<?php

Route::group(['middleware' => 'auth.very_basic'], function () {
    Route::get('/', 'DashboardController@index')->name('index');
    Route::get('/logs', 'LogController@index')->name('log.index');
});