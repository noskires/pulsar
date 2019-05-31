<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use DB;
use Auth;
use App\User;
use App\Role;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ResetPasswordController extends Controller {

  public function index(){
    return view('layout.index');
  }
}
