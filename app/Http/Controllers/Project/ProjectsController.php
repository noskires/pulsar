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
          'm.municipality_text',
          'p.project_engineer',
          DB::raw('concat(trim(concat(e.lname," ",e.affix)),", ", e.fName," ", e.mName) as employee_name')
        )
        ->leftjoin('Municipalities as m', 'p.municipality_code', '=', 'm.municipality_code')
        ->leftjoin('employees as e','e.employee_id','=','p.project_engineer');

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
    $data['projectName'] = $request->input('name');
    $data['description'] = $request->input('description');
    $data['code'] = $request->input('code');
    $data['cost'] = $request->input('cost');
    $data['zipCode'] = ''; 
    $data['municipality'] = $request->input('municipality'); 
    // $data['dateStarted'] = date('Y-m-d', strtotime($request->input('dateStarted')));
    // $data['dateStarted'] = date('Y-m-d', strtotime($request->input('dateStarted')));
    // $data['dateCompleted'] = date('Y-m-d', strtotime($request->input('dateCompleted')));
    // $data['projectEngineer'] = $request->input('projectEngineer'); 
    // $data['dateAssigned'] = date('Y-m-d', strtotime($request->input('dateAssigned')));
    $data['division'] = $request->input('division');
    $data['barangay'] = $request->input('barangay');
   
    $transaction = DB::transaction(function($data) use($data){
    try{

        $organization = new Organization;
        $depCode = str_pad($organization->where('org_type', 'Unit')->get()->count() + 1, 8, "0", STR_PAD_LEFT);
        $organization->org_code = "52".$depCode; 
        $organization->next_org_code = $data['division']; 
        $organization->org_name = $data['projectName']; 
        $organization->org_type = "Unit"; 
        $organization->municipality_code = $data['municipality'];
        $organization->barangay = $data['barangay'];
        $organization->changed_by = Auth::user()->email;
        $organization->save();


        $unit_code = DB::table('organizations')
                    ->select('org_code')
                    ->where('org_type', 'Unit')
                    ->where('org_name', $data['projectName'])
                    ->first();

        $project = new Project;

        $proCode = (str_pad(($project->where('created_at', 'like', '%'.Carbon::now('Asia/Manila')->toDateString().'%')
        ->get()->count() + 1), 4, "0", STR_PAD_LEFT));

        $project->project_code = "PRO-".date('YmdHis', strtotime(Carbon::now('Asia/Manila')))."-".$proCode;
        $project->org_code = $unit_code->org_code;
        $project->name = $data['projectName'];
        $project->description = $data['description'];
        $project->cost = $data['cost'];
        $project->code = $data['code'];
        $project->zip_code = $data['zipCode']; 
        $project->municipality_code = $data['municipality']; 
        $project->changed_by = Auth::user()->email;
        $project->save();

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