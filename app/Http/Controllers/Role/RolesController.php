<?php
namespace App\Http\Controllers\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Auth;
use DB;
use App\Role;
use App\RoleItem;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class RolesController extends Controller {
  public function index(){
    return view('layout.index');
  }

  public function list(Request $request){

    $filter = array(
      'roleCode'=>$request->input('roleCode'),
      'roleName'=>$request->input('roleName')
    );


  	$list = DB::table('roles as role');

    if ($filter['roleCode']){
      $list = $list->where('role.role_code', $filter['roleCode']);
    }

    if ($filter['roleName']){
      $list = $list->where('role.role_name', $filter['roleName']);
    }

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

          $roleCode             = (str_pad(($role->get()->count() + 1), 4, "0", STR_PAD_LEFT)); 
          $role->role_code      = "ROLE-".date('YmdHis', strtotime(Carbon::now('Asia/Manila')))."-".$roleCode;
          $role->role_name      = $data['roleName'];
          $role->description    = $data['description'];
          $role->changed_by     = Auth::user()->email;
        
          $role->save();

          $role =  DB::table('roles')->latest('role_code')->first();
          
          // foreach($data['modules'] as $module) {
          //   $roleItem                 = new RoleItem;
          //   $roleItem->role_code      = $role->role_code;
          //   $roledItemCode             = (str_pad(($roleItem->get()->count() + 1), 6, "0", STR_PAD_LEFT)); 
          //   $roleItem->role_item_code = "ROLEITM-".date('YmdHis', strtotime(Carbon::now('Asia/Manila')))."-".$roledItemCode;
          //   $roleItem->module_code    = $module;
          //   $roleItem->changed_by     = Auth::user()->email;
          //   $roleItem->save(); // fixed typo
          // }

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
    try{

        $role = Role::where('role_code', $data['role_code'])->first();
        $role->role_name = $data['role_name'];
        $role->description = $data['description'];
        $role->changed_by = Auth::user()->email;
        $role->timestamps = true;
        $role->save();

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