<?php

Route::group([
    'middleware' => ["web", "admin"],
    "prefix" => "admin/products",
],
    function () {
        Route::prefix('blog')->group(function () {
            Route::get('/', 'BlogController@index')->name("get.blog.index");
            Route::get('create', 'BlogController@create')->name("get.blog.create");
            Route::post('store', 'BlogController@store')->name("post.blog.store");
            Route::get('edit/{id}', 'BlogController@edit')->name("get.blog.edit");
            Route::post('update', 'BlogController@update')->name("post.blog.update");
            Route::post('delete', 'BlogController@delete')->name("post.blog.delete");
        });

        Route::prefix('blog-categories')->group(function () {
            Route::get('/', 'BlogCattegoriesController@index')->name("get.blog_categories.index");
            Route::get('create', 'BlogCattegoriesController@create')->name("get.blog_categories.create");
            Route::post('store', 'BlogCattegoriesController@store')->name("post.blog_categories.store");
            Route::get('edit/{id}', 'BlogCattegoriesController@edit')->name("get.blog_categories.edit");
            Route::post('update', 'BlogCattegoriesController@update')->name("post.blog_categories.update");
        });
        Route::prefix('categories')->group(function () {
            Route::get('/', 'CategoriesController@index')->name("get.categories.index");
            Route::get('create', 'CategoriesController@create')->name("get.categories.create");
            Route::post('store', 'CategoriesController@store')->name("post.categories.store");
            Route::get('edit/{id}', 'CategoriesController@edit')->name("get.categories.edit");
            Route::post('update', 'CategoriesController@update')->name("post.categories.update");
            Route::post('delete', 'CategoriesController@delete')->name("post.categories.delete");
        });

        Route::prefix('products')->group(function () {
            Route::get('/', 'ProductController@index')->name("get.products.index");
            Route::get('create', 'ProductController@create')->name("get.products.create");
            Route::post('store', 'ProductController@store')->name("post.products.store");
            Route::get('edit/{id}', 'ProductController@edit')->name("get.products.edit");
            Route::post('update', 'ProductController@update')->name("post.products.update");
            Route::post('delete', 'ProductController@delete')->name("post.products.delete");
        });
        Route::prefix('orders')->group(function () {
            Route::get('/', 'OrderController@index')->name("get.orders.index");
            Route::post('update', 'OrderController@update')->name("post.orders.update");
            Route::get ('detail/{id}', 'OrderController@detail')->name("get.orders.detail");
            Route::get ('downloadPDF/{id}', 'OrderController@downloadPDF')->name("get.orders.downloadPDF");
        });

        Route::prefix('contacts')->group(function () {
            Route::get('/', 'ContactController@index')->name("get.contacts.index");
        });

        Route::prefix('info')->group(function () {
            Route::get('/', 'InfoController@index')->name("get.info.index");
            Route::post('update', 'InfoController@update')->name("post.info.update");
        });
});

Route::prefix('blog')->group(function () {
    Route::get('/', 'BlogController@search')->name("get.blog.search");
    Route::get('detail/{slug}.html', 'BlogController@detail')->name("get.blog.detail");
});