<?php
namespace App\Http\Controllers\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Auth;
use DB;
use App\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class UsersController extends Controller {
  public function index(){
    return view('layout.index');
  }

  public function list(Request $request){

    $filter = array(
      'userCode'=>$request->input('userCode'),
      'roleName'=>$request->input('roleName'),
      'isSelfOnly'=>$request->input('isSelfOnly'),
    );

  	$list = DB::table('users as user')
            ->select(
              'employee.employee_code',
              DB::raw('CONCAT(trim(CONCAT(employee.lname," ",COALESCE(employee.affix,""))),", ", COALESCE(employee.fname,"")," ", COALESCE(employee.mname,"")) as employee_name'),
              'role.role_code',
              'role.role_name'
            )
            ->leftjoin('employees as employee','employee.employee_code','=','user.employee_code')
            ->leftjoin('roles as role','role.role_code','=','user.role_code')
            ->whereNotNull('user.employee_code');

    if ($filter['isSelfOnly']){
      $list = $list->where('user.employee_code', Auth::user()->employee_code);
    } else if ($filter['userCode']){
      $list = $list->where('user.employee_code', $filter['userCode']);
    }

    $list = $list->get();
    
    foreach ($list as $i => $item) {
      $roleItems = DB::table('role_items as ri');
      $items =  $roleItems-> select('module_code')-> where('role_code', $item->role_code)->get();
      $modules = $items->map(function ($item) {
         return ($item->module_code);
        });
      $list[$i]->modules=$modules;
    }

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
          $user                 = new User;
          $user->name           = $data['employee_code'];
          $user->employee_code  = $data['employee_code'];
          $user->email          = $data['employee_code'];
          $user->role_code      = $data['role_code'];
          $user->password       = bcrypt("pulsar");
          // $user->description    = $data['description'];
          // $user->changed_by     = Auth::user()->email;
          $user->save();

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

        $role = User::where('employee_code', $data['employee_code'])->first();
        $role->role_code = $data['role_code'];
        // $role->changed_by = Auth::user()->email;
        $role->timestamps = true;
        $role->save();

        return response()->json([
          'status' => 200,
          'data' => 'null',
          'message' => 'Successfully saved.'
        ]);

      // }
      // catch (\Exception $e) 
      // {
      //   return response()->json([
      //     'status' => 500,
      //     'data' => 'null',
      //     'message' => 'Error, please try again!'
      //   ]);
      // } 

    });
    return $transaction;
  }
  
}