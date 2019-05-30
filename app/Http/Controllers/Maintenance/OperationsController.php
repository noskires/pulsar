<?php
namespace App\Http\Controllers\Maintenance;
use Illuminate\Http\Request;

Use Auth;
use DB;
use App\Employee;
use App\Project;
use App\Operation;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class OperationsController extends Controller {
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
                // 'o.asset_tag',
                'o.project_code', 
                'o.remarks', 
                'o.operating_hours', 
                'o.distance_travelled', 
                'o.diesel_consumption', 
                'o.gas_consumption', 
                'o.oil_consumption', 
                'o.number_loads', 
                'a.tag', 
                'a.asset_code', 
                'a.code', 
                'a.name as asset_name',
                'project.name as project_name',
                'm.municipality_code as municipality_code',
                'm.municipality_text',
                'p.province_code as province_code',
                'p.province_text',
                'r.region_code as region_code',
                'r.region_text_short',
                'r.region_text_long'
              )
            ->leftjoin('assets as a','a.asset_code','=','o.asset_code')
            ->leftjoin('projects as project','project.project_code','=','o.project_code')
            ->leftjoin('municipalities as m','m.municipality_code','=','project.municipality_code')
            ->leftjoin('provinces as p','p.province_code','=','m.province_code')
            ->leftjoin('regions as r','r.region_code','=','p.region_code');

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


  public function assets_monitoring(Request $request){

      $data = array(
        'assetCode'=>$request->input('assetCode'),
      );

      $assets = DB::table('assets as a')
              ->select( 
                        'a.asset_code',
                        'a.name as asset_name', 
                        DB::raw("COALESCE(SUM(o.operating_hours), 0) as total_operating_hours"),
                        DB::raw("COALESCE(SUM(o.distance_travelled), 0) as total_distance_travelled"),
                        DB::raw("COALESCE(SUM(o.diesel_consumption), 0) as total_diesel_consumption"),
                        DB::raw("COALESCE(SUM(o.gas_consumption), 0) as total_gas_consumption"),
                        DB::raw("COALESCE(SUM(o.oil_consumption), 0) as total_oil_consumption"),
                        DB::raw("COALESCE(SUM(o.number_loads), 0) as total_number_loads")
                      )
            ->leftjoin('operations as o','o.asset_code','=','a.asset_code')
            ->groupBy('a.asset_code', 'a.name')
            ->leftjoin('projects as p','p.project_code','=','o.project_code')
            ->where('a.category', 'CONE');

      if ($data['assetCode']){
        $assets = $assets->where('a.asset_code', $data['assetCode']);
      }

      $assets = $assets->get();

      return response()-> json([
          'status'=>200,
          'data'=>$assets
      ])->setEncodingOptions(JSON_NUMERIC_CHECK);
  }

   public function save(Request $request){

    $data = array();
    $data['operationDate']        = date('Y-m-d', strtotime($request->input('operationDate')));
    $data['assetName']            = $request->input('assetName');
    $data['assetCode']            = $request->input('assetCode');
    $data['assetTag']             = $request->input('assetTag');
    $data['projectName']          = $request->input('projectName');
    $data['projectCode']          = $request->input('projectCode');
    $data['remarks']              = $request->input('remarks');
    $data['operatingHours']       = $request->input('operatingHours');
    $data['distanceTravelled']    = $request->input('distanceTravelled');
    $data['dieselConsumption']    = $request->input('dieselConsumption');
    $data['gasConsumption']       = $request->input('gasConsumption');
    $data['oilConsumption']       = $request->input('oilConsumption');
    $data['numberLoads']          = $request->input('numberLoads');
   
    $transaction = DB::transaction(function($data) use($data){
    // try{

        $operation = new Operation;

        $operationCode = (str_pad(($operation->where('operation_date', 'like', '%'.Carbon::now('Asia/Manila')->toDateString().'%')
        ->get()->count() + 1), 4, "0", STR_PAD_LEFT));

        $operation->operation_code      = "OPN-".date('YmdHis', strtotime(Carbon::now('Asia/Manila')))."-".$operationCode;
        $operation->operation_date      = $data['operationDate']; 
        $operation->asset_code           = $data['assetCode']; 
        // $operation->asset_tag           = $data['assetTag']; 
        $operation->project_code        = $data['projectCode']; 
        $operation->remarks             = $data['remarks']; 
        $operation->operating_hours     = $data['operatingHours']; 
        $operation->distance_travelled  = $data['distanceTravelled']; 
        $operation->diesel_consumption  = $data['dieselConsumption']; 
        $operation->gas_consumption     = $data['gasConsumption']; 
        $operation->oil_consumption     = $data['oilConsumption']; 
        $operation->number_loads        = $data['numberLoads']; 
        $operation->changed_by          = Auth::user()->email;
        $operation->save();

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