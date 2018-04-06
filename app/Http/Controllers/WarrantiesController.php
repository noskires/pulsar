<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use DB;
use App\Organization;
use App\Warranty;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class WarrantiesController extends Controller {
   // public function index(){
   //    return view('employee.index');
   // }

  public function warranties(Request $request){

    $data = array(
      'tag'=>$request->input('tag'),
    );

  	$warranties = DB::table('warranties');

    if ($data['tag']){
      $warranties = $warranties->where('asset_tag', $data['tag']);
    }

    $warranties = $warranties->get();

    return response()-> json([
        'status'=>200,
        'data'=>$warranties,
        'message'=>''
    ]);
  }

  public function save(Request $request){

    $data = array();

    $data['expiry_date'] = date('Y-m-d', strtotime($request->input('expiryDate')));
    $data['asset_tag']   = $request->input('asset_tag');
    $data['monthLength'] = $request->input('monthLength');
    $data['description'] = $request->input('description');

    $transaction = DB::transaction(function($data) use($data){
    try{

        $warranty = new Warranty;

    //     $joCode = (str_pad(($jo->where('created_at', 'like', '%'.Carbon::now('Asia/Manila')->toDateString().'%')
    //     ->get()->count() + 1), 4, "0", STR_PAD_LEFT));

        // $warranty->job_order_code = "JO-".date('Ymd', strtotime(Carbon::now('Asia/Manila')))."-".$joCode;
        $warranty->warranty_code = '001';
        $warranty->asset_tag = $data['asset_tag'];
        $warranty->description = $data['description'];
        $warranty->expiry_date = $data['expiry_date'];
        $warranty->save();

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
}