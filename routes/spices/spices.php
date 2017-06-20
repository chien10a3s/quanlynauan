<?php
/**
 * Created by PhpStorm.
 * User: danon
 * Date: 6/7/2017
 * Time: 6:33 AM
 */

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'spices'], function(){
    Route::get('/', 'SpicesController@index')->name('admin.spices.index');
    Route::delete('/delete/{id_food?}', 'SpicesController@delete')->name('admin.spices.delete');
});