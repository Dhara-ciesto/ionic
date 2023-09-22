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
    // Route::post('update-profile', [FranchiseController::class, 'updateProfile']);
    // Route::get('order-history', [FranchiseController::class, 'orderHistory']);
    Route::get('/logout', [AuthController::class, 'signout']);
});

Route::group(['middleware' => ['cors']], function () {
    Route::post('/login', [AuthController::class, 'loginUser']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('products', [ApiResponseController::class, 'index'])->name('product.index');
    Route::get('getGenderProduct/{gender}/{code?}', [ApiResponseController::class, 'getGenderwiseProduct'])->name('product.genderwise');
    
    Route::post('shareFavProduct', [ApiResponseController::class, 'shareFavProduct'])->name('product.shareFavProduct');
    Route::get('getProducts/{ids}', [ApiResponseController::class, 'getProducts'])->name('product.getProducts');
    Route::get('getProduct/{id}', [ApiResponseController::class, 'getProduct'])->name('product.getProduct');
    Route::get('getFragRenceTone/{code}', [ApiResponseController::class, 'getFragRenceTone'])->name('product.getFragRenceTone');
    Route::get('popup-dismiss', [ApiResponseController::class, 'popupDismissAfter'])->name('product.popupDismissAfter');


});




Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
});