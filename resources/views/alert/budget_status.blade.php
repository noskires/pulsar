

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><span class="fa fa-cogs"> </span> Budget Allocation Status </h1>
  <ol class="breadcrumb">
    <li><a href="../../index.html"><i class="fa fa-th"></i> Dashboard</a></li>
    <li class="active">Returned Items</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="box box-primary">
        <div class="box-body">
          <div export-to-xlsx data="rc.returneReceiptItems" bind-to-table="'tb-maintenance-monitoring'" filename="'Returned Items'"></div>
          <table datatable="ng" class="table table-bordered table-hover" name='tb-maintenance-monitoring' width="100%">
            <thead>
            <tr>
                <th>Fund Year</th>
                <th>Fund Name</th>
                <th>Cost Center Name</th> 
                <th>Particular</th>
                <th>Allocation</th>
                <th>Utilization</th>
                <th>Variance</th>
                <th>%</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="fund in fc.fundItems">
              <td><%fund.fund_year%></td>
              <td><%fund.fund_name%></td>
              <td><%fund.cost_center_name%></td>
              <td><%fund.supply_category_name%></td>
              <td align="right"><%fund.fund_item_amount |number:2%></td>
              <td align="right"><%fund.total_receipt_item_Cost |number:2%></td>
              <td align="right"><%fund.fund_item_amount-fund.total_receipt_item_Cost |number:2%></td>
              <td align="right"><%(fund.total_receipt_item_Cost/fund.fund_item_amount)*100 |number:2%>%</td>
            </tr>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
  </div>
</section>