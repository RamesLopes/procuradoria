<?php

Route::group(['prefix' => '/tribunais'], function () {
    //INDEX
    Route::get('/', 'Tribunais@index')->name('tribunais.index');

    //Create and Store
    Route::get('/create', 'Tribunais@create')->name('tribunais.create');
    Route::post('/', 'Tribunais@store')->name('tribunais.store');

    //Detail
    Route::get('/detail', 'Tribunais@detail')->name('tribunais.detail');
});
