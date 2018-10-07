<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use DB;
use App\Organization;
use App\Warranty;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use PDF;

class PdfController extends Controller {
   public function index(){
      // return view('employee.index');
    $pdf = PDF::loadView('asset.report1');
    return $pdf->stream('asset.report1.pdf');
   }

   public function export($assetTag){
      // return view('employee.index');

    $data['some_data'] = array('you', 'are', 'the', 'one');
    $data['assetTag'] = $assetTag;

    $data['asset']            = $this->asset($assetTag);
    $data['asset_photo']      = $this->asset_photo($assetTag);
    $data['asset_monitoring'] = $this->asset_monitoring($assetTag);
    $data['jos']              = $this->jo($assetTag);
    $data['events']           = $this->events($assetTag);
    $data['insurance']        = $this->insurance($assetTag);

    $pdf = PDF::loadView('asset.report1',  $data);
    return $pdf->stream('asset.report1.pdf');
   }

   public function asset($assetTag){
    $asset = DB::table('Assets as a')
            // ->select('*')
            ->select(
                DB::raw('CONCAT(trim(CONCAT(e.lname," ",COALESCE(e.affix,""))),", ", COALESCE(e.fname,"")," ", COALESCE(e.mname,"")) as employee_name'),
                'a.asset_id',
                'a.tag', 
                'a.code', 
                'a.are_code', 
                'a.name',
                'a.category',
                'a.model',
                'a.brand',
                'a.description',
                DB::raw('DATE_FORMAT(a.date_acquired, "%M %d, %Y") as date_acquired'),
                'a.acquisition_cost',
                'a.plate_no',
                'a.engine_no',
                'a.chassis_no',
                DB::raw('DATE_FORMAT(a.warranty_date, "%M %d, %Y") as warranty_date'),
                'a.project_code',
                'a.status',
                'sc.asset_category',
                'sc.asset_name',
                'e.organizational_unit',
                'org.org_name as organizational_unit_name',
                'org.barangay as barangay',
                'm.municipality_code as municipality_code',
                'm.municipality_text',
                'p.province_code as province_code',
                'p.province_text',
                'r.region_code as region_code',
                'r.region_text_short',
                'r.region_text_long'
              )

            ->leftjoin('asset_categories as sc','sc.asset_code','=','a.category')
            ->leftjoin('ares as are','are.are_code','=','a.are_code')
            ->leftjoin('Employees as e','e.employee_code','=','are.employee_code')
            ->leftjoin('organizations as org','org.org_code','=','e.organizational_unit')
            ->leftjoin('municipalities as m','m.municipality_code','=','org.municipality_code')
            ->leftjoin('provinces as p','p.province_code','=','m.province_code')
            ->leftjoin('regions as r','r.region_code','=','p.region_code');

          $asset = $asset->where('a.tag', $assetTag);
        
        $asset = $asset->first();

        return $asset;
   }


   public function asset_monitoring($assetTag){
    $assets = DB::table('assets as a')
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
            ->where('a.category', 'CONE');


        $assets = $assets->where('tag', $assetTag);


      $assets = $assets->first();

      return $assets;
   }

   public function asset_photo($assetTag){

    $data = DB::table('asset_photos as ap')->where('ap.asset_tag', $assetTag)->where('ap.asset_photo_status', 1)->first();
    return $data;
   }

   public function jo($assetTag){

    $data = DB::table('job_orders as jo')->where('jo.asset_tag', $assetTag)->get();
    return $data;
   }

   public function events($assetTag){

    $data = DB::table('asset_events as ae')->where('ae.asset_tag', $assetTag)->get();
    return $data;
   }

   public function insurance($assetTag){

    $data = DB::table('insurance_items as ii')->where('ii.asset_code', $assetTag)->leftjoin('insurance as i','i.insurance_code','=','ii.insurance_code')
    ->get();
    return $data;
   }



}