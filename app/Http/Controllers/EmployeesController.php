<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use DB;
use Auth;
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
                      'e.gender',
                      DB::raw('CONCAT(trim(CONCAT(e.lname," ",COALESCE(e.affix,""))),", ", COALESCE(e.fname,"")," ", COALESCE(e.mname,"")) as employee_name'),
                      // 'e.birthdate',
                      DB::raw('DATE_FORMAT(e.birthdate, "%m/%d/%Y") as birthdate'),
                      'e.email_account',
                      'e.phone_number',
                      'e.position_code',
                      'p.position_text',
                      'e.department AS department_code',
                      'dep.org_name AS department',
                      'e.division AS division_code',
                      'div.org_name AS division',
                      'e.unit AS unit_code',
                      'unit.org_name AS unit',
                      'e.organizational_unit AS organizational_unit_code',
                      'org_unit.org_name AS organizational_unit_name'
                    )
                    ->leftjoin('positions as p','p.position_code','=','e.position_code')
                    ->leftjoin('organizations as dep','dep.org_code','=','e.department')
                    ->leftjoin('organizations as div','div.org_code','=','e.division')
                    ->leftjoin('organizations as unit','unit.org_code','=','e.unit')
                    ->leftjoin('organizations as org_unit','org_unit.org_code','=','e.organizational_unit');

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
                      'e.gender',
                      DB::raw('CONCAT(trim(CONCAT(e.lname," ",COALESCE(e.affix,""))),", ", COALESCE(e.fname,"")," ", COALESCE(e.mname,"")) as employee_name'),
                      // 'e.birthdate',
                      DB::raw('DATE_FORMAT(e.birthdate, "%m/%d/%Y") as birthdate'),
                      'e.email_account',
                      'e.phone_number',
                      'e.position_code',
                      'p.position_text',
                      'e.department AS department_code',
                      'dep.org_name AS department',
                      'e.division AS division_code',
                      'div.org_name AS division',
                      'e.unit AS unit_code',
                      'unit.org_name AS unit',
                      'e.organizational_unit AS organizational_unit_code',
                      'org_unit.org_name AS organizational_unit_name'
                    )
                    ->leftjoin('positions as p','p.position_code','=','e.position_code')
                    ->leftjoin('organizations as dep','dep.org_code','=','e.department')
                    ->leftjoin('organizations as div','div.org_code','=','e.division')
                    ->leftjoin('organizations as unit','unit.org_code','=','e.unit')
                    ->leftjoin('organizations as org_unit','org_unit.org_code','=','e.organizational_unit');

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
      $data['emp_id']     = $request->input('emp_id');
      $data['lname']      = $request->input('lname');
      $data['suffix']     = $request->input('suffix');
      $data['fname']      = $request->input('fname');
      $data['mname']      = $request->input('mname');
      $data['gender']     = $request->input('gender');
      $data['birthdate']  = date('Y-m-d', strtotime($request->input('bday')));
      $data['position_code'] = $request->input('position_code');
      $data['email']      = $request->input('email');
      $data['phone_no']   = $request->input('phone_no');
      $data['department'] = $request->input('department');
      $data['division']   = $request->input('division');
      $data['unit']       = $request->input('unit');

      // return $request->all();

      if($data['unit'] != ""){
        $data['organizational_unit'] = $data['unit'];
      }elseif($data['division'] != ""){
        $data['organizational_unit'] = $data['division'];
      }else{
        $data['organizational_unit'] = $data['department'];
      }
      
      $transaction = DB::transaction(function($data) use($data){
      try{

          $employee = new Employee;

          $employeeCode = (str_pad(($employee->get()->count() + 1), 6, "0", STR_PAD_LEFT)); 
          $employee->employee_code = "816".$employeeCode;

          // $employee->employee_code = $data['emp_id'];
          $employee->lname          = $data['lname'];
          $employee->affix          = $data['suffix'];
          $employee->fname          = $data['fname'];
          $employee->mname          = $data['mname'];
          $employee->gender         = $data['gender'];
          $employee->position_code  = $data['position_code'];
          $employee->birthdate      = $data['birthdate'];
          $employee->email_account  = $data['email'];
          $employee->phone_number   = $data['phone_no'];
          $employee->department     = $data['department'];
          $employee->division       = $data['division'];
          $employee->unit           = $data['unit'];
          $employee->organizational_unit = $data['organizational_unit'];
          $employee->changed_by     = Auth::user()->email;
          $employee->save();

          return response()->json([
              'status' => 200,
              'data' => $data['birthdate'],
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
    $data['employee_code'] = $request->input('employee_code');
    $data['lname'] = $request->input('lname');
    $data['suffix'] = $request->input('affix');
    $data['fname'] = $request->input('fname');
    $data['mname'] = $request->input('mname');
    $data['gender'] = $request->input('gender');
    $data['birthdate'] = date('Y-m-d', strtotime($request->input('birthdate')));
    $data['position_code'] = $request->input('position_code');
    $data['email_account'] = $request->input('email_account');
    $data['phone_no'] = $request->input('phone_number');
    $data['department'] = $request->input('department_code');
    $data['division'] = $request->input('division_code');
    $data['unit'] = $request->input('unit_code');

    if($data['unit'] != ""){
      $data['organizational_unit'] = $data['unit'];
    }elseif($data['division'] != ""){
      $data['organizational_unit'] = $data['division'];
    }else{
      $data['organizational_unit'] = $data['department'];
    }

    $transaction = DB::transaction(function($data) use($data){
    try{

          $employee = Employee::where('employee_code', $data['employee_code'])->first();
          $employee->lname            = $data['lname'];
          $employee->affix            = $data['suffix'];
          $employee->fname            = $data['fname'];
          $employee->mname            = $data['mname'];
          $employee->gender           = $data['gender'];
          $employee->position_code    = $data['position_code'];
          $employee->birthdate        = $data['birthdate'];
          $employee->email_account    = $data['email_account'];
          $employee->phone_number     = $data['phone_no'];
          $employee->department       = $data['department'];
          $employee->division         = $data['division'];
          $employee->unit             = $data['unit'];
          $employee->organizational_unit     = $data['organizational_unit'];
          $employee->changed_by       = Auth::user()->email;
          $employee->timestamps       = true;
          $employee->save();

        return response()->json([
            'status' => 200,
            'data' => null,
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