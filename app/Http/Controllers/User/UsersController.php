<?php
namespace App\Http\Controllers\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;

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
      'isSelfOnly'=> ( $request->input('isSelfOnly') == 'true'),
    );

  	$list = DB::table('users as user')
            ->select(
              'employee.employee_code',
              'user.is_active',
              'user.auto_generated',
              'user.password_generated',
              DB::raw('CONCAT(trim(CONCAT(employee.lname," ",COALESCE(employee.affix,""))),", ", COALESCE(employee.fname,"")," ", COALESCE(employee.mname,"")) as employee_name'),
              'role.role_code',
              'role.is_active as role_is_active',
              'role.role_name'
            )
            ->leftjoin('employees as employee','employee.employee_code','=','user.employee_code')
            ->leftjoin('roles as role','role.role_code','=','user.role_code')
            ->whereNotNull('user.employee_code')
            ->whereNotNull('employee.employee_code');

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
      $list[$i]->password_generated= ($item->auto_generated) ? $item->password_generated : '';
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
          $user->password       = bcrypt($this->getRandomPassword());
          $user->password_generated = $this->getRandomPassword();
          $user->auto_generated = true;
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
        $role->is_active = $data['is_active'];
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

  public function generatePassword(Request $request) {
    $data = Input::post();
    $transaction = DB::transaction(function($data) use($data){
      $randomPassword = $this->getRandomPassword();
      $user = User::where('employee_code', $data['employee_code'])->first();
      $user->password = bcrypt($randomPassword);
      $user->password_generated = $randomPassword;
      $user->auto_generated = true;
      $user->timestamps = true;
      $user->save();

      return response()->json([
        'status' => 200,
        'data' => 'null',
        'message' => 'Successfully saved.'
      ]);
    });
    return $transaction;
  }

  public function resetPassword(Request $request) {
    $data = Input::post();
    $errors = $this->checkPasswordErrors($data);
    if (count($errors)) {
      return response()->json([
        'status' => 400,
        'data' => $errors,
        'message' => 'Invalid password'
      ]);
    }

    $transaction = DB::transaction(function($data) use($data){
      $user = User::where('employee_code', $data['employee_code'])->first();
      $user->password = bcrypt($data['password']);
      $user->auto_generated = false;
      $user->timestamps = true;
      $user->save();

      return response()->json([
        'status' => 200,
        'data' => 'null',
        'message' => 'Successfully saved.'
      ]);
    });
    return $transaction;
  }
  
  function getRandomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $numbers = '1234567890';
    $specialChars = '!@#$()_+?><';
    $pass = array();
    $random;
    for ($i = 0; $i < 8; $i++) {
        if ($i <= 5 ) $random = $alphabet[rand(0, strlen($alphabet) - 1)];
        if ($i == 6) $random = $numbers[rand(0, strlen($numbers) - 1)];
        if ($i == 7) $random = $specialChars[rand(0, strlen($specialChars) - 1)];
        $pass[] = $random;
    }
    return implode($pass);
  }

  function checkPasswordErrors($data) {
    $errors = array();
    if ($data['password_current']) {
      $user = User::where('employee_code', Auth::User()->employee_code)->first();
      if (!Hash::check($data['password_current'], $user->password)) {
        $errors[] = 'Current password is invalid.';
      }
    }

    if ($data['password'] !== $data['password_confirmation']) {
      $errors[] = 'Password must be match.';
    }
    if (strlen($data['password']) < 8 || strlen($data['password']) > 16) {
      $errors[] = "Password should be min 8 characters and max 16 characters";
    }
    if (!preg_match("/\d/", $data['password'])) {
        $errors[] = "Password should contain at least one digit";
    }
    if (!preg_match("/[A-Z]/", $data['password'])) {
        $errors[] = "Password should contain at least one Capital Letter";
    }
    if (!preg_match("/[a-z]/", $data['password'])) {
        $errors[] = "Password should contain at least one small Letter";
    }
    if (!preg_match("/\W/", $data['password'])) {
        $errors[] = "Password should contain at least one special character";
    }
    if (preg_match("/\s/", $data['password'])) {
        $errors[] = "Password should not contain any white space";
    }
      return $errors;

    }
}
