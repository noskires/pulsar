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
        <h2 class="page-header"><i class="fa fa-tags"></i> <img src="assets/dist/img/text-file.png" style="margin-bottom:-4px;width:30px;">
          &nbsp;UTILIZATION REPORT<br></h2>
        <span style="font-size:14px;letter-spacing:1px;">Period: {{$date_from}} - {{$date_to}}</span>
        
        <!-- <div style="position: absolute;top:1%;right:0;"> <img src="assets/dist/img/qrcode.png" style='width:100px;'> </div> -->
      </div>
      <!-- /.col -->
    </div>
<br>

<!-- JOB ORDER DETAILS -->    
    <div class="row" style="font-size: 11.5px;">
      <div class="col-md-12">
        Office/Project: <b>{{$office->reference_name}}</b> <br>
        Location: <b>{{$office->municipality_text." ".$office->province_text." ".$office->region_text_long}}</b> <br>
        <br>

        @foreach($requisition_slip_items as $category=>$category_items)
<!-- Repairs and Maintenance - Construction Equipment -->    
        <h4><b>{{$category}}</b></h4> 
          <table width="100%" border="1" style="border-collapse: collapse;">
          <thead>
          <tr>
            <th align="left">Supply Code</th>
            <th align="left">Supply Name</th>
            <th align="left">Description</th>
            <th align="left">Stock Unit</th>
            <th align="left">Total Quantity per RIS (TQRIS)</th>
            <th align="left">Total Quantity Per Utilization (TQU)</th>
            <th align="left">Quantity Available (TQRIS - TQU)</th>
          </tr>
          </thead>
          <tbody style="font-size: 12px;">
          @foreach($category_items as $category_item)
            <tr>
              <td style="border-top: 1px solid #e1e1e1;"> {{$category_item->supply_code}} </td>
              <td style="border-top: 1px solid #e1e1e1;"> {{$category_item->supply_name}} </td>
              <td style="border-top: 1px solid #e1e1e1;"> {{$category_item->description}}  </td>
              <td style="border-top: 1px solid #e1e1e1;"> {{$category_item->stock_unit}} </td>
              <td style="border-top: 1px solid #e1e1e1;"> {{$category_item->total_item_quantity_ris}}</td>
              <td style="border-top: 1px solid #e1e1e1;"> {{$category_item->total_item_quantity_utilization}}</td>
              <td style="border-top: 1px solid #e1e1e1;"> 
                {{ ($category_item->total_item_quantity_ris - $category_item->total_item_quantity_utilization) }}
              </td>
            </tr>
            @endforeach    
          </tbody>
        </table>
        @endforeach 
      </div>
    </div>
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
