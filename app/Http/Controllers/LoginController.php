<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use DB;
use Auth;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class LoginController extends Controller {

  public function phpinfo(){
    phpinfo();
  }

  public function login(Request $request){
    // dd($request->all());
    if(Auth::attempt([
      'email'=>$request->email,
      'password'=>$request->password
      ]))
    {
      $user = User::where('email', $request->email)->first();
      if($user->is_admin())
      {
        return redirect('index');
        // echo Auth::user()->id;
      }
      else
      {
        // echo "user";
        return redirect('index');
        // return redirect()->route('/login');
      }
    }
    else
    {
      // return redirect()->route('login');
      return redirect('login')->with('status', 'Login failed; Invalid email or password');
    }
  }
  // public function user()
}