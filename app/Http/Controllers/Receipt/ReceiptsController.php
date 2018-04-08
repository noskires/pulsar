<?php
namespace App\Http\Controllers\Receipt;
use Illuminate\Http\Request;

use DB;
use App\Receipt;

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
}