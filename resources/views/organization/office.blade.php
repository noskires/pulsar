<!-- Page Loader -->
<div id="loader" ng-if="oc.loader_status"></div>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><span class="fa fa-building"> </span> Office Locations</h1>
  <p>Manage Departments, Divisions and Units. Each office may have a specific location.</p>
  <ol class="breadcrumb">
    <li><a href="../../index.html"><i class="fa fa-th"></i> Dashboard</a></li>
    <li><i class="fa fa-cloud"></i> Advanced</li>
    <li class="active"><i class="fa fa-building"></i> Office Locations</li>
  </ol>
</section>

<!-- Main content -->
<section class="content" id="load_div">
  <div class="row">
    <div class="col-md-12"> 
      <div id="add-department" class="collapse department">
        <div class="panel panel-default">
          <div class="panel-body">
<!-- NEW DEPARTMENT -->
            <form id="from-department" class="form-inline" role="form" ng-model="oc.officeDetails">
              <div class="form-group">
                <label style="margin-right:15px;" for="dept-name">Department Name:</label>
                <input type="text" class="form-control" id="dept-name" size="125" required="" ng-model="oc.officeDetails.name">
              </div><!-- form group -->
                <div class="form-group col-sm-12">
                  <hr style="border-color:#e1e1e1;border-width:1px 0;">
                  <h4>Department Address:</h4><br>
                </div>
                <div class="form-group col-sm-12">
                  <label class="col-sm-1 control-label">Region</label>
                  <div class="col-sm-4">
                  <select class="form-control select2" style="width: 100%;" required="" ng-model="oc.officeDetails.region" ng-change="oc.selectRegion(oc.officeDetails.region)">
                    <option selected="selected" value="">- - - Select Region - - -</option>
                    <option value="<%region.region_code%>" ng-repeat="region in oc.regions"><% region.region_text_short%></option>
                  </select>
                  </div>
                  <label class="col-sm-1 control-label">Province</label>
                  <div class="col-sm-3">
                  <select class="form-control select2" style="width: 100%;" required="" ng-model="oc.officeDetails.province" ng-change="oc.selectProvince(oc.officeDetails.province)">
                    <option selected="selected" value="">- - - Select Province - - -</option>
                    <option value="<%province.province_code%>" ng-repeat="province in oc.provinces"><% province.province_text%></option>
                  </select>
                  </div>
                  <div class="col-sm-1"><input type="text" class="form-control" id="dept-zipcode" placeholder="Zip Code" disabled required=""></div>
                </div>
                <div class="form-group col-sm-12">
                  <label class="col-sm-1 control-label">Municipality</label>
                  <div class="col-sm-4">
                  <select class="form-control select2" style="width: 100%;" required="" ng-model="oc.officeDetails.municipality">
                    <option selected="selected" value="">- - - Select Municipality - - -</option>
                    <option value="<%municipality.municipality_code%>" ng-repeat="municipality in oc.municipalities"><% municipality.municipality_text%></option>
                  </select>
                  </div>
                  <label class="col-sm-1 control-label">Barangay</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" id="" required="" ng-model="oc.officeDetails.barangay">
                  </div>
                </div>
                <div class="form-group col-sm-12">
                  <!-- <label for="zipcode" class="col-sm-1 control-label">St/Bldg/Unit</label> -->
                  <div class="col-sm-4"><!-- <input type="text" class="form-control" id="dept-street" required=""> --></div>
                  <div class="col-sm-1"> </div>
                  <div class="col-sm-3">
                  <hr style="border-color:#e1e1e1;border-width:1px 0;">
                  <button class="btn btn-large btn-success btn-block" data-toggle="confirmation"
                  data-btn-ok-label="Save" data-btn-ok-icon="fa fa-check" data-btn-ok-class="btn-success"
                  data-btn-cancel-label="Cancel" data-btn-cancel-icon="fa fa-times" data-btn-cancel-class="btn-danger"
                  data-title="Confirm data entry." data-content="Are you sure?" ng-click="oc.newDepartment(oc.officeDetails)"> CONFIRMATION
                  </button>
                </div>
                </div>
            </form>
          </div>
        </div>
      </div>
<!-- NEW DIVISION -->
      <div id="add-division" class="collapse division">
        <div class="panel panel-default">
          <div class="panel-body">
            <form id="from-division" class="form-inline" role="form" ng-model="oc.divisionDetails">
              <div class="form-group">
                <div class="col-sm-4">
                <label style="margin-right:15px;" for="dept-name">Department Name:</label>
                <select class="form-control select2" style="width: 100%;" required="" ng-model="oc.divisionDetails.departmentCode">
                  <option selected="selected" value="">- - - Select Department - - -</option>
                  <option value="<%department.org_code%>" ng-repeat="department in oc.orgDepartments"><% department.department_name%></option>
                </select>
                </div>
                <div class="col-sm-8">
                <label style="margin-right:15px;" for="division-name">Division Name:</label> <br>
                <input type="text" class="form-control" id="division-name" size="92" required="" ng-model="oc.divisionDetails.name">
                </div>
              </div>
              <div class="form-group col-sm-12">
                <hr style="border-color:#e1e1e1;border-width:1px 0;">
                <h4>Division Address:</h4><br>
              </div>
              <div class="form-group col-sm-12">
                  <label class="col-sm-1 control-label">Region</label>
                  <div class="col-sm-4">
                  <select class="form-control select2" style="width: 100%;" required="" ng-model="oc.divisionDetails.region" ng-change="oc.selectRegion(oc.divisionDetails.region)">
                    <option selected="selected" value="">- - - Select Region - - -</option>
                    <option value="<%region.region_code%>" ng-repeat="region in oc.regions"><% region.region_text_short%></option>
                  </select>
                  </div>
                  <label class="col-sm-1 control-label">Province</label>
                  <div class="col-sm-3">
                  <select class="form-control select2" style="width: 100%;" required="" ng-model="oc.divisionDetails.province" ng-change="oc.selectProvince(oc.divisionDetails.province)">
                    <option selected="selected" value="">- - - Select Province - - -</option>
                    <option value="<%province.province_code%>" ng-repeat="province in oc.provinces"><% province.province_text%></option>
                  </select>
                  </div>
                  <div class="col-sm-1"><input type="text" class="form-control" id="dept-zipcode" placeholder="Zip Code" disabled required=""></div>
                </div>
                <div class="form-group col-sm-12">
                  <label class="col-sm-1 control-label">Municipality</label>
                  <div class="col-sm-4">
                  <select class="form-control select2" style="width: 100%;" required="" ng-model="oc.divisionDetails.municipality">
                    <option selected="selected" value="">- - - Select Municipality - - -</option>
                    <option value="<%municipality.municipality_code%>" ng-repeat="municipality in oc.municipalities"><% municipality.municipality_text%></option>
                  </select>
                  </div>
                  <label class="col-sm-1 control-label">Barangay</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" id="" required="" ng-model="oc.divisionDetails.barangay">
                  </div>
                </div>
                <div class="form-group col-sm-12">
                  <!-- <label for="zipcode" class="col-sm-1 control-label">St/Bldg/Unit</label> -->
                  <div class="col-sm-4"><!-- <input type="text" class="form-control" id="dept-street" required=""> --></div>
                  <div class="col-sm-1"> </div>
                  <div class="col-sm-3">
                  <hr style="border-color:#e1e1e1;border-width:1px 0;">
                  <button class="btn btn-large btn-success btn-block" data-toggle="confirmation"
                  data-btn-ok-label="Save" data-btn-ok-icon="fa fa-check" data-btn-ok-class="btn-success"
                  data-btn-cancel-label="Cancel" data-btn-cancel-icon="fa fa-times" data-btn-cancel-class="btn-danger"
                  data-title="Confirm data entry." data-content="Are you sure?" ng-click="oc.newDivision(oc.divisionDetails)"> CONFIRMATION
                  </button>
                </div>
                </div>
            </form>
          </div>
        </div>
      </div>
<!-- NEW UNIT -->
      <div id="add-unit" class="collapse unit">
        <div class="panel panel-default">
          <div class="panel-body">
            <form id="from-unit" class="form-inline" role="form">
              <div class="form-group">
                <div class="col-sm-4">
                <label style="margin-right:15px;" for="dept-name">Department Name:</label>
                
                <select class="form-control select2" style="width: 100%;" required="" ng-model="oc.unitDetails.departmentCode" ng-change="oc.selectDepartment(oc.unitDetails.departmentCode)">
                  <option selected="selected" value="">- - - Select Department - - -</option>
                  <option value="<%department.org_code%>" ng-repeat="department in oc.orgDepartments" ><% department.department_name%></option>
                </select>
                </div>
                <div class="col-sm-4">
                <label style="margin-right:15px;" for="division-name">Division Name:</label> <br>
                
                <select class="form-control select2" style="width: 100%;" required="" ng-model="oc.unitDetails.divisionCode" ng-change="oc.selectDivision(oc.unitDetails.divisionCode)">
                  <option selected="selected" value="">- - - Select Division - - -</option>
                  <option value="<%division.org_code%>" ng-repeat="division in oc.divisions"><% division.division_name%></option>
                </select>
                </div>
                <div class="col-sm-4">
                <label style="margin-right:15px;" for="division-name">Unit Name:</label> <br>
                <input type="text" class="form-control" id="division-name" size="51" required="" ng-model="oc.unitDetails.name">
                </div>
              </div>
              <div class="form-group col-sm-12">
                <hr style="border-color:#e1e1e1;border-width:1px 0;">
                <h4>Unit Address:</h4><br>
              </div>
              <div class="form-group col-sm-12">
                  <label class="col-sm-1 control-label">Region</label>
                  <div class="col-sm-4">
                  <select class="form-control select2" style="width: 100%;" required="" ng-model="oc.unitDetails.region" ng-change="oc.selectRegion(oc.unitDetails.region)">
                    <option selected="selected" value="">- - - Select Region - - -</option>
                    <option value="<%region.region_code%>" ng-repeat="region in oc.regions"><% region.region_text_short%></option>
                  </select>
                  </div>
                  <label class="col-sm-1 control-label">Province</label>
                  <div class="col-sm-3">
                  <select class="form-control select2" style="width: 100%;" required="" ng-model="oc.unitDetails.province" ng-change="oc.selectProvince(oc.unitDetails.province)">
                    <option selected="selected" value="">- - - Select Province - - -</option>
                    <option value="<%province.province_code%>" ng-repeat="province in oc.provinces"><% province.province_text%></option>
                  </select>
                  </div>
                  <div class="col-sm-1"><input type="text" class="form-control" id="dept-zipcode" placeholder="Zip Code" disabled required=""></div>
                </div>
                <div class="form-group col-sm-12">
                  <label class="col-sm-1 control-label">Municipality</label>
                  <div class="col-sm-4">
                  <select class="form-control select2" style="width: 100%;" required="" ng-model="oc.unitDetails.municipality">
                    <option selected="selected" value="">- - - Select Municipality - - -</option>
                    <option value="<%municipality.municipality_code%>" ng-repeat="municipality in oc.municipalities"><% municipality.municipality_text%></option>
                  </select>
                  </div>
                  <label class="col-sm-1 control-label">Barangay</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" id="" required="" ng-model="oc.unitDetails.barangay">
                  </div>
                </div>
                <div class="form-group col-sm-12">
                  <!-- <label for="zipcode" class="col-sm-1 control-label">St/Bldg/Unit</label> -->
                  <div class="col-sm-4"><!-- <input type="text" class="form-control" id="dept-street" required=""> --></div>
                  <div class="col-sm-1"> </div>
                  <div class="col-sm-3">
                  <hr style="border-color:#e1e1e1;border-width:1px 0;">
                  <button class="btn btn-large btn-success btn-block" data-toggle="confirmation"
                  data-btn-ok-label="Save" data-btn-ok-icon="fa fa-check" data-btn-ok-class="btn-success"
                  data-btn-cancel-label="Cancel" data-btn-cancel-icon="fa fa-times" data-btn-cancel-class="btn-danger"
                  data-title="Confirm data entry." data-content="Are you sure?" ng-click="oc.newUnit(oc.unitDetails)"> CONFIRMATION
                  </button>
                </div>
                </div>
            </form>
          </div>
        </div>
      </div>
<!-- BUTTONS -->
      <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#add-department">
          <span class="glyphicon glyphicon-plus"></span> New Department
      </button> &nbsp;
      <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#add-division">
          <span class="glyphicon glyphicon-plus"></span> New Division
      </button> &nbsp;
      <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#add-unit">
          <span class="glyphicon glyphicon-plus"></span> New Unit
      </button>
    </div>
  </div><br>  
<!-- TABLES -->
  <div class="row">
    <div class="col-md-6"> 
<h4><b>Units Table</b></h4>
      <div class="box box-primary">
        <div class="box-body">
          <table id="" class="table table-bordered table-hover" width="100%">
            <thead>
            <tr>
              <th>Department</th>
              <th>Division</th>
              <th>Unit</th>
              <th>Address</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="unit in oc.orgUnits">
              <td><%unit.department_name | uppercase%></td>
              <td><%unit.division_name | uppercase%></td>
              <td><a href="#"><b><%unit.unit_name | uppercase%></b></a></td>
              <td><%unit.office_address | uppercase%></td>
            </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-6"> 
    <h4><b>Divisions Table</b></h4>
      <div class="box box-primary">
        <div class="box-body">
          <table id="" class="table table-bordered table-hover" width="100%">
            <thead>
            <tr>
              <th>Department</th>
              <th>Division</th>
              <th>Address</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="division in oc.orgDivisions">
              <td><%division.department_name | uppercase%></td>
              <td><a href="#"><b><%division.division_name | uppercase%></b></a></td>
              <td><%division.office_address | uppercase%></td>
            </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-6"> 
<h4><b>Departments Table</b></h4>
      <div class="box box-primary">
        <div class="box-body">
          <table id="" class="table table-bordered table-hover" width="100%">
            <thead>
            <tr>
              <th>Department</th>
              <th>Address</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="department in oc.orgDepartments">
              <td><a href="#" ui-sref="org-office({orgUnitCode:department.org_code})"><b><%department.department_name | uppercase%></b></a></td>
              <td><%department.office_address | uppercase%></td>
            </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- MODAL CONTENTS -->
<script type="text/ng-template" id="edit.department.modal">
<div>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" ui-sref="org-office-create()" ng-click="vm.ok()">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Department</h4>
      </div>
      <div class="modal-body">
        <!-- Custom Tabs (Pulled to the right) -->
        <form class="form-horizontal" id="">
            <div class="box-body">
              <div class="form-group col-sm-12">
                <label for="controlnumber" class="col-sm-3 control-label">Department Name</label>
                <div class="col-sm-6"><input type="text" class="form-control" ng-model="vm.data.org_name"></div>
              </div>
        
              <div class="form-group col-sm-12">
                <label class="col-sm-1 control-label">Region</label>
                <div class="col-sm-5">
                <select class="form-control" style="width: 100%;" required="" ng-model="vm.data.region_code" ng-change="vm.selectRegion(vm.data.region_code)">
                  <option selected="selected" value="">- - - Select Region - - -</option>
                  <option ng-value="region.region_code" ng-repeat="region in vm.regions"><% region.region_text_short%></option>
                </select>
                </div>
                
                <label class="col-sm-1 control-label">Province</label>
                <div class="col-sm-5">
                <select class="form-control" style="width: 100%;" required="" ng-model="vm.data.province_code" ng-change="vm.selectProvince(vm.data.province_code)">
                  <option selected="selected" value="">- - - Select Province - - -</option>
                  <option ng-value="province.province_code" ng-repeat="province in vm.provinces"><% province.province_text%></option>
                </select>
                </div>
                <!-- <div class="col-sm-1"><input type="text" class="form-control" id="dept-zipcode" placeholder="Zip Code" disabled required=""></div> -->
              </div>
              <div class="form-group col-sm-12">
                <label class="col-sm-1 control-label">Municipality</label>
                <div class="col-sm-5">
                <select class="form-control" style="width: 100%;" required="" ng-model="vm.data.municipality_code">
                  <option selected="selected" value="">- - - Select Municipality - - -</option>
                  <option ng-value="municipality.municipality_code" ng-repeat="municipality in vm.municipalities"><% municipality.municipality_text%></option>
                </select>
                </div>
                <label class="col-sm-1 control-label">Barangay</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="" required="" ng-model="vm.data.barangay">
                </div>
              </div>
            </div>
            <!-- /.box-body -->
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" ui-sref="list-role({roleCode:''})" ng-click="vm.ok()">Close</button>
        <button class="btn btn-large btn-danger pull-left" data-toggle="confirmation"
          data-btn-ok-label="Yes" data-btn-ok-icon="fa fa-check" data-btn-ok-class="btn-success"
          data-btn-cancel-label="No" data-btn-cancel-icon="fa fa-times" data-btn-cancel-class="btn-danger"
          data-title="Confirmation." data-content="Are you sure?" style="width: 10%;"> Delete
        </button>
        <button class="btn btn-large btn-success pull-right" data-toggle="confirmation"
          data-btn-ok-label="Yes" data-btn-ok-icon="fa fa-check" data-btn-ok-class="btn-success"
          data-btn-cancel-label="No" data-btn-cancel-icon="fa fa-times" data-btn-cancel-class="btn-danger"
          data-title="Confirm data entry." data-content="Update entry?" style="width: 20%;" ng-click="vm.updateDepartmentBtn(vm.data)"> Update
        </button>
        <!-- nav-tabs-custom -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
</script>
<!-- /.modal -->