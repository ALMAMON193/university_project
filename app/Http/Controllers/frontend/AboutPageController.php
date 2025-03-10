<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Cars_And_Bids;

class AboutPageController extends Controller
{
    // return the view of cars-and-bids
    public function index() {
        $data = Cars_And_Bids::all();
        // dd($data);
        return view('frontend.layout.cars-and-bids', compact('data'));
    }
}
