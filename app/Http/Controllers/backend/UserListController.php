<?php

namespace App\Http\Controllers\backend;

use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class UserListController extends Controller
{
    /**
     * Display a user listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data = User::where('id', '!=', auth()->user()->id)->get();

                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('name', function ($data) {
                        return '<div >
                                <a href="'.route('bidder.profile', ['id' => $data->id, 'slug' => Str::slug($data->full_name ?? '')]).'" type="button" class="btn btn-success text-white" title="Show" style="padding: 10px">
                                    <div>' . $data->full_name . '</div>
                                </a>
                            </div>';
                    })
                    ->addColumn('status', function ($data) {
                        $status = ' <div class="form-check form-switch" style="margin-left:40px;">';
                        $status .= ' <input onclick="auctionStatusHandler(' . $data->id . ', this)" type="checkbox" class="form-check-input" id="customSwitch' . $data->id . '" getAreaid="' . $data->id . '" name="status"';
                        if ($data->status == 'active') {
                            $status .= "checked";
                        }
                        $status .= '><label for="customSwitch' . $data->id . '" class="form-check-label" for="customSwitch"></label></div>';

                        return $status;
                    })
                    ->addColumn('role', function ($data) {
                        // Define the base class and an array of status-to-class mappings
                        $baseClass = 'btn btn-sm dropdown-toggle';

                        $roleClassMap = [
                            'admin' => 'btn-success',
                            'user' => 'btn-secondary',
                        ];

                        // Get the class for the current status, defaulting to 'btn-secondary' if not found
                        $roleClass = $roleClassMap[$data->role] ?? 'btn-secondary';
                        $select = '<select class="' . $baseClass . ' ' . $roleClass . '" onchange="auctionRoleHandler(' . $data->id . ', this)">';
                        $select .= '<option ' . ($data->role === 'admin' ? 'selected' : '') . ' value="admin">Admin</option>';
                        $select .= '<option ' . ($data->role === 'user' ? 'selected' : '') . ' value="user">User</option>';

                        $select .= '</select>';

                        return $select;
                    })
                    ->addColumn('action', function ($data) {
                        return '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                      <a href="#" onclick="deleteAlert(' . $data->id . ')" type="button" class="btn btn-danger text-white" title="Delete">
                                      <i class="fa fa-times"></i>
                                    </a>
                                    </div>';
                    })

                    ->rawColumns(['name','status', 'role', 'action'])
                    ->make(true);
            }
            return view('backend.layout.user.index');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Something went wrong! Please try again.');
        }
    }

    /**
     * Update the status in storage.
     */
    public function roleUpdate(Request $request)
    {
        try {
            $data = User::findOrFail($request->id);

            if ($data->role == 'user') {
                $data->role = 'admin';
                $data->save();

                return response()->json([
                    'message' => 'User role updated to ' . $request->featured,
                    'success' => true
                ]);
            } else {
                $data->role = 'user';
                $data->save();

                return response()->json([
                    'message' => 'User role updated to ' . $request->featured,
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
     * Update the Featured in storage.
     */
    public function statusUpdate(Request $request)
    {
        try {
            $data = User::findOrFail($request->id);
            if ($data->status == 'active') {
                $data->status = 'inactive';
                $data->save();

                return response()->json([
                    'message' => 'User status updated to ' . $request->featured,
                    'success' => true
                ]);
            } else {
                $data->status = 'active';
                $data->save();

                return response()->json([
                    'message' => 'User status updated to ' . $request->featured,
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
    public function destroy(User $user)
    {
        try {
            $user->delete();
            return response()->json([
                'success' => true,
                'message' => 'User is successfully deleted.'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong...!'
            ], 500);
        }
    }
}
