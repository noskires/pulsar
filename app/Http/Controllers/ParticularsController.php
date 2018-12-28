<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use DB;
use App\Particular;
use App\Supplier;
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

		$particulars = DB::table('particulars');

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

		// return $request->all();
		$transaction = DB::transaction(function($data) use($data){
		try{

				$particular = new Particular;

			    $particularCode = (str_pad(($particular->get()->count() + 1), 4, "0", STR_PAD_LEFT));

				$particular->particular_code = "PAR".$particularCode;
				$particular->description = $data['description'];
				$particular->save();

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
		$data['particular_code']   = $request->input('particular_code');
		$data['description']   = $request->input('description');

	    $transaction = DB::transaction(function($data) use($data){
	    try{
	      
	          DB::table('particulars')
	            ->where('particular_code', $data['particular_code'])
	            ->update([
	              'description' => $data['description'],
	            ]);

	        return response()->json([
	            'status' => 200,
	            'data' => $data['particular_code'],
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