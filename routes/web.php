<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\SalesOrderController;
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

// Route::get('/', function () {
//     return view('frontend.pages.index');
// });

Route::get('/',[HomeController::class,'index'])->name('index');
Route::get('/login',[HomeController::class,'login'])->name('login');
Route::post('/login',[HomeController::class,'post_login'])->name('post_login');
Route::post('/logout',[HomeController::class,'logout'])->name('logout');
Route::get('/my_cart',[HomeController::class,'my_cart'])->name('my_cart')->middleware('LoginCheck');
Route::get('/my_order',[HomeController::class,'my_order'])->name('my_order')->middleware('LoginCheck');

Route::get('/count_word',function(){
    return view('frontend.pages.wordcount');
})->name('count_word');
Route::post('/count_word',[HomeController::class,'countWordsInSentences'])->name('count_word_post');


Route::post('/cart/data/store/{id}', [CartController::class,'add_to_cart'])->name('addtocart_direct')->middleware('LoginCheck');
Route::post('/cart/data/sub/{id}', [CartController::class,'sub_to_cart'])->name('subtocart_direct')->middleware('LoginCheck');
Route::post('/cart/data/delete', [CartController::class,'delete_to_cart'])->name('delete_to_cart')->middleware('LoginCheck');


Route::get('/create_sales_order',[SalesOrderController::class,'create_sales_order'])->name('create_sales_order')->middleware('LoginCheck');
Route::get('/complete_sales_order/{id}',[SalesOrderController::class,'complete_sales_order'])->name('complete_sales_order')->middleware('LoginCheck','SalesOwnerCheck');
Route::get('/cancel_sales_order/{id}',[SalesOrderController::class,'cancel_sales_order'])->name('cancel_sales_order')->middleware('LoginCheck','SalesOwnerCheck');
