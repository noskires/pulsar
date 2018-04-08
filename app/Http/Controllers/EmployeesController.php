<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use DB;
use App\Employee;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class EmployeesController extends Controller {
   public function index(){
      return view('layout.index');
   }

   public function employees(Request $request){

   		$data = array(
            'jobType'=>$request->input('jobType'),
        );

      	$employees = DB::table('Employees as e')
                    ->leftjoin('positions as p','p.position_code','=','e.position_code');

      	if ($data['jobType']){ 
      		$employees = $employees->where('e.position_code', $data['jobType']);
      	}

        $employees = $employees->orderBy('lname', 'asc')
                    ->orderBy('affix', 'asc')
                    ->orderBy('fname', 'asc')
                    ->orderBy('mname', 'asc')
                    ->get();
  

        return response()-> json([
            'status'=>200,
            'data'=>$employees,
            'message'=>''
        ]);
    }

    public function employees2(Request $request){

      $data = array(
            'employee_id'=>$request->input('employee_id'),
        );

        $employees = DB::table('Employees');

        if ($data['employee_id']){ 
          $employees = $employees->where('employee_id', $data['employee_id']);
        }

        $employees = $employees->orderBy('lname', 'asc')
                    ->orderBy('affix', 'asc')
                    ->orderBy('fname', 'asc')
                    ->orderBy('mname', 'asc')
                    ->get();

        return response()-> json([
            'status'=>200,
            'data'=>$employees,
            'message'=>''
        ]);
    }

    public function save(Request $request){
      // return $request->all();
    $data = array();
    $data['emp_id'] = $request->input('emp_id');
    $data['lname'] = $request->input('lname');
    $data['suffix'] = $request->input('suffix');
    $data['fname'] = $request->input('fname');
    $data['mname'] = $request->input('mname');
    $data['bday'] = date('Y-m-d', strtotime($request->input('bday')));
    $data['position_code'] = $request->input('position_code');
    $data['email'] = $request->input('email');
    $data['phone_no'] = $request->input('phone_no');
    $data['department'] = $request->input('department');
    $data['division'] = $request->input('division');
    $data['unit'] = $request->input('unit');
    
    $transaction = DB::transaction(function($data) use($data){
    try{

        $employee = new Employee;

        // $employeeCode = (str_pad(($employee->get()->count() + 1), 6, "0", STR_PAD_LEFT)); 
        // $employee->job_order_code = "JO-".date('Ymd', strtotime(Carbon::now('Asia/Manila')))."-".$joCode;

        $employee->employee_code = $data['emp_id'];
        $employee->lname = $data['lname'];
        $employee->affix = $data['suffix'];
        $employee->fname = $data['fname'];
        $employee->mname = $data['mname'];
        $employee->position_code = $data['position_code'];
        $employee->birthdate = $data['bday'];
        $employee->email_account = $data['email'];
        $employee->phone_number = $data['phone_no'];
        $employee->department = $data['department'];
        $employee->division = $data['division'];
        $employee->unit = $data['unit'];
        $employee->save();

        return response()->json([
            'status' => 200,
            'data' => $data['position_code'],
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


  public function update(Request $request){

    $data = array();
    $data['emp_id'] = $request->input('employee_id');
    $data['lname'] = $request->input('lname');
    $data['suffix'] = $request->input('affix');
    $data['fname'] = $request->input('fname');
    $data['mname'] = $request->input('mname');
    $data['bday'] = date('Y-m-d', strtotime($request->input('bday')));
    $data['position_code'] = $request->input('position_code');
    $data['email'] = $request->input('email_account');
    $data['phone_no'] = $request->input('phone_number');
    $data['department'] = $request->input('department');
    $data['division'] = $request->input('division');
    $data['unit'] = $request->input('unit');

    $transaction = DB::transaction(function($data) use($data){
    try{
      
          DB::table('employees')
            ->where('employee_id', $data['emp_id'])
            ->update([
              'lname' => $data['lname'],
              'affix' => $data['suffix'],
              'fname' => $data['fname'],
              'mname' => $data['mname'],
              'position_code' => $data['position_code'],
              'birthdate' => $data['bday'],
              'email_account' => $data['email'],
              'phone_number' => $data['phone_no'],
              'department' => $data['department'],
              'division' => $data['division'],
              'unit' => $data['unit']
            ]);

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