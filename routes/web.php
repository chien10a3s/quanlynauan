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
    return view('customer.index');
});
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
    Route::group(['prefix' => 'kitchens'], function () {
        Route::get('/', 'KitchenController@index')->name('admin.kitchen.index');
        Route::get('/{id}/detail', 'KitchenController@detail')->name('admin.kitchen.detail');

        Route::get('/add', 'KitchenController@add')->name('admin.kitchen.add');
        Route::post('/store', 'KitchenController@store')->name('admin.kitchen.store');

        Route::get('/{id}/edit-kitchen', 'KitchenController@edit')->name('admin.kitchen.edit');
        Route::post('/update/{id}', 'KitchenController@update')->name('admin.kitchen.update');

        Route::post('/delete-kitchen/{id}', 'KitchenController@delete')->name('admin.kitchen.delete');

        Route::get('/{id}/user', 'KitchenController@user')->name('admin.kitchen.user');
        Route::post('/{id}/update-user', 'KitchenController@updateUser')->name('admin.kitchen.update-user');
    });
    Route::group(['prefix' => 'user'], function () {
        Route::get('/', 'UserController@index')->name('admin.user.index');
        Route::get('/{id}/detail', 'KitchenController@detail')->name('admin.kitchen.detail');

        Route::get('/add', 'KitchenController@add')->name('admin.kitchen.add');
        Route::post('/store', 'KitchenController@store')->name('admin.kitchen.store');

        Route::get('/{id}/edit', 'KitchenController@edit')->name('admin.kitchen.edit');
        Route::post('/update/{id}', 'KitchenController@update')->name('admin.kitchen.update');

        Route::post('/delete/{id}', 'KitchenController@delete')->name('admin.kitchen.delete');

        Route::get('/{id}/user', 'KitchenController@user')->name('admin.kitchen.user');
        Route::post('/{id}/update-user', 'KitchenController@updateUser')->name('admin.kitchen.update-user');
    });
});
