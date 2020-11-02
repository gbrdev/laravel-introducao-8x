<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductCtr;
use Illuminate\Support\Facades\Artisan;
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

Route::get('/hello/{name}/{city?}', function ($name, $city = null) {
    $response =  "<h1>Hello World</h1>";
    $response .= "<h2>$name</h2>";
    $response .= !is_null($city) ? "<h2>$city</h2>" : "";
    return $response;
})->name('home');

Route::get('/products', [ProductCtr::class,'index']);

Route::get('/products/add/{product}', [ProductCtr::class, 'addProduct']);

Route::resource('/client', ClientController::class);



