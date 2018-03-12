<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><span class="fa fa-cogs"> </span> Daily Operating Report</h1>
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
          <h3 class="box-title">Please provide details of the Report</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" id="">
          <div class="box-body">
            <div class="form-group">
              <label for="controlnumber" class="col-sm-3 control-label">Control Number</label>
              <div class="col-sm-9"><input type="text" class="form-control" id="controlnumber" placeholder="" disabled></div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Select Date</label>
              <div class="col-sm-9">
              <div class="input-group date">
              <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
              <input type="text" class="form-control pull-right" id="datepicker">
            </div></div>
            </div>
            <div class="form-group">
              <label for="equipmentname" class="col-sm-3 control-label">Equipment Name</label>
              <div class="col-sm-9"><input type="text" class="form-control" id="equipmentname" placeholder="" required=""></div>
            </div>
            <div class="form-group">
              <label for="equipmentplate" class="col-sm-3 control-label">Asset ID</label>
              <div class="col-sm-9"><input type="text" class="form-control" id="equipmentplate" placeholder="" required=""></div>
            </div>
            <div class="form-group">
              <label for="equipmentplate" class="col-sm-3 control-label">Project Name</label>
              <div class="col-sm-9"><input type="text" class="form-control" id="equipmentplate" placeholder="" required=""></div>
            </div>
            <div class="form-group">
              <label for="equipmentplate" class="col-sm-3 control-label">Project ID</label>
              <div class="col-sm-9"><input type="text" class="form-control" id="equipmentplate" placeholder="" required=""></div>
            </div>
            <div class="form-group">
              <label for="activity" class="col-sm-3 control-label">Activity/ Remarks</label>
              <div class="col-sm-9"><textarea name="comment" form="usrform">Enter text here...</textarea></div>
            </div>
            <div class="form-group">
              <label for="operating" class="col-sm-3 control-label">Operating Time(HRS)</label>
              <div class="col-sm-9"><input type="text" class="form-control" id="operating" placeholder="" required=""></div>
            </div>
            <div class="form-group">
              <label for="distance" class="col-sm-3 control-label">Distance Travelled(KM/HR)</label>
              <div class="col-sm-9"><input type="text" class="form-control" id="distance" placeholder="" required=""></div>
            </div>
            <div class="form-group">
              <label for="idle" class="col-sm-3 control-label">Idle Time(HRS)</label>
              <div class="col-sm-9"><input type="text" class="form-control" id="idle" placeholder="" required=""></div>
            </div>
            <div class="form-group">
              <label for="breakdown" class="col-sm-3 control-label">Breakdown Time(HRS)</label>
              <div class="col-sm-9"><input type="text" class="form-control" id="breakdown" placeholder="" disabled=""></div>
            </div>
            <div class="form-group">
              <label for="gas" class="col-sm-3 control-label">Diesel Consumption</label>
              <div class="col-sm-9"><input type="text" class="form-control" id="gas" placeholder="" required=""></div>
            </div>
            <div class="form-group">
              <label for="gas" class="col-sm-3 control-label">Gas Consumption</label>
              <div class="col-sm-9"><input type="text" class="form-control" id="gas" placeholder="" required=""></div>
            </div>
            <div class="form-group">
              <label for="oil" class="col-sm-3 control-label">Oil Consumption</label>
              <div class="col-sm-9"><input type="text" class="form-control" id="oil" placeholder="" required=""></div>
            </div>
            <div class="form-group">
              <label for="oil" class="col-sm-3 control-label">Number of Loads</label>
              <div class="col-sm-9"><input type="text" class="form-control" id="oil" placeholder="For Dump Truck only"></div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <div class="pull-right"></div>
            <button class="btn btn-large btn-primary pull-right" data-toggle="confirmation"
            data-btn-ok-label="Save" data-btn-ok-icon="fa fa-check" data-btn-ok-class="btn-success"
            data-btn-cancel-label="Cancel" data-btn-cancel-icon="fa fa-times" data-btn-cancel-class="btn-danger"
            data-title="Comfirmation" data-content="Are you sure?"> Confirmation
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