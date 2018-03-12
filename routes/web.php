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

/*
|--------------------------------------------------------------------------
| Maintenance
|--------------------------------------------------------------------------
*/

Route::get('/','MaintenanceController@index'); 
Route::get('/index','MaintenanceController@index'); 
Route::get('/maintenance/operation','MaintenanceController@index'); 
Route::get('/maintenance/list-operating','MaintenanceController@index'); 
Route::get('/maintenance/list-monitoring','MaintenanceController@index');

/*
|--------------------------------------------------------------------------
| Assets
|--------------------------------------------------------------------------
*/

Route::get('/asset/create','AssetsController@index'); 


/*
|--------------------------------------------------------------------------
| Assets Apis
|--------------------------------------------------------------------------
*/

Route::get('/api/v1/assets','AssetsController@assets');
Route::get('/api/v1/assets/asset-categories','AssetsController@asset_categories');
Route::post('/api/v1/assets/save','AssetsController@save');