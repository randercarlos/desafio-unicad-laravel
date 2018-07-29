<?php


Route::get('/', function () {
    return redirect()->route('militares.index');
});

Route::resource('/militares', 'MilitarController');
