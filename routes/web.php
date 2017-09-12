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
})->name('index');
Route::get('home', function () {
    return view('article.create');
});
Route::any('/q','IndexController@request');

Route::get('g','IndexController@get');


Route::get('set','IndexController@setSession');
Route::get('get','IndexController@getSession');

Route::get('del','IndexController@delSession');

Route::get('setcookie','IndexController@setCookie');
Route::get('getcookie','IndexController@getCookie');

