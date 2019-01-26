<?php
namespace App\Http\Controllers\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Auth;
use DB;
use App\Role;
use App\RoleItem;
use App\Module;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ModulesController extends Controller {
  public function index(){
    return view('layout.index');
  }

  public function list(Request $request){

    $filter = array(
      'moduleCode'=>$request->input('moduleCode'),
      // 'roleName'=>$request->input('roleName')
    );


  	$list = DB::table('modules as module');

    if ($filter['moduleCode']){
      $list = $list->where('module.module_code', $filter['moduleCode']);
    }

    // if ($filter['roleName']){
    //   $list = $list->where('role.role_name', $filter['roleName']);
    // }

    $list = $list->get();



    return response()-> json([
      'status'=>200,
      'data'=>$list,
      'message'=>''
    ]);
  }

  public function save(Request $request){

    $data = Input::post();

    $transaction = DB::transaction(function($data) use($data){
    // try{
          $role                 = new Role;
          $role->role_code      = "ROLE-".date('YmdHis', strtotime(Carbon::now('Asia/Manila')));
          $role->role_name      = $data['roleName'];
          $role->description    = $data['description'];
          $role->changed_by     = Auth::user()->email;
        
          $role->save();

          $role =  DB::table('roles')->latest('role_code')->first();
          
          foreach($data['modules'] as $module) {
            $roleItem                 = new RoleItem;
            $roleItem->role_code      = $role->role_code;
            $roledItemCode             = (str_pad(($roleItem->get()->count() + 1), 6, "0", STR_PAD_LEFT)); 
            $roleItem->role_item_code = "ROLEITM-".date('YmdHis', strtotime(Carbon::now('Asia/Manila')))."-".$roledItemCode;
            $roleItem->module_code    = $module;
            $roleItem->changed_by     = Auth::user()->email;
            $roleItem->save(); // fixed typo
          }

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

  // public function delete_receipt_items(Request $request){

  //   // $data = Input::post();
  //   $data = array(
  //     'receiptItemCode'=>$request->input('receiptItemCode'),
  //     'receiptItemQuantity'=>$request->input('receiptItemQuantity'),
  //     'supplyCode'=>$request->input('supplyCode'),
  //   );

  //   $transaction = DB::transaction(function($data) use($data){
  //   try{

  //       DB::table('receipt_items')->where('receipt_item_code', $data['receiptItemCode'])->delete();

  //       $supply = DB::table('supplies')
  //         ->select('quantity')
  //         ->where('supply_code', $data['supplyCode'])
  //         ->first();

  //         $totalQuantity = $supply->quantity - $data['receiptItemQuantity'];

  //         DB::table('supplies')
  //         ->where('supply_code', $data['supplyCode'])
  //           ->update([
  //             'quantity' => $totalQuantity
  //           ]);

  //       return response()->json([
  //           'status' => 200,
  //           'data' => 'null',
  //           'message' => 'Successfully saved.'
  //       ]);

  //     }
  //     catch (\Exception $e) 
  //     {
  //         return response()->json([
  //           'status' => 500,
  //           'data' => 'null',
  //           'message' => 'Error, please try again!'
  //       ]);
  //     }
  //   });

  //   return $transaction;
  // }

  
}