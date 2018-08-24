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
                    ->select(
                      'e.employee_code',
                      'e.lname',
                      'e.affix', 
                      'e.fname', 
                      'e.mname',
                      'e.birthdate',
                      'e.email_account',
                      'e.phone_number',
                      'e.position_code',
                      'p.position_text',
                      'e.department AS department_code',
                      'dep.org_name AS department',
                      'e.division AS division_code',
                      'div.org_name AS division',
                      'e.unit AS unit_code',
                      'unit.org_name AS unit'
                    )
                    ->leftjoin('positions as p','p.position_code','=','e.position_code')
                    ->leftjoin('organizations as dep','dep.org_code','=','e.department')
                    ->leftjoin('organizations as div','div.org_code','=','e.division')
                    ->leftjoin('organizations as unit','unit.org_code','=','e.unit');

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
            'employee_code'=>$request->input('employee_code'),
        );

        $employees = DB::table('Employees as e')
                    ->select(
                      'e.employee_code',
                      'e.lname',
                      'e.affix', 
                      'e.fname', 
                      'e.mname',
                      'e.birthdate',
                      'e.email_account',
                      'e.phone_number',
                      'e.position_code',
                      'p.position_text',
                      'e.department AS department_code',
                      'dep.org_name AS department',
                      'e.division AS division_code',
                      'div.org_name AS division',
                      'e.unit AS unit_code',
                      'unit.org_name AS unit'
                    )
                    ->leftjoin('positions as p','p.position_code','=','e.position_code')
                    ->leftjoin('organizations as dep','dep.org_code','=','e.department')
                    ->leftjoin('organizations as div','div.org_code','=','e.division')
                    ->leftjoin('organizations as unit','unit.org_code','=','e.unit');

        if ($data['employee_id']){ 
          $employees = $employees->where('employee_id', $data['employee_id']);
        }


        if ($data['employee_code']){ 
          $employees = $employees->where('employee_code', $data['employee_code']);
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

        $employeeCode = (str_pad(($employee->get()->count() + 1), 6, "0", STR_PAD_LEFT)); 
        $employee->employee_code = "816".$employeeCode;

        // $employee->employee_code = $data['emp_id'];
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
    $data['emp_code'] = $request->input('employee_code');
    $data['lname'] = $request->input('lname');
    $data['suffix'] = $request->input('affix');
    $data['fname'] = $request->input('fname');
    $data['mname'] = $request->input('mname');
    $data['bday'] = date('Y-m-d', strtotime($request->input('bday')));
    $data['position_code'] = $request->input('position_code');
    $data['email'] = $request->input('email_account');
    $data['phone_no'] = $request->input('phone_number');
    $data['department'] = $request->input('department_code');
    $data['division'] = $request->input('division_code');
    $data['unit'] = $request->input('unit_code');

    $transaction = DB::transaction(function($data) use($data){
    // try{
      
          DB::table('employees')
            ->where('employee_code', $data['emp_code'])
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