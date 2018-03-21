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
| Custom Login
|--------------------------------------------------------------------------
*/

Auth::routes();
Route::post('/auth', ['uses'=>'LoginController@login', 'as'=>'auth']); 
Route::get('/home','HomeController@index');

Route::group(['middleware'=>'auth'], function(){

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
| Maintenance
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Assets
|--------------------------------------------------------------------------
*/

Route::get('/asset/create','AssetsController@index'); 
Route::get('/asset/list-equipments','AssetsController@index'); 
Route::get('/asset/list-equipments/{asset_code}','AssetsController@index'); 

Route::get('/asset/sample_state_url','AssetsController@index'); 
Route::get('/asset/sample_state_url/{id}','AssetsController@index'); 

/*
|--------------------------------------------------------------------------
| Assets Apis
|--------------------------------------------------------------------------
*/

Route::get('/api/v1/assets','AssetsController@assets'); 
Route::post('/api/v1/assets/save','AssetsController@save');
Route::post('/api/v1/assets/asset-tag','AssetsController@asset_tag');
Route::get('/api/v1/assets/asset-categories','AssetsController@asset_categories');
Route::get('/api/v1/assets/methods','AssetsController@methods');

/*
|--------------------------------------------------------------------------
| Employees Apis
|--------------------------------------------------------------------------
*/

Route::get('/api/v1/employees','EmployeesController@employees');

/*
|--------------------------------------------------------------------------
| Organizations Apis
|--------------------------------------------------------------------------
*/

Route::get('/api/v1/organizations','OrganizationsController@organizations');

/*
|--------------------------------------------------------------------------
| Projects
|--------------------------------------------------------------------------
*/

Route::get('/project/new','Project\ProjectsController@index');
Route::get('/projects/list','Project\ProjectsController@index');

/*
|--------------------------------------------------------------------------
| Projects
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Project Apis
|--------------------------------------------------------------------------
*/

Route::post('/api/v1/projects/save','Project\ProjectsController@save');
Route::get('/api/v1/projects','Project\ProjectsController@projects');

/*
|--------------------------------------------------------------------------
| Project Apis
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Job Order
|--------------------------------------------------------------------------
*/

Route::get('/job-order/new','JobOrder\JobOrdersController@index');
Route::get('/job-order/list','JobOrder\JobOrdersController@index');

/*
|--------------------------------------------------------------------------
| Job Order
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Job Order Apis
|--------------------------------------------------------------------------
*/

Route::post('/api/v1/job-order/save','JobOrder\JobOrdersController@save');
Route::get('/api/v1/job-orders','JobOrder\JobOrdersController@job_orders');
Route::get('/api/v1/sampleDate','JobOrder\JobOrdersController@sampleDate');

/*
|--------------------------------------------------------------------------
| Job Order Apis
|--------------------------------------------------------------------------
*/

});