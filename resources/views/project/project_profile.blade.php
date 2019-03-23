<!-- Content Header (Page header) -->
<section class="content-header">
<h1><span class="fa fa-cube"> </span> Project Profile</h1>
<ol class="breadcrumb">
<li><a href="../../index.html"><i class="fa fa-th"></i> Dashboard</a></li>
<li><a href="list-projects.html">Projects</a></li>
<li class="active">Project Profile</li>
</ol>
</section>

<!-- Main content -->
<section class="content">
<div class="row">
<!-- ////// LEFT COLUMN -->
<div class="col-md-11">
  <div class="box box-primary">
    <div class="box-header">
      <h3 class="box-title"><b>BUNTUN BRIDGE PROJECT</b></h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <div class="col-md-5">
        <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="2000">
          <!-- Wrapper for slides -->
          <div class="carousel-inner">
            <div class="item active">
              <img src="../../dist/img/construction-buntun1.jpg" style="width:100%;height:100%;">
              <div class="carousel-caption d-none d-md-block">
                <h3>Buntun Phase 3</h3>
                <p>04/06/2018</p>
              </div>
            </div>
            <div class="item">
              <img src="../../dist/img/construction-buntun2.jpg" style="width:100%;height:100%;">
              <div class="carousel-caption d-none d-md-block">
                <h3>Buntun Phase 2</h3>
                <p>02/02/2018</p>
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
<!-- ////// START OVERVIEW -->
      <div class="col-md-4"> 
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Overview</h3>
          </div>
          <div class="box-body" style="font-size: 14px;">
            <b>Control No.: </b>2017-5310001<br>
            <b>Project ID: </b>5310001<br>
            <b>Project Cost: </b>₱ 1,234,567.00<br>
            <b>Region: </b>Region II<br>
            <b>Province: </b>Cagayan<br>
            <b>Municipality: </b>Tuguegarao City<br>
            <b>Zip Code: </b>3500<br>
            <b>Barangay: </b>Buntun<br>
            <b>Department: </b>Pulsar Construction<br>
            <b>Division: </b>Construction<br>
            <b>Date Assigned: </b>01/30/2017<br>
            <b>Target Date: </b>12/25/2018<br>
            <b>Date Started: </b>02/01/2017<br>
            <b>Project Engineer: </b><a href="../employee/list-employees.html" target="_blank">ENGR. MICHAEL CAPARAS</a><br>
            <b>Date Completed: </b><br>
            <b>Status: </b> <small class="label bg-green">On-going</small>
          </div>
        </div>
      </div>
<!-- ////// END OVERVIEW -->
<!-- ////// START BUTTONS -->
      <div class="col-md-3">
        <div class="box-body">
          <br><br>
          <a class="btn btn-app">
            <i class="fa fa-map-o"></i> Activities
          </a> 
          <a class="btn btn-app">
            <i class="fa fa-file-text-o"></i> Request
          </a> 
          <a class="btn btn-app">
            <i class="fa fa-file-pdf-o"></i> Documents
          </a> 
          <a class="btn btn-app">
            <i class="fa fa-image"></i> Photo
          </a>
          <a class="btn btn-app">
            <i class="fa fa-user"></i> Employees
          </a>
          <a class="btn btn-app" ui-sref="project-profile-copy({projectCode:'123', actionType:'edit'})">
            <i class="fa fa-edit"></i> Edit
          </a>
          <a class="btn btn-app">
            <i class="fa fa-external-link"></i> Assign
          </a>              
          <a href="javascript: window.open('pdfproject.pdf');"  class="btn btn-app">
            <i class="fa fa-print"></i> Print
          </a>
        </div> 
      </div>




<!-- ////// END BUTTONS -->
    </div>
  <div>
</div>    
</div>    
<!-- ////// START ACTIVITIES TAB -->
  <div class="nav-tabs-custom">
    <ul class="nav nav-tabs pull-right tab-head">
      <li><a href="#tab_2-2" data-toggle="tab">Logs</a></li>
      <li class="active"><a href="#tab_3-3" data-toggle="tab">Project Activities</a></li>
      <li class="pull-left header"><h4><i class="fa fa-map-o"></i> Activities</li></h4>
    </ul>
    <div class="tab-content">
      <!-- /.tab-pane -->
      <div class="tab-pane" id="tab_2-2">
        <h4><b>Project Logs</b></h4>
        <table class="table" width="100%">
        <tbody>
        <tr>
          <td><code class="text-success">Edit Target Date</code></td>
          <td>FROM <b>11/16/2018</b></td>
          <td>TO <b>12/25/2018</b></td>
          <td>Change of target date as approved by the Project Engr.</td>
          <td>BY <b>John Juan</b></td>
        </tr><tr>
          <td><code class="text-success">Edit Target Date</code></td>
          <td>FROM <b>11/16/2018</b></td>
          <td>TO <b>12/25/2018</b></td>
          <td>Change of target date as approved by the Project Engr.</td>
          <td>BY <b>John Juan</b></td>
        </tr><tr>
          <td><code class="text-success">Edit Target Date</code></td>
          <td>FROM <b>11/16/2018</b></td>
          <td>TO <b>12/25/2018</b></td>
          <td>Change of target date as approved by the Project Engr.</td>
          <td>BY <b>John Juan</b></td>
        </tr>
        </tbody>
      </table>
      </div>
      <!-- /.tab-pane -->
      <div class="tab-pane active" id="tab_3-3">
        <h4><b>Project Activities</b><button type="button" class="btn btn-xs btn-primary pull-right" data-toggle="modal" data-target="#modal-depreciation">
        <li class="fa fa-plus"></li> Manage</button></h4> 
        <table id="depreciation" class="table" width="100%">
        <thead>
        <tr>
          <th>Date</th>
          <th>Activities</th>
          <th>Remarks</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td>02/07/2012</td>
          <td>Buntun Bridge ground breaking</td>
          <td>Ground breaking ceremonies by Tuguegarao City Government Officials and Administration</td>
        </tr><tr>
          <td>03/03/2012</td>
          <td>Construction of 10 posts finished and inspected</td>
          <td>Remarks here</td>
        </tr>
        </tbody>
      </table>
      </div>
      <!-- /.tab-pane -->        
    </div>
  </div>
<!-- ////// END ACTIVITIES TAB -->
<!-- ////// START ASSET ATTACHMENTS -->
  <div class="nav-tabs-custom">
    <ul class="nav nav-tabs pull-right tab-head">
      <li class="active"><a href="#tab_8-8" data-toggle="tab">Documents</a></li>
      <li class="pull-left header"><h4><i class="fa fa-file-pdf-o"></i> Attachments</li></h4>
    </ul>
    <div class="tab-content">
      <h4><b>Project Documents</b><button type="button" class="btn btn-xs btn-primary pull-right" data-toggle="modal" data-target="#modal-docs">
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
          <td>Project Contract</td>
          <td>PDF</td>
          <td>BuntunContract</td>
          <td>04/01/2018</td>
          <td>Mykee Caparas</td>
          <td><a href="#" data-toggle="modal" data-target="#modal-default"><code class="text-blue">DOWNLOAD</code></a>
          <a href="#" data-toggle="modal" data-target="#modal-warranty"><code class="text-red">DETACH</code></a></td>
        </tr><tr>
          <td>Project Contract</td>
          <td>PDF</td>
          <td>BuntunContract</td>
          <td>04/01/2018</td>
          <td>Mykee Caparas</td>
          <td><a href="#" data-toggle="modal" data-target="#modal-default"><code class="text-blue">DOWNLOAD</code></a>
          <a href="#" data-toggle="modal" data-target="#modal-warranty"><code class="text-red">DETACH</code></a></td>
        </tr><tr>
          <td>Project Contract</td>
          <td>PDF</td>
          <td>BuntunContract</td>
          <td>04/01/2018</td>
          <td>Mykee Caparas</td>
          <td><a href="#" data-toggle="modal" data-target="#modal-default"><code class="text-blue">DOWNLOAD</code></a>
          <a href="#" data-toggle="modal" data-target="#modal-warranty"><code class="text-red">DETACH</code></a></td>
        </tr>

        </tbody>
      </table>
    </div>
    <!-- /.tab-content -->
  </div>
<!-- ////// END ASSET ATTACHMENTS -->
<!-- ////// START REQUISITIONS -->
  <div class="nav-tabs-custom">
    <ul class="nav nav-tabs pull-right tab-head">
      <li class="active"><a href="#tab_8-8" data-toggle="tab">Documents</a></li>
      <li class="pull-left header"><h4><i class="fa fa-file-text-o"></i> Requisitions</li></h4>
    </ul>
    <div class="tab-content">
      <div>
    <button ng-click="my_tree.collapse_all()" class="btn btn-default btn-sm">Collapse All</button>
    <input class="input-sm pull-right" type="text" data-ng-model="filterString" placeholder="Filter" />
    <tree-grid tree-data="tree_data" tree-control="my_tree" col-defs="col_defs" expand-on="expanding_property" on-select="my_tree_handler(branch)" expand-level="1" icon-leaf= "glyphicon glyphicon-globe"></tree-grid>
</div>
    </div>
    <!-- /.tab-content -->
  </div>
<!-- ////// END REQUISITIONS -->
</div>
<!-- /.col -->
</div>
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


<script type="text/ng-template" id="project.edit.modal111">
<!-- MODAL-EDIT HERE HERE -->
<div>
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><li class="fa fa-edit"></li> Edit Project Details</h4>
      </div>
      <form class="form-horizontal" id="">
      <div class="box-body">

        <div class="form-group col-sm-12">
          <label class="col-sm-2 control-label">Department</label>
            <div class="col-sm-10">
              <select class="form-control select2" style="width: 100%;" required="">
                <option selected hidden value="">Select Department</option>
                <option value="1">PULSAR CONSTRUCTION</option>
                <option value="2">DEPTARTMENT 1</option>
                <option value="3">DEPTARTMENT 2</option>
              </select>
            </div>
          </div>
          <div class="form-group col-sm-12">  
          <label class="col-sm-2 control-label">Division</label>
            <div class="col-sm-10">
              <select class="form-control select2" style="width: 100%;" required="">
                <option selected hidden value="">Select Division</option>
                <option value="1">CONSTRUCTION</option>
                <option value="2">OPERATIONS</option>
                <option value="3">ACCOUNTING</option>
                <option value="3">ENGINEERING</option>
              </select>
            </div>
          <hr style="border-color:#e1e1e1;border-width:1px 0;">
        </div>

        <div class="form-group col-sm-12">
        </div>

        <div class="form-group col-sm-12"">
          <label for="controlnumber" class="col-sm-2 control-label">Control Number</label>
          <div class="col-sm-6"><input type="text" class="form-control" id="controlnumber" placeholder="PROJ-01012017-5310001" disabled></div>
        </div>
        <div class="form-group col-sm-12"">
          <label for="projectid" class="col-sm-2 control-label">Project ID</label>
          <div class="col-sm-6"><input type="text" class="form-control" id="projectid" placeholder="" required=""></div>
        </div>
        <div class="form-group col-sm-12"">
          <label for="projectname" class="col-sm-2 control-label">Project Name</label>
          <div class="col-sm-10"><input type="text" class="form-control" id="projectname" placeholder="" required=""></div>
        </div>
        <div class="form-group col-sm-12"">
          <label for="projectname" class="col-sm-2 control-label">Client</label>
          <div class="col-sm-10">
          <select class="form-control select2" style="width: 100%;" required="">
          <option selected="selected" value="1">Client 1</option>
          <option value="2">Client 2</option>
          </select>
          </div>
        </div>
        <div class="form-group col-sm-12"">
          <label for="projectcost" class="col-sm-2 control-label">Project Cost</label>
          <div class="col-sm-4"><input type="number" class="form-control" id="projectcost" placeholder="" required=""></div>
        </div>

        <div class="form-group col-sm-12">
          <hr style="border-color:#e1e1e1;border-width:1px 0;">
        </div>
        <div class="form-group col-sm-12">
          <label class="col-sm-2 control-label">Region</label>
          <div class="col-sm-4">
          <select class="form-control select2" style="width: 100%;" required="">
          <option selected="selected" value="1">Region II</option>
          <option value="2">Region I</option>
          <option value="3">Region III</option>
          </select>
          </div>
          <label class="col-sm-2 control-label">Province</label>
          <div class="col-sm-4">
          <select class="form-control select2" style="width: 100%;" required="">
          <option selected="selected" value="1">Cagayan</option>
          <option value="2">Isabela</option>
          <option value="3">Vizcaya</option>
          <option value="4">Batanes</option>
          <option value="5">Quirino</option>
          </select>
          </div>
        </div>
        <div class="form-group col-sm-12">
          <label class="col-sm-2 control-label">Municipality</label>
          <div class="col-sm-6">
          <select class="form-control select2" style="width: 100%;" required="">
          <option selected="selected" value="1">Tuguegarao City</option>
          <option value="2">Iguig</option>
          <option value="3">Solana</option>
          <option value="4">Enrile</option>
          <option value="5">Peñablanca</option>
          <option value="6">Gonzaga</option>
          <option value="7">Sta. Ana</option>
          </select>
          </div>
          <label for="zipcode" class="col-sm-2 control-label">Zip Code</label>
          <div class="col-sm-2"><input type="text" class="form-control" id="emp_barangay" placeholder="" disabled required=""></div>
        </div>
        <div class="form-group col-sm-12">
          <label class="col-sm-2 control-label">Barangay</label>
          <div class="col-sm-4">
          <select class="form-control select2" style="width: 100%;" required="">
          <option selected="selected" value="1">Ugac Norte</option>
          <option value="2">Caritan</option>
          <option value="3">Pallua</option>
          </select>
          </div>
          <label for="zipcode" class="col-sm-2 control-label">Street/Bldg/Unit</label>
          <div class="col-sm-4"><input type="text" class="form-control" id="emp_street" placeholder=""></div>
        </div>

        <div class="form-group col-sm-12">
        <label class="col-sm-2 control-label">Project Engineer</label>
        <div class="col-sm-4">
        <select class="form-control select2" style="width: 100%;">
          <option selected="selected">Jay Bulan</option>
          <option>Mykee Caparas</option>
          <option>Erick Supnet</option>
        </select>
      </div>
          <label class="col-sm-2 control-label">Date Assigned</label>
          <div class="col-sm-4">
          <div class="input-group date">
          <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
          <input type="text" class="form-control pull-right" id="datepicker4">
        </div></div>
      </div>
        <div class="form-group col-sm-12">
          <label class="col-sm-2 control-label">Target Date</label>
          <div class="col-sm-4">
          <div class="input-group date">
          <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
          <input type="text" class="form-control pull-right" id="datepicker">
        </div></div>
          <label class="col-sm-2 control-label">Date Started</label>
          <div class="col-sm-4">
          <div class="input-group date">
          <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
          <input type="text" class="form-control pull-right" id="datepicker2">
        </div></div>
      </div>
      <div class="form-group col-sm-12">
          <label class="col-sm-2 control-label">Date Completed</label>
          <div class="col-sm-4">
          <div class="input-group date">
          <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
          <input type="text" class="form-control pull-right" id="datepicker3">
        </div></div>
      </div>
      
      
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <div class="pull-right"></div>
        <button class="btn btn-large btn-primary pull-right" data-toggle="confirmation"
        data-btn-ok-label="Save" data-btn-ok-icon="fa fa-check" data-btn-ok-class="btn-success"
        data-btn-cancel-label="Cancel" data-btn-cancel-icon="fa fa-times" data-btn-cancel-class="btn-danger"
        data-title="Comfirmation" data-content="Are you sure?"> Confirmation
        </button>
      </div>
    </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

</script>