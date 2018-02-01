<?php

use Illuminate\Support\Facades\Session;
Blade::setContentTags('<%', '%>');
Blade::setEscapedContentTags('<%%', '%%>');
Blade::setRawTags('[[', ']]');
Route::get('/', function () {
    if (Auth()->check()) {
        return redirect('/welcome');
    } else {
        return redirect('/about');
    }
});

Route::group(['middleware' => ['auth']], function () {
    Route::post('/fetch', 'TaskController@Listing');
    Route::post('/pagination', 'TaskController@Listing');
    Route::delete('/delete-task/{id}', 'TaskController@destroy');
    Route::get('/showing/{id}{note}', 'TaskController@show');
    Route::get('/editing/{id}{status}', 'TaskController@show');
    Route::post('/up/{id}', 'TaskController@upToDate');
    Route::post('/updateStatus/{id}', 'TaskController@upToDate');
    Route::post('/create-task', 'TaskController@store');
    Route::get('/user', 'TaskController@index');
    Route::get('/out','TaskController@modify');
    Route::get('/welcome','TaskController@visible');
    Route::delete('/delete-all/{id}', 'TaskController@deleteAll');
 });
// Route::group(['middleware' => ['guest']], function () {
Route::get('/about','TaskController@allow');
Route::post('/sign', 'TaskController@create');
Route::post('/log', 'TaskController@check');
Route::post('/signout', 'TaskController@logout');
Route::get('/forget-password', function () {
        return view('/forget_password');
    });
Route::post('/reset-password', 'TaskController@send');
Route::get('/newpassword', function () {
        return view('/newpassword');
    });
Route::post('/new-password', 'TaskController@latest');
// });
//Route::get('/greeting', function()
// {
//     return View::make('greeting',$task);
