<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use DB;
use App\PurchaseOrder;
use App\Organization;
use App\Warranty;
use App\Receipt;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use PDF;

class PurchaseOrderReportController extends Controller {

	public function index(){
	  	// return view('employee.index');
		$pdf = PDF::loadView('asset.report1');
		return $pdf->stream('asset.report1.pdf');
	}

	public function export($purchaseOrderCode){

		$data['purchase_order']        = $this->purchase_order($purchaseOrderCode);
		$data['purchase_order_items']  = $this->purchase_order_items($purchaseOrderCode);

		// return $data;

		$pdf = PDF::loadView('purchase_order.report_purchase_order', $data);
		return $pdf->stream('purchase_order.report_purchase_order.pdf');

	}

	public function purchase_order($purchaseOrderCode){
		$data = DB::table('purchase_orders AS po')
				->select(
                  'po.po_code',
                  'po.request_type',
                  'po.reference_code',
                  's.supplier_code',
                  's.supplier_name',
                  's.supplier_owner',
                  's.address',
                  's.bir_no',
                  'po.received_by',
                  'po.date_received',
                  'po.inspected_by',
                  'po.date_inspected',
                  	DB::raw('CONCAT(trim(CONCAT(recby.lname," ",COALESCE(recby.affix,""))),", ", COALESCE(recby.fname,"")," ", COALESCE(recby.mname,"")) as received_by_name'),
					DB::raw('CONCAT(trim(CONCAT(insby.lname," ",COALESCE(insby.affix,""))),", ", COALESCE(insby.fname,"")," ", COALESCE(insby.mname,"")) as inspected_by_name'),
					'recbypos.position_text as received_by_position',
					'insbypos.position_text as inspected_by_position'
                )
                ->leftjoin('employees as recby','recby.employee_code','=','po.received_by')
				->leftjoin('employees as insby','insby.employee_code','=','po.inspected_by')
				->leftjoin('positions as recbypos','recbypos.position_code','=','recby.position_code')
				->leftjoin('positions as insbypos','insbypos.position_code','=','insby.position_code')
                ->leftjoin('suppliers as s','s.supplier_code','=','po.supplier_code')
                ->leftjoin('receipts as r','r.purchase_order_code','=','po.po_code')
                // ->leftjoin('organizations as org','org.org_code','=','po.reference_code')
                ->where('po.po_code', $purchaseOrderCode)->first();

                if($data->request_type=="Office")
				{
					$organization = DB::table('organizations as org')
					->where('org_code', $data->reference_code)->first();
					
					if($organization)
					{
						$data->requesting_office = $organization->org_name;
					}
					else
					{
						$data->requesting_office = null;
					}
				}
				else{

					$project = DB::table('projects as project')
					->where('project_code', $data->reference_code)->first();
					
					if($project)
					{
						$data->requesting_office = $project->name;
					}
					else
					{
						$data->requesting_office = null;
					}

				}

			return $data;

	}

	public function purchase_order_items($purchaseOrderCode){
		$data = DB::table('purchase_order_items as poi')
	           ->select(
	                'poi.po_code', 
	                'poi.po_item_code',
	                'poi.supply_code',
	                's.supply_name',
	                'poi.item_description', 
	                'poi.item_quantity',
	                'poi.item_stock_unit'
	              )

	    ->leftjoin('supplies as s','s.supply_code','=','poi.supply_code')
	    ->where('poi.po_code', $purchaseOrderCode)->get();
	    return $data;
	}

	public function receipt($receiptCode){

		$data = DB::table('receipts as r')
              ->select(
                'r.receipt_code', 
                'r.purchase_order_code',
                'r.receipt_type',
                'r.receipt_number',
                'r.amount', 
                'r.receipt_date',
                'r.payee_type',
                'r.payee',
                'r.remarks',
                'rt.receipt_type_name',
                'vi.voucher_code'
              )
               ->leftjoin('receipt_types as rt','rt.receipt_type_code','=','r.receipt_type')
               ->leftjoin('voucher_items as vi','vi.receipt_code','=','r.receipt_code')
               ->where('r.receipt_code', $receiptCode)->first();


				if($data->payee_type=="EMPLOYEE")
				{
					$employee = DB::table('employees as e')
					->select(
					DB::raw('CONCAT(trim(CONCAT(e.lname," ",COALESCE(e.affix,""))),", ", COALESCE(e.fname,"")," ", COALESCE(e.mname,"")) as employee_name')
					)
					->where('employee_code', $data->payee)->first();
					
					if($employee)
					{
						$data->payee_text = $employee->employee_name;
					}
					else
					{
						$data->payee_text = null;
						$data->payee_owner = null;
						$data->address = null;
					}
				}
				elseif($data->payee_type=="SUPPLIER")
				{
					$supplier = DB::table('suppliers as s')
					->select('s.supplier_name', 's.supplier_owner', 's.address')
					->where('s.supplier_code', $data->payee)->first();

					if($supplier)
					{
						$data->payee_text = $supplier->supplier_name;
						$data->payee_owner = $supplier->supplier_owner;
						$data->address = $supplier->address;
					}
					else
					{
						$data->payee_text = null;
						$data->payee_owner = null;
						$data->address = null;
					}
				}
				elseif($data->payee_type=="BANK")
				{
					$bank = DB::table('banks as b')
					->select('b.bank_name')
					->where('b.bank_code', $data->payee)->first();

					if($bank)
					{
						$data->payee_text = $bank->bank_name;
						$data->payee_owner = null;
						$data->address = null;
					}
					else
					{
						$data->payee_text = null;
						$data->payee_owner = null;
						$data->address = null;
					}
				}
				else
				{
					$data->payee_text = null;
					$data->payee_owner = null;
					$data->address = null;
				}
 

		// $data = DB::table('receipts as receipt')->where('receipt.receipt_code', $receiptCode)->first();
		return $data;
	}

	public function receipt_items($receiptCode){
		$data = DB::table('receipt_items as ri')
              ->select(
                'ri.receipt_code', 
                'ri.receipt_item_code',
                'ri.receipt_item_supply_code',
                's.supply_name',
                'ri.receipt_item_description', 
                'ri.receipt_item_quantity',
                'ri.receipt_item_cost',
                'ri.receipt_item_stock_unit',
                'ri.receipt_item_total',
                'r.receipt_type',
                'rt.receipt_type_name'
              )
            ->leftjoin('receipts as r','r.receipt_code','=','ri.receipt_code')
            ->leftjoin('supplies as s','s.supply_code','=','ri.receipt_item_supply_code')
            ->leftjoin('receipt_types as rt','rt.receipt_type_code','=','r.receipt_type')
            ->where('ri.receipt_code', $receiptCode)
            // ->sum('ri.receipt_item_total');
            ->get();

		// $data = DB::table('receipt_items as receipt_item')->where('receipt_item.receipt_code', $receiptCode)->get();
		return $data;
	}


}