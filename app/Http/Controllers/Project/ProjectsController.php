<?php
namespace App\Http\Controllers\Project;
use Illuminate\Http\Request;

use DB;
use Auth;
use App\Organization;
use App\Employee;
use App\Project;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ProjectsController extends Controller {

  public function index(){
    return view('layout.index');
  }

  public function projects(Request $request){

    $data = array(
      'projectCode'=>$request->input('projectCode'),
    );

  	$projects = DB::table('Projects as p')
        ->select(
          'p.project_code',
          'p.department_code',
          'p.division_code',
          'p.name',
          'p.description',
          'p.cost',
          'p.code',
          'p.zip_code',
          'p.date_started',
          'p.date_completed',
          'p.target_date',
          'p.date_assigned',
          'p.municipality_code',
          'p.project_engineer as employee_code',
          DB::raw('CONCAT(trim(CONCAT(e.lname," ",COALESCE(e.affix,""))),", ", COALESCE(e.fname,"")," ", COALESCE(e.mname,"")) as project_engineer_name'),
          'municipality.municipality_text',
          'municipality.province_code',
          'province.province_text',
          'province.region_code',
          'region.region_text_long',
          'division.org_name as division_name', 
          'department.org_name as department_name'
        )
        ->leftjoin('employees as e','e.employee_code','=','p.project_engineer')
        ->leftjoin('municipalities as municipality','municipality.municipality_code','=','p.municipality_code')
        ->leftjoin('provinces as province','province.province_code','=','municipality.province_code')
        ->leftjoin('regions as region','region.region_code','=','province.region_code')
        ->leftjoin('organizations as division','division.org_code','=','p.division_code')
        ->leftjoin('organizations as department','department.org_code','=','p.department_code');

    if ($data['projectCode']){
      $projects = $projects->where('project_code', $data['projectCode']);
    }

    $projects = $projects->get();

    return response()-> json([
      'status'=>200,
      'data'=>$projects,
      'message'=>''
    ]);
  }

  public function save(Request $request){
    
  // return $request->all();
    $data = array();
    $data['department_code']                  = $request->input('department_code');
    $data['division_code']                  = $request->input('division_code');
    $data['projectName']                  = $request->input('name');
    $data['remarks']                      = $request->input('remarks');
    $data['code']                         = $request->input('code');
    $data['cost']                         = $request->input('cost');
    $data['description']                  = $request->input('description');
    $data['zipCode']                      = ''; 
    $data['municipality']                 = $request->input('municipality'); 
    $data['division']                     = $request->input('division');
    $data['barangay']                     = $request->input('barangay');
   
    $transaction = DB::transaction(function($data) use($data){
    // try{

        // $organization = new Organization;
        // $depCode                          = str_pad($organization->where('org_type', 'Unit')->get()->count() + 1, 8, "0", STR_PAD_LEFT);
        // $organization->org_code           = "52".$depCode; 
        // $organization->next_org_code      = $data['division']; 
        // $organization->org_name           = $data['projectName']; 
        // $organization->org_type           = "Unit"; 
        // $organization->municipality_code  = $data['municipality'];
        // $organization->barangay           = $data['barangay'];
        // $organization->changed_by         = Auth::user()->email;
        // $organization->save();

        // $unit_code = DB::table('organizations')
        //             ->select('org_code')
        //             ->where('org_type', 'Unit')
        //             ->where('org_name', $data['projectName'])
        //             ->first();

        $project = new Project;

        $proCode = (str_pad(($project->where('created_at', 'like', '%'.Carbon::now('Asia/Manila')->toDateString().'%')
        ->get()->count() + 1), 4, "0", STR_PAD_LEFT));

        $project->project_code             = "PRO-".date('YmdHis', strtotime(Carbon::now('Asia/Manila')))."-".$proCode;
        $project->department_code          = $data['department_code'];
        $project->division_code            = $data['division_code'];
        $project->name                     = $data['projectName'];
        $project->description              = $data['description'];
        $project->cost                     = $data['cost'];
        $project->code                     = $data['code'];
        $project->zip_code                 = $data['zipCode']; 
        $project->municipality_code        = $data['municipality']; 
        
        $project->changed_by               = Auth::user()->email;
        $project->save();

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

  public function update(Request $request){

    $data = array();

    $data['project_code']                 = $request->input('project_code');
    $data['department_code']              = $request->input('department_code');
    $data['division_code']                = $request->input('division_code');
    $data['projectName']                  = $request->input('name');
    $data['remarks']                      = $request->input('remarks');
    $data['code']                         = $request->input('code');
    $data['cost']                         = $request->input('cost');
    $data['description']                  = $request->input('description');
    $data['zipCode']                      = ''; 
    $data['municipality_code']            = $request->input('municipality_code'); 
    $data['division']                     = $request->input('division');
    $data['barangay']                     = $request->input('barangay');
    $data['employee_code']                     = $request->input('employee_code');

    $transaction = DB::transaction(function($data) use($data){
    // try{
      
        $project = Project::where('project_code', $data['project_code'])->first();
        $project->department_code          = $data['department_code'];
        $project->division_code            = $data['division_code'];
        $project->name                     = $data['projectName'];
        $project->description              = $data['description'];
        $project->cost                     = $data['cost'];
        $project->code                     = $data['code'];
        $project->zip_code                 = $data['zipCode']; 
        $project->municipality_code        = $data['municipality_code'];
        $project->project_engineer        = $data['employee_code'];
        $project->changed_by = Auth::user()->email;
        $project->timestamps = true;
        $project->save();

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