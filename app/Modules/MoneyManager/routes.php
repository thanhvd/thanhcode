<?php

Route::group(['prefix' => 'money-manager', 'namespace' => 'App\Modules\MoneyManager\Controllers', 'middleware' => ['web', 'auth'] ], function() {
    Route::resource('categories', 'CategoryController');
    Route::resource('payments', 'PaymentController');

    Route::get('treegrid-categories', 'CategoryController@getTreeGridData');
    Route::get('combotree-categories', 'CategoryController@getComboTreeData');
});
