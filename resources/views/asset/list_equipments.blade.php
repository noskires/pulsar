<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><span class="fa fa-tags"> </span> Equipments</h1>
    <p>Manage company equipments.</p>
  <ol class="breadcrumb">
    <li><a href="../../index.html"><i class="fa fa-th"></i> Dashboard</a></li>
    <li class="active">Equipments</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
      <div class="row">
        <div id="button-top" class="col-md-12"> 
<!-- BUTTONS -->
          <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#addoperating">
              <span class="glyphicon glyphicon-plus"></span> Add New Equipment
          </button> &nbsp; 
          <button class="btn btn-primary" data-toggle="collapse" data-target="#filter" data-parent="#btn-top">
              <span class="glyphicon glyphicon-filter"></span> Filter
          </button> <br>

<!-- ADD ASSET SLIDE -->
          <div id="addoperating" class="collapse"><br>
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-body">
            <!-- form start -->
            <form id="from-unit" class="form-horizontal" role="form">
              <div class="box-body">
                <div class="form-group col-sm-12">
                  <label class="col-sm-2 control-label">Asset Category*</label>
                  <div class="col-sm-10">
                  <select class="form-control select2" style="width: 100%;" required="" ng-model="ac.assetsDetails.categoryCode" ng-change="ac.assetTag(ac.assetsDetails)">
                    <option selected="selected" value="">- - - SELECT CATEGORY - - -</option>
                    <option value="<%category.asset_category_code%>" ng-repeat="category in ac.asset_categories"><%category.asset_category_name +" ("+category.asset_category_code+")"%></option>
                  </select>
                  </div>
                </div>
                <div class="form-group col-sm-12">  
                  <label for="assetname" class="col-sm-2 control-label">Asset Name*</label>
                  <div class="col-sm-4"><input type="text" class="form-control" id="assetname" ng-model="ac.assetsDetails.assetName" placeholder="" required="" autofocus></div>
                  <label for="assetID" class="col-sm-2 control-label">Asset ID*</label>
                  <div class="col-sm-4"><input type="text" class="form-control" id="assetID" ng-model="ac.assetsDetails.assetID" placeholder="" required=""></div>
                </div>
                <div class="form-group col-sm-12">
                  <label for="controlnumber" class="col-sm-2 control-label">Description </label>
                  <div class="col-sm-10"><input type="text" class="form-control" id="description" ng-model="ac.assetsDetails.description" placeholder="Load Capacity/ Remarks/ Technical Description/ Specification"></div>
                </div>
                <div class="form-group col-sm-12">
                  <label for="modelnumber" class="col-sm-2 control-label">Model*</label>
                  <div class="col-sm-4"><input type="text" class="form-control" id="modelnumber" ng-model="ac.assetsDetails.modelnumber" placeholder="" required=""></div>
                  <label for="brandname" class="col-sm-2 control-label">Brand</label>
                  <div class="col-sm-4"><input type="text" class="form-control" id="brandname" ng-model="ac.assetsDetails.brand" placeholder=""></div>
                </div>
                <div class="form-group col-sm-12">
                  <label class="col-sm-2 control-label">Date Acquired*</label>
                  <div class="col-sm-4">
                  <div class="input-group date">
                  <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                  <input type="text" class="form-control pull-right" id="datepicker-dateacquired" datepicker2 ng-model="ac.assetsDetails.dateAcquired">
                </div></div>
                  <label for="acquisitioncost" class="col-sm-2 control-label">Acquisition Cost*</label>
                  <div class="col-sm-4">
                  <div class="input-group date">
                  <span class="input-group-addon" style="font-size: 20px;">₱</span>
                  <input type="text" class="form-control" id="acquisitioncost" placeholder="" required="" ng-model="ac.assetsDetails.acquisitionCost">
                </div></div>
                </div>
                <div class="form-group col-sm-12">
                  <label for="platenumber" class="col-sm-2 control-label">Plate No.</label>
                  <div class="col-sm-4"><input type="text" class="form-control" id="platenumber" placeholder="" required="" ng-model="ac.assetsDetails.plateNumber"></div>
                  <label for="enginenumber" class="col-sm-2 control-label">Engine/Serial No.</label>
                  <div class="col-sm-4"><input type="text" class="form-control" id="enginenumber" placeholder="" required="" ng-model="ac.assetsDetails.engineNumber"></div>
                </div>
                <div class="form-group col-sm-12">
                  <label for="platenumber" class="col-sm-2 control-label">Chasis No.</label>
                  <div class="col-sm-4"><input type="text" class="form-control" id="" required="" ng-model="ac.assetsDetails.chassisNumber"></div>
                  <label for="enginenumber" class="col-sm-2 control-label">Warranty Date</label>
                  <div class="col-sm-4">
                    <div class="input-group date">
                      <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                      <input type="text" class="form-control pull-right" id="datepicker-warranty" ng-model="ac.assetsDetails.warrantyDate">
                    </div>
                  </div>
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
                  data-title="Confirm data entry." data-content="Are you sure?" ng-click="ac.submit(ac.assetsDetails)"> CONFIRMATION
                  </button></div></div>
              </div>
            </form>
          </div>
          </div>
          <!-- /.box -->
          </div><br>
          
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

<!-- /// ASSETS TABLE -->  
      <div class="box box-primary">
            <div class="box-body">
            <div export-to-xlsx data="ac.assets" bind-to-table="'tb-assets'" filename="'Equipments'"></div>
            <table datatable="ng" class="table table-bordered table-hover" name="tb-assets" width="100%">
              <thead>
              <tr> 
                <th>Asset Code</th>
                <th>Category</th>
                <th>Name</th>
                <th>Asset ID</th>
                <th>Model</th>
                <th>Brand</th>
                <th>Date Acquired</th>
                <th>Acquisition Cost</th>
                <th>Plate No.</th>
                <th>Engine No.</th>
                <th>Chassis No.</th>
                <th>Warranty</th>
                <th>Assigned to</th>
              </tr>
              </thead>
              <tbody>
              <tr ng-repeat="asset in ac.assets"> 
                <td><a href="#" ui-sref="asset-list-equipmentsCopy({assetCode:asset.asset_code})"><b><%asset.asset_code%></b></a></td>
                <td><%asset.category%></td>
                <td><%asset.name%></td>
                <td><%asset.code%></td>
                <td><%asset.model%></td>
                <td><%asset.brand%></td>
                <td><%asset.date_acquired%></td>
                <td><%asset.acquisition_cost | number:2%></td>
                <td><%asset.plate_no%></td>
                <td><%asset.engine_no%></td>
                <td><%asset.chassis_no%></td>
                <td><%asset.warranty_date%></td>
                <td><%asset.employee_name%></td>
              </tr>
              </tbody>
            </table>
            </div>
            <!-- /.box-body -->
      </div>
<!-- MODAL HERE HERE -->
        <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><li class="fa fa-tags"></li> Asset Tag: <b>CONE-03082018-DT1</b></h4>
              </div>
              <div class="modal-body">
                <!-- Custom Tabs (Pulled to the right) -->
                <div class="nav-tabs-custom">
                  <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#tab_1-1" data-toggle="tab">Asset Details</a></li>
                    <li class="pull-left header">Dump Truck</li>
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane active" id="tab_1-1">
                      <div class="row">
                        <div class="col-sm-6"><br>
                          <img src="../../dist/img/dumptruck3_1024x768.jpg" style="width:100%;height:100%;">
                        </div>
                        <div class="col-sm-6">
                          <b>Category:</b> Construction Equipment<br><br>
                          <b>ID:</b> DT1<br>
                          <b>Name:</b> DUMPTRUCK<br>
                          <b>Model:</b> CXZ19J-3005460<br>
                          <b>Make/Brand:</b> ISUZU<br>
                          <b>Owner Company:</b> PULSAR CONSTRUCTION<br>
                          <b>Date Acquired:</b> 2/7/2012<br>
                          <b>Acquisition Cost:</b> 1,200,000.00<br>
                          <b>Plate No:</b> FGR-254<br>
                          <b>Engine No:</b> 10PC1-970126 <br>
                          <b>Warranty Date:</b> 01/01/2018 <br>
                          <b>Location:</b> Quarry<br>
                          <b>Assigned to:</b> <a href="#">Erik Subnet</a><br>
                          <b>Status:</b> <small class="label bg-green">Active</small>
                        </div>
                      </div>        
                    </div>
                    <!-- /.tab-pane -->
                  </div>
                  <!-- /.tab-content -->
                </div>
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary pull-right" onclick="window.location='view-asset.html'">
                  <li class="fa fa-navicon "></li> More Details</button>
                <button type="button" class="btn btn-info pull-right" style="margin-right: 7px;"><li class="fa fa-print"></li> Print</button>
                                <button type="button" class="btn btn-default pull-right" style="margin-right: 7px;"><li class="fa fa-folder-o"></li> Create J.O.</button>  

                <!-- nav-tabs-custom -->
              </div>
              <div class="modal-footer">
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
<!-- MODAL HERE HERE 2 -->
        <div class="modal fade" id="modal-default2">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><li class="fa fa-tags"></li> Asset Tag: <b>CONE-04082017-MX2</b></h4>
              </div>
              <div class="modal-body">
                <!-- Custom Tabs (Pulled to the right) -->
                <div class="nav-tabs-custom">
                  <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#tab_1-1" data-toggle="tab">Asset Details</a></li>
                    <li class="dropdown">
                      <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        Options <span class="caret"></span>
                      </a>
                      <ul class="dropdown-menu">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Assign</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Lease</a></li>
                        <li role="presentation" class="divider"></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Donate</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Sell</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Dispose</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Lost / Missing</a></li>
                        <li role="presentation" class="divider"></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><b>Create Job Order</b></a></li>
                      </ul>
                    </li>
                    <li class="pull-left header">Transit Mixer</li>
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane active" id="tab_1-1">
                      <div class="row">
                        <div class="col-sm-6"><br>
                          <img src="../../dist/img/mixer_1024x768.jpg" style="width:100%;height:100%;">
                        </div>
                        <div class="col-sm-6">
                          <b>Category:</b> Construction Equipment<br>
                          <b>ID:</b> MX2<br>
                          <b>Model:</b> CXZ19J-4445460<br>
                          <b>Make/Brand:</b> MAN<br>
                          <b>Date Acquired:</b> 4/8/2017<br>
                          <b>Acquisition Cost:</b> ₱3,300,000.00<br>
                          <b>Plate No.:</b> FGR-123<br>
                          <b>Engine No:</b> 10PC1-970126 <br>
                          <b>Location:</b> Tuguegarao City, Cagayan<br>
                          <b>Assigned to:</b> <a href="#">Jaime Beljica</a><br>
                          <b>Status:</b> <small class="label bg-green">Active</small><br><br>
                        </div>
                      </div>        
                    </div>
                    <!-- /.tab-pane -->
                  </div>
                  <!-- /.tab-content -->
                </div>
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary pull-right" onclick="window.location='view-asset.html'">
                  <li class="fa fa-navicon "></li> More Details</button>
                <button type="button" class="btn btn-info pull-right" style="margin-right: 7px;"><li class="fa fa-print"></li> Print</button>
                <!-- nav-tabs-custom -->
              </div>
              <div class="modal-footer">
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->        

    </section>

<script type="text/ng-template" id="assetInfo.modal">
<!-- MODAL HERE HERE -->
 
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" ng-click="vm.ok()">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><li class="fa fa-tags"></li> Asset Tag: <b><%vm.formData.asset.tag%></b></h4>
      </div>
      <div class="modal-body">
        <!-- Custom Tabs (Pulled to the right) -->
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs pull-right">
            <li class="active"><a href="#tab_1-1" data-toggle="tab">Asset Details</a></li>
            <li class="pull-left header">Dump Truck</li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab_1-1">
              <div class="row">
                <div class="col-sm-6"><br>
                  <img src="uploads/no-image.png" style="width:100%;height:100%;padding-right:0px;" ng-if="vm.assetPhoto.length==0">
                  <img src="uploads/<%vm.assetPhoto[0].asset_photo_name%>" style="width:100%;height:100%;padding-right:0px;" ng-if="vm.assetPhoto.length==1">
                </div>

                <div style="font-size: 14px;">
                <b>Category:</b> <%vm.formData.asset.asset_name%><br>
                <b>ID:</b> <%vm.formData.asset.code%><br>
                <b>Model:</b> <%vm.formData.asset.model%><br>
                <b>Make/Brand:</b> <%vm.formData.asset.brand%><br>
                <b>Date Acquired:</b> <%vm.formData.asset.date_acquired%><br>
                <b>Acquisition Cost:</b> <%vm.formData.asset.acquisition_code%><br>
                <b>Plate No:</b> <%vm.formData.asset.plate_no%><br>
                <b>Engine No:</b> <%vm.formData.asset.engine_no%> <br>
                <b>Location:</b> <%vm.formData.asset.barangay+' '+vm.formData.asset.municipality_text +' '+ vm.formData.asset.province_text+' '+ vm.formData.asset.region_text_short%> <br>
                
                <b>Warranty:</b> <%vm.formData.asset.warranty_date%> <br>
                <b>Assigned to:</b> <a href="#"><%vm.formData.asset.employee_name%></a><br>
                <b>Status:</b> <small class="label bg-green"><%vm.formData.asset.status%></small>
              </div>
              </div>        
            </div>
            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div>
        <button type="button" class="btn btn-primary pull-right" ui-sref="asset-more-details({assetCode:vm.formData.asset.asset_code})" ng-click="vm.ok()">
          <li class="fa fa-navicon "></li> More Details 1</button>
        <a class="btn btn-info pull-right" style="margin-right: 7px;" ng-click="vm.printAssetDetails(vm.formData.asset.asset_code)" target="_blank" ng-href="<%vm.url%>"  style="margin-right: 7px;"><li class="fa fa-print"></li> Print
        </a>

        <!-- <button type="button" class="btn btn-default pull-right" style="margin-right: 7px;"><li class="fa fa-folder-o"></li> Create J.O.</button>   -->

        <!-- nav-tabs-custom -->
      </div>
      <div class="modal-footer">
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog --> 

<!-- asdf -->
 
</script>