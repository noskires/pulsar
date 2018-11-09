<!-- Content Header (Page header) -->
<section class="content-header">
<h1><span class="fa fa-briefcase"> </span> Supply List</h1>
<ol class="breadcrumb">
<li><a href="../../index.html"><i class="fa fa-th"></i> Dashboard</a></li>
<li class="active">Supplies</li>
</ol>
</section>

<!-- Main content -->
<section class="content">
<div class="box">
    <div class="box-body">
      <table datatable="ng"  class="table table-bordered table-hover" width="100%">
        <thead>
        <tr>
          <th>Control Number</th>
          <th>Category</th>
          <th>Name</th>
          <th>Description</th>
          <th>Supply Qty</th>
          <th>Supply Unit</th>
          <th>Re-order Level</th>
        </tr>
        </thead>
        <tbody>
        <tr ng-repeat="supply in sc.supplies">
          <td><a href="#" ui-sref="list-supplyCopy({supplyCode:supply.supply_code})"><b> <%supply.supply_code%> </b></a></td>
          <td><%supply.asset_name%></td>
          <td><%supply.supply_name%></td>
          <td><%supply.description%></td> 
          <td><%supply.quantity%></td> 
          <td><%supply.stock_unit_name%></td> 
          <td><%supply.re_order_level%></td> 
        </tr>
        </tbody>
      </table>
    </div>
    <!-- /.box-body -->
</div>
<!-- MODAL POPUP -->
<script type="text/ng-template" id="supplyInfo.modal">
<div>
  <div class="modal-dialog" style="width:100%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" ng-click="vm.ok()" ui-sref="list-supply">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><li class="fa fa-briefcase"></li> Supply ID: <b><%vm.formData.supply_code%> ( <%vm.formData.supply_name%> )</b></h4>
      </div>
      <div class="modal-body">
        <p>View supply item details.</p>
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-body">
                <form>
                  <table datatable="ng" class="table table-bordered table-hover" width="100%">
                    <thead> 
                        <th>No.</th>
                        <th>Receipt No.</th>
                        <th>Receipt Type</th>
                        <!-- <th>Supplier Name</th> -->
                        <th>Supply Qty</th>
                        <th>Stock Unit</th>
                        <th>Total Amount</th> 
                    </thead>
                    <tbody>
                      <tr ng-repeat="receiptItem in vm.receiptItems">
                        <td><%$index+1%></td>
                        <td><%receiptItem.receipt_code%></td>
                        <td><%receiptItem.receipt_type_name%></td>
                        <!-- <td><%receiptItem.supplier_code%></td> -->
                        <td ng-init="vm.supplyTotalQuantity = vm.supplyTotalQuantity + receiptItem.receipt_item_quantity"><%receiptItem.receipt_item_quantity%></td>
                        <td><%receiptItem.receipt_item_stock_unit%></td>
                        <td><%receiptItem.receipt_item_total%></td>
                      </tr>
                    </tbody>
                  </table>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
</script>

</section>