<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><span class="fa fa-briefcase"> </span> Supplies</h1>
  <ol class="breadcrumb">
    <li><a href="../../index.html"><i class="fa fa-th"></i> Dashboard</a></li>
    <li class="active">Supplies</li>
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
          <h3 class="box-title">Create a new supply</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" id="" ng-model="sc.supplyDetails">
          <div class="box-body">
            <div class="form-group col-sm-12">
              <label class="col-sm-2 control-label">Category*</label>
              <div class="col-sm-10">
              <select class="form-control select2" style="width: 100%;" required="" ng-model="sc.supplyDetails.category">
                <option selected="selected" value="0">- - select supply category - -</option>
                <option ng-value="assetCategory.asset_code" ng-repeat="assetCategory in sc.assetCategories"><%assetCategory.asset_name%></option>
              </select></div>
            </div>
            <div class="form-group col-sm-12">
              <label for="supplyname" class="col-sm-2 control-label">Supply Name*</label>
              <div class="col-sm-10"><input type="text" class="form-control" id="supplyname" required="" ng-model="sc.supplyDetails.supplyName"></div>
            </div>
            <div class="form-group col-sm-12">
              <label for="supplydescription" class="col-sm-2 control-label">Description</label>
              <div class="col-sm-10"><textarea class="col-sm-9 form-control" id="supplydescription" rows="2" ng-model="sc.supplyDetails.description"></textarea></div>
            </div>
            <div class="form-group col-sm-12">
              <label class="col-sm-2 control-label">Stock Unit*</label>
              <div class="col-sm-4">
              <select class="form-control select2" style="width: 100%;" required="" ng-model="sc.supplyDetails.stockUnit">
              <option selected="selected" value="0">- - select stock unit - -</option>
                <option value="1">BOX</option>
                <option value="2">CAN</option>
                <option value="3">ROLL</option>
                <option value="4">UNIT</option>
                <option value="5">PIECE</option>
                <option value="6">DOZEN</option>
                <option value="7">REAM</option>
              </select></div>
            </div>
            <div class="form-group col-sm-12">
              <label for="platenumber" class="col-sm-2 control-label">Re-order Level*</label>
              <div class="col-sm-4"><input type="number" class="form-control" id="reoderlevel" placeholder="" required="" ng-model="sc.supplyDetails.reOrderLevel"></div>
            </div>
            <div class="form-group col-sm-12">
              <label for="supplyimg" class="col-sm-2 control-label">Upload Image</label>
              <div class="col-sm-4">
              <div class="input-group">
              <label class="input-group-btn">
                <span class="btn btn-default">Browse&hellip; <input type="file" style="display: none;"></span>
              </label>
              <input type="text" class="form-control" id="supplyimg" readonly>
            </div> </div>               
            </div>

            <div class="form-group col-sm-12">           
            <div class="col-sm-8"></div>
            <div class="col-sm-4"><br>
            <button class="btn btn-large btn-primary btn-block" data-toggle="confirmation"
            data-btn-ok-label="Save" data-btn-ok-icon="fa fa-check" data-btn-ok-class="btn-success"
            data-btn-cancel-label="Cancel" data-btn-cancel-icon="fa fa-times" data-btn-cancel-class="btn-danger"
            data-title="Confirm data entry." data-content="Are you sure?" ng-click="sc.newSupply(sc.supplyDetails)"> CONFIRMATION
            </button></div></div>
          <!-- /.box-body -->
        </form>
      </div>
      <!-- /.box -->
    </div>
    <!--/.col (left) -->
  </div>
  <!-- /.row -->
</section>