<?php
namespace App\Http\Controllers
;
use Illuminate\Http\Request;

use DB;
use App\Organization;
use App\Warranty;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use PDF;

class UtilizationReportController extends Controller {

	public function export($utilizationCode){

		$data['utilization'] 				= $this->utilizations($utilizationCode);
		$data['requisition_slip_items'] 	= $this->requisition_slip_items($data['utilization']->reference_code);

		// return $data;

		$pdf = PDF::loadView('utilization.report_utilization_office', $data);
		return $pdf->stream('utilization.report_utilization_office.pdf');
	}

	public function utilizations($utilizationCode){

		$data = DB::table('utilizations as utilization')
		->select(

			'utilization.utilization_code',
			'utilization.request_type',
			'utilization.reference_code',
			'utilization.employee_code',
			'utilization.received_by',
			'utilization.date_received',
			'utilization.inspected_by',
			'utilization.date_inspected',
			'municipality.municipality_text',
			'municipality.municipality_code',
			'province.province_text',
			'province.province_code',
			'region.region_text_long',
			'region.region_text_short',
			'region.region_code',
          	DB::raw('CASE 
				WHEN utilization.request_type = "Office" 
					THEN (SELECT CONCAT(org_name," (",org_code,")")  FROM organizations WHERE org_code=utilization.reference_code)
				WHEN utilization.request_type = "Project"
					THEN (SELECT CONCAT(name," (",code,")")  FROM projects WHERE project_code=utilization.reference_code)
				ELSE "" 
				END AS reference_name'
			),
			DB::raw('CASE 
				WHEN utilization.request_type = "Office" 
					THEN (SELECT municipality_code  FROM organizations WHERE org_code=utilization.reference_code)
				WHEN utilization.request_type = "Project"
					THEN (SELECT municipality_code  FROM projects WHERE project_code=utilization.reference_code)
				ELSE "" 
				END AS municipality_code2'
			)

		)
		->leftjoin('organizations as organization','organization.org_code','=','utilization.reference_code')
		->leftjoin('municipalities as municipality','municipality.municipality_code','=',
			DB::raw('CASE 
				WHEN utilization.request_type = "Office" 
					THEN (SELECT municipality_code  FROM organizations WHERE org_code=utilization.reference_code)
				WHEN utilization.request_type = "Project"
					THEN (SELECT municipality_code  FROM projects WHERE project_code=utilization.reference_code)
				ELSE "" 
				END'
			)
		)
        ->leftjoin('provinces as province','province.province_code','=','municipality.province_code')
		->leftjoin('regions as region','region.region_code','=','province.region_code')
		->where('utilization.utilization_code', $utilizationCode)
		->first();

		return $data;
	}


	public function requisition_slip_items($reference_code){

		$data = DB::table('requisition_slips_items as rsi')
		->select(
			'rs.reference_code',
			'rsi.supply_code',
			'supply.supply_name',
			'supply.stock_unit',
			'supply.description',
			'supply.category_code',
			'supply_category.supply_category_name',
			DB::raw("CAST(COALESCE(SUM(rsi.item_quantity), 0) as INT) AS total_item_quantity_ris"),
			DB::raw("(SELECT CAST(SUM(utilization_items.item_quantity) AS INT) 
					FROM utilizations, utilization_items 
					WHERE utilizations.utilization_code = utilization_items.utilization_code 
					AND utilizations.reference_code = rs.reference_code
					AND utilization_items.supply_code = rsi.supply_code)
					AS total_item_quantity_utilization")
		)
		->leftjoin('requisition_slips as rs','rs.requisition_slip_code','=','rsi.requisition_slip_code')
		->leftjoin('supplies as supply','supply.supply_code','=','rsi.supply_code')
		->leftjoin('supply_categories as supply_category','supply_category.supply_category_code','=','supply.category_code')
		->where('rs.reference_code', $reference_code)
		->whereNotNull('rs.date_received')
		->whereNotNull('rs.received_by')
		->whereNotNull('rs.date_inspected')
		->whereNotNull('rs.inspected_by')
 
		->groupBy('rs.reference_code', 'rsi.supply_code', 'supply.supply_name', 'supply.stock_unit', 'supply.description', 'supply.category_code', 'supply_category.supply_category_name')
		->get();

		return $data->groupBy('supply_category_name');
	}

	public function supply_categories(){
		$data = DB::table('supply_categories')->get();
		return $data;
	}

}