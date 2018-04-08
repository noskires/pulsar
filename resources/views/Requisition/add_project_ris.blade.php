<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><span class="fa fa-file-text"> </span> Create Requisition and Issue Slip</h1>
  <ol class="breadcrumb">
    <li><a href="../../index.html"><i class="fa fa-th"></i> Dashboard</a></li>
    <li><a href="../../pages/maintenance/list-equipments.html">Maintenance</a></li>
    <li class="active">Maintenance</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-7">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"></h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" id="">
          <div class="box-body">
            <!-- <div class="form-group">
              <label for="controlnumber" class="col-sm-3 control-label">Control Number</label>
              <div class="col-sm-9"><input type="text" class="form-control" id="controlnumber" placeholder="RS-03102018-1" disabled></div>
            </div> -->
            <div class="form-group">
              <label class="col-sm-3 control-label">Request Date</label>
              <div class="col-sm-9">
              <div class="input-group date">
              <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
              <input type="text" class="form-control pull-right" id="datepicker" ng-model="rpc.risDetails.date_requested">
            </div></div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Date Needed</label>
              <div class="col-sm-9">
              <div class="input-group date">
              <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
              <input type="text" class="form-control pull-right" id="datepicker2" ng-model="rpc.risDetails.date_needed">
            </div></div>
            </div>
            <div class="form-group">
              <label for="equipmentplate" class="col-sm-3 control-label">Description/Remarks</label>
              <div class="col-sm-9"><input type="text" class="form-control" id="equipmentplate" placeholder="" required="" ng-model="rpc.risDetails.description"></div>
            </div>
            <div class="form-group">
              <label for="equipmentplate" class="col-sm-3 control-label">Project</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="" placeholder="" value="<%rpc.project.name+ ' : '+rpc.project.project_code%>" disabled>
              </div>
            </div>
            <div class="form-group">
              <label for="equipmentplate" class="col-sm-3 control-label">Requesting Employee</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="" placeholder="" value="<%rpc.project.employee_name%>" disabled>
              </div>
            </div>
            <div class="form-group">
              <label for="equipmentplate" class="col-sm-3 control-label">Location</label>
              <div class="col-sm-9"><input type="text" class="form-control" id="equipmentplate" placeholder="" value="<%rpc.project.municipality_text%>" disabled=""></div>
            </div>

          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <div class="pull-right"></div> 
            <button class="btn btn-large btn-primary pull-right" data-toggle="confirmation"
            data-btn-ok-label="Save" data-btn-ok-icon="fa fa-check" data-btn-ok-class="btn-success"
            data-btn-cancel-label="Cancel" data-btn-cancel-icon="fa fa-times" data-btn-cancel-class="btn-danger"
            data-title="Comfirmation" data-content="Are you sure?" ng-click="rpc.newRequisitionSlip(rpc.risDetails)"> Confirmation
            </button>
          </div>
        </form>
      </div>
      <!-- /.box -->
    </div>
    <!--/.col (left) -->
  </div>
  <!-- /.row -->
</section>