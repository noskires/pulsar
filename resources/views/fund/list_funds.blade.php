<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><span class="fa fa-shield"> </span> Funds</h1>
   <!--  <p>The list below displays insurance policies associated with your asset.<br>
    To create a new contract, click <strong>New Insurance</strong> and enter the necessary information.</p> -->
  <ol class="breadcrumb">
    <li><a href="../../index.html"><i class="fa fa-th"></i> Dashboard</a></li>
    <li><i class="fa fa-cloud"></i> Advanced</li>
    <li class="active"><i class="fa fa-bank"></i> Funds</li>
  </ol>
</section>

<!-- Main content -->

<section class="content">
  <div class="col-md-9"> 
    <h4><b>Funds</b> &nbsp; 
    <button type="button" class="btn btn-primary pull-right" ui-sref="fund-create({fundRequest:'new'})"> <li class="fa fa-plus"></li> </button></h4> 
    <div class="box box-primary">
      <div class="box-body">
        <table id="suppliers" class="table table-bordered table-hover"   datatable="ng">
          <thead>
          <tr>
            <th>Fund Code</th>
            <th>Fund Year</th>
            <th>Fund Name</th>
            <th align="right">Amount</th>
            <th></th>
          </tr>
          </thead>
          <tbody>
          <tr ng-repeat="fund in fc.funds">
          <td><a href="#" ui-sref="list-fundCopy({fundCode:fund.fund_code})"><b> <%fund.fund_code%> </b></a></td>
          <td><%fund.fund_year%></td>
          <td><%fund.fund_name%></td>
          <td><%fund.total_fund_item_amount | number:2%></td>
          <td> <a href="#" ui-sref="edit-fund({fundCode2:fund.fund_code})"><b> Edit </b></a></td>
        </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

<script type="text/ng-template" id="fundNew.modal">
  <div>
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" ui-sref="list-fund" ng-click="vm.ok()">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Create New Fund</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" ng-model="vm.fundDetails">
            <div class="box-body">
              <div class="form-group col-sm-12">
                <label class="col-sm-4 control-label">Year</label>
                <div class="col-sm-8"><input type="text" class="form-control" required="" ng-model="vm.fundDetails.fund_year"><br></div>
              </div>
              <div class="form-group col-sm-12">
                <label class="col-sm-4 control-label">Fund Name</label>
                <div class="col-sm-8"><input type="text" class="form-control" required="" ng-model="vm.fundDetails.fund_name"><br></div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" ui-sref="list-particular" ng-click="vm.ok()">Close</button>
          <button type="button" class="btn btn-primary pull-right" ng-click="vm.newFund(vm.fundDetails);">Create Fund</button> &nbsp;
          <!-- <button type="button" class="btn btn-danger pull-right">Delete</button> --> 
        </div>
      </div>
    </div>
  </div>
</script>

<script type="text/ng-template" id="fundEdit.modal">
  <div >
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" ui-sref="list-fund" ng-click="vm.ok()">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Edit Fund Information</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" id="">
            <div class="box-body">
              <div class="form-group col-sm-12">
                <label class="col-sm-4 control-label">Year</label>
                <div class="col-sm-8"><input type="text" class="form-control" required="" ng-model="vm.formData.fund_year"><br></div>
              </div>
              <div class="form-group col-sm-12">
                <label class="col-sm-4 control-label">Fund Name</label>
                <div class="col-sm-8"><input type="text" class="form-control" required="" ng-model="vm.formData.fund_name"><br></div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" ui-sref="list-fund" ng-click="vm.ok()">Close</button>
          <button type="button" class="btn btn-success pull-right" ng-click="vm.updateFund(vm.formData)">Update Fund</button> &nbsp;
          <!-- <button type="button" class="btn btn-danger pull-right">Delete</button> --> 
        </div>
      </div>
    </div>
  </div>
</script>

<script type="text/ng-template" id="fundInfo.modal"> 
  <div>
    <div class="modal-dialog" style="width:100%;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" ui-sref="list-fund" ng-click="vm.ok()">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><li class="fa fa-file-o"></li> Fund Control No: <b><%vm.formData.fund_code%></b></h4>
        </div>
        <div class="modal-body">
          <!-- <p>Add requested supply items to specific Requisition Slip</p> -->
          <!-- Custom Tabs (Pulled to the right) -->
          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-body">
                  <form ng-submit="vm.addNew()" >
                    <table class="table table-striped table-bordered" class="tbl_rs_supply">
                      <thead>
                        <tr>
                          <th><input type="checkbox" ng-model="selectedAll" ng-click="vm.checkAll()" /></th> 
                          <th>Cost Center</th>
                          <th>Particular</th>
                          <th>Amount</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr ng-repeat="fundDetail in vm.fundDetails" >
                          <td><input type="checkbox" ng-model="fundDetail.selected"/></td> 
                          <td>
                            <select class="form-control select2" style="width: 100%;" ng-model="fundDetail.cost_center_code" required="">
                              <option value="">- - Select Cost Center - -</option>
                              <option value="<%organization.org_code%>" ng-repeat="organization in vm.organizations"><%organization.org_name%></option>
                              <option value="<%project.project_code%>" ng-repeat="project in vm.projects"> <%project.cost%> - <%project.name%></option>
                            </select>
                          </td>
                          <td>
                            <select class="form-control select2" style="width: 100%;" required="" ng-model="fundDetail.supply_category_code" ng-init="parentIndex = $index">
                              <option value="">- - Select Particular - -</option>
                              <option ng-value="supplyCategory.supply_category_code" ng-repeat="supplyCategory in vm.supplyCategories"><%supplyCategory.supply_category_name%></option>
                            </select>
                          </td>
                          <td>
                            <input type="text" class="form-control" ng-model="fundDetail.fund_item_amount" required/>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <div class="form-group">
                      <div class="form-group">
                        <input type="button" class="btn btn-info pull-right" value="Submit Form" style="margin-right: 10px;" ng-click="vm.addFundItems(vm.fundDetails)">
                        <button ng-hide="!vm.fundDetails.length" type="button" class="btn btn-danger pull-left fa fa-trash-o" ng-click="vm.remove()"></button>
                        <button type="submit" class="pull-left btn btn-primary fa fa-plus addnew"></button>
                    </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-body">
                  <form>
                    <table class="table table-bordered" class="tbl_list_rcpt">
                      <thead>
                        <tr>
                          <th>Cost Center Code</th> 
                          <th>Cost Center Name</th> 
                          <th width="25%">Particular</th>
                          <th width="25%">Amount</th>
                        </tr> 
                      </thead>
                      <tbody>
                        <tr ng-repeat="fundItem in vm.fundItems"> 
                          <!-- <td><%fundItem.fund_name%></td> -->
                          <td><%fundItem.cost_center_code%></td>
                          <td><%fundItem.cost_center_name%></td>
                          <td><%fundItem.supply_category_name%></td>
                          <td align="right"><%fundItem.fund_item_amount | number:2%></td>
                          <!-- <td>
                            <a href="#" data-toggle="modal"  ng-click="vm.removeRequisitionSlipItem(requisitionSlipItem.requisition_slip_item_code, requisitionSlipItem.item_quantity, requisitionSlipItem.supply_code)"><code class="text-red">REMOVE</code></a>
                          </td> -->
                        </tr>
                        <tr>
                          <td colspan="2" align="right"><b>GRAND TOTAL</b></td>
                          <td colspan="1" align="right"><b>₱<%vm.totalFundItems | number:2%></b></td>
                          <td ng-if="!vm.formData.status"></td>
                        </tr>
                      </tbody>
                    </table>
                  </form>
                </div>
              </div>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <a type="button" class="btn btn-info" ng-click="vm.printRequisitionDetails(vm.formData.requisition_slip_code)" target="_blank" ng-href="<%vm.url%>"><li class="fa fa-print"></li> Print</a>
          
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
</script>