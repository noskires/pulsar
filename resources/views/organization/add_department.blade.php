<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><span class="fa fa-cube"> </span> Add a Department</h1>
  <ol class="breadcrumb">
    <li><a href="../../index.html"><i class="fa fa-th"></i> Dashboard</a></li>
    <li><a href="../../pages/maintenance/list-equipments.html">Organization</a></li>
    <li class="active">Department</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Please provide details of Department</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" ng-model="oc.departmentDetails">
          <div class="box-body">
            <div class="form-group">
              <label for="projectname" class="col-sm-3 control-label">Department Name</label>
              <div class="col-sm-9"><input type="text" class="form-control" id="projectname" ng-model="oc.departmentDetails.name" placeholder="" required=""></div>
            </div>
            <div class="form-group">
            <label class="col-sm-3 control-label">Region</label>
              <div class="col-sm-9">
              <select class="form-control select2" style="width: 100%;" required="" ng-model="oc.departmentDetails.region" ng-change="oc.selectRegion(oc.departmentDetails.region)">
                <option selected="selected" value="0">- - - Select Region - - -</option>
                <option value="<%region.region_code%>" ng-repeat="region in oc.regions"><% region.region_text_short%></option>
              </select>
              </div>
            </div>
            <div class="form-group">
            <label class="col-sm-3 control-label">Province</label>
              <div class="col-sm-9">
              <select class="form-control select2" style="width: 100%;" required="" ng-model="oc.departmentDetails.province" ng-change="oc.selectProvince(oc.departmentDetails.province)">
                <option selected="selected" value="0">- - - Select Province - - -</option>
                <option value="<%province.province_code%>" ng-repeat="province in oc.provinces"><% province.province_text%></option>
              </select>
              </div>
            </div>
            <div class="form-group">
            <label class="col-sm-3 control-label">Municipality</label>
              <div class="col-sm-9">
              <select class="form-control select2" style="width: 100%;" required="" ng-model="oc.departmentDetails.municipality">
                <option selected="selected" value="0">- - - Select Municipalities - - -</option>
                <option ng-value="<%municipality.municipality_code%>" ng-repeat="municipality in oc.municipalities"><% municipality.municipality_text%></option>
              </select>
              </div>
            </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <div class="pull-right"></div>
            <button class="btn btn-large btn-primary pull-right" data-toggle="confirmation"
            data-btn-ok-label="Save" data-btn-ok-icon="fa fa-check" data-btn-ok-class="btn-success"
            data-btn-cancel-label="Cancel" data-btn-cancel-icon="fa fa-times" data-btn-cancel-class="btn-danger"
            data-title="Comfirmation" data-content="Are you sure?" ng-click="oc.newDepartment(oc.departmentDetails)"> Confirmation
            </button>
          </div>
          </div>
        </form>
      </div>
      <!-- /.box -->
    </div>
    <!--/.col (left) -->
  </div>
  <!-- /.row -->
</section>
