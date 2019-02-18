<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><span class="fa fa-file-text"> </span> Utilization </h1><br>
    
  <ol class="breadcrumb">
    <li><a href="../../index.html"><i class="fa fa-th"></i> Dashboard</a></li>
    <li><i class="fa fa-tags"></i> Asset Database</li>
    <li class="active">Utilization</li>
  </ol>
</section>  

<!-- Main content -->
<section class="content">
  <div class="row">
    <div id="button-top" class="col-md-12"> 
<!-- BUTTONS -->
      <button class="btn btn-primary" data-toggle="collapse" data-target="#filter" data-parent="#btn-top">
          <span class="glyphicon glyphicon-refresh"></span> Generate
      </button> <br>

<!-- FILTER DISPLAY -->
      <div id="filter" class="collapse"><br>
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Generate Utilization</h3>
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
            <div class="col-sm-2">

              <select style="width: 100%;" ng-model="uc.utilizationDetails.request_type">
                <option value="">--Select Request Type--</option>
                <option value="Office">Office</option>
                <option value="Project">Project</option>
              </select>
            </div>
            <div class="col-sm-3">

              <select style="width: 100%;" ng-model="uc.utilizationDetails.reference_code">
                <option value="">--Select--</option>
                <option ng-if="uc.utilizationDetails.request_type=='Office'" value="<%organization.org_code%>" ng-repeat="organization in uc.organizations"><%organization.org_name%></option>
                <option ng-if="uc.utilizationDetails.request_type=='Project'" value="<%project.project_code%>" ng-repeat="project in uc.projects"><%project.name%></option>
              </select>
            </div>
            <div class="col-sm-3">

              <select class="form-control select2"  style="width: 100%;" ng-model="uc.utilizationDetails.employee_code">
                <option value=""> -- Select Employee -- </option>
                <option value="<%employee.employee_code%>" ng-repeat="employee in uc.employees">
                  <%employee.fname+' '+employee.lname%>
                </option>
              </select>

            </div>
            <div class="col-sm-1">
              <button type="button" class="btn btn-primary btn-flat" ng-click="uc.newUtilizationBtn(uc.utilizationDetails);uc.toggle()">Generate</button></div>
          </div>
        </form>
      </div>
      </div>
      <!-- /.box -->
      </div>
    </div>
  </div><br>       

<!-- TABLES -->
  <div class="row">
    <div class="col-md-12"> 
      <div class="box box-primary">
        <div class="box-body">
          <table datatable="ng" class="table table-bordered table-hover" width="100%">
            <thead>
            <tr>
              <th>Utilization Code</th>
              <th>Type</th>
              <th>Reference</th>
              <th>Employee</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="utilization in uc.utilizations">
              <td><a href="#" ui-sref="list-utilizationCopy({utilizationCode:utilization.utilization_code})"><b><%utilization.utilization_code%></b></a></td>
              <td><%utilization.request_type%></td>
              <td><%utilization.reference_name%></td>
              <td><%utilization.employee_name%></td>
            </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- MODAL CONTENTS -->
<script type="text/ng-template" id="utilizationInfo.modal"> 
  <div>
    <div class="modal-dialog" style="width:100%;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" ui-sref="list-utilization" ng-click="vm.ok()">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><li class="fa fa-file-o"></li> Utilization No: <b><%vm.formData.utilization_code%></b></h4>
        </div>
        <div class="modal-body">
          <p>Add requested supply items</p>
          <!-- Custom Tabs (Pulled to the right) -->
          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-body" ng-if="!vm.formData.status" >
                  <form ng-submit="vm.addNew()" >
                    <table class="table table-striped table-bordered" class="tbl_rs_supply">
                      <thead>
                        <tr>
                          <!-- <th><input type="checkbox" ng-model="selectedAll" ng-click="vm.checkAll()" /></th>  -->
                          <th>Supply Name</th>
                          <th width="25%">Description</th> 
                          <th width="9%">Stock Unit</th>
                          <th width="9%">Quantity</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr ng-repeat="personalDetail in vm.personalDetails" >
                          <!-- <td><input type="checkbox" ng-model="personalDetail.selected"/></td>  -->
                          <td>
                            <select class="form-control select2" style="width: 100%;" required="" ng-model="personalDetail.supply_name" ng-init="parentIndex = $index" ng-change="vm.selectSupply(parentIndex, personalDetail.supply_name)">
                              <option selected="selected" value="">- - select supply - -</option>
                              <option ng-value="supply.supply_code" ng-repeat="supply in vm.supplies"><%supply.supply_name%></option>
                            </select>
                          </td>
                          <td><input type="text" class="form-control" ng-model="personalDetail.supply_desc" disabled required/></td>
                          <td><input type="text" class="form-control" ng-model="personalDetail.supply_unit" disabled required="" /></td>
                          <td><input type="text" class="form-control" ng-model="personalDetail.supply_qty"  required/></td>
                        </tr>
                      </tbody>
                    </table>
                    <div class="form-group">
                      <div class="form-group">
                        <input type="button" class="btn btn-info pull-right" value="Submit Form" style="margin-right: 10px;" ng-click="vm.addUtilizationItems(vm.personalDetails)">
                       <!--  <button ng-hide="!vm.personalDetails.length" type="button" class="btn btn-danger pull-left fa fa-trash-o" ng-click="vm.remove()"></button>
                        <button type="submit" class="pull-left btn btn-primary fa fa-plus addnew"></button> -->
                    </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-body">
                  <form>
                    <table class="table table-bordered" class="tbl_list_rcpt">
                      <thead>
                        <tr>
                          <th>Supply Name</th> 
                          <th width="25%">Description</th>
                          <th width="9%">Stock Unit</th>
                          <th width="9%">Quantity</th>
                          <th ng-if="!vm.formData.status"></th>
                        </tr> 
                      </thead>
                      <tbody>
                        <tr ng-repeat="utilizationItem in vm.utilizationItems"> 
                          <td><%utilizationItem.supply_name%></td>
                          <td><%utilizationItem.item_description%></td>
                          <td><%utilizationItem.item_stock_unit%></td>
                          <td align="right"><%utilizationItem.item_quantity%></td> 
                          <td ng-if="!vm.formData.status">
                            <a href="#" ng-click="vm.removeUtilizationItem(utilizationItem.utilization_item_code)"><code class="text-red">REMOVE</code></a>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </form>
                </div>
              </div>
            </div>
          </div>

<!--           <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-body">
                  <form ng-model="vm.formData">
                      <h4><b>**Delivery Information</b></h4><br>
                      <div class="form-group col-sm-12">
                        <label for="controlnumber" class="col-sm-2 control-label">Received By</label>
                        <div class="col-sm-4">
                          <select class="form-control select2" style="width:100%;" required ng-model="vm.formData.received_by" ng-disabled="vm.formData.status">   
                              <option value="">- - - Select Employee - - -</option>
                              <option ng-value="employee.employee_code" ng-repeat="employee in vm.employees">
                                <% employee.fname + ' '+employee.lname%>
                              </option>
                          </select>
                        </div>
                        <label for="controlnumber" class="col-sm-2 control-label">Inspected by</label>
                        <div class="col-sm-4">
                          <select class="form-control select2" style="width:100%;" required ng-model="vm.formData.inspected_by" ng-disabled="vm.formData.status">   
                              <option value="">- - - Select Employee - - -</option>
                              <option ng-value="employee.employee_code" ng-repeat="employee in vm.employees">
                                <% employee.fname + ' '+employee.lname%>
                              </option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group col-sm-12">
                        <label class="col-sm-2 control-label">Date Received</label>
                        <div class="col-sm-4">
                        <div class="input-group date">
                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                        <input ng-disabled="vm.formData.status" type="text" class="form-control pull-right" id="" ng-model="vm.formData.date_received">
                      </div></div>

                        <label class="col-sm-2 control-label">Date Inspected</label>
                        <div class="col-sm-4">
                        <div class="input-group date">
                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                        <input ng-disabled="vm.formData.status" type="text" class="form-control pull-right" id="" ng-model="vm.formData.date_inspected">
                      </div></div>
                      </div>
                          <div class="form-group" >
                            <div class="form-group">
                              <input type="button" ng-if="!vm.formData.status" class="btn btn-info pull-right" value="Save Changes" style="margin-right: 30px;" ng-click="vm.updatePo(vm.formData)">
                            </div>
                          </div>
                  </form>
                </div>
              </div>
            </div>
          </div> -->

        </div>
        <div class="modal-footer">
          <!-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button> -->
          <a type="button" class="btn btn-info" ng-click="vm.printUtilizationDetails(vm.formData.utilization_code)" target="_blank" ng-href="<%vm.url%>"><li class="fa fa-print"></li> Print</a>
          
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
</script>