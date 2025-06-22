<?php

namespace App\Http\Controllers\frontend;

use App\Events\CarBiddingPriceEvent;
use App\Http\Controllers\Controller;
use App\Models\Auction;
use App\Models\Bid;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;

class BidController extends Controller
{
    // create a bid
    public function create(Request $request)
    {
        $user = auth()->user();

        if ($user->email_verified_at == null) {
            return redirect()->back()->with('t-error', 'Please verify your email address');
        }

        $input = $request->validate([
            'bid' => 'required|numeric',
            'auction_id' => 'required|numeric'
        ], [
            'bid' => 'Please enter a valid bid amount'
        ]);

        // Finding a bid under a user id
        $bid = Bid::where('user_id', auth()->user()->id)->where('auction_id', $input['auction_id'])->first();

        // Retrieve the highest bid for the specified auction_id
        $auction = Auction::findOrFail($request->auction_id);
        $highest_bid = $auction->maxBid();

        // Check if the amount is greater than highest bid
        if ($request->bid < $highest_bid) {
            return redirect()->back()->with('t-error', "You can't bid lower than the current highest bid");
        } else if ($request->bid == $highest_bid) {
            return redirect()->back()->with('t-error', "You can't bid same as the current highest bid");
        } else if ((float) $highest_bid + 50 > (float) $input['bid']) {
            return redirect()->back()->with('t-error', "Next bid range is " . (float) $highest_bid + 50 . "$");
        }

        // Create a new bid instance
        $newBid = new Bid([
            'bid' => $input['bid'],
            'auction_id' => $input['auction_id'],
            // Additional fields if any
        ]);

        if ($bid !== null) {
            // Checking the eligibility for bidding
            $balance = $user->balance->balance;
            $two_percent_of_bid_amount = ((float) $input['bid'] * 2) / 100;

            if ($balance < $two_percent_of_bid_amount) {
                return redirect()->back()->with('t-error', 'You don\'t have enough balance to bid');
            }

            try {
                DB::beginTransaction();
                // Deleting the existing bid
                $bid->delete();
                // Saving the bid
                $user->bids()->save($newBid);
                // Deduct the bid amount from user balance
                $user->balance->balance -= (float) $input['bid'];
                $user->balance->save();
                // Check if the bidding time is less than 1 minute
                $currentTime = Carbon::now();
                $auctionEnd = Carbon::parse($auction->end);
                // Checking the difference between minutes
                $differenceInMinutes = $currentTime->diffInMinutes($auctionEnd, false);
                // Updating the minute with 1 minute
                if ($differenceInMinutes <= 1) {
                    $auction->end = $auctionEnd->addMinutes(1);
                    $auction->save();
                }
                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                return redirect()->back()->with('t-error', $e->getMessage());
            }
        } else {
            try {
                $balance = $user->balance->balance;
                $two_percent_of_bid_amount = ((float) $input['bid'] * 2) / 100;

                if ($balance < $two_percent_of_bid_amount) {
                    return redirect()->back()->with('t-error', 'You don\'t have enough balance to bid');
                }
                DB::beginTransaction();
                $user->bids()->save($newBid);
                // Deduct the bid amount from user balance
                $user->balance->balance -= (float) $input['bid'];
                $user->balance->save();
                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                return redirect()->back()->with('t-error', $e->getMessage());
            }
        }

        $eventData = [
            'auction_id' => $newBid->auction_id,
            'price' => $request->bid,
        ];

        event(
            new CarBiddingPriceEvent(
                $eventData
            )
        );
        return redirect()->back()->with('t-success', 'Bid placed successfully..');
    }
}
