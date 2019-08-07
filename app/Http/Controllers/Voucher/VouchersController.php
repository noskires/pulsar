<?php
namespace App\Http\Controllers\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use DB;
use Auth;
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
	                'v.fund_item_code',
	                'v.description',
	                'v.vat_payee',
	                'v.other_taxes',
	                'v.tax_1',
	                'v.tax_2',
	                'v.amount',
	                'v.check_number',
	                'v.cost_center_code',
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
            ->leftjoin('supply_categories as supply_category','supply_category.supply_category_code','=','v.supply_category_code');

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
		$data['fundItemCode'] = $request->input('fund_code');
		$data['description'] = $request->input('description');
		$data['vatPayee'] = $request->input('vatPayee');
		$data['otherTaxes'] = $request->input('otherTaxes');
		$data['tax1'] = $request->input('tax1');
		$data['tax2'] = $request->input('tax2');
		$data['amount'] = $request->input('amount');
		$data['checkNumber'] = $request->input('checkNumber');
		$data['checkDate'] = date('Y-m-d', strtotime($request->input('checkDate')));
		$data['bankCode'] = $request->input('bankCode');
		$data['cost_center_code'] = $request->input('cost_center_code');
    $data['payment_type'] = $request->input('payment_type');
		$data['supply_category_code'] = $request->input('supply_category_code');

		$transaction = DB::transaction(function($data) use($data){
		try{

				$voucher = new Voucher;

			    $voucherCode = (str_pad(($voucher->where('created_at', 'like', '%'.Carbon::now('Asia/Manila')->toDateString().'%')
			    ->get()->count() + 1), 4, "0", STR_PAD_LEFT));

				$voucher->voucher_code           = "DV-".date('YmdHis', strtotime(Carbon::now('Asia/Manila')))."-".$voucherCode;
        $voucher->cost_center_code       = $data['cost_center_code'];
				$voucher->supply_category_code   = $data['supply_category_code'];
				$voucher->payee_type             = $data['payeeType'];
				$voucher->payee                  = $data['payee'];
				$voucher->fund_item_code         = $data['fundItemCode'];
				$voucher->description            = $data['description'];
				$voucher->payment_type           = $data['payment_type'];
				$voucher->amount                 = 0;
        $voucher->changed_by             = Auth::user()->email;
				$voucher->save();

				return response()->json([
				    'status' => 200,
				    'data' => 'null',
				    'message' => 'Successfully saved.'
				]);

			}
			catch (\Exception $e) 
			{
			  	return response()->json([
				    'status' => 500,
				    'data' => 'null',
				    'message' => 'Error, please try again!'
				]);
			}
		});

		return $transaction;
	}

	public function update(Request $request){

    $data = array();
    $data['voucherCode']  = $request->input('voucherCode');
    $data['checkNumber']  = $request->input('check_number');
    $data['checkDate']    = date('Y-m-d', strtotime($request->input('check_date')));
    $data['bankCode']     = $request->input('bank_code');
    $data['payment_type'] = $request->input('payment_type');

    $transaction = DB::transaction(function($data) use($data){
    try{
      	

      //temporary query
    	$voucher = DB::table('vouchers as v')
          ->select(
          	DB::raw("COALESCE(SUM(receipt_item.receipt_item_total), 0) as total_amount")
          )
          ->where('v.voucher_code', $data['voucherCode'])
          ->leftjoin('voucher_items as vi','vi.voucher_code','=','v.voucher_code')
          ->leftjoin('receipts as r','r.receipt_code','=','vi.receipt_code')
          ->leftjoin('receipt_items as receipt_item','receipt_item.receipt_code','=','r.receipt_code')
          ->first();

          $totalReceiptAmount = $voucher->total_amount;

          $voucher = Voucher::where('voucher_code', $data['voucherCode'])->first();

          if($data['payment_type']=="CHECK"){
            $voucher->check_number     = $data['checkNumber'];
            $voucher->check_date       = $data['checkDate'];
            $voucher->bank_code        = $data['bankCode'];
          }else{
            $voucher->check_number     = null;
            $voucher->check_date       = null;
            $voucher->bank_code        = null;
          }
          $voucher->payment_type     = $data['payment_type'];
          $voucher->amount           = $totalReceiptAmount;
          $voucher->changed_by       = Auth::user()->email;
          $voucher->timestamps       = true;
          $voucher->save();

        return response()->json([
            'status' => 200,
            'data' => 'null',
            'message' => 'Successfully saved.'
        ]);

      }
      catch (\Exception $e) 
      {
          return response()->json([
            'status' => 500,
            'data' => 'null',
            'message' => 'Error, please try again!'
        ]);
      }
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
    try{

        for($i = 0; $i < count($data); $i++) {

          $vc            = new VoucherItem;

          $voucherItemCode = (str_pad(($vc->where('created_at', 'like', '%'.Carbon::now('Asia/Manila')->toDateString().'%')
          ->get()->count() + 1), 4, "0", STR_PAD_LEFT));

          // $vc->voucher_item_code = "DVITM-".date('Ymd', strtotime(Carbon::now('Asia/Manila')))."-".$voucherItemCode;
          $vc->voucher_item_code = "DVITM-".date('YmdHis', strtotime(Carbon::now('Asia/Manila')))."-".$voucherItemCode;

          $vc->voucher_code     = $data[$i]['voucher_code'];
          $vc->receipt_code     = $data[$i]['receipt_code'];
          $vc->changed_by       = Auth::user()->email;
          $vc->save(); // fixed typo

        }

        return response()->json([
            'status' => 200,
            'data' => 'null',
            'message' => 'Successfully saved.'
        ]);

      }
      catch (\Exception $e) 
      {
          return response()->json([
            'status' => 500,
            'data' => 'null',
            'message' => 'Error, please try again!'
        ]);
      }
    });

    return $transaction;
  }

  public function remove_voucher_item(Request $request){
  
    $data = Input::post();

    $transaction = DB::transaction(function($data) use($data){
    try{

    	VoucherItem::where('voucher_item_code', $data['voucher_item_code'])->firstOrFail()->delete();

        return response()->json([
            'status' => 200,
            'data' => 'null',
            'message' => 'Successfully deleted.'
        ]);

      }
      catch (\Exception $e) 
      {
          return response()->json([
            'status' => 500,
            'data' => 'null',
            'message' => 'Error, please try again!'
        ]);
      }
    });

    return $transaction;
  }

}