<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><span class="fa fa-credit-card"> </span> List of Disbursement Vouchers</h1>
  <ol class="breadcrumb">
    <li><a href="../../index.html"><i class="fa fa-th"></i> Dashboard</a></li>
    <li class="active">Vouchers</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
  <div class="col-sm-12">
  <div class="box">
    <!-- form start -->
      <form role="form">
        <div class="box-body">
          <div class="form-group">
            <div class="col-sm-3">
            <select class="form-control select2" style="width: 100%;" required="">
            <option selected="selected" value="0">Select Payee Type</option>
            <option value="1">EMPLOYEE</option>
            <option value="2">SUPPLIER</option>
            <option value="3">BANK</option>
            </select>
            </div>
            <div class="col-sm-3"> 
            <button type="button" class="btn btn-default" id="daterange-btn">
              <span><i class="fa fa-calendar"></i> Date range picker </span> <i class="fa fa-caret-down"></i>
            </button>
            </div>
            <div class="col-sm-3"> 
            <button type="button" class="btn btn-primary"><li class="fa fa-refresh"></li> Filter Display</button>
            </div>  
          </div>
        </div>
        <!-- /.box-body -->
      </form>
  </div>
</div>
</div>



<div id="create-voucher" class="collapse"><br>


  <div class="box box-primary">
        <div class="box-body">
          <table id="vouchers" datatable="ng" class="table table-bordered table-hover" width="100%">
            <thead>
            <tr>
              <th>Control No.</th>
              <th>DV No.</th>
              <th>Payee Type</th>
              <th>Payee Name</th>
              <th>Particulars</th>
              <th>Description/Remarks</th>
              <th>Amount</th>
              <th>Check No</th>
              <th>Check Date</th>
              <th>Bank</th>

            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="voucher in vc.vouchers">
              <td><a href="#"  ui-sref="list-voucherCopy({voucherCode:voucher.voucher_code})" title="Click for details"><b><%voucher.voucher_code%></b></a></td>
              <td></td>
              <td><%voucher.payee_type%></td>
              <td><%voucher.payee_text%></td>
              <td><%voucher.description%></td>
              <td><%voucher.description%></td>
              <td align="right"><%voucher.amount | number:2%></td>
              <td><%voucher.check_number%></td>
              <td><%voucher.check_date%></td>
              <td><%voucher.bank_name%></td>
            </tr>

            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
  </div>
</section>

<script type="text/ng-template" id="voucherInfo.modal">
  <div>
    <div class="modal-dialog" style="width:100%">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" ng-click="vm.ok()">
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
                  <td align="right"><%receipt.amount | number:2%></td>
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
                  <td align="right" ng-init="vm.voucherItemGrandTotal = vm.voucherItemGrandTotal + voucherItem.amount"><%voucherItem.amount | number:2%></td>
                  <td>
                    <a href="#" data-toggle="modal" data-target="#modal-edit"><code class="text-green">EDIT</code></a>
                    <a href="#" data-toggle="modal" data-target="#modal-delete"><code class="text-red">REMOVE</code></a>
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
        <div class="form-group">
          <div class="col-sm-4">
          <div class="input-group checknum">
          <span class="input-group-addon" style="font-size: 15px;">Check #</span>
          <input type="number" class="form-control" id="rcpt-number" placeholder="" required="" ng-model="vm.formData.check_number">
        </div></div>
        <div class="col-sm-4">
          <div class="input-group checkdate">
          <span class="input-group-addon" style="font-size: 15px;">Check Date</span>
          <input type="text" class="form-control pull-right" id="datepicker_check" ng-model="vm.formData.check_date">
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
          <button type="button" class="btn btn-info"><li class="fa fa-print"></li> Print</button>
          <button type="button" class="btn btn-primary" ng-click="vm.updateVoucher(vm.formData)">Save changes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->  
</script>