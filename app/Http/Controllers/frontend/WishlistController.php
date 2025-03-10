<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index(Request $request)
    {
        // Validate input
        $request->validate([
            'auction_id' => 'required|exists:auctions,id',
        ]);

        $auctionId = $request->input('auction_id');
        $userId = auth()->id();

        // Check if the wishlist item exists for this user and auction
        $wishlistItem = Wishlist::where('user_id', $userId)
            ->where('auction_id', $auctionId)
            ->first();

        if ($wishlistItem) {
            //  if  item exists, we will remove it from wishlist
            $wishlistItem->delete();
            return response()->json(['wished' => false,'success' => true, 'message' => 'Item removed from wishlist.']);
        } else {
            // if item does not exist, so add it to wishlist
            $wishlistItem = new Wishlist();
            $wishlistItem->user_id = $userId;
            $wishlistItem->auction_id = $auctionId;
            $wishlistItem->save();
            return response()->json(['wished' => true,'success' => true, 'message' => 'Item added to wishlist.']);
        }
    }
}
