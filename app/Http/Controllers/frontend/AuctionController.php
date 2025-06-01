<?php

namespace App\Http\Controllers\frontend;

use Exception;
use App\Models\Auction;
use App\Rules\MediaSize;
use App\Rules\MediaCount;
use App\Models\CMS_Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\AuctionImageGallery;
use App\Models\AuctionVideoGallery;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AuctionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($year, $model, $make)
    {
        // getting filtered auction
        $query = Auction::where('status', '!=', 'disapprove')->where('status', '!=', 'close')->where(function ($q) {
            $q->where('end', '>=', now())
                ->orWhereNull('end');
        });

        if ($year != '*') {
            $query->where('year', $year);
        }
        if ($model != '*') {
            $query->where('model', $model);
        }
        if ($make != '*') {
            $query->where('make', $make);
        }

        // Paginate the results
        $auctions = $query->paginate(12);

        $data = [
            'auctions' => $auctions,
            'parameters' => ['year' => $year, 'model' => $model, 'make' => $make]
        ];

        return view('frontend.layout.auction', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // dd($request->all());

        // Assuming authentication and user retrieval
        $user = auth()->user();

        if ($user->email_verified_at     == null) {
            return redirect()->back()->with('t-error', 'Please vefiry your email address');
        }


        // creating validation rules
        $rules = [
            'full_name' => 'required',
            'phone' => 'required',
            'vin_number' => 'required',
            'year' => 'required | numeric',
            'make' => 'required',
            'model' => 'required',
            'transmission' => 'required',
            'mileage' => 'required',
            'equipment' => 'required',
            'modify' => 'required|boolean',
            'flaw' => 'required|boolean',
            'modify_text' => $request->modify == true ? 'required' : 'nullable',
            'flaw_text' => $request->flaw == true ? 'required' : 'nullable',
            'location' => 'required',
            'sale_elsewhere' => 'required|boolean',
            'titled_location' => 'required',
            'state_id' => 'required',
            'on_my_name' => 'required|boolean',
            'title_status' => 'required',
            'reserve_price' => 'required|boolean',
            'price_range' => $request->reserve_price == true ? 'required' : 'nullable',
            'engine' => 'required',
            'drivetrain' => 'required',
            'body_style' => 'required',
            'exterior_color' => 'required',
            'interior_color' => 'required',
            'ownership_history' => 'required',
            'media' => ['required', 'array'],
            'media.*' => 'file|mimes:jpeg,png,jpg,gif,svg,avi,mpeg,mov,mp4',
        ];
        // validating rules
        $input = Validator::make($request->all(), $rules);
        // Return validation errors if any
        if ($input->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $input->errors()
            ]);
        }

        try {
            // Start a database transaction
            DB::beginTransaction();

            // Creating new Auction instance
            $auction = new Auction();
            $auction->full_name = $request->input('full_name');
            $auction->phone = $request->input('phone');
            $auction->vin_number = $request->input('vin_number');
            $auction->year = $request->input('year');
            $auction->make = $request->input('make');
            $auction->model = $request->input('model');
            $auction->transmission = $request->input('transmission');
            $auction->mileage = $request->input('mileage');
            $auction->equipment = $request->input('equipment');
            $auction->modify = (bool) $request->input('modify');
            $auction->flaw = (bool) $request->input('flaw');
            $auction->modify_text = (bool) $request->input('modify') ? $request->input('modify_text') : null;
            $auction->flaw_text = (bool) $request->input('flaw') ? $request->input('flaw_text') : null;
            $auction->location = $request->input('location');
            $auction->sale_elsewhere = (bool) $request->input('sale_elsewhere');
            $auction->titled_location = $request->input('titled_location');
            $auction->state_id = $request->input('state_id');
            $auction->on_my_name = (bool) $request->input('on_my_name');
            $auction->title_status = $request->input('title_status');
            $auction->reserve_price = (bool) $request->input('reserve_price');
            $auction->price_range = (bool) $request->input('reserve_price') ? $request->input('price_range') : null;
            $auction->engine = $request->input('engine');
            $auction->drivetrain = $request->input('drivetrain');
            $auction->body_style = $request->input('body_style');
            $auction->exterior_color = $request->input('exterior_color');
            $auction->interior_color = $request->input('interior_color');
            $auction->ownership_history = $request->input('ownership_history');



            // Save the auction
            $auction = $user->auctions()->save($auction);


            // Handle file uploads
            if ($request->hasFile('media')) {
                foreach ($request->file('media') as $media) {
                    $extension = $media->getClientOriginalExtension();

                    if (in_array($extension, ['jpeg', 'png', 'jpg', 'gif', 'svg'])) {
                        $url = uploadImage($media, 'images/auctions'); // Adjust the storage path as needed
                        // Save to auction_image_galleries table
                        $auctionImage = new AuctionImageGallery(['url' => $url]);
                        $auction->auctionImageGallery()->save($auctionImage);
                    } elseif (in_array($extension, ['avi', 'mpeg', 'mov', 'mp4'])) {
                        $url = uploadImage($media, 'videos/auctions'); // Adjust the storage path as needed
                        // Save to auction_image_galleries table
                        $auctionImage = new AuctionVideoGallery(['url' => $url]);
                        $auction->auctionImageGallery()->save($auctionImage);
                    }
                }
            }

            // Commit the transaction
            DB::commit();

            // Set flash message for the next request
            session()->flash('t-success', 'Successfully Uploaded');

            return response()->json([
                'success' => true,
                'message' => 'Successfully uploaded'
            ], 200);
        } catch (Exception $e) {
            // Rollback the transaction on exception
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong..!',
                'error' => $e->getMessage()
            ], 500);
        }
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
    public function show(Auction $auction)
    {
        $cms = CMS_Content::all();
        $auctions = Auction::where('id', '!=', $auction->id)->where('status', 'approve')->orderBy('end', 'desc')->take(10)->get();

        $data = [
            'auction' => $auction,
            'auctions' => $auctions,
            'cms' => $cms,
        ];
        return view('frontend.layout.car-single', compact('data'));
    }

    /**
     * exicute auction search operation
     */
    public function search(Request $request)
    {
        $input = $request->validate([
            'search' => 'required',
        ]);

        $auctions = Auction::where(function ($query) use ($input) {
            $query->where('make', 'LIKE', "%{$input['search']}%")
                ->orWhere('model', 'LIKE', "%{$input['search']}%")
                ->orWhere('year', 'LIKE', "%{$input['search']}%");
        })
            ->where('status', '!=', 'disapprove')
            ->where('status', '!=', 'close')
            ->where(function ($q) {
                $q->where('end', '>=', now())
                    ->orWhereNull('end');
            })
            ->paginate(12);

        $data = [
            'auctions' => $auctions,
            'parameters' => [
                'year' => "*",
                'model' => "*",
                'make' => "*",
            ],
        ];
        // dd($data);
        return view('frontend.layout.auction', compact('data'));
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
