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

class MunicipalitiesController extends Controller {
   // public function index(){
   //    return view('employee.index');
   // }

   public function municipality(Request $request){

      $data = array(
          'province_code'=>$request->input('province_code'),
      );

    	$municipalities = DB::table('Municipalities');

      if ($data['province_code']){ 
        $municipalities = $municipalities->where('province_code', $data['province_code']);
      }
      
    	$municipalities = $municipalities->orderBy('municipality_text', 'asc')->get();

      return response()-> json([
          'status'=>200,
          'data'=>$municipalities,
          'message'=>''
      ]);
    }
}