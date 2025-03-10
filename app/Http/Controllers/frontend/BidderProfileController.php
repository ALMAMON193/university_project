<?php

namespace App\Http\Controllers\frontend;
use App\Http\Controllers\Controller;
use App\Models\User;
use Usamamuneerchaudhary\Commentify\Models\User as Commenter;


class BidderProfileController extends Controller
{
    /**
     * returns the view of profile edite page for user
     */
    public function index(string $id)
    {
        $bidder = User::with('profile')->find($id);
        // dd($bidder);
        // $comments = Commenter::findOrFail($bidder->id)->comments()->take(4)->get();
        $commenter = Commenter::findOrFail($bidder->id);
        $totalComments = $commenter->comments()->count();
        $comments = $commenter->comments()->take(4)->get();
        // dd($comments[0]->commentable);
        $data = [
            'bidder' => $bidder,
            'comments' => $comments,
            'totalComments' => $totalComments,
        ];
        return view('frontend.layout.bidder-profile', compact('data'));
    }

    public function indexWithAllComments(string $id)
    {
        $bidder = User::with('profile')->find($id);
        $comments = Commenter::findOrFail($bidder->id)->comments()->get();
        $data = [
            'bidder' => $bidder,
            'comments' => $comments,
            'totalComments' => 0,
        ];
        return view('frontend.layout.bidder-profile', compact('data'));
    }
}
