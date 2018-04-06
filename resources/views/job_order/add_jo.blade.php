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
              <label class="col-sm-3 control-label">Job Order Date</label>
              <div class="col-sm-9">
              <div class="input-group date">
              <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
              <input type="text" class="form-control pull-right datepicker" ng-model="joc.joDetails.orderDate">
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
                <option value="4">REPAIRS & MAINTENANCE-CONSTRUCTION EQUIPMENT</option>
                <option value="5">REPAIRS & MAINTENANCE-FURNITURE AND FIXTUREST</option>
                <option value="6">REPAIRS & MAINTENANCE-IT EQUIPMENT & SOFTWARES</option>
                <option value="7">REPAIRS & MAINTENANCE-MOTOR VEHICLE</option>
                <option value="8">REPAIRS & MAINTENANCE-OFFICE EQUIPMENT</option>
              </select></div>
            </div>
            <div class="form-group">
              <label for="assetname" class="col-sm-3 control-label">Asset Name</label>
              <div class="col-sm-9">
              <input type="text" class="form-control" ng-model="joc.joDetails.name" disabled="">
              </div>
            </div>
            <div class="form-group">
              <label for="assettag" class="col-sm-3 control-label">Asset Tag </label>
              <div class="col-sm-9"><input type="text" class="form-control" id="assettag" ng-model="joc.joDetails.tag"  disabled=""></div>
            </div>
            <div class="form-group">
              <label for="location" class="col-sm-3 control-label">Location</label>
              <div class="col-sm-9"><input type="text" class="form-control" placeholder="Location" ng-model="joc.joDetails.location" disabled=""></div>
            </div>
            <div class="form-group">
              <label for="requestingemp" class="col-sm-3 control-label">Requesting Employee</label>
              <div class="col-sm-9"><input type="text" class="form-control" placeholder="Employee" ng-model="joc.joDetails.requestingEmployee" disabled=""></div>
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

<input type="text" class="form-control" uib-datepicker-popup="<%joc.dateFormat%>" ng-model="joc.AvailableDate" name="availabledate" is-open="joc.availableDatePopup.opened" datepicker-options="joc.availableDateOptions" ng-required="true" close-text="Close" ng-click="joc.OpenAvailableDate()"
                ng-change="joc.ChangeExpiryMinDate(AvailableDate)" placeholder="Available Date" />
