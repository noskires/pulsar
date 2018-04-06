<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><span class="fa fa-cogs"> </span> Maintenance Monitoring</h1>
  <ol class="breadcrumb">
    <li><a href="../../index.html"><i class="fa fa-th"></i> Dashboard</a></li>
    <li class="active">Maintenance Monitoring</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="box box-primary">
        <div class="box-body">
          <table id="employees" class="table table-bordered table-hover" width="100%">
            <thead>
            <tr>
              <th>Asset Tag</th>
              <th>Equipment Name</th>
              <th>Total Operating Time(HRS)</th>
              <th>Total Distance Travelled(KM/HR)</th>
              <th>Total Diesel</th>
              <th>Total Gas</th>
              <th>Total Oil</th>
              <th>Total Loads</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="asset in lmc.assetsMonitoring">
              <td><a href="#" data-toggle="modal" data-target="#modal-default"><b><%asset.tag%> </b></a></td>
              <td><%asset.asset_name%></td>
              <td><%asset.total_operating_hours%></td>
              <td><%asset.total_distance_travelled%></td>
              <td><%asset.total_diesel_consumption%></td>
              <td><%asset.total_gas_consumption%></td>
              <td><%asset.total_oil_consumption%></td>
              <td><%asset.total_number_loads%></td>
            </tr>

            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
  </div>
</section>