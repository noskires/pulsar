<?php
namespace App\Http\Controllers\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

Use Auth;
use DB;
use App\Organization;
use App\Position;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Carbon\Carbon;

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

    public function save(Request $request){

      $data = Input::post();

      $transaction = DB::transaction(function($data) use($data){
      // try{

          $position = new Position;

            $positionCode = (str_pad(($position->get()->count() + 1), 4, "0", STR_PAD_LEFT));

          $position->position_code = "POS-".$positionCode;
          $position->position_text = $data['position_text'];
          $position->changed_by = Auth::user()->email;
          $position->save();

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
}