<?php
namespace App\Http\Controllers\Supplier;
use Illuminate\Http\Request;

use DB;
use App\Supplier;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class SuppliersController extends Controller {
	public function index(){
		return view('layout.index');
	}

	public function suppliers(Request $request){

		$data = array(
			'supplierCode'=>$request->input('supplierCode'),
		);

		$suppliers = DB::table('suppliers');

		if ($data['supplierCode']){
			$suppliers = $suppliers->where('supplier_code', $data['supplierCode']);
		}

		$suppliers = $suppliers->get();

		return response()-> json([
			'status'=>200,
			'data'=>$suppliers,
			'message'=>''
		]);
	}

	public function save(Request $request){

		$data = array();
		$data['supplier_name']   = $request->input('supplier_name');
		$data['supplier_owner']   = $request->input('supplier_owner');
		$data['dti_expiry_date'] = date('Y-m-d', strtotime($request->input('dti_expiry_date')));
		$data['business_permit_no']   = $request->input('business_permit_no');
		$data['business_permit_expiry_date'] = date('Y-m-d', strtotime($request->input('business_permit_expiry_date')));
		$data['bir_no']   = $request->input('bir_no');
		$data['contact_no']   = $request->input('contact_no');
		$data['address']   = $request->input('address');

		// return $request->all();
		$transaction = DB::transaction(function($data) use($data){
		try{

				$supplier = new Supplier;

			    $supplierCode = (str_pad(($supplier->get()->count() + 1), 4, "0", STR_PAD_LEFT));

				$supplier->supplier_code = "SUPLR-".date('Ymd', strtotime(Carbon::now('Asia/Manila')))."-".$supplierCode;
				$supplier->supplier_name = $data['supplier_name'];
				$supplier->supplier_owner = $data['supplier_owner'];
				$supplier->dti_expiry_date = $data['dti_expiry_date'];
				$supplier->business_permit_no = $data['business_permit_no'];
				$supplier->business_permit_expiry_date = $data['business_permit_expiry_date'];
				$supplier->bir_no = $data['bir_no'];
				$supplier->contact_no = $data['contact_no'];
				$supplier->address = $data['address'];
				$supplier->save();

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
		$data['supplier_code']   = $request->input('supplier_code');
		$data['supplier_name']   = $request->input('supplier_name');
		$data['supplier_owner']   = $request->input('supplier_owner');
		$data['dti_expiry_date'] = date('Y-m-d', strtotime($request->input('dti_expiry_date')));
		$data['business_permit_no']   = $request->input('business_permit_no');
		$data['business_permit_expiry_date'] = date('Y-m-d', strtotime($request->input('business_permit_expiry_date')));
		$data['bir_no']   = $request->input('bir_no');
		$data['contact_no']   = $request->input('contact_no');
		$data['address']   = $request->input('address');

	    $transaction = DB::transaction(function($data) use($data){
	    try{
	      
	          DB::table('suppliers')
	            ->where('supplier_code', $data['supplier_code'])
	            ->update([
	              'supplier_name' => $data['supplier_name'],
	              'supplier_owner' => $data['supplier_owner'],
	              'dti_expiry_date' => $data['dti_expiry_date'],
	              'business_permit_no' => $data['business_permit_no'],
	              'business_permit_expiry_date' => $data['business_permit_expiry_date'],
	              'bir_no' => $data['bir_no'],
	              'contact_no' => $data['contact_no'],
	              'address' => $data['address']
	            ]);

	        return response()->json([
	            'status' => 200,
	            'data' => $data['supplier_code'],
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