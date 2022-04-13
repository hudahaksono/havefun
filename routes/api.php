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

//Master Kategori Paket
Route::get('/master-kategori-paket/list-data', 'Master\KategoriPaketController@list_data_hdr')->name('api.kategori.paket.list');
Route::post('/master-kategori-paket/store', 'Master\KategoriPaketController@store')->name('api.kategori.paket.store');
Route::post('/master-kategori-paket/update', 'Master\KategoriPaketController@update')->name('api.kategori.paket.update');
Route::post('/master-kategori-paket/destroy', 'Master\KategoriPaketController@destroy')->name('api.kategori.paket.destroy');

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
Route::get('/tr-order/list-paket', 'Transaksi\OrderController@list_data_paket')->name('api.order.list.paket');
Route::post('/tr-order/store', 'Transaksi\OrderController@store')->name('api.order.store');
Route::post('/tr-order/store-paket', 'Transaksi\OrderController@store_paket')->name('api.order.paket.store');
Route::post('/tr-order/update', 'Transaksi\OrderController@update')->name('api.order.update');
Route::post('/tr-order/destroy-hdr', 'Transaksi\OrderController@destroy_hdr')->name('api.order.destroyhdr');
Route::post('/tr-order/destroy-dtl', 'Transaksi\OrderController@destroy_dtl')->name('api.order.destroydtl');
Route::post('/tr-order/proses-po', 'Transaksi\OrderController@proses_po')->name('api.order.proses');
Route::get('/tr-order/get-total', 'Transaksi\OrderController@get_total')->name('api.order.total');

//Payment
Route::get('/tr-payment/list-data', 'Transaksi\PaymentController@list_data_hdr')->name('api.payment.list');
Route::post('/tr-payment/store', 'Transaksi\PaymentController@store')->name('api.payment.store');

// Schedule
Route::get('/tr-schedule/list-data', 'Transaksi\ScheduleController@list_data_hdr')->name('api.schedule.list');
Route::get('/tr-schedule/list-data-order', 'Transaksi\ScheduleController@list_data_order')->name('api.schedule.listorder');
Route::post('/tr-schedule/store', 'Transaksi\ScheduleController@store')->name('api.schedule.store');
Route::post('/tr-schedule/update', 'Transaksi\ScheduleController@update')->name('api.schedule.update');

// FRONT
// PRODUCT
Route::get('/fr-produk', 'Front\ProdukController@list_produk')->name('api.fr.produk.list');
Route::get('/fr-produk/detail', 'Front\ProdukController@detail_produk')->name('api.fr.produk.detail');
Route::post('/fr-produk/chart/store', 'Front\ProdukController@store_chart')->name('api.fr.produk.store.chart');
Route::post('/fr-produk/barang/store', 'Front\ProdukController@store_barang')->name('api.fr.produk.store.barang');
Route::post('/fr-produk/paket/store', 'Front\PaketController@store_barang')->name('api.fr.produk.store.paket');

// Route::get('/fr-chart/list', 'Front\ChartController@list_produk')->name('api.fr.chart.list');
Route::post('/fr-payment/order/store', 'Front\PaymentController@store_order')->name('api.fr.payment.store.order');
Route::post('/fr-payment/payment/store', 'Front\PaymentController@store_payment')->name('api.fr.payment.store.payment');
Route::get('/fr-payment/list', 'Front\PaymentController@list_produk')->name('api.fr.payment.list');

// PAKET
Route::get('/fr-paket', 'Front\PaketController@list_produk')->name('api.fr.paket.list');
Route::get('/fr-paket/detail', 'Front\PaketController@detail_produk')->name('api.fr.paket.detail');
Route::get('/fr-paket/detail-product', 'Front\PaketController@detail_produk_paket')->name('api.fr.paket.detail.produk');
Route::post('/fr-paket/chart/store', 'Front\PaketController@store_chart')->name('api.fr.paket.store.chart');