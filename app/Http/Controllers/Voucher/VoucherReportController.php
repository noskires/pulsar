<?php
namespace App\Http\Controllers\Voucher;
use Illuminate\Http\Request;

use DB;
use App\PurchaseOrder;
use App\Organization;
use App\Warranty;
use App\Receipt;
use App\Voucher;
use App\VoucherItem;
use App\Employee;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use PDF;

class VoucherReportController extends Controller {

	public function index(){
	  	// return view('employee.index');
		$pdf = PDF::loadView('asset.report1');
		return $pdf->stream('asset.report1.pdf');
	}

	public function export($voucherCode){

		$data['voucher']        = $this->voucher($voucherCode);
		$data['voucher_items']  = $this->voucher_items($voucherCode);

		// return $data;

		$pdf = PDF::loadView('voucher.report_voucher', $data);
		return $pdf->stream('voucher.report_voucher.pdf');

	}

	public function voucher($voucherCode){
		$data = DB::table('vouchers as v')
                ->select(
                    'v.voucher_code',
                    'v.payee_type', 
                    'v.payee', 
                    'v.fund_item_code',
                    'v.description',
                    'v.vat_payee',
                    'v.other_taxes',
                    'v.tax_1',
                    'v.tax_2',
                    'v.amount',
                    'v.check_number',
                    'v.cost_center_code',
                    'v.created_at',
                DB::raw('CASE 
                    WHEN (SELECT count(org_code) FROM organizations WHERE org_code=v.cost_center_code) = 1 
                    THEN (SELECT org_name FROM organizations WHERE org_code=v.cost_center_code)
                    ELSE 
                    (SELECT CONCAT(name," (",code,")")  FROM projects WHERE project_code=v.cost_center_code)
                    END AS cost_center_name'
                ),
                'supply_category.supply_category_code',
                    'supply_category.supply_category_name',
                    DB::raw('DATE_FORMAT(v.check_date, "%M %d, %Y") as check_date'),
                'v.bank_code',
                    'v.payment_type',
                    'b.bank_name',
                    'fi.fund_item_amount'
                )
            ->leftjoin('employees as e','e.employee_code','=','v.payee')
            ->leftjoin('banks as b','b.bank_code','=','v.bank_code')
            ->leftjoin('fund_items as fi','fi.fund_item_code','=','v.fund_item_code')
            ->leftjoin('supply_categories as supply_category','supply_category.supply_category_code','=','v.supply_category_code')
            ->where('v.voucher_code', $voucherCode)->first();

            // return $data;
             
                if($data->payee_type=="EMPLOYEE")
                {
                    $employee = DB::table('employees as e')
                                ->select(DB::raw('CONCAT(trim(CONCAT(e.lname," ",COALESCE(e.affix,""))),", ", COALESCE(e.fname,"")," ", COALESCE(e.mname,"")) as employee_name'))
                                ->where('employee_code', $data->payee)->first();
                    if($employee)
                    {
                        $data->payee_text = $employee->employee_name;
						$data->payee_owner = null;
                        $data->address = null;
                        $data->contact_no = null;
                    }
                    else
                    {
                        $data->payee_text = null;
						$data->payee_owner = null;
                        $data->address = null;
                        $data->contact_no = null;
                    }
                }
                elseif($data->payee_type=="SUPPLIER")
                {
                    $supplier = DB::table('suppliers as s')
					->select('s.supplier_name', 's.supplier_owner', 's.address', 's.contact_no')
					->where('s.supplier_code', $data->payee)->first();
    
                    if($supplier)
                    {
                        $data->payee_text = $supplier->supplier_name;
						$data->payee_owner = $supplier->supplier_owner;
						$data->address = $supplier->address;
						$data->contact_no = $supplier->contact_no;
                    }
                    else
                    {
                        $data->payee_text = null;
						$data->payee_owner = null;
                        $data->address = null;
                        $data->contact_no = null;
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
                        $data->contact_no = null;
                    }
                    else
                    {
                        $data->payee_text = null;
						$data->payee_owner = null;
                        $data->address = null;
                        $data->contact_no = null;
                    }
                }
                else
                {
                    $data->payee_text = null;
                    $data->payee_owner = null;
                    $data->address = null;
                    $data->contact_no = null;
                }
        
        
            return $data;

	}
    
    public function voucher_items($voucherCode){
		$data = DB::table('voucher_items as vi')
        ->select(
          'vi.receipt_code', 
          'vi.voucher_code', 
          'vi.voucher_item_code',
          'v.payment_type',
          'r.receipt_number',
          'r.receipt_date',
          'r.receipt_code',
          'r.purchase_order_code',
          'rt.receipt_type_name',
          DB::raw("(SELECT COALESCE(SUM(receipt_items.receipt_item_quantity), 0) 
					FROM receipts, receipt_items 
					WHERE receipts.receipt_code = receipt_items.receipt_code 
                    AND receipts.receipt_code = r.receipt_code) AS total_item_quantity_receipt"),

          DB::raw("(SELECT COALESCE(SUM(receipt_items.receipt_item_total), 0)
					FROM receipts, receipt_items 
					WHERE receipts.receipt_code = receipt_items.receipt_code 
                    AND receipts.receipt_code = r.receipt_code) AS total_item_cost_receipt")
        )
        ->leftjoin('vouchers as v','v.voucher_code','=','vi.voucher_code')
        ->leftjoin('receipts as r','r.receipt_code','=','vi.receipt_code')
        ->leftjoin('receipt_types as rt','rt.receipt_type_code','=','r.receipt_type')
        ->where('vi.voucher_code', $voucherCode)->get();
	    return $data;
    }
    
}