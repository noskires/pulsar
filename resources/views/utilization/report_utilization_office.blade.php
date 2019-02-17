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
        <h2 class="page-header"><i class="fa fa-tags"></i> <img src="assets/dist/img/text-file.png" style="margin-bottom:-4px;width:30px;">
          &nbsp;UTILIZATION REPORT<br></h2>
        <span style="font-size:16px;letter-spacing:1px;">Period: 01/01/2019 - 02/02/2019</span>
        <div style="position: absolute;top:1%;right:0;"> <img src="assets/dist/img/qrcode.png" style='width:100px;'> </div>
      </div>
      <!-- /.col -->
    </div>
<br>

<!-- JOB ORDER DETAILS -->    
    <div class="row">
      <div class="col-md-12">
        Office/Project: <b>{{$utilization->reference_name}}</b> <br>
        Location: <b>{{$utilization->municipality_text." ".$utilization->province_text." ".$utilization->region_text_long}}</b> <br>
        <br>

        @foreach($requisition_slip_items as $category=>$category_items)
<!-- Repairs and Maintenance - Construction Equipment -->    
        <h4><b>{{$category}}</b></h4> 
          <table border="1" width="100%" style="font-size:13px;border-spacing:0px;">
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
<br>
      </div>
    </div>

<br><br>    
</section>
</div>
<div style="text-align:center;">
  <span style="font-size: 10px;">*** END OF UTILIZATION REPORT ***</span><br>
  <span style="font-size: 9.5px;">ASSETERIK&copy; V.1.0 &nbsp;&nbsp; Developed by Bizlogiks Information Technology Systems (BITS) &nbsp;&nbsp; www.bizlogiks.ph</span>
</div>
</body>
</html>
