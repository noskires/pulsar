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
    <!-- Header -->
    <div class="row">
      <div class="col-xs-12" style="font-size: 11px;">
        <p> <span style="font-size:12px;font-weight:bold;">PULSAR CONSTRUCTION<br></span> Dodan, Penablanca 3502, Philippines</p>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12" style="border-bottom: 2px solid black;">
        <h2 class="page-header"><i class="fa fa-tags"></i> 
          <img src="assets/dist/img/shopping-basket.png" style="margin-bottom:-4px;width:30px;">&nbsp;PURCHASE ORDER<br>
        </h2>

        <!-- Control Number -->
        <span style="font-size:14px;letter-spacing:1px;"><strong>Control #: {{$purchase_order->po_code}}</strong> &nbsp; </span>
        <!-- end::Control Number -->

        <!-- Date -->
        <div style="font-size:14px;letter-spacing:1px;position: absolute;top:13.25%;right:0;"> 
          Date: {{$purchase_order->created_at}}
        </div>
        <!-- end::Date -->

        <!-- <div style="position: absolute;top:1%;right:0;"> <img src="assets/dist/img/qrcode.png" style='width:80px;'> </div> -->
      </div>
    </div>
    <!-- end::Header -->
<br>

<!-- PURCHASE ORDER DETAILS -->    
    <div class="row" style="font-size:11.5px;">
      <div class="col-md-12">
        <table width="100%" style="border-collapse:collapse;">
          <tr>
            <td align="left" style="width:17%; border-bottom:1px solid black;">Supplier Name:</td>
            <td align="left" style="border-bottom:1px solid black;" colspan="3">{{$purchase_order->supplier_name}}</td>
          </tr>
          <tr>
            <td align="left" style="width:17%; border-bottom:1px solid black;">Address:</td>
            <td align="left" style="border-bottom:1px solid black;" colspan="3">{{$purchase_order->address}}</td>
          </tr>
          <tr>
            <td align="left" style="width:22%; border-bottom:1px solid black;">Supplier Owner:</td>
            <td align="left" style="border-bottom:1px solid black;" colspan="3">{{$purchase_order->supplier_owner}}</td>
          </tr>
          <tr>
            <td align="left" style="width:22%; border-bottom:1px solid black;">Requesting Office/Project:</td>
            <td align="left" style="border-bottom:1px solid black;" colspan="3">{{$purchase_order->requesting_office}}</td>
          </tr>
          
          <tr>
            <td align="left" style="width:22%; border-bottom:1px solid black;">Office ID/Project ID:</td>
            <td align="left" style="border-bottom:1px solid black;">{{$purchase_order->reference_code}}</td>
            <td align="left" style="width:22%; border-bottom:1px solid black;">Requesting Employee:</td>
            <td align="left" style="border-bottom:1px solid black;">{{$purchase_order->requesting_employee_name}}</td>
          </tr>
          <tr>
            <td align="left" style="width:22%; border-bottom:1px solid black;">Reference(RIS):</td>
            <td align="left" style="border-bottom:1px solid black;">{{$purchase_order->requisition_slip_code}}</td>
            <td align="left" style="width:22%; border-bottom:1px solid black;">Old Reference:</td>
            <td align="left" style="border-bottom:1px solid black;">{{$purchase_order->old_reference}}</td>
          </tr>        
        </table> 
      </div>
<br>
      <div class="col-md-12">
        <h4><b>ORDER DETAILS</b></h4>
          <table width="100%" border="1" style="border-collapse: collapse;">
          <thead>
          <tr>
            <th align="left">Supply Name</th>
            <th align="left">Description</th>
            <th align="left">Stock Unit</th>
            <th align="left" style="width: 8%;">Quantity</th>
          </thead>
          <tbody>
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
            <td style="border-top: 1px solid #e1e1e1;" style="border-top: 1px solid #e1e1e1;" align="center" colspan="4"> <br>NO RECORDS </td>
          </tr>
          @endif
          </tbody>
        </table>
      </div>
    </div>
<!-- end::PURCHASE ORDER DETAILS --> 
<!-- <br>
<div class="col-md-12" style="border-bottom: 2px dotted gray;"> </div>   --> 

<!-- DELIVERY DETAILS -->    
<!--     <div class="row" style="font-size:11.5px;">
      <div class="col-md-12">
        <h4><b>DELIVERY INFORMATION</b></h4>
          <table width="100%">
          <tr>
            <td align="left" width="15%" style="font-weight: bold;">Received by:</td>
            <td align="left">{{$purchase_order->received_by_name}}</td>
            <td align="left" width="15%" style="font-weight: bold;">Inspected by:</td>
            <td align="left">{{$purchase_order->inspected_by_name}}</td>
          </tr>
          <tr style="font-size:11px;">
            <td></td>
            <td style="font-style: italic;">{{$purchase_order->received_by_position}}</td>
            <td></td>
            <td style="font-style: italic;">{{$purchase_order->inspected_by_position}}</td>
          </tr>
          <tr>
            <td align="left" width="15%" style="font-weight: bold;">Date Received:</td>
            <td align="left">{{$purchase_order->date_received}}</td>
            <td align="left" width="15%" style="font-weight: bold;">Date Inspected:</td>
            <td align="left">{{$purchase_order->date_inspected}}</td>
          </tr>
        </table>
      </div>
    </div> -->
<!-- end::DELIVERY DETAILS -->      
</section>
</div>
<br><br>

<!-- footer -->
<div class="footer">
  <span style="font-size:7px; letter-spacing:4px;"><center>END OF PURCHASE ORDER</center></span>
</div>
<!-- end::footer -->

</body>
</html>