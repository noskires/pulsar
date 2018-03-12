<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Assets;
use App\Asset_categories;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AssetsController extends Controller {
  	public function index(){
    	return view('asset.index');
   	}

    public function asset_categories(){
      	$asset_categories = DB::table('Asset_categories as ac')->where('asset_category','=','Asset')->get();
        return response()-> json([
            'status'=>200,
            'data'=>$asset_categories,
            'message'=>''
        ]);
    }

    public function assets(){
      	$asset = DB::table('Assets')->get();
        return response()-> json([
            'status'=>200,
            'data'=>$asset,
            'message'=>''
        ]);
    }

    public function save(Request $request){
        // $validator = Validator::make($request->all(),[
        //     'title'=> 'required',
        //     'description'=> 'required'
        // ]);

        // if ($validator-> fails()) {
        //     return response()->json([
        //         'status'=> 403,
        //         'data'=>'',
        //         'message'=>'Unable to save.'
        //     ]);
        // }

        // $self = $request->session()->get('student_id');
        
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
            $asset = new Assets;
            $asset->tag = $data['categoryCode']."-".date('Ymd', strtotime($data['dateAcquired']))."-".$data['assetID'];
            $asset->name = $data['assetName'];
            $asset->code = $data['assetID'];
            $asset->model = $data['modelnumber'];
            $asset->category = $data['categoryCode'];
            $asset->description = $data['description'];
            $asset->brand = $data['brand'];
            $asset->date_aquired = $data['dateAcquired'];
            $asset->acquisition_cost = $data['acquisitionCost'];
            $asset->plate_no = $data['plateNumber'];
            $asset->engine_no = $data['engineNumber'];
            $asset->assign_to = $data['assignTo'];
            $asset->fund_source = $data['fundSource'];
            $asset->cost_center = $data['costCenter'];
            $asset->depreciable_cost = $data['depreciableCost'];
            $asset->salvage_value = $data['salvageValue'];
            $asset->method = $data['method'];

            $asset->save();

            // $logsData = array(
            //     'student_id'=>$data['student_id'],
            //     'forum_id'=>$forum->forum_id,
            //     'logs_type'=>'THREAD'
            // );
            // $this->logsForSocial($logsData);
            
            // // is posted 5
            // $achForumDet = array(
            //     'student_id'=>$data['student_id']
            // );
            
            // $this->isPosted5Forum($achForumDet);

            return response()->json([
                'status' => 200,
                'data' => 'null',
                'message' => 'Successfully saved.'
            ]);
        });

        return $transaction;
      
    }
}