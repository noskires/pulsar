<?php
namespace App\Http\Controllers\Supply;
use Illuminate\Http\Request;

use DB;
use Auth;
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
      'quantityStatus'=>$request->input('quantityStatus'),
      'supplyCategory'=>$request->input('supplyCategory'),
      'isRepair'=>$request->input('isRepair'),
    );

  	$supplies = DB::table('supplies as s')
            ->leftjoin('stock_units as su','su.stock_unit_code','=','s.stock_unit')
            ->leftjoin('supply_categories as sc','sc.supply_category_code','=','s.category_code'); 

    // if ($data['supplyCategory'] == "Project"){
    //   $supplies = $supplies->where('sc.supply_category_name', 'not like', '%Repair%');
    // }
    // elseif ($data['supplyCategory'] == "Office"){
    //   $supplies = $supplies->where('sc.supply_category_name', 'not like', '%Repair%');
    // }
    // elseif ($data['supplyCategory'] == "Asset"){
    //   $supplies = $supplies->where('sc.supply_category_name', 'like', '%Repair%');
    // }

    if ($data['isRepair'] == 1){
      $supplies = $supplies->where('sc.supply_category_name', 'like', '%Repair%');
    }
    elseif ($data['isRepair'] == 0){
      $supplies = $supplies->where('sc.supply_category_name', 'not like', '%Repair%');
    }
    else{
      $supplies = $supplies->where('sc.supply_category_name', 'like', '%%');
    }

    if ($data['supplyCode']){
      $supplies = $supplies->where('supply_code', $data['supplyCode']);
    }

    if ($data['quantityStatus'] == 1){
      $supplies = $supplies->where('quantity', '>', 0);
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

        // $supply->supply_code = "SUP-".date('Ymd', strtotime(Carbon::now('Asia/Manila')))."-".$supCode;
        $supply->supply_code = "SUP-".date('YmdHis', strtotime(Carbon::now('Asia/Manila')))."-".$supCode;
        $supply->supply_name = $data['supplyName'];
        $supply->description = $data['description'];
        $supply->category_code = $data['category'];
        $supply->quantity = 0;
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

  public function update(Request $request){

    $data = array();
    $data['supply_code'] = $request->input('supply_code');
    $data['category_code'] = $request->input('category_code');
    $data['supply_name']   = $request->input('supply_name');
    $data['description'] = $request->input('description');
    $data['re_order_level'] = $request->input('re_order_level');
    $data['stock_unit'] = $request->input('stock_unit_code');

      $transaction = DB::transaction(function($data) use($data){
      try{
        
            $supply = Supply::where('supply_code', $data['supply_code'])->first();
            $supply->category_code = $data['category_code'];
            $supply->supply_name = $data['supply_name'];
            $supply->description = $data['description'];
            $supply->re_order_level = $data['re_order_level'];
            $supply->stock_unit = $data['stock_unit'];
            $supply->changed_by = Auth::user()->email;
            $supply->timestamps = true;
            $supply->save();

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