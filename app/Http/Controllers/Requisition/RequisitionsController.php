<?php
namespace App\Http\Controllers\Requisition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use DB;
use Auth;
use App\Employee;
use App\Project;
use App\JobOrder;
use App\Requisition;
use App\RequisitionSlipItem;
use App\Supply;
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
      'requisitionStatus'=>$request->input('requisitionStatus'),
      'dateRequested'=>$request->input('dateRequested'),
      'requestType'=>$request->input('requestType'),
    );

    $requisitions = DB::table('requisition_slips as rs')
      ->select(
        'rs.requisition_slip_code', 
        'rs.date_requested',
        'rs.date_needed',
        'rs.remarks', 
        'rs.request_type',
        'rs.reference_code',
        'rs.job_order_code',
        'rs.received_by',
        DB::raw('CONCAT(trim(CONCAT(receivedEmployee.lname," ",COALESCE(receivedEmployee.affix,""))),", ", COALESCE(receivedEmployee.fname,"")," ", COALESCE(receivedEmployee.mname,"")) as received_by_name'),
        'rs.date_received',
        'rs.inspected_by',
        DB::raw('CONCAT(trim(CONCAT(inspectedEmployee.lname," ",COALESCE(inspectedEmployee.affix,""))),", ", COALESCE(inspectedEmployee.fname,"")," ", COALESCE(inspectedEmployee.mname,"")) as inspected_by_name'),
        'rs.date_inspected',
        'rs.withdrawal_remarks',
        'rs.old_reference',
        'rs.created_at',
        'rs.is_open',
        'rs.requesting_employee as employee_code',

        DB::raw(
          'CASE 
            WHEN rs.is_open = 1
            THEN "OPEN"
          ELSE 
            "CLOSED" 
          END AS status'
        ),

        // DB::raw(
        //   'CASE 
        //     WHEN rs.request_type = "Office" 
        //       THEN (SELECT organizations.org_name FROM organizations WHERE organizations.org_code=rs.reference_code)
        //     WHEN rs.request_type = "Project" 
        //       THEN (SELECT CONCAT(projects.code,"-",projects.name) AS reference_name FROM projects WHERE projects.project_code=rs.reference_code) 
        //   ELSE 
        //       "" 
        //   END as department'
        // ),

        DB::raw(
          'CASE 
            WHEN rs.request_type = "Office" 
              THEN (SELECT organizations.org_name FROM organizations WHERE organizations.org_code=rs.reference_code)
            WHEN rs.request_type = "Project" 
              THEN (SELECT CONCAT(projects.code,"-",projects.name) AS reference_name FROM projects WHERE projects.project_code=rs.reference_code) 
          ELSE 
              "" 
          END as reference_name'
        ),
        DB::raw(
          'CASE 
            WHEN rs.request_type = "Office" 
              THEN (SELECT organizations.org_name FROM organizations WHERE organizations.org_code=rs.reference_code)
            WHEN rs.request_type = "Project" 
              THEN (SELECT CONCAT(projects.code,"-",projects.name) AS reference_name FROM projects WHERE projects.project_code=rs.reference_code) 
          ELSE 
              "" 
          END as reference_name'
        ),
        // DB::raw(
        //   'CASE    
        //     WHEN rs.job_order_code IS NOT NULL 
        //       THEN (SELECT assets.code FROM job_orders, assets WHERE assets.asset_code=job_orders.asset_code AND job_orders.job_order_code = rs.job_order_code)
        //     WHEN rs.job_order_code IS NULL 
        //       THEN null
        //     END as reference_id'
        // ),
        DB::raw(
          'CASE 
            WHEN rs.job_order_code IS NULL 
              THEN null
            ELSE 
              (SELECT assets.name FROM job_orders, assets WHERE assets.asset_code=job_orders.asset_code AND job_orders.job_order_code = rs.job_order_code)
            END as asset_name'
        ),
        DB::raw(
          'CASE 
            WHEN rs.job_order_code IS NULL 
              THEN null
            ELSE 
              (SELECT assets.code FROM job_orders, assets WHERE assets.asset_code=job_orders.asset_code AND job_orders.job_order_code = rs.job_order_code)
            END as asset_code'
        )
      )
    ->leftjoin('employees as receivedEmployee','receivedEmployee.employee_code','=','rs.received_by')
    ->leftjoin('employees as inspectedEmployee','inspectedEmployee.employee_code','=','rs.inspected_by');

    if ($data['requisitionCode']){
      $requisitions = $requisitions->where('rs.requisition_slip_code', $data['requisitionCode']);
    }

    if ($data['requestType']){
      $requisitions = $requisitions->where('rs.request_type', $data['requestType']);
    }

    if($data['dateRequested']){
      $requisitions = $requisitions->whereDate('rs.date_requested', date('Y-m-d', strtotime($data['dateRequested'])));
    }

    if ($data['requisitionStatus'] == 1){

      $requisitions = $requisitions->where(DB::raw('CASE 
          WHEN rs.is_open = 1
            THEN "OPEN"
          ELSE 
            "CLOSED" 
          END'), 
        'OPEN'
      );
      
      // $requisitions = $requisitions->where(DB::raw('CASE 
      //       WHEN rs.date_received IS NULL 
      //         OR rs.received_by IS NULL 
      //         OR rs.received_by = "1970-01-01" 
      //         OR rs.date_inspected IS NULL 
      //         OR rs.inspected_by IS NULL 
      //       THEN "OPEN"
      //     ELSE 
      //       "CLOSED" 
      //     END'),  
      //   'OPEN'
      // ); 
    }

    if ($data['requisitionStatus'] == 2){


      $requisitions = $requisitions->where(DB::raw('CASE 
          WHEN rs.is_open = 1
            THEN "OPEN"
          ELSE 
            "CLOSED" 
          END'), 
        'CLOSED'
      );

      // $requisitions = $requisitions->where(DB::raw('CASE 
      //       WHEN rs.date_received IS NULL 
      //         OR rs.received_by IS NULL 
      //         OR rs.received_by = "1970-01-01" 
      //         OR rs.date_inspected IS NULL 
      //         OR rs.inspected_by IS NULL 
      //       THEN "OPEN"
      //     ELSE 
      //       "CLOSED" 
      //     END'), 
      //   'CLOSED'
      // );

    }
    
    $debugQuery = $requisitions;

    $requisitions = $requisitions->where('rs.record_status', 1);
    $requisitions = $requisitions->orderBy('rs.created_at');
    $requisitions = $requisitions->get();

    return response()-> json([
      'status'=>200,
      'data'=>$requisitions,
      'message'=>'',
      'debugQuery'=>$debugQuery
    ])->setEncodingOptions(JSON_NUMERIC_CHECK);
    
  }

  public function requisitionSlipItems(Request $request){

    $data = array(
      'requisitionCode'=>$request->input('requisitionCode'),
      'requisitionSlipItemCode'=>$request->input('requisitionSlipItemCode'),
      'supplyCode'=>$request->input('supplyCode'),
    );

    $requisitionSlipItems = DB::table('requisition_slips_items as rsi')
           ->select(
                'rsi.requisition_slip_code', 
                'rsi.requisition_slip_item_code',
                'rs.old_reference',
                'rs.date_requested',
                'rs.requesting_employee',
                DB::raw('CONCAT(trim(CONCAT(e.lname," ",COALESCE(e.affix,""))),", ", COALESCE(e.fname,"")," ", COALESCE(e.mname,"")) as requesting_employee_name'),
                'rsi.supply_code',
                's.supply_name',
                'rsi.item_description', 
                'rsi.item_quantity_requested',
                'rsi.item_quantity',
                'rsi.item_cost',
                'rsi.item_stock_unit',
                'rsi.item_purpose',
                'rsi.item_total',
                DB::raw(
                  'CASE 
                    WHEN rs.request_type = "Office" 
                      THEN (SELECT organizations.org_name FROM organizations WHERE organizations.org_code=rs.reference_code)
                    WHEN rs.request_type = "Project" 
                      THEN (SELECT CONCAT(projects.code,"-",projects.name) AS reference_name FROM projects WHERE projects.project_code=rs.reference_code) 
                  ELSE 
                      "" 
                  END as reference_name'
                ),
                DB::raw(
                  'CASE 
                    WHEN rs.job_order_code IS NULL 
                      THEN null
                    ELSE 
                      (SELECT assets.name FROM job_orders, assets WHERE assets.asset_code=job_orders.asset_code AND job_orders.job_order_code = rs.job_order_code)
                    END as asset_name'
                ), 
                DB::raw(
                  'CASE 
                    WHEN rs.job_order_code IS NULL 
                      THEN null
                    ELSE 
                      (SELECT assets.code FROM job_orders, assets WHERE assets.asset_code=job_orders.asset_code AND job_orders.job_order_code = rs.job_order_code)
                    END as asset_code'
                )
              )

    ->leftjoin('supplies as s','s.supply_code','=','rsi.supply_code')
    ->leftjoin('requisition_slips as rs','rs.requisition_slip_code','=','rsi.requisition_slip_code')
    ->leftjoin('employees as e','e.employee_code','=','rs.requesting_employee');


    if ($data['requisitionCode']){
      $requisitionSlipItems = $requisitionSlipItems->where('rsi.requisition_slip_code', $data['requisitionCode']);
    }

    if ($data['requisitionSlipItemCode']){
      $requisitionSlipItems = $requisitionSlipItems->where('rsi.requisition_slip_item_code', $data['requisitionSlipItemCode']);
    }

    if ($data['supplyCode']){
      $requisitionSlipItems = $requisitionSlipItems->where('s.supply_code', $data['supplyCode']);
    }

    $requisitionSlipItems = $requisitionSlipItems->get();

    return response()-> json([
      'status'=>200,
      'data'=>$requisitionSlipItems,
      'message'=>''
    ])->setEncodingOptions(JSON_NUMERIC_CHECK);

  }

  public function save_asset(Request $request){
    
    // return $request->all();
    $data = array();
    $data['jobOrderCode'] = $request->input('jobOrderCode');
    $data['date_requested'] = date('Y-m-d', strtotime($request->input('date_requested')));
    $data['date_needed'] = date('Y-m-d', strtotime($request->input('date_needed')));
    $data['description'] = $request->input('description');
    $data['request_type'] = $request->input('request_type');
    $data['reference_code'] = $request->input('reference_code');
    $data['requestingEmployee'] = $request->input('employee_code');
    $data['old_reference'] = $request->input('old_reference');
    
    $transaction = DB::transaction(function($data) use($data){
    // try{

        $requisition = new Requisition;

        $risCode = (str_pad(($requisition->where('created_at', 'like', '%'.Carbon::now('Asia/Manila')->toDateString().'%')
        ->get()->count() + 1), 4, "0", STR_PAD_LEFT));

        // $requisition->requisition_slip_code = "RS-".date('Ymd', strtotime(Carbon::now('Asia/Manila')))."-".$risCode;
        $requisition->requisition_slip_code   = "RS-".date('YmdHis', strtotime(Carbon::now('Asia/Manila')))."-".$risCode;
        $requisition->date_requested          = $data['date_requested'];
        $requisition->date_needed             = $data['date_needed'];
        $requisition->remarks                 = $data['description'];
        $requisition->request_type            = $data['request_type'];;
        $requisition->reference_code          = $data['reference_code'];
        $requisition->requesting_employee     = $data['requestingEmployee'];
        $requisition->job_order_code          = $data['jobOrderCode'];
        $requisition->old_reference           = $data['old_reference'];
        $requisition->is_open                 = 1;
        $requisition->record_status           = 1;

        $requisition->changed_by              = Auth::user()->email;
        $requisition->save();

        return response()->json([
            'status' => 200,
            'data' => $data,
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
        $requisition->requisition_slip_code = "RS-".date('YmdHis', strtotime(Carbon::now('Asia/Manila')))."-".$risCode;
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
    $data['old_reference'] = $request->input('old_reference');
    $data['remarks'] = $request->input('remarks');
    
    $transaction = DB::transaction(function($data) use($data){
    try{

        $requisition = new Requisition;

        $risCode = (str_pad(($requisition->where('created_at', 'like', '%'.Carbon::now('Asia/Manila')->toDateString().'%')
        ->get()->count() + 1), 4, "0", STR_PAD_LEFT));

        $requisition->requisition_slip_code = "RS-".date('YmdHis', strtotime(Carbon::now('Asia/Manila')))."-".$risCode;
        $requisition->date_requested = $data['date_requested'];
        $requisition->date_needed = $data['date_needed'];
        $requisition->request_type = $data['request_type'];
        $requisition->reference_code = $data['reference_code'];
        $requisition->requesting_employee = $data['requesting_employee'];
        $requisition->old_reference = $data['old_reference'];
        $requisition->remarks = $data['remarks'];
        $requisition->record_status = 1;
        $requisition->is_open = 1;
        $requisition->changed_by = Auth::user()->email;
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

  public function update(Request $request){
    
    $data = array();
  
    $data['requisition_slip_code'] = $request->input('requisition_slip_code');
    $data['received_by'] = $request->input('received_by');
    $data['date_received'] = date('Y-m-d', strtotime($request->input('date_received')));
    $data['inspected_by'] = $request->input('inspected_by');
    $data['date_inspected'] = date('Y-m-d', strtotime($request->input('date_inspected')));
    $data['withdrawal_remarks'] = $request->input('withdrawal_remarks');
    $data['is_open'] = $request->input('is_open');

    // return $data;

    $transaction = DB::transaction(function($data) use($data){
    try{

          if($data['date_received']=='1970-01-01'){
            $data['date_received'] = null;
          }

          if($data['date_inspected']=='1970-01-01'){
            $data['date_inspected'] = null;
          }

          $requisitionSlip = Requisition::where('requisition_slip_code', $data['requisition_slip_code'])->first();
          $requisitionSlip->received_by        = $data['received_by'];
          $requisitionSlip->date_received      = $data['date_received'];
          $requisitionSlip->inspected_by       = $data['inspected_by'];
          $requisitionSlip->date_inspected     = $data['date_inspected'];
          $requisitionSlip->withdrawal_remarks = $data['withdrawal_remarks'];
          $requisitionSlip->is_open            = $data['is_open'];
          $requisitionSlip->changed_by         = Auth::user()->email;
          $requisitionSlip->timestamps         = true;
          $requisitionSlip->save();

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

  public function update2(Request $request){
    
    $data = array();
    
    $data['requisition_slip_code']              = $request->input('requisition_slip_code');
    $data['date_needed']          = date('Y-m-d', strtotime($request->input('date_needed')));
    $data['date_requested']       = date('Y-m-d', strtotime($request->input('date_requested')));
    $data['old_reference']        = $request->input('old_reference');
    $data['request_type']         = $request->input('request_type');
    $data['reference_code']       = $request->input('reference_code');
    $data['requesting_employee']  = $request->input('employee_code');
    $data['remarks']              = $request->input('remarks');

    // return $data;

    $transaction = DB::transaction(function($data) use($data){
    // try{

          if($data['date_needed']=='1970-01-01'){
            $data['date_needed'] = null;
          }

          if($data['date_requested']=='1970-01-01'){
            $data['date_requested'] = null;
          }

          $requisitionSlip = Requisition::where('requisition_slip_code', $data['requisition_slip_code'])->first();
          $requisitionSlip->date_needed           = $data['date_needed'];
          $requisitionSlip->date_requested        = $data['date_requested'];
          $requisitionSlip->old_reference         = $data['old_reference'];
          $requisitionSlip->request_type          = $data['request_type'];
          $requisitionSlip->reference_code        = $data['reference_code'];
          $requisitionSlip->requesting_employee   = $data['requesting_employee'];
          $requisitionSlip->remarks               = $data['remarks'];
          $requisitionSlip->changed_by            = Auth::user()->email;
          $requisitionSlip->timestamps            = true;
          $requisitionSlip->save();

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
  
  public function update_record_status(Request $request){

		$data = Input::post();

		$transaction = DB::transaction(function($data) use($data){
		// try{

				$rsi_count = DB::table('requisition_slips_items AS rsi')->where('rsi.requisition_slip_code', $data['requisition_slip_code'])
					->get()->count();

				if($rsi_count==0){

					$ris = Requisition::where('requisition_slip_code', $data['requisition_slip_code'])->first();
					$ris->record_status        	= 0;
					$ris->changed_by       		  = Auth::user()->email;
					$ris->save();

					return response()->json([
						'status' => 200,
						'data' => 'null',
						'message' => 'Successfully deleted.'
					]);

				}
				else{
					return response()->json([
						'status' => 200,
						'data' => 'null',
						'message' => 'Your attempt to delete this '. $data['requisition_slip_code'].' could not be completed because there are items associated on this record.'
					]);
				}
			// }
			// catch (\Exception $e)
			// {
			// 	return response()->json([
			// 		'status' => 500,
			// 		'data' => 'null',
			// 		'message' => 'Error, please try again!'
			// 	]);
			// }
		});

		return $transaction;
	}

  public function save_requisition_slip_items(Request $request){
    // return $request->all();
    $data = Input::post();

    $transaction = DB::transaction(function($data) use($data){
    try{

        // for($i = 0; $i < count($data); $i++) {
          $requisitionSlipItem            = new RequisitionSlipItem;

          $requisitionSlipItemCode = (str_pad(($requisitionSlipItem->where('created_at', 'like', '%'.Carbon::now('Asia/Manila')->toDateString().'%')
          ->get()->count() + 1), 4, "0", STR_PAD_LEFT));

          $requisitionSlipItem->requisition_slip_item_code = "RSITM-".date('YmdHis', strtotime(Carbon::now('Asia/Manila')))."-".$requisitionSlipItemCode;

          $requisitionSlipItem->requisition_slip_code     = $data['requisition_slip_code'];
          $requisitionSlipItem->supply_code               = $data['supply_name'];
          $requisitionSlipItem->item_description          = $data['supply_desc'];	
          $requisitionSlipItem->item_quantity_requested   = $data['supply_qty_requested'];
          $requisitionSlipItem->item_quantity             = $data['supply_qty'];
          $requisitionSlipItem->item_cost                 = $data['supply_cost'];
          $requisitionSlipItem->item_stock_unit           = $data['supply_unit'];
          $requisitionSlipItem->item_total                = $data['supply_total'];
          $requisitionSlipItem->item_purpose              = $data['item_purpose'];
          $requisitionSlipItem->changed_by                = Auth::user()->email;
          $requisitionSlipItem->save(); // fixed typo

          $supply = Supply::where('supply_code', $data['supply_name'])->first();
          $supply->quantity         = $supply->quantity - $data['supply_qty'];
          $supply->changed_by       = Auth::user()->email;
          $supply->timestamps       = true;
          $supply->save();

        // }

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

  public function remove_requisition_slip_items(Request $request){
  
    $data = Input::post();

    $transaction = DB::transaction(function($data) use($data){
    // try{

        $supply = Supply::where('supply_code', $data['requisition_item_supply_code'])->first();
        $supply->quantity         = $supply->quantity + $data['requisition_item_quantity'];
        $supply->changed_by       = Auth::user()->email;
        $supply->timestamps       = true;
        $supply->save();

        RequisitionSlipItem::where('requisition_slip_item_code', $data['requisition_slip_item_code'])->firstOrFail()->delete();

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