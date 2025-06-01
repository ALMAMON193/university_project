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

        // Check if user is authenticated and email is verified
        $user = auth()->user();
        if (!$user || !$user->email_verified_at) {
            return response()->json([
                'success' => false,
                'message' => 'Please verify your email address'
            ], 403);
        }

        // Define validation rules
        $rules = [
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'vin_number' => 'required|string|max:17',
            'year' => 'required|numeric|min:1900|max:' . date('Y'),
            'make' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'transmission' => 'required|string|in:Manual Transmission,Automatic Transmission,Continuously Variable Transmission,Dual-Clutch Transmission',
            'mileage' => 'required|numeric|min:0',
            'equipment' => 'required|string',
            'modify' => 'required|boolean',
            'flaw' => 'required|boolean',
            'modify_text' => $request->modify ? 'required|string' : 'nullable|string',
            'flaw_text' => $request->flaw ? 'required|string' : 'nullable|string',
            'location' => 'required|string|in:Dhaka,Chattogram,Khulna,Rajshahi,Sylhet,Rangpur,Barisal,Mymensingh',
            'sale_elsewhere' => 'required|boolean',
            'titled_location' => 'required|string|in:Dhaka,Chattogram,Khulna,Rajshahi,Sylhet,Rangpur,Barisal,Mymensingh',
            'state_id' => 'required|exists:states,id',
            'on_my_name' => 'required|boolean',
            'title_status' => 'required|string|in:Clean,Salvage,Rebuilt,Not actual mileage,Manufacturer buyback',
            'reserve_price' => 'required|boolean',
            'price_range' => $request->reserve_price ? 'required|numeric|min:0' : 'nullable|numeric|min:0',
            'engine' => 'required|string|max:100',
            'drivetrain' => 'required|string|max:100',
            'body_style' => 'required|string|max:100',
            'exterior_color' => 'required|string|max:100',
            'interior_color' => 'required|string|max:100',
            'ownership_history' => 'required|string',
            'media' => 'required|array|max:512000', // 500MB total
            'media.*' => 'file|mimes:jpeg,png,jpg,gif,svg,avi,mpeg,mov,mp4|max:20480', // 20MB max per file
        ];

        // Validate request
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            // Create new Auction instance
            $auction = new Auction([
                'full_name' => $request->full_name,
                'phone' => $request->phone,
                'vin_number' => $request->vin_number,
                'year' => $request->year,
                'make' => $request->make,
                'model' => $request->model,
                'transmission' => $request->transmission,
                'mileage' => $request->mileage,
                'equipment' => $request->equipment,
                'modify' => (bool) $request->modify,
                'flaw' => (bool) $request->flaw,
                'modify_text' => $request->modify ? $request->modify_text : null,
                'flaw_text' => $request->flaw ? $request->flaw_text : null,
                'location' => $request->location,
                'sale_elsewhere' => (bool) $request->sale_elsewhere,
                'titled_location' => $request->titled_location,
                'state_id' => $request->state_id,
                'on_my_name' => (bool) $request->on_my_name,
                'title_status' => $request->title_status,
                'reserve_price' => (bool) $request->reserve_price,
                'price_range' => $request->reserve_price ? $request->price_range : null,
                'engine' => $request->engine,
                'drivetrain' => $request->drivetrain,
                'body_style' => $request->body_style,
                'exterior_color' => $request->exterior_color,
                'interior_color' => $request->interior_color,
                'ownership_history' => $request->ownership_history,
            ]);

            // Associate auction with user and save
            $auction = $user->auctions()->save($auction);

            // Handle media uploads
            if ($request->hasFile('media')) {
                foreach ($request->file('media') as $media) {
                    $extension = $media->getClientOriginalExtension();
                    $path = in_array($extension, ['jpeg', 'png', 'jpg', 'gif', 'svg'])
                        ? 'images/auctions'
                        : 'videos/auctions';

                    // Custom upload function (assumed to be defined elsewhere)
                    $url = uploadImage($media, $path);

                    // Save to appropriate gallery
                    $galleryModel = in_array($extension, ['jpeg', 'png', 'jpg', 'gif', 'svg'])
                        ? AuctionImageGallery::class
                        : AuctionVideoGallery::class;

                    $auction->auctionImageGallery()->save(new $galleryModel(['url' => $url]));
                }
            }

            DB::commit();

            return response()->json([
                't-success' => true,
                'message' => 'Auction created successfully'
            ], 200);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                't-error' => false,
                'message' => 'Failed to create auction: ' . $e->getMessage()
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
