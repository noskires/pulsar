<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><span class="fa fa-file-text-o"> </span> Create Requisition for Asset</h1>
  <ol class="breadcrumb">
    <li><a href="../../index.html"><i class="fa fa-th"></i> Dashboard</a></li>
    <li class="active">Requisition for Asset</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-9">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title"></h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" id="">
          <div class="box-body">
            <div class="form-group col-sm-12">
              <label class="col-sm-3 control-label">Request Date</label>
              <div class="col-sm-3">
              <div class="input-group date">
              <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
              <input type="text" class="form-control pull-right" id="datepicker" required="" ng-model="rac.risDetails.date_requested" datepicker autocomplete="off" readonly="">
            </div></div>
              <label class="col-sm-3 control-label">Date Needed</label>
              <div class="col-sm-3">
              <div class="input-group date">
              <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
              <input type="text" class="form-control pull-right" id="datepicker2" required="" ng-model="rac.risDetails.date_needed" datepicker autocomplete="off" readonly="">
            </div></div>
            </div>
            <!-- <div class="form-group col-sm-12">
              <label for="controlnumber" class="col-sm-3 control-label">Asset Details</label>
              <div class="col-sm-9"><input type="text" class="form-control" placeholder="DUMPTRUCK: CONE-03082018-DT1" disabled></div>
            </div> -->
            <div class="form-group col-sm-12">
              <label for="" class="col-sm-3 control-label">Reference</label>
              <div class="col-sm-9"><input type="text" class="form-control" ng-model="rac.risDetails.old_reference"></div>
            </div>
            <div class="form-group col-sm-12">
              <label for="" class="col-sm-3 control-label">Reference Type</label>
              <div class="col-sm-9">
                <select class="form-control select2" style="width: 100%;" ng-model="rac.risDetails.request_type" required="">
                  <option value="">- - SELECT REQUEST TYPE - -</option>
                  <option value="Office">Office</option>
                  <option value="Project">Project</option>
                </select>
              </div>
            </div>
            <div class="form-group col-sm-12">
              <label for="" class="col-sm-3 control-label">Reference Name</label>
              <div class="col-sm-9">
                  <select class="form-control select2" style="width: 100%;"  ng-model="rac.risDetails.reference_code" required="">
                    <option value="">- - SELECT - -</option>
                    <option ng-if="rac.risDetails.request_type=='Office'" value="<%organization.org_code%>" ng-repeat="organization in rac.organizations"><%organization.org_name%></option>
                    <option ng-if="rac.risDetails.request_type=='Project'" value="<%project.project_code%>" ng-repeat="project in rac.projects"><%project.name%></option>
                  </select>
              </div>
            </div>
            <div class="form-group col-sm-12">
            <label for="assetname" class="col-sm-3 control-label">Requesting Employee</label>
              <div class="col-sm-9">
                  <select class="form-control select2" style="width: 100%;" ng-model="rac.risDetails.employee_code">
                    <option value="">- - SELECT EMPLOYEE - -</option>
                    <option ng-value=employee.employee_code ng-repeat="employee in rac.employees"><%employee.employee_name%></option>
                  </select>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <div class="form-group col-sm-12">           
              <div class="col-sm-8"></div>
              <div class="col-sm-4">
              <button class="btn btn-large btn-primary btn-block" data-toggle="confirmation"
              data-btn-ok-label="Save" data-btn-ok-icon="fa fa-check" data-btn-ok-class="btn-success"
              data-btn-cancel-label="Cancel" data-btn-cancel-icon="fa fa-times" data-btn-cancel-class="btn-danger"
              data-title="Confirm data entry." data-content="Are you sure?" ng-click="rac.createRequisitionSlipBtn(rac.risDetails)"> CONFIRMATION
              </button></div></div>
          </div>
        </form>
      </div>
      <!-- /.box -->
    </div>
    <!--/.col (left) -->
  </div>
  <!-- /.row -->
</section>

<script type="text/javascript">
$(function () {

$('.select2').select2();

//   $('#datepicker').datepicker({
//    autoclose: true
//   })

});
</script>