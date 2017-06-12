<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/account', function () {
    return view('customer.index');
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
    Route::group(['prefix' => 'kitchens'], function () {
        Route::get('/', 'KitchenController@index')->name('admin.kitchen.index');
        Route::get('/{id}/detail', 'KitchenController@detail')->name('admin.kitchen.detail');

        Route::get('/add', 'KitchenController@add')->name('admin.kitchens.addnew');
        Route::post('/store', 'KitchenController@store')->name('admin.kitchen.store');

        Route::get('/{id}/edit-kitchen', 'KitchenController@edit')->name('admin.kitchen.edit');
        Route::post('/update/{id}', 'KitchenController@update')->name('admin.kitchen.update');

        Route::post('/delete-kitchen/{id}', 'KitchenController@delete')->name('admin.kitchen.delete');

        Route::get('/{id}/user', 'KitchenController@user')->name('admin.kitchen.user');
        Route::post('/{id}/update-user', 'KitchenController@updateUser')->name('admin.kitchen.update-user');
    });
    Route::group(['prefix' => 'meal-daily'], function () {
        Route::get('/add', 'UserController@add')->name('admin.user.add');
        Route::post('/store', 'UserController@store')->name('admin.user.store');

    });
    
    Route::group(['prefix' => 'food'], function () {
        Route::get('/', 'FoodController@index')->name('admin.food.index');
        Route::get('/add', 'FoodController@add')->name('admin.food.add');
        Route::post('/store', 'FoodController@store')->name('admin.food.store');
        Route::get('/edit/{food_id}', 'FoodController@edit')->name('admin.food.edit');
        Route::post('/update/{food_id}', 'FoodController@update')->name('admin.food.update');
        Route::get('/duplicate/{food_id}', 'FoodController@duplicate')->name('admin.food.duplicate');
        Route::get('/delete/{food_id}', 'FoodController@delete')->name('admin.food.delete');
    });
<<<<<<< HEAD
    
    Route::resource('supplier', 'SupplierController', ['only' => [
        'index', 'create', 'edit', 'destroy', 'update', 'store'
    ]]);

    
=======
    require(__DIR__.'/chef/chef.php');
>>>>>>> d582b8b4bafef539f82d584ebe88a677151e4c9a
});
