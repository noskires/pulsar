<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use DB;
use Auth;
use App\PurchaseOrder;
use App\PurchaseOrderItem;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class PurchaseOrdersController extends Controller {
	
	public function index(){
		return view('layout.index');
	}

	public function purchaseOrders(Request $request){

		$data = array(
			'poCode'=>$request->input('poCode'),
			'supplierCode'=>$request->input('supplierCode'),
			'status'=>$request->input('status'),
		);

		$pos = DB::table('purchase_orders AS po')
					->select(
                      'po.po_code',
                      'po.reference_code',
                      'po.request_type',
                      'po.received_by',
                      'po.date_received',
                      'po.inspected_by',
                      'po.date_inspected',
                      'po.old_reference',
                      's.supplier_code',
                      's.supplier_name',
                      's.supplier_owner',
                      's.bir_no',
                      's.address',
                      'e.employee_code',
                      DB::raw('CONCAT(trim(CONCAT(e.lname," ",COALESCE(e.affix,""))),", ", COALESCE(e.fname,"")," ", COALESCE(e.mname,"")) as requesting_employee')
                    )
                    ->leftjoin('suppliers as s','s.supplier_code','=','po.supplier_code')
                    ->leftjoin('receipts as r','r.purchase_order_code','=','po.po_code')
                    ->leftjoin('employees as e','e.employee_code','=','po.employee_code');

		if ($data['poCode']){
			$pos = $pos->where('po.po_code', $data['poCode']);
		}

		if ($data['supplierCode']){
			$pos = $pos->where('po.supplier_code', $data['supplierCode']);
		}

		if ($data['status'] == 1){
      		$pos = $pos->whereNull('r.purchase_order_code');
      	}

		$pos = $pos->get();

		

		foreach ($pos as $key => $po) {

			if($po->received_by && $po->date_received && $po->inspected_by && $po->date_inspected)
			{
				$po->status = "Closed";
			}
			else{
				$po->status = null;
			}

			if($po->request_type == "Office"){

		        $list = DB::table('organizations as organization')
		        ->select(
		          'organization.org_code as code',
		          'organization.org_name as name'
		        )
		        ->where('organization.org_code', $po->reference_code)
		        ->first();

		        if($list){

		          $po->reference_name = $list->name;
		          $po->reference_id = $list->code;
		          
		        }else{
		          
		          $po->reference_name = null;
		          $po->reference_id = null;

		        }

		      }
		      elseif($po->request_type == "Project"){

		        $list = DB::table('projects as project')
		        ->select(
		          'project.project_code',
		          'project.code',
		          'project.name'
		        )
		        ->where('project.project_code', $po->reference_code)
		        ->first();

		        if($list){

		          $po->reference_name = $list->name;
		          $po->reference_id = $list->code;
		          $po->asset_name = null;
		          
		        }else{
		          
		          $po->reference_name = null;
		          $po->reference_id = null;
		          $po->asset_name = null;
		        }

		      }
		      else{
		        $po->reference_name = null;
		        $po->reference_id = null;
		        $po->asset_name = null;

		      }
	      
	    }

	    
      
    

		return response()-> json([
			'status'=>200,
			'data'=>$pos,
			'message'=>''
		]);
	}

	public function save(Request $request){

		$data = Input::post();

		$transaction = DB::transaction(function($data) use($data){
		// try{
				$po = new PurchaseOrder;

				$poCode = (str_pad(($po->where('created_at', 'like', '%'.Carbon::now('Asia/Manila')->toDateString().'%')
			    ->get()->count() + 1), 4, "0", STR_PAD_LEFT));
				$po->po_code = "PO-".date('YmdHis', strtotime(Carbon::now('Asia/Manila')));
				$po->supplier_code = $data['supplier_code'];
				$po->request_type = $data['request_type'];
				$po->reference_code = $data['reference_code'];
				$po->old_reference = $data['old_reference'];
				$po->employee_code = $data['requesting_employee'];
				$po->changed_by = Auth::user()->email;
				$po->save();

				return response()->json([
				    'status' => 200,
				    'data' => 'null',
				    'message' => 'Successfully saved.'
				]);
			// }
			// catch (\Exception $e) 
			// {
			//   	return response()->json([
			// 	    'status' => 500,
			// 	    'data' => 'null',
			// 	    'message' => 'Error, please try again!'
			// 	]);
			// }
		});

		return $transaction;
	}

	public function update(Request $request){

		$data = Input::post();

		$transaction = DB::transaction(function($data) use($data){
		try{
				DB::table('purchase_orders')
				->where('po_code', $data['po_code'])
				->update([
					'supplier_code' => $data['supplier_code'],
					'received_by' => $data['received_by'],
					'date_received' => date('Y-m-d', strtotime($data['date_received'])),
					'inspected_by' => $data['inspected_by'],
					'date_inspected' => date('Y-m-d', strtotime($data['date_inspected']))
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

	public function purchaseOrderItems(Request $request){

	    $data = array(
	      'poCode'=>$request->input('poCode'),
	      'poItemCode'=>$request->input('poItemCode'),
	      'supplyCode'=>$request->input('supplyCode'),
	    );

	    // return $data['requisitionCode'];
	    $poItems = DB::table('purchase_order_items as poi')
	           ->select(
	                'poi.po_code', 
	                'poi.po_item_code',
	                'poi.supply_code',
	                's.supply_name',
	                'poi.item_description', 
	                'poi.item_quantity',
	                'poi.item_stock_unit'
	              )

	    ->leftjoin('supplies as s','s.supply_code','=','poi.supply_code');

	    if ($data['poCode']){
	      $poItems = $poItems->where('po_code', $data['poCode']);
	    }

	    if ($data['poItemCode']){
	      $poItems = $poItems->where('po_item_code', $data['poItemCode']);
	    }

	    if ($data['supplyCode']){
	      $poItems = $poItems->where('supply_code', $data['supplyCode']);
	    }

	    $poItems = $poItems->get();

	    return response()-> json([
	      'status'=>200,
	      'data'=>$poItems,
	      'message'=>''
	    ])->setEncodingOptions(JSON_NUMERIC_CHECK);

	}



	public function save_purchase_order_items(Request $request){
    // return $request->all();
    $data = Input::post();

    $transaction = DB::transaction(function($data) use($data){
    // try{

        for($i = 0; $i < count($data); $i++) {
          $purchaseOrderItem            = new PurchaseOrderItem;

          $purchaseOrderItemCode = (str_pad(($purchaseOrderItem->where('created_at', 'like', '%'.Carbon::now('Asia/Manila')->toDateString().'%')
          ->get()->count() + 1), 4, "0", STR_PAD_LEFT));

          $purchaseOrderItem->po_item_code 			= "POITM-".date('YmdHis', strtotime(Carbon::now('Asia/Manila')));
          $purchaseOrderItem->po_code     			= $data[$i]['po_code'];
          $purchaseOrderItem->supply_code     		= $data[$i]['supply_name'];
          $purchaseOrderItem->item_description      = $data[$i]['supply_desc'];
          $purchaseOrderItem->item_quantity 		= $data[$i]['supply_qty']; 
          $purchaseOrderItem->item_stock_unit  		= $data[$i]['supply_unit']; 
          $purchaseOrderItem->save(); // fixed typo

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

  public function remove_po_items(Request $request){
  
    $data = Input::post();

    $transaction = DB::transaction(function($data) use($data){
    // try{


        DB::table('purchase_order_items')->where('po_item_code', $data['po_item_code'])->delete();

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