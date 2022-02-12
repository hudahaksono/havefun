<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Master Kategori
Route::get('/master-kategori/list-data', 'Master\KategoriController@list_data_hdr')->name('api.kategori.list');
Route::post('/master-kategori/store', 'Master\KategoriController@store')->name('api.kategori.store');
Route::post('/master-kategori/update', 'Master\KategoriController@update')->name('api.kategori.update');
Route::post('/master-kategori/destroy', 'Master\KategoriController@destroy')->name('api.kategori.destroy');

//Master Barang
Route::get('/master-product/list-data', 'Master\ProductController@list_data_hdr')->name('api.product.list');
Route::get('/master-product/list-kategori', 'Master\ProductController@list_data_kategori')->name('api.product.list.kategori');
Route::post('/master-product/store', 'Master\ProductController@store')->name('api.product.store');
Route::post('/master-product/update', 'Master\ProductController@update')->name('api.product.update');
Route::post('/master-product/destroy', 'Master\ProductController@destroy')->name('api.product.destroy');