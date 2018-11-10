<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><span class="fa fa-file-o"> </span> Receipts</h1>
  <ol class="breadcrumb">
    <li><a href="../../index.html"><i class="fa fa-th"></i> Dashboard</a></li>
    <li class="active">Receipts</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-9">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Create a new receipt</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" id="" ng-model="rc.receiptDetails">
          <div class="box-body">
            <div class="form-group col-sm-12">
              <label for="controlnumber" class="col-sm-2 control-label">Purchase Order* </label>
              <div class="col-sm-4"><input type="text" class="form-control" id="rcpt-ponumber" placeholder="PO-03102018-1--- autocomplete" ng-model="rc.receiptDetails.purchaseOrderCode"></div>
            </div>
            <div class="form-group col-sm-12">
              <label class="col-sm-2 control-label">Receipt Type*</label>
              <div class="col-sm-4">
              <select class="form-control select2" required="" ng-model="rc.receiptDetails.receiptType">
              <option selected="selected" value="0">- - select type - -</option>
              <option ng-value="receiptType.receipt_type_code" ng-repeat="receiptType in rc.receiptTypes"><%receiptType.receipt_type_name +" ("+ receiptType.receipt_type_code+")"%> </option>
              </select>
              </div>
            </div>
            <div class="form-group col-sm-12">
              <label for="platenumber" class="col-sm-2 control-label">Receipt No.*</label>
              <div class="col-sm-4"><input type="text" class="form-control" id="reoderlevel" required="" ng-model="rc.receiptDetails.receiptNumber"></div>
              <label class="col-sm-2 control-label">Receipt Date</label>
              <div class="col-sm-4">
              <div class="input-group date">
              <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
              <input type="text" class="form-control pull-right" datepicker required="" ng-model="rc.receiptDetails.receiptDate">
            </div>
            </div></div>
            <div class="form-group col-sm-12">
              <label for="rcpt-amount" class="col-sm-2 control-label">Amount*</label>
              <div class="col-sm-4">
              <div class="input-group date">
              <span class="input-group-addon" style="font-size: 20px;">₱</span>
              <input type="text" class="form-control" id="rcpt-amount" placeholder="" required="" ng-model="rc.receiptDetails.amount">
            </div></div>
            </div>
            <div class="form-group col-sm-12">
              <label for="payeetype" class="col-sm-2 control-label">Payee Type</label>
              <div class="radio col-sm-8">
               <!--  <label><input type="radio" ng-model="rc.voucherDetails.payeeType" name="optionsRadios" id="optionsRadios1" value="SUPPLIER" ng-click="rc.selectPayeeType(rc.voucherDetails.payeeType)" ng-init="rc.voucherDetails.payeeType=='SUPPLIER'">SUPPLIER</label>
                &nbsp;
                <label><input type="radio" ng-model="rc.voucherDetails.payeeType" name="optionsRadios" id="optionsRadios2" value="BANK" ng-click="rc.selectPayeeType(rc.voucherDetails.payeeType)">BANK</label>
                &nbsp;
                <label><input type="radio" ng-model="rc.voucherDetails.payeeType" name="optionsRadios" id="optionsRadios3" value="EMPLOYEE" ng-click="rc.selectPayeeType(rc.voucherDetails.payeeType)">EMPLOYEE</label> -->

                <select class="form-control select2" style="width: 100%;" required="" ng-model="rc.receiptDetails.payeeType" ng-change="rc.selectPayeeType(rc.receiptDetails.payeeType)" ng-init="rc.receiptDetails.payeeType=rc.payeeType">
                  <option selected="selected" value="0">- - select type - -</option>
                  <option value="EMPLOYEE">EMPLOYEE</option>
                  <option value="SUPPLIER">SUPPLIER</option>
                  <option value="BANK">BANK</option>
                </select>

              </div>
            </div>
            <div class="form-group col-sm-12">
              <label for="controlnumber" class="col-sm-2 control-label">Payee Name</label>
                <div class="col-sm-4">
                  <select class="form-control select2" style="width: 100%;" required="" ng-model="rc.receiptDetails.payee">
                    <option selected="selected" value="0">- - select payee - -</option>
                    <option ng-if="rc.payeeType=='EMPLOYEE'" value="<%employee.employee_code%>" ng-repeat="employee in rc.employees"> <%employee.fname+' '+employee.mname+' '+employee.lname%> </option>

                    <option ng-if="rc.payeeType=='SUPPLIER'" value="<%supplier.supplier_code%>" ng-repeat="supplier in rc.suppliers"> <%supplier.supplier_name%> </option>

                    <option ng-if="rc.payeeType=='BANK'" value="<%bank.bank_code%>" ng-repeat="bank in rc.banks"> <%bank.bank_name%> </option>
                  </select> 
              </div>
            </div>
            <div class="form-group col-sm-12">
              <label for="rcpt-remarks" class="col-sm-2 control-label">Remarks</label>
              <div class="col-sm-10"><textarea class="col-sm-12 form-control" id="rcpt-remarks" rows="2" ng-model="rc.receiptDetails.remarks"></textarea></div>
            </div>
        </div>
        <!-- /.box-body -->
          <div class="box-footer">
            <div class="form-group col-sm-12">           
              <div class="col-sm-8"></div>
              <div class="col-sm-4">
              <button class="btn btn-large btn-primary btn-block" data-toggle="confirmation"
              data-btn-ok-label="Save" data-btn-ok-icon="fa fa-check" data-btn-ok-class="btn-success"
              data-btn-cancel-label="Cancel" data-btn-cancel-icon="fa fa-times" data-btn-cancel-class="btn-danger"
              data-title="Confirm data entry." data-content="Are you sure?" ng-click="rc.newReceipt(rc.receiptDetails)"> CONFIRMATION
              </button></div></div>
          </div>
        </form>
      </div>
      <!-- /.box -->
    </div>
    <!--/.col (left) -->
  </div>
  <!-- /.row -->
</section>