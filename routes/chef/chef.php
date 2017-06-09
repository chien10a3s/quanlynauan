<?php
/**
 * Created by PhpStorm.
 * User: danon
 * Date: 6/7/2017
 * Time: 6:33 AM
 */

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'chef'], function(){
    Route::get('/', 'ChefController@index')->name('admin.chef.index');
    Route::get('meal/{kitchen_id}', 'ChefController@dailyMeals')->name('admin.chef.meal.index');
});