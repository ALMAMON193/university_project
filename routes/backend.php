<?php

use App\Http\Controllers\backend\Account\AccountController;
use App\Http\Controllers\backend\Account\WithdrawController;
use App\Http\Controllers\backend\AuctionController;
use App\Http\Controllers\backend\BidWinnerController;
use App\Http\Controllers\backend\CMS\AboutPageController;
use App\Http\Controllers\backend\CMS\SellCarPageController;
use App\Http\Controllers\backend\CMS\AuctionPageController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\FAQController;
use App\Http\Controllers\backend\setting\DynamicPageController;
use App\Http\Controllers\backend\setting\MailController;
use App\Http\Controllers\backend\setting\SocialLightController;
use App\Http\Controllers\backend\setting\StripeController;
use App\Http\Controllers\backend\setting\SystemController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\backend\UserListController;
use Illuminate\Support\Facades\Route;

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

//!Route for DashboardController
Route::get('/dasboard', [DashboardController::class, 'index'])->name('admin.dashboard');


// routes for sell car page contents
Route::prefix('sell-car-page')->controller(SellCarPageController::class)->group(function () {
    // get methordse
    Route::get('/cms', 'index')->name('cms.car.page');
    Route::get('/cms/headertext', 'headerText')->name('cms.car.page.header');
    Route::get('/cms/section-auction/edit', 'auction')->name('cms.car.page.auction');
    Route::get('/cms/how-it-works', 'howItWorks')->name('cms.car.page.how-works');
    Route::get('/cms/features-sell-car-page', 'features')->name('cms.car.page.features');
    Route::get('/cms/contact', 'contact')->name('cms.car.page.contact');

    // hero text
    Route::patch('/cms/create_hero_text', 'create_description')->name('sell.car.hero');
    // update auction
    Route::patch('/cms/auction', 'title_content')->name('sell.car.auction');
    // how it works
    Route::patch('/cms/how-it-works', 'create_description')->name('sell.car.how.it.works');
    // features
    Route::patch('/cms/features', 'title_content')->name('sell.car.features');
    // contact
    Route::patch('/cms/contact', 'updateContact')->name('sell.car.contact');

});


Route::prefix('sell-car-page/cms/')->controller(FAQController::class)->group(function () {
    Route::get('faq', 'index')->name('cms.car.page.faq.index');
    Route::get('faq/create', 'create')->name('cms.car.page.faq.create');
    Route::post('faq/store', 'store')->name('cms.car.page.faq.store');
    Route::get('faq/{faq}/edit', 'edit')->name('cms.car.page.faq.edit');
    Route::patch('faq/update/{faq}', 'update')->name('cms.car.page.faq.update');
    Route::patch('faq/status', 'status')->name('cms.car.page.faq.status');
    Route::delete('faq/{faq}', 'destory')->name('cms.car.page.faq.destory');
});


// routes for about page contents
Route::prefix('cars-and-bits')->controller(AboutPageController::class)->group(function () {
    // returns the page
    Route::get('/cms', 'index')->name('cms.about.page');
    // update about contents
    Route::patch('/cms/create_about', 'content')->name('create.about');
    Route::delete('/cms/destroy_about', 'destroy_content_image')->name('destroy.about.image');
    // update binding a car contents
    Route::patch('/cms/create_binding_a_car', 'content')->name('binding.car');
    Route::delete('/cms/destroy_binding_a_car_image', 'destroy_content_image')->name('binding.car.image');
    // update sell a car contents
    Route::patch('/cms/create_sell_a_car', 'content')->name('sell.car');
    Route::delete('/cms/destroy_sell_a_car_image', 'destroy_content_image')->name('sell.car.image');
    // update finalizing a car contents
    Route::patch('/cms/create_finalizing_a_car', 'content')->name('finalize.car');
    Route::delete('/cms/destroy_finalizing_a_car_image', 'destroy_content_image')->name('finalize.car.image');
    // update my words
    Route::patch('/cms/create_my_words', 'title_content_image')->name('mywords');
    Route::delete('/cms/destroy_my_words', 'destroy_content_image')->name('mywords.image');
    // update features
    Route::patch('/cms/features', 'title_content')->name('create.features');
    // hero text
    Route::patch('/cms/create_hero_text', 'create_hero_text')->name('hero.text');
    Route::get('/cms/header-text', 'headerText')->name('cab.cms.header');
    Route::get('/cms/about-us', 'aboutUs')->name('cab.cms.about-us');
    Route::get('/cms/my-word', 'myWord')->name('cab.cms.my-word');
    Route::get('/cms/secton-features', 'features')->name('cab.cms.features');
    Route::get('/cms/bidding-a-car', 'biddingCar')->name('cab.cms.bid-car');
    Route::get('/cms/selling-a-car', 'sellingCar')->name('cab.cms.sell-car');
    Route::get('/cms/finalize-sell', 'finalizeSell')->name('cab.cms.finalize-sell');
});

// route for Auction page content
Route::controller(AuctionPageController::class)->group(function () {
    Route::get('/cms/auctions', 'index')->name('cms.auction.index');
    Route::patch('/cms/auctions/words', 'title_content_image')->name('cms.auction.words.update');
    Route::delete('/cms/auctions/words', 'destroy_content_image')->name('cms.auction.words.delete.image');
});



// routes for system page
Route::controller(SystemController::class)->group(function () {
    // returns system page
    Route::get('/setting/system', 'index')->name('system.page');
    Route::get('/social-link', 'socialLink')->name('social-link');


    // update statistics banner content
    Route::patch('/setting/system/statistics_banner', 'title_content_image')->name('statistics.banner');
    Route::delete('/setting/system/destroy_statistics_banner_image', 'destroy_content_image')->name('statistics.banner.image');

    // update Logo
    Route::patch('/setting/system/logo', 'upload_image')->name('logo');
    Route::delete('/setting/system/destroy_logo_image', 'destroy_content_image')->name('logo.destroy');


    // update social links
    Route::patch('/setting/system/link', 'link_content')->name('set.link');

});


// routes for male page
Route::controller(MailController::class)->group(function () {
    // returns mail page
    Route::get('/setting/mail', 'index')->name('mail.page');
    // update email properties of env file
    Route::post('/system/mail', 'mailSettingUpdate')->name('mail.setting.update');

});

// routes for dinamic page controller
Route::controller(DynamicPageController::class)->group(function () {
    Route::get('/dynamic-page', 'index')->name('dynamic.page');
    Route::get('create/dynamic-page', 'dynamicPageCreate')->name('dynamic.page.create');
    Route::post('/dynamic-page/create', 'dynamicPageStore')->name('dynamic.page.store');
    Route::get('update/{id}/edit/dynamic-page', 'dynamicPageEdit')->name('dynamic.page.edit');
    Route::post('update/dynamic-page/{id}', 'dynamicPageUpdate')->name('dynamic.page.update');
    Route::delete('/dynamic-page/delete/{id}', 'dynamicPageDelete')->name('dynamic.page.delete');
    Route::get('/dynamic-page/status/{id}', 'status')->name('dynamic.page.status');
});


// route for Auction controller
Route::controller(AuctionController::class)->group(function () {
    Route::get('car-auction-lists', 'index')->name('backend.auction.index');
    Route::delete('auction/{auction}', 'destroy')->name('backend.auction.destroy');
    Route::patch('auction/status', 'statusUpdate')->name('backend.auction.status.update');
    Route::patch('/auction/featured', 'featuredUpdate')->name('backend.auction.featured.update');
    Route::get('/auction/{id}/view', 'show')->name('backend.auction.show');
});


/**
 * This route group contains all the routes under the UserController
 */
Route::controller(UserController::class)->group(function () {
    // return the view of the prifile view
    Route::get('my-profile', 'index')->name('backend.user.profile');
    // update image
    Route::post('/avater', 'updateImage')->name('backend.image.update');
    // updat the public info form
    Route::patch('public-info', 'UpdatePublicInfo')->name('backend.public.info');
    // update the private info
    Route::patch('private-info', 'UpdatePrivateInfo')->name('backend.private.info');
});

/**
 * This route group contains all the routes under the UserListController
 */
Route::controller(UserListController::class)->group(function () {

    Route::get('user-lists', 'index')->name('backend.user-list.index');
    Route::delete('user-list/{user}', 'destroy')->name('backend.user-list.destroy');
    Route::patch('user-list/status', 'statusUpdate')->name('backend.user-list.status.update');
    Route::patch('/user-list/role', 'roleUpdate')->name('backend.user-list.role.update');
});

// route for Account controller
Route::controller(AccountController::class)->group(function () {
    Route::get('/account/transaction', 'index')->name('backend.account.transaction.index');
});


// routes for stripe page
Route::prefix('setting')->controller(StripeController::class)->group(function () {
    // returns stripe page
    Route::get('stripe', 'index')->name('stripe-page');
    // update stripe properties of env file
    Route::post('stripe', 'stripeSettingUpdate')->name('stripe.setting.update');

});



// routes for social page
Route::prefix('setting')->controller(SocialLightController::class)->group(function () {
    // returns social page
    Route::get('/social-light', 'index')->name('social-light-page');
    // update social properties of env file
    Route::post('/social-light', 'socialLightSettingUpdate')->name('social-light.setting.update');

});

// route for Auction controller
Route::controller(WithdrawController::class)->group(function () {
    Route::get('/account/withdraw', 'index')->name('backend.account.withdraw.index');
    Route::patch('/account/withdraw/status', 'statusUpdate')->name('backend.account.withdraw.status.update');
});

// route for Bidwinner controller
Route::controller(BidWinnerController::class)->group(function () {
    Route::get('/auction/bidwinner', 'index')->name('backend.auction.bidwinner.index');
});

