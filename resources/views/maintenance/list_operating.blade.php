<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><span class="fa fa-cogs"> </span> List of Operating Records</h1>
      <ol class="breadcrumb">
        <li><a href="../../index.html"><i class="fa fa-th"></i> Dashboard</a></li>
        <li class="active">Operating records</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">


    <div class="row">
        <div id="button-top" class="col-md-12"> 
<!-- BUTTONS -->
          <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#addoperating">
              <span class="glyphicon glyphicon-plus"></span> Add Operating Record
          </button> &nbsp; 
          <button class="btn btn-primary" data-toggle="collapse" data-target="#filter" data-parent="#btn-top">
              <span class="glyphicon glyphicon-filter"></span> Filter
          </button> <br> 

<!-- ADD OPERATING RECORD SLIDE -->
          <div id="addoperating" class="collapse"><br>
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-body">
            <!-- form start -->
            <form id="from-unit" class="form-horizontal" role="form">
              <div class="box-body">
                <div class="form-group">
                  <label class="col-sm-3 control-label">Select Date</label>
                  <div class="col-sm-9">
                  <div class="input-group date">
                  <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                  <input type="text" class="form-control pull-right" id="datepicker-addoperating" datepicker ng-model="oc.operationDetails.operationDate" autocomplete="off" readonly="readonly">
                </div></div>
                </div>
                <div class="form-group col-sm-12">
                  <label class="col-sm-3 control-label">Equipment Name</label>
                  <div class="col-sm-9">

                  <select class="form-control select2" style="width: 100%;" required="" ng-model="oc.operationDetails.assetCode" ng-init="oc.operationDetails.assetCode=''">
                    <option selected="selected" value="">- - SELECT EQUIPMENT - -</option>
                    <option ng-value="asset.asset_code" ng-repeat="asset in oc.assets"><%asset.name + " : " + asset.code%></option> 
                  </select>

                  </div>
                </div>
                <div class="form-group col-sm-12">
                  <label class="col-sm-3 control-label">Project Name</label>
                  <div class="col-sm-9">

                  <select class="select2 form-control" style="width: 100%;" required="" ng-model="oc.operationDetails.projectCode" ng-init="oc.operationDetails.projectCode=''">
                    <option selected="selected" value="">- - SELECT PROJECT - -</option>
                    <option value="<%project.project_code%>" ng-repeat="project in oc.projects"><%project.name +" : "+project.project_code%></option>
                  </select>
                  
                  </div>
                </div>
                <div class="form-group col-sm-12">
                  <label for="activity" class="col-sm-3 control-label">Activity/ Remarks</label>
                  <div class="col-sm-9"><textarea class="col-sm-9 form-control" id="dv-desc" rows="2" ng-model="oc.operationDetails.remarks"></textarea></div>
                </div>

                <div class="row">
                <div class="col-sm-3 bootstrap-timepicker">
                  <div class="form-group col-sm-12">
                    &nbsp;
                  </div>
                </div>
                <div class="col-sm-2 bootstrap-timepicker">
                  <div class="form-group col-sm-12">
                    <label>Operating Time</label>
                    <div class="input-group">
                      <div class="input-group-addon" >From</div>
                      <input type="text" class="form-control" ng-model="oc.operationDetails.operatingTimeFrom">
                    </div>
                  </div>
                </div>
                <div class="col-sm-2 bootstrap-timepicker">
                  <div class="form-group col-sm-12">
                    <label>Operating Time</label>
                    <div class="input-group">
                      <div class="input-group-addon" >To</div>
                      <input type="text" class="form-control" ng-model="oc.operationDetails.operatingTimeTo">
                    </div>
                  </div>
                </div>
                <div class="col-sm-3">
                  <!-- <div class="form-group col-sm-12">
                    <label>Total Operating Time (HRS)</label>
                    <div class="input-group">
                      <input type="text" class="form-control" required="" ng-model="oc.operationDetails.operatingHours" awnum="price">
                    </div>
                  </div> -->
                </div>
              </div>                

              <div class="row">
                <div class="col-sm-3">
                  <div class="form-group col-sm-12">
                    &nbsp;
                  </div>
                </div>
                <div class="col-sm-2">
                  <div class="form-group col-sm-12">
                    <label>Distance Travelled</label>
                    <div class="input-group">
                      <div class="input-group-addon">From</div>
                      <input type="number" class="form-control" ng-model="oc.operationDetails.distanceTravelledFrom">
                    </div>
                  </div>
                </div>
                <div class="col-sm-2">
                  <div class="form-group col-sm-12">
                    <label>Distance Travelled</label>
                    <div class="input-group">
                      <div class="input-group-addon">To</div>
                      <input type="number" class="form-control" ng-model="oc.operationDetails.distanceTravelledTo">
                    </div>
                  </div>
                </div>
                <div class="col-sm-2">
                  <!-- <div class="form-group col-sm-12">
                    <label>Distance Travelled (KM)</label>
                    <div class="input-group">
                      <input type="number" class="form-control" ng-model="oc.operationDetails.distanceTravelled" awnum="price">
                    </div>
                  </div> -->
                </div>
              </div>

                <!-- <div class="form-group col-sm-12">
                  <label for="operating" class="col-sm-3 control-label">Operating Time(HRS)</label>
                  <div class="col-sm-3"><input type="text" class="form-control" id="operating" placeholder="" required=""></div>
                  <label for="distance" class="col-sm-3 control-label">Distance Travelled(KM)</label>
                  <div class="col-sm-3"><input type="text" class="form-control" id="distance" placeholder="" required=""></div>
                </div> -->
                <div class="form-group col-sm-12">
                  <label for="gas" class="col-sm-3 control-label">Diesel Consumption</label>
                  <div class="col-sm-3"><input type="text" class="form-control" id="gas" placeholder="" required="" ng-model="oc.operationDetails.dieselConsumption" awnum="price"></div>
                  <label for="gas" class="col-sm-3 control-label">Gas Consumption</label>
                  <div class="col-sm-3"><input type="text" class="form-control" id="gas" placeholder="" required="" ng-model="oc.operationDetails.gasConsumption" awnum="price"></div>
                </div>
                <div class="form-group col-sm-12">
                  <label for="oil" class="col-sm-3 control-label">Oil Consumption</label>
                  <div class="col-sm-3"><input type="text" class="form-control" id="oil" placeholder="" required="" ng-model="oc.operationDetails.oilConsumption" awnum="price"></div>
                  <label for="oil" class="col-sm-3 control-label">Number of Loads</label>
                  <div class="col-sm-3"><input type="text" class="form-control" id="oil" placeholder="For Dump Truck only" ng-model="oc.operationDetails.numberLoads" awnum="price"></div>
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
          </div>
          <!-- /.box -->
          </div>
          <br>  

<!-- FILTER DISPLAY SLIDE -->
          <div id="filter" class="collapse"><br>
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Filter Displayed Data</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <!-- form start -->
            <form id="from-unit" class="form-horizontal" role="form">
              <div class="form-group col-sm-12">
                <div class="col-sm-3"> 
                <button type="button" class="btn btn-default" id="daterange-btn" style="width: 100%;">
                  <span><i class="fa fa-calendar"></i> Select Date Range </span> <i class="fa fa-caret-down"></i>
                </button>
                </div>
                <div class="col-sm-1">
                  <button type="button" class="btn btn-primary btn-flat">Filter</button></div>
              </div>
            </form>
          </div>
          </div>
          <!-- /.box -->
          </div>
        </div>
      </div><br>  

      <!-- <div class="row">
        <div class="col-sm-4">
          <div class="box"> 
              <form role="form">
                <div class="box-body">
                  <div class="form-group">
                    <div class="col-sm-7"> 
                    <button type="button" class="btn btn-default" id="daterange-btn">
                      <span><i class="fa fa-calendar"></i> Date range picker </span> <i class="fa fa-caret-down"></i>
                    </button>
                    </div>
                    <div class="col-sm-3"> 
                    <button type="button" class="btn btn-default"><li class="fa fa-refresh"></li> Filter Display</button>
                    </div>
                  </div>
                </div> 
              </form>
          </div>
        </div>
      </div> -->
      <div class="box box-primary">
            <div class="box-body">
              <div export-to-xlsx data="oc.operations" bind-to-table="'tb-operating'" filename="'List of Operating Records'"></div>
              <table datatable="ng" class="table table-bordered table-hover" name="tb-operating" width="100%">
                <thead>
                <tr>
                  <th>Control Number</th>
                  <th>Asset Code</th>
                  <th>Date</th>
                  <th>Equipment Name</th>
                  <th>Asset ID</th>
                  <th>Project Name</th>
                  <th>Project ID</th>
                  <th>Office Location</th>
                  <th>Activity/Remarks</th>
                  <th>Operating Time(HRS) From</th>
                  <th>Operating Time(HRS) To</th>
                  <th>Operating Time(HRS) Total</th>
                  <th>Distance Travelled(KM) From</th>
                  <th>Distance Travelled(KM) To</th>
                  <th>Distance Travelled(KM) Total</th>
                  <th>Diesel (L)</th>
                  <th>Gas (L)</th>
                  <th>Oil (L)</th>
                  <th>Loads</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="operation in oc.operations">
                  <td><a href="#" data-toggle="modal" data-target="#modal-default"><b><%operation.operation_code%></b></a></td>
                  <td><%operation.asset_code%></td>
                  <td><%operation.operation_date%></td>
                  <td><%operation.asset_name%></td>
                  <td><%operation.code%></td>
                  <td><%operation.project_name%></td>
                  <td><%operation.project_code%></td>
                  <td><%operation.barangay+' '+operation.municipality_text +' '+ operation.province_text+' '+ operation.region_text_short%></td>
                  <td><%operation.remarks%></td>
                  <td align="right"><%operation.operating_time_from| number:2%></td>
                  <td align="right"><%operation.operating_time_to | number:2%></td>
                  <td align="right"><%operation.operating_time_to-operation.operating_time_from | number:2%></td>
                  <td align="right"><%operation.distance_travelled_from | number:2%></td>
                  <td align="right"><%operation.distance_travelled_to | number:2%></td>
                  <td align="right"><%operation.distance_travelled_to-operation.distance_travelled_from | number:2%></td>
                  <td align="right"><%operation.diesel_consumption | number:2%></td>
                  <td align="right"><%operation.gas_consumption | number:2%></td>
                  <td align="right"><%operation.oil_consumption | number:2%></td>
                  <td align="right"><%operation.number_loads | number:2%></td>
                  <td align="center"> <a href="#"> Edit </a> | <a href="#"> Delete </a> </td>
                </tr>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
      </div>
    </section>

    <script type="text/javascript">
$(function () {

  $('.select2').select2();

//   $('#datepicker').datepicker({
//    autoclose: true
//   })
});
</script>