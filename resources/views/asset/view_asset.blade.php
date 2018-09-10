<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><span class="fa fa-tags"> </span> Asset Profile</h1>
  <ol class="breadcrumb">
    <li><a href="../../index.html"><i class="fa fa-th"></i> Dashboard</a></li>
    <li class="active">Assets</li>
  </ol>
</section>

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
                <b>Warranty:</b> <%amdc.asset.warranty_date%> <br>
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
          <li><a href="#tab_8-8" data-toggle="tab">Documents</a></li>
          <li><a href="#tab_7-7" data-toggle="tab">Insurances</a></li>
          <li><a href="#tab_3-3" data-toggle="tab">Events</a></li>
          <li class="active"><a href="#tab_2-2" data-toggle="tab">Maintenance History</a></li>
          <li class="pull-left header"><h4><i class="fa fa-flag"></i> Attributes</li></h4>
        </ul>


        <div class="tab-content">
          <!-- /.tab-pane -->
          <div class="tab-pane" id="tab_3-3">
            <h4><b>Asset Events</b></h4>
            <table class="table" width="100%">
              <tbody>
              <tr ng-repeat="assetEvent in amdc.assetEvents">
                <td><code class="text-success bg-orange"><%assetEvent.status%></code></td>
                <td>Date <%assetEvent.event_date%></td>
                <td><%assetEvent.remarks%></td>
              </tr>
              <!-- <tr>
                <td><code class="text-success bg-blue">LEASE</code></td>
                <td>Date 02/16/2018</td>
                <td>Description/Remarks</td>
              </tr>
              <tr>
                <td><code class="text-success bg-gray">DONATE</code></td>
                <td>Date 02/16/2018</td>
                <td>Description/Remarks</td>
              </tr>
              <tr>
                <td><code class="text-success bg-yellow">SELL</code></td>
                <td>Date 02/16/2018</td>
                <td>Description/Remarks</td>
              </tr>
              <tr>
                <td><code class="text-success bg-black">DISPOSE</code></td>
                <td>Date 02/16/2018</td>
                <td>Description/Remarks</td>
              </tr>
              <tr>
                <td><code class="text-success bg-red">LOST/MISSING</code></td>
                <td>Date 02/16/2018</td>
                <td>Description/Remarks</td>
              </tr> -->
              </tbody>
            </table>
          </div>
          <!-- /.tab-pane -->

          <div class="active tab-pane" id="tab_2-2">
            <h4><b>Maintenance History</b></h4>
            <table class="table" width="100%" datatable="ng">
              <thead>
              <tr>
                <th>Control#</th>
                <th>JO Date</th>
                <th>Date Started</th>
                <th>Date Completed</th>
                <th>Conducted By</th>
                <th>Operating Hours</th>
                <th>Distance Travelled</th>
                <th>Diesel Consumption</th>
                <th>Gas Consumption</th>
                <th>Oil Consumption</th>
                <th>Loads</th>
                <!-- <th><li class="fa fa-edit"></li></th> -->
              </tr>
              </thead>
              <tbody>
              <tr ng-repeat="jobOrder in amdc.jobOrders">
                <td><%jobOrder.job_order_code%></td>
                <td><%jobOrder.job_order_date%></td>
                <td><%jobOrder.date_started%></td>
                <td><%jobOrder.date_completed%></td>
                <td><%jobOrder.conducted_by%></td>
                <td><%jobOrder.operating_hours | number:0%></td>
                <td><%jobOrder.distance_travelled | number:0%></td>
                <td><%jobOrder.diesel_consumption | number:0%></td>
                <td><%jobOrder.gas_consumption | number:0%></td>
                <td><%jobOrder.oil_consumption | number:0%></td>
                <td><%jobOrder.number_loads | number:0%></td>
               <!--  <td><a href="#" data-toggle="modal" data-target="#modal-event"><code class="text-green">EDIT</code></a></td> -->
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
              <tr ng-repeat="insurance in amdc.insurance">
                <td><%insurance.description%></td>
                <td><%insurance.insurance_co%></td>
                <td><%insurance.insurance_agent%></td>
                <td><%insurance.date_issued%></td>
                <td><%insurance.expiration_date%></td>
                <td><a href="#" data-toggle="modal" data-target="#modal-warranty"><code class="text-green">EDIT</code></a></td>
              </tr>
              </tbody>
            </table>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="tab_8-8">
            <h4><b>Asset Documents:</b><button type="button" class="btn btn-xs btn-primary pull-right" data-toggle="modal" data-target="#modal-docs">
            <li class="fa fa-upload"></li> Upload</button></h4> 
            <table class="table" width="100%">
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
      </div>
<!-- ////// END ASSET ATTRIBUTES -->
    </div>
    <!-- /.col -->
  </div>

<!-- ////// RIGHT COLUMN -->
    <div class="col-md-4">
<!-- ////// APPLICATION BUTTONS -->
      <div class="box"> 

        <div class="box-body">
          <a class="btn btn-app" data-toggle="modal" data-target="#modal-edit">
            <i class="fa fa-edit"></i> Edit
          </a>
          <a class="btn btn-app" data-toggle="modal" data-target="#modal-image"> 
            <i class="fa fa-image"></i> Photo
          </a>            
          <a class="btn btn-app" ui-sref="jo-create({assetTag:amdc.tag})" ng-if="amdc.asset.employee_name && amdc.asset.status=='ACTIVE' ||  amdc.asset.status=='Active'">
                <i class="fa fa-wrench"></i> Repair
          </a>                       
          <a class="btn btn-app" ng-click="amdc.messageAlert('Please assign an employee first!')" ng-if="!amdc.asset.employee_name && amdc.asset.status=='ACTIVE'">
            <i class="fa fa-wrench"></i> Repair
          </a> 
          <a class="btn btn-app" ng-click="amdc.messageAlert('Equipment is currently under maintenance!')" ng-if="amdc.asset.status=='MAINTENANCE'">
            <i class="fa fa-wrench"></i> Repair
          </a>
          <a class="btn btn-app" ng-click="amdc.messageAlert('STATUS: DONATED')" ng-if="amdc.asset.status=='DONATE'">
            <i class="fa fa-wrench"></i> Repair
          </a>
          <a class="btn btn-app" ng-click="amdc.messageAlert('STATUS: LEASE')" ng-if="amdc.asset.status=='LEASE'">
            <i class="fa fa-wrench"></i> Repair
          </a>
          <a class="btn btn-app" ng-click="amdc.messageAlert('STATUS: SELL')" ng-if="amdc.asset.status=='SELL'">
            <i class="fa fa-wrench"></i> Repair
          </a>
          <a class="btn btn-app" ng-click="amdc.messageAlert('STATUS: DISPOSE')" ng-if="amdc.asset.status=='DISPOSE'">
            <i class="fa fa-wrench"></i> Repair
          </a>
          <a class="btn btn-app" ng-click="amdc.messageAlert('STATUS: LOST')" ng-if="amdc.asset.status=='LOST/MISSING'">
            <i class="fa fa-wrench"></i> Repair
          </a>
          <a class="btn btn-app" ng-click="amdc.messageAlert('STATUS: ')" ng-if="amdc.asset.status=='LOST'">
            <i class="fa fa-wrench"></i> Repair
          </a>
          <a href="javascript: window.open('pdfasset.pdf');"  class="btn btn-app">
            <i class="fa fa-print"></i> Print
          </a>
          <a href="#"  class="btn btn-app" data-toggle="modal" data-target="#modal-actions">
            <i class="fa fa-compass"></i> Other Actions
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
              <option value="1">Insurance#12323 (BPI Car Insurance)</option>
              <option value="2">Insurance#22222 (BPI Car Insurance)</option>
              <option value="3">Insurance#33333 (BPI Car Insurance)</option>
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
              <label for="assetimg" class="col-sm-3 control-label">Upload File</label>
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

<!-- MODAL-IMAGE HERE HERE -->
    <div class="modal fade" id="modal-image">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><li class="fa fa-image"></li> Upload new Image</h4>
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

<!-- MODAL-OTHER ACTIONS HERE HERE -->
    <div class="modal fade" id="modal-actions">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><li class="fa fa-compass"></li> Add Asset Event</h4>
          </div>
          <form class="form-horizontal" id="" ng-model="assetEventDetails">
          <div class="modal-body"><br>
            <div class="form-group">
              <label class="col-sm-3 control-label">Event</label>
              <div class="col-sm-8">
              <select class="form-control select2" style="width: 100%;" required="" ng-model="assetEventDetails.status">
              <option>Select Asset Event</option>
              <option value="LEASE">Lease</option>
              <option value="DONATE">Donate</option>
              <option value="SELL">Sell</option>
              <option value="DISPOSE">Dispose</option>
              <option value="LOST/MISSING">Lost/Missing</option>
              </select>
              </div>              
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label">Event Date</label>
              <div class="col-sm-8">
              <div class="input-group date">
              <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
              <input type="text" class="form-control pull-right" id="event_date" required="" ng-model="assetEventDetails.event_date">
            </div></div>
            </div>
            <div class="form-group">
              <label for="rs-desc" class="col-sm-3 control-label">Description/Remarks</label>
              <div class="col-sm-8"><textarea class="col-sm-8 form-control" id="" rows="3" ng-model="assetEventDetails.remarks"></textarea></div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" ng-click="amdc.addAssetEventBtn(assetEventDetails)">Submit</button>
          </div>
        </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

<!-- MODAL-EDIT HERE HERE -->
    <div class="modal fade" id="modal-edit">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><li class="fa fa-edit"></li> Edit Basic Details of Asset</h4>
          </div>
          <form class="form-horizontal" id="">
          <div class="box-body">
            <div class="form-group col-sm-12">
              <label for="controlnumber" class="col-sm-2 control-label">Asset Tag</label>
              <div class="col-sm-4"><input type="text" class="form-control" id="assettag" placeholder="CONE-03082018-DT1" disabled></div>
            </div>

            <div class="form-group col-sm-12">  
              <label for="assetname" class="col-sm-2 control-label">Asset Name</label>
              <div class="col-sm-10"><input type="text" class="form-control" id="assetname" placeholder="" required="" autofocus></div>
            </div>

            <div class="form-group col-sm-12">
              <label for="controlnumber" class="col-sm-2 control-label">Description</label>
              <div class="col-sm-10"><input type="text" class="form-control" id="description" placeholder="Load Capacity/ Remarks/ Technical Description/ Specification"></div>
            </div>

            <div class="form-group col-sm-12">
              <label for="modelnumber" class="col-sm-2 control-label">Model</label>
              <div class="col-sm-4"><input type="text" class="form-control" id="modelnumber" placeholder="" required=""></div>
              <label for="brandname" class="col-sm-2 control-label">Make/Brand</label>
              <div class="col-sm-4"><input type="text" class="form-control" id="brandname" placeholder=""></div>
            </div>

            <div class="form-group col-sm-12">
              <label class="col-sm-2 control-label">Owner Company</label>
              <div class="col-sm-4">
              <select class="form-control select2" style="width: 100%;" required="">
              <option selected="selected" value="1">PULSAR CONSTRUCTION</option>
              <option value="1">JJE CONSTRUCTION</option>
              </select>
              </div>
              <label class="col-sm-2 control-label">Date Acquired</label>
              <div class="col-sm-4">
              <div class="input-group date">
              <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
              <input type="text" class="form-control pull-right" id="dateacquired">
              </div></div>  
            </div>

            <div class="form-group col-sm-12">
              <label for="acquisitioncost" class="col-sm-2 control-label">Acquisition Cost</label>
              <div class="col-sm-4">
              <div class="input-group date">
              <span class="input-group-addon" style="font-size: 20px;">₱</span>
              <input type="text" class="form-control" id="acquisitioncost" placeholder="" required="">
              </div></div>
              <label for="platenumber" class="col-sm-2 control-label">Plate No.</label>
              <div class="col-sm-4"><input type="text" class="form-control" id="platenumber" placeholder="" required=""></div>
            </div>

            <div class="form-group col-sm-12">
              <label for="enginenumber" class="col-sm-2 control-label">Engine No.</label>
              <div class="col-sm-4"><input type="text" class="form-control" id="enginenumber" placeholder="" required=""></div>
              <label class="col-sm-2 control-label">Warranty Date</label>
              <div class="col-sm-4">
              <div class="input-group date">
              <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
              <input type="text" class="form-control pull-right" id="datewarranty">
              </div></div>
            </div>

            <div class="form-group col-sm-12">           
            <div class="col-sm-8"></div>
            <div class="col-sm-4"><br>
            <button class="btn btn-large btn-primary btn-block" data-toggle="confirmation"
            data-btn-ok-label="Save" data-btn-ok-icon="fa fa-check" data-btn-ok-class="btn-success"
            data-btn-cancel-label="Cancel" data-btn-cancel-icon="fa fa-times" data-btn-cancel-class="btn-danger"
            data-title="Confirm data update." data-content="Are you sure?"> UPDATE
            </button></div></div>
          <!-- /.box-body -->
        </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

</section>