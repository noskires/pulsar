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
                // ->select('warranty_code',
                // 'asset_tag',
                // 'effective_date',
                // 'expiry_date',
                // 'description',
                // DB::raw(Carbon::parse('effective_date')->diffInMonths(expiry_date) as date_acquired")
                // );

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

    $data['effective_date'] = date('Y-m-d', strtotime($request->input('effectiveDate')));
    $data['end_date'] = date('Y-m-d', strtotime($request->input('endDate')));
    $data['asset_tag']   = $request->input('asset_tag');
    $data['monthLength'] = $request->input('monthLength');
    $data['description'] = $request->input('description');

    $transaction = DB::transaction(function($data) use($data){
    try{

        // $asset = DB::table('Assets as a')
        //     ->select('date_acquired')
        //     ->where('tag', $data['asset_tag'])
        //     ->first();

        $warranty = new Warranty;
        $warrantyCode = (str_pad(($warranty->where('created_at', 'like', '%'.Carbon::now('Asia/Manila')->toDateString().'%')
        ->get()->count() + 1), 4, "0", STR_PAD_LEFT));

        // $warranty->warranty_code = "WRNTY-".date('Ymd', strtotime(Carbon::now('Asia/Manila')))."-".$warrantyCode; 
        $warranty->warranty_code = "WRNTY-".date('YmdHis', strtotime(Carbon::now('Asia/Manila')))."-".$warrantyCode; 
        $warranty->asset_tag = $data['asset_tag'];
        $warranty->description = $data['description'];
        $warranty->effective_date = $data['effective_date'];
        // $warranty->end_date = Carbon::parse($asset->date_acquired)->addMonths(80)->subDay();
        $warranty->end_date = $data['end_date'];
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