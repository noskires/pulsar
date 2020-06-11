
<!-- Page Loader -->
<div id="loader" ng-if="rc.loader_returned_items_status"></div>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><span class="fa fa-cogs"> </span> Returned Items </h1>
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
              <th>PO</th>
              <th>Receipt Number</th>
              <th>Receipt Type</th>
              <th>Supplier</th>
              <th>Supply Name</th>
              <th>Description</th>
              <th>Stock Unit</th>
              <th>Quantity</th>
              <th>Cost</th>
              <th>Total Cost</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="returned_item in rc.returneReceiptItems">
              <td><%returned_item.old_reference%></td>
              <td><%returned_item.receipt_number%></td>
              <td><%returned_item.receipt_type_name%></td>
              <td><%returned_item.supplier_name%></td>
              <td><%returned_item.supply_name%></td>
              <td><%returned_item.receipt_item_description%></td>
              <td><%returned_item.receipt_item_stock_unit%></td>
              <td><%returned_item.receipt_item_quantity%></td>
              <td><%returned_item.receipt_item_cost%></td>
              <td><%returned_item.receipt_item_total%></td>
            </tr>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
  </div>
</section>