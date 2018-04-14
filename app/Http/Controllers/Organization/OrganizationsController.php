<?php
namespace App\Http\Controllers\Organization;
use Illuminate\Http\Request;

use DB;
use App\Organization;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrganizationsController extends Controller {
   public function index(){
      return view('layout.index');
   }

   public function organizations(Request $request){
    	// $organizations = DB::table('organizations')->get();
     //  return response()-> json([
     //      'status'=>200,
     //      'data'=>$organizations,
     //      'message'=>''
     //  ]);

    $data = array(
      'orgCode'=>$request->input('orgCode'),
      'nextOrgCode'=>$request->input('nextOrgCode'),
      'orgType'=>$request->input('orgType'),
    );

    $organizations = DB::table('organizations');

    if ($data['orgCode']){
      $organizations = $organizations->where('org_code', $data['orgCode']);
    }

    if ($data['nextOrgCode']){
      $organizations = $organizations->where('next_org_code', $data['nextOrgCode']);
    }

    if ($data['orgType']){
      $organizations = $organizations->where('org_type', $data['orgType']);
    }

    $organizations = $organizations->get();

    return response()-> json([
        'status'=>200,
        'data'=>$organizations,
        'message'=>''
    ]);
  }

  public function save(Request $request){
    
    $data = array();
    // return $request->all();
    $data['name'] = $request->input('name'); 
    $data['municipality'] = $request->input('municipality');
    $data['nextOrgCode'] = $request->input('nextOrgCode');
    
    $transaction = DB::transaction(function($data) use($data){
    // try{
        
        // $organization = new Organization;
        // $depCode = str_pad($organization->where('org_type', 'Unit')->get()->count() + 1, 8, "0", STR_PAD_LEFT);
        // $organization->org_code = "52".$depCode; 
        // $organization->next_org_code = $data['nextOrgCode']; 
        // $organization->org_name = $data['name']; 
        // $organization->org_type = "Division"; 
        // $organization->municipality_code = $data['municipality'];
        // $organization->save();

        // return response()->json([
        //     'status' => 200,
        //     'data' => 'null',
        //     'message' => 'Successfully saved.'
        // ]);

    //   }
    //   catch (\Exception $e) 
    //   {
    //       return response()->json([
    //         'status' => 500,
    //         'data' => 'null',
    //         'message' => 'Error, please try again!'
    //     ]);
    //   }
    });

    return $transaction;
  }
}