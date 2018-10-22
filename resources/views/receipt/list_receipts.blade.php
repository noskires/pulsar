<!-- Content Header (Page header) -->
<section class="content-header">
<h1><span class="fa fa-file-o"> </span> List of Receipts</h1>
<ol class="breadcrumb">
  <li><a href="../../index.html"><i class="fa fa-th"></i> Dashboard</a></li>
  <li class="active">Receipts</li>
</ol>
</section>

<!-- Main content -->
<section class="content">
<div class="box">
  <div class="box-body">
    <table datatable="ng" class="table table-bordered table-hover" width="100%">
      <thead>
      <tr>
        <th>Control No.</th>
        <th>Receipt Type</th>
        <th>Receipt No.</th>
        <th>Receipt Date</th>
        <th>Amount</th>
        <th>Payee Type</th>
        <th>Payee Name</th>
        <th>PO</th>
        <th>Voucher</th>
      </tr>
      </thead>
      <tbody>
      <tr ng-repeat="receipt in rc.receipts">
        <td><a href="#" ui-sref="list-receiptCopy({receiptCode:receipt.receipt_code})"><b><%receipt.receipt_code%></b></a></td>
        <td><%receipt.receipt_type_name%></td>
        <td><%receipt.receipt_number%></td>
        <td><%receipt.receipt_date%></td>
        <td><%receipt.amount | number:2%></td>
        <td><%receipt.payee_type%></td>
        <td><%receipt.payee_text%></td>
        <td><%receipt.purchase_order_code%></td>
        <td><%receipt.voucher_code%></td>
      </tr> 
      </tbody>
    </table>
  </div>
  <!-- /.box-body -->
</div>
</section>
<!-- MODAL POPUP -->

<script type="text/ng-template" id="receiptInfo.modal">
  <div>
    <div class="modal-dialog" style="width:100%;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" ui-sref="list-receipt" ng-click="vm.ok()">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><li class="fa fa-file-o"></li> Receipt Control No: <b><%vm.formData.receipt_code%></b></h4>
        </div>
        <div class="modal-body">
          <p>Add supply items under a receipt number. <%vm.formData.amount%> </p>
          <!-- Custom Tabs (Pulled to the right) -->
          <div class="row" ng-if="!vm.formData.voucher_code">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-body">
                  <form ng-submit="vm.addNew()" >
                    <table class="table table-striped table-bordered" class="tbl_rs_supply">
                      <thead>
                        <tr>
                          <!-- <th><input type="checkbox" ng-model="selectedAll" ng-click="vm.checkAll()" /></th>  -->
                          <th>Supply Name</th>
                          <th width="25%">Description</th>
                          <th width="9%">Stock Unit</th>
                          <th width="9%">Quantity</th>
                          <th width="9%">Cost</th>
                          <th width="11%">Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr ng-repeat="personalDetail in vm.personalDetails" >
                          <!-- <td><input type="checkbox" ng-model="personalDetail.selected"/></td>  -->
                          <td>
                            <select class="form-control select2" style="width: 60%;" required="" ng-model="personalDetail.supply_name" ng-init="parentIndex = $index" ng-change="vm.selectSupply(parentIndex, personalDetail.supply_name)">
                              <option selected="selected" value="0">- - select supply - -</option>
                              <option ng-value="supply.supply_code" ng-repeat="supply in vm.supplies"><%supply.supply_name%></option>
                            </select>
                            <button type="button" class="btn btn-primary btn-xs fa fa-plus addsupplyname" ui-sref="supply-create" ng-click="vm.ok()"></button>
                          </td>
                          <td><input type="text" class="form-control" ng-model="personalDetail.supply_desc" disabled required/></td>
                          <td><input type="text" class="form-control" ng-model="personalDetail.supply_unit" disabled required/></td>
                          <td><input type="text" class="form-control" ng-model="personalDetail.supply_qty" ng-keyup="vm.computeTotalPerSupply(parentIndex, personalDetail.supply_qty, personalDetail.supply_cost)" required/></td>
                          <td><input type="text" class="form-control" ng-model="personalDetail.supply_cost" ng-keyup="vm.computeTotalPerSupply(parentIndex, personalDetail.supply_qty, personalDetail.supply_cost)" required/></td>
                          <td><input type="text" class="form-control" ng-model="personalDetail.supply_total" ng-init="personalDetail.supply_total = vm.supply_qty[parentIndex]" required/></td>
                        </tr>
                      </tbody>
                    </table>

                    <div class="form-group">
                      <div class="form-group">
                        <input type="button" class="btn btn-info pull-right" value="Submit Form" style="margin-right: 10px;" ng-click="vm.addReceiptItems(vm.personalDetails)">
                        <!-- <button ng-hide="!vm.personalDetails.length" type="button" class="btn btn-danger pull-left fa fa-trash-o" ng-click="vm.remove()"></button> -->
                        <!-- <button type="submit" class="pull-left btn btn-primary fa fa-plus addnew"></button> -->
                      </div>
                    </div>

                  </form>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-body">
                  <form>
                    <table class="table table-bordered" class="tbl_list_rcpt">
                      <thead>
                        <tr> 
                          <th>Supply Name</th>
                          <th width="25%">Description</th>
                          <th width="9%">Stock Unit</th>
                          <th width="9%">Quantity</th>
                          <th width="9%">Cost</th>
                          <th width="7%">Total</th>
                          <th ng-if="!vm.formData.voucher_code" width="11%"> </th>
                        </tr> 
                      </thead>
                      <tbody>
                        <tr ng-repeat="receiptItem in vm.receiptItems"> 
                          <td><%receiptItem.supply_name%></td>
                          <td><%receiptItem.receipt_item_description%></td>
                          <td><%receiptItem.receipt_item_stock_unit%></td>
                          <td><%receiptItem.receipt_item_quantity%></td>
                          <td align="right"><%receiptItem.receipt_item_cost | number:2%></td>
                          <td ng-init="vm.supplyGrandTotal = vm.supplyGrandTotal + receiptItem.receipt_item_total"><%receiptItem.receipt_item_total | number:2%></td>
                          <td ng-if="!vm.formData.voucher_code">
                            <a href="#" ng-click="vm.removeSupplyBtn(receiptItem.receipt_item_code, receiptItem.receipt_item_quantity, receiptItem.receipt_item_supply_code)"><code class="text-red">REMOVE</code></a>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="5" align="right"><b>GRAND TOTAL</b></td>
                          <td colspan="1"><b>₱<%vm.supplyGrandTotal | number:2%></b></td>
                          <td ng-if="!vm.formData.voucher_code"></td>
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
          <!-- <button type="button" class="btn btn-primary" ng-click="vm.addItems()">Save changes</button> -->
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
</script>

<script type="text/ng-template" id="receiptInfo2.modal">
<div class="">
  <div class="modal-dialog" style="width:100%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" ng-click="vm.ok()">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><li class="fa fa-file-o"></li> Receipt Control No: <b><%vm.formData.receipt_code%></b></h4>
      </div>
      <div class="modal-body">
        <p><b>Remarks:</b> <%vm.formData.remarks%></p>

        <!-- Custom Tabs (Pulled to the right) -->
              <div class="row">
                <div class="col-md-12">
                  <div class="panel panel-default">
                    <div class="panel-body">
                      <label>Receipt Type:&nbsp;</label><%vm.formData.receipt_type_name%><br>
                      <label>Receipt No:&nbsp;</label><%vm.formData.receipt_number%><br>
                      <label>Receipt Date:&nbsp;</label><%vm.formData.receipt_date%><br>
                      <label>Amount:&nbsp;</label><%vm.formData.amount | number:2%><br>
                      <label>Payee Type:&nbsp;</label><%vm.formData.payee_type%><br>
                      <label>Payee Name:&nbsp;</label><%vm.formData.payee_text%><br>
                    </div>
                  </div>
                </div>
              </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" ng-click="vm.ok()">Close</button>
        <button type="button" class="btn btn-info"><li class="fa fa-print"></li> Print</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
</script>
