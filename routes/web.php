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

Route::get('/', 'LandingController@index');

Route::get('foo', function () {
    return view('customer.test_search');
});

Route::get('blog/{slug}',['as' => 'blog', 'uses' => 'BlogController@show'])->where('slug', '[A-Za-z0-9-_]+');
Route::get('blog/category/{slug}',['as' => 'post', 'uses' => 'BlogController@showCategory'])->where('slug', '[A-Za-z0-9-_]+');
Route::get('blog/{cate}/{post}',['as' => 'post', 'uses' => 'BlogController@showWithCategory'])->where('cate', '[A-Za-z0-9-_]+')->where('post', '[A-Za-z0-9-_]+');
Route::get('pages/{url}',['as' => 'pages', 'uses' => 'PageController@show'])->where('url', '[A-Za-z0-9-_]+');
Route::get('di-cho-thu', 'CustomerController@dichothu');

Route::group(['middleware' => 'admin.user'], function () {


    Route::get('account/spices', 'SpicesController@index')->name('admin.spices.index');
    Route::delete('account/spices/delete/{id_food?}', 'SpicesController@delete')->name('admin.spices.delete');
    
    Route::get('account', 'CustomerController@index');
    

    Route::get('account', 'CustomerController@index')->name('dashboard.customer');

    Route::get('account/food', 'CustomerController@food');
    Route::get('account/orderhistory', 'CustomerController@orderHistory')->name('user.account.orderhistory');
    Route::get('account/transaction', 'CustomerController@transaction');
    Route::get('account/feedback', 'CustomerController@feedback')->name('admin.account.feedback');
    // Route::get('account/feedback', 'CustomerController@getFeedback')->name('admin.account.feedback');
    Route::post('account/feedback-create', 'CustomerController@storeFeedback')->name('admin.account.feedback.store');
    
    

    Route::group(['prefix' => 'meal-daily'], function () {
        Route::get('/', 'UserController@index')->name('admin.user.index');
        Route::get('/{id}/view', 'UserController@view')->name('admin.user.view');

        Route::get('/add', 'UserController@add')->name('admin.user.add');
        Route::post('/store', 'UserController@store')->name('admin.user.store');
        Route::get('/checkdate', 'UserController@checkDate')->name('admin.user.checkdate');

        Route::get('/{id}/edit', 'UserController@edit')->name('admin.user.edit');
        Route::post('/{id}/update', 'UserController@update')->name('admin.user.update');
        Route::get('/check-date-update', 'UserController@checkDateUpdate')->name('admin.user.check-date-update');

        Route::get('/{id}/double', 'UserController@double')->name('admin.user.double');

        Route::post('/delete/{id}', 'UserController@delete')->name('admin.user.delete');

        Route::get('/ajax_get_list_meal', 'UserController@getLisstMeal')->name('admin.user.ajax_get_list_meal');

    });
});




Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
    Route::group(['middleware' => 'admin.user'], function () {
        Route::group(['prefix' => 'kitchens'], function () {
            Route::get('/', 'KitchenController@index')->name('admin.kitchen.index');
            Route::get('/{id}/detail', 'KitchenController@detail')->name('admin.kitchen.detail');
            Route::get('/add/{id}', 'KitchenController@add')->name('admin.kitchens.addnew');
            Route::post('/store', 'KitchenController@store')->name('admin.kitchen.store');
            Route::get('/{id}/edit-kitchen', 'KitchenController@edit')->name('admin.kitchen.edit');
            Route::post('/update/{id}', 'KitchenController@update')->name('admin.kitchen.update');

            Route::post('/delete-kitchen/{id}', 'KitchenController@delete')->name('admin.kitchen.delete');

            Route::get('/{id}/user', 'KitchenController@user')->name('admin.kitchen.user');
            Route::post('/{id}/update-user', 'KitchenController@updateUser')->name('admin.kitchen.update-user');
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
    });
    
    Route::resource('foodcategory', 'FoodCategoryController', ['only' => [
        'index', 'create', 'edit', 'destroy', 'update', 'store'
    ]]);
    
    
    Route::resource('supplier', 'SupplierController', ['only' => [
        'index', 'create', 'edit', 'destroy', 'update', 'store'
    ]]);
    
    
    Route::resource('slide', 'SlideController', ['only' => [
        'index', 'create', 'edit', 'destroy', 'update', 'store'
    ]]);
    
    
    Route::resource('banner', 'BannerController', ['only' => [
        'index', 'create', 'edit', 'destroy', 'update', 'store'
    ]]);
    
    Route::resource('bannergroup', 'BannerGroupController', ['only' => [
        'index', 'create', 'edit', 'destroy', 'update', 'store'
    ]]);
    
    Route::resource('testimonial', 'TestimonialController', ['only' => [
        'index', 'create', 'edit', 'destroy', 'update', 'store'
    ]]);
    
});
