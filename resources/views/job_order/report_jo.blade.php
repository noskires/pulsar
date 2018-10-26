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
        <h2 class="page-header"><i class="fa fa-tags"></i> <img src="assets/dist/img/folder-o.png" style="margin-bottom:-4px;width:30px;">&nbsp;JOB ORDER INFORMATION<br></h2>
        <span style="font-size:16px;letter-spacing:1px;"><strong>Control Number: {{$job_order->job_order_code}}</strong> &nbsp; Date: {{$job_order->job_order_date}}</span>
        <div style="position: absolute;top:1%;right:0;"> <img src="assets/dist/img/qrcode.png" style='width:100px;'> </div>
      </div>
      <!-- /.col -->
    </div>

<!-- ASSET DETAILS -->
    <div class="row" style="border-bottom: 1px solid black;">
      <div class="col-md-12">
        <h4> <b>ASSET DETAILS</b> </h4> 
          <table border="0" width="100%" style="font-size:13px;line-height:10px;">
            <tr>
              <th width="20%"></th>
              <th width="45%"></th>
              <th width="35%" rowspan="16" valign="top">
                <!-- <img src="../../dist/img/dumptruck_1024x768.jpg" width="260px"> <br> -->
                @if($asset_photo)
                <img src="uploads/{{$asset_photo->asset_photo_name}}" style='width:190px;'> <br>
                @else
                <img src="uploads/no-image.png" style='width:190px;'> <br>
                @endif
              </th>
            </tr>
            <tr>
              <td width="20%">Category:</td>
                <td>{{$asset->category}}</td>
             </tr>
              <tr>
                <td>Name:</td>
                <td>{{$asset->asset_name}}</td>
              </tr>
              <tr>
                <td>Asset ID:</td>
                <td>{{$asset->code}}</td>
              </tr>
              <tr>
                <td>Model:</td>
                <td>{{$asset->model}}</td>
              </tr>
              <tr>
                <td>Brand:</td>
                <td>{{$asset->brand}}</td>
              </tr>
              <tr>
                <td>Date Acquired:</td>
                <td>{{$asset->date_acquired}}</td>
              </tr>
              <tr>
                <td>Plate No:</td>
                <td>{{$asset->plate_no}}</td>
              </tr>
              <tr>
                <td>Warranty Date:</td>
                <td>{{$asset->warranty_date}}</td>
              </tr>
              <tr>
                <td>Location:</td>
                <td>{{$asset->barangay.' '.$asset->municipality_text.' '.$asset->province_text.' '.$asset->region_text_short}}</td>
              </tr>
              <tr>
                <td>Assigned to:</td>
                <td>{{$asset->employee_name}}</td>
              </tr>
              <tr>
                <td>Status:</td>
                <td>{{$asset->status}}</td>
              </tr> 
          </table> 
      </div>
    </div>
<!-- JOB ORDER DETAILS -->    
    <div class="row" style="border-bottom: 1px solid black;">
      <div class="col-md-12">
        <h4><b>JOB ORDER DETAILS</b></h4> 
          <table border="0" width="100%" style="font-size:13px;">
          <thead>
          <tr>
            <th align="left">Date Started</th>
            <th align="left">Date Completed</th>
            <th align="left">Conducted by</th>
            <th align="left">Accepted by</th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td style="border-top: 1px solid #e1e1e1;"> {{$job_order->date_started}} </td>
            <td style="border-top: 1px solid #e1e1e1;"> {{$job_order->date_completed}} </td>
            <td style="border-top: 1px solid #e1e1e1;"> {{$job_order->conducted_by_name}} </td>
            <td style="border-top: 1px solid #e1e1e1;"> {{$job_order->accepted_by_name}} </td>
          </tr>
          </tbody>
        </table> <br>
      </div>
    </div>
    <!-- REQUISITION AND ISSUE SLIP -->    
    <div class="row" style="border-bottom: 1px solid black;">
      <div class="col-md-12">
        <h4><b>REQUISITION AND ISSUE SLIP</b></h4> 
          <table border="0" width="100%" style="font-size:13px;">
          <thead>
          <tr>
            <th align="left">Requisition No.</th>
            <th align="left">Date Requested</th>
            <th align="left">Date Needed</th>
            <th align="left">Received by</th>
            <th align="left">Date Received</th>
            <th align="left">Inspected by</th>
            <th align="left">Date Inspected</th>
          </tr>
          </thead>
          <tbody>
          @foreach($requisition_slips as $requisition_slip)
          <tr style="font-size: 12px !important;">
            <td style="border-top: 1px solid #e1e1e1;"> {{$requisition_slip->requisition_slip_code}} </td>
            <td style="border-top: 1px solid #e1e1e1;"> {{$requisition_slip->date_requested}} </td>
            <td style="border-top: 1px solid #e1e1e1;"> {{$requisition_slip->date_needed}} </td>
            <td style="border-top: 1px solid #e1e1e1;"> {{$requisition_slip->received_by_name}} </td>
            <td style="border-top: 1px solid #e1e1e1;"> {{$requisition_slip->date_received}} </td>
            <td style="border-top: 1px solid #e1e1e1;"> {{$requisition_slip->inspected_by_name}} </td>
            <td style="border-top: 1px solid #e1e1e1;"> {{$requisition_slip->date_inspected}} </td>
          </tr>
          @endforeach
          @if(count($requisition_slips)==0)
           <tr>
            <td style="border-top: 1px solid #e1e1e1;" style="border-top: 1px solid #e1e1e1;" align="center" colspan="7"> NO RECORDS </td>
          </tr>
          @endif
          </tbody>
        </table>
      </div>
    </div>
<!-- SUPPLIES AND SERVICES USED -->    
    <div class="row" style="border-bottom: 1px solid black;">
      <div class="col-md-12">
        <h4><b>SUPPLIES AND SERVICES USED</b></h4> 
          <table border="0" width="100%" style="font-size:13px;">
          <thead>
          <tr>
            <th align="left">Supply Name</th>
            <th align="left">Description</th>
            <th align="left">Stock Unit</th>
            <th align="left">Quantity</th> 
          </tr>
          </thead>
          <tbody>
          

          @if(count($requisition_slip_items)>0)
          @foreach($requisition_slip_items[0] as $requisition_slip_item)
          <tr>
            <td style="border-top: 1px solid #e1e1e1;"> {{$requisition_slip_item->supply_name}} </td>
            <td style="border-top: 1px solid #e1e1e1;"> {{$requisition_slip_item->item_description}} </td>
            <td style="border-top: 1px solid #e1e1e1;"> {{$requisition_slip_item->item_stock_unit}} </td>
            <td style="border-top: 1px solid #e1e1e1;" align="center"> {{$requisition_slip_item->item_quantity}} </td>
          </tr>
          @endforeach
          @else
          <tr>
            <td style="border-top: 1px solid #e1e1e1;" style="border-top: 1px solid #e1e1e1;" align="center" colspan="5"> NO RECORDS </td>
          </tr>
          @endif
          </tbody>
        </table> <br>
      </div>
    </div>
<br>

<!-- SIGNATORIES -->    
    <div class="row">
      <div class="col-md-12">
          <table border="0" width="100%" style="font-size:13px;">
          <thead>
          <tr>
            <th align="left">Requested by:</th>
            <th align="left">{{$job_order->requested_by_name}}</th>
            <th align="left">Approved by:</th>
            <th align="left">{{$job_order->inspected_by_name}} </th>
          </tr>
          </thead>
          <tbody style="font-size:11px;">
            <tr>
              <td></td>
              <td> {{$job_order->received_by_position}} </td>
              <td></td>
              <td> {{$job_order->inspected_by_position}}</td>
            </tr>
          </tbody>
        </table> <br>
      </div>
    </div>
<br>
</section>
</div>
<div style="text-align:center;">
  <span style="font-size: 10px;">*** END OF JOB ORDER INFORMATION ***</span><br>
  <span style="font-size: 9.5px;">ASSETERIK&copy; V.1.0 &nbsp;&nbsp; Developed by Bizlogiks Information Technology Systems (BITS) &nbsp;&nbsp; www.bizlogiks.ph</span>
</div>
</body>
</html>
