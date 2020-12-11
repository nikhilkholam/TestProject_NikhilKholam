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
    return view('auth.login');
});    

Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/contacts/dlist', 'ContactUsController@dlist');
Route::get('/contacts/shareList', 'ContactUsController@shareList');
Route::get('/contacts/userShare', 'ContactUsController@userShare');
Route::get('/contacts/{id}/downloadVCF', 'ContactUsController@downloadVCF');
Route::get('/contacts/{id}/showShareContact', 'ContactUsController@showShareContact');
Route::get('/contacts/{id}/deactivate', 'ContactUsController@deactivate');
Route::get('/contacts/{id}/activate', 'ContactUsController@activate');
Route::resource('/contacts', 'ContactUsController');
