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

class RoleItemsController extends Controller {
  public function index(){
    return view('layout.index');
  }

  public function list(Request $request){

    $filter = array(
      'roleItemCode'=>$request->input('roleItemCode'),
      'roleCode'=>$request->input('roleCode'),
    );


    $list = DB::table('role_items as role_item')
          ->select('role_item.role_item_code', 'role_item.role_code', 'role_item.module_code', 'm.module_name')
          ->leftjoin('modules as m','role_item.module_code','=','m.module_code');

    if ($filter['roleCode']){
      $list = $list->where('role_item.role_code', $filter['roleCode']);
    }

    if ($filter['roleItemCode']){
      $list = $list->where('role_item.role_item_code', $filter['roleItemCode']);
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
          // $role                 = new Role;
          // $role->role_code      = "ROLE-".date('YmdHis', strtotime(Carbon::now('Asia/Manila')));
          // $role->role_name      = $data['roleName'];
          // $role->description    = $data['description'];
          // $role->changed_by     = Auth::user()->email;
        
          // $role->save();

          // $role =  DB::table('roles')->latest('role_code')->first();
          
          // foreach($data['modules'] as $module) {

            $isRoleCodeExist = DB::table('role_items as ri') 
              -> where('ri.module_code', $data['module_code'])
              -> where('ri.role_code', $data['role_code'])
              ->exists();

            if ($isRoleCodeExist) {
              return response()->json([
                'status' => 400,
                'data' => 'null',
                'message' => 'The module was already taggged on the role.',
              ]);
            }

            $roleItem                 = new RoleItem;
            $roleItem->role_code      = $data['role_code'];
            $roledItemCode             = (str_pad(($roleItem->get()->count() + 1), 4, "0", STR_PAD_LEFT)); 
            $roleItem->role_item_code = "ROLEITM-".date('YmdHis', strtotime(Carbon::now('Asia/Manila')))."-".$roledItemCode;
            $roleItem->module_code    = $data['module_code'];
            $roleItem->changed_by     = Auth::user()->email;
            $roleItem->save(); // fixed typo
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


  // public function update(Request $request){

  //     $data = Input::post();

  //     $transaction = DB::transaction(function($data) use($data){
  //     try{

  //         $role = Role::where('role_code', $data['role_code'])->first();
  //         $role->role_name = $data['role_name'];
  //         $role->description = 1;
  //         $role->changed_by = Auth::user()->email;
  //         $role->timestamps = true;
  //         $role->save();

  //         return response()->json([
  //             'status' => 200,
  //             'data' => 'null',
  //             'message' => 'Successfully saved.'
  //         ]);

  //       }
  //       catch (\Exception $e) 
  //       {
  //           return response()->json([
  //             'status' => 500,
  //             'data' => 'null',
  //             'message' => 'Error, please try again!'
  //         ]);
  //       }
  //     });

  //     return $transaction;
  // }

  public function delete(Request $request){

    $data = Input::post();

    $transaction = DB::transaction(function($data) use($data){
    try{

        DB::table('role_items')->where('role_item_code', $data['role_item_code'])->delete();

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