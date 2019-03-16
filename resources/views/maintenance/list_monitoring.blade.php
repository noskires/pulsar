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
          <table datatable="ng" class="table table-bordered table-hover" width="100%">
            <thead>
            <tr>
              <th>Asset Code</th>
              <th>Asset ID</th>
              <th>Asset Name</th>
              <th>Total Operating Time(HRS)</th>
              <th>Total Distance Travelled(KM)</th>
              <th>Total Diesel (L)</th>
              <th>Total Gas (L)</th>
              <th>Total Oil (L)</th>
              <th>Total Loads</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="asset in lmc.assetsMonitoring">
              <td><a href="#" data-toggle="modal" data-target="#modal-default"><b><%asset.asset_code%> </b></a></td>
              <td><a href="#" data-toggle="modal" data-target="#modal-default"><b><%asset.tag%> </b></a></td>
              <td><%asset.asset_name%></td>
              <td align="right"><%asset.total_operating_hours | number:2%></td>
              <td align="right"><%asset.total_distance_travelled | number:2%></td>
              <td align="right"><%asset.total_diesel_consumption | number:2%></td>
              <td align="right"><%asset.total_gas_consumption | number:2%></td>
              <td align="right"><%asset.total_oil_consumption | number:2%></td>
              <td align="right"><%asset.total_number_loads | number:2%></td>
            </tr>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
  </div>
</section>