<?php
namespace App\Http\Controllers\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use DB;
use Auth;
use App\Voucher;
use App\Bank;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class BanksController extends Controller {
	
	public function index(){
		return view('layout.index');
	}

	public function banks(Request $request){

		$data = array(
			'bankCode'=>$request->input('bankCode'),
		);

		$banks = DB::table('banks');

		if ($data['bankCode']){
			$banks = $banks->where('bank_code', $data['bankCode']);
		}

		$banks = $banks->get();

		return response()-> json([
			'status'=>200,
			'data'=>$banks,
			'message'=>''
		]);
	}

	public function save(Request $request){

		$data = Input::post();

		$transaction = DB::transaction(function($data) use($data){
		try{
				$bank = new Bank;

			    $bankCode = (str_pad(($bank->where('created_at', 'like', '%'.Carbon::now('Asia/Manila')->toDateString().'%')
			    ->get()->count() + 1), 4, "0", STR_PAD_LEFT));

				// $bank->bank_code = "BANK-".date('Ymd', strtotime(Carbon::now('Asia/Manila'))).'-'.$bankCode;
				$bank->bank_code = "BANK-".date('YmdHis', strtotime(Carbon::now('Asia/Manila'))).'-'.$bankCode;
				$bank->bank_name = $data['bank_name'];
				$bank->branch = $data['branch'];
				$bank->manager = $data['manager'];
				$bank->manager_email = $data['manager_email'];
				$bank->mobile_number = $data['mobile_number'];
				$bank->telephone_number = $data['telephone_number'];
				$bank->changed_by = Auth::user()->email;
				$bank->save();

				

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

		$data = Input::post();

		$transaction = DB::transaction(function($data) use($data){
		try{


				$bank = Bank::where('bank_code', $data['bank_code'])->first();
	            $bank->bank_name = $data['bank_name'];
	            $bank->branch = $data['branch'];
	            $bank->manager = $data['manager'];
	            $bank->manager_email = $data['manager_email'];
	            $bank->mobile_number = $data['mobile_number'];
	            $bank->telephone_number = $data['telephone_number'];
	            $bank->changed_by = Auth::user()->email;
	            $bank->timestamps = true;
	            $bank->save();

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
}