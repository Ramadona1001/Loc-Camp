<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/', 'HomeController@index')->name('home');

    Route::get('/users', 'UserController@index')->name('users');
    Route::get('/users/create', 'UserController@create')->name('create_users');
    Route::post('/users/store', 'UserController@store')->name('store_users');
    Route::get('/users/edit/{id}', 'UserController@edit')->name('edit_users');
    Route::get('/users/profile', 'UserController@profile')->name('profile_users');
    Route::post('/users/update/{id}', 'UserController@update')->name('update_users');
    Route::get('/users/show/{id}', 'UserController@show')->name('show_users');
    Route::get('/users/premissions/{id}', 'UserController@premissions')->name('premissions_users');
    Route::get('/users/assign-premissions/{id}', 'UserController@assignPremissions')->name('assign_premissions_users');
    Route::get('/users/delete/{id}', 'UserController@destroy')->name('destroy_users');
    Route::post('/users/logout', 'UserController@logout')->name('logout_users');
});
