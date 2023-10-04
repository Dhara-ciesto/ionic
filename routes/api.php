<?php

use App\Http\Controllers\api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ApiResponseController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return auth()->user();
});

// Route::post('/franchise-login', [FranchiseController::class, 'login']);
Route::group(['middleware' => ['auth:sanctum']], function () {
    // Route::get('bakery', [BakeryController::class, 'index']);
    // Route::get('kitchen', [KitchenController::class, 'index']);
    // Route::post('place-order', [FranchiseController::class, 'store']);
    // Route::post('change-password', [FranchiseController::class, 'changePassword']);
    Route::post('updateProfile/{id}', [AuthController::class, 'updateProfile']);
    Route::get('products/{id?}', [ApiResponseController::class, 'index'])->name('product.index');
    Route::post('addtocart', [ApiResponseController::class, 'addToCart'])->name('product.addtocart');
    Route::get('categories', [ApiResponseController::class, 'getCategories'])->name('categories.index');
    Route::get('getcart', [ApiResponseController::class, 'getcart'])->name('product.getcart');
    Route::post('editCartItem/{id}', [ApiResponseController::class, 'editCartItem'])->name('product.editCartItem');
    Route::post('createOrder', [ApiResponseController::class, 'createOrder']);
    Route::get('getOrder/{status}', [ApiResponseController::class, 'getOrder']);
    Route::get('getRecentOrders/{id}/{status}', [ApiResponseController::class, 'getRecentOrders']);
    Route::post('getRecentOrders/{id}/{status}', [ApiResponseController::class, 'getRecentOrders']);
    Route::post('dispatchOrder', [ApiResponseController::class, 'dispatchOrder']);
    Route::get('getSize/{id}', [ApiResponseController::class, 'getSize']);
    Route::get('getUsers', [AuthController::class, 'getUsers']);
    Route::get('/logout', [AuthController::class, 'signout']);
});

Route::group(['middleware' => ['cors']], function () {
    Route::post('/login', [AuthController::class, 'loginUser']);

    Route::post('/sendotp', [AuthController::class, 'sendotp']);
    Route::post('/otpverify', [AuthController::class, 'otpverify']);
    Route::post('/register', [AuthController::class, 'register']);
});




Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
});
