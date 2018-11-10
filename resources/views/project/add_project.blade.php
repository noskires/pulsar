<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><span class="fa fa-cube"> </span> Add a Project</h1>
  <ol class="breadcrumb">
    <li><a href="../../index.html"><i class="fa fa-th"></i> Dashboard</a></li>
    <li><a href="../../pages/maintenance/list-equipments.html">Maintenance</a></li>
    <li class="active">Projects Monitoring</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Please provide details of the Project</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" ng-model="pc.projectDetails">
          <div class="box-body">
            <div class="form-group col-sm-12">
              <label class="col-sm-2 control-label">Department</label>
              <div class="col-sm-10">
                <select class="form-control select2" style="width: 100%;" required="" ng-change="pc.selectDepartment(pc.projectDetails.department)" ng-model="pc.projectDetails.department">
                <option selected="selected" value="0">- - select department - -</option>
                <option value="<%department.org_code%>" ng-repeat="department in pc.departments"><% department.org_name%></option>
                </select>
              </div>
            </div>

            <div class="form-group col-sm-12">
              <label class="col-sm-2 control-label">Division</label>
              <div class="col-sm-10">
              <select class="form-control select2" style="width: 100%;" required="" ng-model="pc.projectDetails.division">
                <option selected="selected" value="0">- - select division - -</option>
                <option value="<%division.org_code%>" ng-repeat="division in pc.divisions"><% division.org_name%></option>
              </select></div>
            </div>

            <div class="form-group col-sm-12">
              <hr style="border-color:#e1e1e1;border-width:1px 0;">
            </div>

            <div class="form-group col-sm-12">
              <label for="projectname" class="col-sm-3 control-label">Project Name</label>
              <div class="col-sm-9"><input type="text" class="form-control" id="projectname" ng-model="pc.projectDetails.name" placeholder="" required=""></div>
            </div>
            <div class="form-group col-sm-12">
              <label for="projectcost" class="col-sm-3 control-label">Project ID</label>
              <div class="col-sm-9"><input type="text" class="form-control" id="projectcost" ng-model="pc.projectDetails.code" placeholder="" required=""></div>
            </div>
            <div class="form-group col-sm-12">
              <label for="projectcost" class="col-sm-3 control-label">Description</label>
              <div class="col-sm-9"><input type="text" class="form-control" id="projectdescription" ng-model="pc.projectDetails.description" placeholder="" required=""></div>
            </div>
            <div class="form-group col-sm-12">
              <label for="projectcost" class="col-sm-3 control-label">Project Cost</label>
              <div class="col-sm-9"><input type="number" class="form-control" id="projectcost" ng-model="pc.projectDetails.cost" placeholder="" required=""></div>
            </div>

            <div class="form-group col-sm-12">
              <label class="col-sm-3 control-label">Project Engineer</label>
              <div class="col-sm-9">
                <select class="form-control select2" style="width: 100%;" ng-model="pc.projectDetails.projectEngineer">
                  <option value="<%employee.employee_code%>" ng-repeat="employee in pc.employees"><%employee.fname+' '+employee.lname%></option>
                </select>
              </div>
            </div>

            <div class="form-group col-sm-12">
              <hr style="border-color:#e1e1e1;border-width:1px 0;">
            </div>

            <div class="form-group col-sm-12">
              <label class="col-sm-2 control-label">Region</label>
              <div class="col-sm-4">
              <select class="form-control select2" style="width: 100%;" required="" ng-model="pc.projectDetails.region" ng-change="pc.selectRegion(pc.projectDetails.region)">
                <option selected="selected" value="0">- - - Select Region - - -</option>
                <option value="<%region.region_code%>" ng-repeat="region in pc.regions"><% region.region_text_short%></option>
              </select>
              </div>

              <label class="col-sm-2 control-label">Province</label>
              <div class="col-sm-4">
              <select class="form-control select2" style="width: 100%;" required="" ng-model="pc.projectDetails.province" ng-change="pc.selectProvince(pc.projectDetails.province)">
                <option selected="selected" value="0">- - - Select Province - - -</option>
                <option value="<%province.province_code%>" ng-repeat="province in pc.provinces"><% province.province_text%></option>
              </select>
              </div> 
            </div> 
            <div class="form-group col-sm-12">
              <label class="col-sm-2 control-label">Municipality</label>
              <div class="col-sm-6">
              <select class="form-control select2" style="width: 100%;" required="" ng-model="pc.projectDetails.municipality">
                <option selected="selected" value="0">- - - Select Municipalities - - -</option>
                <option value="<%municipality.municipality_code%>" ng-repeat="municipality in pc.municipalities"><% municipality.municipality_text%></option>
              </select>
              </div>

              <label for="zipcode" class="col-sm-2 control-label">Zip Code</label>
              <div class="col-sm-2"><input type="text" class="form-control" id="zipcode" ng-model="pc.projectDetails.zipCode" placeholder="" disabled></div>
            </div>

            <div class="form-group col-sm-12">
              <label class="col-sm-2 control-label">Barangay</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" id="" ng-model="pc.projectDetails.barangay" placeholder="">
              </div>
              <label for="zipcode" class="col-sm-2 control-label">Street/Bldg/Unit</label>
              <div class="col-sm-4"><input type="text" class="form-control" id="emp_street" ng-model="pc.projectDetails.streetBldgUnit" placeholder=""></div>
            </div>

            <div class="form-group col-sm-12">
              <hr style="border-color:#e1e1e1;border-width:1px 0;">
            </div>

            <div class="form-group col-sm-12">
              <label class="col-sm-2 control-label">Date Assigned</label>
              <div class="col-sm-4">
                <div class="input-group date">
                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                <input type="text" class="form-control pull-right" ng-model="pc.projectDetails.dateAssigned" id="datepicker3">
                </div>
              </div>

              <label class="col-sm-2 control-label">Target Date</label>
              <div class="col-sm-4">
                <div class="input-group date">
                  <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                  <input type="text" class="form-control pull-right" ng-model="pc.projectDetails.tagetDate" id="datepicker2">
                </div>
              </div>
            </div>
            <div class="form-group col-sm-12">
              
              <label class="col-sm-2 control-label">Date Started</label>
              <div class="col-sm-4">
              <div class="input-group date">
                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                <input type="text" class="form-control pull-right datepicker" ng-model="pc.projectDetails.dateStarted" id="datepicker" >
              </div>
              </div>

              <label class="col-sm-2 control-label">Date Completed</label>
              <div class="col-sm-4">
                <div class="input-group date">
                  <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                  <input type="text" class="form-control pull-right" ng-model="pc.projectDetails.dateCompleted" uib-datepicker-popup="dd-MMMM-yyyy">


                </div>

               <!--  <input type="text" class="form-control" uib-datepicker-popup="dd-MMMM-yyyy" datepicker-options="dateOptions" ng-required="true" close-text="Close" alt-input-formats="altInputFormats" />

                 <p class="input-group">
                  <input type="text" class="form-control" uib-datepicker-popup="dd-MMMM-yyyy" datepicker-options="dateOptions" alt-input-formats="altInputFormats" />
                  <span class="input-group-btn">
                    <button type="button" class="btn btn-default" ng-click="open1()"><i class="glyphicon glyphicon-calendar"></i></button>
                  </span>
                </p> -->
              </div>
            </div>


            
            <!-- /.box-body -->
            <div class="box-footer">
              <div class="pull-right"></div>
              <button class="btn btn-large btn-primary pull-right" data-toggle="confirmation"
              data-btn-ok-label="Save" data-btn-ok-icon="fa fa-check" data-btn-ok-class="btn-success"
              data-btn-cancel-label="Cancel" data-btn-cancel-icon="fa fa-times" data-btn-cancel-class="btn-danger"
              data-title="Comfirmation" data-content="Are you sure?" ng-click="pc.newProject(pc.projectDetails)"> Confirmation
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
