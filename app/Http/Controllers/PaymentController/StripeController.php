<?php

namespace App\Http\Controllers\PaymentController;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Rules\CheckBalance;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session as LaravelSession;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Stripe;
use Stripe\Transfer;
use Stripe\StripeClient;
use Stripe\Token;

class StripeController extends Controller
{
    // strip payment system
    public function recharge(Request $request)
    {
        $input = $request->validate([
            'amount' =>'required|numeric',
        ]);
        try {
            $user = auth()->user();

            // Generate a unique ID and store data in session
            LaravelSession::put([
                'amount' => $input['amount'],
            ]);

            // set the stripe API token
            Stripe::setApiKey(config('stripe.sk'));

            $redirectUrl = route('strype.success') . '?session_id={CHECKOUT_SESSION_ID}';
            $cancleURL = route('home-page');
            // Create the Stripe checkout session
            $session = StripeSession::create([
                'payment_method_types' => ['card'],
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'usd',
                            'product_data' => [
                                'name' => $user->email,
                            ],
                            'unit_amount' => $input['amount'] * 100,
                        ],
                        'quantity' => 1,
                    ]
                ],
                'mode' => 'payment',
                'success_url' => $redirectUrl,
                'cancel_url' => $cancleURL,
            ]);


            return redirect()->away($session->url);
        } catch (Exception $e) {
            // Handle the exception
            Log::error($e->getMessage());
            dd($e->getMessage());

            return redirect()->route('user.buy-tickets')->with($e->getMessage());
        }

    }

    // to save tranjection records after a successful payment.
    public function success(Request $request)
    {
        try {
            $stripe = new StripeClient(Config::get('stripe.sk'));
            $user = auth()->user();
            // saving the session
            $session = $stripe->checkout->sessions->retrieve($request->session_id);
            // checking all is present
            if (!empty($session) && $session->payment_status == 'paid') {
                DB::beginTransaction();
                $userBalance = $user->balance;
                $current_balance = (float) $userBalance->balance;
                $recharge_amount = (float) $session->amount_total / 100;
                // new balance amount
                $new_balance = $current_balance + $recharge_amount;
                // Update balance through the relationship
                $user->balance()->update(['balance' => $new_balance]);

                // add the info to the transaction table
                $transaction = new Transaction();
                $transaction->amount = $recharge_amount;
                $transaction->transaction = $session->payment_intent;

                $user->transactions()->save($transaction);
                DB::commit();

                return redirect()->route('home-page')->with('t-success', 'Recharge Successful');
            }
            else {
                return redirect()->route('home-page')->with('t-error', 'Transection Fail...!');
            }
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('home-page')->with('t-error', 'Recharge Unsuccessful.....!');
        }
    }


    // generate test bank account token
    public function generateBankAccountToken()
    {
        Stripe::setApiKey(config('stripe.sk'));
        try {
            $token = Token::create([
                'bank_account' => [
                    'country' => 'US',
                    'currency' => 'usd',
                    'account_holder_name' => 'Test User',
                    'account_holder_type' => 'individual',
                    'routing_number' => '110000000', // Test routing number
                    'account_number' => '000999999991', // Test account number
                ],
            ]);
            return response()->json(['token' => $token]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    // to redirect amount from stripe to bank account
    public function initiateTransfer(Request $request)
    {
        $input = $request->validate([
            'account' => ['required'],
            'amount' => ['required', new CheckBalance],
        ]);

        // set the stripe API token
        Stripe::setApiKey(config('stripe.sk'));
        try {
            // Create a transfer to the recipient's bank account
            $transfer = Transfer::create([
                'amount' =>  100,
                'currency' => 'usd',  // Currency code
                'destination' => 'acct_1PVYFaBNYzm7LOTt',  // Replace with recipient's Stripe account ID
                'description' => 'Refund from balance',  // Optional description
            ]);

            // Redirect the user to the Stripe transfer page
            return redirect()->away($transfer->destination_payment_url);
        } catch (Exception $e) {
            // Handle transfer failure
            // dd($e);
            return back()->withError('Transfer could not be initiated: ' . $e->getMessage());
        }
    }

    public function cancel()
    {

    }
}
