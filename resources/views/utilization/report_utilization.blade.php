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
        <p> <span style="font-size:12px;font-weight:bold;">PULSAR CONSTRUCTION<br></span> Dodan, Penablanca 3502, Philippines</p>
      </div>
      <!-- /.col -->
    </div>
    <div class="row">
      <div class="col-xs-12" style="border-bottom: 2px solid black;">
        <h2 class="page-header"><i class="fa fa-tags"></i> <img src="assets/dist/img/text-file.png" style="margin-bottom:-4px;width:30px;">&nbsp;UTILIZATION REPORT<br></h2>
        <span style="font-size:14px;letter-spacing:1px;"><strong>Control Number: {{$utilization->utilization_code}}</strong> &nbsp;   </span>
        
        <!-- <div style="position: absolute;top:1%;right:0;"> <img src="assets/dist/img/qrcode.png" style='width:100px;'> </div> -->
      </div>
      <!-- /.col -->
    </div>
<br>

<!-- JOB ORDER DETAILS -->    
    <div class="row" style="font-size: 11.5px;">
      <div class="col-md-12">
        <table width="100%" style="border-collapse:collapse;">
          <tr>
            <td align="left" style="width:17%; border-bottom:1px solid black;">Office/Project:</td>
            <td align="left" style="border-bottom:1px solid black;" colspan="3">{{$office->reference_name}}</td>
          </tr>
          <tr>
            <td align="left" style="width:17%; border-bottom:1px solid black;">Location:</td>
            <td align="left" style="border-bottom:1px solid black;" colspan="3">{{$office->municipality_text." ".$office->province_text." ".$office->region_text_long}}</td>
          </tr>
        </table> 
      </div>
<br>

      <div class="col-md-12">
        <h4><b>REQUISITION DETAILS</b></h4> 
          <table width="100%" border="1" style="border-collapse: collapse;">
          <thead>
          <tr>
            <th align="left">Supply Code</th>
            <th align="left">Supply Name</th>
            <th align="left">Description</th>
            <th align="left">Stock Unit</th>
            <th align="left">Quantity</th>
          </tr>
          </thead>
          <tbody style="font-size: 12px;">
          @foreach($requisition_slip_items as $requisition_slip_item)
            <tr>
              <td style="border-top: 1px solid #e1e1e1;"> {{$requisition_slip_item->supply_code}} </td>
              <td style="border-top: 1px solid #e1e1e1;"> {{$requisition_slip_item->supply_name}} </td>
              <td style="border-top: 1px solid #e1e1e1;"> {{$requisition_slip_item->description}}  </td>
              <td style="border-top: 1px solid #e1e1e1;"> {{$requisition_slip_item->stock_unit}} </td>
              <td style="border-top: 1px solid #e1e1e1;"> {{$requisition_slip_item->item_quantity}} </td>
            </tr>
          @endforeach  
          @if(count($requisition_slip_items)==0)
           <tr>
            <td style="border-top: 1px solid #e1e1e1;" style="border-top: 1px solid #e1e1e1;" align="center" colspan="5"><br> NO RECORDS </td>
          </tr>
          @endif
          </tbody>
        </table>
      </div>
    </div>
</section>
</div>
<br><br>

<!-- footer -->
<div class="footer">
  <span style="font-size:7px; letter-spacing:4px;"><center>END OF UTILIZATION REPORT</center></span>
</div>
<!-- end::footer -->

</body>
</html>
