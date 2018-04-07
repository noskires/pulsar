<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><span class="fa fa-cogs"> </span> Daily Operating Report</h1>
  <ol class="breadcrumb">
    <li><a href="../../index.html"><i class="fa fa-th"></i> Dashboard</a></li>
    <li class="active">Maintenance</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-8">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Please provide details of the Report</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" id="" ng-model="oc.operationDetails">
          <div class="box-body">
            <!-- <div class="form-group col-sm-12">
              <label for="controlnumber" class="col-sm-3 control-label">Control Number</label>
              <div class="col-sm-9"><input type="text" class="form-control" id="controlnumber" placeholder="" disabled></div>
            </div> -->
            <div class="form-group col-sm-12">
              <label class="col-sm-3 control-label">Select Date</label>
              <div class="col-sm-9">
              <div class="input-group date">
              <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
              <input type="text" class="form-control pull-right" id="datepicker" ng-model="oc.operationDetails.operationDate">
            </div></div>
            </div>
            <div class="form-group col-sm-12">
              <label class="col-sm-3 control-label">Equipment Name</label>
              <div class="col-sm-9">
              <select class="form-control select2" style="width: 100%;" required="" ng-model="oc.operationDetails.assetTag">
                <option selected="selected" value="0">- - select equipment - -</option>
                <option ng-value="asset.tag" ng-repeat="asset in oc.assets"><%asset.name + " : " + asset.tag%></option> 
              </select></div>
            </div>
            <div class="form-group col-sm-12">
              <label class="col-sm-3 control-label">Project Name</label>
              <div class="col-sm-9">
              <select class="form-control select2" style="width: 100%;" required="" ng-model="oc.operationDetails.projectCode">
              <option selected="selected" value="0">- - select project - -</option>
              <option value="<%project.project_code%>" ng-repeat="project in oc.projects"><%project.name +" : "+project.project_code%></option>
              </select></div>
            </div>
            <div class="form-group col-sm-12">
              <label for="activity" class="col-sm-3 control-label">Activity/ Remarks</label>
              <div class="col-sm-9"><textarea class="col-sm-9 form-control" id="dv-desc" rows="2" ng-model="oc.operationDetails.remarks"></textarea></div>
            </div>
            <div class="form-group col-sm-12">
              <label for="operating" class="col-sm-3 control-label">Operating Time(HRS)</label>
              <div class="col-sm-3"><input type="text" class="form-control" id="operating" placeholder="" required="" ng-model="oc.operationDetails.operatingHours"></div>
              <label for="distance" class="col-sm-3 control-label">Distance Travelled(KM/HR)</label>
              <div class="col-sm-3"><input type="text" class="form-control" id="distance" placeholder="" required="" ng-model="oc.operationDetails.distanceTravelled"></div>
            </div>
            <div class="form-group col-sm-12">
              <label for="gas" class="col-sm-3 control-label">Diesel Consumption</label>
              <div class="col-sm-3"><input type="text" class="form-control" id="gas" placeholder="" required="" ng-model="oc.operationDetails.dieselConsumption"></div>
              <label for="gas" class="col-sm-3 control-label">Gas Consumption</label>
              <div class="col-sm-3"><input type="text" class="form-control" id="gas" placeholder="" required="" ng-model="oc.operationDetails.gasConsumption"></div>
            </div>
            <div class="form-group col-sm-12">
              <label for="oil" class="col-sm-3 control-label">Oil Consumption</label>
              <div class="col-sm-3"><input type="text" class="form-control" id="oil" placeholder="" required="" ng-model="oc.operationDetails.oilConsumption"></div>
              <label for="oil" class="col-sm-3 control-label">Number of Loads</label>
              <div class="col-sm-3"><input type="text" class="form-control" id="oil" placeholder="For Dump Truck only" ng-model="oc.operationDetails.numberLoads"></div>
            </div>
          </div>  
          <!-- /.box-body -->
          <div class="box-footer">
            <div class="form-group col-sm-12">           
              <div class="col-sm-8"></div>
              <div class="col-sm-4">
              <button class="btn btn-large btn-primary btn-block" data-toggle="confirmation"
              data-btn-ok-label="Save" data-btn-ok-icon="fa fa-check" data-btn-ok-class="btn-success"
              data-btn-cancel-label="Cancel" data-btn-cancel-icon="fa fa-times" data-btn-cancel-class="btn-danger"
              data-title="Confirm data entry." data-content="Are you sure?" ng-click="oc.newOperation(oc.operationDetails)"> CONFIRMATION
              </button></div></div>
          </div>
        </form>
      </div>
      <!-- /.box -->
    </div>
    <!--/.col (left) -->
  </div>
  <!-- /.row -->
</section>