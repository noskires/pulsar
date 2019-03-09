<?php
namespace App\Http\Controllers\Organization;
use Illuminate\Http\Request;

use DB;
use Auth;
use App\Organization;
use App\Department;
use App\Division;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DivisionsController extends Controller {
  public function index(){
    return view('layout.index');
  }

  public function divisions(Request $request){

    $data = array(
      'orgCode'=>$request->input('orgCode'),
      'nextOrgCode'=>$request->input('nextOrgCode'),
      'orgType'=>$request->input('orgType'),
    );

    $division = DB::table('organizations as division')
    ->select(
                'division.org_code',
                'division.org_name as division_name', 
                'division.next_org_code', 
                'division.municipality_code', 
                'm.municipality_text',
                'division.barangay', 
                'm.province_code',
                'p.province_text',
                'p.region_code',
                'r.region_text_long',
                DB::raw('concat(division.barangay,", ",m.municipality_text,", ", p.province_text,", ", r.region_text_long) as office_address'), 
                'department.org_name as department_name'
            )
    ->where('division.org_type', 'Division')
    -> leftjoin('organizations as department','department.org_code','=','division.next_org_code')
    -> leftjoin('municipalities as m','m.municipality_code','=','division.municipality_code')
    -> leftjoin('provinces as p','p.province_code','=','m.province_code')
    -> leftjoin('regions as r','r.region_code','=','p.region_code');

    if ($data['orgCode']){
      $division = $division->where('division.org_code', $data['orgCode']);
    }

    if ($data['nextOrgCode']){
      $division = $division->where('division.next_org_code', $data['nextOrgCode']);
    }

    if ($data['orgType']){
      $division = $division->where('division.org_type', $data['orgType']);
    }

    $division = $division->get();

    return response()->json([
        'status'=>200,
        'data'=>$division,
        'message'=>''
    ]);
  }

  public function save(Request $request){
    
    $data = array();
    // return $request->all();
    $data['name'] = $request->input('name'); 
    $data['municipality'] = $request->input('municipality');
    $data['departmentCode'] = $request->input('departmentCode');
    $data['barangay'] = $request->input('barangay');
    
    $transaction = DB::transaction(function($data) use($data){
    // try{

        $organization = new Organization;
        $depCode = str_pad($organization->where('org_type', 'Division')->get()->count() + 1, 8, "0", STR_PAD_LEFT);
        $organization->org_code = "51".$depCode; 
        $organization->next_org_code = $data['departmentCode']; 
        $organization->org_name = $data['name']; 
        $organization->org_type = "Division"; 
        $organization->municipality_code = $data['municipality'];
        $organization->barangay = $data['barangay'];
        $organization->changed_by = Auth::user()->email;
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