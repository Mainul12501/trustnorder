<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\Product\CategoryController;
use App\Http\Controllers\Backend\Uncat\AdminViewController;
use App\Http\Controllers\Backend\Users\UserController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\Backend\Product\ProductController;
use App\Http\Controllers\SmsOfferController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\Product\OrderController;
use App\Http\Controllers\BasicSettingController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\PageContentController;


//frontend routes
Route::get('/', function () {
//    return view('welcome');
    if (auth()->check())
    {
        return redirect('/dashboard');
    } else {
        return redirect('/login');
    }
});

Route::any('/reset-send-otp', [AdminViewController::class, 'resetSendOtp'])->name('reset-send-otp');
Route::any('/send-otp', [AdminViewController::class, 'sendOtp'])->name('send-otp');
Route::post('/custom-register', [AdminViewController::class, 'register'])->name('custom-register');
Route::post('/custom-login', [AdminViewController::class, 'login'])->name('custom-login');
Route::post('/reset-user-password', [AdminViewController::class, 'resetPassword'])->name('reset-password');
Route::get('/privacy-policy', [AdminViewController::class, 'viewPages'])->name('privacy-policy');
Route::get('/support-center', [AdminViewController::class, 'viewPages'])->name('support-center');
Route::get('/get-total-pending-orders', [AdminViewController::class, 'getTotalPendingOrders'])->name('get-total-pending-orders');




//auth routes
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [AdminViewController::class, 'dashboard'])->name('dashboard');
    Route::get('/send-offers-to-users/{sms_offer}', [SmsOfferController::class, 'sendOfferToUsers'])->name('sms-offers.send-offers-to-users');
    Route::get('/get-areas-by-district-id/{district}', [AreaController::class, 'getAreasByDistrictId'])->name('get-areas-by-district-id');
    Route::post('/change-order-status', [OrderController::class, 'changeOrderStatus'])->name('change-order-status');
    Route::post('/change-cancel-req-order-status/{order}', [OrderController::class, 'changeCancelReqOrderStatus'])->name('change-cancel-req-order-status');
    Route::get('/generate-invoice/{order}', [OrderController::class, 'generateInvoice'])->name('orders.generate-invoice');
    Route::resources([
        'categories' => CategoryController::class,
        'users' => UserController::class,
        'areas' => AreaController::class,
        'products' => ProductController::class,
        'sms-offers'    => SmsOfferController::class,
        'districts'     => DistrictController::class,
        'orders'    => OrderController::class,
        'basic-settings'    => BasicSettingController::class,
        'banners'    => BannerController::class,
        'page-contents'    => PageContentController::class,
    ]);
    Route::prefix('orders')->as('orders')->group(function (){
//        Route::get('/', [OrderController::class, 'index']);
    });
});

Route::get('/clear-all', function () {
    Artisan::call('optimize:clear');
    echo Artisan::output();
});
Route::get('/migrate', function () {
    Artisan::call('migrate');
    echo Artisan::output();
});
Route::get('/migrate-fresh', function () {
    Artisan::call('migrate:fresh');
    echo Artisan::output();
});
Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    echo Artisan::output();
});
Route::get('/auth-test', function () {
    return \App\helper\ViewHelper::loggedUser();
});
Route::get('/df-test',[AdminViewController::class, 'dfTest']);
