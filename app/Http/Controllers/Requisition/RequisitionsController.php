<?php
namespace App\Http\Controllers\Requisition;
use Illuminate\Http\Request;

use DB;
use App\Employee;
use App\Project;
use App\JobOrder;
use App\Requisition;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class RequisitionsController extends Controller {

  public function index(){
    return view('layout.index');
  }

  public function job_orders(Request $request){

    $data = array(
      'joCode'=>$request->input('joCode'),
    );

    $job_orders = DB::table('job_orders as jo')
            ->select(
                'jo.job_order_code', 
                'jo.job_order_date', 
                'jo.request_purpose', 
                'jo.date_started', 
                'jo.date_completed', 
                'jo.particulars',
                DB::raw('datediff(jo.date_completed, jo.date_started) as work_duration'),
                'jo.conducted_by', 
                'jo.assessed_by', 
                'jo.date_assessed', 
                'jo.approved_by', 
                'jo.date_approved', 
                'jo.inspected_by', 
                'jo.date_inspected', 
                'jo.tested_by', 
                'jo.accepted_by', 
                'a.tag', 
                'a.name',
                'e.employee_id', 
                DB::raw('concat(trim(concat(e.lname," ",e.affix)),", ", e.fName," ", e.mName) as employee_name'),
                'p.project_code',
                'm.municipality_code',
                'm.municipality_text',
                'rp.request_purpose as request_purpose_text'
              )
            -> leftjoin('Assets as a','a.tag','=','jo.asset_tag')
            -> leftjoin('Projects as p','p.project_code','=','a.project_code')
            -> leftjoin('Municipalities as m','m.municipality_code','=','p.municipality_code')
            -> leftjoin('Employees as e','e.employee_id','=','a.assign_to')
            -> leftjoin('Request_purpose as rp','rp.request_purpose_id','=','jo.request_purpose');

    if ($data['joCode']){
      $job_orders = $job_orders->where('job_order_code', $data['joCode']);
    }

    $job_orders = $job_orders->get();

    return response()-> json([
      'status'=>200,
      'data'=>$job_orders,
      'message'=>''
    ])->setEncodingOptions(JSON_NUMERIC_CHECK);

  }

  public function save(Request $request){
    
    // return $request->all();
    $data = array();
    $data['date_requested'] = date('Y-m-d', strtotime($request->input('date_requested')));
    $data['date_needed'] = date('Y-m-d', strtotime($request->input('date_needed')));
    $data['request_purpose'] = $request->input('request_purpose');
    $data['description'] = $request->input('description');
    
    $transaction = DB::transaction(function($data) use($data){
    // try{

        $requisition = new Requisition;

        $risCode = (str_pad(($requisition->where('created_at', 'like', '%'.Carbon::now('Asia/Manila')->toDateString().'%')
        ->get()->count() + 1), 4, "0", STR_PAD_LEFT));

        $requisition->requisition_slip_code = "RS-".date('Ymd', strtotime(Carbon::now('Asia/Manila')))."-".$risCode;
        $requisition->date_requested = $data['date_requested'];
        $requisition->request_purpose = $data['request_purpose'];
        $requisition->date_needed = $data['date_needed'];
        $requisition->description = $data['description'];
        $requisition->request_type = 1;
        // $requisition->asset_tag = $data['assetTag'];
        $requisition->save();

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

  public function update(Request $request){
    
    // return $request->all();
    // echo "erikson";
    $data = array();
    // $data['purpose'] = $request->input('asset_tag');
    $data['purpose'] = $request->input('request_purpose');
    $data['orderDate'] = date('Y-m-d', strtotime($request->input('orderDate')));
    $data['date_started'] = date('Y-m-d', strtotime($request->input('date_started')));
    $data['date_completed'] = date('Y-m-d', strtotime($request->input('date_completed')));
    $data['job_order_code'] = $request->input('job_order_code');
    $data['conducted_by'] = $request->input('conducted_by');
    $data['particulars'] = $request->input('particulars');
    $data['work_duration'] = $request->input('work_duration');
    $data['date_approved'] = date('Y-m-d', strtotime($request->input('date_approved')));
    $data['approved_by'] = $request->input('approved_by');
    $data['date_assessed'] = date('Y-m-d', strtotime($request->input('date_assessed')));
    $data['assessed_by'] = $request->input('assessed_by');
    $data['date_inspected'] = date('Y-m-d', strtotime($request->input('date_inspected')));
    $data['inspected_by'] = $request->input('inspected_by');
    $data['accepted_by'] = $request->input('accepted_by');
    $data['tested_by'] = $request->input('tested_by');

    $transaction = DB::transaction(function($data) use($data){
    try{

          DB::table('job_orders')
            ->where('job_order_code', $data['job_order_code'])
            ->update([
              'date_started' => $data['date_started'],
              'date_completed' => $data['date_completed'],
              'accepted_by' => $data['accepted_by'],
              'particulars' => $data['particulars'],
              'work_duration' => $data['work_duration'],
              'date_approved' => $data['date_approved'],
              'approved_by' => $data['approved_by'],
              'date_assessed' => $data['date_assessed'],
              'assessed_by' => $data['assessed_by'],
              'date_inspected' => $data['date_inspected'],
              'inspected_by' => $data['inspected_by'],
              'conducted_by' => $data['conducted_by'],
              'request_purpose' => $data['purpose'],
              'tested_by' => $data['tested_by']
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

  // public function sampleDate()
  // {
  //   // echo Carbon::now('Asia/Manila');
  //   $jo = new JobOrder;
  //   // echo  $jo->get()->count();

  //   // echo date('Ymd', strtotime(Carbon::now('Asia/Manila')));
  //   echo  $count = (str_pad(($jo->where('created_at', 'like', '%'.Carbon::now('Asia/Manila')->toDateString().'%')->get()->count() + 1), 4, "0", STR_PAD_LEFT));
  // }

}