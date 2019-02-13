<?php
namespace App\Http\Controllers\Supply
;
use Illuminate\Http\Request;

use DB;
use App\Organization;
use App\Warranty;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use PDF;

class SupplyReportController extends Controller {

	public function index(){
	  	// return view('employee.index');
		$pdf = PDF::loadView('asset.report1');
		return $pdf->stream('asset.report1.pdf');
	}

	public function export($supplyCode){

		$data['supply'] 			= $this->supply($supplyCode);

		$data['receipt_items'] 			= $this->receipt_items($supplyCode);

		$data['requisition_slip_items'] = $this->requisition_slip_items($supplyCode);

		$receipt_items = $this->receipt_items($supplyCode);

		// return $receipt_items->get();
		$requisition_slips_items =  $this->requisition_slip_items($supplyCode);
		// return $requisition_slips_items->get();

		$data['stock_items'] = $receipt_items->union($requisition_slips_items)->orderBy('date')->get();

		// foreach ($data['stock_items'] as $key => $stock_item) {
		// 	if($stock_item->payee_type=="SUPPLIER")
		// 	{
		// 		$supplier = DB::table('suppliers as s')
		// 				->select('s.supplier_name')
		// 				->where('s.supplier_code', $stock_item->payee)->first();

		// 		if($supplier)
		// 		{
		// 			$stock_item->particulars = $supplier->supplier_name . " ( ".$stock_item->payee." )";
		// 		}
		// 		else
		// 		{
		// 			$stock_item->particulars = $stock_item->asset_name;
		// 		}
		// 	}
		// 	else
		// 	{
		// 		$stock_item->particulars = $stock_item->asset_name;
		// 	}
		// }

		// return $data['stock_items'];

		$pdf = PDF::loadView('supply.report_supply', $data);
		return $pdf->stream('supply.report_supply.pdf');
	}

	public function supply($supplyCode){

		$data = DB::table('supplies as s')
				->where('s.supply_code', $supplyCode)->first();
		return $data;
	}

	public function receipt_items($supplyCode){

		$data = DB::table('receipt_items as ri')
				->select(
					'ri.created_at as date',
					'ri.receipt_code as reference',
					'ri.receipt_item_quantity as quantity',
					DB::raw('"RCP" as type'),
					'r.payee_type as payee_type',
					'r.payee as payee',
					DB::raw('null as request_type'),
					'supplier.supplier_name as particulars'
					
				)
				->leftjoin('receipts as r','r.receipt_code','=','ri.receipt_code')
				->leftjoin('suppliers as supplier','supplier.supplier_code','=','r.payee')
				->where('ri.receipt_item_supply_code', $supplyCode);
		return $data;
	}

	public function requisition_slip_items($supplyCode){

		$data = DB::table('requisition_slips as rs')
				->select(
					'ris.created_at as date',
					'ris.requisition_slip_code as reference',
					'ris.item_quantity as quantity',
					DB::raw('"RIS" as type'),
					DB::raw('null as payee_type'),
					DB::raw('null as payee'),
					// DB::raw('CONCAT(CONCAT(a.name," ( ",COALESCE(a.code,"")," )")) as asset_name'),

					DB::raw('CASE 
						WHEN rs.request_type = "Office" 
							THEN "Office"
						WHEN rs.request_type = "Project"
							THEN "Project"
						ELSE "" 
						END AS request_type'
					),

					DB::raw('CASE 
						WHEN rs.request_type = "Office" 
							THEN (SELECT CONCAT(org_name," (",org_code,")")  FROM organizations WHERE org_code=rs.reference_code)
						WHEN rs.request_type = "Project"
							THEN (SELECT CONCAT(name," (",code,")")  FROM projects WHERE project_code=rs.reference_code)
						ELSE "" 
						END AS particulars'
					)
				)
				->join('requisition_slips_items as ris','ris.requisition_slip_code','=','rs.requisition_slip_code')
				// ->leftjoin('assets as a','a.tag','=','jo.asset_tag')
				->where('ris.supply_code', $supplyCode);
		return $data;
	}


}