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

// Route::get('/home','HomeController@index');

Route::get('/info','LoginController@phpinfo');

Route::group(['middleware'=>'auth'], function(){

//testing angular table
// Route::get('/angular-datatables','MaintenanceController@index'); 
// Route::get('/angular-datatables/new','MaintenanceController@index'); 


Route::get('/pdf', 'PdfController@index');
Route::get('/export/{assetTag}', 'PdfController@export');


Route::post('upload', 'UploadController@upload');

/*
|--------------------------------------------------------------------------
| Maintenance
|--------------------------------------------------------------------------
*/

Route::get('','MaintenanceController@index');
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
Route::get('/asset/more-details4/{asset_code}','AssetsController@index'); 

Route::get('/asset-category/new','Asset\AssetCategoriesController@index');
Route::get('/asset-categories/list','Asset\AssetCategoriesController@index');
Route::get('/asset-category/list/{assetCategoryCode}','Asset\AssetCategoriesController@index');

/*
|--------------------------------------------------------------------------
| Assets Apis
|--------------------------------------------------------------------------
*/

Route::post('/api/v1/assets/save','AssetsController@save');
Route::post('/api/v1/assets/saveAssetEvent','AssetsController@saveAssetEvent');
Route::post('/api/v1/assets/update','AssetsController@update');
Route::post('/api/v1/assets/update-asset','AssetsController@updateAsset');
Route::post('/api/v1/assets/asset-tag','AssetsController@asset_tag');

Route::get('/api/v1/assets','AssetsController@assets'); 
Route::get('/api/v1/assetEvents','AssetsController@asset_events'); 

Route::get('/api/v1/assets-by-name','AssetsController@assetsByName'); 
Route::get('/api/v1/assets/asset-categories','AssetsController@asset_categories');
Route::get('/api/v1/assets/methods','AssetsController@methods');

Route::get('/api/v1/assets-photos','AssetPhotosController@assetPhotos'); 

Route::get('/api/v1/asset-categories','Asset\AssetCategoriesController@assetCategories');
Route::post('/api/v1/asset-category/save','Asset\AssetCategoriesController@save'); 
Route::post('/api/v1/asset-category/update','Asset\AssetCategoriesController@update'); 

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
Route::get('/employee/new','EmployeesController@index');
Route::get('/api/v1/employees','EmployeesController@employees');
Route::get('/api/v1/employees2','EmployeesController@employees2');


/*
|--------------------------------------------------------------------------
| Organizations
|--------------------------------------------------------------------------
*/

Route::get('/organizations','Organization\DepartmentsController@index'); 
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
Route::get('/api/v1/organization/divisions','Organization\DivisionsController@divisions');

//unit
Route::post('/api/v1/organization/unit/save','Organization\UnitsController@save');
Route::post('/api/v1/organization/unit/update','Organization\UnitsController@update');
Route::get('/api/v1/organization/units','Organization\UnitsController@units');


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
Route::get('/job-order/report/{jobOrderCode}', 'JobOrder\JobOrderReportController@export');

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

Route::post('/api/v1/requisition-slip-items/save','Requisition\RequisitionsController@save_requisition_slip_items'); 
Route::post('/api/v1/requisition-slip-items/delete','Requisition\RequisitionsController@remove_requisition_slip_items'); 
Route::get('/api/v1/requisition-slip-items','Requisition\RequisitionsController@requisitionSlipItems');

Route::get('/requisition/list','Requisition\RequisitionsController@index');
Route::get('/requisition/list/{requisitionCode}','Requisition\RequisitionsController@index');
Route::get('/requisition-issue-slip/new','Requisition\RequisitionsController@index');

Route::get('/api/v1/requisitions','Requisition\RequisitionsController@requisitions'); 
Route::post('/api/v1/requisitions/update','Requisition\RequisitionsController@update'); 

Route::get('/requisition/report/{requisitionCode}', 'Requisition\RequisitionReportController@export');

Route::get('/requisition-issue-slip/office/new','Requisition\RequisitionsController@index');
/*
|--------------------------------------------------------------------------
| Requisition Apis
|--------------------------------------------------------------------------
*/

Route::post('/api/v1/requisition-issue-slip/asset/save','Requisition\RequisitionsController@save_asset'); 
Route::post('/api/v1/requisition-issue-slip/project/save','Requisition\RequisitionsController@save_project'); 

Route::get('/requisition-issue-slip/asset/new/{jobOrderCode}','Requisition\RequisitionsController@index');
Route::get('/requisition-issue-slip/project/new/{jobOrderCode}','Requisition\RequisitionsController@index');

Route::post('/api/v1/requisition-issue-slip/office/save','Requisition\RequisitionsController@save_office'); 
Route::post('/api/v1/requisition-issue-slip/office/update','Requisition\RequisitionsController@update_office'); 
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
Route::get('/api/v1/receipts','Receipt\ReceiptsController@receipts');

Route::get('/api/v1/receipt-items','Receipt\ReceiptsController@receiptItems');
Route::get('/api/v1/receipt-types','Receipt\ReceiptsController@receipt_types');

Route::post('/api/v1/receipt-items/save','Receipt\ReceiptsController@save_receipt_items'); 
Route::post('/api/v1/receipt-items/delete','Receipt\ReceiptsController@delete_receipt_items'); 

/*
|--------------------------------------------------------------------------
| Vouchers
|--------------------------------------------------------------------------
*/

Route::get('/voucher/new','Voucher\VouchersController@index');
Route::get('/voucher/list','Voucher\VouchersController@index');
Route::get('/voucher/list/{voucherCode}','Voucher\VouchersController@index');

/*
|--------------------------------------------------------------------------
| Vouchers Apis
|--------------------------------------------------------------------------
*/

Route::post('/api/v1/voucher/save','Voucher\VouchersController@save');
Route::post('/api/v1/voucher-items/save','Voucher\VouchersController@save_voucher_items'); 
Route::post('/api/v1/voucher/update','Voucher\VouchersController@update');

Route::get('/api/v1/vouchers','Voucher\VouchersController@vouchers');
Route::get('/api/v1/voucher-items','Voucher\VouchersController@voucher_items');

Route::get('/api/v1/sample-voucher','Voucher\VouchersController@sample');

/*
|--------------------------------------------------------------------------
| Particulars
|--------------------------------------------------------------------------
*/

// Route::get('/voucher/new','Voucher\VouchersController@index');
// Route::get('/voucher/list','Voucher\VouchersController@index');
// Route::get('/voucher/list/{voucherCode}','Voucher\VouchersController@index');

/*
|--------------------------------------------------------------------------
| Particulars Apis
|--------------------------------------------------------------------------
*/

Route::post('/api/v1/particular/save','Voucher\ParticularsController@save');
Route::post('/api/v1/particular/update','Voucher\ParticularsController@update');
Route::get('/api/v1/particulars','Voucher\ParticularsController@particulars');

/*
|--------------------------------------------------------------------------
| Banks
|--------------------------------------------------------------------------
*/

Route::get('/bank/new','Bank\BanksController@index');
Route::get('/bank/list','Bank\BanksController@index');
Route::get('/bank/list/{bankCode}','Bank\BanksController@index');

/*
|--------------------------------------------------------------------------
| Banks Apis
|--------------------------------------------------------------------------
*/

Route::post('/api/v1/bank/save','Bank\BanksController@save');
Route::post('/api/v1/bank/update','Bank\BanksController@update');
Route::get('/api/v1/banks','Bank\BanksController@banks');

/*
|--------------------------------------------------------------------------
| Insurance
|--------------------------------------------------------------------------
*/

Route::get('/insurance/new','Insurance\InsuranceController@index');
Route::get('/insurance/list','Insurance\InsuranceController@index');
Route::get('/insurance/list/{insuranceCode}','Insurance\InsuranceController@index');

/*
|--------------------------------------------------------------------------
| Insurance Apis
|--------------------------------------------------------------------------
*/

Route::post('/api/v1/insurance/save','Insurance\InsuranceController@save');
Route::post('/api/v1/insurance/update','Insurance\InsuranceController@update');
Route::post('/api/v1/insurance-items/save','Insurance\InsuranceController@save_insurance_items'); 
Route::post('/api/v1/insurance-items/remove','Insurance\InsuranceController@remove_insurance_items'); 

Route::post('/api/v1/insurance/update','Insurance\InsuranceController@update');
Route::get('/api/v1/insurance','Insurance\InsuranceController@insurance');
Route::get('/api/v1/insurance-items','Insurance\InsuranceController@insuranceItems');

/*
|--------------------------------------------------------------------------
| AREs
|--------------------------------------------------------------------------
*/

Route::get('/are/new','Are\AresController@index');
Route::get('/are/list','Are\AresController@index');
Route::get('/are/list/{areCode}','Are\AresController@index');

/*
|--------------------------------------------------------------------------
| AREs Apis
|--------------------------------------------------------------------------
*/

Route::post('/api/v1/are/save','Are\AresController@save');
Route::post('/api/v1/are/update','Are\AresController@update');
Route::get('/api/v1/are','Are\AresController@ares');

Route::post('/api/v1/are-items/save','Are\AresController@save_are_items');
Route::post('/api/v1/are-items/update','Are\AresController@update_are_items');
Route::post('/api/v1/are-items/remove','Are\AresController@remove_are_items');
Route::get('/api/v1/are-items','Are\AresController@areItems');


/*
|--------------------------------------------------------------------------
| POs
|--------------------------------------------------------------------------
*/

Route::get('/purchase-order/new','PurchaseOrdersController@index');
Route::get('/purchase-orders/list','PurchaseOrdersController@index');
Route::get('/purchase-order/list/{poCode}','PurchaseOrdersController@index');

/*
|--------------------------------------------------------------------------
| POs Apis
|--------------------------------------------------------------------------
*/

Route::post('/api/v1/purchase-order/save','PurchaseOrdersController@save');
Route::post('/api/v1/purchase-order/update', 'PurchaseOrdersController@update');
Route::get('/api/v1/purchase-orders','PurchaseOrdersController@purchaseOrders');

Route::post('/api/v1/purchase-order-items/save','PurchaseOrdersController@save_purchase_order_items');
Route::post('/api/v1/purchase-order-items/update','PurchaseOrdersController@update_purchase_order_items');
Route::post('/api/v1/purchase-order-items/remove','PurchaseOrdersController@remove_po_items');
Route::get('/api/v1/purchase-order-items','PurchaseOrdersController@purchaseOrderItems');
/*
|--------------------------------------------------------------------------
| Supplier
|--------------------------------------------------------------------------
*/

Route::get('/supplier/new','Supplier\SuppliersController@index');
Route::get('/suppliers/list','Supplier\SuppliersController@index');
Route::get('/supplier/list/{supplierCode}','Supplier\SuppliersController@index');

/*
|--------------------------------------------------------------------------
| Supplier Apis
|--------------------------------------------------------------------------
*/

Route::post('/api/v1/supplier/save','Supplier\SuppliersController@save');
Route::post('/api/v1/supplier/update','Supplier\SuppliersController@update');
Route::get('/api/v1/suppliers','Supplier\SuppliersController@suppliers');

/*
|--------------------------------------------------------------------------
| Supplies
|--------------------------------------------------------------------------
*/

Route::get('/supply/new','Supply\SuppliesController@index');
Route::get('/supply/list','Supply\SuppliesController@index');
Route::get('/supply/list/{supplyCode}','Supply\SuppliesController@index');
Route::get('/supply/edit/{supplyCode}','Supply\SuppliesController@index');
Route::get('/supply/report/{supplyCode}', 'Supply\SupplyReportController@export');

Route::get('/supply-category/new','Supply\SupplyCategoriesController@index');
Route::get('/supply-categories/list','Supply\SupplyCategoriesController@index');
Route::get('/supply-category/list/{supplyCategoryCode}','Supply\SupplyCategoriesController@index');

Route::get('/supply-unit/new','Supply\SupplyUnitsController@index');
Route::get('/supply-unit/list','Supply\SupplyUnitsController@index');
Route::get('/supply-unit/list/{supplyUnitCode}','Supply\SupplyUnitsController@index');

/*
|--------------------------------------------------------------------------
| Supplies Apis
|--------------------------------------------------------------------------
*/

Route::post('/api/v1/supply/save','Supply\SuppliesController@save'); 
Route::post('/api/v1/supply/update','Supply\SuppliesController@update'); 
Route::get('/api/v1/supplies','Supply\SuppliesController@supplies');

Route::post('/api/v1/supply-category/save','Supply\SupplyCategoriesController@save'); 
Route::post('/api/v1/supply-category/update','Supply\SupplyCategoriesController@update'); 
Route::get('/api/v1/supplies-category','Supply\SupplyCategoriesController@supplyCategories');

Route::post('/api/v1/supply-unit/save','Supply\SupplyUnitsController@save'); 
Route::post('/api/v1/supply-unit/update','Supply\SupplyUnitsController@update'); 
Route::get('/api/v1/supply-unit','Supply\SupplyUnitsController@supplyUnits');

/*
|--------------------------------------------------------------------------
| Supplies Apis
|--------------------------------------------------------------------------
*/




Route::get('/api/v1/stock-units','Supply\StockUnitsController@stock_units');


/*
|--------------------------------------------------------------------------
| Particulars
|--------------------------------------------------------------------------
*/

Route::get('/particular/new','ParticularsController@index');
Route::get('/particulars/list','ParticularsController@index');
Route::get('/particular/list/{particularCode}','ParticularsController@index');

/*
|--------------------------------------------------------------------------
| Particulars Apis
|--------------------------------------------------------------------------
*/

Route::post('/api/v1/particular/save','ParticularsController@save');
Route::post('/api/v1/particular/update','ParticularsController@update');
Route::get('/api/v1/particulars','ParticularsController@particulars');

/*
|--------------------------------------------------------------------------
| Funds
|--------------------------------------------------------------------------
*/

Route::get('/fund/new','Fund\FundsController@index');
Route::get('/funds/list','Fund\FundsController@index');
Route::get('/fund/list/{fundCode}','Fund\FundsController@index');
Route::get('/fund/edit/{fundCode}','Fund\FundsController@index');

/*
|--------------------------------------------------------------------------
| Funds Apis
|--------------------------------------------------------------------------
*/

Route::post('/api/v1/fund/save','Fund\FundsController@save');
Route::post('/api/v1/fund/update','Fund\FundsController@update');
Route::get('/api/v1/funds','Fund\FundsController@funds');

Route::post('/api/v1/fund-item/save','Fund\FundsController@save_fund_items');
Route::post('/api/v1/fund-item/update','Fund\FundsController@update_fund_item');
Route::post('/api/v1/fund-item/remove','Fund\FundsController@remove_fund_item');
Route::get('/api/v1/fund-items','Fund\FundsController@fundItems');

/*
|--------------------------------------------------------------------------
| Clients
|--------------------------------------------------------------------------
*/

Route::get('/client/new','Client\ClientsController@index');
Route::get('/clients/list','Client\ClientsController@index');
Route::get('/clients/list/{particularCode}','Client\ClientsController@index');

/*
|--------------------------------------------------------------------------
| Clients Apis
|--------------------------------------------------------------------------
*/

Route::post('/api/v1/client/save','Client\ClientsController@save');
Route::post('/api/v1/client/update','Client\ClientsController@update');
Route::get('/api/v1/clients','Client\ClientsController@clients');


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

Route::post('/api/v1/position/save','Employee\PositionsController@save');
Route::get('/api/v1/positions','Employee\PositionsController@positions');

/*
|--------------------------------------------------------------------------
| Export excel 
|--------------------------------------------------------------------------
*/

Route::get('/export-employees','ExportController@exportEmployees')->name('exports.employees');
Route::get('/api/v1/export-assets','ExportController@exportAssets')->name('exports.assets');

});