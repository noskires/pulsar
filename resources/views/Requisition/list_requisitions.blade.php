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
              <td><a href="#"><b><%requisition.requisition_slip_code%></b></a></td>
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