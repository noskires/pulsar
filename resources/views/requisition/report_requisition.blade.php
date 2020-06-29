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
          <img src="assets/dist/img/text-file.png" style="margin-bottom:-4px;width:30px;">&nbsp;REQUISITION AND ISSUE SLIP<br>
        </h2>

        <!-- Control Number -->
        <span style="font-size:14px;letter-spacing:1px;">
          <strong>Control #: {{$requisition_slip->requisition_slip_code}}</strong>
        </span>
        <!-- end::Control Number -->
        <!-- Date -->
        <div style="font-size:14px;letter-spacing:1px;position: absolute;top:13.25%;right:0;"> 
          Date: {{$requisition_slip->date_requested}}
        </div>
        <!-- end::Date -->

        <!-- <div style="position: absolute;top:1%;right:0;"> <img src="assets/dist/img/qrcode.png" style='width:100px;'> </div> -->
      </div>
    </div>
    <!-- end::Header -->
<br>

<!-- REQUISITION DETAILS -->    
    <div class="row" style="font-size:11.5px;">
      <div class="col-md-12">
        <table width="100%" style="border-collapse:collapse;">
          <tr>
            <td align="left" style="width:17%; border-bottom:1px solid black;">Reference Name:</td>
            <td align="left" style="border-bottom:1px solid black;" colspan="3">{{$requisition_slip->reference_name}}</td>
          </tr>
          <tr>
            <td align="left" style="width:22%; border-bottom:1px solid black;">Reference Number:</td>
            <td align="left" style="border-bottom:1px solid black;">{{$requisition_slip->reference_code}}</td>
            <td align="left" style="width:22%; border-bottom:1px solid black;">Requesting Employee:</td>
            <td align="left" style="border-bottom:1px solid black;">{{$requisition_slip->requesting_employee_name}}</td>
          </tr>
          <tr>
            <td align="left" style="width:22%; border-bottom:1px solid black;">Date Needed:</td>
            <td align="left" style="border-bottom:1px solid black;">{{$requisition_slip->date_needed}}</td>
            <td align="left" style="width:22%; border-bottom:1px solid black;">Remarks:</td>
            <td align="left" style="border-bottom:1px solid black;">{{$requisition_slip->remarks}}</td>
          </tr>
          <tr>
            <td align="left" style="width:22%; border-bottom:1px solid black;">Asset Name:</td>
            <td align="left" style="border-bottom:1px solid black;"> {{$requisition_slip->asset_name}} </td>
            <td align="left" style="width:22%; border-bottom:1px solid black;">Asset ID:</td>
            <td align="left" style="border-bottom:1px solid black;"> {{$requisition_slip->asset_code}} </td>
          </tr>  
          <tr>
            <td align="left" style="width:32%; border-bottom:1px solid black;">Internal/External Delivery Receipt:</td>
            <td align="left" style="border-bottom:1px solid black;"> {{$requisition_slip->withdrawal_remarks}} </td>
            <td align="left" style="width:22%; border-bottom:1px solid black;"></td>
            <td align="left" style="border-bottom:1px solid black;"></td>
          </tr>         
        </table> 
      </div>
<br>
      <div class="col-md-12">
        <h4><b>REQUISITION DETAILS</b></h4> 
          <table width="100%" border="1" style="border-collapse: collapse;">
          <thead>
          <tr>
            <th align="left">Supply Name</th>
            <th align="left">Description</th>
            <th align="left">Stock Unit</th>
            <th align="left">Qty Requested</th>
            <th align="left">Qty Issued</th>
            <!-- <th align="left">Price</th> -->
            <!-- <th align="left">Total</th> -->
            <th align="left">Purpose</th>
          </tr>
          </thead>
          <tbody>
          @foreach($requisition_slip_items as $requisition_slip_item)
          <tr>
            <td style="border-top: 1px solid #e1e1e1;"> {{$requisition_slip_item->supply_name}} </td>
            <td style="border-top: 1px solid #e1e1e1;"> {{$requisition_slip_item->item_description}} </td>
            <td style="border-top: 1px solid #e1e1e1;"> {{$requisition_slip_item->item_stock_unit}} </td>
            <td style="border-top: 1px solid #e1e1e1;"> {{$requisition_slip_item->item_quantity_requested}} </td>
            <td style="border-top: 1px solid #e1e1e1;"> {{$requisition_slip_item->item_quantity}} </td>
            <!-- <td style="border-top: 1px solid #e1e1e1;"> {{$requisition_slip_item->item_cost}} </td> -->
            <!-- <td style="border-top: 1px solid #e1e1e1;"> {{$requisition_slip_item->item_total}} </td> -->
            <td style="border-top: 1px solid #e1e1e1;"> {{$requisition_slip_item->item_purpose}} </td>
          </tr>       
          @endforeach 
          @if(count($requisition_slip_items)==0)
           <tr>
            <td style="border-top: 1px solid #e1e1e1;" style="border-top: 1px solid #e1e1e1;" align="center" colspan="8"> <br> NO RECORDS </td>
          </tr>
          @endif
          </tbody>
        </table>
      </div>
    </div>
<!-- end::REQUISITION DETAILS -->      
<br>
<div class="col-md-12" style="border-bottom: 2px dotted gray;"> </div>

<!-- WITHDRAWAL DETAILS -->    
    <div class="row" style="font-size:11.5px;">
      <div class="col-md-12">
        <h4><b>WITHDRAWAL DETAILS</b></h4>
          <table width="100%">
          <tr>
            <td align="left" width="15%" style="font-weight: bold;">Received by:</td>
            <td align="left">{{$requisition_slip->received_by_name}} </td>
            <td align="left" width="15%" style="font-weight: bold;">Inspected by:</td>
            <td align="left">{{$requisition_slip->inspected_by_name}} </td>
          </tr>
          <tr style="font-size:11px;">
            <td></td>
            <td style="font-style: italic;"> {{$requisition_slip->received_by_position}} </td>
            <td></td>
            <td style="font-style: italic;"> {{$requisition_slip->inspected_by_position}} </td>
          </tr>
          <tr>
            <td align="left" width="15%" style="font-weight: bold;">Date Received:</td>
            <td align="left">{{$requisition_slip->date_received}}</td>
            <td align="left" width="15%" style="font-weight: bold;">Date Inspected:</td>
            <td align="left">{{$requisition_slip->date_inspected}}</td>
          </tr>
        </table>  
      </div>
    </div>
<!-- end::WITHDRAWAL DETAILS -->    
</section>
</div>
<br><br>

<!-- footer -->
<div class="footer">
  <span style="font-size:7px; letter-spacing:4px;"><center>END OF REQUISITION AND ISSUE SLIP</center></span>
</div>
<!-- end::footer -->

</body>
</html>
