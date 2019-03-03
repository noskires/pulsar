<?php
namespace App\Http\Controllers\Receipt;
use Illuminate\Http\Request;

use DB;
use App\Organization;
use App\Warranty;
use App\Receipt;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use PDF;

class ReceiptReportController extends Controller {

	public function index(){
	  	// return view('employee.index');
		$pdf = PDF::loadView('asset.report1');
		return $pdf->stream('asset.report1.pdf');
	}

	public function export($receiptCode){

		$data['receipt']        = $this->receipt($receiptCode);
		$data['receipt_items']        = $this->receipt_items($receiptCode);
		$data['receipt_items_total']        = $this->receipt_items($receiptCode)->sum('receipt_item_total');

		// return $data;

		$pdf = PDF::loadView('receipt.report_receipt', $data);
		return $pdf->stream('receipt.report_receipt.pdf');
	}

	public function receipt($receiptCode){

		$data = DB::table('receipts as r')
              ->select(
                'r.receipt_code', 
                'r.purchase_order_code',
                'r.receipt_type',
                'r.receipt_number',
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