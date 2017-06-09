<?php

Route::group(['prefix' => 'chef'], function(){
    Route::get('/', 'ChefController@index')->name('admin.chef.index');
    Route::get('meal/{kitchen_id}', 'ChefController@dailyMeals')->name('admin.chef.meal.index');
});