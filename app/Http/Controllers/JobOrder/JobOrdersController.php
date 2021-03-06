<?php
namespace App\Http\Controllers\JobOrder;
use Illuminate\Http\Request;

use DB;
use Auth;
use App\Employee;
use App\Project;
use App\AssetEvent;
use App\JobOrder;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class JobOrdersController extends Controller {

  public function index(){
    return view('layout.index');
  }

  public function job_orders(Request $request){

    $data = array(
      'joCode'=>$request->input('joCode'),
      'joStatus'=>$request->input('joStatus'),
      'date_started'=>$request->input('date_started'),
      'assetCode'=>$request->input('assetCode'),
      'assetCategory'=>$request->input('assetCategory'),
    );

    $job_orders = DB::table('job_orders as jo')
      ->select(
          'jo.job_order_code', 
          'jo.job_order_date', 
          'jo.organizational_unit', 
          'jo.date_started', 
          // DB::raw('DATE_FORMAT(jo.date_started, "%m/%d/%Y") as date_started'),
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
          'jo.date_accepted', 
          'jo.operating_hours', 
          'jo.distance_travelled', 
          'jo.diesel_consumption', 
          'jo.gas_consumption', 
          'jo.oil_consumption', 
          'jo.number_loads', 
          'jo.old_reference', 
          'a.asset_code', 
          'a.code', 
          'a.name',
          'a.category',
          'org.org_name as organizational_unit_name',
          'org.barangay as barangay',
          'm.municipality_code as municipality_code',
          'm.municipality_text',
          'p.province_code as province_code',
          'p.province_text',
          'r.region_code as region_code',
          'r.region_text_short',
          'r.region_text_long',
          'are.are_code',
          'e.employee_code as requested_by',
          DB::raw('CONCAT(trim(CONCAT(e.lname," ",COALESCE(e.affix,""))),", ", COALESCE(e.fname,"")," ", COALESCE(e.mname,"")) as employee_name')
        )

      
      ->leftjoin('assets as a','a.asset_code','=','jo.asset_code')
      ->leftjoin('ares as are','are.are_code','=','a.are_code')
      ->leftjoin('employees as e','e.employee_code','=','jo.employee_code')
      ->leftjoin('organizations as org','org.org_code','=','jo.organizational_unit')
      ->leftjoin('municipalities as m','m.municipality_code','=','jo.municipality_code')
      ->leftjoin('provinces as p','p.province_code','=','m.province_code')
      ->leftjoin('regions as r','r.region_code','=','p.region_code')
      
      ;

    if ($data['joCode']){
      $job_orders = $job_orders->where('job_order_code', $data['joCode']);
    }

    if($data['date_started']){
      $job_orders = $job_orders->whereDate('jo.date_started', date('Y-m-d', strtotime($data['date_started'])));
    }

    if ($data['joStatus']==1){
      $job_orders = $job_orders->whereNull('jo.date_completed');
    }

    if($data['joStatus']==2){
      $job_orders = $job_orders->whereNotNull('jo.date_completed');
    }

    if($data['assetCode']){
      $job_orders = $job_orders->where('a.asset_code', $data['assetCode']);
    }

    if ($data['assetCategory']){
      $job_orders = $job_orders->where('a.category', $data['assetCategory']);
    }



    $debugQuery = $job_orders;

    $job_orders = $job_orders->get();

    return response()-> json([
      'status'=>200,
      'data'=>$job_orders,
      'count'=>$job_orders->count(),
      'message'=>'',
      // 'date_started'=>'',
      'debug'=>$debugQuery
    ])->setEncodingOptions(JSON_NUMERIC_CHECK);

  }

  // public function save(Request $request){
    
  //   $data = array();
  //   $data['orderDate'] = date('Y-m-d', strtotime($request->input('orderDate'))); 
  //   $data['assetTag'] = $request->input('tag');
  //   $data['employee_code'] = $request->input('employee_code');
  //   $data['organizational_unit'] = $request->input('organizational_unit');
  //   $data['municipality_code'] = $request->input('municipality_code');
    
  //   $transaction = DB::transaction(function($data) use($data){
  //   // try{

  //       $asset = DB::table('assets as a')
  //           ->select( 
  //                     'a.a',
  //                     'a.name as asset_name', 
  //                     'a.asset_code as asset_code', 
  //                     DB::raw("COALESCE(SUM(o.operating_hours), 0) as total_operating_hours"),
  //                     DB::raw("COALESCE(SUM(o.distance_travelled), 0) as total_distance_travelled"),
  //                     DB::raw("COALESCE(SUM(o.diesel_consumption), 0) as total_diesel_consumption"),
  //                     DB::raw("COALESCE(SUM(o.gas_consumption), 0) as total_gas_consumption"),
  //                     DB::raw("COALESCE(SUM(o.oil_consumption), 0) as total_oil_consumption"),
  //                     DB::raw("COALESCE(SUM(o.number_loads), 0) as total_number_loads")
  //                   )
  //           ->leftjoin('operations as o','o.asset_code','=','a.asset_code')
  //           ->leftjoin('Projects as p','p.project_code','=','o.project_code')
  //           ->groupBy('a.tag', 'a.name', 'a.asset_code')
  //           ->where('a.tag', $data['assetTag'])
  //           ->first();


  //       // return $asset;
  //       $jo = new JobOrder;
  //       $joCode = (str_pad(($jo->where('created_at', 'like', '%'.Carbon::now('Asia/Manila')->toDateString().'%')
  //       ->get()->count() + 1), 4, "0", STR_PAD_LEFT));

  //       // $jo->job_order_code = "JO-".date('Ymd', strtotime(Carbon::now('Asia/Manila')))."-".$joCode;
  //       $jo->job_order_code = "JO-".date('YmdHis', strtotime(Carbon::now('Asia/Manila')))."-".$joCode;
  //       $jo->job_order_date = $data['orderDate']; 
  //       $jo->date_started = $data['orderDate'];
  //       $jo->asset_tag = $data['assetTag'];
  //       // $jo->asset_tag = $data['assetTag'];
  //       // $jo->asset_code = $asset->asset_code;
  //       $jo->employee_code = $data['employee_code'];
  //       $jo->organizational_unit = $data['organizational_unit'];
  //       $jo->municipality_code = $data['municipality_code'];
  //       $jo->operating_hours = $asset->total_operating_hours;
  //       $jo->distance_travelled = $asset->total_distance_travelled;
  //       $jo->diesel_consumption = $asset->total_diesel_consumption;
  //       $jo->gas_consumption = $asset->total_gas_consumption;
  //       $jo->oil_consumption = $asset->total_oil_consumption;
  //       $jo->number_loads = $asset->total_number_loads;
  //       $jo->changed_by = Auth::user()->email;
  //       $jo->save();

  //       //add repair event
  //       $assetEvent = new AssetEvent;
  //       // $asset->asset_event_code = $data['categoryCode']."-".date('Ymd', strtotime($data['dateAcquired']))."-".$data['assetID'];
  //       $assetEvent->asset_event_code = 1212;
  //       $assetEvent->status = "MAINTENANCE";
  //       $assetEvent->asset_tag = $data['assetTag'];
  //       $assetEvent->event_date = $data['orderDate'];
  //       $assetEvent->remarks = "Under Maintenance";
  //       $assetEvent->save();

  //       DB::table('assets')
  //           ->where('tag', $data['assetTag'])
  //           ->update([
  //             'status' => 'MAINTENANCE'
  //           ]);

  //       return response()->json([
  //           'status' => 200,
  //           'data' => 'null',
  //           'message' => 'Successfully saved.'
  //       ]);

  //       return response()->json([
  //           'status' => 200,
  //           'data' => 'null',
  //           'message' => 'Successfully saved.'
  //       ]);

  //     // }
  //     // catch (\Exception $e) 
  //     // {
  //     //     return response()->json([
  //     //       'status' => 500,
  //     //       'data' => 'null',
  //     //       'message' => 'Error, please try again!'
  //     //   ]);
  //     // }
  //   });

  //   return $transaction;
  // }

  public function save2(Request $request){
    
    $data = array();
    $data['orderDate'] = date('Y-m-d', strtotime($request->input('orderDate'))); 
    $data['assetCode'] = $request->input('assetCode');
    $data['employee_code'] = $request->input('employee_code');
    $data['old_reference'] = $request->input('reference');
    
    $transaction = DB::transaction(function($data) use($data){
    // try{

        $employee = DB::table('employees as e')
                    ->select( 
                      'e.organizational_unit',
                      'o.municipality_code'
                    )
                    ->leftjoin('organizations as o','o.org_code','=','e.organizational_unit')
                    ->where('e.employee_code', $data['employee_code'])->first();

        $asset = DB::table('assets as a')
            ->select( 
                      'a.tag',
                      'a.name as asset_name', 
                      'a.asset_code', 
                      DB::raw("COALESCE(SUM(o.operating_hours), 0) as total_operating_hours"),
                      DB::raw("COALESCE(SUM(o.distance_travelled), 0) as total_distance_travelled"),
                      DB::raw("COALESCE(SUM(o.diesel_consumption), 0) as total_diesel_consumption"),
                      DB::raw("COALESCE(SUM(o.gas_consumption), 0) as total_gas_consumption"),
                      DB::raw("COALESCE(SUM(o.oil_consumption), 0) as total_oil_consumption"),
                      DB::raw("COALESCE(SUM(o.number_loads), 0) as total_number_loads")
                    )
            ->leftjoin('operations as o','o.asset_code','=','a.asset_code')
            // ->leftjoin('Projects as p','p.project_code','=','o.project_code')
            ->groupBy('a.tag', 'a.name', 'a.asset_code')
            ->where('a.asset_code', $data['assetCode'])
            ->first();


        // return $asset;
        $jo = new JobOrder;
        $joCode = (str_pad(($jo->where('created_at', 'like', '%'.Carbon::now('Asia/Manila')->toDateString().'%')
        ->get()->count() + 1), 4, "0", STR_PAD_LEFT));

        $jo->job_order_code           = "JO-".date('YmdHis', strtotime(Carbon::now('Asia/Manila')))."-".$joCode;
        $jo->job_order_date           = $data['orderDate']; 
        $jo->date_started             = $data['orderDate']; 
        $jo->asset_code               = $asset->asset_code;
        $jo->employee_code            = $data['employee_code'];
        $jo->organizational_unit      = $employee->organizational_unit;
        $jo->municipality_code        = $employee->municipality_code;
        $jo->operating_hours          = $asset->total_operating_hours;
        $jo->distance_travelled       = $asset->total_distance_travelled;
        $jo->diesel_consumption       = $asset->total_diesel_consumption;
        $jo->gas_consumption          = $asset->total_gas_consumption;
        $jo->oil_consumption          = $asset->total_oil_consumption;
        $jo->number_loads             = $asset->total_number_loads;
        $jo->old_reference            = $data['old_reference'];
        $jo->changed_by               = Auth::user()->email;
        $jo->save();

        //add repair event
        $assetEvent = new AssetEvent;
        $assetEvent->asset_event_code = "AEVNT-".date('YmdHis', strtotime(Carbon::now('Asia/Manila')));
        $assetEvent->status           = "MAINTENANCE";
        $assetEvent->asset_code       = $data['assetCode'];
        $assetEvent->event_date       = $data['orderDate'];
        $assetEvent->remarks          = "Under Maintenance";
        $assetEvent->save();

        // DB::table('assets')
        //     ->where('tag', $data['assetTag'])
        //     ->update([
        //       'status' => 'MAINTENANCE'
        //     ]);

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
    $data['asset_code'] = $request->input('asset_code');
    $data['orderDate'] = date('Y-m-d', strtotime($request->input('orderDate')));
    $data['date_started'] = date('Y-m-d', strtotime($request->input('date_started')));
    $data['date_completed'] = date('Y-m-d', strtotime($request->input('date_completed')));
    $data['job_order_code'] = $request->input('job_order_code');
    $data['employee_code'] = $request->input('requested_by');
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
    $data['date_accepted'] = date('Y-m-d', strtotime($request->input('date_accepted')));
    $data['tested_by'] = $request->input('tested_by');

    $transaction = DB::transaction(function($data) use($data){
    // try{

          if($data['date_completed']=='1970-01-01'){
            $data['date_completed'] = null;
          }
          else
          {
            //add repair event
            $assetEvent = new AssetEvent;
            $assetEvent->asset_event_code = "AEVNT-".date('YmdHis', strtotime(Carbon::now('Asia/Manila')));
            $assetEvent->status = "ACTIVE";
            $assetEvent->asset_code = $data['asset_code'];
            $assetEvent->event_date = $data['date_completed'];
            $assetEvent->remarks = "Active";
            $assetEvent->save();

            DB::table('assets')
            ->where('asset_code', $data['asset_code'])
            ->update([
              'status' => 'ACTIVE'
            ]);
          }

          if($data['date_started']=='1970-01-01'){
            $data['date_started'] = null;
          }

          if($data['date_approved']=='1970-01-01'){
            $data['date_approved'] = null;
          }

          if($data['date_assessed']=='1970-01-01'){
            $data['date_assessed'] = null;
          }

          if($data['date_inspected']=='1970-01-01'){
            $data['date_inspected'] = null;
          }

          if($data['date_accepted']=='1970-01-01'){
            $data['date_accepted'] = null;
          }

          DB::table('job_orders')
            ->where('job_order_code', $data['job_order_code'])
            ->update([
              'date_started' => $data['date_started'],
              'date_completed' => $data['date_completed'],
              'accepted_by' => $data['accepted_by'],
              'date_accepted' => $data['date_accepted'],
              'employee_code' => $data['employee_code'],
              'particulars' => $data['particulars'],
              'work_duration' => $data['work_duration'],
              'date_approved' => $data['date_approved'],
              'approved_by' => $data['approved_by'],
              'date_assessed' => '2018-10-07',
              'assessed_by' => $data['assessed_by'],
              'date_inspected' => $data['date_inspected'],
              'inspected_by' => $data['inspected_by'],
              'conducted_by' => $data['conducted_by'],
              // 'request_purpose' => $data['purpose'],
              'tested_by' => $data['tested_by']
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