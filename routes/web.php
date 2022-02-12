<?php

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

// Dashboard //
Route::get('/dashboard', 'Menu\MenuController@index')->name('dashboard');

// Master //
Route::get('/master-user', 'Master\MasterUserController@index')->name('master-user');
Route::get('/master-user/list-data', 'Master\MasterUserController@list_data')->name('master-user.list-data');
Route::post('/master-user/store', 'Master\MasterUserController@store')->name('master-user.store');
Route::post('/master-user/update', 'Master\MasterUserController@update')->name('master-user.update');
Route::get('/master-user/destroy', 'Master\MasterUserController@destroy')->name('master-user.destroy');
// });

Route::get('/', function () {
    return view('index');
});

Route::get('/dashboard', function () {
    return view('office.dashboard');
});
