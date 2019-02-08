<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><span class="fa fa-bus"> </span> List of Requisitions</h1>
  <ol class="breadcrumb">
    <li><a href="../../index.html"><i class="fa fa-th"></i> Dashboard</a></li>
    <li class="active">Maintenance</li>
  </ol>
</section>

<!-- Main content -->

<section class="content">

       <div class="row">

<!-- NEW JOB ORDER SLIDE -->
        <div class="col-md-12"> 
          <div id="create-rs" class="collapse rs">
            <div class="panel panel-default">
              <div class="panel-body">
            <form class="form-horizontal" id="">
              <div class="box-body">
                <div class="form-group col-sm-12">
                  <label class="col-sm-2 control-label">Request Date</label>
                  <div class="col-sm-4">
                    <div class="input-group date">
                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                    <input type="text" class="form-control pull-right" id="datepicker-rsdate" ng-model="roc.risDetails.date_requested">
                    </div>
                  </div>
                  <label for="requestpurpose" class="col-sm-2 control-label">Request Type</label>
                  <div class="col-sm-4">
                    <select class="form-control select2" style="width: 100%;" ng-model="roc.risDetails.request_type" required="">
                      <option value="">--Select Request Type--</option>
                      <option value="Office">Office</option>
                      <option value="Project">Project</option>
                    </select>
                  </div>
                </div>

                <div class="form-group col-sm-12">
                  <label class="col-sm-2 control-label">Date Needed</label>
                  <div class="col-sm-4">
                    <div class="input-group date">
                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                    <input type="text" class="form-control pull-right" id="datepicker-dateneeded" ng-model="roc.risDetails.date_needed">
                    </div>
                  </div>
                  <label for="" class="col-sm-2 control-label">Reference Name</label>
                  <div class="col-sm-4">

                  <select class="form-control select2" style="width: 100%;"  ng-model="roc.risDetails.reference_code" required="">
                    <option value="">--Select--</option>
                    <option ng-if="roc.risDetails.request_type=='Office'" value="<%organization.org_code%>" ng-repeat="organization in roc.organizations"><%organization.org_name%></option>
                    <option ng-if="roc.risDetails.request_type=='Project'" value="<%project.project_code%>" ng-repeat="project in roc.projects"><%project.name%></option>
                  </select>

                  </div>
                </div>

                <div class="form-group col-sm-12">
                  <label for="" class="col-sm-2 control-label">Reference</label>
                  <div class="col-sm-4"><input type="text" class="form-control" ng-model="roc.risDetails.old_reference"></div>
                  <label for="assetname" class="col-sm-2 control-label">Requesting Employee</label>
                  <div class="col-sm-4">
                  <select class="form-control select2" style="width: 100%;" ng-model="roc.risDetails.requesting_employee">
                    <option value="<%employee.employee_code%>" ng-repeat="employee in roc.employees"><%employee.fname+' '+employee.lname%></option>
                  </select>
                  </div>
                </div>

                <div class="form-group col-sm-12">
                  
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="form-group col-sm-12">           
                  <div class="col-sm-8"></div>
                  <div class="col-sm-4">
                  <button class="btn btn-large btn-primary pull-right" data-toggle="confirmation"
                    data-btn-ok-label="Save" data-btn-ok-icon="fa fa-check" data-btn-ok-class="btn-success"
                    data-btn-cancel-label="Cancel" data-btn-cancel-icon="fa fa-times" data-btn-cancel-class="btn-danger"
                    data-title="Comfirmation" data-content="Are you sure?" ng-click="roc.newRequisitionSlip2(roc.risDetails)"> Confirmation
                    </button>
                  </div>
                </div>
              </div>
            </form>
              </div>
            </div>
          </div>
        </div>

<!-- FILTER SLIDE -->
        <div class="col-md-12"> 
          <div id="filter-rs" class="collapse rs">
            <div class="panel panel-default">
              <div class="panel-body">
                <form class="form-horizontal" id="">
                  <div class="box-body">
                    <div class="form-group col-sm-12">

                      <label class="col-sm-1 control-label">Date</label>
                      <div class="col-sm-2">
                      <div class="input-group date">
                      <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                      <input type="text" class="form-control pull-right" id="daterange-filter">
                      </div></div>

                      <!-- <label for="requestpurpose" class="col-sm-1 control-label">Repair of</label>
                      <div class="col-sm-4">
                      <select class="form-control select2" style="width: 100%;" required="">
                      <option selected="selected" value="1">All Asset Category</option>
                      <option value="3">Communication Equipment</option>
                      <option value="4">Construction Equipment</option>
                      </select></div> -->

                      <label for="assetname" class="col-sm-2 control-label">Requisition Status</label>
                      <div class="col-sm-1">
                      <label class="checkbox-inline"><input type="checkbox" value="">Closed</label>
                      </div>
                      <div class="col-sm-1">
                      <button class="btn btn-large btn-success">FILTER DISPLAY</button>
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
    <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#create-rs">
        <span class="glyphicon glyphicon-plus"></span> Create Office/Project Requisition
    </button> &nbsp; 
    <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#filter-rs">
        <span class="glyphicon glyphicon-filter"></span> Filter
    </button>
    <br><br>

<!-- LIST RS -->
      <div class="box">
            <div class="box-body">
              <!-- <table id="tbl_rs" class="table table-bordered table-hover" width="100%">
                <thead>
                <tr>
                  <th>Control No.</th>
                  <th>Reference</th>
                  <th>Date Requested</th>
                  <th>Date Needed</th>
                  <th>Request Type</th>
                  <th>Reference Name</th>
                  <th>ID</th>
                  <th>Requested by</th>
                  <th>Date Received</th>
                  <th>Inspected By</th>
                  <th>Date Inspected</th>
                  <th>Status</th>
                  <th>Options</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td><a href="#" data-toggle="modal" data-target="#modal-default"><b>RS-03102018-1</b></a></td>
                  <td>0001</td>
                  <td>03/15/2018</td>
                  <td>04/30/2018</td>
                  <td>Request Type here</td>
                  <td>Reference Name here</td>
                  <td>ID1234</td>
                  <td>Mykee Caparas</td>
                  <td>03/12/2018</td>
                  <td>Jay Bulan</td>
                  <td>03/13/2018</td>
                  <td><small class="label bg-gray">Closed</small></td>
                  <td></td>
                </tr>
                
                </tbody>
              </table> -->

              <br>

              <table datatable="ng" class="table table-bordered table-hover" width="100%">
            <thead>
            <tr>
              <th>Control No.</th>
              <th>Old Reference</th>
              <th>Request Date</th>
              <th>Date Needed</th> 
              <th>Request Type</th>
              <th>Reference </th>
              <th>Reference</th>
              <th>ID</th>
              <th>Asset</th>
              <th>Received By</th>
              <th>Date Received</th>
              <th>Inspected By</th>
              <th>Date Inspected</th> 
              <th>Status</th> 
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="requisition in roc.requisitions">
              <td><a href="#" ui-sref="list-requesitionCopy2({requisitionSlipCode:requisition.requisition_slip_code})"><b><%requisition.requisition_slip_code%></b></a></td>
              <td><%requisition.old_reference%></td>
              <td><%requisition.date_requested%></td>
              <td><%requisition.date_needed%></td>  
              <td><%requisition.request_type%></td>  
              <td><%requisition.reference_code%></td>  
              <td><%requisition.reference_name%></td>  
              <td><%requisition.reference_id%></td>  
              <td><%requisition.asset_name%> <%requisition.asset_name%></td>  
              <td><%requisition.received_by_name%></td>  
              <td><%requisition.date_received%></td>  
              <td><%requisition.inspected_by_name%></td>  
              <td><%requisition.date_inspected%></td>  
              <td><%requisition.status%></td>  
            </tr> 
            
            </tbody>
          </table>
            </div>
            <!-- /.box-body -->
      </div>

      <br>

      <!-- MODAL POPUP -->
<script type="text/ng-template" id="requisitionSlipInfo.modal">
  <div>
    <div class="modal-dialog" style="width:100%;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" ui-sref="list-requesition2" ng-click="vm.ok()">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><li class="fa fa-file-o"></li> Requisition Control No: <b><%vm.formData.requisition_slip_code%></b></h4>
        </div>
        <div class="modal-body">
          <p>Add requested supply items to specific Requisition Slip</p>
          <!-- Custom Tabs (Pulled to the right) -->
          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-body" ng-if="vm.formData.status=='OPEN'" >
                  <form ng-submit="vm.addNew()" >
                    <table class="table table-striped table-bordered" class="tbl_rs_supply">
                      <thead>
                        <tr>
                          <th><input type="checkbox" ng-model="selectedAll" ng-click="vm.checkAll()" /></th> 
                          <th>Supply Name</th>
                          <th width="25%">Description</th>
                          <th width="9%">In Stock</th>
                          <th width="9%">Stock Unit</th>
                          <th width="9%">Quantity</th>
                          <th width="9%">Cost</th>
                          <th width="11%">Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr ng-repeat="personalDetail in vm.personalDetails" >
                          <td><input type="checkbox" ng-model="personalDetail.selected"/></td> 
                          <td>
                            <select class="form-control select2" style="width: 100%;" required="" ng-model="personalDetail.supply_name" ng-init="parentIndex = $index" ng-change="vm.selectSupply(parentIndex, personalDetail.supply_name)">
                              <option value="">- - select supply - -</option>
                              <option ng-value="supply.supply_code" ng-repeat="supply in vm.supplies"><%supply.supply_name%></option>
                            </select>
                          </td>
                          <td><input type="text" class="form-control" ng-model="personalDetail.supply_desc" disabled required/></td>
                          <td><input type="text" class="form-control" ng-model="personalDetail.supply_quantity" disabled required/></td>
                          <td><input type="text" class="form-control" ng-model="personalDetail.supply_unit" disabled required/></td>
                          <td><input type="text" class="form-control" ng-model="personalDetail.supply_qty" ng-keyup="vm.computeTotalPerSupply(parentIndex, personalDetail.supply_qty, personalDetail.supply_cost)" required/></td>
                          <td><input type="text" class="form-control" ng-model="personalDetail.supply_cost" ng-keyup="vm.computeTotalPerSupply(parentIndex, personalDetail.supply_qty, personalDetail.supply_cost)" required/></td>
                          <td><input type="text" class="form-control" ng-model="personalDetail.supply_total" ng-init="personalDetail.supply_total = vm.supply_qty[parentIndex]" required/></td>
                        </tr>
                      </tbody>
                    </table>
                    <div class="form-group">
                      <div class="form-group">
                        <input type="button" class="btn btn-info pull-right" value="Submit Form" style="margin-right: 10px;" ng-click="vm.addRequistionSlipItems(vm.personalDetails)">
                        <button ng-hide="!vm.personalDetails.length" type="button" class="btn btn-danger pull-left fa fa-trash-o" ng-click="vm.remove()"></button>
                        <button type="submit" class="pull-left btn btn-primary fa fa-plus addnew"></button>
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
                          <th width="9%">Cost</th>
                          <th width="7%">Total</th>
                          <th width="11%" ng-if="!vm.formData.status=='OPEN'"></th>
                        </tr> 
                      </thead>
                      <tbody>
                        <tr ng-repeat="requisitionSlipItem in vm.requisitionSlipItems"> 
                          <td><%requisitionSlipItem.supply_name%></td>
                          <td><%requisitionSlipItem.item_description%></td>
                          <td><%requisitionSlipItem.item_stock_unit%></td>
                          <td align="right"><%requisitionSlipItem.item_quantity%></td>
                          <td align="right"><%requisitionSlipItem.item_cost | number:2%></td>
                          <td align="right" ng-init="vm.supplyGrandTotal = vm.supplyGrandTotal + requisitionSlipItem.item_total"><%requisitionSlipItem.item_total | number:2%></td>
                          <td ng-if="!vm.formData.status=='OPEN'">
                            <!-- <a href="#" data-toggle="modal" data-target="#modal-edit"><code class="text-green">EDIT</code></a> -->
                            <a href="#" data-toggle="modal"  ng-click="vm.removeRequisitionSlipItem(requisitionSlipItem.requisition_slip_item_code, requisitionSlipItem.item_quantity, requisitionSlipItem.supply_code)"><code class="text-red">REMOVE</code></a>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="5" align="right"><b>GRAND TOTAL</b></td>
                          <td colspan="1" align="right"><b>₱<%vm.supplyGrandTotal | number:2%></b></td>
                          <td ng-if="!vm.formData.status=='OPEN'"></td>
                        </tr>
                      </tbody>
                    </table>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-body">
                  <form ng-model="vm.formData">
                      <h4><b>**Withdrawal Information</b></h4><br>
                      <div class="form-group col-sm-12">
                        <label for="controlnumber" class="col-sm-2 control-label">Received By</label>
                        <div class="col-sm-4">
                          <select class="form-control select2" style="width:100%;" required ng-model="vm.formData.received_by" ng-disabled="vm.formData.status=='CLOSED'">   
                              <option value="">- - - Select Employee - - -</option>
                              <option ng-value="employee.employee_code" ng-repeat="employee in vm.employees">
                                <% employee.fname + ' '+employee.lname%>
                              </option>
                          </select>
                        </div>
                        <label for="controlnumber" class="col-sm-2 control-label">Inspected by</label>
                        <div class="col-sm-4">
                          <select class="form-control select2" style="width:100%;" required ng-model="vm.formData.inspected_by" ng-disabled="vm.formData.status=='CLOSED'">   
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
                        <input ng-disabled="vm.formData.status=='CLOSED'" type="text" class="form-control pull-right" id="" ng-model="vm.formData.date_received">
                      </div></div>

                        <label class="col-sm-2 control-label">Date Inspected</label>
                        <div class="col-sm-4">
                        <div class="input-group date">
                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                        <input ng-disabled="vm.formData.status=='CLOSED'" type="text" class="form-control pull-right" id="" ng-model="vm.formData.date_inspected">
                      </div></div>
                      </div>
                          <div class="form-group" >
                            <div class="form-group">
                              <input type="button" ng-if="vm.formData.status=='OPEN'" class="btn btn-info pull-right" value="Save Changes" style="margin-right: 30px;" ng-click="vm.withdrawal(vm.formData)">
                            </div>
                          </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <!-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button> -->
          <a type="button" class="btn btn-info" ng-click="vm.printRequisitionDetails(vm.formData.requisition_slip_code)" target="_blank" ng-href="<%vm.url%>"><li class="fa fa-print"></li> Print</a>
          
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
</script>

    </section>




<!-- MODAL POPUP -->
<script type="text/ng-template" id="requisitionSlipInfo.modal">
  <div>
    <div class="modal-dialog" style="width:100%;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" ui-sref="list-requesition2" ng-click="vm.ok()">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><li class="fa fa-file-o"></li> Requisition Control No: <b><%vm.formData.requisition_slip_code%></b></h4>
        </div>
        <div class="modal-body">
          <p>Add requested supply items to specific Requisition Slip</p>
          <!-- Custom Tabs (Pulled to the right) -->
          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-body" ng-if="!vm.formData.status" >
                  <form ng-submit="vm.addNew()" >
                    <table class="table table-striped table-bordered" class="tbl_rs_supply">
                      <thead>
                        <tr>
                          <th><input type="checkbox" ng-model="selectedAll" ng-click="vm.checkAll()" /></th> 
                          <th>Supply Name</th>
                          <th width="25%">Description</th>
                          <th width="9%">In Stock</th>
                          <th width="9%">Stock Unit</th>
                          <th width="9%">Quantity</th>
                          <th width="9%">Cost</th>
                          <th width="11%">Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr ng-repeat="personalDetail in vm.personalDetails" >
                          <td><input type="checkbox" ng-model="personalDetail.selected"/></td> 
                          <td>
                            <select class="form-control select2" style="width: 100%;" required="" ng-model="personalDetail.supply_name" ng-init="parentIndex = $index" ng-change="vm.selectSupply(parentIndex, personalDetail.supply_name)">
                              <option value="">- - select supply - -</option>
                              <option ng-value="supply.supply_code" ng-repeat="supply in vm.supplies"><%supply.supply_name%></option>
                            </select>
                          </td>
                          <td><input type="text" class="form-control" ng-model="personalDetail.supply_desc" disabled required/></td>
                          <td><input type="text" class="form-control" ng-model="personalDetail.supply_quantity" disabled required/></td>
                          <td><input type="text" class="form-control" ng-model="personalDetail.supply_unit" disabled required/></td>
                          <td><input type="text" class="form-control" ng-model="personalDetail.supply_qty" ng-keyup="vm.computeTotalPerSupply(parentIndex, personalDetail.supply_qty, personalDetail.supply_cost)" required/></td>
                          <td><input type="text" class="form-control" ng-model="personalDetail.supply_cost" ng-keyup="vm.computeTotalPerSupply(parentIndex, personalDetail.supply_qty, personalDetail.supply_cost)" required/></td>
                          <td><input type="text" class="form-control" ng-model="personalDetail.supply_total" ng-init="personalDetail.supply_total = vm.supply_qty[parentIndex]" required/></td>
                        </tr>
                      </tbody>
                    </table>
                    <div class="form-group">
                      <div class="form-group">
                        <input type="button" class="btn btn-info pull-right" value="Submit Form" style="margin-right: 10px;" ng-click="vm.addRequistionSlipItems(vm.personalDetails)">
                        <button ng-hide="!vm.personalDetails.length" type="button" class="btn btn-danger pull-left fa fa-trash-o" ng-click="vm.remove()"></button>
                        <button type="submit" class="pull-left btn btn-primary fa fa-plus addnew"></button>
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
                          <th width="9%">Cost</th>
                          <th width="7%">Total</th>
                          <th width="11%" ng-if="!vm.formData.status"></th>
                        </tr> 
                      </thead>
                      <tbody>
                        <tr ng-repeat="requisitionSlipItem in vm.requisitionSlipItems"> 
                          <td><%requisitionSlipItem.supply_name%></td>
                          <td><%requisitionSlipItem.item_description%></td>
                          <td><%requisitionSlipItem.item_stock_unit%></td>
                          <td align="right"><%requisitionSlipItem.item_quantity%></td>
                          <td align="right"><%requisitionSlipItem.item_cost | number:2%></td>
                          <td align="right" ng-init="vm.supplyGrandTotal = vm.supplyGrandTotal + requisitionSlipItem.item_total"><%requisitionSlipItem.item_total | number:2%></td>
                          <td ng-if="!vm.formData.status">
                            <!-- <a href="#" data-toggle="modal" data-target="#modal-edit"><code class="text-green">EDIT</code></a> -->
                            <a href="#" data-toggle="modal"  ng-click="vm.removeRequisitionSlipItem(requisitionSlipItem.requisition_slip_item_code, requisitionSlipItem.item_quantity, requisitionSlipItem.supply_code)"><code class="text-red">REMOVE</code></a>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="5" align="right"><b>GRAND TOTAL</b></td>
                          <td colspan="1" align="right"><b>₱<%vm.supplyGrandTotal | number:2%></b></td>
                          <td ng-if="!vm.formData.status"></td>
                        </tr>
                      </tbody>
                    </table>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-body">
                  <form ng-model="vm.formData">
                      <h4><b>**Withdrawal Information</b></h4><br>
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
                              <input type="button" ng-if="!vm.formData.status" class="btn btn-info pull-right" value="Save Changes" style="margin-right: 30px;" ng-click="vm.withdrawal(vm.formData)">
                            </div>
                          </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <!-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button> -->
          <a type="button" class="btn btn-info" ng-click="vm.printRequisitionDetails(vm.formData.requisition_slip_code)" target="_blank" ng-href="<%vm.url%>"><li class="fa fa-print"></li> Print</a>
          
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
</script>
