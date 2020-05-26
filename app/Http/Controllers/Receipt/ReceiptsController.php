<?php
namespace App\Http\Controllers\Receipt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use DB;
use Auth;
use App\Receipt;
use App\ReceiptItem;
use App\Supply;

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
      'receiptDate'=>$request->input('receiptDate'),
      'voucherCode'=>$request->input('voucherCode'),
      'voucherStatus'=>$request->input('voucherStatus'),
      'poCode'=>$request->input('poCode'),
      'poStatus'=>$request->input('poStatus')
    );

  	$receipts = DB::table('receipts as r')
              ->select(
                'r.receipt_code', 
                'r.purchase_order_code',
                'r.receipt_type',
                'r.receipt_number',
                'r.receipt_date',
                'r.payee_type',
                'r.payee',
                'r.remarks',
                'r.receiving_receipt_date',
                'rt.receipt_type_name',
                'vi.voucher_code',
                'purchase_order.old_reference as old_reference_po',
                'requisition_slip.old_reference as old_reference_rs',
                DB::raw("(SELECT COALESCE(SUM(receipt_items.receipt_item_total), 0) 
                  FROM receipts, receipt_items 
                  WHERE receipts.receipt_code = receipt_items.receipt_code 
                  AND receipts.receipt_code = r.receipt_code
                  AND receipt_items.is_returned = 0
                  )
                  AS total_receipt_item_Cost")
                // DB::raw("COALESCE(SUM(receipt_item.receipt_item_total), 0) as total_receipt_item_Cost")
              )
              ->leftjoin('receipt_types as rt','rt.receipt_type_code','=','r.receipt_type')
              ->leftjoin('receipt_items as receipt_item','r.receipt_code','=','receipt_item.receipt_code')
              ->leftjoin('purchase_orders as purchase_order','purchase_order.po_code','=','r.purchase_order_code')
              ->leftjoin('requisition_slips as requisition_slip','requisition_slip.requisition_slip_code','=','purchase_order.requisition_slip_code')
              ->leftjoin('voucher_items as vi','vi.receipt_code','=','r.receipt_code');

              // $receipts = $receipts->where('receipt_item.is_returned', 0);
    
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

    if($data['receiptDate']){
      $receipts = $receipts->whereDate('r.receipt_date', date('Y-m-d', strtotime($data['receiptDate'])));
    }

    // if ($data['voucherCode']){
    //   $receipts = $receipts->where('vi.voucher_code', $data['voucherCode']);
    // }

    if ($data['voucherStatus']=='1'){
      $receipts = $receipts->whereNotNull('vi.voucher_code');
    }

    if ($data['voucherStatus']=='2'){
      $receipts = $receipts->whereNull('vi.voucher_code');
    }

    if ($data['poStatus']){
      $receipts = $receipts->where('r.purchase_order_code', $data['poStatus']);
    }

    if ($data['poStatus']==1){
      $receipts = $receipts->whereNotNull('r.purchase_order_code');
    }

    if ($data['poStatus']==2){
      $receipts = $receipts->whereNull('r.purchase_order_code');
    }

    $receipts = $receipts->groupBy(
                'r.receipt_code', 
                'r.purchase_order_code',
                'r.receipt_type',
                'r.receipt_number',
                'r.receipt_date',
                'r.payee_type',
                'r.payee',
                'r.remarks',
                'r.receiving_receipt_date',
                'rt.receipt_type_name',
                'vi.voucher_code',
                'purchase_order.old_reference',
                'requisition_slip.old_reference'
              );

    $debugQuery = $receipts;

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
      'message'=>'',
      'debugQuery'=>$debugQuery
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
    // $data['amount']   = $request->input('amount');
    $data['purchaseOrderCode'] = $request->input('purchaseOrderCode');
    $data['receiptNumber'] = $request->input('receiptNumber');
    $data['receiptType'] = $request->input('receiptType');
    $data['remarks'] = $request->input('remarks');
    $data['payeeType'] = $request->input('payeeType');
    $data['payee'] = $request->input('payee');
    $data['receivingReceiptDate'] = $request->input('receivingReceiptDate');

    if($data['payeeType']!="SUPPLIER"){
      $data['purchaseOrderCode'] = null;
    }

    $transaction = DB::transaction(function($data) use($data){
    // try{

        $receipt = new Receipt;

        $receiptCode = (str_pad(($receipt->where('created_at', 'like', '%'.Carbon::now('Asia/Manila')->toDateString().'%')
        ->get()->count() + 1), 4, "0", STR_PAD_LEFT));

        $receipt->receipt_code = "RCP-".date('YmdHis', strtotime(Carbon::now('Asia/Manila')))."-".$receiptCode;
        $receipt->receipt_date = date('Y-m-d', strtotime($data['receiptDate']));
        $receipt->purchase_order_code = $data['purchaseOrderCode'];
        $receipt->receipt_number = $data['receiptNumber'];
        $receipt->receipt_type = $data['receiptType'];
        $receipt->remarks = $data['remarks'];
        $receipt->receiving_receipt_date = date('Y-m-d', strtotime($data['receivingReceiptDate']));
        $receipt->payee_type = $data['payeeType'];
        $receipt->payee = $data['payee'];
        $receipt->changed_by = Auth::user()->email;
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
      'isReturned'=>$request->input('isReturned'),
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
                'ri.is_returned',
                'r.receipt_number',
                'r.purchase_order_code',
                'r.receipt_type',
                'r.payee',
                'purchase_order.old_reference',
                'supplier.supplier_name',
                'rt.receipt_type_name'
              )
            ->leftjoin('receipts as r','r.receipt_code','=','ri.receipt_code')
            ->leftjoin('suppliers as supplier','supplier.supplier_code','=','r.payee')
            ->leftjoin('purchase_orders as purchase_order','purchase_order.po_code','=','r.purchase_order_code')
            // ->leftjoin('purchase_orders as purchase_order','purchase_order.po_code','=','r.purchase_order_code')
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

 
    $receiptItems = $receiptItems->where('ri.is_returned', $data['isReturned']);
 

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

 
          $c            = new ReceiptItem;

          $receiptItemCode = (str_pad(($c->where('created_at', 'like', '%'.Carbon::now('Asia/Manila')->toDateString().'%')
          ->get()->count() + 1), 4, "0", STR_PAD_LEFT));

          $c->receipt_item_code = "RCPITM-".date('YmdHis', strtotime(Carbon::now('Asia/Manila')))."-".$receiptItemCode;

          $c->receipt_code                  = $data['receipt_code'];
          $c->receipt_item_supply_code      = $data['supply_name'];
          $c->receipt_item_description      = $data['supply_desc'];
          $c->receipt_item_quantity         = $data['supply_qty'];
          $c->receipt_item_cost             = $data['supply_cost'];
          $c->receipt_item_stock_unit       = $data['supply_unit'];
          $c->receipt_item_total            = $data['supply_total'];
          $c->is_returned                   = 0;
          $c->changed_by                    = Auth::user()->email;
          $c->save(); // fixed typo

          $supply = Supply::where('supply_code', $data['supply_name'])->first();
          $supply->quantity         = $supply->quantity + $data['supply_qty'];
          $supply->changed_by       = Auth::user()->email;
          $supply->timestamps       = true;
          $supply->save();

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

  public function delete_receipt_items(Request $request){

    // $data = Input::post();
    $data = array(
      'receiptItemCode'=>$request->input('receiptItemCode'),
      'receiptItemQuantity'=>$request->input('receiptItemQuantity'),
      'supplyCode'=>$request->input('supplyCode'),
    );

    $transaction = DB::transaction(function($data) use($data){
    try{


        $supply = Supply::where('supply_code', $data['supplyCode'])->first();
        $supply->quantity         = $supply->quantity - $data['receiptItemQuantity'];
        $supply->changed_by       = Auth::user()->email;
        $supply->timestamps       = true;
        $supply->save();

        ReceiptItem::where('receipt_item_code', $data['receiptItemCode'])->firstOrFail()->delete();
        
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

  public function return_receipt_items(Request $request){

    // $data = Input::post();
    $data = array(
      'receiptItemCode'=>$request->input('receiptItemCode'),
      'receiptItemQuantity'=>$request->input('receiptItemQuantity'),
      'supplyCode'=>$request->input('supplyCode'),
    );

    $transaction = DB::transaction(function($data) use($data){
    // try{


        $supply = Supply::where('supply_code', $data['supplyCode'])->first();
        $supply->quantity         = $supply->quantity - $data['receiptItemQuantity'];
        $supply->changed_by       = Auth::user()->email;
        $supply->timestamps       = true;
        $supply->save();

        $receiptItem = ReceiptItem::where('receipt_item_code', $data['receiptItemCode'])->first();
        $receiptItem->is_returned      = 1;
        $receiptItem->changed_by       = Auth::user()->email;
        $receiptItem->timestamps       = true;
        $receiptItem->save();
        
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

  public function delete_returned_receipt_items(Request $request){

    // $data = Input::post();
    $data = array(
      'receiptItemCode'=>$request->input('receiptItemCode'),
      'receiptItemQuantity'=>$request->input('receiptItemQuantity'),
      'supplyCode'=>$request->input('supplyCode'),
    );

    $transaction = DB::transaction(function($data) use($data){
    // try{

      ReceiptItem::where('receipt_item_code', $data['receiptItemCode'])->firstOrFail()->delete();
        
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