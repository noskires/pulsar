<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use DB;
use Auth;
use App\Asset;
use App\Asset_category;
use App\Employee;
use App\Log;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AssetsController extends Controller {
  	public function index(){
    	return view('layout.index');
   	}

    public function asset_categories(){
      	$asset_categories = DB::table('Asset_categories as ac')->where('asset_category','=','Asset')->get();
        return response()-> json([
            'status'=>200,
            'data'=>$asset_categories,
            'message'=>''
        ]);
    }

    public function assets(Request $request){

        $data = array(
            'tag'=>$request->input('tag'),
        );

      	$asset = DB::table('Assets as a')
      			->select('*')
      			-> leftjoin('Employees as e','e.employee_id','=','a.assign_to');

      	if ($data['tag']){ 
      		$asset = $asset->where('tag', $data['tag']);
      	}

      	$asset = $asset->get();

        return response()-> json([
            'status'=>200,
            'data'=>$asset,
            'message'=> ''
        ]);
    }

    public function methods(){

      	$methods = DB::table('methods')->get();

        return response()-> json([
            'status'=>200,
            'data'=>$methods
        ]);
    }

    public function asset_tag(Request $request)
    {
    	$assetTag = $request->input('categoryCode')."-".date('Ymd', strtotime($request->input('dateAcquired')))."-".$request->input('assetID');

    	return response()-> json([
            'status'=>200,
            'data'=>$assetTag
        ]);
    }

    public function save(Request $request){
        
        $data = array();

       	$data['assetName'] = $request->input('assetName');
       	$data['assetID'] = $request->input('assetID');
       	$data['modelnumber'] = $request->input('modelnumber');
       	$data['categoryCode'] = $request->input('categoryCode');
       	$data['description'] = $request->input('description');
       	$data['brand'] = $request->input('brand');
       	$data['dateAquired'] = $request->input('dateAquired');
       	$data['acquisitionCost'] = $request->input('acquisitionCost');
       	$data['dateAcquired'] = date('Y-m-d', strtotime($request->input('dateAcquired')));
       	$data['plateNumber'] = $request->input('plateNumber');
       	$data['engineNumber'] = $request->input('engineNumber');
       	$data['assignTo'] = $request->input('assignTo');
       	$data['fundSource'] = $request->input('fundSource');
       	$data['costCenter'] = $request->input('costCenter');
       	$data['depreciableCost'] = $request->input('depreciableCost');
       	$data['salvageValue'] = $request->input('salvageValue');
       	$data['method'] = $request->input('method');
       
        $transaction = DB::transaction(function($data) use($data){
        	// try{

        		// $assetCheck = DB::table('Assets')->where('tag', $asset->tag)->first();
	            $asset = new Asset;
	            $asset->tag = $data['categoryCode']."-".date('Ymd', strtotime($data['dateAcquired']))."-".$data['assetID'];
	            $asset->name = $data['assetName'];
	            $asset->code = $data['assetID'];
	            $asset->model = $data['modelnumber'];
	            $asset->category = $data['categoryCode'];
	            $asset->description = $data['description'];
	            $asset->brand = $data['brand'];
	            $asset->date_acquired = $data['dateAcquired'];
	            $asset->acquisition_cost = $data['acquisitionCost'];
	            $asset->plate_no = $data['plateNumber'];
	            $asset->engine_no = $data['engineNumber'];
	            $asset->assign_to = $data['assignTo'];
	            $asset->fund_source = $data['fundSource'];
	            $asset->cost_center = $data['costCenter'];
	            $asset->depreciable_cost = $data['depreciableCost'];
	            $asset->salvage_value = $data['salvageValue'];
	            $asset->method_id = $data['method'];
	            $asset->project_id = 1;
	            $asset->save();

	            $assetCopy = DB::table('Assets')->where('tag', $asset->tag)->first();
	            $assetCopy->asset_id;

	            $log = new Log;
	            $log->log_code = $assetCopy->asset_id;
	            $log->log_desc = "Added new asset";
	            $log->user_id = Auth::user()->id;
	            $log->save();

	            return response()->json([
	                'status' => 200,
	                'data' => 'null',
	                'message' => 'Successfully saved.'
	            ]);
      //       } 
      //       catch (\Exception $e) 
      //       {
		    // 	return response()->json([
	     //            'status' => 500,
	     //            'data' => 'null',
	     //            'message' => 'Error, please try again!'
	     //        ]);
		    // }
        });

        return $transaction;
    }
}