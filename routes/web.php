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
Route::get('/maintenance/new','MaintenanceController@index'); 
Route::get('/maintenance/operation','MaintenanceController@index'); 
Route::get('/maintenance/list-operating','MaintenanceController@index'); 
Route::get('/maintenance/list-monitoring','MaintenanceController@index');

/*
|--------------------------------------------------------------------------
| Maintenance APIs
|--------------------------------------------------------------------------
*/

Route::get('/api/v1/operations','Maintenance\OperationsController@operations'); 
Route::post('/api/v1/operation/save','Maintenance\OperationsController@save');
Route::post('/api/v1/operation/update','Maintenance\OperationsController@update');
Route::get('/api/v1/operations/assets-monitoring','Maintenance\OperationsController@assets_monitoring');

/*
|--------------------------------------------------------------------------
| Assets
|--------------------------------------------------------------------------
*/

Route::get('/asset/new','AssetsController@index'); 
Route::get('/asset/list-equipments','AssetsController@index'); 
Route::get('/asset/list-equipments/{asset_code}','AssetsController@index'); 
Route::get('/asset/more-details/{asset_code}','AssetsController@index'); 

// Route::get('/asset/sample_state_url','AssetsController@index'); 
// Route::get('/asset/sample_state_url/{id}','AssetsController@index'); 

/*
|--------------------------------------------------------------------------
| Assets Apis
|--------------------------------------------------------------------------
*/

Route::get('/api/v1/assets','AssetsController@assets'); 
Route::get('/api/v1/assets-by-name','AssetsController@assetsByName'); 
Route::post('/api/v1/assets/save','AssetsController@save');
Route::post('/api/v1/assets/asset-tag','AssetsController@asset_tag');
Route::get('/api/v1/assets/asset-categories','AssetsController@asset_categories');
Route::get('/api/v1/assets/methods','AssetsController@methods');

/*
|--------------------------------------------------------------------------
| Employees Apis
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Warranties Apis
|--------------------------------------------------------------------------
*/

Route::post('/api/v1/warranty/save','WarrantiesController@save');
Route::get('/api/v1/warranties','WarrantiesController@warranties'); 
// Route::post('/api/v1/warranty/update','WarrantiesController@update');

/*
|--------------------------------------------------------------------------
| Warranties Apis
|--------------------------------------------------------------------------
*/

Route::get('/employee/list','EmployeesController@index');

Route::post('/api/v1/employees/save','EmployeesController@save');
Route::post('/api/v1/employee/update','EmployeesController@update');
Route::get('/api/v1/employees','EmployeesController@employees');
Route::get('/api/v1/employees2','EmployeesController@employees2');

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
Route::get('/job-order/list/{jobOrderCode}','JobOrder\JobOrdersController@index');
Route::get('/job-order/new/{assetTag}','JobOrder\JobOrdersController@index');

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
Route::post('/api/v1/job-order/update','JobOrder\JobOrdersController@update');
Route::get('/api/v1/job-orders','JobOrder\JobOrdersController@job_orders');
// Route::get('/api/v1/sampleDate','JobOrder\JobOrdersController@sampleDate');

/*
|--------------------------------------------------------------------------
| Job Order Apis
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Requisition
|--------------------------------------------------------------------------
*/

Route::get('/requisition-issue-slip/new','Requisition\RequisitionsController@index');
// Route::get('/job-order/list','JobOrder\JobOrdersController@index');

/*
|--------------------------------------------------------------------------
| Requisition
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Requisition Apis
|--------------------------------------------------------------------------
*/

Route::post('/api/v1/requisition-issue-slip/save','Requisition\RequisitionsController@save'); 

/*
|--------------------------------------------------------------------------
| Requisition Apis
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| Address
|--------------------------------------------------------------------------
*/



/*
|--------------------------------------------------------------------------
| Address
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Address Apis
|--------------------------------------------------------------------------
*/

Route::get('/api/v1/regions','Address\RegionsController@region');
Route::get('/api/v1/provinces','Address\ProvincesController@province');
Route::get('/api/v1/municipalities','Address\MunicipalitiesController@municipality');

/*
|--------------------------------------------------------------------------
| Address Apis
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| Positions Apis
|--------------------------------------------------------------------------
*/

Route::get('/api/v1/positions','Employee\PositionsController@positions');

/*
|--------------------------------------------------------------------------
| Positions Apis
|--------------------------------------------------------------------------
*/

});