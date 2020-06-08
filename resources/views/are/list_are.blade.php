
<!-- Page Loader -->
<div id="loader" ng-if="ac.loader_status"></div>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><span class="fa fa-file-text"> </span> Acknowledgment Receipt of Equipment (ARE)</h1><br>
    <p>The table below displays the list of ARE.To create a new ARE, click <strong>New ARE</strong> and select the necessary information.</p>
  <ol class="breadcrumb">
    <li><a href="../../index.html"><i class="fa fa-th"></i> Dashboard</a></li>
    <li><i class="fa fa-tags"></i> Asset Database</li>
    <li class="active">ARE</li>
  </ol>
</section>

<!-- Main content -->
<section class="content" id="load_div" ng-if="!ac.loader_status">
 

  <div class="row">
    <div class="col-md-12"> 
      <div class="">
        <div class="panel panel-default">
          <div class="panel-body">
          <!-- NEW INSURANCE -->
          <form class="form-horizontal" id="" ng-model="ac.insuranceDetails">
            <div class="box-body">
              <div class="form-group col-sm-12">
                <label for="controlnumber" class="col-sm-2 control-label">Employee Name</label>
                <div class="col-sm-4">
                  <select class="form-control select2" style="width: 100%;" required="" ng-model="ac.areDetails.employeeCode">
                    <option selected="selected" value="">Select Employee</option>
                    <option ng-value="employee.employee_code" ng-repeat="employee in ac.employees"><%employee.employee_name%></option>
                  </select>
                </div>
                <div class="col-sm-4">
                  <button class="btn btn-large btn-success pull-right" data-toggle="confirmation"
                  data-btn-ok-label="Yes" data-btn-ok-icon="fa fa-check" data-btn-ok-class="btn-success"
                  data-btn-cancel-label="No" data-btn-cancel-icon="fa fa-times" data-btn-cancel-class="btn-danger"
                  data-title="Confirm data entry." data-content="Are you sure?" style="width: 40%;margin-left: 5%;" ng-click="ac.newAreBtn(ac.areDetails);ac.toggle()"> CONFIRMATION
                  </button>

                </div>
       
              </div>
             </div> 
          </form>
          </div>
        </div>
      </div>
      <!-- BUTTONS -->
      <button class="btn btn-primary" data-toggle="modal" data-target="#modal-view-are">
          <span class="glyphicon glyphicon-plus"></span> New ARE
      </button> <br><br>
    </div>
  </div><br>        

<!-- TABLES -->
  <div class="row">
    <div class="col-md-12"> 
      <div class="box box-primary">
        <div class="box-body">
          <div export-to-xlsx data="ac.ares" bind-to-table="'tb-are'" filename="'Acknowledgment Receipt of Equipment (ARE)'"></div>
          <table datatable="ng" class="table table-bordered table-hover" name="tb-are" width="100%">
            <thead>
            <tr>
              <th>ARE Number</th>
              <th>ARE Date</th>
              <th>Employee ID</th>
              <th>Employee Name</th>
              <th>Department</th>
              <th>Division</th>
              <th>Unit</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="are in ac.ares">
              <td><a href="#" ui-sref="list-aresCopy({areCode:are.are_code})"><b><%are.are_code%></b></a></td>
              <td><%are.created_at%></td>
              <td><%are.employee_code%></td>
              <td><%are.employee_name%></td>
              <td><%are.department%></td>
              <td><%are.division%></td>
              <td><%are.unit%></td>
            </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>

<script type="text/javascript">
$(function () {

$('.select2').select2();

//   $('#datepicker').datepicker({
//    autoclose: true
//   })

});
</script>

<!-- MODAL CONTENTS -->
<script type="text/ng-template" id="areInfo.modal"> 
<d<div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" ui-sref="list-ares" ng-click="vm.ok()">
            <span aria-hidden="true">&times;</span></button>
          <div class="col-sm-3"><h4 class="modal-title"><li class="fa fa-file-text-o"></li> <b><%vm.formData.are_code%></b></h4></div>
          <div class="col-sm-5">
            <!-- <select class="form-control select2" style="width: 100%;" required="">
              <option selected="selected" value="">Select Employee</option>
              <option value="1">Mykee Caparas</option>
              <option value="2">Erik Supnet</option>
              <option value="3">Jay Bulan</option>
            </select> -->
            </div>

        </div>
        <div class="modal-body">
          <h3><li class="fa fa-search"></li> Browse </h3>
          <p>To add an asset to the ARE, search an item and click the <strong>plus button</strong> beside it.</p>
          <!-- <table datatable="ng" class="table table-bordered table-hover" width="100%">
            <thead>
            <tr>
              <th style="width: 10px;"></th>
              <th>Asset Tag</th>
              <th>ID</th>
              <th>Category</th>
              <th>Name</th>
              <th>Model</th>
              <th>Brand</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="availableAsset in vm.availableAssets">
              <td align="center"><button type="button" class="btn btn-primary btn-xs fa fa-plus" ng-click="vm.assignAssetBtn(availableAsset.tag)"></button></td>
              <td><a href="#"><b><%availableAsset.tag%></b></a></td>
              <td><%availableAsset.code%></td>
              <td><%availableAsset.asset_name%></td>
              <td><%availableAsset.name%></td>
              <td><%availableAsset.model%></td>
              <td><%availableAsset.brand%></td>
            </tr>
            </tbody>
          </table> -->

          <form ng-submit="vm.addNew()" >
            <table class="table table-striped table-bordered" class="tbl_rs_supply">
              <thead>
                <tr>
                  <!-- <th><input type="checkbox" ng-model="selectedAll" ng-click="vm.checkAll()" /></th>  -->
                  <th>Asset Tag</th>
                  <th width="25%"> Start Date</th>
                  <!-- <th width="25%"> Ended At</th> -->
              </thead>
              <tbody>
                <tr ng-repeat="assetItemDetail in vm.assetItemDetails" >
                  <!-- <td><input type="checkbox" ng-model="assetItemDetail.selected"/></td>  -->
                  <td>
                    <select class="form-control select2" style="width: 100%;" required="" ng-model="assetItemDetail.asset_code" ng-init="parentIndex = $index" ng-change="vm.selectAsset(parentIndex, assetItemDetail.asset_code)">
                      <option value="">- - Select Asset - -</option>
                      <option ng-value="availableAsset.asset_code" ng-repeat="availableAsset in vm.availableAssets"><%availableAsset.tag%></option>
                    </select>
                  </td>
                  <td><input type="text" class="form-control" ng-model="assetItemDetail.started_at" required/></td>
                  <!-- <td><input type="text" class="form-control" ng-model="assetItemDetail.ended_at" required/></td> -->
                </tr>
              </tbody>
            </table>
            <div class="form-group">
              <div class="form-group">
                <input type="button" class="btn btn-info pull-right" value="Submit Form" style="margin-right: 10px;" ng-click="vm.addAreItems(vm.assetItemDetails)">
                <!-- <button ng-hide="!vm.assetItemDetails.length" type="button" class="btn btn-danger pull-left fa fa-trash-o" ng-click="vm.remove()"></button>
                <button type="submit" class="pull-left btn btn-primary fa fa-plus addnew"></button> -->
              </div>
            </div>
          </form>

          <br><hr>
          <h3><li class="fa fa-link"></li> Acknowledged Items</h3>
          <p>
          Following assets are covered by this Acknowledgment Receipt of Equipment (ARE).</p>
          <table datatable="ng" class="table table-bordered table-hover" width="100%">
            <thead>
            <tr>
              <th>Asset Tag</th>
              <th>ID</th>
              <th>Category</th>
              <th>Name</th>
              <th>Model</th>
              <th>Brand</th>
              <th>Start</th>
              <th>End</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="assignedAsset in vm.assignedAssets">
              <td><a href="#"><b><%assignedAsset.tag%></b></a></td>
              <td><%assignedAsset.code%></td>
              <td><%assignedAsset.asset_name%></td>
              <td><%assignedAsset.name%></td>
              <td><%assignedAsset.model%></td>
              <td><%assignedAsset.brand%></td>
              <td><%assignedAsset.started_at%></td>
              <td><%assignedAsset.ended_at%></td>
            </tr> 
            </tbody>
          </table>
        </div>   
        <br>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-info"><li class="fa fa-print"></li> Print</button>
          <button class="btn btn-large btn-primary pull-right" data-toggle="confirmation"
            data-btn-ok-label="Yes" data-btn-ok-icon="fa fa-check" data-btn-ok-class="btn-success"
            data-btn-cancel-label="No" data-btn-cancel-icon="fa fa-times" data-btn-cancel-class="btn-danger"
            data-title="Confirm data change." data-content="Are you sure?" style="width: 12%;"> Save Changes
          </button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
</script>