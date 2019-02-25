<!-- Content Header (Page header) -->
<section class="content-header">
<h1><span class="fa fa-cog"> </span> Setup</h1>
<p>Browse and modify selection fields</p>
<ol class="breadcrumb">
<li><a href="../../index.html"><i class="fa fa-th"></i> Dashboard</a></li>
<li><i class="fa fa-cloud"></i> Advanced</li>
<li class="active">Particular</li>
</ol>
</section>

<!-- Main content -->

<section class="content">
  <div class="col-md-9"> 
    <h4><b>Particulars</b> &nbsp; 
    <button type="button" class="btn btn-primary pull-right" ui-sref="particular-create({particularRequest:'new'})"> <li class="fa fa-plus"></li> </button></h4> 
    <div class="box box-primary">
      <div class="box-body">
        <table id="suppliers" class="table table-bordered table-hover"   datatable="ng">
          <thead>
          <tr>
            <th>Particular Code</th>
            <th>Description</th>
          </tr>
          </thead>
          <tbody>
          <tr ng-repeat="particular in pc.particulars">
          <td><a href="#" ui-sref="list-particularCopy({particularCode:particular.particular_code})"><b> <%particular.particular_code%> </b></a></td>
          <td><%particular.description%></td>
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

<script type="text/ng-template" id="particularNew.modal">
  <div>
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" ui-sref="list-particular" ng-click="vm.ok()">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Create New Particular</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" ng-model="vm.supplierDetails">
            <div class="box-body">
              <div class="form-group col-sm-12">
                <label class="col-sm-4 control-label">Particular</label>
                <div class="col-sm-8"><input type="text" class="form-control" required="" ng-model="vm.particularDetails.description"><br></div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" ui-sref="list-particular" ng-click="vm.ok()">Close</button>
          <button type="button" class="btn btn-primary pull-right" ng-click="vm.newParticular(vm.particularDetails);">Create Particular</button> &nbsp;
          <!-- <button type="button" class="btn btn-danger pull-right">Delete</button> --> 
        </div>
      </div>
    </div>
  </div>
</script>

<script type="text/ng-template" id="ParticularEdit.modal">
  <div >
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" ui-sref="list-particular" ng-click="vm.ok()">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Edit Particular Information</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" id="">
            <div class="box-body">
              <div class="form-group col-sm-12">
                <label class="col-sm-4 control-label">Particular</label>
                <div class="col-sm-8"><input type="text" class="form-control" required="" ng-model="vm.formData.description"><br></div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" ui-sref="list-particular" ng-click="vm.ok()">Close</button>
          <button type="button" class="btn btn-success pull-right" ng-click="vm.updateParticular(vm.formData)">Update Particular</button> &nbsp;
          <!-- <button type="button" class="btn btn-danger pull-right">Delete</button> --> 
        </div>
      </div>
    </div>
  </div>
</script>