<?php
namespace App\Http\Controllers\Organization;
use Illuminate\Http\Request;

use DB;
use App\Organization;
use App\Department;
use App\Division;
use App\Unit;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UnitsController extends Controller {
  public function index(){
    return view('layout.index');
  }

  // public function units(){
  // 	$departments = DB::table('departments')->get();
  //   return response()-> json([
  //       'status'=>200,
  //       'data'=>$departments,
  //       'message'=>''
  //   ]);
  // }

  public function save(Request $request){
    
    $data = array();
    // return $request->all();
    $data['name'] = $request->input('name'); 
    $data['municipality'] = $request->input('municipality');
    $data['divisionCode'] = $request->input('divisionCode');
    
    $transaction = DB::transaction(function($data) use($data){
    try{
        
        $organization = new Organization;
        $depCode = str_pad($organization->where('org_type', 'Unit')->get()->count() + 1, 8, "0", STR_PAD_LEFT);
        $organization->org_code = "52".$depCode; 
        $organization->next_org_code = $data['divisionCode']; 
        $organization->org_name = $data['name']; 
        $organization->org_type = "Unit"; 
        $organization->municipality_code = $data['municipality'];
        $organization->save();

        return response()->json([
            'status' => 200,
            'data' => 'null',
            'message' => 'Successfully saved.'
        ]);

      }
      catch (\Exception $e) 
      {
          return response()->json([
            'status' => 500,
            'data' => 'null',
            'message' => 'Error, please try again!'
        ]);
      }
    });

    return $transaction;
  }

}