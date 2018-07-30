<?php


Route::get('/', function () {
    return redirect()->route('deliveries.index');
});

Route::resource('/deliveries', 'DeliveryController');
