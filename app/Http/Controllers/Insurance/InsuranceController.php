<?php
namespace App\Http\Controllers\Insurance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use DB;
use App\Voucher;
use App\Bank;
use App\Insurance;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class InsuranceController extends Controller {
	
	public function index(){
		return view('layout.index');
	}

	public function insurance(Request $request){

		$data = array(
			'insuranceCode'=>$request->input('insuranceCode'),
		);

		$banks = DB::table('insurance');

		if ($data['insuranceCode']){
			$banks = $banks->where('insurance_code', $data['insuranceCode']);
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
		// try{
				$insurance = new Insurance;

			    $insuranceCode = (str_pad(($insurance->where('created_at', 'like', '%'.Carbon::now('Asia/Manila')->toDateString().'%')
			    ->get()->count() + 1), 4, "0", STR_PAD_LEFT));

				$insurance->insurance_code = "INSU-".date('Ymd', strtotime(Carbon::now('Asia/Manila'))).'-'.$insuranceCode;
				$insurance->insurance_co = $data['insurance_co'];
				$insurance->description = $data['description'];
				$insurance->policy_number = $data['policy_number'];
				$insurance->insurance_coverage = $data['insurance_coverage'];
				$insurance->date_issued = $data['date_issued'];
				$insurance->expiration_date = $data['expiration_date'];
				$insurance->applicable_premium = $data['applicable_premium'];
				$insurance->insurance_agent = $data['insurance_agent'];
				$insurance->email = $data['email'];
				$insurance->mobile_number = $data['mobile_number'];
				$insurance->telephone_number = $data['telephone_number'];
				$insurance->save();

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

		$data = Input::post();

		$transaction = DB::transaction(function($data) use($data){
		try{
				DB::table('banks')
				->where('bank_code', $data['bank_code'])
				->update([
					'bank_name' => $data['bank_name'],
					'branch' => $data['branch'],
					'manager' => $data['manager'],
					'manager_email' => $data['manager_email'],
					'mobile_number' => $data['mobile_number'],
					'telephone_number' => $data['telephone_number']
				]);

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