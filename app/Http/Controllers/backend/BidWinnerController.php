<?php

namespace App\Http\Controllers\backend;

use Exception;
use App\Models\Bid;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class BidWinnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data = Bid::with('auction')->where('winn', True)->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('winner_name', function ($data) {
                        return '<div >
                                <a href="'.route('bidder.profile', ['id' => $data->user->id, 'slug' => Str::slug($data->user->full_name ?? '')]).'" type="button" class="btn btn-success text-white" title="Show" style="padding: 10px">
                                    <div>' . $data->user->full_name . '</div>
                                </a>
                            </div>';
                    })
                    ->addColumn('model', function ($data) {
                        return $data->auction->year.' '.$data->auction->model;
                    })
                    ->addColumn('win_date', function ($data) {
                        return Carbon::parse($data->created_at)->format('Y-m-d');
                    })
                    ->rawColumns(['winner_name','model','win_date'])
                    ->make(true);
            }
            return view('backend.layout.auction.bid-winner.index');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Something went wrong! Please try again.');
        }
    }
}
