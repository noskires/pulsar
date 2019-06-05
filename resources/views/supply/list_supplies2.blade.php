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
          <th>Supply Unit</th>
          <th>Re-order Level</th>
          <th>Supply Qty</th>
          <th>Options</th>
        </tr>
        </thead>
        <tbody>
        <tr ng-repeat="supply in sc.supplies">
          <td><a href="#" ui-sref="list-supplyCopy({supplyCode:supply.supply_code})"><b> <%supply.supply_code%> </b></a></td>
          <td><%supply.supply_category_name%></td>
          <td><%supply.supply_name%></td>
          <td><%supply.description%></td> 
          <td><%supply.stock_unit_name%></td> 
          <td><%supply.re_order_level%></td> 
          <td><%supply.quantity%></td> 
          <td><a href="#" ui-sref="edit-supply({supplyCode2:supply.supply_code})"><code class="text-white bg-blue">EDIT</code></a></td> 
        </tr>
        </tbody>
      </table>
    </div>
    <!-- /.box-body -->
</div>

</section>

<script type="text/javascript">
$(function () {

$('.select2').select2();

//   $('#datepicker').datepicker({
//    autoclose: true
//   })

});
</script>

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
      <div class="modal-footer">
        <button type="button" class="btn btn-default" ng-click="vm.ok()">Close</button>
        <a type="button" class="btn btn-info" ng-click="vm.printSupplyDetails(vm.formData.supply_code)" target="_blank" ng-href="<%vm.url%>"><li class="fa fa-print"></li> Print</a>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
</script>

<script type="text/ng-template" id="supplyEdit.modal">
  <div>
    <div class="modal-dialog modal-lg" style="width: 1200px;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><li class="fa fa-briefcase"></li> Supply ID: <b><%vm.formData.supply_code%></b></h4>
        </div>
        <div class="modal-body">
          <p>Edit Supply Information</p>
          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-body">
                  
                  <div class="form-group col-sm-12">
                    <label for="requestpurpose" class="col-sm-2 control-label">Supply Category*</label>
                    <div class="col-sm-4">
                      <select class="form-control select2" style="width: 100%;" required="" ng-model="vm.formData.category_code">
                        <option selected="selected" value="0">- - select supply category - -</option>
                        <option ng-value="supplyCategory.supply_category_code" ng-repeat="supplyCategory in vm.supplyCategories"><%supplyCategory.supply_category_name%></option>
                      </select>
                    </div>

                    <label class="col-sm-2 control-label">Supply Unit*</label>
                    <div class="col-sm-2">

                      <select class="form-control select2" style="width: 100%;" required="" ng-model="vm.formData.stock_unit_code">
                        <option selected="selected" value="0">- - select stock unit - -</option>
                        <option ng-value="stockUnit.stock_unit_code" ng-repeat="stockUnit in vm.stockUnits"><%stockUnit.stock_unit_name%></option>
                      </select>

                    </div>
                  </div>

                  <div class="form-group col-sm-12">
                    <label for="controlnumber" class="col-sm-2 control-label">Supply Name*</label>
                    <div class="col-sm-4"><input type="text" class="form-control" id="supplyname" required="" ng-model="vm.formData.supply_name"></div>
                    <label for="platenumber" class="col-sm-2 control-label">Re-order Level*</label>
                    <div class="col-sm-2"><input type="text" class="form-control" id="reoderlevel" placeholder="" required="" ng-model="vm.formData.re_order_level"></div>
                  </div>

                  <div class="form-group col-sm-12">
                    <label for="supplydescription" class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-4"><textarea class="form-control" id="supplydescription" rows="1" required="" ng-model="vm.formData.description"></textarea></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" ng-click="vm.ok()">Close</button>
          <button type="button" class="btn btn-primary pull-right" ng-click="vm.updateSupply(vm.formData)">Save changes</button>
        </div>
      </div>
    </div>
  </div>
</script>