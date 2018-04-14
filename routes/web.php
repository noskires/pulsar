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

Route::post('/api/v1/operation/save','Maintenance\OperationsController@save');
Route::post('/api/v1/operation/update','Maintenance\OperationsController@update');

Route::get('/api/v1/operations','Maintenance\OperationsController@operations'); 
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

/*
|--------------------------------------------------------------------------
| Assets Apis
|--------------------------------------------------------------------------
*/

Route::post('/api/v1/assets/save','AssetsController@save');
Route::post('/api/v1/assets/asset-tag','AssetsController@asset_tag');

Route::get('/api/v1/assets','AssetsController@assets'); 
Route::get('/api/v1/assets-by-name','AssetsController@assetsByName'); 
Route::get('/api/v1/assets/asset-categories','AssetsController@asset_categories');
Route::get('/api/v1/assets/methods','AssetsController@methods');

/*
|--------------------------------------------------------------------------
| Warranties Apis
|--------------------------------------------------------------------------
*/

Route::post('/api/v1/warranty/save','WarrantiesController@save');
Route::get('/api/v1/warranties','WarrantiesController@warranties'); 

/*
|--------------------------------------------------------------------------
| Warranties Apis
|--------------------------------------------------------------------------
*/

Route::post('/api/v1/employees/save','EmployeesController@save');
Route::post('/api/v1/employee/update','EmployeesController@update');

Route::get('/employee/list','EmployeesController@index');
Route::get('/api/v1/employees','EmployeesController@employees');
Route::get('/api/v1/employees2','EmployeesController@employees2');


/*
|--------------------------------------------------------------------------
| Organizations
|--------------------------------------------------------------------------
*/

Route::get('/organization','Organization\DepartmentsController@index'); 
Route::get('/organization/department/new','Organization\DepartmentsController@index'); 
Route::get('/organization/division/new','Organization\DepartmentsController@index'); 
Route::get('/organization/unit/new','Organization\DepartmentsController@index'); 

/*
|--------------------------------------------------------------------------
| Organizations Apis
|--------------------------------------------------------------------------
*/

//department
Route::post('/api/v1/organization/department/save','Organization\DepartmentsController@save');
Route::post('/api/v1/organization/department/update','Organization\DepartmentsController@update');

Route::get('/api/v1/organization/departments','Organization\DepartmentsController@departments');

//division
Route::post('/api/v1/organization/division/save','Organization\DivisionsController@save');
Route::post('/api/v1/organization/division/update','Organization\DivisionsController@update');

//unit
Route::post('/api/v1/organization/unit/save','Organization\UnitsController@save');
Route::post('/api/v1/organization/unit/update','Organization\UnitsController@update');

Route::get('/api/v1/organization/departments','Organization\DepartmentsController@departments');

//mother org
Route::get('/api/v1/organizations','Organization\OrganizationsController@organizations');
// Route::get('/api/v1/organization/departments','Organization\DepartmentsController@departments');

/*
|--------------------------------------------------------------------------
| Projects
|--------------------------------------------------------------------------
*/

Route::get('/project/new','Project\ProjectsController@index');
Route::get('/projects/list','Project\ProjectsController@index');
Route::get('/projects/list/{projectCode}','Project\ProjectsController@index');

/*
|--------------------------------------------------------------------------
| Project Apis
|--------------------------------------------------------------------------
*/

Route::post('/api/v1/projects/save','Project\ProjectsController@save');

Route::get('/api/v1/projects','Project\ProjectsController@projects');

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
| Job Order Apis
|--------------------------------------------------------------------------
*/

Route::post('/api/v1/job-order/save','JobOrder\JobOrdersController@save');
Route::post('/api/v1/job-order/update','JobOrder\JobOrdersController@update');

Route::get('/api/v1/job-orders','JobOrder\JobOrdersController@job_orders');

/*
|--------------------------------------------------------------------------
| Requisition
|--------------------------------------------------------------------------
*/

Route::get('/requisition/list','Requisition\RequisitionsController@index');
Route::get('/requisition-issue-slip/new','Requisition\RequisitionsController@index');
Route::get('/api/v1/requisitions','Requisition\RequisitionsController@requisitions');

/*
|--------------------------------------------------------------------------
| Requisition Apis
|--------------------------------------------------------------------------
*/

Route::post('/api/v1/requisition-issue-slip/asset/save','Requisition\RequisitionsController@save_asset'); 
Route::post('/api/v1/requisition-issue-slip/project/save','Requisition\RequisitionsController@save_project'); 

Route::get('/requisition-issue-slip/asset/new/{jobOrderCode}','Requisition\RequisitionsController@index');
Route::get('/requisition-issue-slip/project/new/{jobOrderCode}','Requisition\RequisitionsController@index');

/*
|--------------------------------------------------------------------------
| Receipts
|--------------------------------------------------------------------------
*/

Route::get('/receipt/new','Receipt\ReceiptsController@index');
Route::get('/receipt/list','Receipt\ReceiptsController@index');
Route::get('/receipt/list/{receiptCode}','Receipt\ReceiptsController@index');

/*
|--------------------------------------------------------------------------
| Receipts Apis
|--------------------------------------------------------------------------
*/

Route::post('/api/v1/receipt/save','Receipt\ReceiptsController@save'); 
Route::post('/api/v1/receipt-items/save','Receipt\ReceiptsController@save_receipt_items'); 
Route::get('/api/v1/receipts','Receipt\ReceiptsController@receipts');
Route::get('/api/v1/receipt-items','Receipt\ReceiptsController@receiptItems');

/*
|--------------------------------------------------------------------------
| Supplies
|--------------------------------------------------------------------------
*/

Route::get('/supply/new','Supply\SuppliesController@index');
Route::get('/supply/list','Supply\SuppliesController@index');
Route::get('/supply/list/{supplyCode}','Supply\SuppliesController@index');

/*
|--------------------------------------------------------------------------
| Supplies Apis
|--------------------------------------------------------------------------
*/

Route::post('/api/v1/supply/save','Supply\SuppliesController@save'); 
Route::get('/api/v1/supplies','Supply\SuppliesController@supplies');

/*
|--------------------------------------------------------------------------
| Supplies Apis
|--------------------------------------------------------------------------
*/

Route::get('/api/v1/stock-units','Supply\StockUnitsController@stock_units');

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
| Positions Apis
|--------------------------------------------------------------------------
*/

Route::get('/api/v1/positions','Employee\PositionsController@positions');


});