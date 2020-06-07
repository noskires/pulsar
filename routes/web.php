<?php

// use App\User;
// use Illuminate\Notifications\Messages\NexmoMessage;

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



Route::get('/sms','SmsNotificationController@not');

Route::get('/sms2','SmsNotificationController@not2');

// Route::get('/sms', function(){
//     Nexmo::message()->send([
//         'to'=>'+639988964947',
//         'from'=>'+639054153810',
//         'text'=>'Message from sample'
//     ]);
// });




Auth::routes();
Route::post('/auth', ['uses'=>'LoginController@login', 'as'=>'auth']);

// Route::get('/home','HomeController@index');

Route::get('/info','LoginController@phpinfo');

Route::group(['middleware'=>'auth'], function(){
    
Route::get('/logout','LoginController@logout');
Route::get('/reset-password','ResetPasswordController@index');

//testing angular table
// Route::get('/angular-datatables','MaintenanceController@index');
// Route::get('/angular-datatables/new','MaintenanceController@index');


Route::get('/pdf', 'PdfController@index');
Route::get('/export/{assetTag}', 'PdfController@export');


Route::post('upload', 'UploadController@upload');

/*
|--------------------------------------------------------------------------
| Maintenance -- MODULE-005
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'checkModules:MODULE-005'], function () {
    Route::get('','MaintenanceController@index');
    Route::get('/index','MaintenanceController@index');
    Route::get('/maintenance/new','MaintenanceController@index');

    Route::get('/maintenance/new2','MaintenanceController@index');

    Route::get('/maintenance/operation','MaintenanceController@index');
    Route::get('/maintenance/list-operating','MaintenanceController@index');
    Route::get('/maintenance/list-operating/{opeartionCode}','MaintenanceController@index');
    Route::get('/maintenance/list-monitoring','MaintenanceController@index');
});
/*
|--------------------------------------------------------------------------
| Maintenance APIs
|--------------------------------------------------------------------------
*/

Route::post('/api/v1/operation/save','Maintenance\OperationsController@save');
Route::post('/api/v1/operation/update','Maintenance\OperationsController@update');

Route::get('/api/v1/operations','Maintenance\OperationsController@operations');
Route::get('/api/v1/operation/update','Maintenance\OperationsController@update');
Route::get('/api/v1/operations/assets-monitoring','Maintenance\OperationsController@assets_monitoring');

/*
|--------------------------------------------------------------------------
| Assets - MODULE-001
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'checkModules:MODULE-001'], function () {
    Route::get('/asset/new','AssetsController@index');
    Route::get('/asset/list-equipments','AssetsController@index');
    Route::get('/asset/list-equipments/{asset_code}','AssetsController@index');
    Route::get('/asset/more-details/{asset_code}','AssetsController@index');
    Route::get('/asset/more-details4/{asset_code}','AssetsController@index');

    Route::get('/asset/more-details/{asset_code}/registration/{asset_registration_code}','AssetsController@index');
    Route::get('/asset/more-details/{asset_code}/registration/new','AssetsController@index');

    Route::get('/asset-category/new','Asset\AssetCategoriesController@index');
    Route::get('/asset-categories/list','Asset\AssetCategoriesController@index');
    Route::get('/asset-category/list/{assetCategoryCode}','Asset\AssetCategoriesController@index');
});

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

Route::get('/api/v1/asset-registrations','Asset\AssetRegistrationsController@assetRgstns');
Route::post('/api/v1/asset-registration/save','Asset\AssetRegistrationsController@save');
Route::post('/api/v1/asset-registration/update','Asset\AssetRegistrationsController@update');

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
Route::group(['middleware' => 'checkModules:MODULE-003'], function () {
    Route::get('/employee/list','EmployeesController@index');
    Route::get('/employee/new','EmployeesController@index');
});

Route::get('/profile','EmployeesController@index');

Route::post('/api/v1/employees/save','EmployeesController@save');
Route::post('/api/v1/employee/update','EmployeesController@update');
Route::get('/api/v1/employees','EmployeesController@employees');
Route::get('/api/v1/employees2','EmployeesController@employees2');
Route::post('/api/v1/profile/upload-profile-photo/{employeeCode}','EmployeesController@uploadProfilePhoto');

/*
|--------------------------------------------------------------------------
| Organizations --
|--------------------------------------------------------------------------
*/
// MODULE-014 - Office Location
Route::group(['middleware' => 'checkModules:MODULE-014'], function () {
    Route::get('/organizations','Organization\DepartmentsController@index');
    Route::get('/organization/{orgUnitCode}','Organization\DepartmentsController@index');
    
});

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
| Projects -- MODULE-003
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => 'checkModules:MODULE-003'], function () {
    Route::get('/project/new','Project\ProjectsController@index');
    Route::get('/projects/list','Project\ProjectsController@index');
    Route::get('/projects/list/{projectCode}','Project\ProjectsController@index');
    Route::get('/project/profile/{projectCode}','Project\ProjectsController@index');
    Route::get('/project/profile/{projectCode}/edit','Project\ProjectsController@index');
});
/*
|--------------------------------------------------------------------------
| Project Apis
|--------------------------------------------------------------------------
*/

Route::post('/api/v1/projects/save','Project\ProjectsController@save');
Route::post('/api/v1/projects/update','Project\ProjectsController@update');

Route::get('/api/v1/projects','Project\ProjectsController@projects');

/*
|--------------------------------------------------------------------------
| Job Order -- MODULE-008
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'checkModules:MODULE-008'], function () {
    Route::get('/job-order/new','JobOrder\JobOrdersController@index');
    Route::get('/job-order/list','JobOrder\JobOrdersController@index');
    Route::get('/job-order/list/{jobOrderCode}','JobOrder\JobOrdersController@index');
    Route::get('/job-order/new/{assetTag}','JobOrder\JobOrdersController@index');
    Route::get('/job-order/report/{jobOrderCode}', 'JobOrder\JobOrderReportController@export');

    Route::get('/job-order2/list','JobOrder\JobOrdersController@index');
    Route::get('/job-order2/list/{jobOrderCode}','JobOrder\JobOrdersController@index');
});
/*
|--------------------------------------------------------------------------
| Job Order Apis
|--------------------------------------------------------------------------
*/

Route::post('/api/v1/job-order/save','JobOrder\JobOrdersController@save');
Route::post('/api/v1/job-order/update','JobOrder\JobOrdersController@update');
Route::get('/api/v1/job-orders','JobOrder\JobOrdersController@job_orders');

Route::post('/api/v1/job-order2/save','JobOrder\JobOrdersController@save2');

/*
|--------------------------------------------------------------------------
| Requisition -- MODULE-006
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
Route::post('/api/v1/requisitions/update2','Requisition\RequisitionsController@update2');
Route::post('/api/v1/requisitions/update_record_status','Requisition\RequisitionsController@update_record_status');

Route::get('/requisition/report/{requisitionCode}', 'Requisition\RequisitionReportController@export');
Route::get('/requisition/report2', 'Requisition\RequisitionReportController@export2');

Route::get('/requisition-issue-slip/office/new','Requisition\RequisitionsController@index');
Route::get('/requisition2/ris-status-report','Requisition\RequisitionsController@index');

Route::group(['middleware' => 'checkModules:MODULE-006'], function () {
    Route::get('/requisition2/list','Requisition\RequisitionsController@index');
    Route::get('/requisition2/list/{requisitionCode}','Requisition\RequisitionsController@index');
    Route::get('/requisition2/edit/{requisitionCode}','Requisition\RequisitionsController@index');
    Route::get('/requisition2/delete/{requisitionCode}','Requisition\RequisitionsController@index');
});
/*
|--------------------------------------------------------------------------
| Requisition Apis
|--------------------------------------------------------------------------
*/

Route::post('/api/v1/requisition-issue-slip/asset/save','Requisition\RequisitionsController@save_asset');
Route::post('/api/v1/requisition-issue-slip/project/save','Requisition\RequisitionsController@save_project');

Route::get('/requisition-issue-slip/asset/new/{jobOrderCode}','Requisition\RequisitionsController@index');
Route::get('/requisition/asset/new/{jobOrderCode}','Requisition\RequisitionsController@index');
Route::get('/requisition-issue-slip/project/new/{jobOrderCode}','Requisition\RequisitionsController@index');

Route::post('/api/v1/requisition-issue-slip/office/save','Requisition\RequisitionsController@save_office');
Route::post('/api/v1/requisition-issue-slip/office/update','Requisition\RequisitionsController@update_office');
Route::post('/api/v1/requisition-issue-slip/office/update2','Requisition\RequisitionsController@update2');
/*
|--------------------------------------------------------------------------
| Receipts -- MODULE-012
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'checkModules:MODULE-012'], function () {
    Route::get('/receipt/new','Receipt\ReceiptsController@index');
    Route::get('/receipt/list','Receipt\ReceiptsController@index');
    Route::get('/receipt/returned-items','Receipt\ReceiptsController@index');
    Route::get('/receipt2/list','Receipt\ReceiptsController@index');
    Route::get('/receipt/list/{receiptCode}','Receipt\ReceiptsController@index');
    Route::get('/receipt2/list/{receiptCode}','Receipt\ReceiptsController@index');
    Route::get('/receipt2/edit/{receiptCode}','Receipt\ReceiptsController@index');
    Route::get('/receipt2/delete/{receiptCode}','Receipt\ReceiptsController@index');
    Route::get('/receipt/report/{receiptCode}', 'Receipt\ReceiptReportController@export');
});
/*
|--------------------------------------------------------------------------
| Receipts Apis
|--------------------------------------------------------------------------
*/

Route::post('/api/v1/receipt/save','Receipt\ReceiptsController@save');
Route::post('/api/v1/receipt/update','Receipt\ReceiptsController@update');
Route::post('/api/v1/receipt/delete','Receipt\ReceiptsController@delete');
Route::get('/api/v1/receipts','Receipt\ReceiptsController@receipts');

Route::get('/api/v1/receipt-items','Receipt\ReceiptsController@receiptItems');
Route::get('/api/v1/receipt-types','Receipt\ReceiptsController@receipt_types');

Route::post('/api/v1/receipt-items/save','Receipt\ReceiptsController@save_receipt_items');
Route::post('/api/v1/receipt-items/delete','Receipt\ReceiptsController@delete_receipt_items');
Route::post('/api/v1/receipt-items/return-receipt','Receipt\ReceiptsController@return_receipt_items');
Route::post('/api/v1/receipt-items/delete-return-receipt','Receipt\ReceiptsController@delete_returned_receipt_items');

/*
|--------------------------------------------------------------------------
| Vouchers -- MODULE-010
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'checkModules:MODULE-010'], function () {
    Route::get('/voucher/new','Voucher\VouchersController@index');
    Route::get('/voucher/list','Voucher\VouchersController@index');
    Route::get('/voucher/list/{voucherCode}','Voucher\VouchersController@index');
    Route::get('/voucher/report/{voucherCode}', 'Voucher\VoucherReportController@export');
});
/*
|--------------------------------------------------------------------------
| Vouchers Apis
|--------------------------------------------------------------------------
*/

Route::post('/api/v1/voucher/save','Voucher\VouchersController@save');
Route::post('/api/v1/voucher-items/save','Voucher\VouchersController@save_voucher_items');
Route::post('/api/v1/voucher-item/remove','Voucher\VouchersController@remove_voucher_item');
Route::post('/api/v1/voucher/update','Voucher\VouchersController@update');

Route::get('/api/v1/vouchers','Voucher\VouchersController@vouchers');
Route::get('/api/v1/voucher-items','Voucher\VouchersController@voucher_items');



// Route::get('/api/v1/sample-voucher','Voucher\VouchersController@sample');

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
| Banks -- MODULE-015
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'checkModules:MODULE-015'], function () {
    Route::get('/bank/new','Bank\BanksController@index');
    Route::get('/bank/list','Bank\BanksController@index');
    Route::get('/bank/list/{bankCode}','Bank\BanksController@index');
});
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
| Insurance -- MODULE-016
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'checkModules:MODULE-016'], function () {
    Route::get('/insurance/new','Insurance\InsuranceController@index');
    Route::get('/insurance/list','Insurance\InsuranceController@index');
    Route::get('/insurance/edit/{insuranceCode}','Insurance\InsuranceController@index');
    Route::get('/insurance/for-renewal','Insurance\InsuranceController@index');
    Route::get('/insurance/list/{insuranceCode}','Insurance\InsuranceController@index');
});
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
| POs -- MODULE-007
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => 'checkModules:MODULE-007'], function () {
    Route::get('/purchase-order/new','PurchaseOrdersController@index');
    Route::get('/purchase-orders/list','PurchaseOrdersController@index');
    Route::get('/purchase-orders2/list','PurchaseOrdersController@index');
    Route::get('/purchase-orders-office/list','PurchaseOrdersController@index');
    Route::get('/purchase-order/list/{poCode}','PurchaseOrdersController@index');
    Route::get('/purchase-order2/list/{poCode}','PurchaseOrdersController@index');
    Route::get('/purchase-order2/po-status-report','PurchaseOrdersController@index');

    Route::get('/purchase-order2/edit/{poCode}','PurchaseOrdersController@index');
    Route::get('/purchase-order2/delete/{poCode}','PurchaseOrdersController@index'); 

    Route::get('/purchase-order/report/{poCode}', 'PurchaseOrderReportController@export');
    Route::get('/purchase-order-office/report', 'PurchaseOrderReportController@export_office');
    


    
});
/*
|--------------------------------------------------------------------------
| POs Apis
|--------------------------------------------------------------------------
*/

Route::post('/api/v1/purchase-order/save','PurchaseOrdersController@save');
Route::post('/api/v1/purchase-order/update', 'PurchaseOrdersController@update');
Route::post('/api/v1/purchase-order/update2', 'PurchaseOrdersController@update2');
Route::post('/api/v1/purchase-order/update_record_status', 'PurchaseOrdersController@update_record_status');
Route::get('/api/v1/purchase-orders','PurchaseOrdersController@purchaseOrders');

Route::post('/api/v1/purchase-order-items/save','PurchaseOrdersController@save_purchase_order_items');
Route::post('/api/v1/purchase-order-items/update','PurchaseOrdersController@update_purchase_order_items');
Route::post('/api/v1/purchase-order-items/remove','PurchaseOrdersController@remove_po_items');
Route::get('/api/v1/purchase-order-items','PurchaseOrdersController@purchaseOrderItems');
Route::get('/api/v2/purchase-order-items','PurchaseOrdersController@purchaseOrderItems2');


/*
|--------------------------------------------------------------------------
| Utilizations -- MODULE-009
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'checkModules:MODULE-009'], function () {
    Route::get('/utilization/new','UtilizationsController@index');
    Route::get('/utilization/list','UtilizationsController@index');
    Route::get('/utilization/list/{utilizationCode}','UtilizationsController@index');
    Route::get('/utilization/report/{utilizationCode}', 'UtilizationReportController@export');

    Route::get('/utilization-office/list','UtilizationsController@index');
    Route::get('/utilization-office/list/{utilizationCode}','UtilizationsController@index');
    Route::get('/utilization-office/report', 'UtilizationReportController@export_office');
});
/*
|--------------------------------------------------------------------------
| Utilizations Apis
|--------------------------------------------------------------------------
*/

Route::post('/api/v1/utilization/save','UtilizationsController@save');
Route::post('/api/v1/utilization/update', 'UtilizationsController@update');
Route::get('/api/v1/utilizations','UtilizationsController@utilizations');

Route::post('/api/v1/utilization-item/save','UtilizationsController@save_utilization_item');
Route::post('/api/v1/utilization-item/update','UtilizationsController@update_utilization_item');
Route::post('/api/v1/utilization-item/remove','UtilizationsController@remove_utilization_item');
Route::get('/api/v1/utilization-items','UtilizationsController@utilizationItems');


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
| Supplies -- MODULE-011
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => 'checkModules:MODULE-011'], function () {
    Route::get('/supply/new','Supply\SuppliesController@index');
    Route::get('/supply/list','Supply\SuppliesController@index');
    Route::get('/supply/list/{supplyCode}','Supply\SuppliesController@index');
    Route::get('/supply/edit/{supplyCode}','Supply\SuppliesController@index');
    Route::get('/supply/list-status','Supply\SuppliesController@index');

    
    Route::get('/supply/report/{supplyCode}', 'Supply\SupplyReportController@export');

    Route::get('/supply-category/new','Supply\SupplyCategoriesController@index');
    Route::get('/supply-categories/list','Supply\SupplyCategoriesController@index');
    Route::get('/supply-category/list/{supplyCategoryCode}','Supply\SupplyCategoriesController@index');

    Route::get('/supply-unit/new','Supply\SupplyUnitsController@index');
    Route::get('/supply-unit/list','Supply\SupplyUnitsController@index');
    Route::get('/supply-unit/list/{supplyUnitCode}','Supply\SupplyUnitsController@index');
});
/*
|--------------------------------------------------------------------------
| Supplies Apis
|--------------------------------------------------------------------------
*/

Route::post('/api/v1/supply/save','Supply\SuppliesController@save');
Route::post('/api/v1/supply/update','Supply\SuppliesController@update');
Route::get('/api/v1/supplies','Supply\SuppliesController@supplies');
Route::get('/api/v2/supplies','Supply\SuppliesController@supplies2');

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
Route::get('/funds/budget-status','Fund\FundsController@index');
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
Route::get('/api/v2/fund-items','Fund\FundsController@fundItems');


/*
|--------------------------------------------------------------------------
| SubCon
|--------------------------------------------------------------------------
*/

Route::get('/subcon/new','Subcon\SubConsController@index');
Route::get('/subcon/list','Subcon\SubConsController@index');
Route::get('/subcon/list/{subconCode}','Subcon\SubConsController@index');
Route::get('/subcon/edit/{subconCode}','Subcon\SubConsController@index');

/*
|--------------------------------------------------------------------------
| SubCon Apis
|--------------------------------------------------------------------------
*/

Route::post('/api/v1/Subcon/save','Subcon\SubConsController@save');
Route::post('/api/v1/Subcon/update','Subcon\SubConsController@update');
Route::get('/api/v1/Subcons','Subcon\SubConsController@subcons');

Route::post('/api/v1/Subcon-item/save','Subcon\SubConsController@save');
Route::post('/api/v1/Subcon-item/update','Subcon\SubConsController@updae');
Route::post('/api/v1/Subcon-item/remove','Subcon\SubConsController@remove');
Route::get('/api/v1/Subcon-items','Subcon\SubConsController@fundItems');
Route::get('/api/v2/Subcon-items','Subcon\SubConsController@fundItems');

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
| Roles -- MODULE-013
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'checkModules:MODULE-013'], function () {
    Route::get('/role/new','Role\RolesController@index');
    Route::get('/role/list','Role\RolesController@index');
    Route::get('/role/list/{roleCode}','Role\RolesController@index');
});
/*
|--------------------------------------------------------------------------
| Roles Apis
|--------------------------------------------------------------------------
*/

Route::post('/api/v1/role/save','Role\RolesController@save');
Route::post('/api/v1/role/update','Role\RolesController@update');
Route::get('/api/v1/roles','Role\RolesController@list');


/*
|--------------------------------------------------------------------------
| RoleItems
|--------------------------------------------------------------------------
*/

Route::get('/role-item/new','Role\RoleItemsController@index');
Route::get('/role-item/list','Role\RoleItemsController@index');
Route::get('/role-item/list/{roleCode}','Role\RoleItemsController@index');

/*
|--------------------------------------------------------------------------
| RoleItems Apis
|--------------------------------------------------------------------------
*/

Route::post('/api/v1/role-item/save','Role\RoleItemsController@save');
Route::post('/api/v1/role-item/update','Role\RoleItemsController@update');
Route::post('/api/v1/role-item/delete','Role\RoleItemsController@delete');
Route::get('/api/v1/role-items','Role\RoleItemsController@list');


/*
|--------------------------------------------------------------------------
| Modules
|--------------------------------------------------------------------------
*/

Route::get('/module/new','Role\ModulesController@index');
Route::get('/module/list','Role\ModulesController@index');
Route::get('/module/list/{roleCode}','Role\ModulesController@index');

/*
|--------------------------------------------------------------------------
| Modules Apis
|--------------------------------------------------------------------------
*/

Route::post('/api/v1/module/save','Role\ModulesController@save');
Route::post('/api/v1/module/update','Role\ModulesController@update');
Route::get('/api/v1/modules','Role\ModulesController@list');


/*
|--------------------------------------------------------------------------
| Users
|--------------------------------------------------------------------------
*/

Route::get('/user/new','User\UsersController@index');
Route::get('/user/list','User\UsersController@index');
Route::get('/user/list/{userCode}','User\UsersController@index');

/*
|--------------------------------------------------------------------------
| Users Apis
|--------------------------------------------------------------------------
*/

Route::post('/api/v1/user/save','User\UsersController@save');
Route::post('/api/v1/user/update','User\UsersController@update');
Route::get('/api/v1/users','User\UsersController@list');
Route::post('/api/v1/user/generate-password','User\UsersController@generatePassword');
Route::post('/api/v1/user/reset-password','User\UsersController@resetPassword');


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

// Route::view('/uela', '');

Route::get('uela', 'MaintenanceController@index');
});
