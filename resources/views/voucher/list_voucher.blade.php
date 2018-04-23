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
  <div class="box box-primary">
        <div class="box-body">
          <table id="vouchers" class="table table-bordered table-hover" width="100%">
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
              <td><a href="#" data-toggle="modal" data-target="#modal-default" title="Click for details"><b><%voucher.voucher_code%></b></a></td>
              <td></td>
              <td><%voucher.payee_type%></td>
              <td><%voucher.payee_text%></td>
              <td><%voucher.particulars%></td>
              <td><%voucher.description%></td>
              <td><%voucher.amount | number:2%></td>
              <td><%voucher.check_number%></td>
              <td><%voucher.check_date%></td>
              <td><%voucher.bank%></td>
            </tr>

            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
  </div>
</section>