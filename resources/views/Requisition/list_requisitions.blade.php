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
  <div class="box">
        <div class="box-body">
          <table datatable="ng" class="table table-bordered table-hover" width="100%">
            <thead>
            <tr>
              <th>Control No.</th>
              <th>Request Date</th>
              <th>Date Needed</th> 
              <th>Request Type</th>
              <th>Reference</th>
              <th>Received By</th>
              <th>Date Received</th>
              <th>Inspected By</th>
              <th>Date Inspected</th> 
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="requisition in rc.requisitions">
              <td><a href="#" ui-sref="list-requesitionCopy({requisitionSlipCode:requisition.requisition_slip_code})"><b><%requisition.requisition_slip_code%></b></a></td>
              <td><%requisition.date_requested%></td>
              <td><%requisition.date_needed%></td>  
              <td><%requisition.request_type%></td>  
              <td><%requisition.reference_code%></td>  
              <td>Mykee Caparas</td>
              <td>03/12/2018</td>
              <td>Jay Bulan</td>
              <td>03/13/2018</td> 
            </tr> 
            
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
  </div>
  <!-- MODAL POPUP -->
    <div class="modal fade" id="modal-default">
      <div class="modal-dialog modal-lg" style="width: 1000px;">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Requisition Control No: <b>RS-03102018-1</b></h4>
          </div>
          <div class="modal-body">
            <p>Add requested supply items to specific Requisition Slip</p>
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
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Close RS (Withdrawal)</a></li>
                  </ul>
                </li>
                <li class="pull-left header"><i class="fa fa-file-text"></i> STR Ramon Proj</li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1-1">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="panel panel-default">
                        <div class="panel-body">
                          <form ng-submit="addNew()">
                            <table class="table table-striped table-bordered" class="tbl_rs_supply">
                              <thead>
                                <tr>
                                  <!-- <th><input type="checkbox" ng-model="selectedAll" ng-click="checkAll()" /></th> -->
                                  <th>Supply Name</th>
                                  <th width="15%">Supply Unit</th>
                                  <th width="9%">Request(Qty)</th>
                                  <th width="9%">Stock(Qty)</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr ng-repeat="personalDetail in personalDetails">
                                  <!-- <td><input type="checkbox" ng-model="personalDetail.selected"/></td> -->
                                  <td><select class="form-control select2" ng-model="personalDetail.suply_name" style="width:100%;" required/>
                                    <option selected="selected">Select Suply</option>
                                    <option>Dump Truck tires 3.0</option>
                                    <option>Tire Interior</option>
                                    </select></td>
                                  <td><input type="text" class="form-control" ng-model="personalDetail.suply_unit" required/></td>
                                  <td><input type="text" class="form-control" ng-model="personalDetail.request_qty" required/></td>
                                  <td><input type="text" class="form-control" ng-model="personalDetail.suply_qty" disabled="" /></td>
                                </tr>
                              </tbody>
                            </table>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary addnew pull-right" value="Add New" style="margin-right: 10px;">
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
                          <form ng-submit="addNew()">
                            <table class="table table-bordered" class="tbl_rs_supply">
                              <thead>
                                <tr>
                             <!-- <th><input type="checkbox" ng-model="selectedAll" ng-click="checkAll()" /></th> -->
                                  <th>Supply Name</th>
                                  <th width="15%">Supply Unit</th>
                                  <th width="9%">Request(Qty)</th>
                                  <th width="9%">Stock(Qty)</th>
                                  <th width="13%">Options</th>
                                </tr> 
                              </thead>
                              <tbody>
                                <tr>
                                  <!-- <td><input type="checkbox" ng-model="personalDetail.selected"/></td> -->
                                  <td>Tires for Dump Truck 3.5in</td>
                                  <td>Piece</td>
                                  <td>2</td>
                                  <td>4</td>
                                  <td><a href="#" data-toggle="modal" data-target="#modal-edit"><code class="text-green">EDIT</code></a>
                                      <a href="#" data-toggle="modal" data-target="#modal-delete"><code class="text-red">REMOVE</code></a></td>
                                </tr>
                                <tr>
                                  <!-- <td><input type="checkbox" ng-model="personalDetail.selected"/></td> -->
                                  <td>Tires for Dump Truck 3.5in</td>
                                  <td>Piece</td>
                                  <td>2</td>
                                  <td>4</td>
                                  <td><a href="#" data-toggle="modal" data-target="#modal-edit"><code class="text-green">EDIT</code></a>
                                      <a href="#" data-toggle="modal" data-target="#modal-delete"><code class="text-red">REMOVE</code></a></td>
                                </tr>
                                <tr>
                                  <!-- <td><input type="checkbox" ng-model="personalDetail.selected"/></td> -->
                                  <td>Tires for Dump Truck 3.5in</td>
                                  <td>Piece</td>
                                  <td>2</td>
                                  <td>4</td>
                                  <td><a href="#" data-toggle="modal" data-target="#modal-edit"><code class="text-green">EDIT</code></a>
                                      <a href="#" data-toggle="modal" data-target="#modal-delete"><code class="text-red">REMOVE</code></a></td>
                                </tr>
                              </tbody>
                            </table>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
     
                </div>
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div>
            <!-- nav-tabs-custom -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-info"><li class="fa fa-print"></li> Print</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

</section>




<!-- MODAL POPUP -->
<script type="text/ng-template" id="requisitionSlipInfo.modal">
  <div>
    <div class="modal-dialog" style="width:100%;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" ui-sref="list-receipt" ng-click="vm.ok()">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><li class="fa fa-file-o"></li> Requisition Control No: <b><%vm.formData.requisition_slip_code%></b></h4>
        </div>
        <div class="modal-body">
          <p>Add requested supply items to specific Requisition Slip</p>
          <!-- Custom Tabs (Pulled to the right) -->
          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-body">
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
                              <option selected="selected" value="0">- - select supply - -</option>
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
                          <th width="11%">Options</th>
                        </tr> 
                      </thead>
                      <tbody>
                        <tr ng-repeat="requisitionSlipItem in vm.requisitionSlipItems">
                          <td><%requisitionSlipItem.supply_name%></td>
                          <td><%requisitionSlipItem.item_description%></td>
                          <td><%requisitionSlipItem.item_stock_unit%></td>
                          <td><%requisitionSlipItem.item_quantity%></td>
                          <td><%requisitionSlipItem.item_cost | number:2%></td>
                          <td ng-init="vm.supplyGrandTotal = vm.supplyGrandTotal + requisitionSlipItem.item_total"><%requisitionSlipItem.item_total | number:2%></td>
                          <td><a href="#" data-toggle="modal" data-target="#modal-edit"><code class="text-green">EDIT</code></a>
                              <a href="#" data-toggle="modal" data-target="#modal-delete"><code class="text-red">REMOVE</code></a></td>
                        </tr>
                        <tr>
                          <td colspan="5" align="right"><b>GRAND TOTAL</b></td>
                          <td colspan="1"><b>₱<%vm.supplyGrandTotal | number:2%></b></td>
                          <td></td>
                        </tr>
                      </tbody>
                    </table>
                  </form>
                </div>
              </div>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-info"><li class="fa fa-print"></li> Print</button>
          <button type="button" class="btn btn-primary" ng-click="vm.addItems()">Save changes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
</script>
