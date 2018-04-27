
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><span class="fa fa-credit-card"> </span> Create Disbursement Voucher</h1>
  <ol class="breadcrumb">
    <li><a href="../../index.html"><i class="fa fa-th"></i> Dashboard</a></li>
    <li class="active">Vouchers</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-8">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"></h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" id="" ng-model="vc.voucherDetails">
          <div class="box-body">
            <div class="form-group col-sm-12">
              <label for="dv-payee-type" class="col-sm-3 control-label">Payee Type</label>
              <div class="col-sm-9">

                <select class="form-control select2" style="width: 100%;" required="" ng-model="vc.voucherDetails.payeeType" ng-change="vc.selectPayeeType(vc.voucherDetails.payeeType)" ng-init="vc.voucherDetails.payeeType=vc.payeeType">
                  <option selected="selected" value="0">- - select type - -</option>
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
                  <option selected="selected" value="0">- - select payee - -</option>
                  <option ng-if="vc.payeeType=='EMPLOYEE'" value="<%employee.employee_id%>" ng-repeat="employee in vc.employees"> <%employee.fname+' '+employee.mname+' '+employee.lname%> </option>

                  <option ng-if="vc.payeeType=='SUPPLIER'" value="<%supplier.supplier_code%>" ng-repeat="supplier in vc.suppliers"> <%supplier.supplier_name%> </option>

                  <option ng-if="vc.payeeType=='BANK'" value="<%bank.bank_code%>" ng-repeat="bank in vc.banks"> <%bank.bank_name%> </option>
                </select> 
              </div>
            </div>
            <div class="form-group col-sm-12">
              <label for="dv-particulars" class="col-sm-3 control-label">Particulars</label>
              <div class="col-sm-9">
                <select class="form-control select2" style="width: 100%;" required="" ng-model="vc.voucherDetails.particulars">
                  <option selected="selected" value="0">- - select payee - -</option>
                  <option value="<%particular.particular_code%>" ng-repeat="particular in vc.particulars"> <%particular.description%> </option>
                </select>
              </div>
            </div>
            <div class="form-group col-sm-12">
              <label for="dv-desc" class="col-sm-3 control-label">Description/Remarks</label>
              <div class="col-sm-9"><textarea class="col-sm-9 form-control" id="dv-desc" rows="2" ng-model="vc.voucherDetails.description"></textarea></div>
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
              data-title="Confirm data entry." data-content="Are you sure?" ng-click="vc.newVoucher(vc.voucherDetails)"> CONFIRMATION
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