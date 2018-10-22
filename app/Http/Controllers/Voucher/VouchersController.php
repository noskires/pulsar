<?php
namespace App\Http\Controllers\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use DB;
use App\Voucher;
use App\VoucherItem;
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
	                'v.bank_code',
	                'b.bank_name'
              	)
            ->leftjoin('Employees as e','e.employee_code','=','v.payee')
            ->leftjoin('Banks as b','b.bank_code','=','v.bank_code')
            ->leftjoin('Particulars as p','p.particular_code','=','v.particulars');

		if ($data['voucherCode']){
			$vouchers = $vouchers->where('voucher_code', $data['voucherCode']);
		}

		$vouchers = $vouchers->get();


		foreach ($vouchers as $key => $voucher) {
			if($voucher->payee_type=="EMPLOYEE")
			{
				$employee = DB::table('employees as e')
							->select(DB::raw('CONCAT(trim(CONCAT(e.lname," ",COALESCE(e.affix,""))),", ", COALESCE(e.fname,"")," ", COALESCE(e.mname,"")) as employee_name'))
							// ->where('e.employee_code', '816000001')->first();
							->where('employee_code', $voucher->payee)->first();
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

	public function update(Request $request){

    $data = array();
    $data['voucherCode'] = $request->input('voucherCode');
    $data['checkNumber'] = $request->input('check_number');
    $data['checkDate'] = date('Y-m-d', strtotime($request->input('check_date')));
    $data['bankCode'] = $request->input('bank_code');

    $transaction = DB::transaction(function($data) use($data){
    // try{
      	
    	$voucher = DB::table('vouchers as v')
          ->select(
          	DB::raw("COALESCE(SUM(r.amount), 0) as total_amount")
          )
          ->where('v.voucher_code', $data['voucherCode'])
          ->leftjoin('voucher_items as vi','vi.voucher_code','=','v.voucher_code')
          ->leftjoin('receipts as r','r.receipt_code','=','vi.receipt_code')
          ->first();


          $totalReceiptAmount = $voucher->total_amount;

		DB::table('vouchers')
            ->where('voucher_code', $data['voucherCode'])
            ->update([
              'check_number' => $data['checkNumber'],
              'check_date' => $data['checkDate'],
              'bank_code' => $data['bankCode'],
              'amount' => $totalReceiptAmount
            ]);

        return response()->json([
            'status' => 200,
            'data' => 'null',
            'message' => 'Successfully saved.'
        ]);

      // }
      // catch (\Exception $e) 
      // {
      //     return response()->json([
      //       'status' => 500,
      //       'data' => 'null',
      //       'message' => 'Error, please try again!'
      //   ]);
      // }
    });

    return $transaction;
  }

	public function voucher_items(Request $request){

    $data = array(
      'voucherCode'=>$request->input('voucherCode'),
      'voucherItemCode'=>$request->input('voucherItemCode'),
      'receiptCode'=>$request->input('receiptCode'),
    );

    $voucherItems = DB::table('voucher_items as vi')
              ->select(
                'vi.receipt_code', 
                'vi.voucher_code', 
                'vi.voucher_item_code',
                'r.receipt_number',
                'r.receipt_date',
                'r.amount',
                'rt.receipt_type_name'
              )
              ->leftjoin('receipts as r','r.receipt_code','=','vi.receipt_code')
              ->leftjoin('receipt_types as rt','rt.receipt_type_code','=','r.receipt_type');


    if ($data['voucherCode']){
      $voucherItems = $voucherItems->where('vi.voucher_code', $data['voucherCode']);
    }

    if ($data['voucherItemCode']){
      $voucherItems = $voucherItems->where('vi.voucher_item_code', $data['voucherItemCode']);
    }

    if ($data['receiptCode']){
      $voucherItems = $voucherItems->where('vi.receipt_code', $data['receiptCode']);
    }

    $voucherItems = $voucherItems->get();

    return response()-> json([
      'status'=>200,
      'data'=>$voucherItems,
      'message'=>''
    ]);
  }

	public function save_voucher_items(Request $request){

    $data = Input::post();

    $transaction = DB::transaction(function($data) use($data){
    // try{

        for($i = 0; $i < count($data); $i++) {

          $vc            = new VoucherItem;

          $voucherItemCode = (str_pad(($vc->where('created_at', 'like', '%'.Carbon::now('Asia/Manila')->toDateString().'%')
          ->get()->count() + 1), 4, "0", STR_PAD_LEFT));

          $vc->voucher_item_code = "DVITM-".date('Ymd', strtotime(Carbon::now('Asia/Manila')))."-".$voucherItemCode;

          $vc->voucher_code     = $data[$i]['voucher_code'];
          $vc->receipt_code     = $data[$i]['receipt_code'];
          $vc->save(); // fixed typo

        }

        return response()->json([
            'status' => 200,
            'data' => 'null',
            'message' => 'Successfully saved.'
        ]);

      // }
      // catch (\Exception $e) 
      // {
      //     return response()->json([
      //       'status' => 500,
      //       'data' => 'null',
      //       'message' => 'Error, please try again!'
      //   ]);
      // }
    });

    return $transaction;
  }

  // public function sample(){
  // 	$voucher = DB::table('vouchers as v')
  //         ->select(
  //         	DB::raw("COALESCE(SUM(r.amount), 0) as total_amount")
  //         )
  //         ->where('v.voucher_code', 'DV-20180428-0002')
  //         ->leftjoin('voucher_items as vi','vi.voucher_code','=','v.voucher_code')
  //         ->leftjoin('receipts as r','r.receipt_code','=','vi.receipt_code')->first();
  //         // ->first();

  //         return $voucher->total_amount;
  // }
}