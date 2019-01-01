<?php
namespace App\Http\Controllers\Requisition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use DB;
use App\Employee;
use App\Project;
use App\JobOrder;
use App\Requisition;
use App\RequisitionSlipItem;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class RequisitionsController extends Controller {

  public function index(){
    return view('layout.index');
  }

  public function requisitions(Request $request){

    $data = array(
      'requisitionCode'=>$request->input('requisitionCode'),
    );

    $requisitions = DB::table('requisition_slips as rs')
              ->select(
                'rs.requisition_slip_code', 
                'rs.date_requested',
                'rs.date_needed',
                'rs.description', 
                'rs.request_type',
                'rs.reference_code',
                'rs.received_by',
                DB::raw('CONCAT(trim(CONCAT(receivedEmployee.lname," ",COALESCE(receivedEmployee.affix,""))),", ", COALESCE(receivedEmployee.fname,"")," ", COALESCE(receivedEmployee.mname,"")) as received_by_name'),
                'rs.date_received',
                'rs.inspected_by',
                DB::raw('CONCAT(trim(CONCAT(inspectedEmployee.lname," ",COALESCE(inspectedEmployee.affix,""))),", ", COALESCE(inspectedEmployee.fname,"")," ", COALESCE(inspectedEmployee.mname,"")) as inspected_by_name'),
                'rs.date_inspected'
              )
    ->leftjoin('employees as receivedEmployee','receivedEmployee.employee_code','=','rs.received_by')
    ->leftjoin('employees as inspectedEmployee','inspectedEmployee.employee_code','=','rs.inspected_by');

    if ($data['requisitionCode']){
      $requisitions = $requisitions->where('requisition_slip_code', $data['requisitionCode']);
    }

    $requisitions = $requisitions->get();


    foreach ($requisitions as $key => $requisition) {

      if($requisition->received_by && $requisition->date_received && $requisition->inspected_by && $requisition->date_inspected)
      {

        $requisition->status = "Closed";
      }
      else{
        $requisition->status = null;
      }
      
    }

    return response()-> json([
      'status'=>200,
      'data'=>$requisitions,
      'message'=>''
    ])->setEncodingOptions(JSON_NUMERIC_CHECK);

  }

  public function requisitionSlipItems(Request $request){

    $data = array(
      'requisitionCode'=>$request->input('requisitionCode'),
      'requisitionSlipItemCode'=>$request->input('requisitionSlipItemCode'),
      'supplyCode'=>$request->input('supplyCode'),
    );

    // return $data['requisitionCode'];
    $requisitionSlipItems = DB::table('requisition_slips_items as rsi')
           ->select(
                'rsi.requisition_slip_code', 
                'rsi.requisition_slip_item_code',
                'rsi.supply_code',
                's.supply_name',
                'rsi.item_description', 
                'rsi.item_quantity',
                'rsi.item_cost',
                'rsi.item_stock_unit',
                'rsi.item_total'
              )

    ->leftjoin('supplies as s','s.supply_code','=','rsi.supply_code');


    if ($data['requisitionCode']){
      $requisitionSlipItems = $requisitionSlipItems->where('requisition_slip_code', $data['requisitionCode']);
    }

    if ($data['requisitionSlipItemCode']){
      $requisitionSlipItems = $requisitionSlipItems->where('requisition_slip_item_code', $data['requisitionSlipItemCode']);
    }

    if ($data['supplyCode']){
      $requisitionSlipItems = $requisitionSlipItems->where('supply_code', $data['supplyCode']);
    }

    $requisitionSlipItems = $requisitionSlipItems->get();

    return response()-> json([
      'status'=>200,
      'data'=>$requisitionSlipItems,
      'message'=>''
    ])->setEncodingOptions(JSON_NUMERIC_CHECK);

  }

  // public function job_orders(Request $request){

  //   $data = array(
  //     'joCode'=>$request->input('joCode'),
  //   );

  //   $job_orders = DB::table('job_orders as jo')
  //           ->select(
  //               'jo.job_order_code', 
  //               'jo.job_order_date', 
  //               'jo.request_purpose', 
  //               'jo.date_started', 
  //               'jo.date_completed', 
  //               'jo.particulars',
  //               DB::raw('datediff(jo.date_completed, jo.date_started) as work_duration'),
  //               'jo.conducted_by', 
  //               'jo.assessed_by', 
  //               'jo.date_assessed', 
  //               'jo.approved_by', 
  //               'jo.date_approved', 
  //               'jo.inspected_by', 
  //               'jo.date_inspected', 
  //               'jo.tested_by', 
  //               'jo.accepted_by', 
  //               'a.tag',
  //               'a.name',
  //               'e.employee_id',
  //               DB::raw('concat(trim(concat(e.lname," ",e.affix)),", ", e.fName," ", e.mName) as employee_name'),
  //               'p.project_code',
  //               'm.municipality_code',
  //               'm.municipality_text',
  //               'rp.request_purpose as request_purpose_text'
  //             )
  //           -> leftjoin('Assets as a','a.tag','=','jo.asset_tag')
  //           -> leftjoin('Projects as p','p.project_code','=','a.project_code')
  //           -> leftjoin('Municipalities as m','m.municipality_code','=','p.municipality_code')
  //           -> leftjoin('Employees as e','e.employee_id','=','a.assign_to')
  //           -> leftjoin('Request_purpose as rp','rp.request_purpose_id','=','jo.request_purpose');

  //   if ($data['joCode']){
  //     $job_orders = $job_orders->where('job_order_code', $data['joCode']);
  //   }

  //   $job_orders = $job_orders->get();

  //   return response()-> json([
  //     'status'=>200,
  //     'data'=>$job_orders,
  //     'message'=>''
  //   ])->setEncodingOptions(JSON_NUMERIC_CHECK);

  // }

  public function save_asset(Request $request){
    
    // return $request->all();
    $data = array();
    $data['date_requested'] = date('Y-m-d', strtotime($request->input('date_requested')));
    $data['date_needed'] = date('Y-m-d', strtotime($request->input('date_needed')));
    $data['description'] = $request->input('description');
    $data['jobOrderCode'] = $request->input('jobOrderCode');
    
    $transaction = DB::transaction(function($data) use($data){
    // try{

        $requisition = new Requisition;

        $risCode = (str_pad(($requisition->where('created_at', 'like', '%'.Carbon::now('Asia/Manila')->toDateString().'%')
        ->get()->count() + 1), 4, "0", STR_PAD_LEFT));

        // $requisition->requisition_slip_code = "RS-".date('Ymd', strtotime(Carbon::now('Asia/Manila')))."-".$risCode;
        $requisition->requisition_slip_code = "RS-".date('YmdHis', strtotime(Carbon::now('Asia/Manila')));
        $requisition->date_requested = $data['date_requested'];
        $requisition->date_needed = $data['date_needed'];
        $requisition->description = $data['description'];
        $requisition->request_type = "Asset";
        $requisition->reference_code = $data['jobOrderCode'];
        $requisition->requesting_employee = 816000001;
        $requisition->save();

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

  public function save_project(Request $request){
    
    // return $request->all();
    $data = array();
    $data['date_requested'] = date('Y-m-d', strtotime($request->input('date_requested')));
    $data['date_needed'] = date('Y-m-d', strtotime($request->input('date_needed')));
    $data['description'] = $request->input('description');
    $data['projectCode'] = $request->input('projectCode');
    
    $transaction = DB::transaction(function($data) use($data){
    try{

        $requisition = new Requisition;

        $risCode = (str_pad(($requisition->where('created_at', 'like', '%'.Carbon::now('Asia/Manila')->toDateString().'%')
        ->get()->count() + 1), 4, "0", STR_PAD_LEFT));

        // $requisition->requisition_slip_code = "RS-".date('Ymd', strtotime(Carbon::now('Asia/Manila')))."-".$risCode;
        $requisition->requisition_slip_code = "RS-".date('YmdHis', strtotime(Carbon::now('Asia/Manila')));
        $requisition->date_requested = $data['date_requested'];
        $requisition->date_needed = $data['date_needed'];
        $requisition->description = $data['description'];
        $requisition->request_type = "Project";
        $requisition->reference_code = $data['projectCode'];
        $requisition->save();

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

  public function save_office(Request $request){
    
    // return $request->all();
    $data = array();
    $data['date_requested'] = date('Y-m-d', strtotime($request->input('date_requested')));
    $data['date_needed'] = date('Y-m-d', strtotime($request->input('date_needed')));
    $data['description'] = $request->input('description');
    $data['reference_code'] = $request->input('reference_code');
    $data['request_type'] = $request->input('request_type');
    $data['requesting_employee'] = $request->input('requesting_employee');
    
    $transaction = DB::transaction(function($data) use($data){
    // try{

        $requisition = new Requisition;

        $risCode = (str_pad(($requisition->where('created_at', 'like', '%'.Carbon::now('Asia/Manila')->toDateString().'%')
        ->get()->count() + 1), 4, "0", STR_PAD_LEFT));

        $requisition->requisition_slip_code = "RS-".date('YmdHis', strtotime(Carbon::now('Asia/Manila')));
        $requisition->date_requested = $data['date_requested'];
        $requisition->date_needed = $data['date_needed'];
        $requisition->description = $data['description'];
        $requisition->request_type = $data['request_type'];
        $requisition->reference_code = $data['reference_code'];
        $requisition->requesting_employee = $data['requesting_employee'];
        $requisition->save();

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
  
    $data['requisition_slip_code'] = $request->input('requisition_slip_code');
    $data['received_by'] = $request->input('received_by');
    $data['date_received'] = date('Y-m-d', strtotime($request->input('date_received')));
    $data['inspected_by'] = $request->input('inspected_by');
    $data['date_inspected'] = date('Y-m-d', strtotime($request->input('date_inspected')));

    // return $data;

    $transaction = DB::transaction(function($data) use($data){
    try{

          if($data['date_received']=='1970-01-01'){
            $data['date_received'] = null;
          }

          if($data['date_inspected']=='1970-01-01'){
            $data['date_inspected'] = null;
          }

          DB::table('requisition_slips')
            ->where('requisition_slip_code', $data['requisition_slip_code'])
            ->update([
              'received_by' => $data['received_by'],
              'date_received' => $data['date_received'],
              'inspected_by' => $data['inspected_by'],
              'date_inspected' => $data['date_inspected']
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

  public function save_requisition_slip_items(Request $request){
    // return $request->all();
    $data = Input::post();

    $transaction = DB::transaction(function($data) use($data){
    // try{

        for($i = 0; $i < count($data); $i++) {
          $requisitionSlipItem            = new RequisitionSlipItem;

          $requisitionSlipItemCode = (str_pad(($requisitionSlipItem->where('created_at', 'like', '%'.Carbon::now('Asia/Manila')->toDateString().'%')
          ->get()->count() + 1), 4, "0", STR_PAD_LEFT));

          // $requisitionSlipItem->requisition_slip_item_code = "RSITM-".date('Ymd', strtotime(Carbon::now('Asia/Manila')))."-".$requisitionSlipItemCode;
          $requisitionSlipItem->requisition_slip_item_code = "RSITM-".date('YmdHis', strtotime(Carbon::now('Asia/Manila')));

          $requisitionSlipItem->requisition_slip_code     = $data[$i]['requisition_slip_code'];
          $requisitionSlipItem->supply_code     = $data[$i]['supply_name'];
          $requisitionSlipItem->item_description      = $data[$i]['supply_desc'];
          $requisitionSlipItem->item_quantity = $data[$i]['supply_qty'];
          $requisitionSlipItem->item_cost = $data[$i]['supply_cost'];
          $requisitionSlipItem->item_stock_unit  = $data[$i]['supply_unit'];
          $requisitionSlipItem->item_total  = $data[$i]['supply_total'];
          $requisitionSlipItem->save(); // fixed typo

          $supply = DB::table('supplies')
          ->select('quantity')
          ->where('supply_code', $data[$i]['supply_name'])
          ->first();

          $totalQuantity = $supply->quantity - $data[$i]['supply_qty'];

          DB::table('supplies')
          ->where('supply_code', $data[$i]['supply_name'])
            ->update([
              'quantity' => $totalQuantity
            ]);
        }

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

  public function remove_requisition_slip_items(Request $request){
  
    $data = Input::post();

    $transaction = DB::transaction(function($data) use($data){
    // try{


        $supply = DB::table('supplies')
          ->select('quantity')
          ->where('supply_code', $data['requisition_item_supply_code'])
          ->first();

          $totalQuantity = $supply->quantity + $data['requisition_item_quantity'];

        DB::table('supplies')
          ->where('supply_code', $data['requisition_item_supply_code'])
            ->update([
              'quantity' => $totalQuantity
            ]);

        DB::table('requisition_slips_items')->where('requisition_slip_item_code', $data['requisition_slip_item_code'])->delete();

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