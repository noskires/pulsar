<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><span class="fa fa-shield"> </span> Sub Con</h1>
   <!--  <p>The list below displays insurance policies associated with your asset.<br>
    To create a new contract, click <strong>New Insurance</strong> and enter the necessary information.</p> -->
  <ol class="breadcrumb">
    <li><a href="../../index.html"><i class="fa fa-th"></i> Dashboard</a></li>
    <li><i class="fa fa-cloud"></i> Advanced</li>
    <li class="active"><i class="fa fa-bank"></i> Sub Con</li>
  </ol>
</section>

<!-- Main content -->

<section class="content">
  <div class="col-md-9"> 
    <h4><b>Sub Con</b> &nbsp; 
    <button type="button" class="btn btn-primary pull-right" ui-sref="subcon-create({subconRequest:'new'})"> <li class="fa fa-plus"></li> </button></h4> 
    <div class="box box-primary">
      <div class="box-body">
        <table id="" class="table table-bordered table-hover"   datatable="ng">
          <thead>
          <tr>
            <th>Sub Con Code</th>
            <th>Sub Con Name</th>
            <th></th>
          </tr>
          </thead>
          <tbody>
          <tr ng-repeat="subcon in scc.subcons">
          <td><a href="#" ui-sref="list-subconCopy({subconCode:subcon.subcon_code})"><b> <%subcon.subcon_code%> </b></a></td>
          <td><%subcon.subcon_name%></td>
          <td> <a href="#" ui-sref="edit-subcon({subconCode2:subcon.subcon_code})"><b> Edit </b></a></td>
        </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

<script type="text/ng-template" id="subconNew.modal">
  <div>
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" ui-sref="list-fund" ng-click="vm.ok()">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Create New Sub Con</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" ng-model="vm.fundDetails">
            <div class="box-body">
              <div class="form-group col-sm-12">
                <label class="col-sm-4 control-label">Sub Con Name</label>
                <div class="col-sm-8"><input type="text" class="form-control" required="" ng-model="vm.subconDetails.subcon_name"><br></div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" ui-sref="list-particular" ng-click="vm.ok()">Close</button>
          <button type="button" class="btn btn-primary pull-right" ng-click="vm.newSubcon(vm.subconDetails);">Create Fund</button> &nbsp;
          <!-- <button type="button" class="btn btn-danger pull-right">Delete</button> --> 
        </div>
      </div>
    </div>
  </div>
</script>

<script type="text/ng-template" id="subconEdit.modal">
  <div >
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" ui-sref="list-fund" ng-click="vm.ok()">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Edit Sub Con Information</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" id="">
            <div class="box-body">
              <div class="form-group col-sm-12">
                <label class="col-sm-4 control-label">Sub Con Name</label>
                <div class="col-sm-8"><input type="text" class="form-control" required="" ng-model="vm.formData.subcon_name"><br></div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" ui-sref="list-fund" ng-click="vm.ok()">Close</button>
          <button type="button" class="btn btn-success pull-right" ng-click="vm.updateSubcon(vm.formData)">Update Fund</button> &nbsp;
          <!-- <button type="button" class="btn btn-danger pull-right">Delete</button> --> 
        </div>
      </div>
    </div>
  </div>
</script>

