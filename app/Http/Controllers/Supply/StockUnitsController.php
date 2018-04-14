<?php
namespace App\Http\Controllers\Supply;
use Illuminate\Http\Request;

use DB;
use App\Organization;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class StockUnitsController extends Controller {
  public function index(){
    return view('layout.index');
  }

  public function stock_units(Request $request){

    $data = array(
      'stockUnitCode'=>$request->input('stockUnitCode'),
    );

    $stockUnits = DB::table('stock_units');

    if ($data['stockUnitCode']){
      $stockUnits = $stockUnits->where('stock_unit_code', $data['stockUnitCode']);
    }

    $stockUnits = $stockUnits->get();

    return response()->json([
      'status'=>200,
      'data'=>$stockUnits,
      'message'=>''
    ]);
  }
}