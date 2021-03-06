<!-- Page Loader -->
<div id="loader" ng-if="vc.loader_status"></div>


<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><span class="fa fa-credit-card"> </span> List of Disbursement Vouchers</h1>
  <p>
    Create Vouchers. Note: The user cannot add anymore new supply in the particular Receipt if it already included in the Voucher item.
  </p>

  <ol class="breadcrumb">
    <li><a href=""><i class="fa fa-th"></i> Dashboard</a></li>
    <li class="active">Vouchers</li>
  </ol>
</section>

<!-- Main content -->
<section class="content" id="load_div">
  <div class="row">
        <div id="button-top" class="col-md-8"> 
<!-- BUTTONS -->
          <button class="btn btn-primary" data-toggle="collapse" data-target="#create-voucher" data-parent="#btn-top">
              <span class="glyphicon glyphicon-plus"></span> Create Voucher
          </button> &nbsp;&nbsp;
          <!-- <button class="btn btn-primary" data-toggle="collapse" data-target="#filter" data-parent="#btn-top">
              <span class="glyphicon glyphicon-refresh"></span> Filter Display
          </button>  -->

<!-- CREATE VOUCHER -->
          <div id="create-voucher" class="collapse" style="text-transform: uppercase;"><br>
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Create Disbursement Voucher</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form id="from-unit" class="form-horizontal" role="form">
              <div class="box-body">
                <div class="form-group col-sm-12">
                  <label for="dv-payee-name" class="col-sm-3 control-label">Payee Type</label>
                  <div class="col-sm-9">

                    <select class="form-control select2" style="width: 100%;" required="" ng-model="vc.voucherDetails.payeeType" ng-change="vc.selectPayeeType(vc.voucherDetails.payeeType)" ng-init="vc.voucherDetails.payeeType=vc.payeeType">
                      <option selected="selected" value="">Select Type</option>
                      <option value="EMPLOYEE">EMPLOYEE</option>
                      <option value="SUPPLIER">SUPPLIER</option>
                      <option value="BANK">BANK</option>
                    </select>

                  </div>
                </div>
                <div class="form-group col-sm-12">
                  <label for="dv-payee-name" class="col-sm-3 control-label">Payee Name</label>
                  <div class="col-sm-9">
                    <select class="form-control select2" style="width: 100%;" required="" ng-model="vc.voucherDetails.payee">
                      <option selected="selected" value="" disabled="">Select Payee</option>
                      <option ng-if="vc.payeeType=='EMPLOYEE'" value="<%employee.employee_code%>" ng-repeat="employee in vc.employees"> <%employee.fname+' '+employee.mname+' '+employee.lname%> </option>
                      <option ng-if="vc.payeeType=='SUPPLIER'" value="<%supplier.supplier_code%>" ng-repeat="supplier in vc.suppliers"> <%supplier.supplier_name%> </option>
                      <option ng-if="vc.payeeType=='BANK'" value="<%bank.bank_code%>" ng-repeat="bank in vc.banks"> <%bank.bank_name%> </option>
                    </select> 
                  </div>
                </div>
               
                <div class="form-group col-sm-12">
                  <label for="dv-desc" class="col-sm-3 control-label">Description</label>
                  <div class="col-sm-9">
                    <textarea class="col-sm-9 form-control" id="dv-desc" rows="2" ng-model="vc.voucherDetails.description"></textarea>
                  </div>
                </div>

                <div class="form-group col-sm-12">
                  <label for="dv-payee-name" class="col-sm-3 control-label">Fund</label>
                  <div class="col-sm-9">
                    <select class="form-control select2" style="width: 100%;" required="" ng-model="vc.voucherDetails.fund_code" ng-change="vc.selectFund(vc.voucherDetails.fund_code)">
                      <option value="" disabled="">Select Fund Source</option>
                      <option value="<%fund.fund_code%>" ng-repeat="fund in vc.funds"> <%fund.fund_name%> </option>
                    </select>
                  </div>
                </div>

                <div class="form-group col-sm-12">
                  <label for="dv-payee-name" class="col-sm-3 control-label">Cost Center</label>
                  <div class="col-sm-9">
                    <select class="form-control select2" style="width: 100%;" ng-model="vc.voucherDetails.cost_center_code" required="">
                      <option value="" disabled="">Select Cost Center</option>
                      <option value="<%organization.org_code%>" ng-repeat="organization in vc.organizations"><%organization.org_name%></option>
                      <option value="<%project.project_code%>" ng-repeat="project in vc.projects"> <%project.code%> - <%project.name%></option>
                    </select>
                  </div>
                </div>

                <div class="form-group col-sm-12">
                  <label for="dv-particulars" class="col-sm-3 control-label">Particulars</label>
                  <div class="col-sm-9">
                    <select class="form-control select2" style="width: 100%;" required="" ng-model="vc.voucherDetails.supply_category_code" ng-init="parentIndex = $index">
                      <option value="" disabled="">Select Particular</option>
                      <option ng-value="supplyCategory.supply_category_code" ng-repeat="supplyCategory in vc.supplyCategories"><%supplyCategory.supply_category_name%></option>
                    </select>
                  </div>
                </div>

                 <!-- <div class="form-group col-sm-12">
                  <label for="dv-particulars" class="col-sm-3 control-label">Payment Type</label>
                  <div class="col-sm-9">
                    <select class="form-control select2" style="width: 100%;" required="" ng-model="vc.voucherDetails.payment_type" ng-init="parentIndex = $index">
                      <option value="" disabled="">- - Select Payment Type - -</option>
                      <option value="CHECK">Check</option>
                      <option value="CASH">Cash</option>
                    </select>
                  </div>
                </div> -->

                <div class="form-group col-sm-12">           
                  <div class="col-sm-8"></div>
                  <div class="col-sm-4">
                  <button class="btn btn-large btn-success btn-block" data-toggle="confirmation"
                  data-btn-ok-label="Save" data-btn-ok-icon="fa fa-check" data-btn-ok-class="btn-success"
                  data-btn-cancel-label="Cancel" data-btn-cancel-icon="fa fa-times" data-btn-cancel-class="btn-danger"
                  data-title="Confirm data entry." data-content="Are you sure?" ng-click="vc.newVoucher(vc.voucherDetails)"> CONFIRMATION
                  </button></div></div>
              </div>
            </form>
          </div>
          <!-- /.box -->
          </div>

<!-- FILTER DISPLAY -->
          <div id="filter" class="collapse"><br>
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Filter Displayed Data</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <!-- form start -->
            <form id="from-unit" class="form-horizontal" role="form">
              <div class="form-group col-sm-12"">
                <div class="col-sm-3">
                <select class="form-control select2" style="width: 100%;" required="">
                <option selected="selected" value="0">Select Payee Type</option>
                <option value="1">SUPPLIER</option>
                <option value="2">BANK</option>
                <option value="3">EMPLOYEE</option>
                </select>
                </div>
                <div class="col-sm-4"> 
                <button type="button" class="btn btn-default" id="daterange-btn" style="width: 100%;">
                  <span><i class="fa fa-calendar"></i> Date range picker </span> <i class="fa fa-caret-down"></i>
                </button>
                </div>
                <div class="col-sm-4">
                  <button type="button" class="btn btn-default btn-flat">Filter Display</button></div>
              </div>
            </form>
          </div>
          </div>
          <!-- /.box -->
          </div>
        </div>

</div>
<br><br>

  <div class="box box-primary">
        <div class="box-body">
          <div export-to-xlsx data="vc.vouchers" bind-to-table="'tb-vouchers'" filename="' List of Disbursement Vouchers'"></div>
          <table id="vouchers" datatable="ng" class="table table-bordered table-hover" name="tb-vouchers" width="100%">
            <thead>
            <tr>
              <th>Control No.</th> 
              <th>Payee Type</th>
              <th>Payee Name</th>
              <th>Cost Center Name</th>
              <th>Particulars</th>
              
              <th>Description/Remarks</th>
              <th>Check No</th>
              <th>Check Date</th>
              <th>Bank</th>
              <th>Payment Type</th>
              <th>Amount</th>
              <!-- <th>Amount</th> -->
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="voucher in vc.vouchers">
              <td><a href="#"  ui-sref="list-voucherCopy({voucherCode:voucher.voucher_code})" title="Click for details"><b><%voucher.voucher_code%></b></a></td> 
              <td><%voucher.payee_type%></td>
              <td title="<%voucher.payee_text%>"> 
                <span ng-bind="voucher.payee_text | limitTo:12"></span> </span>
                <span ng-if="voucher.payee_text.length > 12">...</span>
              </td>
              <td title="<%voucher.cost_center_name%>"> 
                <span ng-bind="voucher.cost_center_name | limitTo:12"></span> </span>
                <span ng-if="voucher.cost_center_name.length > 12">...</span>
              </td>
              <td title="<%voucher.supply_category_name%>"> 
                <span ng-bind="voucher.supply_category_name | limitTo:12"></span> </span>
                <span ng-if="voucher.supply_category_name.length > 12">...</span>
              </td>
              
              <td title="<%voucher.description%>"> 
                <span ng-bind="voucher.description | limitTo:12"></span> </span>
                <span ng-if="voucher.description.length > 12">...</span>
              </td>
              <td><%voucher.check_number%></td>
              
              <td><%voucher.check_date%></td>
              <td><%voucher.bank_name%></td>
              <td><%voucher.payment_type%></td>
              <td align="right"><%voucher.total_receipt_item_Cost | number:2%></td>
              <!-- <td align="right"><%voucher.amount | number:2%></td> -->
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

<script type="text/ng-template" id="voucherInfo.modal">
  <div>
    <div class="modal-dialog" style="overflow:auto; width:1100px;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" ui-sref="list-voucher" ng-click="vm.ok()">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><li class="fa fa-credit-card"></li> DV No: <b><%vm.formData.voucher_code%></b>&nbsp;&nbsp;&nbsp;
            (<%vm.formData.payee_type%> : <%vm.formData.payee_text%>)</h4>
        </div>
        <div class="modal-body">
          <p>Please select particular unpaid receipt/s for the voucher.</p>
            <form class="form-horizontal" id="" ng-model="vm.voucherItemDetails">
              <table datatable="ng"  class="table table-bordered table-hover" width="100%">
                <thead class="rcpt_dv">
                <tr> 
                  <th>Select</th>
                  <th>Control No.</th>
                  <th>Receipt Type</th>
                  <th>Receipt No.</th>
                  <th>Receipt Date</th>
                  <th>Amount</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="receipt in vm.receipts"> 
                  <td> <input type="checkbox" ng-model="active" ng-change="vm.newItem(receipt, active)"/> </td>
                  <td><b><%receipt.receipt_code%></b></td>
                  <td><%receipt.receipt_type_name%></td>
                  <td><%receipt.receipt_number%></td>
                  <td><%receipt.receipt_date%></td>
                  <td align="right"><%receipt.total_receipt_item_Cost | number:2%></td>
                </tr> 
                </tbody>
              </table>
              <button type="button" id="add-row" class="btn btn-sm btn-flat btn-success" ng-click="vm.newVoucherItem(vm.voucherItemDetails)">Add selected receipt</button><br>
            </form>
              <hr>
              <p>Selected unpaid receipt/s for the voucher.</p>
              <table id="tbl_rcpt_dv_view" class="table table-bordered table-hover" width="100%">
                <thead class="thead_rcpt_dv_view">
                <tr>
                  <th>Control No.</th>
                  <th>Receipt Type</th>
                  <th>Receipt No.</th>
                  <th>Receipt Date</th>
                  <th>Amount</th>
                  <th>Options</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="voucherItem in vm.voucherItems">
                  <td><b><%voucherItem.receipt_code%></b></td>
                  <td><%voucherItem.receipt_type_name%></td>
                  <td><%voucherItem.receipt_number%></td>
                  <td><%voucherItem.receipt_date%></td>
                  <td align="right" ng-init="vm.voucherItemGrandTotal = vm.voucherItemGrandTotal + voucherItem.total_receipt_item_Cost"><%voucherItem.total_receipt_item_Cost | number:2%></td>
                  <td>
                    <!-- <a href="#" data-toggle="modal" data-target="#modal-edit"><code class="text-green">EDIT</code></a> -->
                    <a href="#" data-toggle="modal" ng-click="vm.removeVoucherItem(voucherItem.voucher_item_code)"><code class="text-red">REMOVE</code></a>
                  </td>
                </tr>
                <tr>
                  <td colspan="4" align="right"><b>TOTAL VOUCHER AMOUNT</b></td>
                  <td align="right"><b><%vm.voucherItemGrandTotal | number:2%></b></td>
                  <td></td>
                </tr>  
                </tbody>
              </table>
        
        <p>Please provide check details to complete the voucher.</p>
        
        <form class="form-horizontal" id="" ng-model="vm.formData">
        <div class="row">

            <label class="col-sm-3 control-label">Select Payment Type:</label>
            <div class="col-sm-9">
              <input type="radio" ng-model="vm.formData.payment_type" id="check" ng-value="'CHECK'" style="cursor:pointer;"> 
                <label for="check" style="cursor:pointer;"> Check </label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input type="radio" ng-model="vm.formData.payment_type" id="cash" ng-value="'CASH'" style="cursor:pointer;"> 
                <label for="cash" style="cursor:pointer;"> Cash </label>  
            </div>
        </div>

        <div class="form-group" ng-if="vm.formData.payment_type=='CHECK'">
          <div class="col-sm-4">
            <div class="input-group checknum">
              <span class="input-group-addon" style="font-size: 15px;">Check #</span>
              <input type="number" class="form-control" id="rcpt-number" placeholder="" required="" ng-model="vm.formData.check_number">
            </div>
          </div>
          <div class="col-sm-4">
            <div class="input-group checkdate">
            <span class="input-group-addon" style="font-size: 15px;">Check Date</span>
            <input type="text" class="form-control pull-right" id="datepicker_check" ng-model="vm.formData.check_date" datepicker2>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="input-group checkbank">
            <span class="input-group-addon" style="font-size: 15px;">Bank</span>
            <select class="form-control select2" style="width: 100%;" required="" ng-model="vm.formData.bank_code">
              <option selected="selected" value="">Select Bank</option>
                <option value="<%bank.bank_code%>" ng-repeat="bank in vm.banks"> <%bank.bank_name%> </option>
            </select>
          </div>
        </div>
        </div> 
      </form>
        <br>
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <a type="button" class="btn btn-info" ng-click="vm.printVoucherDetails(vm.formData.voucher_code)" target="_blank" ng-href="<%vm.url%>"><li class="fa fa-print"></li> Print</a>
          <button type="button" class="btn btn-primary" ng-click="vm.updateVoucher(vm.formData)">Save changes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->  
</script>