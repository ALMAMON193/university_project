<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\BankAccount;
use Illuminate\Http\Request;
use Exception;

class BankAccountController extends Controller
{
    public function create(Request $request)
    {
        $activeBids = auth()->user()->hasUsersBidsOnActivedAuctions;
        if (count($activeBids)) {
            return redirect()->back()->with('t-error', 'You cannot withdraw your money while participating in an active auction. Please try again after the auction has ended."');
        }
        $input = $request->validate([
            'account_number' => 'required',
            'account_name' => 'required',
            'routing_number' => 'required',
            'bank_name' => 'required',
            'branch_name' => 'required',
            'country' => 'required',
            'city' => 'required',
            'state' => 'nullable',
            'amount' => 'required|numeric'
        ]);
        try {
            $bankAccount = new BankAccount($input);
            $user = auth()->user();
            $balance = $user->balance->balance;
            // dd($balance);
            if ((float) $balance < (float) $input['amount']) {
                return redirect()->back()->with('t-error', "Can't withdraw more than your balance amount $" . $balance);
            }
            $user->bankAccounts()->save($bankAccount);
            return redirect()->back()->with('t-success', 'Refund request send successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Something went wrong');
        }
    }
}
