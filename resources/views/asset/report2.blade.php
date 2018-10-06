<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Pulsar Construction</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../bower_components/Ionicons/css/ionicons.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <!--   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> -->
  <style type="text/css">
    @page {
    margin-top: 1.7cm;
    margin-bottom: 1.6cm;
    margin-left: 1cm;
    margin-right: 1cm; 
    }
    @media print {
      div.divFooter {
      position: fixed;
      bottom: 0; 
      margin-bottom: -1px; 
      font-style: italic;
      font-size: 9px; } 
    }
    .table td {
    padding: 2.5px !important;
    font-size: 12.5px;  
    }
    .table th {
    padding: 1px !important;
    font-size: 12.5px;  
    }
    #operatingdetails {
      font-size: 11px;
    }
    .page-header {
      border-style: none;
    }
  </style>
</head>
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12" style="border-bottom: 2px solid black;">
        <h2 class="page-header">
          <i class="fa fa-tags"></i> ASSET PROFILE<br>
          <small class="pull-right">Asset Tag:  {{$assetTag}}</small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
<br>
<!-- ASSET DETAILS -->
    <div class="row invoice-info" style="border-bottom: 1px solid black;">
      <div class="col-xs-6 invoice-col">
        <h4> ASSET DETAILS </h4>
          <div style="font-size: 16px;">

          <table border="1"  width="100%">
            <tr>
              <th width="20%"></th>
              <th width="45%"></th>
              <th width="35%" rowspan="16" align="right" valign="top">
               <img src="assets/dist/img/dumptruck_1024x768.jpg" style='width:250px;'> <br>
               <img src="assets/dist/img/qrcode.png" style='width:250px;'> 
              </th>
            </tr>
              <tr>
                <td>Category:</td>
                <td> {{$asset->category}}</td>
              </tr>
              <tr>
                <td>Name:</td>
                <td>{{$asset->asset_name}}</td>
              </tr>
              <tr>
                <td>Description:</td>
                <td>{{$asset->description}}</td>
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
                <td>Acquisition Cost:</td>
                <td>{{$asset->acquisition_cost}}</td>
              </tr>
              <tr>
                <td>Plate No:</td>
                <td>{{$asset->plate_no}}</td>
              </tr>
              <tr>
                <td>Engine/Serial No:</td>
                <td>{{$asset->engine_no}}</td>
              </tr>
              <tr>
                <td>Chassis No:</td>
                <td>{{$asset->chassis_no}}</td>
              </tr>
              <tr>
                <td>Warranty Date:</td>
                <td>{{$asset->warranty_date}}</td>
              </tr>
              <tr>
                <td>Location:</td>
                <td>{{$asset->model}}</td>
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
            <br>
          </div>
      </div>
    </div>

<!-- MONITORING -->    
    <div class="row" style="border-bottom: 1px solid black;">
      <div class="col-xs-6 table-responsive">
        <h4 style="padding-bottom: 6px;">CURRENT OPERATING RECORD</h4>
          <table class="table" style="width:50%;border:1px solid;">
            <tbody>
            <tr>
              <td>Operating Hours</td>
              <td>{{$asset_monitoring->total_operating_hours}}</td>
            </tr>
            <tr>
              <td>Kilometers Traveled</td>
              <td>71,234</td>
            </tr>
            <tr>
              <td>Loads (m3)</td>
              <td>71,234</td>
            </tr>
            <tr>
              <td>Diesel (L) Consumed</td>
              <td>55,123</td>
            </tr>
            <tr>
              <td>Gas (L) Consumed</td>
              <td>90,123</td>
            </tr>
            <tr>
              <td>Oil (L) Consumed</td>
              <td>23,123</td>
            </tr>
            </tbody>
          </table>
      </div>
    </div> 
<br>

<!-- INSURANCE -->    
    <div class="row" style="border-bottom: 1px solid black;">
      <div class="col-xs-12 table-responsive">
        <h4>INSURANCE</h4> 
        <table class="table">
          <thead>
          <tr>
            <th>Insurance Co.</th>
            <th>Description</th>
            <th>Contact Person</th>
            <th>Start Date</th>
            <th>End Date</th>
          </tr>
          </thead>
          <tbody>
          @foreach($insurance as $insurance)
          <tr>
            <td>{{$insurance->insurance_co}}</td>
            <td>{{$insurance->description}}</td>
            <td>{{$insurance->insurance_agent}}</td>
            <td>{{$insurance->date_issued}}</td>
            <td>{{$insurance->expiration_date}}</td>
          </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
<br><br><br><br>

<!-- MAINTENANCE HISTORY -->    
    <div class="row" style="border-bottom: 1px solid black;">
      <div class="col-xs-12 table-responsive">
        <h4>MAINTENANCE HISTORY</h4> 
        <table class="table" style="width:100%">
          <thead>
          <tr>
            <th>Control#</th>
            <th>JO Date</th>
            <th>Started</th>
            <th>Completed</th>
            <th>Conducted By</th>
            <th>Operating Details</th>
          </tr>
          </thead>
          <tbody>
          @foreach($jos as $jo)
          <tr>
            <td>{{$jo->job_order_code}}</td>
            <td>{{$jo->job_order_date}}</td>
            <td>{{$jo->date_started}}</td>
            <td>{{$jo->date_completed}}</td>
            <td>{{$jo->conducted_by}}</td>
            <td id="operatingdetails">Operating Hours: 123 <br>
                Kilometers Traveled: 123 <br>
                Diesel (L) Consumed: 123 <br>
                Gas (L) Consumed: 123 <br>
                Oil (L) Consumed: 123 <br>
                Loads (m3): 123 <br>
            </td>
          </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
<br>

<!-- EVENTS -->    
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <h4>EVENTS</h4> 
        <table class="table" style="width:100%;border:1px solid">
          <thead>
          <tr>
            <th>Status</th>
            <th>Event Date</th>
            <th>Description/Remarks</th>
          </tr>
          </thead>
          <tbody>
          	@foreach($events as $event)
          <tr>
            <td>{{$event->status}}</td>
            <td>{{$event->event_date}}</td>
            <td>{{$event->remarks}}</td>
          </tr>
           @endforeach
          </tbody>
        </table>
      </div>
    </div>
<br>

<center>* * * END OF ASSET PROFILE * * *</center>  
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<div class="divFooter"> PULSAR &nbsp; ASSETERIK&copy; V.1.0 &nbsp; www.bizlogiks.ph </div>

<!-- ./wrapper -->
</body>
</html>
