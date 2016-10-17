<?php

Route::group(['prefix' => 'api', 'namespace' => 'App\Modules\Api'/*, 'middleware' => ['api', 'auth:api']*/ ], function() {
    Route::group(['prefix' => 'money-manager', 'namespace' => 'MoneyManager\Controllers'], function() {
        Route::get('categories', 'CategoryController@index');
    });
    // Route::resource('categories', 'CategoryController');
    // Route::resource('payments', 'PaymentController');
});
