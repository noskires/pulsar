
<!-- Page Loader -->
<div id="loader" ng-if="sc.loader_status"></div>

<!-- Content Header (Page header) -->
<section class="content-header">
<h1><span class="fa fa-cog"> </span> Setup</h1>
<p>Browse and modify selection fields</p>
<ol class="breadcrumb">
<li><a href=""><i class="fa fa-th"></i> Dashboard</a></li>
<li><i class="fa fa-cloud"></i> Advanced</li>
<li class="active">Supplier</li>
</ol>
</section>

<!-- Main content -->

<section class="content">
  <div class="col-md-12"> 
    <h4><b>Suppliers</b> &nbsp; 
    <button type="button" class="btn btn-primary pull-right" ui-sref="supplier-create({supplierRequest:'new'})"> <li class="fa fa-plus"></li> Add Supplier </button></h4> 
    <div class="box">
      <div class="box-body">
        <table datatable="ng"  id="suppliers" class="table table-bordered table-hover" width="100%">
          <thead>
          <tr>
            <th>Supplier Code</th>
            <th>Business Name</th>
            <th>Business Owner</th>
            <th>DTI Expiration Date</th>
            <th>Business Permit No</th>
            <th>Business Permit Expiration Date</th>
            <th>BIR No</th>
            <th>Contact No</th>
            <th>Address</th>
          </tr>
          </thead>
          <tbody>
          <tr ng-repeat="supplier in sc.suppliers">
          <td><a href="#" ui-sref="list-supplierCopy({supplierCode:supplier.supplier_code})"><b> <%supplier.supplier_code%> </b></a></td>
          <td><%supplier.supplier_name%></td>
          <td><%supplier.supplier_owner%></td>
          <td><%supplier.dti_expiry_date%></td>
          <td><%supplier.business_permit_no%></td>
          <td><%supplier.business_permit_expiry_date%></td>
          <td><%supplier.bir_no%></td>
          <td><%supplier.contact_no%></td>
          <td><%supplier.address%></td>
        </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

<script type="text/ng-template" id="supplierNew.modal">
  <div>
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" ng-click="vm.ok()" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Create New Supplier</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" ng-model="vm.supplierDetails">
            <div class="box-body">
              <div class="form-group col-sm-12">
                <label class="col-sm-4 control-label">Business Name</label>
                <div class="col-sm-8"><input type="text" class="form-control" required="" ng-model="vm.supplierDetails.supplier_name"><br></div>
                <label class="col-sm-4 control-label">Business Owner</label>
                <div class="col-sm-8"><input type="text" class="form-control" required="" ng-model="vm.supplierDetails.supplier_owner"><br></div>
                <label class="col-sm-4 control-label">DTI Expiration Date</label>
                <div class="col-sm-8">
                  <div class="input-group date">
                  <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                  <input type="text" class="form-control pull-right" id="datepicker-dti-exp" required="" datepicker2 ng-model="vm.supplierDetails.dti_expiry_date">
                  </div><br> 
                </div>
                <label class="col-sm-4 control-label">Business Permit No</label>
                <div class="col-sm-8"><input type="text" class="form-control" required="" ng-model="vm.supplierDetails.business_permit_no"><br></div>
                <label class="col-sm-4 control-label" style="padding-top: 0px;">Business Permit Expiration Date</label>
                <div class="col-sm-8">
                  <div class="input-group date">
                  <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                  <input type="text" class="form-control pull-right" id="datepicker-business-exp" datepicker2 required="" ng-model="vm.supplierDetails.business_permit_expiry_date">
                  </div><br> 
                </div>                      
                <label class="col-sm-4 control-label">BIR No</label>
                <div class="col-sm-8"><input type="text" class="form-control" required="" ng-model="vm.supplierDetails.bir_no"><br></div>
                <label class="col-sm-4 control-label">Contact No</label>
                <div class="col-sm-8"><input type="text" class="form-control" required="" ng-model="vm.supplierDetails.contact_no"><br></div>
                <label class="col-sm-4 control-label">Address</label>
                <div class="col-sm-8"><input type="text" class="form-control" required="" ng-model="vm.supplierDetails.address"></div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <!-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button> -->
          <button type="button" class="btn btn-primary pull-right" ng-click="vm.newSupplier(vm.supplierDetails);">Create Supplier</button> &nbsp;
          <!-- <button type="button" class="btn btn-danger pull-right">Delete</button> --> 
        </div>
      </div>
    </div>
  </div>
</script>

<script type="text/ng-template" id="supplierEdit.modal">
  <div >
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" ng-click="vm.ok()">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Edit Supplier Information</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" id="">
            <div class="box-body">
              <div class="form-group col-sm-12">
                <label class="col-sm-4 control-label">Business Name</label>
                <div class="col-sm-8"><input type="text" class="form-control" required="" ng-model="vm.formData.supplier_name"><br></div>
                <label class="col-sm-4 control-label">Business Owner</label>
                <div class="col-sm-8"><input type="text" class="form-control" required="" ng-model="vm.formData.supplier_owner"><br></div>
                <label class="col-sm-4 control-label">DTI Expiration Date</label>
                <div class="col-sm-8">
                  <div class="input-group date">
                  <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                  <input type="text" class="form-control pull-right" id="edit-dti-exp" datepicker2 required="" ng-model="vm.formData.dti_expiry_date">
                  </div><br> 
                </div>
                <label class="col-sm-4 control-label">Business Permit No</label>
                <div class="col-sm-8"><input type="text" class="form-control" required="" ng-model="vm.formData.business_permit_no"><br></div>
                <label class="col-sm-4 control-label" style="padding-top: 0px;">Business Permit Expiration Date</label>
                <div class="col-sm-8">
                  <div class="input-group date">
                  <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                  <input type="text" class="form-control pull-right" id="edit-business-exp" datepicker2 required="" ng-model="vm.formData.business_permit_expiry_date">
                  </div><br> 
                </div>                      
                <label class="col-sm-4 control-label">BIR No</label>
                <div class="col-sm-8"><input type="text" class="form-control" required="" ng-model="vm.formData.bir_no"><br></div>
                <label class="col-sm-4 control-label">Contact No</label>
                <div class="col-sm-8"><input type="text" class="form-control" required="" ng-model="vm.formData.contact_no"><br></div>
                <label class="col-sm-4 control-label">Address</label>
                <div class="col-sm-8"><input type="text" class="form-control" ng-model="vm.formData.address"></div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" ng-click="vm.ok()">Close</button>
          <button type="button" class="btn btn-success pull-right" ng-click="vm.updateSupplier(vm.formData)">Update Supplier</button> &nbsp;
          <!-- <button type="button" class="btn btn-danger pull-right">Delete</button> --> 
        </div>
      </div>
    </div>
  </div>
</script>