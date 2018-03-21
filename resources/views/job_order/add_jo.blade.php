<section class="content-header">
  <h1><span class="fa fa-folder-open"> </span> Create Job Order</h1>
  <ol class="breadcrumb">
    <li><a href="../../index.html"><i class="fa fa-th"></i> Dashboard</a></li>
    <li class="active">Job Order</li>
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
        <form class="form-horizontal" id="" ng-model="joc.joDetails">
          <div class="box-body">
            <div class="form-group">
              <label for="controlnumber" class="col-sm-3 control-label">Control Number</label>
              <div class="col-sm-9"><input type="text" class="form-control" id="controlnumber" placeholder="JO-03122018-1" disabled></div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Job Order Date</label>
              <div class="col-sm-9">
              <div class="input-group date">
              <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
              <input type="text" class="form-control pull-right" id="datepicker" ng-model="joc.joDetails.orderDate">
            </div></div>
            </div>
            <div class="form-group">
              <label for="requestpurpose" class="col-sm-3 control-label">Request Purpose</label>
              <div class="col-sm-9">
              <select class="form-control select2" style="width: 100%;" required="" ng-model="joc.joDetails.purpose">
                <option selected="selected" value="0">- - select purpose - -</option>
                <option value="1">REPAIRS & MAINTENANCE-BUILDING CONSTRUCTION</option>
                <option value="2">REPAIRS & MAINTENANCE-BUILDING LEASEHOLD IMPROVEMENTS</option>
                <option value="3">REPAIRS & MAINTENANCE-COMMUNICATION EQUIPMENT</option>
                <option value="3">REPAIRS & MAINTENANCE -CONSTRUCTION EQUIPMENT</option>
                <option value="3">REPAIRS & MAINTENANCE-FURNITURE AND FIXTUREST</option>
                <option value="3">REPAIRS & MAINTENANCE-IT EQUIPMENT & SOFTWARES</option>
                <option value="3">REPAIRS & MAINTENANCE-MOTOR VEHICLE</option>
                <option value="3">REPAIRS & MAINTENANCE-OFFICE EQUIPMENT</option>
              </select></div>
            </div>
            <div class="form-group">
              <label for="assetname" class="col-sm-3 control-label">Asset Name</label>
              <div class="col-sm-9">
              <select class="form-control select2" style="width: 100%;" required="">
              <option selected="selected" value="0">- - select asset - -</option>
              <option value="1">Dump Truck</option>
              <option value="2">AssetName1</option>
              <option value="3">AssetName1</option>
              </select>
              </div>
            </div>
            <div class="form-group">
              <label for="assettag" class="col-sm-3 control-label">Asset Tag</label>
              <div class="col-sm-9"><input type="text" class="form-control" id="assettag" placeholder="CONE-03082018-DT1" ng-model="joc.joDetails.assetTag"></div>
            </div>
            <div class="form-group">
              <label for="location" class="col-sm-3 control-label">Location</label>
              <div class="col-sm-9"><input type="text" class="form-control" id="location" placeholder="" disabled=""></div>
            </div>
            <div class="form-group">
              <label for="requestingemp" class="col-sm-3 control-label">Requesting Employee</label>
              <div class="col-sm-9"><input type="text" class="form-control" id="requestingemp" placeholder="" disabled=""></div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <div class="pull-right"></div>
            <button class="btn btn-large btn-primary pull-right" data-toggle="confirmation"
            data-btn-ok-label="Save" data-btn-ok-icon="fa fa-check" data-btn-ok-class="btn-success"
            data-btn-cancel-label="Cancel" data-btn-cancel-icon="fa fa-times" data-btn-cancel-class="btn-danger"
            data-title="Comfirmation" data-content="Are you sure?" ng-click="joc.newJobOrder(joc.joDetails)"> Confirmation
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