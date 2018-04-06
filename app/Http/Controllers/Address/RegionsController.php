<?php
namespace App\Http\Controllers\Address;
use Illuminate\Http\Request;

use DB;
use App\Employee;
use App\Region;
use App\Province;
use App\Municipality;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class RegionsController extends Controller {
   // public function index(){
   //    return view('employee.index');
   // }

   public function region(){

      	$regions = DB::table('Regions');

      	$regions = $regions->get();

        return response()-> json([
            'status'=>200,
            'data'=>$regions,
            'message'=>''
        ]);
    }
}