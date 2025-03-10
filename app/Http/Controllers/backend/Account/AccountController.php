<?php

namespace App\Http\Controllers\backend\Account;

use Exception;
use Carbon\Carbon;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data = Transaction::latest()->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('user_name', function ($data) {
                        return '<div >
                                <a href="'.route('bidder.profile', ['id' => $data->user_id, 'slug' => Str::slug($data->user->full_name ?? '')]).'" type="button" class="btn btn-success text-white" title="Show" style="padding: 10px">
                                    <div>' . $data->user->full_name . '</div>
                                </a>
                            </div>';
                    })
                    ->addColumn('payment_date', function ($data) {
                        return Carbon::parse($data->created_at)->format('Y-m-d');
                    })
                    ->rawColumns(['user_name','payment_date'])
                    ->make(true);
            }
            return view('backend.layout.account.transaction.index');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Something went wrong! Please try again.');
        }
    }
}



