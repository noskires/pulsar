<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use DB;
use App\Employee;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class EmployeesController extends Controller {
   public function index(){
      return view('employee.index');
   }

   public function employees(Request $request){

   		$data = array(
            'jobType'=>$request->input('jobType'),
        );

      	$employees = DB::table('Employees');

      	if ($data['jobType']){ 
      		$employees = $employees->where('job_title', $data['jobType']);
      	}

      	$employees = $employees->get();

        return response()-> json([
            'status'=>200,
            'data'=>$employees,
            'message'=>''
        ]);
    }
}