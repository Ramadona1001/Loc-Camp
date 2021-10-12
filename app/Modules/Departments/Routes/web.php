<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web','auth']], function() {
    $namespace = "Departments\Controllers";
    Route::namespace($namespace)->group(function () {
        Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){
            Route::prefix("backend/departments")->group(function () {
                Route::get('/all', 'DepartmentsController@index')->name('departments');
                Route::get('/create', 'DepartmentsController@create')->name('create_departments');
                Route::post('/store', 'DepartmentsController@store')->name('store_departments');
                Route::get('/show/{id}', 'DepartmentsController@show')->name('show_departments');
                Route::get('/edit/{id}', 'DepartmentsController@edit')->name('edit_departments');
                Route::post('/update/{id}', 'DepartmentsController@update')->name('update_departments');
                Route::get('/delete/{id}', 'DepartmentsController@delete')->name('delete_departments');
                Route::post('/assign-managers/{id}', 'DepartmentsController@assignManagers')->name('assign_departments_managers');
            });
        });
    });
});
