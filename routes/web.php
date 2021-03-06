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

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
| 
| Authentication and registration routes
|
*/

Route::get('register', 'Auth\RegistrationController@create')->name('register');
Route::post('register', 'Auth\RegistrationController@store')->name('register');

Route::get('login', 'Auth\AuthenticatedSessionController@create')->name('login');
Route::post('login', 'Auth\AuthenticatedSessionController@store')->name('login');
Route::post('logout', 'Auth\AuthenticatedSessionController@destroy')->name('logout');

/*
|--------------------------------------------------------------------------
| Pages Routes
|--------------------------------------------------------------------------
| 
| Frontend static pages routes
|
*/
Route::get('about', 'PagesController@about')->name('about');
Route::get('contact', 'PagesController@contact')->name('contact');
Route::resource('doctors', 'DoctorController')
    ->only('index', 'show');
Route::resource('requests', 'RequestController');

Route::group(['middleware' => ['auth', 'can:act-as-a-doctor'], 'prefix' => 'doctor', 'as' => 'doctor.', 'namespace' => 'Doctor'], function () {
    Route::resource('requests', 'RequestsController')
        ->except('create', 'store');
    Route::resource('requests.responses', 'RequestResponseController');
});

Route::resource('contacts', 'ContactController')
    ->only('store');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin'], function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard');
    Route::resource('contacts', 'ContactController')
        ->only('index', 'show', 'destroy');
    Route::resource('doctors', 'DoctorController')
        ->only('index', 'update');
});
