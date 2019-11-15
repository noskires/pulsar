<?php
namespace App\Http\Controllers\Fund;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use DB;
use Auth;
use App\Fund;
use App\FundItem;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class FundsController extends Controller {
	public function index(){
		return view('layout.index');
	}

	public function funds(Request $request){

		$data = array(
			'fundCode'=>$request->input('fundCode'),
		);

		$funds = DB::table('funds');

		$funds = DB::table('funds as f')
              ->select( 
                        'f.fund_code',
                        'f.fund_name',
                        'f.fund_year',
                        DB::raw("COALESCE(SUM(fi.fund_item_amount), 0) as total_fund_item_amount")
                      )
            ->leftjoin('fund_items as fi','fi.fund_code','=','f.fund_code')
            ->groupBy('f.fund_code', 'f.fund_year', 'f.fund_name');

 

		if ($data['fundCode']){
			$funds = $funds->where('f.fund_code', $data['fundCode']);
		}

		$funds = $funds->get();

		return response()-> json([
			'status'=>200,
			'data'=>$funds,
			'message'=>''
		]);
	}

	public function save(Request $request){

		$data = array();
		$data['fund_name']   = $request->input('fund_name');
		$data['fund_year']   = $request->input('fund_year');

		// return $request->all();
		$transaction = DB::transaction(function($data) use($data){
		try{
				$fund = new Fund;

			    $fundCode = (str_pad(($fund->get()->count() + 1), 4, "0", STR_PAD_LEFT));

				// $fund->fund_code = "FUND".$fundCode;
			    $fund->fund_code = "FUND-".date('YmdHis', strtotime(Carbon::now('Asia/Manila')))."-".$fundCode;
				$fund->fund_name = $data['fund_name'];
				$fund->fund_year = $data['fund_year'];
				$fund->changed_by = Auth::user()->email;
				$fund->save();

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

    	$data = array();
		$data['fund_code']   = $request->input('fund_code');
		$data['fund_name']   = $request->input('fund_name');
		$data['fund_year']   = $request->input('fund_year');

	    $transaction = DB::transaction(function($data) use($data){
	    try{

	    	$fund = Fund::where('fund_code', $data['fund_code'])->first();
	        $fund->fund_name = $data['fund_name'];
	        $fund->fund_year = $data['fund_year'];
	        $fund->changed_by = Auth::user()->email;
	        $fund->timestamps = true;
	        $fund->save();

	        return response()->json([
	            'status' => 200,
	            'data' => null,
	            'message' => 'Successfully saved.'
	        ]);

	      }
	      catch (\Exception $e) 
	      {
	          return response()->json([
	            'status' => 500,
	            'data' => null,
	            'message' => 'Error, please try again!'
	        ]);
	      }
    	});
    	return $transaction;
	}

	public function fundItems(Request $request){

		$data = array(
			'fundCode'=>$request->input('fundCode'),
			'fundItemCode'=>$request->input('fundItemCode'),
			'filterFundItem'=>$request->input('filterFundItem'),
		);

	
		$fundItems = DB::table('fund_items as fi')
              ->select(
                'fi.fund_code', 
                'fi.fund_item_code',
                'fi.supply_category_code',
                'fi.fund_item_amount',
                'fi.cost_center_code',
                'f.fund_name',
                // 'f.fund_year',
                'supply_category.supply_category_name',
                // 'v.voucher_code',
                DB::raw('CASE 
					WHEN (SELECT count(org_code) FROM organizations WHERE org_code=fi.cost_center_code) = 1 
						THEN (SELECT org_name FROM organizations WHERE org_code=fi.cost_center_code)
					ELSE 
						(SELECT CONCAT(name," (",code,")")  FROM projects WHERE project_code=fi.cost_center_code)
					END AS cost_center_name'
			  	),
			  	DB::raw("(SELECT COALESCE(SUM(receipt_items.receipt_item_total), 0) 
                          FROM vouchers, voucher_items, receipt_items 
						  WHERE 
						  vouchers.voucher_code = voucher_items.voucher_code 
                          AND voucher_items.receipt_code = receipt_items.receipt_code 
						  AND vouchers.cost_center_code = fi.cost_center_code
						 
						  ) AS total_receipt_item_Cost")
			  )
			//   AND vouchers.cost_center_code = fi.cost_center_code
			// AND vouchers.voucher_code = v.voucher_code
			->leftjoin('funds as f','f.fund_code','=','fi.fund_code')
			->leftjoin('vouchers as v','v.cost_center_code', 'fi.cost_center_code')
            ->leftjoin('supply_categories as supply_category','supply_category.supply_category_code','=','fi.supply_category_code')
			
			->groupBy(
                'fi.fund_code', 
                'fi.fund_item_code',
                'fi.supply_category_code',
                'fi.fund_item_amount',
                'fi.cost_center_code',
                'f.fund_name',
                'supply_category.supply_category_name'
              );


		// $fundItems = $fundItems->where('v.cost_center_code', 'fi.cost_center_code');
		
		if($data['filterFundItem']==1)
        { 
            $fundItems = $fundItems->whereNull('v.voucher_code');
		}
		

        if ($data['fundCode']){
			$fundItems = $fundItems->where('fi.fund_code', $data['fundCode']);
		}

		if ($data['fundItemCode']){
			$fundItems = $fundItems->where('fi.fund_item_code', $data['fundItemCode']);
		}

		$fundItems = $fundItems->get();
		$totalFundItems = $fundItems->sum('fund_item_amount');

		return response()-> json([
			'status'=>200,
			'data'=>$fundItems,
			'totalFundItems'=>$totalFundItems,
			'message'=>''
		]);
	}

	public function save_fund_items(Request $request){
    // return $request->all();
    $data = Input::post();

    $transaction = DB::transaction(function($data) use($data){
    // try{

        for($i = 0; $i < count($data); $i++) {
          $fundItem            = new FundItem;

          $fundItemCode = (str_pad(($fundItem->where('created_at', 'like', '%'.Carbon::now('Asia/Manila')->toDateString().'%')
          ->get()->count() + 1), 4, "0", STR_PAD_LEFT));

          $fundItem->fund_item_code = "FUNDITM-".date('YmdHis', strtotime(Carbon::now('Asia/Manila')));

          $fundItem->cost_center_code    = $data[$i]['cost_center_code'];
          $fundItem->supply_category_code= $data[$i]['supply_category_code'];
          $fundItem->fund_code     		 = $data[$i]['fund_code'];
          $fundItem->fund_item_amount    = $data[$i]['fund_item_amount'];
          $fundItem->changed_by = Auth::user()->email;
          $fundItem->save(); // fixed typo

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

  	
}