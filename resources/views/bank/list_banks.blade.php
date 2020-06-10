
<section class="content-header">
  <h1><span class="fa fa-building"> </span> Banks</h1>
  <p>Manage Banks information.</p>
  <ol class="breadcrumb">
    <li><a href=""><i class="fa fa-th"></i> Dashboard</a></li>
    <li><i class="fa fa-cloud"></i> Advanced</li>
    <li class="active"><i class="fa fa-bank"></i> Banks</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12"> 
      <div class="department" ng-show="bc.state">
        <div class="panel panel-default">
          <div class="panel-body">
          <!-- NEW BANK -->
            <form id="from-bank" class="form-inline" role="form" ng-model="bc.bankDetails">
              <div class="form-group col-sm-12">
                  <h4>Basic Information:</h4><br>
                </div>
                <div class="form-group col-sm-12">
                  <label class="col-sm-2 control-label">Bank Name</label>
                  <div class="col-sm-7">
                  <input type="text" class="form-control" id="bank-name" style="width: 100%;" required="" ng-model="bc.bankDetails.bank_name">
                  </div>
                  <!-- <label for="zipcode" class="col-sm-1 control-label">St/Bldg/Unit</label>
                  <div class="col-sm-3"><input type="text" class="form-control" id="bank-street" style="width: 100%;" required=""></div> -->
                </div>
                <div class="form-group col-sm-12">
                  <label class="col-sm-2 control-label">Business Address</label>
                  <div class="col-sm-7">
                  <input type="text" class="form-control" id="bank-branch" style="width: 100%;" required="" ng-model="bc.bankDetails.branch">
                  </div>
                  <!-- <label for="zipcode" class="col-sm-1 control-label">St/Bldg/Unit</label>
                  <div class="col-sm-3"><input type="text" class="form-control" id="bank-street" style="width: 100%;" required=""></div> -->
                </div>
                <!-- <div class="form-group col-sm-12">
                  <label class="col-sm-1 control-label">Region</label>
                  <div class="col-sm-4">
                  <select class="form-control select2" style="width: 100%;" required="">
                  <option selected="selected" value="1">Region II</option>
                  <option value="2">Region I</option>
                  <option value="3">Region III</option>
                  </select>
                  </div>
                  <label class="col-sm-1 control-label">Province</label>
                  <div class="col-sm-3">
                  <select class="form-control select2" style="width: 100%;" required="">
                  <option selected="selected" value="1">Cagayan</option>
                  <option value="2">Isabela</option>
                  <option value="3">Vizcaya</option>
                  <option value="4">Batanes</option>
                  <option value="5">Quirino</option>
                  </select>
                  </div>
                  <div class="col-sm-1"><input type="text" class="form-control" id="bank-zipcode" placeholder="Zip Code" disabled required=""></div>
                </div>
                <div class="form-group col-sm-12">
                  <label class="col-sm-1 control-label">Municipality</label>
                  <div class="col-sm-4">
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
                  <label class="col-sm-1 control-label">Barangay</label>
                  <div class="col-sm-3">
                  <select class="form-control select2" style="width: 100%;" required="">
                  <option selected="selected" value="1">Ugac Norte</option>
                  <option value="2">Caritan</option>
                  <option value="3">Pallua</option>
                  </select>
                  </div>
                </div> -->
                <br>
                <div class="form-group col-sm-12"><br>
                  <h4>Contact Details:</h4><br>
                </div>
                <div class="form-group col-sm-12">
                  <label class="col-sm-1 control-label">Manager</label>
                  <div class="col-sm-4"><input type="text" class="form-control" id="bank-manager" style="width: 100%;" required="" ng-model="bc.bankDetails.manager"></div>
                  <label for="zipcode" class="col-sm-1 control-label">Mobile No.</label>
                  <div class="col-sm-3"><input type="number" class="form-control" id="bank-mobile" style="width: 100%;" required="" ng-model="bc.bankDetails.mobile_number"></div>
                </div>
                <div class="form-group col-sm-12">
                  <label class="col-sm-1 control-label">Email</label>
                  <div class="col-sm-4"><input type="text" class="form-control" id="bank-email" style="width: 100%;" required="" ng-model="bc.bankDetails.manager_email"></div>
                  <label class="col-sm-1 control-label">Telephone No.</label>
                  <div class="col-sm-3"><input type="number" class="form-control" id="bank-telephone" style="width: 100%;" required="" ng-model="bc.bankDetails.telephone_number"></div>
                </div>
                <div class="form-group col-sm-12">
                  <div class="col-sm-6"></div>
                    <div class="col-sm-3">
                    <hr style="border-color:#e1e1e1;border-width:1px 0;">
                    <button class="btn btn-large btn-success btn-block" data-toggle="confirmation"
                    data-btn-ok-label="Save" data-btn-ok-icon="fa fa-check" data-btn-ok-class="btn-success"
                    data-btn-cancel-label="Cancel" data-btn-cancel-icon="fa fa-times" data-btn-cancel-class="btn-danger"
                    data-title="Confirm data entry." data-content="Are you sure?" ng-click="bc.newBank(bc.bankDetails)"> CONFIRMATION
                    </button>
                  </div>
                </div>
            </form>
          </div>
        </div>
      </div>
      <!-- BUTTONS -->
      <button type="button" class="btn btn-primary" ng-click="bc.toggle()">
        <div ng-if="!bc.state"><span class="glyphicon glyphicon-plus"></span> New Bank </div>
        <div ng-if="bc.state"> Cancel </div>
      </button>

    </div>
  </div><br>  
<!-- TABLES -->
  <div class="row">
    <div class="col-md-12"> 
      <div class="box box-primary">
        <div class="box-body">
          <table id="employees" class="table table-bordered table-hover" width="100%" >
            <thead>
            <tr>
              <th>Name of Bank</th>
              <th>Business Address</th>
              <!-- <th>Address</th> -->
              <th>Manager</th>
              <th>Mobile No.</th>
              <th>Telephone No.</th>
              <th>Email</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="bank in bc.banks">
              <td><a href="#" ui-sref="list-banksCopy({bankCode:bank.bank_code})"><b><%bank.bank_name%></b></a></td>
              <td><%bank.branch%></td>
              <!-- <td> </td> -->
              <td><%bank.manager%></td>
              <td><%bank.mobile_number%></td>
              <td><%bank.telephone_number%></td>
              <td><%bank.manager_email%></td>
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
<script type="text/ng-template" id="bankInfo.modal"> 
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" ui-sref="list-banks" ng-click="vm.ok()">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Bank Information</h4>
      </div>
      <div class="modal-body">
        <!-- Custom Tabs (Pulled to the right) -->
        <form class="form-horizontal" id="">
                  <div class="box-body">
                    <div class="form-group col-sm-12">
                      <label class="col-sm-2 control-label">Bank Name</label>
                      <div class="col-sm-10">
                         <input type="text" class="form-control" id="" required="" ng-model="vm.formData.bank_name">
                      </div>
                    </div>
                    <div class="form-group col-sm-12">
                      <label class="col-sm-2 control-label">Business Address</label>
                      <div class="col-sm-10">
                         <input type="text" class="form-control" id="" required="" ng-model="vm.formData.branch">
                      </div>
                    </div>
                    <div class="form-group col-sm-12">
                    </div>
                  <div class="form-group col-sm-12">
                    <label class="col-sm-2 control-label">Manager</label>
                    <div class="col-sm-4">
                       <input type="text" class="form-control" id="" required="" ng-model="vm.formData.manager">
                    </div>
                    <label class="col-sm-2 control-label">Mobile No.</label>
                    <div class="col-sm-4">
                       <input type="number" class="form-control" id="" required="" ng-model="vm.formData.mobile_number">
                    </div>
                  </div>
                  <div class="form-group col-sm-12">
                    <label class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-4">
                       <input type="text" class="form-control" id="" required="" ng-model="vm.formData.manager_email">
                    </div>
                    <label class="col-sm-2 control-label">Telephone No.</label>
                    <div class="col-sm-4">
                       <input type="number" class="form-control" id="" required="" ng-model="vm.formData.telephone_number">
                    </div>
                  </div>
                </div>
                  <!-- /.box-body -->
                
        </form>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button class="btn btn-large btn-danger pull-left" data-toggle="confirmation"
          data-btn-ok-label="Yes" data-btn-ok-icon="fa fa-check" data-btn-ok-class="btn-success"
          data-btn-cancel-label="No" data-btn-cancel-icon="fa fa-times" data-btn-cancel-class="btn-danger"
          data-title="Confirmation." data-content="Are you sure?" style="width: 10%;"> Delete
        </button> -->
        <button class="btn btn-large btn-success pull-right" data-toggle="confirmation"
          data-btn-ok-label="Yes" data-btn-ok-icon="fa fa-check" data-btn-ok-class="btn-success"
          data-btn-cancel-label="No" data-btn-cancel-icon="fa fa-times" data-btn-cancel-class="btn-danger"
          data-title="Confirm data entry." data-content="Update entry?" style="width: 20%;" ng-click="vm.updateBank(vm.formData)"> Update
        </button>
        <!-- nav-tabs-custom -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog --> 
</script>
<!-- /.modal