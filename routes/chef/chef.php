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

    Route::group(['prefix' => 'food-over'], function(){
        Route::get('{kitchen_id}', 'FoodOverController@index')->name('admin.chef.food-over');
        Route::patch('store-food-over/{kitchen_id}', 'FoodOverController@store')->name('admin.chef.food-over.store');
        Route::put('update-food-over/{food_over_id}', 'FoodOverController@update')->name('admin.chef.food-over.update');
        Route::delete('delete-food-over/{food_over_id}', 'FoodOverController@delete')->name('admin.chef.food-over.delete');
    });

    Route::group(['prefix' => 'dashboard'], function(){
        Route::get('meal', 'DashboardChefController@meal')->name('admin.chef.dashboard.meal');
        Route::get('food', 'DashboardChefController@food')->name('admin.chef.dashboard.food');
    });
});