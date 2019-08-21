<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><span class="fa fa-folder-open"> </span> List of Job Orders</h1>
  <ol class="breadcrumb">
    <li><a href="../../index.html"><i class="fa fa-th"></i> Dashboard</a></li>
    <li class="active">Job Order</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- NEW JOB ORDER POPUP -->

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
                  <input type="text" class="form-control pull-right" id="datepicker-addoperating">
                </div></div>
                </div>
                <div class="form-group col-sm-12">
                  <label class="col-sm-3 control-label">Equipment Name</label>
                  <div class="col-sm-9">
                  <select class="form-control select2" style="width: 100%;" required="">
                    <option value="" selected hidden>Select Equipment</option>
                    <option value="1">DUMPTRUCK 1</option>
                    <option value="2">LOADER 1</option>
                    <option value="3">MIXER 1</option>
                  </select></div>
                </div>
                <div class="form-group col-sm-12">
                  <label class="col-sm-3 control-label">Project Name</label>
                  <div class="col-sm-9">
                  <select class="form-control select2" style="width: 100%;" required="">
                    <option value="" selected hidden>Select Project</option>
                    <option value="1">BUNTUN BRIDGE PROJECT</option>
                    <option value="2">LARION ROAD</option>
                  </select></div>
                </div>
                <div class="form-group col-sm-12">
                  <label for="activity" class="col-sm-3 control-label">Activity/ Remarks</label>
                  <div class="col-sm-9"><textarea class="col-sm-9 form-control" id="dv-desc" rows="2"></textarea></div>
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
                      <div class="input-group-addon">From</div>
                      <input type="text" class="form-control timepicker">
                    </div>
                  </div>
                </div>
                <div class="col-sm-2 bootstrap-timepicker">
                  <div class="form-group col-sm-12">
                    <label>Operating Time</label>
                    <div class="input-group">
                      <div class="input-group-addon">To</div>
                      <input type="text" class="form-control timepicker">
                    </div>
                  </div>
                </div>
                <div class="col-sm-3">
                  <div class="form-group col-sm-12">
                    <label>Total Operating Time (HRS)</label>
                    <div class="input-group">
                      <input type="text" class="form-control">
                    </div>
                  </div>
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
                      <input type="number" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="col-sm-2">
                  <div class="form-group col-sm-12">
                    <label>Distance Travelled</label>
                    <div class="input-group">
                      <div class="input-group-addon">To</div>
                      <input type="number" class="form-control">
                    </div>
                  </div>
                </div>
                <div class="col-sm-2">
                  <div class="form-group col-sm-12">
                    <label>Distance Travelled (KM)</label>
                    <div class="input-group">
                      <input type="number" class="form-control">
                    </div>
                  </div>
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
                  <div class="col-sm-3"><input type="text" class="form-control" id="gas" placeholder="" required=""></div>
                  <label for="gas" class="col-sm-3 control-label">Gas Consumption</label>
                  <div class="col-sm-3"><input type="text" class="form-control" id="gas" placeholder="" required=""></div>
                </div>
                <div class="form-group col-sm-12">
                  <label for="oil" class="col-sm-3 control-label">Oil Consumption</label>
                  <div class="col-sm-3"><input type="text" class="form-control" id="oil" placeholder="" required=""></div>
                  <label for="oil" class="col-sm-3 control-label">Number of Loads</label>
                  <div class="col-sm-3"><input type="text" class="form-control" id="oil" placeholder="For Dump Truck only"></div>
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
                  data-title="Confirm data entry." data-content="Are you sure?"> CONFIRMATION
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
              <div class="form-group col-sm-12"">
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


    <div class="col-md-12"> 
      <div id="create-jo" class="collapse department">
        <div class="panel panel-default">
          <div class="panel-body">
        <form class="form-horizontal" id="">
          <div class="box-body">
            <div class="form-group col-sm-12">
              <label for="controlnumber" class="col-sm-2 control-label">Control Number</label>
              <div class="col-sm-4"><input type="text" class="form-control" id="controlnumber" placeholder="JO-03122018-1" disabled></div>
              <label for="requestpurpose" class="col-sm-2 control-label">Repair of</label>
              <div class="col-sm-4">
            
                <select class="form-control select2" style="width: 100%;" required="" ng-model="jo.details.category" ng-change="joc.selectCategory(jo.details.category)">
                  <option selected="selected" value="">- - SELECT CATEGORY - -</option>
                  <option ng-value="assetCategory.asset_category_code" ng-repeat="assetCategory in joc.assetCategories"><%assetCategory.asset_category_name%></option>
                </select>

              </div>
            </div>

            <div class="form-group col-sm-12">
              <label class="col-sm-2 control-label">Job Order Date</label>
              <div class="col-sm-4">
                <div class="input-group date">
                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                <input type="text" class="form-control pull-right" required="" ng-model="jo.details.orderDate" datepicker autocomplete="off" readonly="">
                </div>
              </div>
              <label for="assetname" class="col-sm-2 control-label">Asset Name</label>
              <div class="col-sm-4">

              <select class="form-control select2" style="width: 100%;" required="" ng-model="jo.details.assetCode">
                <option selected="selected" value="">- - SELECT EQUIPMENT - -</option>
                <option ng-value="asset.asset_code" ng-repeat="asset in joc.assets"><%asset.name + " : " + asset.code%></option> 
              </select>

              </div>
            </div>

            <div class="form-group col-sm-12">
              <label for="assettag" class="col-sm-2 control-label">Reference</label>
              <div class="col-sm-4"><input type="text" class="form-control" ng-model="jo.details.reference" required="" ></div>
              <label for="assettag" class="col-sm-2 control-label">Requesting Employee</label>
              <div class="col-sm-4">
                <select class="form-control select2" style="width: 100%;" ng-model="jo.details.employee_code" required="" >
                  <option value="" selected disabled hidden>- - SELECT EMPLOYEE - -</option>
                  <option value="<%employee.employee_code%>" ng-repeat="employee in joc.employees"><%employee.employee_name%></option>
                </select>
              </div>
            </div>
 
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <div class="form-group col-sm-12">           
              <div class="col-sm-8"></div>
              <div class="col-sm-4">
              <button class="btn btn-large btn-success pull-right" data-toggle="confirmation"
              data-btn-ok-label="Yes" data-btn-ok-icon="fa fa-check" data-btn-ok-class="btn-success"
              data-btn-cancel-label="No" data-btn-cancel-icon="fa fa-times" data-btn-cancel-class="btn-danger"
              data-title="Confirm data entry." data-content="Are you sure?" style="width: 40%;margin-left: 5%;" ng-click="joc.createJoBtn(jo.details)">CONFIRMATION 2</button>
              </div>
            </div>
          </div>
        </form>
          </div>
        </div>
      </div>
    </div>

<!-- FILTER POPUP -->
    <div class="col-md-12"> 
      <div id="filter" class="collapse department">
        <div class="panel panel-default">
          <div class="panel-body">
            <form class="form-horizontal" id="">
              <div class="box-body">
                <div class="form-group col-sm-12">

                  <label class="col-sm-1 control-label">Date</label>
                  <div class="col-sm-2">
                  <div class="input-group date">
                  <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                  <input type="text" class="form-control pull-right" datepicker2 id="daterange-filter" ng-model="filter.date_started" ng-init="filter.date_started=''" readonly autocomplete="off">
                  </div>
                  </div>

                  <label for="requestpurpose" class="col-sm-1 control-label">Repair of</label>
                  <div class="col-sm-4">

                  <select class="form-control select2" style="width: 100%;" ng-model="filter.asset_category" ng-init="filter.asset_category=''">
                    <option selected="selected" value="">- - SELECT CATEGORY - -</option>
                    <option ng-value="assetCategory.asset_category_code" ng-repeat="assetCategory in joc.assetCategories"><%assetCategory.asset_category_name%></option>
                  </select>
                  </div>

                  <label for="assetname" class="col-sm-1 control-label">Job Order Status</label>
                  <div class="col-sm-2">

                  <select class="form-control select2" style="width: 100%;" ng-model="filter.job_order_status" ng-init="filter.job_order_status='1'">
                    <option value="">Job Order Status</option>
                    <option value="3">All</option>
                    <option value="1">On-going</option>
                    <option value="2">Finished</option>
                  </select>

                  </div>

                  <div class="col-sm-1">
                  <button class="btn btn-large btn-success" ng-click="joc.filterJo(filter)">FILTER DISPLAY</button>
                  </div>

                </div>
              </div>
              <!-- /.box-body -->
            </form>
          </div>
        </div>
      </div>
    </div>
</div>

<!-- BUTTONS -->
<button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#create-jo">
    <span class="glyphicon glyphicon-plus"></span> Create Job Order
</button> &nbsp; 
<button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#filter">
    <span class="glyphicon glyphicon-filter"></span> Filter
</button>
<br><br>

<!-- LIST OF JO -->      
  <div class="box">
  <div class="box-body">
    <div export-to-xlsx data="joc.jobOrders" bind-to-table="'tb-job-orders-2'" filename="'Job Orders'"></div>
    <table datatable="ng" class="table table-bordered table-hover" name="tb-job-orders-2" width="100%">
    <thead>
    <tr>
      <th>Control No.</th>
      <th>Job Order Date</th> 
      <th>Asset Name</th>
      <th>Asset ID</th>
      <th>Location</th>
      <th>Requesting Employee</th>
      <th>Organizational Unit</th>
      <th>Date Started</th>
      <th>Reference</th>
    </tr>
    </thead>
    <tbody>
      <!-- data-toggle="modal" data-target="#modal-default" -->
    <tr ng-repeat="jobOrder in joc.jobOrders">
      <td><a href="#" ui-sref="list-joCopy2({joCode2:jobOrder.job_order_code})" ng-click="joc.jobOrderInfo(jobOrder.job_order_code)"><b><%jobOrder.job_order_code%></b></a></td>
      <td><%jobOrder.job_order_date%></td> 
      <td><%jobOrder.name%></td>
      <td><%jobOrder.code%></td>
      <td><%jobOrder.municipality_text%> <%jobOrder.province_text%> <%jobOrder.region_text_long%></td>
      <td><%jobOrder.employee_name%></td>
      <td><%jobOrder.organizational_unit_name%></td>
      <td><%jobOrder.date_started%></td>
      <td><%jobOrder.old_reference%></td>
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

<script type="text/ng-template" id="jobOrderInfo2.modal">
<div class="">
  <div class="modal-dialog" style="width:100%;">
  <div class="modal-content">
    <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="vm.ok()" ui-sref="list-jo2">
      <span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title"><li class="fa fa-folder-open-o"></li><b> Job Order #:</b> (<%vm.formData.jobOrder.job_order_code%>)</h4>
    </div>
    <div class="modal-body">
    <!-- Custom Tabs (Pulled to the right) -->
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs pull-right">
      <li class="active"><a href="#tab_1-1" data-toggle="tab">Job Order Details</a></li>
      <li class="active"><a role="menuitem" tabindex="-1" href="#" ui-sref="requesition-asset-create2({jobOrderCode:vm.formData.jobOrder.job_order_code})" ng-click="vm.ok()">Create R.S.</a></li>

      <li class="pull-left header"><h4><%vm.formData.jobOrder.name%> : <b><%vm.formData.jobOrder.code%></b></h4></li>
      </ul>
      <br>
      <div class="tab-content">
      <div class="tab-pane active" id="tab_1-1">
      <!--  ROW TOP  -->
        <div class="row">
        <div class="col-sm-3"> 
          <div class="pull-left image">
          <img src="assets/dist/img/dumptruck.jpg" height="250" width="330" class="img-square">
          </div>
        </div>
        <form class="form-horizontal" id="">
        <div class="col-sm-9"> 
          <div class="box-body">
          <div class="form-group">
            <label for="jodate" class="col-sm-3 control-label">Job Order Date</label>
            <div class="col-sm-9"><%vm.formData.jobOrder.job_order_date%></div>
          </div>
          <!-- <div class="form-group">
            <label for="requestpurpose" class="col-sm-3 control-label">Request Purpose</label>
            <div class="col-sm-9"><input type="text" class="form-control" id="requestpurpose" disabled="" placeholder="REPAIRS & MAINTENANCE -CONSTRUCTION EQUIPMENT"></div>
          </div> -->
          <div class="form-group">
            <label for="location" class="col-sm-3 control-label">Location</label>
            <div class="col-sm-9"> <%vm.formData.jobOrder.municipality_text+' '+vm.formData.jobOrder.province_text+' '+vm.formData.jobOrder.region_text_long%> </div>
          </div>
          <div class="form-group">
            <label for="requestingemp" class="col-sm-3 control-label">Requesting Employee</label>
            <div class="col-sm-9">
              <!-- <input type="text" class="form-control" id="requestingemp" disabled="" ng-model="vm.formData.jobOrder.employee_name"> -->
              <!-- <%vm.formData.jobOrder.requested_by%> -->
         

               <select class="form-control select2" style="width: 100%;" required="" ng-model="vm.formData.jobOrder.requested_by" >
                <option value="">- - select employee - -</option>
                <option ng-value="<%employee.employee_code%>" ng-repeat="employee in vm.employees"> <%employee.employee_name%></option>
              </select> 
            </div>
          </div>
          <div class="form-group">
            <label for="particulars" class="col-sm-3 control-label">Particulars</label>
          <div class="col-sm-9"><textarea class="form-control name="particulars" rows="2"  ng-model="vm.formData.jobOrder.particulars"></textarea></div>
          </div>
          </div>
        </div>
        </div>
      <!--  END ROW TOP  -->
      <!--  ROW BOT  -->
        <div class="row">     
      <!--  STARTED  --> 
        <div class="col-sm-4"> 
        <div class="box-body">
          <div class="form-group">
          <label class="col-sm-12 control-label">Date Started</label>
          <div class="col-sm-12">
          <div class="input-group date">
          <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
          <input type="text" class="form-control pull-right" required="" datepicker ng-model="vm.formData.jobOrder.date_started" autocomplete="off" readonly="">
          </div></div>
          </div>
          <div class="form-group">
          <label class="col-sm-12 control-label">Date Completed</label>
          <div class="col-sm-12">
          <div class="input-group date">
          <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
          <input type="text" class="form-control pull-right" id="datecompleted" required="" ng-model="vm.formData.jobOrder.date_completed" datepicker autocomplete="off" readonly="">
          </div></div>
          </div>
          <div class="form-group">
          <label for="workduration" class="col-sm-12 control-label">Work Duration</label>
          <div class="col-sm-7"><input type="Number" class="form-control" id="workduration" placeholder="Total Days" ng-model="vm.formData.jobOrder.work_duration"></div>
          </div>
          <div class="form-group">
          <label class="col-sm-12 control-label">Conducted by</label>
          <div class="col-sm-12">
              <select class="form-control select2" style="width: 100%;" ng-model="vm.formData.jobOrder.conducted_by">
                <option value="">- - SELECT EMPLOYEE - -</option>
                <option ng-value=employee.employee_code ng-repeat="employee in vm.employees"><%employee.employee_name%></option>
              </select>
          </div>
          </div>
        </div>
        </div>
        <!-- END JOB STARTED  -->
        <!-- ASSESED -->        
        <div class="col-sm-4"> 
        <div class="box-body">
          <div class="form-group">
          <label for="assessedby" class="col-sm-12 control-label">Assessed by</label>
          <div class="col-sm-12">
              <select class="form-control select2" style="width: 100%;" ng-model="vm.formData.jobOrder.assessed_by">
                <option value="">- - SELECT EMPLOYEE - -</option>
                <option ng-value=employee.employee_code ng-repeat="employee in vm.employees"><%employee.employee_name%></option>
              </select>
          </div>
          </div>
          <div class="form-group">
          <label class="col-sm-12 control-label">Date Assessed</label>
          <div class="col-sm-12">
          <div class="input-group date">
          <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            <input type="text" class="form-control pull-right" id="dateassessed" datepicker ng-model="vm.formData.jobOrder.date_assessed" autocomplete="off" readonly="">
          </div></div>
          </div>
        </div>
        </div> 
        <!-- END ASSESED -->        
        <!-- APPROVED -->        
        <div class="col-sm-4"> 
        <div class="box-body">                   
          <div class="form-group">
          <label class="col-sm-12 control-label">Approved by</label>
          <div class="col-sm-12">
            <select class="form-control select2" style="width: 100%;" ng-model="vm.formData.jobOrder.approved_by">
              <option value="">- - SELECT EMPLOYEE - -</option>
              <option ng-value=employee.employee_code ng-repeat="employee in vm.employees"><%employee.employee_name%></option>
            </select>
          </div>
          </div>
          <div class="form-group">
          <label class="col-sm-12 control-label">Date Approved</label>
          <div class="col-sm-12">
          <div class="input-group date">
          <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
          <input type="text" class="form-control pull-right" id="dateapproved" required="" datepicker ng-model="vm.formData.jobOrder.date_approved" autocomplete="off" readonly="">
          </div></div>
          </div>
        </div>
        </div>
        <!-- END APPROVED -->       
        <!-- INSPECTED -->
        <div class="col-sm-4"> <hr>
        <div class="box-body">
          <div class="form-group">
          <label class="col-sm-12 control-label">Inspected by</label>
          <div class="col-sm-12">
            <select class="form-control select2" style="width: 100%;" ng-model="vm.formData.jobOrder.inspected_by" >
              <option value="">- - SELECT EMPLOYEE - -</option>
              <option ng-value=employee.employee_code ng-repeat="employee in vm.employees"><%employee.employee_name%></option>
            </select>
          </div>
          </div>
          <div class="form-group">
          <label class="col-sm-12 control-label">Date Inspected</label>
          <div class="col-sm-12">
          <div class="input-group date">
          <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
          <input type="text" class="form-control pull-right" id="dateinspected" datepicker ng-model="vm.formData.jobOrder.date_inspected" autocomplete="off" readonly="">
          </div></div>
          </div>
        </div>
        </div>  
        <!-- END INSPECTED -->        
        <!-- TESTED -->
        <div class="col-sm-4"> <hr>
        <div class="box-body">
          <div class="form-group">
          <label class="col-sm-12 control-label">Tested by</label>
          <div class="col-sm-12">
            <select class="form-control select2" style="width: 100%;" ng-model="vm.formData.jobOrder.tested_by">
              <option value="">- - SELECT EMPLOYEE - -</option>
              <option ng-value=employee.employee_code ng-repeat="employee in vm.employees"><%employee.employee_name%></option>
            </select>
          </div>
          </div>
          <div class="form-group">
          <label class="col-sm-12 control-label">Accepted by</label>
          <div class="col-sm-12">
            <select class="form-control select2" style="width: 100%;" ng-model="vm.formData.jobOrder.accepted_by">
              <option value="">- - SELECT EMPLOYEE - -</option>
              <option ng-value=employee.employee_code ng-repeat="employee in vm.employees"><%employee.employee_name%></option>
            </select>
          </div>
          </div>
          <div class="form-group">
          <label class="col-sm-12 control-label">Date Accepted</label>
          <div class="col-sm-12">
          <div class="input-group date">
          <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
          <input type="text" class="form-control pull-right" id="dateaccepted" datepicker ng-model="vm.formData.jobOrder.date_accepted" autocomplete="off" readonly="">
          </div></div>
          </div>
        </div>
        </div>
        <!-- END TESTED -->
        </div>
      <!-- END ROW -->
      </form>
      </div>
      <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content -->
      <div class="modal-footer">
      <button type="button" class="btn btn-default pull-left" ng-click="vm.ok()" ui-sref="list-jo">Close Window</button>
      <!-- <button type="button" class="btn btn-default" ui-sref="requesition-asset-create({jobOrderCode:vm.formData.jobOrder.job_order_code})" ng-click="vm.ok()"><li class="fa fa-check"></li> Create J.O.</button> -->
      <a type="button" class="btn btn-info" ng-click="vm.printJobOrderDetails(vm.formData.jobOrder.job_order_code)" target="_blank" ng-href="<%vm.url%>"><li class="fa fa-print"></li> Print </a>
      <button type="button" class="btn btn-primary" ng-click="vm.updateJobOrder(vm.formData.jobOrder)" ui-sref="list-jo2">Save changes</button>
      </div>
    </div>
    </div>   
  </div>
  <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
</div>

<script type="text/javascript">
$(function () {

  $('.select2').select2();

//   $('#datepicker').datepicker({
//    autoclose: true
//   })
});
</script>

</script>





