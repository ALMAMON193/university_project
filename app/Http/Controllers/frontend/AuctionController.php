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
use Illuminate\Support\Facades\Log;
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
        Log::info('Auction creation attempt', ['user_id' => auth()->id(), 'input' => $request->all()]);

        $user = auth()->user();
        if (!$user || !$user->email_verified_at) {
            Log::warning('Unauthorized auction creation attempt', ['user_id' => auth()->id()]);
            return response()->json([
                'success' => false,
                'message' => 'Please verify your email address'
            ], 403);
        }

        $rules = [
           'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'vin_number' => 'required|string|max:17',
            'year' => 'required|numeric|min:1900|max:' . date('Y'),
            'make' => 'required|string|max:100',
            'model' => 'required|string|max:100',
            'transmission' => 'required|string',
            'mileage' => 'required|numeric|min:0',
            'equipment' => 'required|string',
            'modify' => 'required|boolean',
            'flaw' => 'required|boolean',
            'modify_text' => $request->modify ? 'required|string' : 'nullable|string',
            'flaw_text' => $request->flaw ? 'required|string' : 'nullable|string',
            'location' => 'required|string',
            'sale_elsewhere' => 'required|boolean',
            'titled_location' => 'required|string',
            'state_id' => 'required|exists:states,id',
            'on_my_name' => 'required|boolean',
            'title_status' => 'required|string',
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

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            Log::error('Validation failed', ['errors' => $validator->errors()]);
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

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
            $auction = $user->auctions()->save($auction);
            Log::info('Auction created', ['auction_id' => $auction->id]);

            if ($request->hasFile('media')) {
                foreach ($request->file('media') as $media) {
                    $extension = $media->getClientOriginalExtension();
                    $path = in_array($extension, ['jpeg', 'png', 'jpg', 'gif', 'svg'])
                        ? 'images/auctions'
                        : 'videos/auctions';

                    $url = uploadImage($media, $path);
                    Log::info('Media uploaded', ['url' => $url]);

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
            Log::error('Auction creation failed', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json([
                't-error' => true,
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
