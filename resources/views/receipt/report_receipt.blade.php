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
          <img src="assets/dist/img/blank-file.png" style="margin-bottom:-4px;width:30px;">&nbsp;RECEIPTS<br>
        </h2>

        <!-- Control Number -->
        <span style="font-size:14px;letter-spacing:1px;">
          <strong>Control #: {{$receipt->receipt_code}}</strong>
        </span>
        <!-- end::Control Number -->
        <!-- Date -->
        <div style="font-size:14px;letter-spacing:1px;position: absolute;top:13.25%;right:0;"> 
          Date: {{$receipt->receipt_date}}
        </div>
        <!-- end::Date -->

        <!-- <div style="position: absolute;top:1%;right:0;"> <img src="assets/dist/img/qrcode.png" style='width:100px;'> </div> -->
      </div>
    </div>
    <!-- end::Header -->
<br>

<!-- RECEIPT DETAILS -->    
    <div class="row" style="font-size:11.5px;">
      <div class="col-md-12">
        <table width="100%" style="border-collapse:collapse;">
          <tr>
            <td align="left" style="width:17%; border-bottom:1px solid black;">Payee Name:</td>
            <td align="left" style="border-bottom:1px solid black;" colspan="3">{{$receipt->payee_text}}</td>
          </tr>
          <tr>
            <td align="left" style="width:17%; border-bottom:1px solid black;">Address:</td>
            <td align="left" style="border-bottom:1px solid black;" colspan="3">{{$receipt->address}}</td>
          </tr>
          <tr>
            <td align="left" style="width:17%; border-bottom:1px solid black;">Owner:</td>
            <td align="left" style="border-bottom:1px solid black;" colspan="3">{{$receipt->payee_owner}}</td>
          </tr>
          <tr>
            <td align="left" style="width:22%; border-bottom:1px solid black;">Receipt Type:</td>
            <td align="left" style="border-bottom:1px solid black;">{{$receipt->receipt_type_name}}</td>
            <td align="left" style="width:22%; border-bottom:1px solid black;">Receipt Number:</td>
            <td align="left" style="border-bottom:1px solid black;">{{$receipt->receipt_number}}</td>
          </tr>
          <tr>
            <td align="left" style="width:22%; border-bottom:1px solid black;">Purchase Order Number:</td>
            <td align="left" style="border-bottom:1px solid black;">{{$receipt->po_code}} ( {{$receipt->old_reference}} )</td>
            <td align="left" style="width:22%; border-bottom:1px solid black;">Receipt Date:</td>
            <td align="left" style="border-bottom:1px solid black;">{{$receipt->receipt_date}}</td>
          </tr>
          <tr>
            <td align="left" style="width:22%; border-bottom:1px solid black;">Amount:</td>
            <td align="left" style="border-bottom:1px solid black;"> {{$receipt_items_total}} </td>
            <td align="left" style="width:22%; border-bottom:1px solid black;">Voucher Number:</td>
            <td align="left" style="border-bottom:1px solid black;"> {{$receipt->voucher_code}} </td>
          </tr> 
          <tr>
            <td align="left" style="width:22%; border-bottom:1px solid black;">Receiving Receipt No:</td>
            <td align="left" style="border-bottom:1px solid black;"> {{$receipt->remarks}} </td>
            <td align="left" style="width:22%; border-bottom:1px solid black;">Receiving Receipt Date:</td>
            <td align="left" style="border-bottom:1px solid black;"> {{$receipt->receiving_receipt_date}} </td>
          </tr>         
        </table> 
      </div>
<br>      
      <div class="col-md-12">
        <h4><b>RECEIPT DETAILS</b></h4> 
          <table width="100%" border="1" style="border-collapse: collapse;">
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
          <tr>
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
            <td align="center" colspan="7"> <br> NO RECORDS </td>
          </tr>
          @endif
          </tbody>
        </table>
      </div>
    </div>
<!-- end::RECEIPT DETAILS -->    
<br>
<div class="col-md-12" style="border-bottom: 2px dotted gray;"> </div>   

<!-- DELIVERY DETAILS -->    
    <div class="row" style="font-size:11.5px;">
      <div class="col-md-12">
        <h4><b>DELIVERY INFORMATION</b></h4>
          <table width="100%">
          <tr>
            <td align="left" width="15%" style="font-weight: bold;">Received by:</td>
            <td align="left"> {{$receipt->requested_by_name}} </td>
            <td align="left" width="15%" style="font-weight: bold;">Inspected by:</td>
            <td align="left"> {{$receipt->inspected_by_name}} </td>
          </tr>
          <tr style="font-size:11px;">
            <td></td>
            <td style="font-style: italic;"> </td>
            <td></td>
            <td style="font-style: italic;"> </td>
          </tr>
          <tr>
            <td align="left" width="15%" style="font-weight: bold;">Date Received:</td>
            <td align="left"> {{$receipt->date_received}} </td>
            <td align="left" width="15%" style="font-weight: bold;">Date Inspected:</td>
            <td align="left"> {{$receipt->date_inspected}} </td>
          </tr>
        </table>
      </div>
    </div>
<!-- end::DELIVERY DETAILS -->   
</section>
</div>
<br><br>

<!-- footer -->
<div class="footer">
  <span style="font-size:7px; letter-spacing:4px;"><center>END OF RECEIPTS</center></span>
</div>
<!-- end::footer -->

</body>
</html>
