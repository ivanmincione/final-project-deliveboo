<?php

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

//ROTTE FRONTEND
Route::get('/', function () {
    return view('welcome');
})->name('uiHome');

Auth::routes();

Route::get('/restaurants', 'RestaurantController@index')->name('guest.restaurants');

Route::get('/restaurants/{slug}', 'RestaurantController@show')->name('restaurants.show');

Route::get('/home', 'HomeController@index')->name('home');

// ROTTE PER IL CARRELLO
// Route::get('/', 'DishController@index');
Route::get('cart', 'DishController@cart')->name('cart');
Route::get('add-to-cart/{id}', 'DishController@addToCart');
Route::patch('update-cart', 'DishController@update');
Route::delete('remove-from-cart', 'DishController@remove');

Route::get('checkout', 'CheckoutController@index')->name('checkout.index');
Route::post('checkout', 'CheckoutController@store')->name('checkout.store');
// rotta dopo il checkout
Route::get('postCheckout', 'CheckoutController@postCheckout')->name('postCheckout');
// rotta pagina faq
Route::get('faq', function () {
    return view('faq');
})->name('faq');




//ROTTE BACKEND
Route::middleware('auth')->namespace('Admin')->prefix('admin')->name('admin.')->group(function() {

    Route::get('/', 'HomeController@showRestaurant')->name('index');
    Route::resource('dishes', 'DishController');
    Route::resource('restaurants', 'RestaurantController');
    Route::resource('statistics', 'StatisticController');
    Route::get('orders', 'OrderController@index')->name('orders.index');
    // Route::get('orders/{id}', 'OrderController@show')->name('orders.show');
});
