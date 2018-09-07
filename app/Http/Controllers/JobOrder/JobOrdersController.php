<?php
namespace App\Http\Controllers\JobOrder;
use Illuminate\Http\Request;

use DB;
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
      'assetTag'=>$request->input('assetTag'),
    );

    $job_orders = DB::table('job_orders as jo')
      ->select(
          'jo.job_order_code', 
          'jo.job_order_date', 
          // 'jo.request_purpose', 
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
          'jo.operating_hours', 
          'jo.distance_travelled', 
          'jo.diesel_consumption', 
          'jo.gas_consumption', 
          'jo.oil_consumption', 
          'jo.number_loads', 
          'a.tag', 
          'a.name',
          // 'e.employee_id', 
          // DB::raw('concat(trim(concat(e.lname," ",e.affix)),", ", e.fName," ", e.mName) as employee_name'),
          'p.project_code',
          'm.municipality_code',
          'm.municipality_text'
          // 'rp.request_purpose as request_purpose_text'
        )
      -> leftjoin('Assets as a','a.tag','=','jo.asset_tag')
      -> leftjoin('Projects as p','p.project_code','=','a.project_code')
      -> leftjoin('Municipalities as m','m.municipality_code','=','p.municipality_code');
      // -> leftjoin('Employees as e','e.employee_id','=','a.assign_to');
      // -> leftjoin('Request_purpose as rp','rp.request_purpose_id','=','jo.request_purpose');

    if ($data['joCode']){
      $job_orders = $job_orders->where('job_order_code', $data['joCode']);
    }

    if ($data['joStatus']==1){
      $job_orders = $job_orders->whereNull('jo.date_completed');
    }

    if ($data['assetTag']){
      $job_orders = $job_orders->where('a.tag', $data['assetTag']);
    }

    $job_orders = $job_orders->get();

    return response()-> json([
      'status'=>200,
      'data'=>$job_orders,
      'message'=>''
    ])->setEncodingOptions(JSON_NUMERIC_CHECK);

  }

  public function save(Request $request){
    
    $data = array();
    $data['orderDate'] = date('Y-m-d', strtotime($request->input('orderDate'))); 
    $data['assetTag'] = $request->input('tag');
    
    $transaction = DB::transaction(function($data) use($data){
    // try{

        $asset = DB::table('assets as a')
            ->select( 
                      'a.tag',
                      'a.name as asset_name', 
                      DB::raw("COALESCE(SUM(o.operating_hours), 0) as total_operating_hours"),
                      DB::raw("COALESCE(SUM(o.distance_travelled), 0) as total_distance_travelled"),
                      DB::raw("COALESCE(SUM(o.diesel_consumption), 0) as total_diesel_consumption"),
                      DB::raw("COALESCE(SUM(o.gas_consumption), 0) as total_gas_consumption"),
                      DB::raw("COALESCE(SUM(o.oil_consumption), 0) as total_oil_consumption"),
                      DB::raw("COALESCE(SUM(o.number_loads), 0) as total_number_loads")
                    )
            ->leftjoin('operations as o','o.asset_tag','=','a.tag')
            ->leftjoin('Projects as p','p.project_code','=','o.project_code')
            ->groupBy('a.tag', 'a.name')
            ->where('a.tag', $data['assetTag'])
            ->first();


        // return $asset;
        $jo = new JobOrder;
        $joCode = (str_pad(($jo->where('created_at', 'like', '%'.Carbon::now('Asia/Manila')->toDateString().'%')
        ->get()->count() + 1), 4, "0", STR_PAD_LEFT));

        $jo->job_order_code = "JO-".date('Ymd', strtotime(Carbon::now('Asia/Manila')))."-".$joCode;
        $jo->job_order_date = $data['orderDate']; 
        $jo->date_started = $data['orderDate'];
        $jo->asset_tag = $data['assetTag'];
        $jo->operating_hours = $asset->total_operating_hours;
        $jo->distance_travelled = $asset->total_distance_travelled;
        $jo->diesel_consumption = $asset->total_diesel_consumption;
        $jo->gas_consumption = $asset->total_gas_consumption;
        $jo->oil_consumption = $asset->total_oil_consumption;
        $jo->number_loads = $asset->total_number_loads;

        $jo->save();

        //add repair event
        $assetEvent = new AssetEvent;
        // $asset->asset_event_code = $data['categoryCode']."-".date('Ymd', strtotime($data['dateAcquired']))."-".$data['assetID'];
        $assetEvent->asset_event_code = 1212;
        $assetEvent->status = "MAINTENANCE";
        $assetEvent->asset_tag = $data['assetTag'];
        $assetEvent->event_date = $data['orderDate'];
        $assetEvent->remarks = "Under Maintenance";
        $assetEvent->save();

        DB::table('assets')
            ->where('tag', $data['assetTag'])
            ->update([
              'status' => 'MAINTENANCE'
            ]);

        return response()->json([
            'status' => 200,
            'data' => 'null',
            'message' => 'Successfully saved.'
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

  public function update(Request $request){
  
    $data = array();
    // $data['purpose'] = $request->input('asset_tag');
    // $data['purpose'] = $request->input('request_purpose');
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
    $data['asset_tag'] = $request->input('tag');

    $transaction = DB::transaction(function($data) use($data){
    // try{

          if($data['date_completed']=='1970-01-01'){
            $data['date_completed'] = null;
          }
          else
          {
            //add repair event
            $assetEvent = new AssetEvent;
            // $asset->asset_event_code = $data['categoryCode']."-".date('Ymd', strtotime($data['dateAcquired']))."-".$data['assetID'];
            $assetEvent->asset_event_code = 1212;
            $assetEvent->status = "ACTIVE";
            $assetEvent->asset_tag = $data['asset_tag'];
            $assetEvent->event_date = $data['date_completed'];
            $assetEvent->remarks = "Active";
            $assetEvent->save();

            DB::table('assets')
            ->where('tag', $data['asset_tag'])
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

  // public function sampleDate()
  // {
  //   // echo Carbon::now('Asia/Manila');
  //   $jo = new JobOrder;
  //   // echo  $jo->get()->count();

  //   // echo date('Ymd', strtotime(Carbon::now('Asia/Manila')));
  //   echo  $count = (str_pad(($jo->where('created_at', 'like', '%'.Carbon::now('Asia/Manila')->toDateString().'%')->get()->count() + 1), 4, "0", STR_PAD_LEFT));
  // }
}