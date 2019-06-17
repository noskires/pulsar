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
      <div export-to-xlsx data="joc.jobOrders" bind-to-table="'tb-job-orders'" filename="'Job Orders'"></div>
      <table datatable="ng" class="table table-bordered table-hover" name="tb-job-orders" width="100%">
        <thead>
        <tr>
          <th>Control No.</th>
          <th>Job Order Date</th> 
          <th>Asset Name</th>
          <th>Asset Tag</th>
          <th>Location</th>
          <th>Requesting Employee</th>
          <th>Organizational Unit</th>
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
          <td><%jobOrder.municipality_text+" "+jobOrder.province_text+" "+jobOrder.region_text_long%></td>
          <td><%jobOrder.employee_name%></td>
          <td><%jobOrder.organizational_unit_name%></td>
          <td><%jobOrder.date_started%></td>
        </tr> 
        </tbody>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
    <!-- /.modal -->



<script type="text/ng-template" id="jobOrderInfo.modal">
<div class="">
  <div class="modal-dialog" style="width:100%;">
  <div class="modal-content">
    <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="vm.ok()" ui-sref="list-jo">
      <span aria-hidden="true">&times;</span>
    </button>
    <h4 class="modal-title"><li class="fa fa-folder-open-o"></li><b> Job Order #:</b> (<%vm.formData.jobOrder.job_order_code%>)</h4>
    </div>
    <div class="modal-body">
    <!-- Custom Tabs (Pulled to the right) -->
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs pull-right">
      <li class="active"><a href="#tab_1-1" data-toggle="tab">Job Order Details</a></li>
      <li class="active"><a role="menuitem" tabindex="-1" href="#" ui-sref="requesition-asset-create({jobOrderCode:vm.formData.jobOrder.job_order_code})" ng-click="vm.ok()">Create R.S.</a></li>

      <li class="pull-left header"><h4><%vm.formData.jobOrder.name%> : <b><%vm.formData.jobOrder.tag%></b></h4></li>
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
            <div class="col-sm-9"><input type="text" class="form-control" id="jodate" disabled="" ng-model="vm.formData.jobOrder.job_order_date"></div>
          </div>
          <div class="form-group">
            <label for="requestpurpose" class="col-sm-3 control-label">Request Purpose</label>
            <div class="col-sm-9"><input type="text" class="form-control" id="requestpurpose" disabled="" placeholder="REPAIRS & MAINTENANCE -CONSTRUCTION EQUIPMENT"></div>
          </div>
          <div class="form-group">
            <label for="location" class="col-sm-3 control-label">Location</label>
            <div class="col-sm-9"><input type="text" class="form-control" id="location" disabled="" ng-model="vm.formData.jobOrder.municipality_text+' '+vm.formData.jobOrder.province_text+' '+vm.formData.jobOrder.region_text_long"></div>
          </div>
          <div class="form-group">
            <label for="requestingemp" class="col-sm-3 control-label">Requesting Employee</label>
            <div class="col-sm-9"><input type="text" class="form-control" id="requestingemp" disabled="" ng-model="vm.formData.jobOrder.employee_name"></div>
          </div>
          <div class="form-group">
            <label for="particulars" class="col-sm-3 control-label">Particulars</label>
          <div class="col-sm-9"><textarea name="particulars" rows="2" cols="109" ng-model="vm.formData.jobOrder.particulars"></textarea></div>
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
          <input type="text" class="form-control pull-right" id="datestarted" required="" ng-model="vm.formData.jobOrder.date_started">
          </div></div>
          </div>
          <div class="form-group">
          <label class="col-sm-12 control-label">Date Completed</label>
          <div class="col-sm-12">
          <div class="input-group date">
          <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
          <input type="text" class="form-control pull-right" id="datecompleted" required="" ng-model="vm.formData.jobOrder.date_completed">
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
                <option ng-value=employee.employee_code ng-repeat="employee in vm.employees"><%employee.fname+' '+employee.lname%></option>
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
                <option ng-value=employee.employee_code ng-repeat="employee in vm.employees"><%employee.fname+' '+employee.lname%></option>
              </select>
          </div>
          </div>
          <div class="form-group">
          <label class="col-sm-12 control-label">Date Assessed</label>
          <div class="col-sm-12">
          <div class="input-group date">
          <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            <input type="text" class="form-control pull-right" id="dateassessed" ng-model="vm.formData.jobOrder.date_assessed">
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
              <option ng-value=employee.employee_code ng-repeat="employee in vm.employees"><%employee.fname+' '+employee.lname%></option>
            </select>
          </div>
          </div>
          <div class="form-group">
          <label class="col-sm-12 control-label">Date Approved</label>
          <div class="col-sm-12">
          <div class="input-group date">
          <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
          <input type="text" class="form-control pull-right" id="dateapproved" required="" ng-model="vm.formData.jobOrder.date_approved">
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
              <option ng-value=employee.employee_code ng-repeat="employee in vm.employees"><%employee.fname+' '+employee.lname%></option>
            </select>
          </div>
          </div>
          <div class="form-group">
          <label class="col-sm-12 control-label">Date Inspected</label>
          <div class="col-sm-12">
          <div class="input-group date">
          <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
          <input type="text" class="form-control pull-right" id="dateinspected" ng-model="vm.formData.jobOrder.date_inspected">
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
              <option ng-value=employee.employee_code ng-repeat="employee in vm.employees"><%employee.fname+' '+employee.lname%></option>
            </select>
          </div>
          </div>
          <div class="form-group">
          <label class="col-sm-12 control-label">Accepted by</label>
          <div class="col-sm-12">
            <select class="form-control select2" style="width: 100%;" ng-model="vm.formData.jobOrder.accepted_by">
              <option ng-value=employee.employee_code ng-repeat="employee in vm.employees"><%employee.fname+' '+employee.lname%></option>
            </select>
          </div>
          </div>
          <div class="form-group">
          <label class="col-sm-12 control-label">Date Accepted</label>
          <div class="col-sm-12">
          <div class="input-group date">
          <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
          <input type="text" class="form-control pull-right" id="dateaccepted" ng-model="vm.formData.jobOrder.date_accepted">
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
      <button type="button" class="btn btn-default" ui-sref="requesition-asset-create({jobOrderCode:vm.formData.jobOrder.job_order_code})" ng-click="vm.ok()"><li class="fa fa-check"></li> Create J.O.</button>
      <a type="button" class="btn btn-info" ng-click="vm.printJobOrderDetails(vm.formData.jobOrder.job_order_code)" target="_blank" ng-href="<%vm.url%>"><li class="fa fa-print"></li> Print</a>
      <button type="button" class="btn btn-primary" ng-click="vm.updateJobOrder(vm.formData.jobOrder)" ui-sref="list-jo">Save changes</button>
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
</script>

</section>

