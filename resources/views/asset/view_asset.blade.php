<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><span class="fa fa-tags"> </span> Asset Profile</h1>
      <ol class="breadcrumb">
        <li><a href="../../index.html"><i class="fa fa-th"></i> Dashboard</a></li>
        <li class="active">Assets</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
<!-- ////// LEFT COLUMN -->
        <div class="col-md-8">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"> <%amdc.asset.name%> : <b><%amdc.asset.tag%></b></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-6">
              
                <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="2000">
                  <!-- Wrapper for slides -->
                  <div class="carousel-inner">
                    <div class="item active">
                      <img src="{{URL::to('assets/dist/img/dumptruck_1024x768.jpg')}}" style="width:100%;height:100%;">
                      <div class="carousel-caption d-none d-md-block">
                        <h3>Quarry</h3>
                        <p>04/06/2018</p>
                      </div>
                    </div>
                    <div class="item">
                      <img src="{{URL::to('assets/dist/img/dumptruck2_1024x768.jpg')}}" style="width:100%;height:100%;">
                      <div class="carousel-caption d-none d-md-block">
                        <h3>Station</h3>
                        <p>02/02/2018</p>
                      </div>
                    </div>
                    <div class="item">
                      <img src="{{URL::to('assets/dist/img/dumptruck3_1024x768.jpg')}}" style="width:100%;height:100%;">
                      <div class="carousel-caption d-none d-md-block">
                        <h3>Motor Pool</h3>
                        <p>01/01/2017</p>
                      </div>
                    </div>
                  </div>
                  <!-- Left and right controls -->
                  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                  </a>
                </div>
              </div>
<!-- ////// BASIC DETAILS -->
              <div class="col-md-5"> 
                 

                <div class="box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Basic Details</h3>
                  </div>
                  <div class="box-body" style="font-size: 14px;">
                    <b>Category:</b> <%amdc.asset.asset_category%><br>
                    <b>ID:</b> <%amdc.asset.code%><br>
                    <b>Model:</b> <%amdc.asset.model%><br>
                    <b>Make/Brand:</b> <%amdc.asset.brand%><br>
                    <b>Date Acquired:</b> <%amdc.asset.date_acquired%><br>
                    <b>Acquisition Cost:</b> <%amdc.asset.acquisition_cost%><br>
                    <b>Plate No:</b> <%amdc.asset.plate_no%><br>
                    <b>Engine No:</b> <%amdc.asset.engine_no%> <br>
                    <b>Location:</b> <%amdc.asset.municipality_text%> <br>
                    <b>Assigned to:</b> <a href="#"><%amdc.asset.employee_name%></a><br>
                    <b>Status:</b> <small class="label bg-green"><%amdc.asset.status%></small>
                  </div>
                </div>
              </div>
<!-- ////// END BASIC DETAILS -->
            </div>
          </div>
        <div>
<!-- ////// ASSET EVENTS -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right tab-head">
              <li><a href="#tab_5-5" data-toggle="tab">History</a></li>
              <li><a href="#tab_4-4" data-toggle="tab">Audit</a></li>
              <li><a href="#tab_2-2" data-toggle="tab">Events</a></li>
              <li class="active"><a href="#tab_3-3" data-toggle="tab">Depreciation</a></li>
              <li class="pull-left header"><h4><i class="fa fa-flag"></i> Attributes</li></h4>
            </ul>
            <div class="tab-content">
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2-2">
                <h4><b>Asset Events</b></h4>
                <table class="table" width="100%">
                <tbody>
                <tr>
                  <td><code class="text-success">Assignment</code> Date 01/16/2017 </td>
                  <td><li class="fa fa-mail-forward"></li> Assign</td>
                  <td>Assigned to John Juan</td>
                  <td>Notes Event notes here</td>
                  <td><a href="#" data-toggle="modal" data-target="#modal-event"><code class="text-green">EDIT</code></a></td>
                </tr>
                <tr>
                  <td><code class="text-success">Assignment</code> Date 01/16/2017 </td>
                  <td><li class="fa fa-mail-forward"></li> Assign</td>
                  <td>Assigned to John Juan</td>
                  <td>Notes Event notes here</td>
                  <td><a href="#" data-toggle="modal" data-target="#modal-event"><code class="text-green">EDIT</code></a></td>
                </tr>
                </tbody>
              </table>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane active" id="tab_3-3">
                <h4><b>Asset Depreciation:</b><button type="button" class="btn btn-xs btn-primary pull-right" data-toggle="modal" data-target="#modal-depreciation">
                <li class="fa fa-plus"></li> Manage</button></h4> 
                <table id="depreciation" class="table" width="100%">
                <thead>
                <tr>
                  <th>Date Acquired</th>
                  <th>Depreciable Cost</th>
                  <th>Salvage Value</th>
                  <th>Asset Life (months)</th>
                  <th>Depr. Method</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>02/07/2012</td>
                  <td>₱500,000.00</td>
                  <td>₱300,000.00</td>
                  <td>120 months</td>
                  <td>Straight Line</td>
                </tr>
                </tbody>
              </table>
 
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_4-4">
                <h4><b>Asset Audit:</b></h4>
                <table class="table" width="100%">
                <thead>
                <tr>
                  <th>Audit Name</th>
                  <th>Last Audit</th>
                  <th>Date</th>
                  <th>Location</th>
                  <th>Notes</th>
                  <th><li class="fa fa-edit"></li></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>Internal Audit</td>
                  <td>Jay Bulan</td>
                  <td>02/16/2018</td>
                  <td>Operations</td>
                  <td>Completed</td>
                  <td><a href="#" data-toggle="modal" data-target="#modal-event"><code class="text-green">EDIT</code></a></td>
                </tr>
                <tr>
                  <td>External Audit</td>
                  <td>Erikson Supnet</td>
                  <td>04/01/2018</td>
                  <td>Operations</td>
                  <td>Completed</td>
                  <td><a href="#" data-toggle="modal" data-target="#modal-event"><code class="text-green">EDIT</code></a></td>
                </tr>
                </tbody>
              </table>
              </div>            
            </div>
          </div>
<!-- ////// END ASSET ATTRIBUTES -->
<!-- ////// START ASSET ATTACHMENTS -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs pull-right tab-head">
              <li><a href="#tab_8-8" data-toggle="tab">Documents</a></li>
              <li><a href="#tab_7-7" data-toggle="tab">Insurances</a></li>
              <li class="active"><a href="#tab_6-6" data-toggle="tab">Warranty</a></li>
              <li class="pull-left header"><h4><i class="fa fa-clipboard"></i> Attachments</li></h4>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_6-6">
                <h4><b>Asset Warranty:</b><button type="button" class="btn btn-xs btn-primary pull-right" ng-click="amdc.addNewWarranty()">
                <li class="fa fa-plus"></li> Add New</button></h4> 
                <table datatable="ng" id="warranty" class="table" width="100%">
                <thead>
                <tr>
                  <th>Status</th>
                  <th>Expiration Date</th>
                  <th>Length</th>
                  <th>Description</th>
                  <th><li class="fa fa-edit"></li></th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="warranty in amdc.warranties">
                  <td>Active</td>
                  <td><%warranty.expiry_date%></td>
                  <td></td>
                  <td><%warranty.description%></td>
                  <td><a href="#" data-toggle="modal" data-target="#modal-warranty"><code class="text-green">EDIT</code></a></td>
                </tr> 
                </tbody>
              </table>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_7-7">
                <h4><b>Asset Insurance:</b><button type="button" class="btn btn-xs btn-primary pull-right" data-toggle="modal" data-target="#modal-insurance">
                <li class="fa fa-link"></li> Link Insurance</button></h4> 
                <table class="table" width="100%">
                <thead>
                <tr>
                  <th>Description</th>
                  <th>Insurance Co.</th>
                  <th>Contact Person</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th><li class="fa fa-edit"></li></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>Insurance Description</td>
                  <td>BPI</td>
                  <td>Jerik Erikson</td>
                  <td>12/12/2015</td>
                  <td>12/12/2020</td>
                  <td><a href="#" data-toggle="modal" data-target="#modal-warranty"><code class="text-green">EDIT</code></a></td>
                </tr>
                </tbody>
              </table>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_8-8">
                <h4><b>Asset Documents:</b><button type="button" class="btn btn-xs btn-primary pull-right" data-toggle="modal" data-target="#modal-docs">
                <li class="fa fa-upload"></li> Upload</button></h4> 
                <table id="warranty" class="table" width="100%">
                <thead>
                <tr>
                  <th>Description</th>
                  <th>File Type</th>
                  <th>File Name</th>
                  <th>Upload Date</th>
                  <th>Upload By</th>
                  <th>Options</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>Warranty Scanned</td>
                  <td>PDF</td>
                  <td>DT1Warranty</td>
                  <td>04/01/2018</td>
                  <td>Mykee Caparas</td>
                  <td><a href="#" data-toggle="modal" data-target="#modal-default"><code class="text-blue">DOWNLOAD</code></a>
                  <a href="#" data-toggle="modal" data-target="#modal-warranty"><code class="text-red">DETACH</code></a></td>
                </tr>
                <tr>
                  <td>Insurance Scanned</td>
                  <td>PDF</td>
                  <td>MX2Insurance</td>
                  <td>01/01/2017</td>
                  <td>Mykee Caparas</td>
                  <td><a href="#" data-toggle="modal" data-target="#modal-default"><code class="text-blue">DOWNLOAD</code></a>
                  <a href="#" data-toggle="modal" data-target="#modal-default"><code class="text-red">DETACH</code></a></td>
                </tr>
                <tr>
                  <td>Warranty</td>
                  <td>PDF</td>
                  <td>DT2Warranty</td>
                  <td>11/01/2016</td>
                  <td>Erik Subnet</td>
                  <td><a href="#" data-toggle="modal" data-target="#modal-default"><code class="text-blue">DOWNLOAD</code></a>
                  <a href="#" data-toggle="modal" data-target="#modal-default"><code class="text-red">DETACH</code></a></td>
                </tr>
                </tbody>
              </table>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
<!-- ////// END ASSET ATTACHMENTS -->
        </div>
        <!-- /.col -->
      </div>

<!-- ////// RIGHT COLUMN -->
        <div class="col-md-4">
<!-- ////// APPLICATION BUTTONS -->
          <div class="box"> 

            <div class="box-body">
              <a class="btn btn-app" >
                <i class="fa fa-edit"></i> Edit
              </a>
              <a class="btn btn-app">
                <i class="fa fa-image"></i> Photo
              </a>
              <a class="btn btn-app">
                <i class="fa fa-external-link"></i> Assign
              </a>              
              <a class="btn btn-app">
                <i class="fa fa-wrench"></i> Repair
              </a>
              <a href="javascript: window.open('pdfasset.pdf');"  class="btn btn-app">
                <i class="fa fa-print"></i> Print
              </a>
              <a class="btn btn-app">
                <i class="fa fa-bookmark-o"></i> Lease
              </a>
              <a class="btn btn-app">
                <i class="fa fa-heart-o"></i> Donate
              </a>
              <a class="btn btn-app">
                <i class="fa fa-folder-o"></i> Sell
              </a>              
              <a class="btn btn-app">
                <i class="fa fa-unlink"></i> Dispose
              </a>
              <a class="btn btn-app">
                <i class="fa fa-eye-slash"></i> Lost/Missing
              </a>
            </div>
            <!-- /.box-body -->
          </div>
<!-- ////// END APPLICATION BUTTONS -->
<!-- ////// OPERATING DATA -->
          <div class="box"> 

            <div class="box-body">

              <div class="wrapper" style="color: #000;background-color: #fff;">
                  <div class="counter col_fourth col-sm-3">
                    <h2 class="timer count-title count-number" data-to="" data-speed="1500"> <%amdc.assetsMonitoring.total_operating_hours | number:0%></h2>
                     <li class="fa fa-clock-o fa-1x"></li><p class="count-text ">Operating Hours</p>
                  </div>
                  <div class="counter col_fourth col-sm-3">
                    <h2 class="timer count-title count-number" data-to="71234" data-speed="1500"><%amdc.assetsMonitoring.total_distance_travelled | number:0%></h2>
                    <li class="fa fa-road fa-1x"></li><p class="count-text ">Kilometers Traveled</p>
                  </div>
                  <div class="counter col_fourth col-sm-3">
                    <h2 class="timer count-title count-number" data-to="55123" data-speed="1500"><%amdc.assetsMonitoring.total_diesel_consumption | number:0%></h2>
                    <li class="fa fa-database fa-1x"></li><p class="count-text ">Diesel (L) Consumed</p>
                  </div>
                  <div class="counter col_fourth col-sm-3">
                    <h2 class="timer count-title count-number" data-to="90123" data-speed="1500"><%amdc.assetsMonitoring.total_gas_consumption | number:0%></h2>
                    <li class="fa fa-database fa-1x"></li><p class="count-text ">Gas (L) Consumed</p>
                  </div>
                  <div class="counter col_fourth col-sm-3">
                    <h2 class="timer count-title count-number" data-to="23123" data-speed="1500"><%amdc.assetsMonitoring.total_oil_consumption | number:0%></h2>
                    <li class="fa fa-bullseye fa-1x"></li><p class="count-text ">Oil (L) Consumed</p>
                  </div>
                  <div class="counter col_fourth end col-sm-3">
                    <h2 class="timer count-title count-number" data-to="71234" data-speed="1500"><%amdc.assetsMonitoring.total_number_loads | number:0%></h2>
                    <li class="fa fa-truck fa-1x"></li><p class="count-text ">Loads (m3)</p>
                  </div>
              </div>

            </div>
          </div>
<!-- ////// END OPERATING DATA -->
        </div>
<!-- ////// END RIGHT COLUMN -->
      </div>



<!-- START TABS -->
<br>
<div class="row">


<!-- ////// RIGHT COLUMN -->

        <!-- /.col -->
</div>

<!-- ////// ATTRIBUTES MODALS HERE -->
<!-- ////// MODAL-WARRANTY HERE HERE -->
        <div class="modal fade" id="modal-depreciation">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><li class="fa fa-plus"></li> Manage Asset Depreciation</h4>
              </div>
            <form class="form-horizontal" id="">
              <div class="modal-body"><br>
                <div class="form-group">
                  <label for="platenumber" class="col-sm-3 control-label">Depreciable Cost</label>
                  <div class="col-sm-8">
                  <div class="input-group date">
                  <span class="input-group-addon" style="font-size: 20px;">₱</span>
                  <input type="text" class="form-control" id="depreciablecost" placeholder="sales tax, freight, installation" required="">
                </div></div>
                </div>
                <div class="form-group">
                  <label for="platenumber" class="col-sm-3 control-label">Salvage Value</label>
                  <div class="col-sm-8">
                  <div class="input-group date">
                  <span class="input-group-addon" style="font-size: 20px;">₱</span>
                  <input type="text" class="form-control" id="salvagevalue" placeholder="" required="">
                </div></div>
                </div>
                <div class="form-group">
                  <label for="enginenumber" class="col-sm-3 control-label">Asset Life</label>
                  <div class="col-sm-8"><input type="text" class="form-control" id="assetlife" placeholder="In Months" required=""></div>
                </div>
                <div class="form-group">
                  <label for="enginenumber" class="col-sm-3 control-label">Method</label>
                  <div class="col-sm-8">
                  <select class="form-control select2" style="width: 100%;" required="">
                  <option selected="selected" value="1">Straight Line</option>
                  <option value="2">Double Declining Balance</option>
                  <option value="3">150% Declining Balance</option>
                  <option value="3">Sum of the Year's Digits</option>
                  </select>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
              </div>
            </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
<!-- ATTATCHMENT MODALS HERE -->
<!-- MODAL-WARRANTY HERE HERE -->
        <div class="modal fade" id="modal-warranty">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><li class="fa fa-plus"></li> Add an Asset Warranty</h4>
              </div>
            <form class="form-horizontal" id="">
              <div class="modal-body"><br>
                <div class="form-group">
                  <label for="controlnumber" class="col-sm-3 control-label">Length (Months)</label>
                  <div class="col-sm-8"><input type="text" class="form-control" id="warranty_months" required=""></div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">Expiration Date</label>
                  <div class="col-sm-8">
                  <div class="input-group date">
                  <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                  <input type="text" class="form-control pull-right" id="warranty_expiration" required="">
                </div></div>
                </div>
                <div class="form-group">
                  <label for="rs-desc" class="col-sm-3 control-label">Description/Remarks</label>
                  <div class="col-sm-8"><textarea class="col-sm-8 form-control" id="warranty_desc" rows="2"></textarea></div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
<!-- MODAL-INSURANCE HERE HERE -->
        <div class="modal fade" id="modal-insurance">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><li class="fa fa-link"></li> Link an Insurance</h4>
              </div>
              <form class="form-horizontal" id="">
              <div class="modal-body">
              <p>Select an insurance from the list below. <br>To define a new insurance go to Advanced > Insurance.</p><br> 
                <div class="form-group">
                  <label class="col-sm-3 control-label">Insurance</label>
                  <div class="col-sm-8">
                  <select class="form-control select2" style="width: 100%;" required="">
                  <option selected="selected" value="0">- - - nothing selected - - -</option>
                  <option value="1">Insurance 1</option>
                  <option value="2">Insurance 2</option>
                  <option value="3">Insurance 3</option>
                  </select>
                  </div>              
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Link Insurance</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->      
<!-- MODAL-DOCS HERE HERE -->
        <div class="modal fade" id="modal-docs">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><li class="fa fa-upload"></li> Upload new Document</h4>
              </div>
              <form class="form-horizontal" id="">
              <div class="modal-body"><br>
                <div class="form-group">
                  <label for="assetimg" class="col-sm-3 control-label">Upload Image</label>
                  <div class="col-sm-8">
                  <div class="input-group">
                  <label class="input-group-btn">
                    <span class="btn btn-default">Browse&hellip; <input type="file" style="display: none;"></span>
                  </label>
                  <input type="text" class="form-control" id="asset_doc" readonly required="">
                </div> </div>               
                </div>
                <div class="form-group">
                  <label for="controlnumber" class="col-sm-3 control-label">Description </label>
                  <div class="col-sm-8"><input type="text" class="form-control" id="asset_docdesc" required=""></div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Upload</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

    </section>



<!-- MODAL-WARRANTY HERE HERE -->
<script type="text/ng-template" id="assetAddWarranty.modal">
    <div>
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" ng-click="vm.ok()">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><li class="fa fa-plus"></li> Add an Asset Warranty</h4>
          </div>
        <form class="form-horizontal" id="" ng-model="amdc.warrantyDetails">
          <div class="modal-body"><br>
            <div class="form-group">
              <label for="controlnumber" class="col-sm-3 control-label">Length (Months)</label>
              <div class="col-sm-8"><input type="text" class="form-control" id="warranty_months" required="" ng-model="amdc.warrantyDetails.monthLength"></div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Expiration Date</label>
              <div class="col-sm-8">
              <div class="input-group date">
              <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
              <input type="text" class="form-control pull-right" id="warranty_expiration" required="" ng-model="amdc.warrantyDetails.expiryDate">
            </div></div>
            </div>
            <div class="form-group">
              <label for="rs-desc" class="col-sm-3 control-label">Description/Remarks</label>
              <div class="col-sm-8"><textarea class="col-sm-8 form-control" id="warranty_desc" rows="2" ng-model="amdc.warrantyDetails.description"></textarea></div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" ng-click="vm.submitWarranty(amdc.warrantyDetails)">Submit</button>
          </div>
        </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  </script>