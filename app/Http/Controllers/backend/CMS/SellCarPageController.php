<?php

namespace App\Http\Controllers\backend\CMS;

use App\Http\Controllers\Controller;
use App\Models\CMS_Content;
use App\Models\Sell_Car_Page;
use Exception;
use Illuminate\Http\Request;

class SellCarPageController extends Controller
{
    /**
     * return view & array
     */
    public function headerText()
    {
        $data = Sell_Car_Page::all();
        return view('backend.layout.CMS.sell-car.header-text', compact('data'));
    }

    /**
     * return view & array
     */
    public function auction()
    {
        $data = Sell_Car_Page::all();
        return view('backend.layout.CMS.sell-car.auction', compact('data'));
    }

    /**
     * return view & array
     */
    public function howItWorks()
    {
        $data = Sell_Car_Page::all();
        return view('backend.layout.CMS.sell-car.how-works', compact('data'));
    }

    /**
     * return view & array
     */
    public function features()
    {
        $data = Sell_Car_Page::all();
        return view('backend.layout.CMS.sell-car.features', compact('data'));
    }

    /**
     * return view & array
     */
    public function contact()
    {
        $data = CMS_Content::all();
        return view('backend.layout.CMS.sell-car.contact', compact('data'));
    }

    /**
     * Updating Cointact info
    */
    public function updateContact(Request $request) {
        $data = CMS_Content::find($request->id);
        try {
            $data->update([
                'title' => $request->title,
                'sub_title' => $request->sub_title,
                'description' => $request->description
            ]);
            return redirect()->back()->with('t-success', 'Updated Successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Something went wrong');
        }
    }

    /**
     * Update the sale-car page hero text
     * taking input from a form
     * returns error or success tost
     */
    public function create_description(Request $request)
    {
        $data = Sell_Car_Page::find($request->id);
        try {
            $data->update([
                'description' => $request->description,
            ]);
            return redirect()->back()->with('t-success', 'Updated Successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Something went wrong');
        }
    }


    /**
     * Update the about page title & contents
     * taking input from a form
     * returns error or success tost
     */
    public function title_content(Request $request)
    {
        $data = Sell_Car_Page::find($request->id);
        try {
            $data->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);

            return redirect()->back()->with('t-success', 'Updated Successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Something went wrong');
        }
    }


}
