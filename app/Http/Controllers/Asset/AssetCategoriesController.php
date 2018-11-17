<?php
namespace App\Http\Controllers\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

Use Auth;
use DB;
use App\AssetCategory;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Carbon\Carbon;

class AssetCategoriesController extends Controller {
  public function index(){
    return view('layout.index');
  }

   public function assetCategories(Request $request){

      $data = array(
        'assetCategoryCode'=>$request->input('assetCategoryCode'),
      );

      $assetCategories = DB::table('asset_categories');

      if ($data['assetCategoryCode']){
        $assetCategories = $assetCategories->where('asset_category_code', $data['assetCategoryCode']);
      }

      $assetCategories = $assetCategories->get();
      
      return response()-> json([
          'status'=>200,
          'data'=>$assetCategories,
          'message'=>''
      ]);

    }

    public function save(Request $request){

      $data = Input::post();

      $transaction = DB::transaction(function($data) use($data){
      try{

          $assetCategory = new AssetCategory;
          // $assetCategory->asset_category_code = "ASSET-CTGY".date('YmdHis', strtotime(Carbon::now('Asia/Manila')));
          $assetCategory->asset_category_code = $data['asset_category_code'];
          $assetCategory->asset_category_name = $data['asset_category_name'];
          $assetCategory->asset_category_status = 1;
          $assetCategory->changed_by = Auth::user()->email;
          $assetCategory->save();

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
      try{

          $assetCategory = AssetCategory::where('asset_category_code', $data['asset_category_code'])->first();
          $assetCategory->asset_category_name = $data['asset_category_name'];
          $assetCategory->asset_category_status = 1;
          $assetCategory->changed_by = Auth::user()->email;
          $assetCategory->timestamps = true;
          $assetCategory->save();

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