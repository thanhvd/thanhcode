<?php

Route::group(['prefix' => 'money-manager', 'namespace' => 'App\Modules\MoneyManager\Controllers'], function() {
	Route::resource('categories', 'CategoryController');
});
