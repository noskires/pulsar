<?php
namespace App\Http\Controllers\JobOrder;
use Illuminate\Http\Request;

use DB;
use App\Employee;
use App\Project;
use App\JobOrder;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class JobOrdersController extends Controller {

  public function index(){
    return view('layout.index');
  }

  public function job_orders(){
  	$job_orders = DB::table('job_orders')->get();
    return response()-> json([
      'status'=>200,
      'data'=>$job_orders,
      'message'=>''
    ]);
  }

  public function save(Request $request){
    
    $data = array();
    $data['orderDate'] = date('Y-m-d', strtotime($request->input('orderDate')));
    $data['jobOrderCode'] = 'code123';
    $data['purpose'] = $request->input('purpose');
    $data['assetTag'] = $request->input('assetTag');
    
    $transaction = DB::transaction(function($data) use($data){
    // try{

        $jo = new JobOrder;

        $joCode = (str_pad(($jo->where('created_at', 'like', '%'.Carbon::now('Asia/Manila')->toDateString().'%')
        ->get()->count() + 1), 4, "0", STR_PAD_LEFT));

        $jo->job_order_code = "JO-".date('Ymd', strtotime(Carbon::now('Asia/Manila')))."-".$joCode; //$data['jobOrderCode'];
        $jo->job_order_date = $data['orderDate'];
        $jo->request_purpose = $data['purpose'];
        $jo->asset_tag = $data['assetTag'];
        $jo->save();

        // $assetCopy = DB::table('Assets')->where('tag', $asset->tag)->first();
        // $assetCopy->asset_id;

        // $log = new Log;
        // $log->log_code = $assetCopy->asset_id;
        // $log->log_desc = "Added new asset";
        // $log->user_id = Auth::user()->id;
        // $log->save();

        return response()->json([
            'status' => 200,
            'data' => 'null',
            'message' => 'Successfully saved.'
        ]);

      // }
      // catch (\Exception $e) 
      // {
      //     return response()->json([
      //       'status' => 500,
      //       'data' => 'null',
      //       'message' => 'Error, please try again!'
      //   ]);
      // }
    });

    return $transaction;
  }

  public function sampleDate()
  {
    // echo Carbon::now('Asia/Manila');
    $jo = new JobOrder;
    // echo  $jo->get()->count();

    // echo date('Ymd', strtotime(Carbon::now('Asia/Manila')));
   echo  $count = (str_pad(($jo->where('created_at', 'like', '%'.Carbon::now('Asia/Manila')->toDateString().'%')->get()->count() + 1), 4, "0", STR_PAD_LEFT));
  }
}