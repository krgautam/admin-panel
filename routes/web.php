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
/*
Route::get('/', function () {
    return view('welcome');
});
*/
Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/users', 'UserController@index')->name('users.index');
Route::get('/user/{id}/edit','UserController@edit')->name('users.edit');
Route::get('/user/{id}/delete','UserController@destroy')->name('users.destroy');
Route::get('/user/create','UserController@create')->name('users.create');
Route::post('/user/create','UserController@store')->name('users.store');
Route::post('/user/update','UserController@update')->name('users.update');
Route::post('uploadimage', 'HomeController@upload_image')->name('uploadimage');
