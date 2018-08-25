<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><span class="fa fa-tags"> </span> Assets</h1>
  <ol class="breadcrumb">
    <li><a href="../../index.html"><i class="fa fa-th"></i> Dashboard</a></li>
    <li class="active">Assets</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-8">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Add a new asset</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" id=""  >
          <div class="box-body">
            
            <div class="form-group col-sm-12">
              <label class="col-sm-2 control-label">Asset Category* </label>
              <div class="col-sm-10">
              <select class="form-control select2" style="width: 100%;" required="" ng-model="ac.assetsDetails.categoryCode" ng-change="ac.assetTag(ac.assetsDetails)">
                <option selected="selected" value="0">- - - Select Category - - -</option>
                <option value="<%category.asset_code%>" ng-repeat="category in ac.asset_categories"><%category.asset_name +" ("+category.asset_code+")"%></option>
              </select>
              </div>
            </div>
            <div class="form-group col-sm-12">  
              <label for="assetname" class="col-sm-2 control-label">Asset Name*</label>
              <div class="col-sm-4"><input type="text" class="form-control" id="assetName" ng-model="ac.assetsDetails.assetName" placeholder="" required="" autofocus ></div>
              <label for="assetID" class="col-sm-2 control-label">Asset ID*</label>
              <div class="col-sm-4"><input type="text" class="form-control" id="assetID" ng-model="ac.assetsDetails.assetID" placeholder="" required="" ng-keyup="ac.assetTag(ac.assetsDetails)"></div>
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
              <input type="text" class="form-control pull-right datepicker" datepicker ng-model="ac.assetsDetails.dateAcquired">
            </div></div>
              <label for="acquisitioncost" class="col-sm-2 control-label">Acquisition Cost*</label>
              <div class="col-sm-4">
              <div class="input-group date">
              <span class="input-group-addon" style="font-size: 20px;">₱</span>
              <input type="number" class="form-control" id="acquisitionCost" ng-model="ac.assetsDetails.acquisitionCost" placeholder="" required="">
            </div></div>
            </div>
            <div class="form-group col-sm-12">
              <label for="platenumber" class="col-sm-2 control-label">Plate No.</label>
              <div class="col-sm-4"><input type="text" class="form-control" id="plateNumber" ng-model="ac.assetsDetails.plateNumber" placeholder="" required=""></div>
              <label for="enginenumber" class="col-sm-2 control-label">Engine/Serial No.</label>
              <div class="col-sm-4"><input type="text" class="form-control" id="engineNumber" ng-model="ac.assetsDetails.engineNumber" placeholder="" required=""></div>
            </div>
            <div class="form-group col-sm-12">
              <label for="platenumber" class="col-sm-2 control-label">Chassis No.</label>
              <div class="col-sm-4"><input type="text" class="form-control" id="chassisNumber" ng-model="ac.assetsDetails.chassisNumber" placeholder="" required=""></div>
            </div>
            <div class="form-group col-sm-12">
              <div class="col-sm-8"></div>
              <div class="pull-right col-sm-2">
              <button class="btn btn-large btn-primary" data-toggle="confirmation"
              data-btn-ok-label="Save" data-btn-ok-icon="fa fa-check" data-btn-ok-class="btn-success"
              data-btn-cancel-label="Cancel" data-btn-cancel-icon="fa fa-times" data-btn-cancel-class="btn-danger"
              data-title="Comfirmation" data-content="Are you sure?" type="submit" ng-click="ac.submit(ac.assetsDetails)"> Confirmation
              </button>
          </div></div>
          <!-- /.box-body -->
        </form>
      </div>
      <!-- /.box -->
    </div>
    <!--/.col (left) -->
  </div>
  <!-- /.row -->
</section>