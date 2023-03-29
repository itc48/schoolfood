<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'App\Http\Controllers\Api'], function () {
    Route::get('/schools/{uuid}', 'SchoolController@show');
    Route::get('/qr-code/{uuid}', 'SchoolController@qrCode');
    Route::post('/schools/{uuid}/review', 'ReviewController@store');

    Route::group(['prefix' => 'dashboards', 'middleware' => ['verify.dashboard']], function () {
        Route::get('/schools', 'DashboardController@schools');

        Route::get('/everyday-count', 'DashboardController@everydayCount');
        Route::get('/everyday-negative-count', 'DashboardController@everydayNegativeCount');
        Route::get('/schools-positive-count', 'DashboardController@schoolPositiveCount');
        Route::get('/schools-count', 'DashboardController@schoolsCount');
        Route::get('/schools-summary-count', 'DashboardController@schoolsSummaryCount');
        Route::get('/everyday-positive-negative-count', 'DashboardController@everydayPositiveNegativeCount');
        Route::get('/schools-positive-negative-count', 'DashboardController@schoolsPositiveNegativeCount');
    });
});