<?php

namespace App\Console\Commands;

use App\Models\Auction;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CheckAuctionEnd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auction:check-end';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check if an auction ended and deside the winner of the auction.';

    /**
     * Handle the CheckAuctionEnd command.
     *
     * This command checks for auctions that have ended and processes them accordingly.
     * It identifies winning bids, updates user balances, and closes auctions.
     *
     * @return void
     */
    public function handle()
    {
        Log::info('CheckAuctionEnd command started.');

        $now = Carbon::now();
        $auctions = Auction::where('end', '<', $now)->where('status', 'approve')->get();

        // Log the current time
        Log::info('Current time: ' . $now);

        if ($auctions->isNotEmpty()) {
            foreach ($auctions as $auction) {
                Log::info('Processing auction ID: ' . $auction->id);

                $maxBid = (float) $auction->maxBid();
                Log::info('Max bid: ' . $maxBid);
                if ($maxBid && (float) $auction->price_range <= (float) $maxBid) {
                    $bids = $auction->bids();
                    $bid = $bids->where('bid', $maxBid)->first();
                    $user = $bid->user;

                    $cutof = (2 * $maxBid) / 100;
                    $new_balance = (float) $user->balance->balance - $cutof;

                    $bid->winn = true;
                    $bid->save();

                    $user->balance->balance = $new_balance;
                    $user->balance->save();

                    Log::info('User ID: ' . $user->id . ' won the auction. New balance: ' . $new_balance);
                }
                $auction->status = 'close';
                $auction->save();

                Log::info('Auction ID: ' . $auction->id . ' status updated to close.');
            }
        } else {
            Log::info('No auctions found that need to be processed.');
        }

        Log::info('CheckAuctionEnd command completed.');
    }
}
