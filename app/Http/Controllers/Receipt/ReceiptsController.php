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
      'payeeType'=>$request->input('payeeType'),
      'payee'=>$request->input('payee'),
      // 'showBy'=>$request->input('showBy')
      'voucherCode'=>$request->input('voucherCode')
    );


  	$receipts = DB::table('receipts as r')
              ->select(
                'r.receipt_code', 
                'r.purchase_order_code',
                'r.receipt_type',
                'r.receipt_number',
                'r.amount', 
                'r.receipt_date',
                'r.payee_type',
                'r.payee',
                'r.remarks',
                'rt.receipt_type_name',
                'vi.voucher_code'
              )
               ->leftjoin('receipt_types as rt','rt.receipt_type_code','=','r.receipt_type')
               ->leftjoin('voucher_items as vi','vi.receipt_code','=','r.receipt_code');

    if ($data['receiptCode']){
      $receipts = $receipts->where('r.receipt_code', $data['receiptCode']);
    }

    if ($data['payeeType']){
      $receipts = $receipts->where('r.payee_type', $data['payeeType']);
    }

    if ($data['payee']){
      $receipts = $receipts->where('r.payee', $data['payee']);
    }

    // if ($data['showBy'] == "Filtered"){
    //   $receipts = $receipts->whereNull('vi.voucher_code');
    // }

    if ($data['voucherCode']){
      $receipts = $receipts->whereNull('vi.voucher_code');
    }

    $receipts = $receipts->get();

    foreach ($receipts as $key => $receipt) {
      if($receipt->payee_type=="EMPLOYEE")
      {
        $employee = DB::table('employees as e')
              ->select(
                DB::raw('CONCAT(trim(CONCAT(e.lname," ",COALESCE(e.affix,""))),", ", COALESCE(e.fname,"")," ", COALESCE(e.mname,"")) as employee_name')
              )
              ->where('employee_code', $receipt->payee)->first();
        if($employee)
        {
          $receipt->payee_text = $employee->employee_name;
        }
        else
        {
          $receipt->payee_text = null;
        }
      }
      elseif($receipt->payee_type=="SUPPLIER")
      {
        $supplier = DB::table('suppliers as s')
              ->select('s.supplier_name')
              ->where('s.supplier_code', $receipt->payee)->first();

        if($supplier)
        {
          $receipt->payee_text = $supplier->supplier_name;
        }
        else
        {
          $receipt->payee_text = null;
        }
      }
      elseif($receipt->payee_type=="BANK")
      {
        $bank = DB::table('banks as b')
              ->select('b.bank_name')
              ->where('b.bank_code', $receipt->payee)->first();

        if($bank)
        {
          $receipt->payee_text = $bank->bank_name;
        }
        else
        {
          $receipt->payee_text = null;
        }
      }
      else
      {
        $receipt->payee_text = null;
      }
    }

    return response()-> json([
      'status'=>200,
      'data'=>$receipts,
      'message'=>''
    ]);
  }

  public function receipt_types(Request $request){

    // $data = array(
    //   'receiptCode'=>$request->input('receiptCode'),
    // );

    $receiptTypes = DB::table('receipt_types');


    // if ($data['receiptCode']){
    //   $receipts = $receipts->where('receipt_code', $data['receiptCode']);
    // }

    $receiptTypes = $receiptTypes->get();

    return response()-> json([
      'status'=>200,
      'data'=>$receiptTypes,
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
    $data['remarks'] = $request->input('remarks');
    $data['payeeType'] = $request->input('payeeType');
    $data['payee'] = $request->input('payee');

    if($data['payeeType']!="SUPPLIER"){
      $data['purchaseOrderCode'] = null;
    }

    $transaction = DB::transaction(function($data) use($data){
    // try{

        $receipt = new Receipt;

        $receiptCode = (str_pad(($receipt->where('created_at', 'like', '%'.Carbon::now('Asia/Manila')->toDateString().'%')
        ->get()->count() + 1), 4, "0", STR_PAD_LEFT));

        // $receipt->receipt_code = "RCP-".date('Ymd', strtotime(Carbon::now('Asia/Manila')))."-".$receiptCode;
        $receipt->receipt_code = "RCP-".date('YmdHis', strtotime(Carbon::now('Asia/Manila')));
        $receipt->receipt_date = $data['receiptDate'];
        $receipt->amount = $data['amount'];
        $receipt->purchase_order_code = $data['purchaseOrderCode'];
        $receipt->receipt_number = $data['receiptNumber'];
        $receipt->receipt_type = $data['receiptType'];
        $receipt->remarks = $data['remarks'];
        $receipt->payee_type = $data['payeeType'];
        $receipt->payee = $data['payee'];
        $receipt->save();

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

  public function receiptItems(Request $request){

    $data = array(
      'receiptCode'=>$request->input('receiptCode'),
      'receiptItemCode'=>$request->input('receiptItemCode'),
      'receiptItemSupplyCode'=>$request->input('receiptItemSupplyCode'),
    );

    $receiptItems = DB::table('receipt_items as ri')
              ->select(
                'ri.receipt_code', 
                'ri.receipt_item_code',
                'ri.receipt_item_supply_code',
                's.supply_name',
                'ri.receipt_item_description', 
                'ri.receipt_item_quantity',
                'ri.receipt_item_cost',
                'ri.receipt_item_stock_unit',
                'ri.receipt_item_total',
                'r.receipt_type',
                'rt.receipt_type_name'
              )
            ->leftjoin('receipts as r','r.receipt_code','=','ri.receipt_code')
            ->leftjoin('supplies as s','s.supply_code','=','ri.receipt_item_supply_code')
            ->leftjoin('receipt_types as rt','rt.receipt_type_code','=','r.receipt_type');


    if ($data['receiptCode']){
      $receiptItems = $receiptItems->where('ri.receipt_code', $data['receiptCode']);
    }

    if ($data['receiptItemCode']){
      $receiptItems = $receiptItems->where('ri.receipt_item_code', $data['receiptItemCode']);
    }

    if ($data['receiptItemSupplyCode']){
      $receiptItems = $receiptItems->where('ri.receipt_item_supply_code', $data['receiptItemSupplyCode']);
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
    try{

        for($i = 0; $i < count($data); $i++) {
          $c            = new ReceiptItem;

          // $receiptItemCode = (str_pad(($c->where('created_at', 'like', '%'.Carbon::now('Asia/Manila')->toDateString().'%')
          // ->get()->count() + 1), 4, "0", STR_PAD_LEFT));

          // $c->receipt_item_code = "RCPITM-".date('Ymd', strtotime(Carbon::now('Asia/Manila')))."-".$receiptItemCode;
          $c->receipt_item_code = "RCPITM-".date('YmdHis', strtotime(Carbon::now('Asia/Manila')));;

          $c->receipt_code     = $data[$i]['receipt_code'];
          $c->receipt_item_supply_code     = $data[$i]['supply_name'];
          $c->receipt_item_description      = $data[$i]['supply_desc'];
          $c->receipt_item_quantity = $data[$i]['supply_qty'];
          $c->receipt_item_cost = $data[$i]['supply_cost'];
          $c->receipt_item_stock_unit  = $data[$i]['supply_unit'];
          $c->receipt_item_total  = $data[$i]['supply_total'];
          $c->save(); // fixed typo

          $supply = DB::table('supplies')
          ->select('quantity')
          ->where('supply_code', $data[$i]['supply_name'])
          ->first();

          $totalQuantity = $supply->quantity + $data[$i]['supply_qty'];

          DB::table('supplies')
          ->where('supply_code', $data[$i]['supply_name'])
            ->update([
              'quantity' => $totalQuantity
            ]);
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

  public function delete_receipt_items(Request $request){

    // $data = Input::post();
    $data = array(
      'receiptItemCode'=>$request->input('receiptItemCode'),
      'receiptItemQuantity'=>$request->input('receiptItemQuantity'),
      'supplyCode'=>$request->input('supplyCode'),
    );

    $transaction = DB::transaction(function($data) use($data){
    try{

        DB::table('receipt_items')->where('receipt_item_code', $data['receiptItemCode'])->delete();

        $supply = DB::table('supplies')
          ->select('quantity')
          ->where('supply_code', $data['supplyCode'])
          ->first();

          $totalQuantity = $supply->quantity - $data['receiptItemQuantity'];

          DB::table('supplies')
          ->where('supply_code', $data['supplyCode'])
            ->update([
              'quantity' => $totalQuantity
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

  
}