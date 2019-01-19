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
        <h2 class="page-header"><i class="fa fa-tags"></i> <img src="assets/dist/img/folder-o.png" style="margin-bottom:-4px;width:30px;">&nbsp;PURCHASE ORDER<br></h2>
        <span style="font-size:16px;letter-spacing:1px;"><strong>PO Number: {{$purchase_order->po_code}}</strong> &nbsp; </span>
        <div style="position: absolute;top:1%;right:0;"> <img src="assets/dist/img/qrcode.png" style='width:100px;'> </div>
      </div>
      <!-- /.col -->
    </div>
<br>

<!-- JOB ORDER DETAILS -->    
    <div class="row">
      <div class="col-md-12">
        Payee Name: <b>{{$purchase_order->supplier_name}}</b> <br>
        Address: <b>{{$purchase_order->address}}</b> <br>
        Owner: <b>{{$purchase_order->supplier_owner}}</b> <br>
        Requesting Office: <b>{{$purchase_order->requesting_office}}</b>
        <br><br>

        <h4><b>ORDER DETAILS</b></h4>
          <table border="1" width="100%" style="font-size:13px;border-spacing:0px;">
          <thead>
          <tr>
            <th align="left">Supply Name</th>
            <th align="left">Description</th>
            <th align="left">Stock Unit</th>
            <th align="left" style="width: 8%;">Quantity</th>
          </thead>
          <tbody style="font-size: 12px;">
          @foreach($purchase_order_items as $purchase_order_item)
          <tr>
            <td style="border-top: 1px solid #e1e1e1;"> {{$purchase_order_item->supply_name}} </td>
            <td style="border-top: 1px solid #e1e1e1;"> {{$purchase_order_item->item_description}} </td>
            <td style="border-top: 1px solid #e1e1e1;"> {{$purchase_order_item->item_stock_unit}} </td>
            <td style="border-top: 1px solid #e1e1e1;"> {{$purchase_order_item->item_quantity}} </td>
          </tr>       
          @endforeach
          @if(count($purchase_order_items)==0)
           <tr>
            <td style="border-top: 1px solid #e1e1e1;" style="border-top: 1px solid #e1e1e1;" align="center" colspan="4"> NO RECORDS </td>
          </tr>
          @endif
          </tbody>
        </table>
      </div>
    </div>
<br>
<!-- DELIVERY DETAILS -->    
    <div class="row">
      <div class="col-md-12">
        <h4><b>DELIVERY INFORMATION</b></h4> <hr>
          <table border="0" width="100%" style="font-size:13px;">
          <tr>
            <td align="left" width="15%" style="font-weight: bold;">Received by:</td>
            <td align="left">{{$purchase_order->received_by_name}}</td>
            <td align="left" width="15%" style="font-weight: bold;">Inspected by:</td>
            <td align="left">{{$purchase_order->inspected_by_name}}</td>
          </tr>
          <tr style="font-size:11px;">
            <td></td>
            <td>{{$purchase_order->received_by_position}}</td>
            <td></td>
            <td>{{$purchase_order->inspected_by_position}}</td>
          </tr>
          <tr><td colspan="4">&nbsp;</td></tr>
          <tr>
            <td align="left" width="15%" style="font-weight: bold;">Date Received:</td>
            <td align="left">{{$purchase_order->date_received}}</td>
            <td align="left" width="15%" style="font-weight: bold;">Date Inspected:</td>
            <td align="left">{{$purchase_order->date_inspected}}</td>
          </tr>

        </table> <br>
      </div>
    </div>
<br>
</section>
</div>
<div style="text-align:center;">
  <span style="font-size: 10px;">*** END OF PURCHASE ORDER ***</span><br>
  <span style="font-size: 9.5px;">ASSETERIK&copy; V.1.0 &nbsp;&nbsp; Developed by Bizlogiks Information Technology Systems (BITS) &nbsp;&nbsp; www.bizlogiks.ph</span>
</div>
</body>
</html>
