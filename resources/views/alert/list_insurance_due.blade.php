<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><span class="fa fa-cogs"> </span> Insurance for renewal </h1>
  <ol class="breadcrumb">
    <li><a href="../../index.html"><i class="fa fa-th"></i> Dashboard</a></li>
    <li class="active">Insurance</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="box box-primary">
        <div class="box-body">
          <div export-to-xlsx data="ic.insurance" bind-to-table="'tb-maintenance-monitoring'" filename="'Insurance For Renewal'"></div>
          <table datatable="ng" class="table table-bordered table-hover" name='tb-maintenance-monitoring' width="100%">
            <thead>
            <tr>
              <th>Insurance Co.</th>
              <th>Description</th>
              <th>Insurance Coverage</th>
              <th>Date Issued</th>
              <th>Expiration Date</th>
              <th>Expires in (days)</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="insurance in ic.insurance" ng-if="insurance.expires_in<=30">
              <td><%insurance.insurance_co%></td>
              <td><%insurance.description%></td>
              <td><%insurance.insurance_coverage%></td>
              <td><%insurance.date_issued%></td>
              <td><%insurance.expiration_date%></td>
              <td><%insurance.expires_in%></td>
            </tr>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
  </div>
</section>