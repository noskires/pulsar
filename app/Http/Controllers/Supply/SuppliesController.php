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
      'quantityStatus'=>$request->input('quantityStatus'),
    );

  	$supplies = DB::table('supplies as s')
            ->leftjoin('stock_units as su','su.stock_unit_code','=','s.stock_unit')
            ->leftjoin('supply_categories as sc','sc.supply_category_code','=','s.category_code'); 

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
    // try{

        $supply = new Supply;

        $supCode = (str_pad(($supply->where('created_at', 'like', '%'.Carbon::now('Asia/Manila')->toDateString().'%')
        ->get()->count() + 1), 4, "0", STR_PAD_LEFT));

        // $supply->supply_code = "SUP-".date('Ymd', strtotime(Carbon::now('Asia/Manila')))."-".$supCode;
        $supply->supply_code = "SUP-".date('YmdHis', strtotime(Carbon::now('Asia/Manila')));
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
        
            DB::table('supplies')
              ->where('supply_code', $data['supply_code'])
              ->update([
                'category_code' => $data['category_code'],
                'supply_name' => $data['supply_name'],
                'description' => $data['description'],
                're_order_level' => $data['re_order_level'],
                'stock_unit' => $data['stock_unit']
              ]);

          return response()->json([
              'status' => 200,
              'data' => $data['supply_code'],
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