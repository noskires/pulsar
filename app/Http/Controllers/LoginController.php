<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use DB;
use Auth;
use App\User;
use App\Role;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class LoginController extends Controller {

  public function phpinfo(){
    phpinfo();
  }
  public function logout(Request $request){
    return redirect('login')->with(Auth::logout());
  }
  public function login(Request $request){
    $user = User::where('email', $request->email)->first();
    $role = null;

    if ($user) {
      $role = Role::where('role_code', $user->role_code)->first();
    }

    if ($role && (!$role->is_active || !$user->is_active)) {
      return redirect('login')->with('status', 'Login failed; Account is disabled.');
    } else if(Auth::attempt([
      'email'=>$request->email,
      'password'=>$request->password
      ]))
      {
        if ($user->auto_generated) {
          return redirect('reset-password');
        }
        return redirect('index');
      }
    else
    {
      // return redirect()->route('login');
      return redirect('login')->with('status', 'Login failed; Invalid email or password.');
    }
  }
  // public function user()
}
