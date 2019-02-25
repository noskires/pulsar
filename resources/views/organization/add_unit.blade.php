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
          <h3 class="box-title">Please provide details of Unit</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" ng-model="uc.unitDetails">
          <div class="box-body">
            <div class="form-group">
            <label class="col-sm-3 control-label">Department</label>
              <div class="col-sm-9">
              <select class="form-control select2" style="width: 100%;" required="" ng-model="uc.unitDetails.departmentCode" ng-change="uc.selectDepartment(uc.unitDetails.departmentCode)">
                <option selected="selected" value="0">- - - Select Department - - -</option>
                <option value="<%department.org_code%>" ng-repeat="department in uc.departments"><%department.org_name%></option>
              </select>
              </div>
            </div>
            <div class="form-group">
            <label class="col-sm-3 control-label">Division</label>
              <div class="col-sm-9">
              <select class="form-control select2" style="width: 100%;" required="" ng-model="uc.unitDetails.divisionCode" ng-change="uc.selectDivision(uc.unitDetails.divisionCode)">
                <option selected="selected" value="0">- - - Select Division - - -</option>
                <option value="<%division.org_code%>" ng-repeat="division in uc.divisions"><%division.org_name%></option>
              </select>
              </div>
            </div>
            <div class="form-group">
              <label for="" class="col-sm-3 control-label">Unit Name</label>
              <div class="col-sm-9"><input type="text" class="form-control" id="" ng-model="uc.unitDetails.name" placeholder="" required=""></div>
            </div>
            <div class="form-group">
            <label class="col-sm-3 control-label">Region</label>
              <div class="col-sm-9">
              <select class="form-control select2" style="width: 100%;" required="" ng-model="uc.unitDetails.region" ng-change="uc.selectRegion(uc.unitDetails.region)">
                <option selected="selected" value="0">- - - Select Region - - -</option>
                <option value="<%region.region_code%>" ng-repeat="region in uc.regions"><% region.region_text_short%></option>
              </select>
              </div>
            </div>
            <div class="form-group">
            <label class="col-sm-3 control-label">Province</label>
              <div class="col-sm-9">
              <select class="form-control select2" style="width: 100%;" required="" ng-model="uc.unitDetails.province" ng-change="uc.selectProvince(uc.unitDetails.province)">
                <option selected="selected" value="0">- - - Select Province - - -</option>
                <option value="<%province.province_code%>" ng-repeat="province in uc.provinces"><% province.province_text%></option>
              </select>
              </div>
            </div>
            <div class="form-group">
            <label class="col-sm-3 control-label">Municipality</label>
              <div class="col-sm-9">
              <select class="form-control select2" style="width: 100%;" required="" ng-model="uc.unitDetails.municipality">
                <option selected="selected" value="0">- - - Select Municipalities - - -</option>
                <option ng-value="<%municipality.municipality_code%>" ng-repeat="municipality in uc.municipalities"><% municipality.municipality_text%></option>
              </select>
              </div>
            </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <div class="pull-right"></div>
            <button class="btn btn-large btn-primary pull-right" data-toggle="confirmation"
            data-btn-ok-label="Save" data-btn-ok-icon="fa fa-check" data-btn-ok-class="btn-success"
            data-btn-cancel-label="Cancel" data-btn-cancel-icon="fa fa-times" data-btn-cancel-class="btn-danger"
            data-title="Comfirmation" data-content="Are you sure?" ng-click="uc.newUnit(uc.unitDetails)"> Confirmation
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