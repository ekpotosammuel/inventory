<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


// Route::post('/login', [RegisterController::class, 'login']);



// Route::prefix('product')->group(function(){
//     Route::get('/', 'ProductController@index');
//     Route::post('/', 'ProductController@store');
//     Route::get('/{id}', 'ProductController@show');
//     Route::put('/{id}', 'ProductController@update');
//     Route::delete('/{id}', 'ProductController@destroy');
// });