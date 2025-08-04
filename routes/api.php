<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Product\OrderController;
use App\Http\Controllers\Backend\Uncat\AdminViewController;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Backend\Product\CategoryController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\Backend\Product\ProductController;
use App\Http\Controllers\Backend\Users\UserController;
use App\Http\Controllers\BannerController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::any('/send-otp', [AdminViewController::class, 'sendOtp']);
Route::post('/custom-register', [AdminViewController::class, 'register']);
Route::post('/custom-login', [AdminViewController::class, 'login']);
Route::get('/registered-user-details', [UserController::class, 'registeredUserDetails']);
Route::get('/privacy-policy', [AdminViewController::class, 'viewPages']);
Route::get('/support-center', [AdminViewController::class, 'viewPages']);
Route::get('/terms-condition', [AdminViewController::class, 'viewPages']);
Route::get('/about-us', [AdminViewController::class, 'viewPages']);


Route::get('/get-basic-settings', [ApiController::class, 'getBasicSettings']);
Route::get('/get-active-categories', [ApiController::class, 'getActiveCategories']);
Route::get('/get-active-sub-categories/{category}', [ApiController::class, 'getActiveSubCategories']);
Route::get('/get-active-districts', [ApiController::class, 'getActiveDistricts']);
Route::get('/get-active-areas-by-district/{district}', [ApiController::class, 'getActiveAreasByDistrict']);
Route::get('/get-active-products', [ApiController::class, 'getActiveProducts']);
Route::get('/get-active-featured-products', [ApiController::class, 'getActiveFeaturedProducts']);
Route::get('/get-active-discounted-products', [ApiController::class, 'getActiveDiscountedProducts']);
Route::get('/get-active-products-by-category/{category}', [ApiController::class, 'getActiveProductsByCategory']);
Route::get('/categories/{category}', [CategoryController::class, 'show']);
Route::get('/products/{product}', [ProductController::class, 'show']);
//Route::get('/users/{user}', [UserController::class, 'show']);
Route::get('/order-history/{user}', [OrderController::class, 'orderHistory']);
Route::get('/registered-user-order-history', [OrderController::class, 'registeredUserOrderHistory']);
Route::get('/req-for-order-rejection/{order}', [OrderController::class, 'reqForOrderRejection']);
Route::get('/banners', [BannerController::class, 'index']);

Route::post('/change-order-status', [OrderController::class, 'changeOrderStatus']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function (){
    Route::apiResource('orders', OrderController::class);
    Route::apiResource('users', UserController::class);
//    Route::apiResource('banners', BannerController::class);
    Route::get('get-order-full-details/{order}', [OrderController::class, 'getOrderFullDetails']);
});
