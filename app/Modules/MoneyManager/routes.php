<?php

Route::group(['prefix' => 'money-manager', 'namespace' => 'App\Modules\MoneyManager\Controllers', 'middleware' => ['web', 'auth'] ], function() {
    Route::resource('categories', 'CategoryController');
    Route::resource('payments', 'PaymentController');
});
