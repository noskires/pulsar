<?php
namespace App\Http\Controllers\Organization;
use Illuminate\Http\Request;

use DB;
use App\Organization;
use App\Department;
use App\Division;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DivisionsController extends Controller {
  public function index(){
    return view('layout.index');
  }

  // public function divisions(){
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
    $data['departmentCode'] = $request->input('departmentCode');
    
    $transaction = DB::transaction(function($data) use($data){
    try{
        
        $organization = new Organization;
        $depCode = str_pad($organization->where('org_type', 'Division')->get()->count() + 1, 8, "0", STR_PAD_LEFT);
        $organization->org_code = "51".$depCode; 
        $organization->next_org_code = $data['departmentCode']; 
        $organization->org_name = $data['name']; 
        $organization->org_type = "Division"; 
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