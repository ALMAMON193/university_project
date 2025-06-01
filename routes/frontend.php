<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\BidController;
use App\Http\Controllers\frontend\UserController;
use App\Http\Controllers\frontend\AuctionController;
use App\Http\Controllers\frontend\ChatbotController;
use App\Http\Controllers\frontend\HomepageController;
use App\Http\Controllers\frontend\WishlistController;
use App\Http\Controllers\frontend\AboutPageController;
use App\Http\Controllers\frontend\BankAccountController;
use App\Http\Controllers\frontend\DynamicPageController;
use App\Http\Controllers\frontend\SellCarPageController;
use App\Http\Controllers\frontend\BidderProfileController;
use App\Http\Controllers\PaymentController\StripeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/**
 * This route group contains all routes for the HomepageController
 */
Route::controller(HomepageController::class)->group(function () {
    // return the view of the index page
    Route::get('/', 'index')->name('home-page');
    Route::get('/filter', 'filter')->name('filter');
});


/**
 * This route group contains all the routes under the UserController
 */
Route::controller(UserController::class)->middleware('auth')->group(function () {
    // return the view of the prifile view
    Route::get('my-profile', 'index')->name('user.profile')->middleware(['auth', 'otp_verified']);
});


/**
 * This route group contains all the routes under the UserController
 */
Route::controller(UserController::class)->middleware(['auth', 'otp_verified'])->group(function () {
    // update image
    Route::post('/avater', 'updateImage')->name('image.update');
    // updat the public info form
    Route::patch('public-info', 'UpdatePublicInfo')->name('public.info');
    // update the private info
    Route::patch('private-info', 'UpdatePrivateInfo')->name('private.info');
    // update the card information
    Route::patch('card-info', 'updateCard')->name('update.card.Info');
    // delete user
    Route::delete('delete-user', 'destory')->name('delete.user');
});


/**
 * This route group contains all routes for the page AboutPageController
 */
Route::controller(AboutPageController::class)->group(function () {
    // return the view of cars-and-bits.blade.php
    Route::get('/cars-and-bits', 'index')->name('cars.bid.page');
});

/**
 * This route group contains all routes for the SellCarPageController
 */
Route::controller(SellCarPageController::class)->group(function () {
    // return the view of sell-car.blade.php
    Route::get('/sell-car', 'index')->name('sell.car.page');
})->middleware(['auth', 'otp_verified']);

/**
 * this route group contains all the routes for the AuctionController
 */

Route::controller(AuctionController::class)->group(function () {
    // return auction page
    Route::get('/auctions/{year}/{model}/{make}', 'index')->name('auction.page');
    // all atucitons
    Route::get('/auctions/{year}/{model}/{make}/all', 'viewAll')->name('auction.all');
    // a single auction
    Route::get('/auction/{auction}/{slug}', 'show')->name('show.auction');
    // search
    Route::get('/search', 'search')->name('search.auction');
});


/**
 * this route group contains all the routes for the AuctionController
 */

Route::controller(AuctionController::class)->middleware('auth')->group(function () {
    // creating an auction
    Route::post('/auction', 'create')->name('create.auction');
    // updating an auction
    Route::patch('/auction', 'update')->name('update.auction');
    // deleting an auction
    Route::delete('/auction', 'delete')->name('delete.auction');
});


/**
 * This route group contains all the routes of the BidController
 */
Route::controller(BidController::class)->middleware('auth')->group(function () {
    // posting a bid under a user
    Route::post('/bid', 'create')->name('bid.create');
})->middleware(['auth', 'otp_verified']);

/**
 * This route group contains all the routes of the DynamicPageController
 */
Route::controller(DynamicPageController::class)->group(function () {
    // return the view of sell-car.blade.php
    Route::get('/page/{page_slug}', 'index')->name('custom.page');
});


/**
 * Strype controller
 */

Route::controller(StripeController::class)->middleware('auth')->group(function () {
    Route::post('/recharge', 'recharge')->name('strype.payment');
    Route::get('/recharge/success', 'success')->name('strype.success');
    Route::put('/recharge/initiate-Transfer', 'initiateTransfer')->name('strype.initiate.transfer');
    Route::get('test/bank-account', 'generateBankAccountToken')->name('strype.test.bank');
});

Route::controller(BankAccountController::class)->middleware('auth')->group(function () {
    Route::post('/withdraw', 'create')->name('withdraw.create');
});

Route::controller(WishlistController::class)->middleware('auth')->group(function () {
    // this basically add wishlist of a user
    Route::post('/wishlist/add', 'index')->name('wishlist.add');
});

Route::prefix('bidder-profile')->controller(BidderProfileController::class)->group(function () {
    // user profile for all user
    Route::get('bidder/{id}/{slug}', 'index')->name('bidder.profile');
    Route::get('bidder/{id}/{slug}/comments', 'indexWithAllComments')->name('bidder.profile.all');
});


Route::get('/chat-gpt', [ChatbotController::class, 'ChatGpt'])->name('chat-gpt.view');
Route::post('/chat-gpt', [ChatbotController::class, 'ChatGptPost'])->name('chat-gpt.post');
