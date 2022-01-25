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
    return view('auth.login');
});

Route::prefix('admin')->middleware(['auth','admin'])->group(function () {
    Route::get('dashboard','Admin\DashboardController@index')->name('admin.dashboard.index');

    // CRUD KELAS
    Route::get('kelas', 'Admin\KelasController@index')->name('admin.kelas.index');
    Route::post('kelas/create', 'Admin\KelasController@store')->name('admin.kelas.store');
    Route::post('kelas/update/{id}', 'Admin\KelasController@update')->name('admin.kelas.update');
    Route::post('kelas/delete/{id}', 'Admin\KelasController@delete')->name('admin.kelas.delete');

     // CRUD JURUSAN
     Route::get('jurusan', 'Admin\JurusanController@index')->name('admin.jurusan.index');
     Route::post('jurusan/create', 'Admin\JurusanController@store')->name('admin.jurusan.store');
     Route::post('jurusan/update/{id}', 'Admin\JurusanController@update')->name('admin.jurusan.update');
     Route::post('jurusan/delete/{id}', 'Admin\JurusanController@delete')->name('admin.jurusan.delete');

     // CRUD PEMBAYARAN
     Route::get('pembayaran', 'Admin\PembayaranController@index')->name('admin.pembayaran.index');
     Route::post('pembayaran/create', 'Admin\PembayaranController@store')->name('admin.pembayaran.store');
     Route::post('pembayaran/update/{id}', 'Admin\PembayaranController@update')->name('admin.pembayaran.update');
     Route::post('pembayaran/delete/{id}', 'Admin\PembayaranController@delete')->name('admin.pembayaran.delete');

    // CRUD SISWA
    Route::get('siswa', 'Admin\SiswaController@index')->name('admin.siswa.index');
    Route::post('siswa/create', 'Admin\SiswaController@store')->name('admin.siswa.store');
    Route::post('siswa/update/{id}', 'Admin\SiswaController@update')->name('admin.siswa.update');
    Route::post('siswa/delete/{id}', 'Admin\SiswaController@delete')->name('admin.siswa.delete');

    // Transaksi
    Route::get('transaksi', 'Admin\TransaksiController@index')->name('admin.transaksi.index');

    Route::get('transaksi/active/{id}', 'Admin\TransaksiController@active')->name('admin.transaksi.active');
    Route::get('transaksi/non-active/{id}', 'Admin\TransaksiController@nonActive')->name('admin.transaksi.non.active');

    Route::post('transaksi/global', 'Admin\TransaksiController@globalPost')->name('admin.transaksi.global');
    Route::post('transaksi/per-siswa', 'Admin\TransaksiController@addPostPerSiswa')->name('admin.transaksi.per.siswa');


    Route::get('transaksi/detail/{id}', 'Admin\TransaksiController@detail')->name('admin.transaksi.detail');
    Route::get('transaksi/detail/hapus/{id}', 'Admin\TransaksiController@hapus')->name('admin.transaksi.detail.hapus');
    Route::post('transaksi/detail/store/{id}', 'Admin\TransaksiController@storeDetail')->name('admin.transaksi.store.detail');

    // Laporan

    Route::get('/laporan','Admin\LaporanController@index')->name('admin.laporan.index');
    Route::get('/laporan/transaksi-detail/{id}','Admin\LaporanController@detail')->name('admin.laporan.detail');


});

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard','DashboardController@index')->name('siswa.dashboard.index');
    Route::get('transaksi','TransactionController@index')->name('siswa.transaksi.index');
    Route::post('siswa/bayar/{id}','TransactionController@siswaBayar')->name('siswa.bayar');


    Route::get('ganti-password','ChangePasswordController@index')->name('siswa.change.password.index');
    Route::post('ganti-password','ChangePasswordController@changePassword')->name('siswa.change.password.store');
});


Auth::routes([
    'register' => false,
]);

// Route::get('/home', 'HomeController@index')->name('home');
Route::post('midtrans/callback', 'MidtransController@notificationHandler');
Route::get('midtrans/finish', 'MidtransController@finishRedirect');
Route::get('midtrans/unfinish', 'MidtransController@unfinishRedirect');
Route::get('midtrans/error', 'MidtransController@errorRedirect');
