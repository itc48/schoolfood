<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QRController;

Route::get('qr-generate/{uid}', [QRController::class, 'qrcode']) ->name('qr-generate');

Route::group(['namespace' => 'App\Http\Controllers\Auth'], function () {

    Route::post('/login', 'LoginController');

    Route::post('/logout', 'LogoutController');

});


Route::group(['namespace' => 'App\Http\Controllers\Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'verify.admin']], function () {

    Route::post('/schools/import', 'SchoolController@import');

    Route::post('/districts/import', 'DistrictController@import');

    Route::resource('/schools', SchoolController::class)->except([
        'show'
    ]);

    Route::resource('/districts', DistrictController::class)->except([
        'show'
    ]);

    Route::resource('/users', UserController::class)->except([
        'show'
    ]);

    Route::get('/reviews', 'ReviewController@index');

    Route::get('/reviews/export', 'ReviewController@export');

    Route::get('/reviews/school_export', 'ReviewController@school_export'); /*!!!!!!!добавил для "скачать отчёт по школам"*/

    Route::get('/logins', 'UsersLoginController@index');

    Route::get('/logins/export', 'UsersLoginController@export');

    Route::get('/schools/export', 'SchoolController@export');

    Route::get('/schools/{uuid}/reviews', 'SchoolController@reviews');

    Route::get('/schools/{uuid}/trash', 'SchoolController@trash');

    Route::delete('/reviews/{uuid}', 'SchoolController@reviewDelete');

});

Route::group(['namespace' => 'App\Http\Controllers\Moderator', 'prefix' => 'moderator', 'middleware' => ['auth', 'verify.moderator']], function () {

    Route::resource('/schools', SchoolController::class)->except([
        'show', 'destroy'
    ]);

    Route::get('/schools/{uuid}/reviews', 'SchoolController@reviews');

    Route::get('/schools/{uuid}/qrcode', 'SchoolController@qrcode'); /*--тест новой страницы qr*/

    Route::get('/reviews', 'ReviewController@index');

    Route::get('/reviews/export', 'ReviewController@export');

    /*Route::get('/reviews/school_export', 'ReviewController@school_export'); /*!!!!!!!добавил для "скачать отчёт по школам"*/

});

Route::group(['namespace' => 'App\Http\Controllers\Schoolchildren', 'prefix' => 'schoolchildren', 'middleware' => ['auth', 'verify.schoolchildren']], function () {

    Route::resource('/schools', SchoolController::class)->only([
        'index', 'edit', 'update'
    ]);

    Route::get('/schools/{uuid}/reviews', 'SchoolController@reviews');

});

Route::group(['namespace' => 'App\Http\Controllers'], function () {

    Route::get('/', 'SiteController@main')->name('main');

    Route::get('/login', 'SiteController@login')->name('login');

    Route::get('/{any}', 'SiteController@index')->where('any', '.*');

});
