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

Route::get('/dashboard', function () {
        return view('index');
});

Route::get('/', 'otentikasi\OtentikasiController@index')->name('loginpage');
Route::post('login', 'otentikasi\OtentikasiController@login')->name('login');
Route::get('logout', 'otentikasi\OtentikasiController@logout')->name('logout');

Route::get('crud', 'CrudController@index')->name('crud')->middleware('CekLoginMiddleware');
Route::get('crud/tambah', 'CrudController@tambah')->name('crud.tambah')->middleware('CekLoginMiddleware');
Route::post('crud/simpan', 'CrudController@simpan')->name('crud.simpan')->middleware('CekLoginMiddleware');
Route::delete('crud/delete/{id}', 'CrudController@delete')->name('crud.delete')->middleware('CekLoginMiddleware');
Route::get('crud/{id}/edit', 'CrudController@edit')->name('crud.edit')->middleware('CekLoginMiddleware');
Route::patch('crud/{id}', 'CrudController@update')->name('crud.update')->middleware('CekLoginMiddleware');

