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

		$vouchers = DB::table('vouchers');

		if ($data['voucherCode']){
			$vouchers = $vouchers->where('voucher_code', $data['voucherCode']);
		}

		$vouchers = $vouchers->get();

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
				// $voucher->amount = $data['amount'];
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