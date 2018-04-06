<?php
namespace App\Http\Controllers\Employee;
use Illuminate\Http\Request;

use DB;
use App\Organization;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PositionsController extends Controller {

   public function positions(Request $request){

        $data = array(
          'positionCode'=>$request->input('positionCode'),
        );

      	$positions = DB::table('positions');

        if ($data['positionCode']){
          $positions = $positions->where('position_code', $data['positionCode']);
        }

        $positions = $positions->get();

        return response()-> json([
            'status'=>200,
            'data'=>$positions,
            'message'=>''
        ]);
    }
}