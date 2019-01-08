<!-- Content Header (Page header) -->
<section class="content-header">
<h1><span class="fa fa-cog"> </span> Setup</h1>
<p>Browse and modify selection fields</p>
<ol class="breadcrumb">
<li><a href="../../index.html"><i class="fa fa-th"></i> Dashboard</a></li>
<li><i class="fa fa-cloud"></i> Advanced</li>
<li class="active">Supply Unit</li>
</ol>
</section>

<!-- Main content -->

<section class="content">
  <div class="col-md-9"> 
    <h4><b>Supply Units</b> &nbsp; 
    <button type="button" class="btn btn-primary pull-right" ui-sref="supply-unit-create({supplyUnitRequest:'new'})"> <li class="fa fa-plus"></li> </button></h4> 
    <div class="box box-primary">
      <div class="box-body">
        <table id="suppliers" class="table table-bordered table-hover" width="100%" datatable="ng" >
          <thead>
          <tr>
            <th>Supply Unit Name</th>
            <th>Supply Unit</th>
          </tr>
          </thead>
          <tbody>
          <tr ng-repeat="supplyUnit in suc.supplyUnits">
          <td><a href="#" ui-sref="list-supplyUnitCopy({supplyUnitCode:supplyUnit.stock_unit_code})"><b> <%supplyUnit.stock_unit_code%> </b></a></td>
          <td><%supplyUnit.stock_unit_name%></td>
        </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

<script type="text/ng-template" id="supplyUnitNew.modal">
  <div>
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Create New Stock Unit</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" ng-model="vm.stockUnitDetails">
            <div class="box-body">
              <div class="form-group col-sm-12">
                <label class="col-sm-4 control-label">Stock Unit</label>
                <div class="col-sm-8"><input type="text" class="form-control" required="" ng-model="vm.stockUnitDetails.stock_unit_name"><br></div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" ng-click="vm.ok()">Close</button>
          <button type="button" class="btn btn-primary pull-right" ng-click="vm.newSupplyUnit(vm.stockUnitDetails)">Create Stock Unit</button> &nbsp;
          <!-- <button type="button" class="btn btn-danger pull-right">Delete</button> --> 
        </div>
      </div>
    </div>
  </div>
</script>

<script type="text/ng-template" id="supplyUnitEdit.modal">
  <div >
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" ng-click="vm.ok()">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Edit Stock Unit</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" id="">
            <div class="box-body">
              <div class="form-group col-sm-12">
                <label class="col-sm-4 control-label">Stock Unit Name</label>
                <div class="col-sm-8"><input type="text" class="form-control" required="" ng-model="vm.formData.stock_unit_name"><br></div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" ng-click="vm.ok()">Close</button>
          <button type="button" class="btn btn-success pull-right" ng-click="vm.updateSupplyUnit(vm.formData)">Update Stock Unit</button> &nbsp;
          <!-- <button type="button" class="btn btn-danger pull-right">Delete</button> --> 
        </div>
      </div>
    </div>
  </div>
</script>