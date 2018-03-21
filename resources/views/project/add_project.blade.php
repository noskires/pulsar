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
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Please provide details of the Project</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" ng-model="pc.projectDetails">
          <div class="box-body">
            <div class="form-group">
              <label for="projectname" class="col-sm-3 control-label">Project Name</label>
              <div class="col-sm-9"><input type="text" class="form-control" id="projectname" ng-model="pc.projectDetails.name" placeholder="" required=""></div>
            </div>
            <div class="form-group">
              <label for="projectcost" class="col-sm-3 control-label">Project Cost</label>
              <div class="col-sm-9"><input type="number" class="form-control" id="projectcost" ng-model="pc.projectDetails.cost" placeholder="" required=""></div>
            </div>
            <div class="form-group">
            <label class="col-sm-3 control-label">Province</label>
              <div class="col-sm-9">
              <select class="form-control select2" style="width: 100%;" required="" ng-model="pc.projectDetails.province">
                <option selected="selected" value="1">Cagayan</option>
                <option value="2">Isabela</option>
                <option value="3">Vizcaya</option>
                <option value="4">Batanes</option>
                <option value="5">Quirino</option>
              </select>
              </div>
            </div>
            <div class="form-group">
            <label class="col-sm-3 control-label">Municipality</label>
              <div class="col-sm-9">
              <select class="form-control select2" style="width: 100%;" required="" ng-model="pc.projectDetails.municipality">
                <option selected="selected" value="1">Tuguegarao City</option>
                <option value="2">Iguig</option>
                <option value="3">Solana</option>
                <option value="4">Enrile</option>
                <option value="5">Peñablanca</option>
                <option value="6">Gonzaga</option>
                <option value="7">Sta. Ana</option>
              </select>
              </div>
            </div>
            <div class="form-group">
              <label for="zipcode" class="col-sm-3 control-label">Zip Code</label>
              <div class="col-sm-9"><input type="text" class="form-control" id="zipcode" ng-model="pc.projectDetails.zipCode" placeholder="" disabled></div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Date Started</label>
              <div class="col-sm-9">
              <div class="input-group date">
              <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
              <input type="text" class="form-control pull-right datepicker" ng-model="pc.projectDetails.dateStarted" id="datepicker" >
            </div></div>
          </div>
          <div class="form-group">
              <label class="col-sm-3 control-label">Date Completed</label>
              <div class="col-sm-9">
              <div class="input-group date">
              <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
              <input type="text" class="form-control pull-right" ng-model="pc.projectDetails.dateCompleted" id="datepicker2">
            </div></div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label">Project Engineer</label>
            <div class="col-sm-9">
            <select class="form-control select2" style="width: 100%;" ng-model="pc.projectDetails.projectEngineer">
              <option value="<%employee.employee_id%>" ng-repeat="employee in pc.employees"><%employee.fname+' '+employee.lname%></option>
            </select>
          </div></div>
          <div class="form-group">
              <label class="col-sm-3 control-label">Date Assigned</label>
              <div class="col-sm-9">
              <div class="input-group date">
              <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
              <input type="text" class="form-control pull-right" ng-model="pc.projectDetails.dateAssigned" id="datepicker3">
            </div></div>
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
