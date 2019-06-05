<?php
namespace App\Http\Controllers\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use DB;
use Auth;
use App\Voucher;
use App\Bank;
use App\Insurance;
use App\InsuranceItem;
use App\AssetRegistration;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class AssetRegistrationsController extends Controller {
	
	public function index(){
		return view('layout.index');
	}

	public function assetRgstns(Request $request){

		$data = array(
			'assetRegistrationCode'=>$request->input('assetRegistrationCode'),
		);

		$assetRgstn = DB::table('asset_registrations as asset_registration');

		if ($data['assetRegistrationCode']){
			$assetRgstn = $assetRgstn->where('asset_reg_code', $data['assetRegistrationCode']);
		}

		$assetRgstn = $assetRgstn->get();

		return response()-> json([
			'status'=>200,
			'data'=>$assetRgstn,
			'message'=>''
		]);
	}

	public function save(Request $request){

		$data = Input::post();

		$transaction = DB::transaction(function($data) use($data){
		try{
				$assetRgstn = new AssetRegistration;

			  $assetRegCode = (str_pad(($assetRgstn->where('created_at', 'like', '%'.Carbon::now('Asia/Manila')->toDateString().'%')
			    ->get()->count() + 1), 4, "0", STR_PAD_LEFT));

				$assetRgstn->asset_reg_code = "ASSET-REG-".date('YmdHis', strtotime(Carbon::now('Asia/Manila'))).'-'.$assetRegCode;
				$assetRgstn->renewal_date = date('Y-m-d', strtotime($data['renewal_date']));
				$assetRgstn->renewal_status = $data['renewal_status'];
				$assetRgstn->asset_code = $data['asset_code'];
				// $assetRgstn->OR_number = $data['or_number'];
				// $assetRgstn->OR_date = $data['or_date'];
				// $assetRgstn->MV_file_number = $data['mv_file_number'];
				$assetRgstn->changed_by = Auth::user()->email;
				$assetRgstn->save();

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

				$registration = AssetRegistration::where("asset_reg_code", $data["asset_reg_code"])->first();
				$registration->renewal_date 		= date('Y-m-d', strtotime($data['renewal_date']));
				$registration->renewal_status 	= $data['renewal_status'];
				$registration->asset_code 			= $data['asset_code'];
				$registration->OR_number 				= $data['OR_number'];
				$registration->OR_date 					= date('Y-m-d', strtotime($data['OR_date']));
				$registration->MV_file_number 	= $data['MV_file_number'];
				$registration->changed_by 			= Auth::user()->email;
				$registration->save();

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


  	public function remove_insurance_items(Request $request){

	    $data = Input::post();

	    $transaction = DB::transaction(function($data) use($data){
	    try{

			InsuranceItem::where('insurance_item_code', $data['insurance_item_code'])->firstOrFail()->delete();

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