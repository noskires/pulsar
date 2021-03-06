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
      <div class="col-md-6" style="border-bottom: 2px solid black;">
        <h2 class="page-header"><i class="fa fa-tags"></i> <img src="assets/dist/img/clipboard.png" style="margin-bottom:-4px;width:30px;">&nbsp;STOCK CARD<br></h2>
       
       <!-- Supply Name -->
        <span style="font-size:14px;letter-spacing:1px;">
          <strong>{{$supply->supply_name}}</strong>
        </span>
        <!-- end::Supply Name -->

        <!-- <div style="position: absolute;top:1%;right:0;"> <img src="assets/dist/img/qrcode.png" style='width:100px;'> </div> -->
      </div>
    </div>
<br>    
    <div class="row" style="font-size:11.5px;">
      <div class="col-md-12">
        <table width="100%" style="border-collapse:collapse;">
          <tr>
            <td align="left" style="width:17%; border-bottom:1px solid black;">Supply Name:</td>
            <td align="left" style="border-bottom:1px solid black;" colspan="3">{{$supply->supply_name}}</td>
          </tr>
          <tr>
            <td align="left" style="width:17%; border-bottom:1px solid black;">Supply Category:</td>
            <td align="left" style="border-bottom:1px solid black;">{{$supply->category_code}}</td>
            <td align="left" style="width:17%; border-bottom:1px solid black;">Supply Unit:</td>
            <td align="left" style="border-bottom:1px solid black;">{{$supply->stock_unit}}</td>
          </tr>
          <tr>
            <td align="left" style="width:17%; border-bottom:1px solid black;">Re-order Level:</td>
            <td align="left" style="border-bottom:1px solid black;">{{$supply->re_order_level}}</td>
            <td align="left" style="width:17%; border-bottom:1px solid black;">Supply Quantity:</td>
            <td align="left" style="border-bottom:1px solid black;">{{$supply->quantity}}</td>
          </tr>
        </table> 
      </div>      
    </div>
<br><br>

<!-- STOCK CARD -->    
    <div class="row" style="font-size: 11.5px;">
      <div class="col-md-12">
          <table width="100%" border="1" style="border-collapse: collapse;">
          <thead>
          <tr>
            <th align="left">Date</th>
            <th align="left">References</th>
            <th align="left">Particulars</th>
            <th align="left">Quantity (+)</th>
            <th align="left">Quantity (-)</th>
            <th align="left">Available Stock</th>
          </tr>
          </thead>
          <tbody style="font-size: 12px;padding:3px">
            {{$stocks = 0}}
            @foreach($stock_items as $stock_item)
            <tr>
              <td style="border-top: 1px solid #e1e1e1;"> {{$stock_item->date}} </td>
              <td style="border-top: 1px solid #e1e1e1;"> {{$stock_item->reference}} </td>
              <td style="border-top: 1px solid #e1e1e1;"> {{$stock_item->particulars}}</td>
              @if($stock_item->type=="RCP")
              {{$stocks = $stocks + $stock_item->quantity }}
              <td style="border-top: 1px solid #e1e1e1;text-align: right;padding: 3px;"> {{number_format($stock_item->quantity, 2)}} </td>
              <td style="border-top: 1px solid #e1e1e1;">  </td>
              @else
              {{$stocks = $stocks - $stock_item->quantity }}
              <td style="border-top: 1px solid #e1e1e1;"> </td>
              <td style="border-top: 1px solid #e1e1e1;text-align: right;padding: 3px;"> {{number_format($stock_item->quantity, 2)}} </td>
              @endif
              <td style="border-top: 1px solid #e1e1e1;text-align: right;padding: 3px;"> {{number_format($stocks, 2)}} </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
<br>
</section>
</div>
<br><br>

<!-- footer -->
<div class="footer">
  <span style="font-size:7px; letter-spacing:4px;"><center>END OF STOCK CARD</center></span>
</div>
<!-- end::footer -->

</body>
</html>
