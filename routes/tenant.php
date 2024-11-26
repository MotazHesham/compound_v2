<?php

use Illuminate\Support\Facades\Route; 

Route::group(['prefix' => 'tenant', 'as' => 'tenant.', 'namespace' => 'Tenant', 'middleware' => ['auth','tenant']], function () {

    Route::get('/', 'HomeController@index')->name('home');   

    // Contracts 
    Route::resource('contracts', 'ContractsController');

    // Appointments 
    Route::resource('appointments', 'AppointmentsController');  


    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
        // Change password 
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile'); 
    });
});
