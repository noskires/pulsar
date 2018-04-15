<?php
namespace App\Http\Controllers\Organization;
use Illuminate\Http\Request;

use DB;
use App\Organization;
use App\Department;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DepartmentsController extends Controller {
  public function index(){
    return view('layout.index');
  }

  public function departments(Request $request){

    $data = array(
      'orgCode'=>$request->input('orgCode'),
    );

    $units = DB::table('organizations as department')
    ->select(
                'department.org_code',
                'department.org_name as department_name', 
                'department.next_org_code', 
                'department.municipality_code', 
                'm.municipality_text',
                'department.barangay', 
                'm.province_code',
                'p.province_text',
                'p.region_code',
                'r.region_text_long',
                DB::raw('concat(department.barangay,", ",m.municipality_text,", ", p.province_text,", ", r.region_text_long) as office_address'), 
                'department.org_name as department_name'
            )
    ->where('department.org_type', 'Department')
    -> leftjoin('municipalities as m','m.municipality_code','=','department.municipality_code')
    -> leftjoin('provinces as p','p.province_code','=','m.province_code')
    -> leftjoin('regions as r','r.region_code','=','p.region_code');

    if ($data['orgCode']){
      $units = $units->where('department.org_code', $data['orgCode']);
    }

    $units = $units->get();

    return response()->json([
        'status'=>200,
        'data'=>$units,
        'message'=>''
    ]);
  }

  public function save(Request $request){
    
    $data = array();
    // return $request->all();
    $data['name'] = $request->input('name'); 
    $data['municipality'] = $request->input('municipality');
    $data['barangay'] = $request->input('barangay');
    
    $transaction = DB::transaction(function($data) use($data){
    // try{

        $organization = new Organization;
        $depCode = str_pad($organization->where('org_type', 'Department')->get()->count() + 1, 8, "0", STR_PAD_LEFT);
        $organization->org_code = "50".$depCode; 
        $organization->next_org_code = "9999999999"; 
        $organization->org_name = $data['name']; 
        $organization->org_type = "Department"; 
        $organization->municipality_code = $data['municipality'];
        $organization->barangay = $data['barangay'];
        $organization->save();

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