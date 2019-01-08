<?php
namespace App\Http\Controllers\Supply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

Use Auth;
use DB;
use App\SupplyUnit;
use App\Organization;
use App\Position;
use App\SupplyCategory;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Carbon\Carbon;

class SupplyUnitsController extends Controller {
  public function index(){
    return view('layout.index');
  }

   public function supplyUnits(Request $request){

      $data = array(
        'supplyUnitCode'=>$request->input('supplyUnitCode'),
      );

    	$supplyUnits = DB::table('stock_units');

      if ($data['supplyUnitCode']){
        $supplyUnits = $supplyUnits->where('stock_unit_code', $data['supplyUnitCode']);
      }

      $supplyUnits = $supplyUnits->get();
      
      return response()-> json([
          'status'=>200,
          'data'=>$supplyUnits,
          'message'=>''
      ]);

    }

    public function save(Request $request){

      $data = Input::post();

      $transaction = DB::transaction(function($data) use($data){
      // try{

          $supplyUnit = new SupplyUnit;
          $supplyUnit->stock_unit_code = "STOCK-UNT".date('YmdHis', strtotime(Carbon::now('Asia/Manila')));
          $supplyUnit->stock_unit_name = $data['stock_unit_name'];
          $supplyUnit->changed_by = Auth::user()->email;
          $supplyUnit->save();

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

      $data = Input::post();

      $transaction = DB::transaction(function($data) use($data){
      // try{

          $supplyUnit = SupplyUnit::where('stock_unit_code', $data['stock_unit_code'])->first();
          $supplyUnit->stock_unit_name = $data['stock_unit_name'];
          $supplyUnit->changed_by = Auth::user()->email;
          $supplyUnit->timestamps = true;
          $supplyUnit->save();

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
}