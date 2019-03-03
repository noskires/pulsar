<?php
namespace App\Http\Controllers\Voucher;
use Illuminate\Http\Request;

use DB;
use App\Voucher;
use App\Particular;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ParticularsController extends Controller {
	public function index(){
		return view('layout.index');
	}

	public function particulars(Request $request){

		$data = array(
			'particularCode'=>$request->input('particularCode'),
		);

		$particulars = DB::table('particulars as p')
				->select(
                'p.particular_code',
                'p.description'
              );

		if ($data['particularCode']){
			$particulars = $particulars->where('particular_code', $data['particularCode']);
		}

		$particulars = $particulars->get();

		return response()-> json([
			'status'=>200,
			'data'=>$particulars,
			'message'=>''
		]);
	}

	public function save(Request $request){

		$data = array();

		$data['description']   = $request->input('description');

		$transaction = DB::transaction(function($data) use($data){
		// try{

				$particular = new Particular;

			    $particularCode = (str_pad(($particular->where('created_at', 'like', '%'.Carbon::now('Asia/Manila')->toDateString().'%')
			    ->get()->count() + 1), 4, "0", STR_PAD_LEFT));

				$particular->particularCode = "DV-".date('YmdHis', strtotime(Carbon::now('Asia/Manila')))."-".$particularCode;
				$particular->description = $data['description'];
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