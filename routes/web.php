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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => 'auth', 'namespace' => 'Admin'], function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');

    Route::group(['prefix' => 'posts'], function () {
        Route::get('/', 'PostController@index')->name('post.index');
        Route::get('/create', 'PostController@create')->name('post.create');
        Route::post('/', 'PostController@store')->name('post.store');

        Route::group(['prefix' => '{post}'], function () {
            Route::get('/', 'PostController@show')->name('post.show');
            Route::get('/edit', 'PostController@edit')->name('post.edit');
            Route::patch('/', 'PostController@update')->name('post.update');
            Route::get('/delete', 'PostController@delete')->name('post.delete');
            Route::delete('/', 'PostController@destory')->name('post.destory');
        });

    });
});
