<?php

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Modules\Category\Infra\Controllers\CategoryController;
use App\Modules\Products\Infra\Controllers\ProductsController;
use App\Modules\Users\Infra\Controllers\UsersController;
use App\Modules\Users\Infra\Controllers\SessionsController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/session', [SessionsController::class, 'store']);
Route::post('/users', [UsersController::class, 'store']);



Route::group([
    'middleware' => 'auth',
], function ($router) {
    Route::get('/category', [CategoryController::class, 'index']);
    Route::post('/category', [CategoryController::class, 'store']);

    Route::get('/products', [ProductsController::class, 'index']);
    Route::post('/products', [ProductsController::class, 'store']);

    Route::get('/users', [UsersController::class, 'index']);
});
