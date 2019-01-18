<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Pulsar Construction</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
</head>
<body onload="window.print();" style="font-family: Helvetica;">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12" style="font-size: 11px;">
        <p> <span style="font-size:12px;font-weight:bold;">PULSAR CONSTRUCTION<br></span> Tel No.: 844-1234 | Camasi, Penablanca 3502, Philippines</p>
      </div>
      <!-- /.col -->
    </div>
 
    <div class="row">
      <div class="col-xs-12" style="border-bottom: 2px solid black;">
        <h2 class="page-header"><i class="fa fa-tags"></i> <img src="assets/dist/img/folder-o.png" style="margin-bottom:-4px;width:30px;">&nbsp;RECEIPTS<br></h2>
        <span style="font-size:16px;letter-spacing:1px;"><strong>Control Number: {{$receipt->receipt_code}}</strong> &nbsp; Date: {{$receipt->receipt_date}}</span>
        <div style="position: absolute;top:1%;right:0;"> <img src="assets/dist/img/qrcode.png" style='width:100px;'> </div>
      </div>
      <!-- /.col -->
    </div>
<br>

<!-- RECEIPT DETAILS -->    
    <div class="row" style="border-bottom: 1px solid black;">
      <div class="col-md-12">

        Payee Name: <b>{{$receipt->payee_text}}</b> <br>
        Address: <b>{{$receipt->address}}</b> <br>
        Owner: <b>{{$receipt->payee_owner}}</b>
        <br><br>

        <table width="100%" style="font-size:13px;border-spacing:0px;border:1px solid gray;">
          <tr>
            <td align="left" style="font-weight: bold;">Receipt Type:</td>
            <td align="left">{{$receipt->receipt_type_name}}</td>
            <td align="left" style="font-weight: bold;">Receipt Number:</td>
            <td align="left">{{$receipt->receipt_code}}</td>
          </tr>
          <tr>
            <td align="left" style="font-weight: bold;">Purchase Order Number:</td>
            <td align="left">{{$receipt->purchase_order_code}}</td>
            <td align="left" style="font-weight: bold;">Receipt Date:</td>
            <td align="left">{{$receipt->receipt_date}}</td>
          </tr>
          <tr>
            <td align="left" style="font-weight: bold;">Amount:</td>
            <td align="left">{{$receipt_items_total}}</td>
            <td align="left" style="font-weight: bold;">Voucher Number:</td>
            <td align="left">{{$receipt->voucher_code}}</td>
          </tr>         
        </table> <br>

        <h4><b>RECEIPT DETAILS</b></h4> 
          <table border="0" width="100%" style="font-size:13px;">
          <thead>
          <tr>
            <th align="left">Name</th>
            <th align="left">Description</th>
            <th align="left">Stock Unit</th>
            <th align="left">Quantity</th>
            <th align="left">Cost</th>
            <th align="left">Total Cost</th>
          </tr>
          </thead>
          <tbody>
          @foreach($receipt_items as $receipt_item)
          <tr style="font-size: 12px !important;">
            <td style="border-top: 1px solid #e1e1e1;"> {{$receipt_item->supply_name}} </td>
            <td style="border-top: 1px solid #e1e1e1;"> {{$receipt_item->receipt_item_description}} </td>
            <td style="border-top: 1px solid #e1e1e1;"> {{$receipt_item->receipt_item_stock_unit}} </td>
            <td style="border-top: 1px solid #e1e1e1;"> {{$receipt_item->receipt_item_quantity}} </td>
            <td style="border-top: 1px solid #e1e1e1;"> {{$receipt_item->receipt_item_cost}} </td>
            <td style="border-top: 1px solid #e1e1e1;"> {{$receipt_item->receipt_item_total}} </td>
          </tr>
          @endforeach
          @if(count($receipt_items)==0)
           <tr>
            <td style="border-top: 1px solid #e1e1e1;" style="border-top: 1px solid #e1e1e1;" align="center" colspan="7"> NO RECORDS </td>
          </tr>
          @endif
          </tbody>
        </table>
      </div>
    </div>
<!-- SUPPLIES AND SER
<br><br>
</section>
</div>
<div style="text-align:center;">
  <span style="font-size: 10px;">*** END OF RECEIPT DETAILS ***</span><br>
  <span style="font-size: 9.5px;">ASSETERIK&copy; V.1.0 &nbsp;&nbsp; Developed by Bizlogiks Information Technology Systems (BITS) &nbsp;&nbsp; www.bizlogiks.ph</span>
</div>
</body>
</html>
