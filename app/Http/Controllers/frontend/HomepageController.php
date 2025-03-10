<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Auction;
use App\Models\CMS_Content;
use Exception;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
  // return the view of index.php
  public function index()
  {
    // calling the data
    $cms = CMS_Content::all();
    // getting all the approved auctions only
    $auctions = Auction::where('status', '!=', 'disapprove')->where('status', '!=', 'close')->where(function ($q) {
      $q->where('end', '>=', now())
        ->orWhereNull('end');
    })->get();
    // dd($auctions);
    $data = [
      'cms' => $cms,
      'auctions' => $auctions,
      'parameters' => ['year' => '*', 'model' => '*', 'make' => '*']
    ];
    return view('frontend.layout.index', compact('data'));
  }


  /**
   * filter the auction base on the request
   */
  public function filter(Request $request)
  {
    try {

      // calling the data
      $cms = CMS_Content::all();
      // getting filtered auction
      $query = Auction::where('status', '!=', 'disapprove')->where('status', '!=', 'close')->where(function ($q) {
        $q->where('end', '>=', now())
          ->orWhereNull('end');
      });

      if ($request->year != '*') {
        $query->where('year', $request->year);
      }
      if ($request->model != '*') {
        $query->where('model', $request->model);
      }
      if ($request->make != '*') {
        $query->where('make', $request->make);
      }

      $auctions = $query->get();

      $data = [
        'cms' => $cms,
        'auctions' => $auctions,
        'parameters' => ['year' => $request->year, 'model' => $request->model, 'make' => $request->make]
      ];

      return view('frontend.layout.index', compact('data'));

    } catch (Exception $e) {
      // Handle query exceptions
      return response()->json([
        'success' => false,
        'message' => 'Error retrieving filtered data: ' . $e->getMessage()
      ], 500);
    } catch (Exception $e) {
      // Handle other unexpected exceptions
      return response()->json([
        'success' => false,
        'message' => 'Unexpected error: ' . $e->getMessage()
      ], 500);
    }
  }
}
