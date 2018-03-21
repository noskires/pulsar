<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use DB;
use App\Organization;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrganizationsController extends Controller {
   // public function index(){
   //    return view('employee.index');
   // }

   public function organizations(){
      	$organizations = DB::table('organizations')->get();
        return response()-> json([
            'status'=>200,
            'data'=>$organizations,
            'message'=>''
        ]);
    }
}