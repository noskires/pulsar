<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><span class="fa fa-cube"> </span> Add a Division</h1>
  <ol class="breadcrumb">
    <li><a href="../../index.html"><i class="fa fa-th"></i> Dashboard</a></li>
    <li><a href="../../pages/maintenance/list-equipments.html">Organization</a></li>
    <li class="active">Division</li>
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
          <h3 class="box-title">Please provide details of Division</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" ng-model="dc.divisionDetails">
          <div class="box-body">

            <div class="form-group">
            <label class="col-sm-3 control-label">Department</label>
              <div class="col-sm-9">
              <select class="form-control select2" style="width: 100%;" required="" ng-model="dc.divisionDetails.departmentCode" ng-change="dc.selectDepartment(dc.divisionDetails.departmentCode)">
                <option selected="selected" value="0">- - - Select Department - - -</option>
                <option value="<%department.org_code%>" ng-repeat="department in dc.departments"><%department.org_name%></option>
              </select>
              </div>
            </div>
            <div class="form-group">
              <label for="projectname" class="col-sm-3 control-label">Division Name</label>
              <div class="col-sm-9"><input type="text" class="form-control" id="projectname" ng-model="dc.divisionDetails.name" placeholder="" required=""></div>
            </div>
            <div class="form-group">
            <label class="col-sm-3 control-label">Region</label>
              <div class="col-sm-9">
              <select class="form-control select2" style="width: 100%;" required="" ng-model="dc.divisionDetails.region" ng-change="dc.selectRegion(dc.divisionDetails.region)">
                <option selected="selected" value="0">- - - Select Region - - -</option>
                <option value="<%region.region_code%>" ng-repeat="region in dc.regions"><% region.region_text_short%></option>
              </select>
              </div>
            </div>
            <div class="form-group">
            <label class="col-sm-3 control-label">Province</label>
              <div class="col-sm-9">
              <select class="form-control select2" style="width: 100%;" required="" ng-model="dc.divisionDetails.province" ng-change="dc.selectProvince(dc.divisionDetails.province)">
                <option selected="selected" value="0">- - - Select Province - - -</option>
                <option value="<%province.province_code%>" ng-repeat="province in dc.provinces"><% province.province_text%></option>
              </select>
              </div>
            </div>
            <div class="form-group">
            <label class="col-sm-3 control-label">Municipality</label>
              <div class="col-sm-9">
              <select class="form-control select2" style="width: 100%;" required="" ng-model="dc.divisionDetails.municipality">
                <option selected="selected" value="0">- - - Select Municipalities - - -</option>
                <option ng-value="<%municipality.municipality_code%>" ng-repeat="municipality in dc.municipalities"><% municipality.municipality_text%></option>
              </select>
              </div>
            </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <div class="pull-right"></div>
            <button class="btn btn-large btn-primary pull-right" data-toggle="confirmation"
            data-btn-ok-label="Save" data-btn-ok-icon="fa fa-check" data-btn-ok-class="btn-success"
            data-btn-cancel-label="Cancel" data-btn-cancel-icon="fa fa-times" data-btn-cancel-class="btn-danger"
            data-title="Comfirmation" data-content="Are you sure?" ng-click="dc.newDivision(dc.divisionDetails)"> Confirmation
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

<script type="text/javascript">
$(function () {

$('.select2').select2();

//   $('#datepicker').datepicker({
//    autoclose: true
//   })

});
</script>