<?php
namespace App\Http\Controllers\Are;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use DB;
use Auth;
use App\Are;
use App\AreItem;
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

				// $are->are_code = "ARE-".date('Ymd', strtotime(Carbon::now('Asia/Manila')))."-".date('His', strtotime(Carbon::now('Asia/Manila')));
				$are->are_code = "ARE-".date('YmdHis', strtotime(Carbon::now('Asia/Manila')))."-".$areCode;
				$are->employee_code = $data['employeeCode'];
				// $are->asset_code = $data['assetCode'];
				// $are->show_status = 1;
				$are->changed_by = Auth::user()->email;
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

	public function areItems(Request $request){

		$data = array(
			'areItemCode'=>$request->input('areItemCode'),
			'areCode'=>$request->input('areCode'),
			'assetCode'=>$request->input('assetCode'),
		);

		$ares = DB::table('are_items AS are_item')
                ->leftjoin('assets AS asset','asset.asset_code','=','are_item.asset_code');

        if ($data['areItemCode']){
			$ares = $ares->where('are_item.are_item_code', $data['areItemCode']);
		}

		if ($data['areCode']){
			$ares = $ares->where('are_item.are_code', $data['areCode']);
		}

		if ($data['assetCode']){
			$ares = $ares->where('are_item.asset_code', $data['assetCode']);
		}

		$ares = $ares->get();

		return response()-> json([
			'status'=>200,
			'data'=>$ares,
			'message'=>''
		]);
	}

	public function save_are_items(Request $request){

	    $data = Input::post();

	    // return $data;

	    $transaction = DB::transaction(function($data) use($data){
			try{
				$areItem = new AreItem;
				$areCode = (str_pad(($areItem->where('created_at', 'like', '%'.Carbon::now('Asia/Manila')->toDateString().'%')
			    ->get()->count() + 1), 4, "0", STR_PAD_LEFT));

				$areItem->are_item_code = "AREITM-".date('Ymd', strtotime(Carbon::now('Asia/Manila')))."-".date('His', strtotime(Carbon::now('Asia/Manila')));
				$areItem->are_code = $data['are_code'];
				$areItem->asset_code = $data['asset_code'];
				$areItem->started_at = date('Y-m-d', strtotime($data['started_at']));
				$areItem->ended_at = "9999-12-31";
				$areItem->show_status = 1;
				$areItem->changed_by = Auth::user()->email;
				$areItem->save();

				return response()->json([
				    'status' => 200,
				    'data' => $data,
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