<?php
namespace App\Http\Controllers\Supply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

Use Auth;
use DB;
use App\Organization;
use App\Position;
use App\SupplyCategory;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Carbon\Carbon;

class SupplyCategoriesController extends Controller {
  public function index(){
    return view('layout.index');
  }

   public function supplyCategories(Request $request){

      $data = array(
        'supplyCategoryCode'=>$request->input('supplyCategoryCode'),
      );

    	$supplyCategories = DB::table('supply_categories');

      if ($data['supplyCategoryCode']){
        $supplyCategories = $supplyCategories->where('supply_category_code', $data['supplyCategoryCode']);
      }

      $supplyCategories = $supplyCategories->get();
      
      return response()-> json([
          'status'=>200,
          'data'=>$supplyCategories,
          'message'=>''
      ]);

    }

    public function save(Request $request){

      $data = Input::post();

      $transaction = DB::transaction(function($data) use($data){
      try{

          $supplyCategory = new SupplyCategory;
          $supplyCategory->supply_category_code = "SUP-CTGY".date('YmdHis', strtotime(Carbon::now('Asia/Manila')));
          $supplyCategory->supply_category_name = $data['category_name'];
          $supplyCategory->supply_category_status = 1;
          $supplyCategory->changed_by = Auth::user()->email;
          $supplyCategory->save();

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

      $data = Input::post();

      $transaction = DB::transaction(function($data) use($data){
      // try{

          DB::table('supply_categories')
            ->where('supply_category_code', $data['supply_category_code'])
            ->update([
              'supply_category_name' => $data['supply_category_name']
            ]);

          return response()->json([
              'status' => 200,
              'data' => 'null',
              'message' => 'Successfully saved.'
          ]);

      //   }
      //   catch (\Exception $e) 
      //   {
      //       return response()->json([
      //         'status' => 500,
      //         'data' => 'null',
      //         'message' => 'Error, please try again!'
      //     ]);
      //   }
      });

      return $transaction;
  }
}