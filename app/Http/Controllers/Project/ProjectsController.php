<?php
namespace App\Http\Controllers\Project;
use Illuminate\Http\Request;

use DB;
use App\Employee;
use App\Project;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProjectsController extends Controller {

  public function index(){
    return view('layout.index');
  }

  public function projects(){
  	$projects = DB::table('Projects')->get();
    return response()-> json([
      'status'=>200,
      'data'=>$projects,
      'message'=>''
    ]);
  }

  public function save(Request $request){
    
    $data = array();
    $data['projectName'] = $request->input('name');
    $data['cost'] = $request->input('cost');
    $data['zipCode'] = $request->input('province'); 
    $data['dateStarted'] = date('Y-m-d', strtotime($request->input('dateStarted')));
    $data['dateStarted'] = date('Y-m-d', strtotime($request->input('dateStarted')));
    $data['dateCompleted'] = date('Y-m-d', strtotime($request->input('dateCompleted')));
    $data['projectEngineer'] = $request->input('projectEngineer'); 
    $data['dateAssigned'] = date('Y-m-d', strtotime($request->input('dateAssigned')));
   
    $transaction = DB::transaction(function($data) use($data){
    // try{

        $project = new Project;
        $project->name = $data['projectName'];
        $project->project_code = "code";
        $project->cost = $data['cost'];
        $project->zip_code = $data['zipCode']; 
        $project->date_started = $data['dateStarted']; 
        $project->date_completed = $data['dateCompleted']; 
        $project->project_engineer = $data['projectEngineer']; 
        $project->date_assigned = $data['dateAssigned']; 
        $project->save();

        // $assetCopy = DB::table('Assets')->where('tag', $asset->tag)->first();
        // $assetCopy->asset_id;

        // $log = new Log;
        // $log->log_code = $assetCopy->asset_id;
        // $log->log_desc = "Added new asset";
        // $log->user_id = Auth::user()->id;
        // $log->save();

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