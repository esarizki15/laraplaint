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
 
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/ajax', 'UserController@ajax')->name('ajax');

Route::get('/email', function () {
    return view('email');
});
Route::group(['middleware'=>['auth']], function () {
Route::post('/user/{user}/storeLokasi', 'UserController@storeLokasi')->name('user.storeLokasi');
Route::delete('/user/{user}/deleteLokasi/{lokasi}', 'UserController@deleteLokasi')->name('user.deleteLokasi');

Route::resource('user', 'UserController');
Route::get('/ajax/lokasi/search', 'LokasiController@ajaxSearch')->name('lokasi.search');
Route::resource('lokasi', 'LokasiController');
Route::resource('konfirmasi', 'KonfirmasiController');

Route::resource('kategori', 'KategoriController');
Route::get('/ajax/mesin/search', 'MesinController@ajaxSearch')->name('mesin.search');
Route::resource('mesin', 'MesinController');
Route::get('pengaduan/create/{lokasi}/{mesin}','PengaduanController@autoCreate')->name('pengaduan.createQR');
Route::resource('pengaduan', 'PengaduanController');
Route::resource('penanganan', 'PenangananController');
Route::get('riwayat/{pengaduan}', 'RiwayatController@create')->name('riwayat.create');
Route::get('pengaduan/{pengaduan}/riwayat/{riwayat}', 'RiwayatController@edit')->name('riwayat.edit');

Route::put('pengaduan/{pengaduan}/riwayat/{riwayat}', 'RiwayatController@update')->name('riwayat.update');

Route::post('riwayat', 'RiwayatController@store')->name('riwayat.store');
Route::delete('riwayat/{riwayat}', 'RiwayatController@destroy')->name('riwayat.destroy');


Route::get('/lokasiMesin/{id}', 'LokasiMesinController@index')->name('lokasiMesin.index');

Route::get('/lokasiMesin/{id}/create', 'LokasiMesinController@create')->name('lokasiMesin.create');

Route::post('/lokasiMesin/{id}', 'LokasiMesinController@store')->name('lokasiMesin.store');

Route::delete('/lokasiMesin/{lokasi}/{mesin}', 'LokasiMesinController@destroy')->name('lokasiMesin.destroy');

Route::get('/qr', 'QRCodeController@index')->name('qr.index');
Route::get('/qr/{lokasi}/{mesin}', 'QRCodeController@create')->name('qr.create');
});