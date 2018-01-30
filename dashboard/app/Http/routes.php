<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');

Route::get('admin', function () {
    return view('admin_template');
});

Route::auth();

Route::get('/home', 'HomeController@index');
Route::get('/logout', 'Auth\AuthController@logout');
Route::get('/linkloader','LinkLoaderController@index');
Route::get('/link/all',['as'=>'linksAjax','uses'=>'LinkLoaderController@anyData']);
Route::get('/click/all',['as'=>'clicksAjax','uses'=>'ClickViewerController@anyData']);
Route::get('/clickviewer','ClickViewerController@index');
Route::post('/uploadcsv',['as'=>'uploadcsv','uses'=>'UploadController@uploadCSV']);
Route::get('/getxls',['as'=>'getxls','uses'=>'ClickViewerController@exportToExcel']);
