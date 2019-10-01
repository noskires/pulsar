<?php
namespace App\Http\Controllers\Insurance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use DB;
use Auth;
use App\Voucher;
use App\Bank;
use App\Insurance;
use App\InsuranceItem;
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

		$insurance = DB::table('insurance as i')
                    ->select(
                      'i.insurance_id',
                      'i.insurance_code',
                      'i.insurance_co',
                      'i.description',
                      'i.policy_number',
                      'i.insurance_coverage',
                      DB::raw('DATE_FORMAT(i.date_issued, "%m/%d/%Y") as date_issued'),
                      DB::raw('DATE_FORMAT(i.expiration_date, "%m/%d/%Y") as expiration_date'),
                      'i.applicable_premium',
                      'i.insurance_agent',
                      'i.email',
                      'i.mobile_number', 
					  'i.telephone_number',
					  DB::raw('DATEDIFF(expiration_date, NOW()) as expires_in')
                    );

		if ($data['insuranceCode']){
			$insurance = $insurance->where('insurance_code', $data['insuranceCode']);
		}

		$insurance = $insurance->get();

		return response()-> json([
			'status'=>200,
			'data'=>$insurance,
			'message'=>''
		]);
	}

	public function save(Request $request){

		$data = Input::post();

		$transaction = DB::transaction(function($data) use($data){
		try{
				$insurance = new Insurance;

			    $insuranceCode = (str_pad(($insurance->where('created_at', 'like', '%'.Carbon::now('Asia/Manila')->toDateString().'%')
			    ->get()->count() + 1), 4, "0", STR_PAD_LEFT));

				$insurance->insurance_code = "INSU-".date('YmdHis', strtotime(Carbon::now('Asia/Manila'))).'-'.$insuranceCode;
				$insurance->insurance_co = $data['insurance_co'];
				$insurance->description = $data['description'];
				$insurance->policy_number = $data['policy_number'];
				$insurance->insurance_coverage = $data['insurance_coverage'];
				$insurance->date_issued = date('Y-m-d', strtotime($data['date_issued'])); 
				$insurance->expiration_date = date('Y-m-d', strtotime($data['expiration_date']));
				$insurance->applicable_premium = $data['applicable_premium'];
				$insurance->insurance_agent = $data['insurance_agent'];
				$insurance->email = $data['email'];
				$insurance->mobile_number = $data['mobile_number'];
				$insurance->telephone_number = $data['telephone_number'];
				$insurance->changed_by = Auth::user()->email;
				$insurance->save();

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


				$bank = Insurance::where('insurance_code', $data['insurance_code'])->first();
	            $bank->insurance_co 		= $data['insurance_co'];
	            $bank->description 			= $data['description'];
	            $bank->policy_number 		= $data['policy_number'];
	            $bank->date_issued 			= date('Y-m-d', strtotime($data['date_issued']));
	            $bank->insurance_coverage 	= $data['insurance_coverage'];
	            $bank->expiration_date 		= date('Y-m-d', strtotime($data['expiration_date']));
	            $bank->applicable_premium 	= $data['applicable_premium'];
	            $bank->insurance_agent 		= $data['insurance_agent'];
	            $bank->email 				= $data['email'];
	            $bank->mobile_number 		= $data['mobile_number'];
	            $bank->telephone_number 	= $data['telephone_number'];
	            $bank->changed_by 			= Auth::user()->email;
	            $bank->timestamps 			= true;
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

	public function insuranceItems(Request $request){

	    $data = array(
	      'insuranceCode'=>$request->input('insuranceCode'),
	      'insuranceItemCode'=>$request->input('insuranceItemCode'),
	      'assetCode'=>$request->input('assetCode'),
	      'insuranceItemStatus'=>$request->input('insuranceItemStatus'),
	    );

	    $insuranceItems = DB::table('assets as a')
	              ->select(
	                'a.asset_code',
	                'a.code',
	                'a.name',
	                'a.model',
	                'a.brand',
	                'a.category',
	                'ii.insurance_item_code',
	                'i.insurance_code',
	                'i.insurance_co',
	                'i.description',
	                'i.insurance_agent',
	                DB::raw('DATE_FORMAT(i.date_issued, "%m/%d/%Y") as date_issued'),
                    DB::raw('DATE_FORMAT(i.expiration_date, "%m/%d/%Y") as expiration_date'),
	                'i.insurance_coverage'
	              )
	            ->leftjoin('insurance_items as ii','ii.asset_code','=','a.asset_code')
	            ->leftjoin('insurance as i','i.insurance_code','=','ii.insurance_code');

	    if ($data['insuranceCode']){
	      $insuranceItems = $insuranceItems->where('ii.insurance_code', $data['insuranceCode']);
	    }

	    if ($data['insuranceItemCode']){
	      $insuranceItems = $insuranceItems->where('ii.insurance_item_code', $data['insuranceItemCode']);
	    }

	    if ($data['assetCode']){
	      $insuranceItems = $insuranceItems->where('ii.asset_code', $data['assetCode']);
	    }

	    if ($data['insuranceItemStatus']==1){
	      $insuranceItems = $insuranceItems->whereNotNull('ii.insurance_item_code');
	    }

	    if ($data['insuranceItemStatus']==2){
	      $insuranceItems = $insuranceItems->whereNull('ii.insurance_item_code');
	    }

	    $insuranceItems = $insuranceItems->get();

	    return response()-> json([
	      'status'=>200,
	      'data'=>$insuranceItems,
	      'message'=>''
	    ]);

	}

	public function save_insurance_items(Request $request){

	    $data = Input::post();

	    $transaction = DB::transaction(function($data) use($data){
	    try{

	        // for($i = 0; $i < count($data); $i++) {
			$insurance            = new InsuranceItem;

			$insuranceItemCode = (str_pad(($insurance->where('created_at', 'like', '%'.Carbon::now('Asia/Manila')->toDateString().'%')
			->get()->count() + 1), 4, "0", STR_PAD_LEFT));
			$insurance->insurance_item_code = "INSUITM-".date('YmdHis', strtotime(Carbon::now('Asia/Manila')))."-".$insuranceItemCode;
			$insurance->insurance_code = $data['insurance_code'];
			$insurance->asset_code     = $data['asset_code'];
			$insurance->changed_by = Auth::user()->email;
        	$insurance->timestamps = true;
			$insurance->save(); // fixed typo

	        // }

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