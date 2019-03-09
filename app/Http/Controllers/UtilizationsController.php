<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use DB;
use Auth;
use App\Utilization;
use App\UtilizationItem;
use App\PurchaseOrder;
use App\PurchaseOrderItem;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class UtilizationsController extends Controller {

	public function index(){
		return view('layout.index');
	}

	public function utilizations(Request $request){

		$data = array(
			'utilizationCode'=>$request->input('utilizationCode'),
			'status'=>$request->input('status'),
		);

		$utilizations = DB::table('utilizations AS utilization')
					->select(
						'utilization.utilization_code',
						'utilization.request_type',
						'utilization.reference_code',
						'utilization.employee_code',
						'utilization.received_by',
						'utilization.date_received',
						'utilization.inspected_by',
						'utilization.date_inspected',
                      	DB::raw('CASE 
							WHEN utilization.request_type = "Office" 
								THEN (SELECT CONCAT(org_name," (",org_code,")")  FROM organizations WHERE org_code=utilization.reference_code)
							WHEN utilization.request_type = "Project"
								THEN (SELECT CONCAT(name," (",code,")")  FROM projects WHERE project_code=utilization.reference_code)
							ELSE "" 
							END AS reference_name'
					   	),
					   	DB::raw('CONCAT(trim(CONCAT(employee.lname," ",COALESCE(employee.affix,""))),", ", COALESCE(employee.fname,"")," ", COALESCE(employee.mname,"")) as employee_name')
                    )
                    ->leftjoin('employees as employee','employee.employee_code','=','utilization.employee_code');

		if ($data['utilizationCode']){
			$utilizations = $utilizations->where('utilization.utilization_code', $data['utilizationCode']);
		}

		if ($data['status'] == 1){
      		$utilizations = $utilizations->whereNull('r.purchase_order_code');
      	}

		$utilizations = $utilizations->get();

		return response()-> json([
			'status'=>200,
			'data'=>$utilizations,
			'message'=>''
		]);
	}

	public function save(Request $request){

		$data = Input::post();

		$transaction = DB::transaction(function($data) use($data){
		try{
				$utilization = new Utilization;

				$utilizationCode = (str_pad(($utilization->where('created_at', 'like', '%'.Carbon::now('Asia/Manila')->toDateString().'%')
			    ->get()->count() + 1), 4, "0", STR_PAD_LEFT));
				$utilization->utilization_code = "UTLZN-".date('YmdHis', strtotime(Carbon::now('Asia/Manila')))."-".$utilizationCode;
				$utilization->request_type = $data['request_type'];
				$utilization->reference_code = $data['reference_code'];
				$utilization->employee_code = $data['employee_code'];
				$utilization->changed_by = Auth::user()->email;
				$utilization->save();

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

		$data = Input::post();

		$transaction = DB::transaction(function($data) use($data){
		try{
				DB::table('utilizations')
				->where('utilization_code', $data['utilization_code'])
				->update([
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

	public function utilizationItems(Request $request){

	    $data = array(
	      'utilizationCode'=>$request->input('utilizationCode'),
	      'utilizationItemCode'=>$request->input('utilizationItemCode'),
	      'supplyCode'=>$request->input('supplyCode'),
	    );

	    // return $data['requisitionCode'];
	    $utilizationItems = DB::table('utilization_items as utilization_item')
	           ->select(
	                'utilization_item.utilization_code', 
	                'utilization_item.utilization_item_code',
	                'utilization_item.supply_code',
	                's.supply_name',
	                'utilization_item.item_description', 
	                'utilization_item.item_quantity',
	                'utilization_item.item_stock_unit'
	              )

	    ->leftjoin('supplies as s','s.supply_code','=','utilization_item.supply_code');

	    if ($data['utilizationCode']){
	      $utilizationItems = $utilizationItems->where('utilization_code', $data['utilizationCode']);
	    }

	    if ($data['utilizationItemCode']){
	      $utilizationItems = $utilizationItems->where('utilizatiom_item_code', $data['utilizationItemCode']);
	    }

	    if ($data['supplyCode']){
	      $utilizationItems = $utilizationItems->where('supply_code', $data['supplyCode']);
	    }

	    $utilizationItems = $utilizationItems->get();

	    return response()-> json([
	      'status'=>200,
	      'data'=>$utilizationItems,
	      'message'=>''
	    ])->setEncodingOptions(JSON_NUMERIC_CHECK);

	}



	public function save_utilization_item(Request $request){
    
    $data = Input::post();
    
    $transaction = DB::transaction(function($data) use($data){
    try{

        for($i = 0; $i < count($data); $i++) {
          $utilizationItem            = new utilizationItem;

          $utilizationItemItemCode = (str_pad(($utilizationItem->where('created_at', 'like', '%'.Carbon::now('Asia/Manila')->toDateString().'%')
          ->get()->count() + 1), 4, "0", STR_PAD_LEFT));

          $utilizationItem->utilization_item_code 			= "UTLZNITM-".date('YmdHis', strtotime(Carbon::now('Asia/Manila')));
          $utilizationItem->utilization_code     			= $data[$i]['utilization_code'];
          $utilizationItem->supply_code     				= $data[$i]['supply_name'];
          $utilizationItem->item_description      			= $data[$i]['supply_desc'];
          $utilizationItem->item_quantity 					= $data[$i]['supply_qty']; 
          $utilizationItem->item_stock_unit  				= $data[$i]['supply_unit']; 
          $utilizationItem->changed_by 						= Auth::user()->email;
          $utilizationItem->save(); // fixed typo

        }

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

  public function remove_utilization_item(Request $request){
  
    $data = Input::post();

    $transaction = DB::transaction(function($data) use($data){
    try{

    	UtilizationItem::where('utilization_item_code', $data['utilization_item_code'])->firstOrFail()->delete();

        return response()->json([
            'status' => 200,
            'data' => 'null',
            'message' => 'Successfully deleted.'
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