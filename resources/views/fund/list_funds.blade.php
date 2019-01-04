<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><span class="fa fa-shield"> </span> Funds</h1>
   <!--  <p>The list below displays insurance policies associated with your asset.<br>
    To create a new contract, click <strong>New Insurance</strong> and enter the necessary information.</p> -->
  <ol class="breadcrumb">
    <li><a href="../../index.html"><i class="fa fa-th"></i> Dashboard</a></li>
    <li><i class="fa fa-cloud"></i> Advanced</li>
    <li class="active"><i class="fa fa-bank"></i> Funds</li>
  </ol>
</section>

<!-- Main content -->

<section class="content">
  <div class="col-md-9"> 
    <h4><b>Funds</b> &nbsp; 
    <button type="button" class="btn btn-primary pull-right" ui-sref="fund-create({fundRequest:'new'})"> <li class="fa fa-plus"></li> </button></h4> 
    <div class="box box-primary">
      <div class="box-body">
        <table id="suppliers" class="table table-bordered table-hover"   datatable="ng">
          <thead>
          <tr>
            <th>Fund Code</th>
            <th>Fund Name</th>
          </tr>
          </thead>
          <tbody>
          <tr ng-repeat="fund in fc.funds">
          <td><a href="#" ui-sref="list-fundCopy({fundCode:fund.fund_code})"><b> <%fund.fund_code%> </b></a></td>
          <td><%fund.fund_name%></td>
        </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

<script type="text/ng-template" id="fundNew.modal">
  <div>
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" ui-sref="list-fund" ng-click="vm.ok()">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Create New Fund</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" ng-model="vm.fundDetails">
            <div class="box-body">
              <div class="form-group col-sm-12">
                <label class="col-sm-4 control-label">Fund</label>
                <div class="col-sm-8"><input type="text" class="form-control" required="" ng-model="vm.fundDetails.fund_name"><br></div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" ui-sref="list-particular" ng-click="vm.ok()">Close</button>
          <button type="button" class="btn btn-primary pull-right" ng-click="vm.newFund(vm.fundDetails);">Create Fund</button> &nbsp;
          <!-- <button type="button" class="btn btn-danger pull-right">Delete</button> --> 
        </div>
      </div>
    </div>
  </div>
</script>

<script type="text/ng-template" id="fundEdit.modal">
  <div >
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" ui-sref="list-fund" ng-click="vm.ok()">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Edit Fund Information</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" id="">
            <div class="box-body">
              <div class="form-group col-sm-12">
                <label class="col-sm-4 control-label">Fund</label>
                <div class="col-sm-8"><input type="text" class="form-control" required="" ng-model="vm.formData.fund_name"><br></div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" ui-sref="list-fund" ng-click="vm.ok()">Close</button>
          <button type="button" class="btn btn-success pull-right" ng-click="vm.updateFund(vm.formData)">Update Fund</button> &nbsp;
          <!-- <button type="button" class="btn btn-danger pull-right">Delete</button> --> 
        </div>
      </div>
    </div>
  </div>
</script>