<?php
namespace App\Http\Controllers\Maintenance;
use Illuminate\Http\Request;

use DB;
use App\Employee;
use App\Project;
use App\Operation;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class OperationsController1 extends Controller {
   public function index(){
      return view('layout.index');
   }

   public function operations(Request $request){

    $data = array(
      'operationCode'=>$request->input('operationCode'),
    );

    $operations = DB::table('operations as o')
            ->select(
                'o.operation_code', 
                'o.operation_date', 
                'o.asset_tag',
                'o.project_code', 
                'o.remarks', 
                'o.operating_hours', 
                'o.distance_travelled', 
                'o.diesel_consumption', 
                'o.gas_consumption', 
                'o.oil_consumption', 
                'o.number_loads', 
                'a.tag', 
                'a.name as asset_name',
                'p.name as project_name'
              )
            -> leftjoin('Assets as a','a.tag','=','o.asset_tag')
            -> leftjoin('Projects as p','p.project_code','=','o.project_code');
            // -> leftjoin('Municipalities as m','m.municipality_code','=','p.municipality_code')
            // -> leftjoin('Employees as e','e.employee_id','=','a.assign_to')
            // -> leftjoin('Request_purpose as rp','rp.request_purpose_id','=','jo.request_purpose');

    if ($data['operationCode']){
      $operations = $operations->where('operation_code', $data['operationCode']);
    }

    $operations = $operations->get();

    return response()-> json([
      'status'=>200,
      'data'=>$operations,
      'message'=>''
    ])->setEncodingOptions(JSON_NUMERIC_CHECK);

  }

   public function save(Request $request){
    
    $data = array();
    $data['operationDate'] = date('Y-m-d', strtotime($request->input('operationDate')));
    $data['assetName'] = $request->input('assetName');
    $data['assetTag'] = $request->input('assetTag');
    $data['projectName'] = $request->input('projectName');
    $data['projectCode'] = $request->input('projectCode');
    $data['remarks'] = $request->input('remarks');
    $data['operatingHours'] = $request->input('operatingHours');
    $data['distanceTravelled'] = $request->input('distanceTravelled');
    $data['dieselConsumption'] = $request->input('dieselConsumption');
    $data['gasConsumption'] = $request->input('gasConsumption');
    $data['oilConsumption'] = $request->input('oilConsumption');
    $data['numberLoads'] = $request->input('numberLoads');
   
    $transaction = DB::transaction(function($data) use($data){
    try{

        $operation = new Operation;

        $operationCode = (str_pad(($operation->where('operation_date', 'like', '%'.Carbon::now('Asia/Manila')->toDateString().'%')
        ->get()->count() + 1), 4, "0", STR_PAD_LEFT));

        // $operation->operation_code = "OPN-".date('Ymd', strtotime(Carbon::now('Asia/Manila')))."-".$operationCode;
        $operation->operation_code = "OPN-".date('YmdHis', strtotime(Carbon::now('Asia/Manila')));
        $operation->operation_date = $data['operationDate']; 
        $operation->asset_tag = $data['assetTag']; 
        $operation->project_code = $data['projectCode']; 
        $operation->remarks = $data['remarks']; 
        $operation->operating_hours = $data['operatingHours']; 
        $operation->distance_travelled = $data['distanceTravelled']; 
        $operation->diesel_consumption = $data['dieselConsumption']; 
        $operation->gas_consumption = $data['gasConsumption']; 
        $operation->oil_consumption = $data['oilConsumption']; 
        $operation->number_loads = $data['numberLoads']; 
        $operation->save();

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