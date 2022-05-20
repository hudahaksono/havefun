<?php
// login //
Route::get('/login-customer', 'AuthCustomer\LoginController@index')->name('login-customer');
Route::post('/postlogincustomer', 'AuthCustomer\LoginController@postlogincustomer')->name('postlogincustomer');
Route::get('/logoutcustomer', 'AuthCustomer\LoginController@logoutcustomer')->name('logoutcustomer');

// Register //
Route::get('/register-customer', 'AuthCustomer\RegisterController@index')->name('register-customer');
Route::post('/postregistercustomer', 'AuthCustomer\RegisterController@postregistercustomer')->name('postregistercustomer');

// login //
Route::get('/login', 'Authentification\LoginController@index')->name('login');
Route::post('/postlogin', 'Authentification\LoginController@postlogin')->name('postlogin');
Route::get('/logout', 'Authentification\LoginController@logout')->name('logout');

// Register //
Route::get('/register', 'Authentification\RegisterController@index')->name('register');
Route::post('/postregister', 'Authentification\RegisterController@postregister')->name('postregister');

// Route::group(['middleware' => 'LoginCheck'], function () {
// Menu Dashboard //
Route::get('/menu', 'Menu\MenuController@index')->name('menu');

// Monitoring Kemenkes
Route::get('/kemenkes', 'Monitoring\KemenkesController@index')->name('kemenkes');

// Monitoring Otokabe
Route::get('/otokabe', 'Monitoring\OtokabeController@index')->name('otokabe');

// Monitoring Marketplace
Route::get('/marketplace', 'Monitoring\MarketController@index')->name('marketplace');

// });

//### Front Web ###//
// Route::get('/', function () {
//     return view('front.index');
// });
Route::get('/', 'Front\FrontController@index');

Route::post('/store-message', 'Front\FrontController@store');
Route::post('/store-message2', 'Front\FrontController@store2');

Route::get('/about', 'Front\FrontController@index_about');

Route::get('/product', 'Front\ProdukController@index')->name('f-produk');

Route::get('/paket', 'Front\PaketController@index')->name('f-paket');

Route::get('/cart', 'Front\ChartController@index')->name('f-chart');

Route::get('/payment', 'Front\PaymentController@index')->name('f-payment');

Route::get('/transfer', function () {
    return view('front.transfer');
});

Route::get('/front-profile', 'Front\FrontController@index_profil');

Route::get('/ubah-password', 'Front\FrontController@ubah_password');

Route::get('/myorder', 'Front\OrderController@index')->name('f-myorder');

//### Back Web ###//

Route::get('/profile', function () {
    return view('office.profile');
});

// Dashboard //
Route::get('/dashboard', 'Menu\MenuController@index')->name('dashboard');
Route::get('/dashboard/list-data', 'Menu\MenuController@list_data')->name('dashboard.list-data');

// Master User //
Route::get('/master-user', 'Master\MasterUserController@index')->name('master-user');
Route::get('/master-user/list-data', 'Master\MasterUserController@list_data')->name('master-user.list-data');
Route::post('/master-user/store', 'Master\MasterUserController@store')->name('master-user.store');
Route::post('/master-user/update', 'Master\MasterUserController@update')->name('master-user.update');
Route::post('/master-user/destroy/{id}', 'Master\MasterUserController@destroy')->name('master-user.destroy');

// Master Akses //
Route::get('/master-akses', 'Master\MasterAksesController@index')->name('master-akses');
Route::get('/master-akses/list-data', 'Master\MasterAksesController@list_data')->name('master-akses.list-data');
Route::post('/master-akses/accept/{id}', 'Master\MasterAksesController@accept')->name('master-akses.accept');
Route::post('/master-akses/reject/{id}', 'Master\MasterAksesController@reject')->name('master-akses.reject');

// Master Paket //
Route::get('/master-paket', 'Master\PaketController@index')->name('master-paket');

// Master Paket //
Route::get('/master-banner', 'Master\BannerController@index')->name('master-banner');
Route::get('/master-banner/view_file/{filename}', 'Master\BannerController@view_filename');

// Master Kategori //
Route::get('/master-kategori', 'Master\KategoriController@index')->name('master-kategori');

Route::get('/master-kategori-paket', 'Master\KategoriPaketController@index')->name('master-kategori-paket');
// Route::get('/master-kategori/list-data', 'Master\KategoriController@list_data_hdr');
// Route::post('/master-kategori/store', 'Master\KategoriController@store');
// Route::post('/master-kategori/update', 'Master\KategoriController@update');
// Route::post('/master-kategori/destroy/{id}', 'Master\KategoriController@destroy');

// Master Product //
Route::get('/master-product', 'Master\ProductController@index')->name('master-product');
Route::get('/master-product/view_file/{filename}', 'Master\ProductController@view_filename');

// Route::get('/tr-order', function () {
//     return view('office.transaksi.tr-order');
// });
Route::get('/tr-order', 'Transaksi\OrderController@index')->name('trx-order');

// Route::get('/tr-schedule', function () {
//     return view('office.transaksi.tr-shcedule');
// });
Route::get('/tr-schedule', 'Transaksi\ScheduleController@index')->name('trx-schedule');

// Route::get('/tr-payment', function () {
//     return view('office.transaksi.tr-payment');
// });
Route::get('/tr-payment', 'Transaksi\PaymentController@index')->name('trx-payment');

// Route::get('/', 'TelegramBotController@sendMessage');
Route::post('/send-message', 'TelegramBotController@storeMessage');
Route::get('/send-photo', 'TelegramBotController@sendPhoto');
Route::post('/store-photo', 'TelegramBotController@storePhoto');
Route::get('/updated-activity', 'TelegramBotController@updatedActivity');

// PdF //
Route::get('invoice-lunas', 'Transaksi\InvoiceController@index');
Route::get('invoice-lunas/generate', 'Transaksi\InvoiceController@generatelunas');

// PdF //
Route::get('invoice-outstanding', 'Transaksi\InvoiceController@index_os');
Route::get('invoice-outstanding/generate', 'Transaksi\InvoiceController@generateoutstanding');

// Report //
Route::get('/rpt-message', 'Report\MessageController@index')->name('rpt-message');
Route::get('/rpt-message/list-data', 'Report\MessageController@list_data')->name('rpt-message.list-data');
