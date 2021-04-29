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

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', 'PagesController@availableHouses')->name('home');
Route::get('/house/{id}','PagesController@viewHouse')->name('view.house');
Route::post('/house/filter','PagesController@filter')->name('house.filter');
Route::get('/search', 'PagesController@search')->name('house.search');


Route::group(['middleware' => 'auth'], function () {
    
Route::get('/myhouses','PagesController@myHouseList')->name('show.Myhouses');
Route::post('/myhouses','housesController@store')->name('house.store');
Route::get('/myhouses/edit/{id}', 'housesController@edit')->name('house.edit');
Route::post('/myhouses/update/{id}', 'housesController@update')->name('house.update');
Route::get('/myhouses/delete/{id}', 'housesController@delete')->name('house.delete');
Route::get('/addhouse','PagesController@addHouse')->name('house.add');

Route::get('/house/torent/{id}','housesController@sentToRent')->name('house.sentRent');
Route::get('/house/fromrent/{id}','housesController@retFromRent')->name('house.fromRent');

Route::get('/review/{id}','PagesController@Review')->name('house.review');
Route::post('/review/{id}','ReviewController@store')->name('house.review.store');
Route::post('/review/update/{house_id}/{review_id}','ReviewController@update')->name('house.review.update');
Route::get('/review/delete/{id}','ReviewController@delete')->name('house.review.delete');

// Route::get('/areas','PagesController@areaList')->name('show.Area');
// Route::post('/areas','areaController@store')->name('Area.store');
// Route::get('area/edit/{id}','areaController@edit')->name('Area.edit');
// Route::post('/area/update/{id}', 'areaController@update')->name('Area.update');


Route::get('/payment/{house_id}','PagesController@payment')->name('make.payment');
Route::get('/paymentHistory','PagesController@paymentHistory')->name('history.payment');
Route::get('/rentHistory','PagesController@rentHistory')->name('history.rent');
Route::get('/getrenterinfo/{payment_id}','PagesController@renter')->name('view.renterinfo');
Route::get('/getownerinfo/{payment_id}','PagesController@owner')->name('view.ownerinfo');
Route::get('/renthistory','PagesController@rentHistory')->name('view.rentHistory');
Route::get('/paymentwith/{house_id}','PagesController@paywith')->name('paywith');
});

