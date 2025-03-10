<?php

namespace App\Http\Controllers\backend\Account;


use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\BankAccount;
use Illuminate\Support\Facades\DB;

class WithdrawController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data = BankAccount::latest()->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('user_name', function ($data) {
                        return '<div >
                                <a href="' . route('bidder.profile', ['id' => $data->user_id, 'slug' => Str::slug($data->user->full_name ?? '')]) . '" type="button" class="btn btn-success text-white" title="Show" style="padding: 10px">
                                    <div>' . $data->user->full_name . '</div>
                                </a>
                            </div>';
                    })
                    ->addColumn('status', function ($data) {

                        if ($data->status == 'pending') {
                            $select = '<select class="btn btn-sm btn-success dropdown-toggle" onchange="auctionStatusHandler(' . $data->id . ', this)">';
                            $select .= '<option ' . ($data->status === 'pending' ? 'selected' : '') . ' value="pending">Pending</option>';
                            $select .= '<option ' . ($data->status === 'success' ? 'selected' : '') . ' value="success">Success</option>';

                            $select .= '</select>';

                            return $select;
                        } else {
                           return '<p style="color:green;">'.$data->status.'</p>';
                        }
                    })

                    ->rawColumns(['user_name', 'status'])
                    ->make(true);
            }
            return view('backend.layout.account.withdraw.index');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Something went wrong! Please try again.');
        }
    }

    /**
     * Update the status in storage.
     */
    public function statusUpdate(Request $request)
    {
        // dd($request->all());
        try {

            DB::beginTransaction();
            $withdraw = BankAccount::findOrFail($request->id);
            $withdraw->status = $request->status;
            $withdraw->save();

            $user = $withdraw->user;
            $Balance = $user->balance;

            $oldBalance = $Balance->balance;

            $newBalance = (float) $oldBalance - (float) $withdraw->amount;

            $Balance->balance = $newBalance;
            $Balance->save();

            DB::commit();

            return response()->json([
                'message' => 'Status role updated to ' . $request->status,
                'success' => true
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => $e,
                'success' => false
            ], 404);
        }
    }
}


