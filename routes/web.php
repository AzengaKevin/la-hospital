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

Route::get('/', fn () => view('welcome'))->name('home');

Route::get('register', 'Auth\RegistrationController@create')->name('register');
Route::post('register', 'Auth\RegistrationController@store')->name('register');
Route::get('login', 'Auth\AuthenticatedSessionController@create')->name('login');

