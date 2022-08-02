<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\RoleController;
use GuzzleHttp\Middleware;
use Illuminate\Auth\Middleware\AdminAuth;
// use Illuminate\Auth\Middleware\AdminAuth;

// use App\Http\Controllers\ProductController;

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
    return $request->user();
});

/*
|--------------------------------------------------------------------------
| API Routes for register & login
|--------------------------------------------------------------------------
*/
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


/*
|--------------------------------------------------------------------------
| API Routes for admin & User
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::post('/logout', [AuthController::class, 'logout']);

/*
|--------------------------------------------------------------------------
| API Routes for Product View
|--------------------------------------------------------------------------
*/
    Route::prefix('product')->group(function(){
       
        // Route::post('/', [ProductController::class, 'store']);
        Route::get('/{id}', [ProductController::class, 'show']);
        Route::get('/', [ProductController::class, 'index']);





    /*
|--------------------------------------------------------------------------
| API Routes for Admin Acess Only
|--------------------------------------------------------------------------
*/
        Route::group(['middleware' => ['admin.auth']], function(){
            Route::post('/', [ProductController::class, 'store']);
            Route::post('/{id}', [ProductController::class, 'update']);
            Route::delete('/{id}', [ProductController::class, 'destroy']);

        });
    });

    Route::prefix('roles')->group(function(){
        Route::group(['middleware' => ['admin.auth']], function(){
            Route::get('/', [RoleController::class, 'index']);
            Route::post('/', [RoleController::class, 'store']);
            Route::get('/{id}', [RoleController::class, 'show']);
            Route::put('/{id}', [RoleController::class, 'update']);
            Route::delete('/{id}', [RoleController::class, 'destroy']);
        });
    });

    /*
    |--------------------------------------------------------------------------
    | API Routes for Cart 
    |--------------------------------------------------------------------------
    */
    Route::prefix('cart')->group(function(){
        Route::get('/', [CartController::class, 'index']);
        Route::post('/', [CartController::class, 'store']);
        Route::get('/{id}', [CartController::class, 'show']);
        Route::delete('/{id}', [CartController::class, 'destroy']);
    });



 
});