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

  public function units(Request $request){

    $data = array(
      'orgCode'=>$request->input('orgCode'),
      'nextOrgCode'=>$request->input('nextOrgCode'),
      'orgType'=>$request->input('orgType'),
    );

  	$units = DB::table('organizations as unit')
    ->select(
                'unit.org_code',
                'unit.org_name as unit_name', 
                'unit.next_org_code', 
                'unit.municipality_code', 
                'm.municipality_text',
                'unit.barangay', 
                'm.province_code',
                'p.province_text',
                'p.region_code',
                'r.region_text_long',
                DB::raw('concat(unit.barangay,", ",m.municipality_text,", ", p.province_text,", ", r.region_text_long) as office_address'),
                'division.org_name as division_name', 
                'department.org_name as department_name'
            )
    ->where('unit.org_type', 'Unit')
    -> leftjoin('organizations as division','division.org_code','=','unit.next_org_code')
    -> leftjoin('organizations as department','department.org_code','=','division.next_org_code')
    -> leftjoin('municipalities as m','m.municipality_code','=','unit.municipality_code')
    -> leftjoin('provinces as p','p.province_code','=','m.province_code')
    -> leftjoin('regions as r','r.region_code','=','p.region_code');

    if ($data['orgCode']){
      $units = $units->where('unit.org_code', $data['orgCode']);
    }

    if ($data['nextOrgCode']){
      $units = $units->where('unit.next_org_code', $data['nextOrgCode']);
    }

    if ($data['orgType']){
      $units = $units->where('unit.org_type', $data['orgType']);
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
    $data['divisionCode'] = $request->input('divisionCode');
    $data['barangay'] = $request->input('barangay');
    
    $transaction = DB::transaction(function($data) use($data){
    try{
        
        $organization = new Organization;
        $depCode = str_pad($organization->where('org_type', 'Unit')->get()->count() + 1, 8, "0", STR_PAD_LEFT);
        $organization->org_code = "52".$depCode; 
        $organization->next_org_code = $data['divisionCode']; 
        $organization->org_name = $data['name']; 
        $organization->org_type = "Unit"; 
        $organization->municipality_code = $data['municipality'];
        $organization->barangay = $data['barangay'];
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