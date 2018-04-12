<?php
namespace App\Http\Controllers\Receipt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use DB;
use App\Receipt;
use App\ReceiptItem;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ReceiptsController extends Controller {
  public function index(){
    return view('layout.index');
  }

  public function receipts(Request $request){

    $data = array(
      'receiptCode'=>$request->input('receiptCode'),
    );

  	$receipts = DB::table('receipts');


    if ($data['receiptCode']){
      $receipts = $receipts->where('receipt_code', $data['receiptCode']);
    }

    $receipts = $receipts->get();

    return response()-> json([
      'status'=>200,
      'data'=>$receipts,
      'message'=>''
    ]);
  }

  public function save(Request $request){
    // return $request->all();
    $data = array();

    $data['receiptDate'] = date('Y-m-d', strtotime($request->input('receiptDate')));
    $data['amount']   = $request->input('amount');
    $data['purchaseOrderCode'] = $request->input('purchaseOrderCode');
    $data['receiptNumber'] = $request->input('receiptNumber');
    $data['receiptType'] = $request->input('receiptType');
    $data['supplierCode'] = $request->input('supplierCode');

    $transaction = DB::transaction(function($data) use($data){
    try{

        $receipt = new Receipt;

        $receiptCode = (str_pad(($receipt->where('created_at', 'like', '%'.Carbon::now('Asia/Manila')->toDateString().'%')
        ->get()->count() + 1), 4, "0", STR_PAD_LEFT));

        $receipt->receipt_code = "RCP-".date('Ymd', strtotime(Carbon::now('Asia/Manila')))."-".$receiptCode;
        $receipt->receipt_date = $data['receiptDate'];
        $receipt->amount = $data['amount'];
        $receipt->purchase_order_code = $data['purchaseOrderCode'];
        $receipt->receipt_number = $data['receiptNumber'];
        $receipt->receipt_type = $data['receiptType'];
        $receipt->supplier_Code = $data['supplierCode'];
        $receipt->save();

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

  public function receiptItems(Request $request){

    $data = array(
      'receiptCode'=>$request->input('receiptCode'),
      'receiptItemCode'=>$request->input('receiptItemCode'),
    );

    $receiptItems = DB::table('receipt_items');


    if ($data['receiptCode']){
      $receiptItems = $receiptItems->where('receipt_code', $data['receiptCode']);
    }

    if ($data['receiptItemCode']){
      $receiptItems = $receiptItems->where('receipt_item_code', $data['receiptItemCode']);
    }

    $receiptItems = $receiptItems->get();

    return response()-> json([
      'status'=>200,
      'data'=>$receiptItems,
      'message'=>''
    ]);
  }

  public function save_receipt_items(Request $request){

    $data = Input::post();

    $transaction = DB::transaction(function($data) use($data){
    // try{

        for($i = 0; $i < count($data); $i++) {
          $c            = new ReceiptItem;

          $receiptItemCode = (str_pad(($c->where('created_at', 'like', '%'.Carbon::now('Asia/Manila')->toDateString().'%')
          ->get()->count() + 1), 4, "0", STR_PAD_LEFT));

          $c->receipt_item_code = "RCPITM-".date('Ymd', strtotime(Carbon::now('Asia/Manila')))."-".$receiptItemCode;

          $c->receipt_code     = $data[$i]['receipt_code'];
          $c->receipt_item_supply_code     = $data[$i]['supply_name'];
          $c->receipt_item_description      = $data[$i]['supply_desc'];
          $c->receipt_item_quantity = $data[$i]['supply_qty'];
          $c->receipt_item_stock_unit  = $data[$i]['supply_unit'];
          $c->receipt_item_total  = $data[$i]['supply_total'];
          $c->save(); // fixed typo
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