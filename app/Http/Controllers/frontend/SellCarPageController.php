<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Auction;
use App\Models\CMS_Content;
use App\Models\FAQ;
use App\Models\Sell_Car_Page;
use App\Models\State;
use Illuminate\Http\Request;

class SellCarPageController extends Controller
{
    // return the view of sell-car
    public function index()
    {
        $data = Sell_Car_Page::all();
        $cms = CMS_Content::all();
        $status = State::all();
        $faqs = FAQ::whereStatus(true)->get();
        $auctions = Auction::where('status', 'approve')
            ->where('end', '<', now())
            ->whereHas('bids') // Ensure there is at least one related bid
            ->take(4)
            ->get();

        return view('frontend.layout.sell-car', compact('data', 'cms', 'status', 'auctions', 'faqs'));
    }
}