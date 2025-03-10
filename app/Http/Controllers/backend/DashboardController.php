<?php

namespace App\Http\Controllers\backend;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Bid;

class DashboardController extends Controller
{
       /**
     * Display the backend dashboard.
     *
     * @return View
     */

     public function index(){
       $totalUser = User::where('role','user')->count();

       $totalActiveUser = User::join('bids','users.id','bids.user_id')
       ->leftJoin('auctions','auctions.id','bids.auction_id')
       ->where('end','>',now())
       ->distinct()
       ->count('users.id');

       $totalBids = Bid::count();

       $totalBidWinner = Bid::where('winn','true')->count();

       $user = User::count();

        $totalCountsData = [
            'Users'              => $user,
            'Total Active Users' => $totalActiveUser,
            'Total Bids'           => $totalBids,
            'Total Bid Winner'      => $totalBidWinner,
        ];

        return view('backend.layout.dashboard',compact([
            'user',
            'totalUser',
            'totalActiveUser',
            'totalBids',
            'totalCountsData',
            'totalBids',
            'totalBidWinner'
        ]));
     }
}
