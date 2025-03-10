<?php

namespace App\Http\Controllers\backend\setting;

use App\Http\Controllers\Controller;
use App\Models\DynamicPage;
use Exception;
use Illuminate\Console\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class DynamicPageController extends Controller
{

    /**
     * Display a listing of dynamic pages.
     *
     * param Request $request
     * @eturn View|Factory|JsonResponse
     * throws Exception
     */
    public function index(Request $request): View|Factory|JsonResponse
    {
        if ($request->ajax()) {
            $data = DynamicPage::latest();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('page_title', function ($data) {
                    $page_title = $data->page_title;
                    return '<p>' . $page_title . ' </p>';
                })
                ->addColumn('page_content', function ($data) {
                    $page_content = $data->page_content;
                    $short_page_content = strlen($page_content) > 150 ? substr($page_content, 0, 150) . '...' : $page_content;
                    return '<p>' . $short_page_content . '</p>';
                })
                ->addColumn('status', function ($data) {
                    $status = ' <div class="form-check form-switch" style="margin-left:40px;">';
                    $status .= ' <input onclick="showStatusChangeAlert(' . $data->id . ')" type="checkbox" class="form-check-input" id="customSwitch' . $data->id . '" getAreaid="' . $data->id . '" name="status"';
                    if ($data->status == "active") {
                        $status .= "checked";
                    }
                    $status .= '><label for="customSwitch' . $data->id . '" class="form-check-label" for="customSwitch"></label></div>';

                    return $status;
                })
                ->addColumn('action', function ($data) {
                    return '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                  <a href="' . route('dynamic.page.edit', ['id' => $data->id]) . '" type="button" class="btn btn-primary text-white" title="Edit">
                                  <i class="fa fa-edit"></i>
                                  </a>
                                  <a href="#" onclick="showDeleteConfirm(' . $data->id . ')" type="button" class="btn btn-danger text-white" title="Delete">
                                  <i class="fa fa-times"></i>
                                </a>
                                </div>';
                })
                ->rawColumns(['page_title', 'page_content', 'status', 'action'])
                ->make();
        }
        return view('backend.layout.setting.dynamicPage.index');
    }

    /**
     * Show the form for creating a new dynamic page.
     */
    public function dynamicPageCreate()
    {
        if (auth()->user()->role == 'admin') {
            return view('backend.layout.setting.dynamicPage.create');
        } else {
            return redirect()->back()->with('t-error', 'You do not have permission to create a dynamic page.');
        }
    }

    /**
     * Store a newly created dynamic page in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function dynamicPageStore(Request $request): RedirectResponse
    {
        try {
            if (auth()->user()->role == 'admin') {
                $validator = Validator::make($request->all(), [
                    'page_title' => 'required|string|max:100',
                    'page_content' => 'required|string',
                ]);

                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                $data = new DynamicPage();
                $data->page_title = $request->page_title;
                $data->page_slug = str::slug($request->page_title);
                $data->page_content = $request->page_content;
                $data->save();
            }
            return redirect()->route('dynamic.page')->with('t-success', 'Dynamic Page created successfully.');
        } catch (Exception) {
            return redirect()->route('dynamic.page')->with('t-error', 'Dynamic Page failed created.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View|\Illuminate\Foundation\Application|\Illuminate\View\View|void
     */
    public function dynamicPageEdit(int $id)
    {
        if (auth()->user()->role == 'admin') {
            $data = DynamicPage::find($id);
            return view('backend.layout.setting.dynamicPage.edit', compact('data'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse|void
     */
    public function dynamicPageUpdate(Request $request, int $id)
    {
        try {
            if (auth()->user()->role == 'admin') {
                $validator = Validator::make($request->all(), [
                    'page_title' => 'required|string|max:100',
                    'page_content' => 'required|string',
                ]);

                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                $data = DynamicPage::findOrFail($id);
                $data->page_title = $request->page_title;
                $data->page_slug = Str::slug($request->page_title);
                $data->page_content = $request->page_content;
                $data->update([
                    'page_title' => $data->page_title,
                    'page_slug' => $data->page_slug,
                    'page_content' => $data->page_content,
                ]);

                return redirect()->route('dynamic.page')->with('t-success', 'Dynamic Page Updated Successfully.');
            }
        } catch (Exception $e) {
            // dd($e);
            return redirect()->route('dynamic.page')->with('t-error', 'Dynamic Page failed to update');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function dynamicPageDelete(int $id): JsonResponse
    {
        $page = DynamicPage::find($id);
        if (!$page) {
            return response()->json(['t-success' => false, 'message' => 'Page not found.']);
        }
        $page->delete();
        return response()->json(['t-success' => true, 'message' => 'Deleted successfully.']);
    }

    /**
     * Update the status of a dynamic page.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function status(int $id): JsonResponse
    {
        $data = DynamicPage::where('id', $id)->first();
        if ($data->status == 'active') {
            $data->status = 'inactive';
            $data->save();

            return response()->json([
                'success' => false,
                'message' => 'Unpublished Successfully.',
                'data' => $data,
            ]);
        } else {
            $data->status = 'active';
            $data->save();

            return response()->json([
                'success' => true,
                'message' => 'Published Successfully.',
                'data' => $data,
            ]);
        }
    }
}
