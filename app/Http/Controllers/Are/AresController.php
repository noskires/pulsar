<?php
namespace App\Http\Controllers\Are;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use DB;
use App\Voucher;
use App\Bank;
use App\Insurance;
use App\InsuranceItem;
use App\Are;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class AresController extends Controller {
	
	public function index(){
		return view('layout.index');
	}

	public function ares(Request $request){

		$data = array(
			'areCode'=>$request->input('areCode'),
		);

		$ares = DB::table('ares AS a')
					->select(
                      'a.are_code',
                      'e.employee_code',
                      DB::raw('CONCAT(trim(CONCAT(e.lname," ",COALESCE(e.affix,""))),", ", COALESCE(e.fname,"")," ", COALESCE(e.mname,"")) as employee_name'),
                      'e.department AS department_code',
                      'dep.org_name AS department',
                      'e.division AS division_code',
                      'div.org_name AS division',
                      'e.unit AS unit_code',
                      'unit.org_name AS unit',
                      'a.created_at'
                    )
                    ->leftjoin('employees as e','e.employee_code','=','a.employee_code')
                    ->leftjoin('organizations as dep','dep.org_code','=','e.department')
                    ->leftjoin('organizations as div','div.org_code','=','e.division')
                    ->leftjoin('organizations as unit','unit.org_code','=','e.unit');

		if ($data['areCode']){
			$ares = $ares->where('are_code', $data['areCode']);
		}

		$ares = $ares->get();

		return response()-> json([
			'status'=>200,
			'data'=>$ares,
			'message'=>''
		]);
	}

	public function save(Request $request){

		$data = Input::post();

		$transaction = DB::transaction(function($data) use($data){
		// try{
				$are = new Are;

				$areCode = (str_pad(($are->where('created_at', 'like', '%'.Carbon::now('Asia/Manila')->toDateString().'%')
			    ->get()->count() + 1), 4, "0", STR_PAD_LEFT));
			    
				// $areCode = (str_pad(($are->whereDate('created_at', 'like', Carbon::today()->toDateString())
			 //    ->get()->count() + 1), 4, "0", STR_PAD_LEFT));

				$are->are_code = "ARE-".date('Ymd', strtotime(Carbon::now('Asia/Manila'))).'-'.$areCode;
				// $are->are_code = "ARE-".date('Ymd', strtotime(Carbon::now('Asia/Manila'))).'-'.$areCode;
				$are->employee_code = $data['employeeCode'];
				$are->save();

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

	// public function update(Request $request){

	// 	$data = Input::post();

	// 	$transaction = DB::transaction(function($data) use($data){
	// 	try{
	// 			DB::table('insurance')
	// 			->where('insurance_code', $data['insurance_code'])
	// 			->update([
	// 				'insurance_co' => $data['insurance_co'],
	// 				'description' => $data['description'],
	// 				'policy_number' => $data['policy_number'],
	// 				'date_issued' => $data['date_issued'],
	// 				'insurance_coverage' => $data['insurance_coverage'],
	// 				'expiration_date' => $data['expiration_date'],
	// 				'applicable_premium' => $data['applicable_premium'],
	// 				'insurance_agent' => $data['insurance_agent'],
	// 				'email' => $data['email'],
	// 				'mobile_number' => $data['mobile_number'],
	// 				'telephone_number' => $data['telephone_number']
	// 			]);

	// 			return response()->json([
	// 				'status' => 200,
	// 				'data' => 'null',
	// 				'message' => 'Successfully saved.'
	// 			]);
	// 		}
	// 		catch (\Exception $e)
	// 		{
	// 			return response()->json([
	// 				'status' => 500,
	// 				'data' => 'null',
	// 				'message' => 'Error, please try again!'
	// 			]);
	// 		}
	// 	});

	// 	return $transaction;
	// }

	// public function insuranceItems(Request $request){

	//     $data = array(
	//       'insuranceCode'=>$request->input('insuranceCode'),
	//       'insuranceItemCode'=>$request->input('insuranceItemCode'),
	//       'assetCode'=>$request->input('assetCode'),
	//       'insuranceItemStatus'=>$request->input('insuranceItemStatus'),
	//     );

	//     $insuranceItems = DB::table('assets as a')
	//               // ->select(
	//               //   'ii.insurance_item_code',
	//               //   'ii.insurance_code',
	//               //   'ii.asset_code'
	//               // )
	//             ->leftjoin('insurance_items as ii','ii.asset_code','=','a.tag')
	//             ->leftjoin('insurance as i','i.insurance_code','=','ii.insurance_code');

	//     if ($data['insuranceCode']){
	//       $insuranceItems = $insuranceItems->where('ii.insurance_code', $data['insuranceCode']);
	//     }

	//     if ($data['insuranceItemCode']){
	//       $insuranceItems = $insuranceItems->where('ii.insurance_item_code', $data['insuranceItemCode']);
	//     }

	//     if ($data['assetCode']){
	//       $insuranceItems = $insuranceItems->where('ii.asset_code', $data['assetCode']);
	//     }

	//     if ($data['insuranceItemStatus']==1){
	//       $insuranceItems = $insuranceItems->whereNotNull('ii.insurance_item_code');
	//     }

	//     if ($data['insuranceItemStatus']==2){
	//       $insuranceItems = $insuranceItems->whereNull('ii.insurance_item_code');
	//     }

	//     $insuranceItems = $insuranceItems->get();

	//     return response()-> json([
	//       'status'=>200,
	//       'data'=>$insuranceItems,
	//       'message'=>''
	//     ]);

	// }

	// public function save_insurance_items(Request $request){

	//     $data = Input::post();

	//     $transaction = DB::transaction(function($data) use($data){
	//     try{

	//         // for($i = 0; $i < count($data); $i++) {
	// 		$insurance            = new InsuranceItem;

	// 		$insuranceItemCode = (str_pad(($insurance->where('created_at', 'like', '%'.Carbon::now('Asia/Manila')->toDateString().'%')
	// 		->get()->count() + 1), 4, "0", STR_PAD_LEFT));
	// 		$insurance->insurance_item_code = "INSUITM-".date('Ymd', strtotime(Carbon::now('Asia/Manila')))."-".$insuranceItemCode;
	// 		$insurance->insurance_code = $data['insurance_code'];
	// 		$insurance->asset_code     = $data['asset_code'];
	// 		$insurance->save(); // fixed typo

	//         // }

	//         return response()->json([
	//             'status' => 200,
	//             'data' => 'null',
	//             'message' => 'Successfully saved.'
	//         ]);

	//       }
	//       catch (\Exception $e) 
	//       {
	//           return response()->json([
	//             'status' => 500,
	//             'data' => 'null',
	//             'message' => 'Error, please try again!'
	//         ]);
	//       }
	//     });

 //   	 	return $transaction;
 //  	}

 //  	public function remove_insurance_items(Request $request){

	//     $data = Input::post();

	//     $transaction = DB::transaction(function($data) use($data){
	//     try{

	//         // for($i = 0; $i < count($data); $i++) {
	// 		$insurance            = new InsuranceItem;

	// 		DB::table('insurance_items')->where('insurance_item_code', $data['insurance_item_code'])->delete();

	//         // }

	//         return response()->json([
	//             'status' => 200,
	//             'data' => 'null',
	//             'message' => 'Successfully deleted.'
	//         ]);

	//       }
	//       catch (\Exception $e) 
	//       {
	//           return response()->json([
	//             'status' => 500,
	//             'data' => 'null',
	//             'message' => 'Error, please try again!'
	//         ]);
	//       }
	//     });

 //   	 	return $transaction;
 //  	}
}