<?php

namespace App\Http\Controllers\backend;

use Exception;
use Carbon\Carbon;
use App\Models\Auction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class AuctionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data = Auction::latest()->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('full_name', function ($data) {
                        return '<div >
                                <a href="'.route('bidder.profile', ['id' => $data->user_id, 'slug' => Str::slug($data->user->full_name ?? '')]).'" type="button" class="btn btn-success text-white" title="Show" style="padding: 10px">
                                    <div>' . $data->user->full_name . '</div>
                                </a>
                            </div>';
                    })
                    ->addColumn('featured', function ($data) {
                        $featured = ' <div class="form-check form-switch" style="margin-left:40px;">';
                        $featured .= ' <input onclick="auctionFeaturedHandler(' . $data->id . ', this)" type="checkbox" class="form-check-input" id="customSwitch' . $data->id . '" getAreaid="' . $data->id . '" name="featured"';
                        if ($data->featured == 1) {
                            $featured .= "checked";
                        }
                        $featured .= '><label for="customSwitch' . $data->id . '" class="form-check-label" for="customSwitch"></label></div>';

                        return $featured;
                    })
                    ->addColumn('status', function ($data) {
                        // Define the base class and an array of status-to-class mappings
                        $baseClass = 'btn btn-sm dropdown-toggle';

                        $statusClassMap = [
                            'pending' => 'btn-warning',
                            'approve' => 'btn-success',
                            'disapprove' => 'btn-secondary',
                            'close' => 'btn-danger'
                        ];

                        // Get the class for the current status, defaulting to 'btn-warning' if not found
                        $statusClass = $statusClassMap[$data->status] ?? 'btn-warning';

                        $select = '<select class="' . $baseClass . ' ' . $statusClass . '" onchange="auctionStatusHandler(' . $data->id . ', this)">';
                        $select .= '<option ' . ($data->status === 'pending' ? 'selected' : '') . ' value="pending">Pending</option>';
                        $select .= '<option ' . ($data->status === 'approve' ? 'selected' : '') . ' value="approve">Approve</option>';
                        $select .= '<option ' . ($data->status === 'disapprove' ? 'selected' : '') . ' value="disapprove">Disapprove</option>';
                        $select .= '<option ' . ($data->status === 'close' ? 'selected' : '') . ' value="close">close</option>';

                        $select .= '</select>';

                        return $select;
                    })
                    ->addColumn('action', function ($data) {
                        return '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                      <a href="' . route('backend.auction.show', $data->id) . '" type="button" class="btn btn-primary text-white" title="Show" style="padding: 10px">
                                    <i class="fa fa-eye"></i>
                                </a>
                                      <a href="#" onclick="deleteAlert(' . $data->id . ')" type="button" class="btn btn-danger text-white" title="Delete">
                                      <i class="fa fa-times"></i>
                                    </a>
                                    </div>';
                    })

                    ->rawColumns(['full_name','featured', 'status', 'action'])
                    ->make(true);
            }
            return view('backend.layout.auction.index');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Something went wrong! Please try again.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $auction = Auction::findOrFail($id);

        $maxBid = $auction->maxBid();

        $bid = $auction->bids()->where('bid', $maxBid)->first();
        return view('backend.layout.auction.show', compact('auction', 'bid'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Update the status in storage.
     */
    public function statusUpdate(Request $request)
    {
        try {
            $auction = Auction::findOrFail($request->id);
            $previousStatus = $auction->status;
            $auction->status = $request->status;
            if ($request->status === 'approve' && $previousStatus !== 'approve') {

                // Set start time to current timestamp in the desired format
                $auction->start = Carbon::now()->format('Y-m-d H:i:s');

                // Set end time to 7 days from now in the desired format
                $auction->end = Carbon::now()->addHours(168)->format('Y-m-d H:i:s');
            }
            $auction->save();
            return response()->json([
                'message' => 'Status role updated to ' . $request->status,
                'success' => true,
                'status' => $auction->status
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Failed not update',
                'success' => false
            ], 404);
        }
    }

    /**
     * Update the Featured in storage.
     */
    public function featuredUpdate(Request $request)
    {
        try {
            $data = Auction::findOrFail($request->id);
            if ($data->featured == 1) {
                $data->featured = 0;
                $data->save();

                return response()->json([
                    'message' => 'Featured role updated to ' . $request->featured,
                    'success' => true
                ]);
            } else {
                $data->featured = 1;
                $data->save();

                return response()->json([
                    'message' => 'Featured role updated to ' . $request->featured,
                    'success' => true
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Failed not update',
                'success' => false
            ], 404);
        }
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Auction $auction)
    {
        try {
            $auction->delete();
            return response()->json([
                'success' => true,
                'message' => 'Auction is successfully deleted.'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong...!'
            ], 500);
        }
    }
}
