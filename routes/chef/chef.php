<?php
/**
 * Created by PhpStorm.
 * User: danon
 * Date: 6/7/2017
 * Time: 6:33 AM
 */

Route::group(['prefix' => 'chefs'], function(){
    Route::get('/', 'ChefController@index')->name('admin.chef.index');
    Route::get('meal/{kitchen_id}', 'ChefController@dailyMeals')->name('admin.chef.meal');
    Route::get('ajax-meal/{kitchen_id}', 'ChefController@ajaxMeals')->name('admin.chef.meal.ajax');
    Route::put('update-money/{daily_meal_id}', 'ChefController@updateMoneyChef')->name('admin.chef.meal.update');
    Route::get('feedback/{kitchen_id}', 'ChefController@getFeedback')->name('admin.chef.feedback');
    Route::post('feedback-create', 'ChefController@storeFeedback')->name('admin.chef.feedback.store');
    Route::get('spice/{kitchen_id}', 'ChefController@spice')->name('admin.chef.spice');
});