<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();

});

Route::group(['prefix'=>'v1','namespace'=>'Api' ],  function (){
    Route::group(['prefix'=>'client','namespace'=>'client' ],  function (){
        Route::post('register','authcontroller@register'); 
        Route::post('login','authcontroller@login'); 
        Route::post('resetpassword','authcontroller@resetpassword');
        Route::post('newpassword','authcontroller@newpassword');
        Route::post('help','authcontroller@help');
       
    Route::group(['middleware'=>'auth:api'],function(){
       
        Route::post('contacts','Maincontroller@contacts');
        Route::post('profile','authcontroller@profile');
        Route::post('registertoken','authcontroller@registertoken');
        Route::post('removetoken','authcontroller@removetoken');
        Route::post('neworder','Maincontroller@neworder');
        Route::post('myorder','Maincontroller@myorder');
        Route::post('showorder','Maincontroller@showorder');
        Route::post('declineorder','Maincontroller@declineorder');
        Route::post('confirmorder','Maincontroller@confirmorder');
        Route::post('changeState','Maincontroller@changeState');
      
        
     
    });   
    });

    Route::group(['prefix'=>'resturant','namespace'=>'resturant' ],  function (){
 
        Route::post('register','authcontroller@register'); 
        Route::post('login','authcontroller@login'); 
        Route::post('resetpassword','authcontroller@resetpassword');
        Route::post('newpassword','authcontroller@newpassword');
       
       
        
        Route::group(['middleware'=>'auth:resturant'],function(){
            Route::post('product','Maincontroller@product');
            Route::post('updateproduct','Maincontroller@updateproduct');
            Route::post('deleteproduct','Maincontroller@deleteproduct');
            Route::post('offer','Maincontroller@offer');
            Route::post('updateoffer','Maincontroller@updateoffer');
            Route::post('deleteoffer','Maincontroller@deleteoffer');
            Route::post('contacts','Maincontroller@contacts');
            Route::post('registertoken','authcontroller@registertoken');
            Route::post('removetoken','authcontroller@removetoken');
            Route::post('myorders','Maincontroller@myorders');
            Route::post('showorder','Maincontroller@showorder');
            Route::post('rejectorder','Maincontroller@rejectorder');
            Route::post('confirmorder','Maincontroller@confirmorder');
            Route::post('acceptorder','Maincontroller@acceptorder');
        });   
        });    

    Route::group(['prefix'=>'admin','namespace'=>'admin' ],  function (){
     
        Route::get('cities','Maincontroller@cities');
        Route::get('region','Maincontroller@region');
        Route::get('listproduct','Maincontroller@listproduct');
        Route::get('listoffer','Maincontroller@listoffer');
        Route::get('resturant','Maincontroller@resturant');
        Route::get('payment','Maincontroller@payment');
        Route::get('contact','Maincontroller@contact');
        Route::get('setting','Maincontroller@setting');
        Route::get('notification','Maincontroller@notification');
        Route::get('help','Maincontroller@help');
        
        
    });

});
