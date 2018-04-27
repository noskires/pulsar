<?php
namespace App\Http\Controllers\Voucher;
use Illuminate\Http\Request;

use DB;
use App\Voucher;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class VouchersController extends Controller {
	public function index(){
		return view('layout.index');
	}

	public function vouchers(Request $request){

		$data = array(
			'voucherCode'=>$request->input('voucherCode'),
		);

		$vouchers = DB::table('vouchers as v')
				->select(
                'v.voucher_code',
                'v.payee_type', 
                'v.payee', 
                'v.particulars',
                'v.description',
                'v.vat_payee',
                'v.other_taxes',
                'v.tax_1',
                'v.tax_2',
                'v.amount',
                'v.check_number',
                'p.description',
                DB::raw('DATE_FORMAT(v.check_date, "%M %d, %Y") as check_date'),
                'v.bank_code'
              )
            ->leftjoin('Employees as e','e.employee_id','=','v.payee')
            ->leftjoin('Particulars as p','p.particular_code','=','v.particulars');

		if ($data['voucherCode']){
			$vouchers = $vouchers->where('voucher_code', $data['voucherCode']);
		}

		$vouchers = $vouchers->get();


		foreach ($vouchers as $key => $voucher) {
			if($voucher->payee_type=="EMPLOYEE")
			{
				$employee = DB::table('employees as e')
							->select(DB::raw('concat(trim(concat(e.lname," ",e.affix)),", ", e.fName," ", e.mName) as employee_name'))
							->where('employee_id', $voucher->payee)->first();
				if($employee)
				{
					$voucher->payee_text = $employee->employee_name;
				}
				else
				{
					$voucher->payee_text = null;
				}
			}
			elseif($voucher->payee_type=="SUPPLIER")
			{
				$supplier = DB::table('suppliers as s')
							->select('s.supplier_name')
							->where('s.supplier_code', $voucher->payee)->first();

				if($supplier)
				{
					$voucher->payee_text = $supplier->supplier_name;
				}
				else
				{
					$voucher->payee_text = null;
				}
			}
			elseif($voucher->payee_type=="BANK")
			{
				$bank = DB::table('banks as b')
							->select('b.bank_name')
							->where('b.bank_code', $voucher->payee)->first();

				if($bank)
				{
					$voucher->payee_text = $bank->bank_name;
				}
				else
				{
					$voucher->payee_text = null;
				}
			}
			else
			{
				$voucher->payee_text = null;
			}
		}

		return response()-> json([
			'status'=>200,
			'data'=>$vouchers,
			'message'=>''
		]);
	}

	public function save(Request $request){

		$data = array();

		$data['payeeType']   = $request->input('payeeType');
		$data['payee'] = $request->input('payee');
		$data['particulars'] = $request->input('particulars');
		$data['description'] = $request->input('description');
		$data['vatPayee'] = $request->input('vatPayee');
		$data['otherTaxes'] = $request->input('otherTaxes');
		$data['tax1'] = $request->input('tax1');
		$data['tax2'] = $request->input('tax2');
		$data['amount'] = $request->input('amount');
		$data['checkNumber'] = $request->input('checkNumber');
		$data['checkDate'] = date('Y-m-d', strtotime($request->input('checkDate')));
		$data['bankCode'] = $request->input('bankCode');

		$transaction = DB::transaction(function($data) use($data){
		// try{

				$voucher = new Voucher;

			    $voucherCode = (str_pad(($voucher->where('created_at', 'like', '%'.Carbon::now('Asia/Manila')->toDateString().'%')
			    ->get()->count() + 1), 4, "0", STR_PAD_LEFT));

				$voucher->voucher_code = "DV-".date('Ymd', strtotime(Carbon::now('Asia/Manila')))."-".$voucherCode;
				$voucher->payee_type = $data['payeeType'];
				$voucher->payee = $data['payee'];
				$voucher->particulars = $data['particulars'];
				$voucher->description = $data['description'];
				// $voucher->vat_payee = $data['vatPayee'];
				// $voucher->other_taxes = $data['otherTaxes'];
				// $voucher->tax_1 = $data['tax1'];
				// $voucher->tax_2 = $data['tax2'];
				$voucher->amount = 0;
				// $voucher->check_number = $data['checkNumber'];
				// $voucher->check_date = $data['checkDate'];
				// $voucher->bank_code = $data['bankCode'];
				$voucher->save();

				return response()->json([
				    'status' => 200,
				    'data' => 'null',
				    'message' => 'Successfully saved.'
				]);

			// }
			// catch (\Exception $e) 
			// {
			//   	return response()->json([
			// 	    'status' => 500,
			// 	    'data' => 'null',
			// 	    'message' => 'Error, please try again!'
			// 	]);
			// }
		});

		return $transaction;
	}
}