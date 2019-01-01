<?php
namespace App\Http\Controllers\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Auth;
use DB;
use App\Client;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ClientsController extends Controller {
	
	public function index(){
		return view('layout.index');
	}

	public function clients(Request $request){

		$data = array(
			'clientCode'=>$request->input('clientCode'),
		);

		$clients = DB::table('clients');

		if ($data['clientCode']){
			$clients = $clients->where('client_code', $data['clientCode']);
		}

		$clients = $clients->get();

		return response()-> json([
			'status'=>200,
			'data'=>$clients,
			'message'=>''
		]);
	}

	public function save(Request $request){

		$data = array();
		$data['client_name']   = $request->input('client_name');
		$data['client_address']   = $request->input('client_address');

		// return $request->all();
		$transaction = DB::transaction(function($data) use($data){
		try{

				$client = new Client;

			    $clientCode = (str_pad(($client->get()->count() + 1), 4, "0", STR_PAD_LEFT));


				$client->client_code = "CLIENT-".$clientCode."-".date('YmdHis', strtotime(Carbon::now('Asia/Manila')));

				// $client->client_code = "CLIENT".$clientCode;
				$client->client_name = $data['client_name'];
				$client->client_address = $data['client_address'];
				$client->changed_by        = Auth::user()->email;
				$client->save();

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
		$data['client_code']   = $request->input('client_code');
		$data['client_name']   = $request->input('client_name');
		$data['client_address']   = $request->input('client_address');

	    $transaction = DB::transaction(function($data) use($data){
	    try{
	      
	          DB::table('clients')
	            ->where('client_code', $data['client_code'])
	            ->update([
	              'client_name' => $data['client_name'],
	              'client_address' => $data['client_address'],
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
	            'data' => 'null',
	            'message' => 'Error, please try again!'
	        ]);
	      }
    	});
    	return $transaction;
	}
}