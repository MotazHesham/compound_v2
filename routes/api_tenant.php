<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'tenant','as' => 'api.', 'namespace' => 'Api\Tenant', 'middleware' => 'changelanguage'], function () { 

    Route::post('login','UserAuthApiController@login');  
    

    //reset password
    Route::post('forgetpassword', 'ForgetPasswordController@create_token');
    Route::post('forgetpassword/reset', 'ForgetPasswordController@reset');
    
    Route::group(['middleware' => ['auth:sanctum']],function () {

        // delete the token
        Route::delete('logout','UserAuthApiController@logout');  

        Route::post('fcm-token','UsersApiController@update_fcm_token'); 

        //home
        Route::get('sliders','HomeApiController@sliders');  
        Route::get('home/appointments','HomeApiController@appointments'); 
        Route::get('home/appointment-stats','HomeApiController@appointmentStats'); 

        //services
        Route::get('services','ServiceApiController@services'); 

        //appointments
        Route::group(['prefix' =>'appointments'],function(){
            Route::get('upcoming','AppointmentsApiController@upcoming');
            Route::get('completed','AppointmentsApiController@completed');
            Route::get('closed','AppointmentsApiController@closed');
            Route::post('get_token','AppointmentsApiController@get_token'); 
            Route::post('rate','AppointmentsApiController@rate'); 
            Route::post('add','AppointmentsApiController@add'); 
            Route::post('available_times','AppointmentsApiController@available_times');  
            Route::delete('cancel/{id}','AppointmentsApiController@cancel');
        }); 

        //appointment edit requests
        Route::get('appointment-edit-requests','AppointmentEditRequestsController@all');
        Route::post('appointment-edit-requests/add','AppointmentEditRequestsController@add');
        Route::get('appointment-edit-requests/delete/{id}','AppointmentEditRequestsController@delete');

        //contracts
        Route::get('contracts','ContractsController@all'); 

        //user profile
        Route::group(['prefix' =>'profile'],function(){
            Route::get('/','UsersApiController@profile'); 
            Route::post('update','UsersApiController@update_profile');  
        });
        
        //notifications
        Route::get('notifications','UsersApiController@notifications');
    });
});

