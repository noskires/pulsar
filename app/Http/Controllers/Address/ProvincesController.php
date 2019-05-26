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

class ProvincesController extends Controller {
   // public function index(){
   //    return view('employee.index');
   // }

   public function province(Request $request){

      $data = array(
          'region_code'=>$request->input('region_code'),
      );

      $provinces = DB::table('provinces');

      if ($data['region_code']){ 
        $provinces = $provinces->where('region_code', $data['region_code']);
      }

    	$provinces = $provinces->orderBy('province_text', 'asc')->get();

      return response()-> json([
          'status'=>200,
          'data'=>$provinces,
          'message'=>''
      ]);
    }
}