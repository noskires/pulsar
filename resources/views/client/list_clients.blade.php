<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><span class="fa fa-shield"> </span> Clients</h1>
   <!--  <p>The list below displays insurance policies associated with your asset.<br>
    To create a new contract, click <strong>New Insurance</strong> and enter the necessary information.</p> -->
  <ol class="breadcrumb">
    <li><a href="../../index.html"><i class="fa fa-th"></i> Dashboard</a></li>
    <li><i class="fa fa-cloud"></i> Advanced</li>
    <li class="active"><i class="fa fa-bank"></i> Clients</li>
  </ol>
</section>

<!-- Main content -->

<section class="content">
  <div class="col-md-9"> 
    <h4><b>Clients</b> &nbsp; 
    <button type="button" class="btn btn-primary pull-right" ui-sref="client-create({clientRequest:'new'})"> <li class="fa fa-plus"></li> </button></h4> 
    <div class="box box-primary">
      <div class="box-body">
        <table id="suppliers" class="table table-bordered table-hover"   datatable="ng">
          <thead>
          <tr>
            <th>Client Code</th>
            <th>Client Name</th>
            <th>Client Address</th>
          </tr>
          </thead>
          <tbody>
          <tr ng-repeat="client in cc.clients">
          <td><a href="#" ui-sref="list-clientCopy({clientCode:client.client_code})"><b> <%client.client_code%> </b></a></td>
          <td><%client.client_name%></td>
          <td><%client.client_address%></td>
        </tr>
          </tbody>
        </table>
      </div>
    </div>
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

<script type="text/ng-template" id="clientNew.modal">
  <div>
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" ui-sref="list-particular" ng-click="vm.ok()">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Create New Client</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" ng-model="vm.clientDetails">
            <div class="box-body">
              <div class="form-group col-sm-12">
                <label class="col-sm-4 control-label">Client</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" required="" ng-model="vm.clientDetails.client_name"><br>
                </div>
              </div>
              <div class="form-group col-sm-12">
                <label class="col-sm-4 control-label">Address</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" required="" ng-model="vm.clientDetails.client_address"><br>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" ui-sref="list-client" ng-click="vm.ok()">Close</button>
          <button type="button" class="btn btn-primary pull-right" ng-click="vm.newClient(vm.clientDetails);">Create Client</button> &nbsp;
          <!-- <button type="button" class="btn btn-danger pull-right">Delete</button> --> 
        </div>
      </div>
    </div>
  </div>
</script>

<script type="text/ng-template" id="ClientEdit.modal">
  <div >
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" ui-sref="list-client" ng-click="vm.ok()">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Edit Client Information</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" id="">
            <div class="box-body">
              <div class="form-group col-sm-12">
                <label class="col-sm-4 control-label">Client</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" required="" ng-model="vm.formData.client_name"><br>
                </div>
              </div>
              <div class="form-group col-sm-12">
                <label class="col-sm-4 control-label">Address</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" required="" ng-model="vm.formData.client_address"><br>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" ui-sref="list-client" ng-click="vm.ok()">Close</button>
          <button type="button" class="btn btn-success pull-right" ng-click="vm.updateClient(vm.formData)">Update Particular</button> &nbsp;
          <!-- <button type="button" class="btn btn-danger pull-right">Delete</button> --> 
        </div>
      </div>
    </div>
  </div>
</script>