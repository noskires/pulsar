<?php
namespace App\Http\Controllers\Project;
use Illuminate\Http\Request;

use DB;
use App\Employee;
use App\Project;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ProjectsController extends Controller {

  public function index(){
    return view('layout.index');
  }

  public function projects(){
  	$projects = DB::table('Projects as p')
        ->select(
          'p.project_code',
          'p.name',
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
        ->leftjoin('employees as e','e.employee_id','=','p.project_engineer')
        ->get();
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
    $data['code'] = $request->input('code');
    $data['cost'] = $request->input('cost');
    $data['zipCode'] = ''; 
    $data['municipality'] = $request->input('municipality'); 
    $data['dateStarted'] = date('Y-m-d', strtotime($request->input('dateStarted')));
    $data['dateStarted'] = date('Y-m-d', strtotime($request->input('dateStarted')));
    $data['dateCompleted'] = date('Y-m-d', strtotime($request->input('dateCompleted')));
    $data['projectEngineer'] = $request->input('projectEngineer'); 
    $data['dateAssigned'] = date('Y-m-d', strtotime($request->input('dateAssigned')));
   
    $transaction = DB::transaction(function($data) use($data){
    try{

        $project = new Project;

        $proCode = (str_pad(($project->where('created_at', 'like', '%'.Carbon::now('Asia/Manila')->toDateString().'%')
        ->get()->count() + 1), 4, "0", STR_PAD_LEFT));

        $project->project_code = "PRO-".date('Ymd', strtotime(Carbon::now('Asia/Manila')))."-".$proCode;
        $project->name = $data['projectName'];
        $project->cost = $data['cost'];
        $project->code = $data['code'];
        $project->zip_code = $data['zipCode']; 
        $project->municipality_code = $data['municipality']; 
        $project->date_started = $data['dateStarted']; 
        $project->date_completed = $data['dateCompleted']; 
        $project->project_engineer = $data['projectEngineer']; 
        $project->date_assigned = $data['dateAssigned']; 
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