<?php

namespace App\Http\Controllers\backend\setting;

use App\Http\Controllers\Controller;
use App\Models\CMS_Content;
use FFI\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SystemController extends Controller
{
    /**
     * return view & array
     */
    public function index()
    {
        $data = CMS_Content::all();
        return view('backend.layout.setting.system', compact('data'));
    }

    /**
     * return view & array
     */
    public function socialLink()
    {
        $data = CMS_Content::all();
        return view('backend.layout.setting.social-link', compact('data'));
    }

    /**
     * Update title and image
     * taking input from a form
     * returns error or success tost
     */
    public function title_content_image(Request $request)
    {
        $data = CMS_Content::find($request->id);
        $image_url = null;

        // Define the validation rules
        $rules = [
            'image_url' => 'nullable|image|mimes:jpeg,jpg,png,svg,webp|max:2048'
        ];
        // Create a validator instance with the request data and rules
        $validator = Validator::make($request->all(), $rules);
        // returning the validation error
        if ($validator->fails()) {

            return redirect()->back()->with('t-error', $validator->errors()->first());
        }

        try {
            if ($request->has('image_url')) {
                $image = $request->file('image_url');
                $image_url = uploadImage($image, 'images/cms');

                $data->update([
                    'title' => $request->title,
                    'image_url' => $image_url ?? $data->image_url,
                ]);
            } else {
                $data->update([
                    'title' => $request->title,
                ]);
            }

            return redirect()->back()->with('t-success', 'Updated Successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Something went wrong');
        }
    }


    /**
     * Update title
     * taking input from a form
     * returns error or success tost
     */
    public function title_content(Request $request)
    {
        $data = CMS_Content::find($request->id);
        try {
            $data->update([
                'title' => $request->title,
            ]);

            return redirect()->back()->with('t-success', 'Updated Successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Something went wrong');
        }
    }

    /**
     * Update link
     * taking input from a form
     * returns error or success tost
     */
    public function link_content(Request $request)
    {
        $data = CMS_Content::find($request->id);
        try {
            $data->update([
                'link' => $request->link,
            ]);

            return redirect()->back()->with('t-success', 'Updated Successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Something went wrong');
        }
    }


    /**
     * Update the image
     * taking input from a form
     * returns error or success tost
     */
    public function upload_image(Request $request)
    {
        $data = CMS_Content::find($request->id);
        $image_url = null;

        // Define the validation rules
        $rules = [
            'image_url' => 'nullable|image|mimes:jpeg,jpg,png,svg,webp|max:2048'
        ];
        // Create a validator instance with the request data and rules
        $validator = Validator::make($request->all(), $rules);
        // returning the validation error
        if ($validator->fails()) {

            return redirect()->back()->with('t-error', $validator->errors()->first());
        }

        try {
            if ($request->has('image_url')) {
                $image = $request->file('image_url');
                $image_url = uploadImage($image, 'images/cms');
            }
            $data->update([
                'image_url' => $image_url
            ]);

            return redirect()->back()->with('t-success', 'Updated Successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Something went wrong');
        }
    }



    /**
     * deleteing the image from the how_it_works database
     */
    public function destroy_content_image(Request $request)
    {
        $how_it_works = CMS_Content::find($request->id);
        try {
            $result = deleteImage($how_it_works->image_url);

            $how_it_works->image_url = null;

            $how_it_works->save();

            if ($result) {
                return redirect()->back()->with('t-success', 'Deleted Successfully');
            } else {
                return redirect()->back()->with('t-error', 'No Image to Delete');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Something went wrong');
        }
    }
}
