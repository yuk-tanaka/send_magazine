<?php
Route::group(['middleware' => 'auth.very_basic'], function () {
    Route::post('/wysiwyg', 'UploadWysiwygImageController@upload');
    Route::post('/import', 'SendMagazineController@importCsv');
    Route::post('/send', 'SendMagazineController@send');
    Route::get('/footer', 'SendMagazineController@footer');
    Route::get('/rule', 'SendMagazineController@rule');
    Route::get('/logs', 'MagazineLogController@get');
});
