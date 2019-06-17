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
  <div class="box">
    <div class="box-body">
      <div export-to-xlsx data="joc.jobOrders" bind-to-table="'tb-job-orders-copy'" filename="'Job Orders'"></div>
      <table datatable="ng" class="table table-bordered table-hover" name="tb-job-orders-copy" width="100%">
        <thead>
        <tr>
          <th>Control No.</th>
          <th>Job Order Date</th> 
          <th>Asset Name</th>
          <th>Asset Tag</th>
          <th>Location</th>
          <th>Requesting Employee</th>
          <th>Date Started</th>
        </tr>
        </thead>
        <tbody>
          <!-- data-toggle="modal" data-target="#modal-default" -->
        <tr ng-repeat="jobOrder in joc.jobOrders">
          <td><a href="#" ui-sref="list-joCopy({joCode:jobOrder.job_order_code})" ng-click="joc.jobOrderInfo(jobOrder.job_order_code)"><b><%jobOrder.job_order_code%></b></a></td>
          <td><%jobOrder.job_order_date%></td> 
          <td><%jobOrder.name%></td>
          <td><%jobOrder.tag%></td>
          <td><%jobOrder.municipality_text%></td>
          <td><%jobOrder.employee_name%></td>
          <td><%jobOrder.date_started%></td>
        </tr> 
        </tbody>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
    <!-- /.modal -->



<script type="text/ng-template" id="jobOrderInfo.modal">
<div>
<form class="form-horizontal" id="" ng-model="vm.formData.jobOrder">
  <div class="modal-dialog" style="width:100%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="vm.ok()" ui-sref="list-jo">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Job Order No: 1<b><%vm.formData.jobOrder.job_order_code%></b></h4>
      </div>
      <div class="modal-body">
          <!-- Custom Tabs (Pulled to the right) -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right">
              <li class="active"><a href="#tab_1-1" data-toggle="tab">Details</a></li>
              <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  Options <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Print</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#" ui-sref="requesition-asset-create({jobOrderCode:vm.formData.jobOrder.job_order_code})" ng-click="vm.ok()">Create R.S.</a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Close J.O. (Completed)</a></li>
                </ul>
              </li>
              <li class="pull-left header"><i class="fa fa-bus"></i> <%vm.formData.jobOrder.name%> : <%vm.formData.jobOrder.tag%><b><%vm.formData.jobOrder.asset_tag%></b></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1-1">
                <div class="pull-left image col-xs-3">
                  <img src="{{URL::to('assets/dist/img/dumptruck.jpg')}}" height="230px" class="img-square">
                </div>
                <div class="col-xs-9"> 
          <!-- general form elements -->
          <div class="box-header with-border">
            <h3 class="box-title"></h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
      
        <div class="box-body">
          <div class="form-group">
            <label for="jodate" class="col-sm-4 control-label">Job Order Date</label>
            <div class="col-sm-8"><input type="text" class="form-control" id="jodate" disabled="" ng-model="vm.formData.jobOrder.job_order_date"></div>
          </div>
          <div class="form-group">
            <label for="location" class="col-sm-4 control-label">Location</label>
            <div class="col-sm-8"><input type="text" class="form-control" id="location" disabled="" placeholder="Tuguegarao City" ng-model="vm.formData.jobOrder.location"></div>
          </div>
          <div class="form-group">
            <label for="requestingemp" class="col-sm-4 control-label">Requesting Employee</label>
            <div class="col-sm-8"><input type="text" class="form-control" id="requestingemp" disabled="" placeholder="" ng-model="vm.formData.jobOrder.employee_name"></div>
          </div>
          <div class="form-group">
            <label for="particulars" class="col-sm-4 control-label">Particulars</label>
            <div class="col-sm-8"><textarea name="particulars" rows="3" cols="30" ng-model="
              vm.formData.jobOrder.particulars"> </textarea></div></div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Date Started</label>
            <div class="col-sm-8">
            <div class="input-group date">
            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            <input type="text" class="form-control pull-right" id="datestarted" ng-model="vm.formData.jobOrder.date_started" datepicker autocomplete="off" readonly="readonly">
          </div></div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Date Completed</label>
            <div class="col-sm-8">
            <div class="input-group date">
            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            <input type="text" class="form-control pull-right" id="datecompleted" ng-model="vm.formData.jobOrder.date_completed" datepicker autocomplete="off" readonly="readonly">
          </div></div>
          </div>
          <div class="form-group">
            <label for="workduration" class="col-sm-4 control-label">Work Duration</label>
            <div class="col-sm-8"><input type="text" class="form-control" id="workduration" placeholder="Total Days" ng-model="vm.formData.jobOrder.work_duration"></div>
          </div>
          <div class="form-group">
          <label class="col-sm-4 control-label">Conducted by</label>
            <div class="col-sm-8">
              <select class="form-control select2" style="width: 100%;" ng-model="vm.formData.jobOrder.conducted_by">
                <option ng-value='employee.employee_id' ng-repeat="employee in vm.employees"><%employee.fname+' '+employee.lname%></option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="assessedby" class="col-sm-4 control-label">Assessed by</label>
            <div class="col-sm-8"> 
              <select class="form-control select2" style="width: 100%;" ng-model="vm.formData.jobOrder.assessed_by">
                <option ng-value='employee.employee_id' ng-repeat="employee in vm.employees"><%employee.fname+' '+employee.lname%></option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Date Assessed</label>
            <div class="col-sm-8">
            <div class="input-group date">
            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            <input type="text" class="form-control pull-right" id="datepicker2" ng-model="vm.formData.jobOrder.date_assessed" datepicker autocomplete="off" readonly="readonly">
          </div></div>
          </div>
          <div class="form-group">
          <label class="col-sm-4 control-label">Approved by</label>
            <div class="col-sm-8">
            
              <select class="form-control select2" style="width: 100%;" ng-model="vm.formData.jobOrder.approved_by">
                <option ng-value='employee.employee_id' ng-repeat="employee in vm.employees"><%employee.fname+' '+employee.lname%></option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Date Approved</label>
            <div class="col-sm-8">
            <div class="input-group date">
            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            <input type="text" class="form-control pull-right" id="datepicker2" ng-model="vm.formData.jobOrder.date_approved" datepicker autocomplete="off" readonly="readonly">
          </div></div>
          </div>
          <div class="form-group">
          <label class="col-sm-4 control-label">Inspected by</label>
            <div class="col-sm-8">
              <select class="form-control select2" style="width: 100%;" ng-model="vm.formData.jobOrder.inspected_by">
                <option ng-value='employee.employee_id' ng-repeat="employee in vm.employees"><%employee.fname+' '+employee.lname%></option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-4 control-label">Date Inspected</label>
            <div class="col-sm-8">
            <div class="input-group date">
            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            <input type="text" class="form-control pull-right datepicker" id="dateinspected" ng-model="vm.formData.jobOrder.date_inspected" datepicker autocomplete="off" readonly="readonly">
          </div></div>
          </div>
          <div class="form-group">
          <label class="col-sm-4 control-label">Tested by</label>
            <div class="col-sm-8">
              <select class="form-control select2" style="width: 100%;" ng-model="vm.formData.jobOrder.tested_by">
                <option ng-value='employee.employee_id' ng-repeat="employee in vm.employees"><%employee.fname+' '+employee.lname%></option>
              </select>
            </div>
          </div>
          <div class="form-group">
          <label class="col-sm-4 control-label">Accepted by</label>
            <div class="col-sm-8">
              <select class="form-control select2" style="width: 100%;" ng-model="vm.formData.jobOrder.accepted_by">
                <option ng-value='employee.employee_id' ng-repeat="employee in vm.employees"><%employee.fname+' '+employee.lname%></option>
              </select>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal" ng-click="vm.ok()" ui-sref="list-jo">Close</button>
          <button type="button" class="btn btn-info"><li class="fa fa-print"></li> Print</button>
          <button type="button" class="btn btn-primary" ng-click="vm.updateJobOrder(vm.formData.jobOrder)" ui-sref="list-jo">Save changes</button>
        </div>
      </div> <!-- body -->
    </div>  <!-- content -->
  </div> <!--  dialog -->
</form>
</div>
</script>

</section>

