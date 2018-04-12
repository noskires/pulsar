<?php
namespace App\Http\Controllers\Supply;
use Illuminate\Http\Request;

use DB;
use App\Supply;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class SuppliesController extends Controller {
public function index(){
  return view('layout.index');
}

  public function supplies(Request $request){

    $data = array(
      'supplyCode'=>$request->input('supplyCode'),
    );

  	$supplies = DB::table('supplies');

    if ($data['supplyCode']){
      $supplies = $supplies->where('supply_code', $data['supplyCode']);
    }

    $supplies = $supplies->get();

    return response()-> json([
        'status'=>200,
        'data'=>$supplies,
        'message'=>''
    ]);
  }

  public function save(Request $request){

    $data = array();

    $data['supplyName'] = $request->input('supplyName');
    $data['description'] = $request->input('description');
    $data['category']   = $request->input('category');
    $data['stockUnit'] = $request->input('stockUnit');
    $data['reOrderLevel'] = $request->input('reOrderLevel');

    $transaction = DB::transaction(function($data) use($data){
    try{

        $supply = new Supply;

        $supCode = (str_pad(($supply->where('created_at', 'like', '%'.Carbon::now('Asia/Manila')->toDateString().'%')
        ->get()->count() + 1), 4, "0", STR_PAD_LEFT));

        $supply->supply_code = "SUP-".date('Ymd', strtotime(Carbon::now('Asia/Manila')))."-".$supCode;
        $supply->supply_name = $data['supplyName'];
        $supply->description = $data['description'];
        $supply->category_code = $data['category'];
        $supply->stock_unit = $data['stockUnit'];
        $supply->re_order_level = $data['reOrderLevel'];
        $supply->save();

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