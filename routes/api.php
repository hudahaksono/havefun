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

//Master Paket
Route::get('/master-paket/list-data', 'Master\PaketController@list_data_hdr')->name('api.paket.list');
Route::get('/master-paket/list-data-dtl', 'Master\PaketController@list_data_dtl')->name('api.paket.list.dtl');
Route::post('/master-paket/store', 'Master\PaketController@store')->name('api.paket.store');
Route::post('/master-paket/store-dtl', 'Master\PaketController@store_dtl')->name('api.paket.store.dtl');
Route::post('/master-paket/update', 'Master\PaketController@update')->name('api.paket.update');
Route::post('/master-paket/destroy', 'Master\PaketController@destroy')->name('api.paket.destroy');
Route::post('/master-paket/destroy-dtl', 'Master\PaketController@destroy_dtl')->name('api.paket.destroy.dtl');

//Master Kategori
Route::get('/master-kategori/list-data', 'Master\KategoriController@list_data_hdr')->name('api.kategori.list');
Route::post('/master-kategori/store', 'Master\KategoriController@store')->name('api.kategori.store');
Route::post('/master-kategori/update', 'Master\KategoriController@update')->name('api.kategori.update');
Route::post('/master-kategori/destroy', 'Master\KategoriController@destroy')->name('api.kategori.destroy');

//Master Barang
Route::get('/master-product/list-data', 'Master\ProductController@list_data_hdr')->name('api.product.list');
Route::get('/master-product/list-paket', 'Master\ProductController@list_data_paket')->name('api.product.list.paket');
Route::get('/master-product/list-kategori', 'Master\ProductController@list_data_kategori')->name('api.product.list.kategori');
Route::post('/master-product/store', 'Master\ProductController@store')->name('api.product.store');
Route::post('/master-product/update', 'Master\ProductController@update')->name('api.product.update');
Route::post('/master-product/destroy', 'Master\ProductController@destroy')->name('api.product.destroy');

//Order Barang
Route::get('/tr-order/list-data', 'Transaksi\OrderController@list_data_hdr')->name('api.order.list');
Route::get('/tr-order/list-data-dtl', 'Transaksi\OrderController@list_data_dtl')->name('api.order.listdtl');
Route::get('/tr-order/list-kategori', 'Transaksi\OrderController@list_data_kategori')->name('api.order.list.kategori');
Route::get('/tr-order/list-barang', 'Transaksi\OrderController@list_data_barang')->name('api.order.list.barang');
Route::post('/tr-order/store', 'Transaksi\OrderController@store')->name('api.order.store');
Route::post('/tr-order/update', 'Transaksi\OrderController@update')->name('api.order.update');
Route::post('/tr-order/destroy-hdr', 'Transaksi\OrderController@destroy_hdr')->name('api.order.destroyhdr');
Route::post('/tr-order/destroy-dtl', 'Transaksi\OrderController@destroy_dtl')->name('api.order.destroydtl');
Route::post('/tr-order/proses-po', 'Transaksi\OrderController@proses_po')->name('api.order.proses');

//Payment
Route::get('/tr-payment/list-data', 'Transaksi\PaymentController@list_data_hdr')->name('api.payment.list');
Route::post('/tr-payment/store', 'Transaksi\PaymentController@store')->name('api.payment.store');

// Schedule
Route::get('/tr-schedule/list-data', 'Transaksi\ScheduleController@list_data_hdr')->name('api.schedule.list');
Route::get('/tr-schedule/list-data-order', 'Transaksi\ScheduleController@list_data_order')->name('api.schedule.listorder');
Route::post('/tr-schedule/store', 'Transaksi\ScheduleController@store')->name('api.schedule.store');
Route::post('/tr-schedule/update', 'Transaksi\ScheduleController@update')->name('api.schedule.update');

// FRONT
Route::get('/fr-produk', 'Front\ProdukController@list_produk')->name('api.fr.produk.list');
Route::get('/fr-produk/detail', 'Front\ProdukController@detail_produk')->name('api.fr.produk.detail');
Route::post('/fr-produk/chart/store', 'Front\ProdukController@store_chart')->name('api.fr.produk.store.chart');

// Route::get('/fr-chart/list', 'Front\ChartController@list_produk')->name('api.fr.chart.list');
Route::post('/fr-payment/order/store', 'Front\PaymentController@store_order')->name('api.fr.payment.store.order');
Route::get('/fr-payment/list', 'Front\PaymentController@list_produk')->name('api.fr.payment.list');