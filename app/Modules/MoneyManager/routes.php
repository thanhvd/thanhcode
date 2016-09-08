<?php

Route::group(['prefix' => 'money-manager', 'namespace' => 'App\Modules\MoneyManager\Controllers', 'middleware' => 'web'], function() {
	Route::resource('categories', 'CategoryController');
});
