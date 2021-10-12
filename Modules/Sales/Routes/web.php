<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web','auth']], function() {
    $namespace = "Sales\Controllers";
    Route::namespace($namespace)->group(function () {
        Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){
            Route::prefix("sales")->group(function () {
                Route::prefix("leads")->group(function () {
                    Route::get('/all', 'LeadsController@index')->name('leads');
                    Route::get('/create', 'LeadsController@create')->name('create_leads');
                    Route::post('/store', 'LeadsController@store')->name('store_leads');
                    Route::get('/show/{id}', 'LeadsController@show')->name('show_leads');
                    Route::get('/edit/{id}', 'LeadsController@edit')->name('edit_leads');
                    Route::post('/update/{id}', 'LeadsController@update')->name('update_leads');
                    Route::get('/delete/{id}', 'LeadsController@delete')->name('delete_leads');
                    Route::get('/search-domain', 'LeadsController@searchDomain')->name('search_lead_domain');
                    Route::get('/search-lead', 'LeadsController@searchLead')->name('search_lead');
                    Route::post('/add-follow', 'LeadsController@addFollow')->name('add_follow_lead');
                });
            });
        });
    });
});
