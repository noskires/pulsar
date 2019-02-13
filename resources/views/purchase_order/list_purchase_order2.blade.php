<section class="content-header">
      <h1><span class="fa fa-shopping-basket"> </span> Purchase Order</h1>
        <p>The list below displays purchase orders.</p>
      <ol class="breadcrumb">
        <li><a href="../../index.html"><i class="fa fa-th"></i> Dashboard</a></li>
        <li class="active">Purchase Order</li>
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
                    <input type="text" class="form-control pull-right" id="datepicker-rsdate" ng-model="poc.poDetails.date_requested">
                    </div>
                  </div>
                  <label for="requestpurpose" class="col-sm-2 control-label">Request Type</label>
                  <div class="col-sm-4">
                    <select style="width: 100%;" class="form-control select2" ng-model="poc.poDetails.request_type">
                      <option value="">--Select Request Type--</option>
                      <option value="Office">Office</option>
                      <option value="Project">Project</option>
                    </select>
                  </div>
                </div>

                <div class="form-group col-sm-12">
                  <label for="" class="col-sm-2 control-label">Reference(RIS)</label>
                  <div class="col-sm-4">

                    <select style="width: 100%;" class="form-control select2" ng-model="poc.poDetails.requisition_slip_code">
                      <option value="">Select RIS</option>
                      <option value="<%requisition.requisition_slip_code%>" ng-repeat="requisition in poc.requisitions"> <%requisition.requisition_slip_code%></option>
                      
                    </select>
                  </div>
                  <label for="" class="col-sm-2 control-label">Reference Name</label>
                  <div class="col-sm-4">
                    <select style="width: 100%;" class="form-control select2" ng-model="poc.poDetails.reference_code">
                      <option value="">Select Reference Name</option>
                      <option ng-if="poc.poDetails.request_type=='Office'" value="<%organization.org_code%>" ng-repeat="organization in poc.organizations"><%organization.org_name%></option>
                      <option ng-if="poc.poDetails.request_type=='Project'" value="<%project.project_code%>" ng-repeat="project in poc.projects"><%project.name%></option>
                    </select>
                  </div>
                </div>

                <div class="form-group col-sm-12">
                  <label for="assetname" class="col-sm-2 control-label">Supplier</label>
                  <div class="col-sm-4">
                    <select class="form-control select2" style="width: 100%;" required="" ng-model="poc.poDetails.supplier_code">
                      <option selected="selected" value="">Select Supplier</option>
                      <option ng-value="supplier.supplier_code" ng-repeat="supplier in poc.suppliers"><%supplier.supplier_name%></option>
                    </select>
                  </div>
                  <label for="assetname" class="col-sm-2 control-label">Requesting Employee</label>
                  <div class="col-sm-4">
                    <select class="form-control select2"  style="width: 100%;" ng-model="poc.poDetails.requesting_employee">
                      <option value=""> -- Select Employee -- </option>
                      <option value="<%employee.employee_code%>" ng-repeat="employee in poc.employees">
                        <%employee.fname+' '+employee.lname%>
                      </option>
                    </select>
                  </div>
                </div>

                <div class="form-group col-sm-12">
                  <label for="assetname" class="col-sm-2 control-label">Reference</label>
                  <div class="col-sm-4">
                    <input type="text" class="form-control pull-right"  ng-model="poc.poDetails.old_reference">
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
                  <button class="btn btn-large btn-success pull-right" data-toggle="confirmation"
                  data-btn-ok-label="Yes" data-btn-ok-icon="fa fa-check" data-btn-ok-class="btn-success"
                  data-btn-cancel-label="No" data-btn-cancel-icon="fa fa-times" data-btn-cancel-class="btn-danger"
                  data-title="Confirm data entry." data-content="Are you sure?" style="width: 40%;margin-left: 5%;" ng-click="poc.newPoBtn2(poc.poDetails)">CONFIRMATION</button>
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

                      <label for="assetname" class="col-sm-2 control-label">PO Status</label>
                      <div class="col-sm-1">
                      <label class="checkbox-inline"><input type="checkbox" value="">Open</label>
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
        <span class="glyphicon glyphicon-plus"></span> Create New PO
    </button> &nbsp; 
    <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#filter-rs">
        <span class="glyphicon glyphicon-filter"></span> Filter
    </button>
    <br><br>

    <!-- TABLES -->
  <div class="row">
    <div class="col-md-12"> 
      <div class="box box-primary">
        <div class="box-body">
          <table datatable="ng" class="table table-bordered table-hover" width="100%">
            <thead>
            <tr>
              <th>PO Number</th>
              <th>Old Reference</th>
              <th>Reference (RIS)</th>
              <th>Supplier Owner</th>
              <th>Supplier Name</th>
              <th>Address</th>
              <th>Requesting Office</th>
              <th>ID</th>
              <th>Requesting Employee</th>
              <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="po in poc.pos">
              <td><a href="#" ui-sref="list-poCopy2({poCode:po.po_code})"><b><%po.po_code%></b></a></td>
              <td><%po.old_reference%></td>
              <td ng-if="po.requisition_old_reference!=null"><%po.requisition_old_reference%></td>
              <td ng-if="po.requisition_old_reference==null"><%po.requisition_slip_code%></td>
              <td><%po.supplier_name%></td>
              <td><%po.supplier_owner%></td>
              <td><%po.address%></td>
              <td><%po.reference_name%></td>
              <td><%po.reference_id%></td>
              <td><%po.requesting_employee%></td>
              <td><%po.po_status%></td>
            </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

<!-- LIST RS -->
<!--       <div class="box">
            <div class="box-body">
              <table id="tbl_rs" class="table table-bordered table-hover" width="100%">
                <thead>
                <tr>
                  <th>PO No.</th>
                  <th>Reference (RIS)</th>
                  <th>Reference (PO)</th>
                  <th>Date</th>
                  <th>Supplier Name</th>
                  <th>Address</th>
                  <th>Owner</th>
                  <th>Requesting Office</th>
                  <th>ID</th>
                  <th>Requesting Employee</th>
                  <th>Status</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td><a href="#" data-toggle="modal" data-target="#modal-default"><b>PO-03102018-1</b></a></td>
                  <td>RIS-1234</td>
                  <td>PO-1234</td>
                  <td>04/30/2018</td>
                  <td>Supplier Name</td>
                  <td>Supplier Address</td>
                  <td>Supplier Owner</td>
                  <td>Requesting Office</td>
                  <td>Project ID/Office ID</td>
                  <td>Jay Bulan</td>
                  <td><small class="label bg-gray">Closed</small></td>
                </tr>
                <tr>
                  <td><a href="#" data-toggle="modal" data-target="#modal-default"><b>PO-03102018-1</b></a></td>
                  <td>RIS-1234</td>
                  <td>PO-1234</td>
                  <td>04/30/2018</td>
                  <td>Supplier Name</td>
                  <td>Supplier Address</td>
                  <td>Supplier Owner</td>
                  <td>Requesting Office</td>
                  <td>Project ID/Office ID</td>
                  <td>Jay Bulan</td>
                  <td><small class="label bg-green">Open</small></td>
                </tr>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
      <!-- </div> -->

        <div class="modal fade" id="modal-editrs">
          <div class="modal-dialog modal-md">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Reference</h4>
              </div>
              <div class="modal-body">
                <!-- Custom Tabs (Pulled to the right) -->
                <form class="form-horizontal" id="">
                  <div class="form-group col-sm-12">
                    <label for="controlnumber" class="col-sm-3 control-label">Reference</label>
                    <div class="col-sm-9"><input type="text" class="form-control" placeholder="Reference Here"></div>
                  </div>
                  <br><br>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button class="btn btn-large btn-success pull-right" data-toggle="confirmation"
                  data-btn-ok-label="Yes" data-btn-ok-icon="fa fa-check" data-btn-ok-class="btn-success"
                  data-btn-cancel-label="No" data-btn-cancel-icon="fa fa-times" data-btn-cancel-class="btn-danger"
                  data-title="Confirm data entry." data-content="Update entry?" style="width: 20%;"> Update
                </button>
                <!-- nav-tabs-custom -->
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->        

    </section>


<!-- MODAL CONTENTS -->
<script type="text/ng-template" id="poInfo.modal"> 
  <div>
    <div class="modal-dialog" style="width:100%;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" ui-sref="list-po2" ng-click="vm.ok()">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><li class="fa fa-file-o"></li> Purchase Order No: <b><%vm.formData.po_code%></b></h4>
        </div>
        <div class="modal-body">
          <p>Add requested supply items to specific Purchase Order</p>
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
                              <option selected="selected" value="0">- - select supply - -</option>
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
                        <input type="button" class="btn btn-info pull-right" value="Submit Form" style="margin-right: 10px;" ng-click="vm.addPoItems(vm.personalDetails)">
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
                        <tr ng-repeat="poItem in vm.poItems"> 
                          <td><%poItem.supply_name%></td>
                          <td><%poItem.item_description%></td>
                          <td><%poItem.item_stock_unit%></td>
                          <td align="right"><%poItem.item_quantity%></td> 
                          <td ng-if="!vm.formData.status">
                            <a href="#" ng-click="vm.removePoItem(poItem.po_item_code)"><code class="text-red">REMOVE</code></a>
                          </td>
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
          </div>

        </div>
        <div class="modal-footer">
          <!-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button> -->
          <a type="button" class="btn btn-info" ng-click="vm.printPurchaseOrderDetails(vm.formData.po_code)" target="_blank" ng-href="<%vm.url%>"><li class="fa fa-print"></li> Print</a>
          
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
</script>

<script type="text/javascript">
$(function () {

  $('.select2').select2();

//   $('#datepicker').datepicker({
//    autoclose: true
//   })
  alert('a')
});
</script>