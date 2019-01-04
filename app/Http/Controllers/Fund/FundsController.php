<?php
namespace App\Http\Controllers\Fund;
use Illuminate\Http\Request;

use DB;
use Auth;
use App\Fund;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class FundsController extends Controller {
	public function index(){
		return view('layout.index');
	}

	public function funds(Request $request){

		$data = array(
			'fundCode'=>$request->input('fundCode'),
		);

		$funds = DB::table('funds');

		if ($data['fundCode']){
			$funds = $funds->where('fund_code', $data['fundCode']);
		}

		$funds = $funds->get();

		return response()-> json([
			'status'=>200,
			'data'=>$funds,
			'message'=>''
		]);
	}

	public function save(Request $request){

		$data = array();
		$data['fund_name']   = $request->input('fund_name');

		// return $request->all();
		$transaction = DB::transaction(function($data) use($data){
		// try{
				$fund = new Fund;

			    $fundCode = (str_pad(($fund->get()->count() + 1), 4, "0", STR_PAD_LEFT));

				$fund->fund_code = "FUND".$fundCode;
				$fund->fund_name = $data['fund_name'];
				$fund->changed_by = Auth::user()->email;
				$fund->save();

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
		$data['fund_code']   = $request->input('fund_code');
		$data['fund_name']   = $request->input('fund_name');

	    $transaction = DB::transaction(function($data) use($data){
	    try{
	      
	          DB::table('funds')
	            ->where('fund_code', $data['fund_code'])
	            ->update([
	              'fund_name' => $data['fund_name'],
	            ]);

	        return response()->json([
	            'status' => 200,
	            'data' => null,
	            'message' => 'Successfully saved.'
	        ]);

	      }
	      catch (\Exception $e) 
	      {
	          return response()->json([
	            'status' => 500,
	            'data' => null,
	            'message' => 'Error, please try again!'
	        ]);
	      }
    	});
    	return $transaction;
	}
}