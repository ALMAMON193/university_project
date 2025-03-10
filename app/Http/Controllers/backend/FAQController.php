<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\FAQ;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class FAQController extends Controller
{
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $data = FAQ::latest()->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('status', function ($data) {
                        // Define the base class and an array of status-to-class mappings
                        $baseClass = 'btn btn-sm dropdown-toggle';

                        $statusClassMap = [
                            '0' => 'btn-danger',
                            '1' => 'btn-success',
                        ];

                        // Get the class for the current status, defaulting to 'btn-warning' if not found
                        $statusClass = $statusClassMap[$data->status] ?? 'btn-warning';

                        $select = '<select class="' . $baseClass . ' ' . $statusClass . '" onchange="auctionStatusHandler(' . $data->id . ')">';
                        $select .= '<option ' . ($data->status == '1' ? 'selected' : '') . ' value="1">Publish</option>';
                        $select .= '<option ' . ($data->status == '0' ? 'selected' : '') . ' value="0">Unpublish</option>';
                        $select .= '</select>';

                        return $select;
                    })
                    ->addColumn('action', function ($data) {
                        return '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                      <a href="' . route('cms.car.page.faq.edit', $data->id) . '" type="button" class="btn btn-primary text-white" title="Show" style="padding: 10px">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                      <a href="#" onclick="deleteAlert(' . $data->id . ')" type="button" class="btn btn-danger text-white" title="Delete">
                                      <i class="fa fa-times"></i>
                                    </a>
                                    </div>';
                    })

                    ->rawColumns(['status', 'action'])
                    ->make(true);
            }
            return view('backend.layout.CMS.sell-car.FAQ.index');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Something went wrong! Please try again.');
        }
    }

    public function create()
    {
        return view('backend.layout.CMS.sell-car.FAQ.create');
    }


    public function store(Request $request)
    {
        $input = $request->validate([
            'place' => 'required|in:one,two,three',
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);

        FAQ::create($input);
        return redirect()->route('cms.car.page.faq.index')->with('t-success', 'FAQ Created Successfully');
    }

    public function edit(FAQ $faq)
    {
        return view('backend.layout.CMS.sell-car.FAQ.edit', compact('faq'));
    }

    public function update(Request $request, FAQ $faq)
    {
        $input = $request->validate([
            'place' => 'required|in:one,two,three',
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);

        $faq->update($input);
        return redirect()->route('cms.car.page.faq.index')->with('t-success', 'FAQ Updated Successfully');
    }

    public function status(Request $request)
    {
        try {
            $faq = FAQ::findOrFail($request->id);
            $faq->status = !$faq->status;
            $faq->save();
            return response()->json([
                'message' => 'Status Updated',
                'success' => true,
                'status' => $faq->status
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Failed not update',
                'success' => false
            ], 404);
        }
    }

    public function destory(FAQ $faq)
    {
        try {
            $faq->delete();
            return response()->json([
                'success' => true,
                'message' => 'FAQ is successfully deleted.'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong...!'
            ], 500);
        }
    }
}
