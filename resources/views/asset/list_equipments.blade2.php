

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

    <a href="#" class="btn btn-info" style="margin:10px;" ng-click="ac.exportAssets()" > Export Assets </a>
    <div class="box-body">
      <table datatable="ng" class="table table-bordered table-hover" width="100%">
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

</section>


