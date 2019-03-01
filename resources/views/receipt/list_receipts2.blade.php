<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><span class="fa fa-file-o"> </span> Receipts</h1>
        <p>This page displays the list of Receipts.<br>
        To add a new receipt, click <strong>Add Receipt</strong> and enter receipt details. Click a receipt <strong>Control No.</strong> to add supply items.</p>
      <ol class="breadcrumb">
        <li><a href="../../supplies.html"><i class="fa fa-th"></i> Dashboard</a></li>
        <li class="active">Receipts</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <!-- BUTTONS -->
      <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#create-jo">
        <span class="glyphicon glyphicon-plus"></span> Add Receipt
      </button> &nbsp; 
      <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#filter">
        <span class="glyphicon glyphicon-filter"></span> Filter
      </button> <br><br>

<div class="row">

<!-- NEW JOB ORDER POPUP -->
        <div class="col-md-12"> 
          <div id="create-jo" class="collapse department">
            <div class="panel panel-default">
              <div class="panel-body">
            <form class="form-horizontal" id="">
              <div class="box-body">

                <div class="form-group col-sm-12">
                  <label for="controlnumber" class="col-sm-2 control-label">Control Number</label>
                  <div class="col-sm-4"><input type="text" class="form-control" id="controlnumber" placeholder="SUP-03102018-1" disabled></div>
                  <label class="col-sm-2 control-label">Receipt Number*</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control" id="reoderlevel" required="" ng-model="rc.receiptDetails.receiptNumber">
                  </div>
                </div>

                <div class="form-group col-sm-12">
                  <label for="payeetype" class="col-sm-2 control-label">Payee Type</label>
                  <div class="radio col-sm-4">
                    <select class="form-control select2" style="width: 100%;" required="" ng-model="rc.receiptDetails.payeeType" ng-change="rc.selectPayeeType(rc.receiptDetails.payeeType);rc.selectPayee(rc.receiptDetails.payeeType, rc.receiptDetails.payee)" ng-init="rc.receiptDetails.payeeType=rc.payeeType">
                      <option selected="selected" value="0">- - select type - -</option>
                      <option value="EMPLOYEE">EMPLOYEE</option>
                      <option value="SUPPLIER">SUPPLIER</option>
                      <option value="BANK">BANK</option>
                    </select>
                  </div>
                  <label class="col-sm-2 control-label">Receipt Date</label>
                  <div class="col-sm-4">
                    <div class="input-group date">
                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                      <input type="text" class="form-control pull-right" datepicker required="" ng-model="rc.receiptDetails.receiptDate">
                    </div>
                  </div>
                  
                </div>

                <div class="form-group col-sm-12">
                  <label class="col-sm-2 control-label">Payee Name</label>
                  <div class="col-sm-4">
                    <select class="form-control select2" style="width: 100%;" required="" ng-model="rc.receiptDetails.payee" ng-change="rc.selectPayee(rc.receiptDetails.payeeType, rc.receiptDetails.payee)">
                      <option value="">- - select payee - -</option>
                      <option ng-if="rc.payeeType=='EMPLOYEE'" value="<%employee.employee_code%>" ng-repeat="employee in rc.employees"> <%employee.fname+' '+employee.mname+' '+employee.lname%> </option>

                      <option ng-if="rc.payeeType=='SUPPLIER'" value="<%supplier.supplier_code%>" ng-repeat="supplier in rc.suppliers"> <%supplier.supplier_name%> </option>

                      <option ng-if="rc.payeeType=='BANK'" value="<%bank.bank_code%>" ng-repeat="bank in rc.banks"> <%bank.bank_name%> </option>
                    </select> 
                  </div>
                  <label class="col-sm-2 control-label">Receipt Type</label>
                  <div class="col-sm-4">
                    <select class="form-control select2" style="width: 100%;" required="" ng-model="rc.receiptDetails.receiptType">
                      <option selected="selected" value="0">- - select type - -</option>
                      <option ng-value="receiptType.receipt_type_code" ng-repeat="receiptType in rc.receiptTypes"><%receiptType.receipt_type_name +" ("+ receiptType.receipt_type_code+")"%> </option>
                    </select>
                  </div>
                </div>

                <div class="form-group col-sm-12">
                  <label class="col-sm-2 control-label">Purchase Order*</label>
                  <div class="col-sm-4">
                    <select class="form-control select2" style="width: 100%;" required="" ng-model="rc.receiptDetails.purchaseOrderCode">
                      <option value="">- - select payee - -</option>
                      <option ng-value="po.po_code" ng-repeat="po in rc.pos"> <%po.po_code%> </option>
                    </select> 
                  </div>
                  <label for="rcpt-amount" class="col-sm-2 control-label">Remarks</label>
                  <div class="col-sm-4">
                    <div class="input-group date">
                      <textarea class="col-sm-12 form-control" id="rcpt-remarks" rows="2" ng-model="rc.receiptDetails.remarks"></textarea>
                    </div>
                  </div>
                </div>

  

              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="form-group col-sm-12">           
                  <div class="col-sm-8"></div>
                  <div class="col-sm-4">
                  <button class="btn btn-large btn-success pull-right" data-toggle="confirmation"
                  data-btn-ok-label="Yes" data-btn-ok-icon="fa fa-check" data-btn-ok-class="btn-success"
                  data-btn-cancel-label="No" data-btn-cancel-icon="fa fa-times" data-btn-cancel-class="btn-danger"
                  data-title="Confirm data entry." data-content="Are you sure?" style="width: 40%;margin-left: 5%;" ng-click="rc.newReceipt(rc.receiptDetails)">CONFIRMATION</button>
                  </div>
                </div>
              </div>
            </form>
              </div>
            </div>
          </div>
        </div>

<!-- FILTER POPUP -->
        <div class="col-md-12"> 
          <div id="filter" class="collapse department">
            <div class="panel panel-default">
              <div class="panel-body">
                <form class="form-horizontal" id="">
                  <div class="box-body">
                    <div class="form-group col-sm-12">

                      <div class="col-sm-2">
                        <div class="input-group">
                          <button type="button" class="btn btn-primary pull-right" id="rcpt-date-filter">
                            <span>
                              <i class="fa fa-calendar"></i> Select Receipt Date
                            </span>
                            <i class="fa fa-caret-down"></i>
                          </button>
                        </div>
                      </div>

                      <label class="col-sm-1 control-label">Payee Type:</label>
                      <div class="col-sm-2">
                        <select class="form-control" required="" style="width: 100%;">
                        <option selected="selected" value="1">Supplier</option>
                        <option value="2">Employee</option>
                        <option value="3">Bank</option>
                        </select>
                      </div>

                      <label class="col-sm-1 control-label">With Voucher:</label>
                      <div class="col-sm-2">
                      <label><input type="radio" name="r1" class="minimal" value="1" checked=""> &nbsp; Yes</label> &nbsp;&nbsp;&nbsp;
                      <label><input type="radio" name="r1" class="minimal" value="2"> &nbsp; No</label> &nbsp;&nbsp;&nbsp;
                      </div>

                    <div class="col-sm-1">
                    <button class="btn btn-large btn-success"><span class="glyphicon glyphicon-filter"></span>FILTER DISPLAY</button>
                    </div>

                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

<div class="box">
  <div class="box-body">
    <table datatable="ng" class="table table-bordered table-hover" width="100%">
      <thead>
      <tr>
        <th>Control No.</th>
        <th>Receipt Type</th>
        <th>Receipt No.</th>
        <th>Receipt Date</th>
        <th>Payee Type</th>
        <th>Payee Name</th>
        <th>PO</th>
        <th>Voucher</th>
        <th>Amount</th>
      </tr>
      </thead>
      <tbody>
      <tr ng-repeat="receipt in rc.receipts">
        <td><a href="#" ui-sref="list-receiptCopy2({receiptCode:receipt.receipt_code})"><b><%receipt.receipt_code%></b></a></td>
        <td><%receipt.receipt_type_name%></td>
        <td><%receipt.receipt_number%></td>
        <td><%receipt.receipt_date%></td>
        <td><%receipt.payee_type%></td>
        <td><%receipt.payee_text%></td>
        <td><%receipt.purchase_order_code%></td>
        <td><%receipt.voucher_code%></td>
        <td align="right"><%receipt.total_receipt_item_Cost | number:2%></td>
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

<script type="text/ng-template" id="receiptInfo.modal">
  <div>
    <div class="modal-dialog" style="width:100%;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" ui-sref="list-receipt2" ng-click="vm.ok()">
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
          <button type="button" class="btn btn-default pull-left" ui-sref="list-receipt2" ng-click="vm.ok()">Close</button>
          <!-- <button type="button" class="btn btn-info"><li class="fa fa-print"></li> Print</button> -->

          <a type="button" class="btn btn-info" ng-click="vm.printReceiptDetails(vm.formData.receipt_code)" target="_blank" ng-href="<%vm.url%>"><li class="fa fa-print"></li> Print</a>
          <!-- <button type="button" class="btn btn-primary" ng-click="vm.addItems()">Save changes</button> -->
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

   <script type="text/javascript">
  $(function () {

    $('.select2').select2();

  //   $('#datepicker').datepicker({
  //    autoclose: true
  //   })
  });
  </script>
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

 <script type="text/javascript">
  $(function () {

    $('.select2').select2();

  //   $('#datepicker').datepicker({
  //    autoclose: true
  //   })
  });
  </script>
</script>
