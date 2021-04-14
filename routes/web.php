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

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();
Route::get('/home','DashboardController@index')->name('home');
Route::get('/logout','HomeController@logout');
//MIDDLEWARE ADMIN DAN KASIR
Route::group(['middleware'=>['auth','checkRole:admin,kasir']],function(){ 

    Route::group(['prefix'=>'package'],function(){ 
        Route::get('/','PackageController@index');
        Route::post('/','PackageController@store');
        Route::get('/edit/{id}','PackageController@edit');
        Route::put('/{id}','PackageController@update');
        Route::get('/delete/{id}','PackageController@delete');
    });

    Route::group(['prefix'=>'outlet'],function(){ 
        Route::get('/','OutletController@index');
        Route::get('/edit/{id}','OutletController@edit');
        Route::post('/','OutletController@store')->name('outlet.store');
        Route::put('/update/{id}','OutletController@update');
        Route::get('delete/{id}','OutletController@delete');
    });

    Route::group(['prefix'=>'member'],function(){ 
        Route::get('/','MemberController@index');
        Route::post('/','MemberController@save');
        Route::get('/delete/{id}','MemberController@delete');
        Route::get('/edit/{id}','MemberController@edit');
        Route::put('/{id}','MemberController@update');
    });

    Route::group(['prefix'=>'transaction'],function(){ 
        Route::get('/','TransactionController@index');
        Route::post('/','TransactionController@create');
        Route::get('/edit/{id}','TransactionController@edit')->name('transaction.edit');
        Route::get('/getPricePackage/{id}','TransactionController@getPrice');
        Route::post('/update/{id}','TransactionController@update');
        Route::post('/save/{id}','TransactionController@save');
        Route::get('/cancel/{id}','TransactionController@cancelOrder');
        Route::get('/deleteItem/{id}','TransactionController@deleteItem');
        Route::get('/updateItem/{id}','TransactionController@updateItem');
        Route::post('/saveUpdate/{id}','TransactionController@saveUpdate');
        Route::get('/detailOrder/{id}','TransactionController@detailOrder');
        Route::get('/updateOrder/{id}','TransactionController@updateOrder');
        Route::post('/saveUpdateOrder/{id}','TransactionController@saveUpdateOrder');
        Route::get('/print/{id}','TransactionController@genarateTransaction');
    }); 

   

 });

Route::group(['middleware'=>['auth','checkRole:admin']],function(){

    Route::group(['prefix'=>'user'],function(){ 
        Route::get('/','HomeController@index');
        Route::get('/create','HomeController@create');
        Route::post('/','HomeController@save');
        Route::get('/edit/{id}','HomeController@edit');
        Route::put('/{id}','HomeController@update');
        Route::get('/delete/{id}','HomeController@delete');
       
    }); 

});

//  MIDDLEWARE ADMIN, KASIR, OWNER
 Route::group(['middleware'=>['auth','checkRole:admin,kasir,owner']],function(){  
    
    Route::get('/dashboard','DashboardController@index');
    Route::group(['prefix'=>'report'],function(){ 
        Route::get('/','HomeController@laporan');
        Route::post('/','HomeController@report');
     });
 });



