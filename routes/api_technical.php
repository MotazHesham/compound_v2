<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'technical','as' => 'api.', 'namespace' => 'Api\Technical', 'middleware' => 'changelanguage'], function () { 

Route::post('login','UserAuthApiController@login');  


//reset password
Route::post('forgetpassword', 'ForgetPasswordController@create_token');
Route::post('forgetpassword/reset', 'ForgetPasswordController@reset');

Route::group(['middleware' => ['auth:sanctum']],function () {

    // delete the token
    Route::delete('logout','UserAuthApiController@logout');  

    Route::post('fcm-token','UsersApiController@update_fcm_token'); 

    //appointments
    Route::group(['prefix' =>'appointments'],function(){
        Route::get('/','AppointmentsApiController@appointments'); 
        Route::post('status','AppointmentsApiController@status'); 
        Route::get('covenants','AppointmentsApiController@covenants'); 
        Route::get('closed','AppointmentsApiController@closed'); 
        Route::get('open','AppointmentsApiController@open'); 
    });
    
    Route::post('add_part','AppointmentsApiController@add_part'); 

    //user profile
    Route::group(['prefix' =>'profile'],function(){
        Route::get('/','UsersApiController@profile'); 
        Route::post('update','UsersApiController@update_profile');  
    });
});
});