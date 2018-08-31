<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><span class="fa fa-bus"> </span> List of Assets</h1>
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
          <th>Asset Tag</th>
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
          <td><a href="#" ui-sref="asset-list-equipmentsCopy({assetTag:asset.tag})"><b><%asset.tag%></b></a></td>
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
          <li class="pull-left header"><%vm.formData.asset.name%></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="tab_1-1">
            <div class="row">
              <div class="col-sm-6"><br>
                <!-- <img src="../../dist/img/dumptruck3_1024x768.jpg" style="width:100%;height:100%;"> -->
                <img src="{{URL::to('assets/dist/img/dumptruck.jpg')}}" style="width:100%;height:100%;" class="img-square">
              </div>
              <div class="col-sm-6">
                <b>Category:</b> <%vm.formData.asset.asset_name%><br>
                <b>ID:</b> <%vm.formData.asset.code%><br>
                <b>Model:</b> <%vm.formData.asset.model%><br>
                <b>Make/Brand:</b> <%vm.formData.asset.brand%><br>
                <b>Date Acquired:</b> <%vm.formData.asset.date_acquired%><br>
                <b>Acquisition Cost:</b> ₱<%vm.formData.asset.acquisition_cost | number:2%><br>
                <b>Plate No.:</b> <%vm.formData.asset.plate_no%> <br>
                <b>Engine No:</b> <%vm.formData.asset.engine_no%> <br>
                <b>Location:</b> <%vm.formData.asset.municipality_text%><br>
                <b>Assigned to:</b> <a href="#"><%vm.formData.asset.employee_name%></a><br>
                <b>Status:</b> <small class="label bg-green">Active</small><br><br>
              </div>
            </div>        
          </div>
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div>
      
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary pull-right" ui-sref="asset-more-details({assetTag:vm.formData.asset.tag})" ng-click="vm.ok()">
        <li class="fa fa-navicon "></li> More Details</button>
      <button type="button" class="btn btn-info pull-right" style="margin-right: 7px;"><li class="fa fa-print"></li> Print</button>
      <!-- nav-tabs-custom -->
    </div>
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
 
</script>

</section>