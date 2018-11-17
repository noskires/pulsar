<!-- Content Header (Page header) -->
<section class="content-header">
<h1><span class="fa fa-cog"> </span> Setup</h1>
<p>Browse and modify selection fields</p>
<ol class="breadcrumb">
<li><a href="../../index.html"><i class="fa fa-th"></i> Dashboard</a></li>
<li><i class="fa fa-cloud"></i> Advanced</li>
<li class="active">Supply Category</li>
</ol>
</section>

<!-- Main content -->

<section class="content">
  <div class="row">
    <div class="col-md-6"> 
      <h4><b>Supply Category</b> &nbsp; 
      <button type="button" class="btn btn-primary pull-right" ui-sref="supply-category-create({supplyCategoryRequest:'new'})"> 
        <li class="fa fa-plus"></li> ADD </button></h4> 
      <div class="box box-primary">
        <div class="box-body">
          <table id="supply-category" class="table table-bordered table-hover" width="100%">
            <thead>
            <tr>
              <th>Category Code</th>
              <th>Name</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="supplyCategory in scc.supplyCategories">
              <td>
                <a href="#" ui-sref="list-supply-categoriesCopy({supplyCategoryCode:supplyCategory.supply_category_code})"><b><%supplyCategory.supply_category_code%></b></a>
              </td>
              <td>
                <%supplyCategory.supply_category_name%>
              </td>
            </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>

<script type="text/ng-template" id="supplyCategoryNew.modal">
  <div>
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Create New Supply Category</h4>
        </div>
        <div class="modal-body">
          <!-- Custom Tabs (Pulled to the right) -->
          <form class="form-horizontal" ng-model="vm.supplyCategoryDetails">
            <div class="box-body">
              <div class="form-group col-sm-12">
                <label class="col-sm-3 control-label">Supply Category</label>
                <div class="col-sm-9">
                <input type="text" class="form-control" placeholder="" ng-model="vm.supplyCategoryDetails.category_name"></div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" ng-click="vm.ok()">Close</button>
          <button type="button" class="btn btn-primary pull-right" ng-click="vm.newSupplyCategory(vm.supplyCategoryDetails);vm.ok()">Create</button>
        </div>
      </div>
    </div>
  </div>
</script>

<script type="text/ng-template" id="supplyCategoryEdit.modal">
  <div>
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Edit Supply Category</h4>
        </div>
        <div class="modal-body">
          <!-- Custom Tabs (Pulled to the right) -->
          <form class="form-horizontal" id="">
            <div class="box-body">
              <div class="form-group col-sm-12">
                <label class="col-sm-3 control-label">Supply Category</label>
                <div class="col-sm-9">
                <input type="text" class="form-control" ng-model="vm.formData.supply_category_name"> </div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" ng-click="vm.ok()">Close</button>
          <button type="button" class="btn btn-primary pull-right" ng-click="vm.updateSupplyCategory(vm.formData);vm.ok()">Update Category</button> &nbsp;
          <!-- <button type="button" class="btn btn-danger pull-right">Delete</button> --> 
        </div>
      </div>
    </div>
  </div>
</script>