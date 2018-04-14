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
      <table id="tbl_rs" class="table table-bordered table-hover" width="100%">
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
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" ng-click="vm.ok()" ui-sref="list-supply">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><li class="fa fa-briefcase"></li> Supply ID: <b><%vm.formData.supply_code%></b></h4>
      </div>
      <div class="modal-body">
        <p>View supply item details.</p>
        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-body">
                <form>
                  <table class="table table-bordered" class="tbl_list_rcpt">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Receipt No.</th>
                        <th>Receipt Type</th>
                        <th>Supplier Name</th>
                        <th>Supply Qty</th>
                        <th>Stock Unit</th>
                        <th>Total Amount</th>
                      </tr> 
                    </thead>
                    <tbody>
                      <tr ng-repeat="receiptItem in vm.receiptItems">
                        <td><%$index+1%></td>
                        <td><%receiptItem.receipt_code%></td>
                        <td><%receiptItem.receipt_type_name%></td>
                        <td><%receiptItem.supplier_code%></td>
                        <td ng-init="vm.supplyTotalQuantity = vm.supplyTotalQuantity + receiptItem.receipt_item_quantity"><%receiptItem.receipt_item_quantity%></td>
                        <td><%receiptItem.receipt_item_stock_unit%></td>
                        <td><%receiptItem.receipt_item_total%></td>
                      </tr>
                      <tr>
                        <td colspan="4" align="right"><b>TOTAL QUANTITY</b></td>
                        <td colspan="2"><b><%vm.supplyTotalQuantity%></b></td>
                        <td></td>
                      </tr>
                    </tbody>
                  </table>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-info"><li class="fa fa-print"></li> Print</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
</script>

</section>