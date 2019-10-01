<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><span class="fa fa-shield"> </span> Insurance</h1>
    <p>The list below displays insurance policies associated with your asset.<br>
    To create a new contract, click <strong>New Insurance</strong> and enter the necessary information.</p>
  <ol class="breadcrumb">
    <li><a href="../../index.html"><i class="fa fa-th"></i> Dashboard</a></li>
    <li><i class="fa fa-cloud"></i> Advanced</li>
    <li class="active"><i class="fa fa-bank"></i> Banks</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
    <div class="col-md-12"> 
      <div class="" ng-show="ic.state">
        <div class="panel panel-default">
          <div class="panel-body">
<!-- NEW INSURANCE -->
        <form class="form-horizontal" id="" ng-model="ic.insuranceDetails">
          <div class="box-body">
            <div class="form-group col-sm-12">
              <label for="controlnumber" class="col-sm-2 control-label">Control Number</label>
              <div class="col-sm-4"><input type="text" class="form-control" id="controlnumber" placeholder="INSU-04082018-1" disabled></div>
            </div>
            <div class="form-group col-sm-12">
              <label for="controlnumber" class="col-sm-2 control-label">Insurance Co.</label>
              <div class="col-sm-10"><input type="text" class="form-control" id="insu_co" autofocus="" ng-model="ic.insuranceDetails.insurance_co"></div>
            </div>
            <div class="form-group col-sm-12">
              <label for="controlnumber" class="col-sm-2 control-label">Description</label>
              <div class="col-sm-10"><textarea class="form-control" id="insu_desc" rows="2" ng-model="ic.insuranceDetails.description"></textarea> </div>
            </div>
            <div class="form-group col-sm-12">
              <label for="controlnumber" class="col-sm-2 control-label">Policy Number</label>
              <div class="col-sm-4"><input type="text" class="form-control" id="insu_num" ng-model="ic.insuranceDetails.policy_number"></div>
              <label for="controlnumber" class="col-sm-2 control-label">Insurance Coverage</label>
              <div class="col-sm-4"><input type="text" class="form-control" id="insu_cov" ng-model="ic.insuranceDetails.insurance_coverage"></div>
            </div>
            <div class="form-group col-sm-12">
              <label class="col-sm-2 control-label">Date Issued</label>
              <div class="col-sm-4">
              <div class="input-group date">
              <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
              <input type="text" class="form-control pull-right" id="insu_dateissue" datepicker2 ng-model="ic.insuranceDetails.date_issued">
            </div></div>

              <label class="col-sm-2 control-label">Expiration Date</label>
              <div class="col-sm-4">
              <div class="input-group date">
              <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
              <input type="text" class="form-control pull-right" id="insu_dateexpire"  datepicker2 ng-model="ic.insuranceDetails.expiration_date">
            </div></div>
            </div>
            <div class="form-group col-sm-12">
              <label for="controlnumber" class="col-sm-2 control-label">Applicable Premium</label>
              <div class="col-sm-10"><input type="text" class="form-control" id="insu_desc" ng-model="ic.insuranceDetails.applicable_premium"></div>
            </div>
            <div class="form-group col-sm-12">
              <label for="controlnumber" class="col-sm-2 control-label">Insurance Agent</label>
              <div class="col-sm-4"><input type="text" class="form-control" id="insu_desc" ng-model="ic.insuranceDetails.insurance_agent"></div>
              <label for="controlnumber" class="col-sm-2 control-label">Email Address</label>
              <div class="col-sm-4"><input type="text" class="form-control" id="insu_desc" ng-model="ic.insuranceDetails.email"></div>
            </div>
            <div class="form-group col-sm-12">
              <label for="controlnumber" class="col-sm-2 control-label">Mobile #</label>
              <div class="col-sm-4"><input type="text" class="form-control" id="insu_desc" ng-model="ic.insuranceDetails.mobile_number"></div>
              <label for="controlnumber" class="col-sm-2 control-label">Telephone #</label>
              <div class="col-sm-4"><input type="text" class="form-control" id="insu_desc" ng-model="ic.insuranceDetails.telephone_number"></div>
            </div>
            <div class="form-group col-sm-12">
              
            </div>
           </div> 
          <!-- /.box-body -->
          <div class="box-footer">
            <div class="form-group col-sm-12">           
              <div class="col-sm-8"></div>
              <div class="col-sm-4">
              <button class="btn btn-large btn-success pull-right" data-toggle="confirmation"
              data-btn-ok-label="Yes" data-btn-ok-icon="fa fa-check" data-btn-ok-class="btn-success"
              data-btn-cancel-label="No" data-btn-cancel-icon="fa fa-times" data-btn-cancel-class="btn-danger"
              data-title="Confirm data entry." data-content="Are you sure?" style="width: 40%;margin-left: 5%;" ng-click="ic.newInsurance(ic.insuranceDetails);ic.toggle()"> CONFIRMATION
              </button>
              <button type="button" class="btn btn-primary pull-right" ng-click="ic.toggle()"> 
                <div ng-if="ic.state"> Cancel </div>
              </button>
            </div></div>
          </div>
        </form>
          </div>
        </div>
      </div>
<!-- BUTTONS -->
      <button type="button" class="btn btn-primary" ng-click="ic.toggle()" ng-if="!ic.state">
          <div ><span class="glyphicon glyphicon-plus"></span> New Insurance </div>
      </button>
    </div>
  </div><br>  
<!-- TABLES -->
  <div class="row">
    <div class="col-md-12"> 
      <div class="box box-primary">
        <div class="box-body">
          <table id="tbl-insurance" class="table table-bordered table-hover" width="100%" datatable="ng">
            <thead>
            <tr>
              <th>Status</th>
              <th>Insurance Co.</th>
              <th>Description</th>
              <th>Insurance Coverage</th>
              <th>Date Issued</th>
              <th>Expiration Date</th>
              <th>Expires In (days)</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="insurance in ic.insurance">
              <td>Active</td>
              <td><a href="#" ui-sref="list-insuranceCopy({insuranceCode:insurance.insurance_code})"><b><%insurance.insurance_co%></b></a></td>
              <td><%insurance.description%></td>
              <td><%insurance.insurance_coverage%></td>
              <td><%insurance.date_issued%></td>
              <td><%insurance.expiration_date%></td>
              <td><%insurance.expires_in%></td>
            </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- MODAL CONTENTS -->
<script type="text/ng-template" id="insuranceInfo.modal"> 
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" ng-click="vm.ok()" ui-sref="list-insurance">
        <span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title"><li class="fa fa-shield"></li> <b><%vm.formData.insurance_co%></b> (Policy #: <%vm.formData.policy_number%>)</h4>
      </div>
    <div class="modal-body">
                <!-- Custom Tabs (Pulled to the right) -->
                <div class="nav-tabs-custom">
                  <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#tab_1-1" data-toggle="tab">Associate Assets</a></li>
                    <li><a href="#tab_2-2" data-toggle="tab">Insurance Details</a></li>
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane active" id="tab_1-1">
      <h3>Associated Assets</h3>
      <p>Following assets are covered by this insurance policy:</p>
          <table id="tbl-linked-assets" class="table table-bordered table-hover" width="100%" datatable="ng"> 
            <thead>
            <tr>
              <th> </th>
              <th>Asset Code</th>
              <th>ID</th>
              <th>Category</th>
              <th>Name</th>
              <th>Model</th>
              <th>Brand</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="associatedAsset in vm.associatedAssets">
              <td align="center">
                <button type="button" class="btn btn-danger btn-xs fa fa-minus" ng-click="vm.removeInsuranceItems(associatedAsset.insurance_item_code)"></button>
              </td> 
              <td><%associatedAsset.asset_code%></td>
              <td><%associatedAsset.code%></td>
              <td><%associatedAsset.category%></td>
              <td><%associatedAsset.name%></td>
              <td><%associatedAsset.model%></td>
              <td><%associatedAsset.brand%></td>
            </tr>
            </tbody>
          </table>
          
          <br><hr>
          <h3><li class="fa fa-link"></li> Associate New Assets</h3>
          <p>Select assets that are connected to your insurance policy. To associate assets, check boxes next to all of the assets for the insurance policy and select <strong>Associate Assets</strong>.</p>
              <table id="tbl-assets" class="table table-bordered table-hover" width="100%" datatable="ng">
                <thead>
                <tr>
                  <th> </th> 
                  <th>Asset Code</th>
                  <th>ID</th>
                  <th>Category</th>
                  <th>Name</th>
                  <th>Model</th>
                  <th>Brand</th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="availableAsset in vm.availableAssets">
                  <td align="center">
                    <button class="btn btn-primary btn-xs fa fa-plus" ng-click="vm.addInsuranceItems(availableAsset.asset_code)"></button>
                  </td> 
                  <td><a href="#"><b><%availableAsset.asset_code%></b></a></td>
                  <td><%availableAsset.code%></td>
                  <td><%availableAsset.category%></td>
                  <td><%availableAsset.name%></td>
                  <td><%availableAsset.model%></td>
                  <td><%availableAsset.brand%></td>
                </tr>
                </tbody>
              </table>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_2-2">
                      <!-- form start -->
                      <!-- EDIT INSURANCE -->

                          <div class="box-body">
                            <div class="form-group col-sm-12">
                              <label for="controlnumber" class="col-sm-2 control-label">Control Number</label>
                              <div class="col-sm-4"><input type="text" class="form-control" id="controlnumber" placeholder="INSU-04082018-1" disabled ng-model="vm.formData.insurance_code"></div>
                            </div>
                            <div class="form-group col-sm-12">
                              <label for="controlnumber" class="col-sm-2 control-label">Insurance Co.</label>
                              <div class="col-sm-10"><input type="text" class="form-control" id="insu_co" autofocus="" ng-model="vm.formData.insurance_co">
                              </div>
                            </div>
                            <div class="form-group col-sm-12">
                              <label for="controlnumber" class="col-sm-2 control-label">Description</label>
                              <div class="col-sm-10"><textarea class="form-control" id="insu_desc" rows="2" ng-model="vm.formData.description"></textarea> </div>
                            </div>
                            <div class="form-group col-sm-12">
                              <label for="controlnumber" class="col-sm-2 control-label">Policy Number</label>
                              <div class="col-sm-4"><input type="text" class="form-control" id="insu_num" ng-model="vm.formData.policy_number"></div>
                              <label for="controlnumber" class="col-sm-2 control-label">Insurance Coverage</label>
                              <div class="col-sm-4"><input type="text" class="form-control" id="insu_cov" ng-model="vm.formData.insurance_coverage"></div>
                            </div>
                            <div class="form-group col-sm-12">
                              <label class="col-sm-2 control-label">Date Issued</label>
                              <div class="col-sm-4">
                              <div class="input-group date">
                              <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                              <input type="text" class="form-control pull-right" id="insu_dateissue" datepicker2 ng-model="vm.formData.date_issued">
                            </div></div>

                              <label class="col-sm-2 control-label">Expiration Date</label>
                              <div class="col-sm-4">
                              <div class="input-group date">
                              <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                              <input type="text" class="form-control pull-right" id="insu_dateexpire" datepicker2 ng-model="vm.formData.expiration_date">
                            </div></div>
                            </div>
                            <div class="form-group col-sm-12">
                              <label for="controlnumber" class="col-sm-2 control-label">Applicable Premium</label>
                              <div class="col-sm-10"><input type="text" class="form-control" id="insu_desc" ng-model="vm.formData.applicable_premium"></div>
                            </div>
                            <div class="form-group col-sm-12">
                              <label for="controlnumber" class="col-sm-2 control-label">Insurance Agent</label>
                              <div class="col-sm-4"><input type="text" class="form-control" id="insu_desc" ng-model="vm.formData.insurance_agent"></div>
                              <label for="controlnumber" class="col-sm-2 control-label">Email Address</label>
                              <div class="col-sm-4"><input type="text" class="form-control" id="insu_desc" ng-model="vm.formData.email"></div>
                            </div>
                            <div class="form-group col-sm-12">
                              <label for="controlnumber" class="col-sm-2 control-label">Mobile #</label>
                              <div class="col-sm-4"><input type="text" class="form-control" id="insu_desc" ng-model="vm.formData.mobile_number"></div>
                              <label for="controlnumber" class="col-sm-2 control-label">Telephone #</label>
                              <div class="col-sm-4"><input type="text" class="form-control" id="insu_desc" ng-model="vm.formData.telephone_number"></div>
                            </div>
                           </div> 
                          <!-- /.box-body -->
                        </form>
                        <button class="btn btn-large btn-primary pull-right" data-toggle="confirmation"
                        data-btn-ok-label="Yes" data-btn-ok-icon="fa fa-check" data-btn-ok-class="btn-success"
                        data-btn-cancel-label="No" data-btn-cancel-icon="fa fa-times" data-btn-cancel-class="btn-danger"
                        data-title="Confirm data change." data-content="Are you sure?" style="width: 12%;" ng-click="vm.updateInsurance(vm.formData)" ui-sref="list-insurance"> Save Changes
                      </button>
                    </div>
                    <!-- /.tab-pane -->
                  </div>
                  <!-- /.tab-content -->
                </div>


        </div>  
<br>
    <div class="modal-footer">
      <button type="button" class="btn btn-default pull-left" ui-sref="list-insurance">Close</button>
      <button type="button" class="btn btn-info"><li class="fa fa-print"></li> Print</button>
      
    </div>
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</script>

