<?php
namespace App\Http\Controllers\JobOrder;
use Illuminate\Http\Request;

use DB;
use App\Organization;
use App\Warranty;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use PDF;

class JobOrderReportController extends Controller {

	public function index(){
	  	// return view('employee.index');
		$pdf = PDF::loadView('asset.report1');
		return $pdf->stream('asset.report1.pdf');
	}

	public function export($jobOrderCode){

		$data['job_order']        = $this->job_order($jobOrderCode);
		$data['requisition_slips'] = $this->requisition_slips($jobOrderCode);

		$data['requisition_slip_items'] = array();

		foreach($data['requisition_slips'] as $requisition_slip){
			array_push($data['requisition_slip_items'], $this->requisition_slip_items($requisition_slip->requisition_slip_code));
		}

		$data['asset']            = $this->asset($data['job_order']->asset_code);
		$data['asset_photo']      = $this->asset_photo($data['job_order']->asset_code);

		// return $data;

		$pdf = PDF::loadView('job_order.report_jo', $data);
		return $pdf->stream('job_order.report_jo.pdf');
	}

	public function job_order($jobOrderCode){

		$data = DB::table('job_orders as jo')
		->select(

			'jo.job_order_code',
			'jo.job_order_date',
			'jo.employee_code',
			DB::raw('CONCAT(trim(CONCAT(reqby.lname," ",COALESCE(reqby.affix,""))),", ", COALESCE(reqby.fname,"")," ", COALESCE(reqby.mname,"")) as requested_by_name'),
			'jo.organizational_unit',
			'jo.municipality_code',
			'jo.particulars',
			'jo.date_started',
			'jo.date_completed',
			'jo.work_duration',
			'jo.conducted_by',
			DB::raw('CONCAT(trim(CONCAT(conby.lname," ",COALESCE(conby.affix,""))),", ", COALESCE(conby.fname,"")," ", COALESCE(conby.mname,"")) as conducted_by_name'),
			'jo.assessed_by',
			'jo.date_assessed',
			'jo.approved_by',
			DB::raw('CONCAT(trim(CONCAT(aprby.lname," ",COALESCE(aprby.affix,""))),", ", COALESCE(aprby.fname,"")," ", COALESCE(aprby.mname,"")) as approved_by_name'),
			'jo.date_approved',
			'jo.inspected_by',
			DB::raw('CONCAT(trim(CONCAT(insby.lname," ",COALESCE(insby.affix,""))),", ", COALESCE(insby.fname,"")," ", COALESCE(insby.mname,"")) as inspected_by_name'),
			'jo.date_inspected',
			'jo.tested_by',
			'jo.accepted_by',
			DB::raw('CONCAT(trim(CONCAT(accby.lname," ",COALESCE(accby.affix,""))),", ", COALESCE(accby.fname,"")," ", COALESCE(accby.mname,"")) as accepted_by_name'),
			'jo.date_accepted',
			'jo.operating_hours',
			'jo.distance_travelled',
			'jo.diesel_consumption',
			'jo.gas_consumption',
			'jo.oil_consumption',
			'jo.number_loads',
			'jo.asset_code',
			'recbypos.position_text as received_by_position',
			'insbypos.position_text as inspected_by_position'
		)
		->leftjoin('employees as reqby','reqby.employee_code','=','jo.employee_code')
		->leftjoin('employees as conby','conby.employee_code','=','jo.conducted_by')
		->leftjoin('employees as accby','accby.employee_code','=','jo.accepted_by')
		->leftjoin('employees as aprby','aprby.employee_code','=','jo.approved_by')
		->leftjoin('employees as insby','insby.employee_code','=','jo.inspected_by')
		->leftjoin('positions as recbypos','recbypos.position_code','=','reqby.position_code')
		->leftjoin('positions as insbypos','insbypos.position_code','=','insby.position_code')
		->where('jo.job_order_code', $jobOrderCode)
		->first();

		return $data;
	}

	public function asset($assetCode){
		$asset = DB::table('assets as a')
		// ->select('*')
		->select(
			DB::raw('CONCAT(trim(CONCAT(e.lname," ",COALESCE(e.affix,""))),", ", COALESCE(e.fname,"")," ", COALESCE(e.mname,"")) as employee_name'),
			'a.asset_id',
			// 'a.tag', 
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
			'sc.asset_category_code',
			'sc.asset_category_name',
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
		->leftjoin('asset_categories as sc','sc.asset_category_code','=','a.category')
		->leftjoin('ares as are','are.are_code','=','a.are_code')
		->leftjoin('Employees as e','e.employee_code','=','are.employee_code')
		->leftjoin('organizations as org','org.org_code','=','e.organizational_unit')
		->leftjoin('municipalities as m','m.municipality_code','=','org.municipality_code')
		->leftjoin('provinces as p','p.province_code','=','m.province_code')
		->leftjoin('regions as r','r.region_code','=','p.region_code');
		$asset = $asset->where('a.asset_code', $assetCode);
		$asset = $asset->first();

		return $asset;
	}

	public function requisition_slips($jobOrderCode){

		$data = DB::table('requisition_slips as rs')
		->select(
			'rs.requisition_slip_code',
			'rs.date_requested',
			'rs.date_needed',
			'rs.remarks',
			'rs.request_type',
			'rs.reference_code',
			'rs.received_by',
			DB::raw('CONCAT(trim(CONCAT(recby.lname," ",COALESCE(recby.affix,""))),", ", COALESCE(recby.fname,"")," ", COALESCE(recby.mname,"")) as received_by_name'),
			'rs.date_received',
			'rs.inspected_by',
			DB::raw('CONCAT(trim(CONCAT(insby.lname," ",COALESCE(insby.affix,""))),", ", COALESCE(insby.fname,"")," ", COALESCE(insby.mname,"")) as inspected_by_name'),
			'rs.date_inspected'
		)
		->leftjoin('employees as recby','recby.employee_code','=','rs.received_by')
		->leftjoin('employees as insby','insby.employee_code','=','rs.inspected_by')
		->where('rs.reference_code', $jobOrderCode)
		->get();

		return $data;
	}

	public function requisition_slip_items($requisitionItemCode){

		$data = DB::table('requisition_slips_items as rsi')
		->select(
			'rsi.requisition_slip_item_code',
			'rsi.requisition_slip_code',
			'rsi.supply_code',
			'rsi.item_description',
			'rsi.item_quantity',
			'rsi.item_cost',
			'rsi.item_stock_unit',
			'rsi.item_total',
			's.supply_name'
		)
		->leftjoin('supplies as s','s.supply_code','=','rsi.supply_code')
		->where('rsi.requisition_slip_code', $requisitionItemCode)
		->get();

		return $data;
	}

	// public function asset_monitoring($assetTag){
	// 	$assets = DB::table('assets as a')
	// 	->select( 
	// 		'a.tag',
	// 		'a.name as asset_name', 
	// 		DB::raw("COALESCE(SUM(o.operating_hours), 0) as total_operating_hours"),
	// 		DB::raw("COALESCE(SUM(o.distance_travelled), 0) as total_distance_travelled"),
	// 		DB::raw("COALESCE(SUM(o.diesel_consumption), 0) as total_diesel_consumption"),
	// 		DB::raw("COALESCE(SUM(o.gas_consumption), 0) as total_gas_consumption"),
	// 		DB::raw("COALESCE(SUM(o.oil_consumption), 0) as total_oil_consumption"),
	// 		DB::raw("COALESCE(SUM(o.number_loads), 0) as total_number_loads")
	// 	)
	// 	->leftjoin('operations as o','o.asset_tag','=','a.tag')
	// 	->leftjoin('Projects as p','p.project_code','=','o.project_code')
	// 	->groupBy('a.tag', 'a.name')
	// 	->where('a.category', 'CONE');
	// 	$assets = $assets->where('tag', $assetTag);
	// 	$assets = $assets->first();

	// 	return $assets;
	// }

	public function asset_photo($assetCode){

		$data = DB::table('asset_photos as ap')->where('ap.asset_code', $assetCode)->where('ap.asset_photo_status', 1)->first();
		return $data;
	}

	public function insurance($assetTag){

		$data = DB::table('insurance_items as ii')->where('ii.asset_code', $assetTag)->leftjoin('insurance as i','i.insurance_code','=','ii.insurance_code')
		->get();
		return $data;
	}

}