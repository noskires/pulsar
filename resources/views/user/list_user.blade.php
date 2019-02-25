<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><span class="fa fa-users"> </span> User Accounts</h1>
    <p>Manage employee access accounts.</p>
  <ol class="breadcrumb">
    <li><a href="../../index.html"><i class="fa fa-th"></i> Dashboard</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12"> 
      <div id="add-bank" class="collapse department">
        <div class="panel panel-default">
          <div class="panel-body">
<!-- NEW USER ACCOUNT -->
        <form class="form-horizontal" id="">
          <div class="box-body">
            <!-- <div class="form-group col-sm-12">
              <label for="controlnumber" class="col-sm-2 control-label">Control Number</label>
              <div class="col-sm-4"><input type="text" class="form-control" placeholder="ACCOUNT-001" disabled></div>
            </div> -->
            <div class="form-group col-sm-12">
              <label for="controlnumber" class="col-sm-2 control-label">Employee Name</label>
              <div class="col-sm-4">
     
                <select class="form-control select2" style="width: 100%;" required="" ng-model="user.employee_code">
                  <option value="">- - select employee - -</option>
                  <option ng-value="employee.employee_code" ng-repeat="employee in uc.employees"><%employee.employee_name%></option>
                </select> 
              </div>
            </div>
            <div class="form-group col-sm-12">
              <label for="controlnumber" class="col-sm-2 control-label"></label>
              <div class="col-sm-10"><code class="text-green">NOTE: The default password is set to <b>"pulsar"</b></code></div>
            </div>
            <div class="form-group col-sm-12">
              <label for="controlnumber" class="col-sm-2 control-label">Access Group</label>
              <div class="col-sm-10">
                <select class="form-control select2" style="width: 100%;" required="" ng-model="user.role_code">
                  <option value="">- - select role - -</option>
                  <option ng-value="role.role_code" ng-repeat="role in uc.roles"><%role.role_name%></option>
                </select>
              </div>
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
              data-title="Confirm data entry." data-content="Are you sure?" style="width: 40%;margin-left: 5%;" ng-click="uc.createUserBtn(user)">CONFIRMATION</button>

              <button type="button" class="btn btn-default pull-right" data-toggle="collapse" data-target="#add-bank">
              <span class="glyphicon glyphicon-remove"></span> CANCEL
              </button>
              </div>
            </div>
          </div>
        </form>
          </div>
        </div>
      </div>
<!-- BUTTONS -->
      <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#add-bank" >
          <span class="glyphicon glyphicon-plus"></span> Create New
      </button>
    </div>
  </div><br>  
<!-- TABLES -->
  <div class="row">
    <div class="col-md-12"> 
      <div class="box box-primary">
        <div class="box-body">
          <table id="tbl-accessrights" class="table table-bordered table-hover" width="100%">
            <thead>
            <tr>
              <th>Employee</th>
              <th>UserID</th>
              <th>Access Group Name</th>
              <th>Options</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="user in uc.users">
              <td><a href="#" ui-sref="list-userCopy({userCode:user.employee_code})"><b><%user.employee_name%></b></a></td>
              <td><%user.employee_code%></td>
              <td><%user.role_name%></td>
              <td><a href="#" data-toggle="modal" data-target="#modal-renewal"><code class="text-green">Enable</code></a>
                  &nbsp;&nbsp;<a href="#"><code class="text-red">Disable</code></a>
                  &nbsp;&nbsp;<a href="#"><code class="text-yellow">Password-Reset</code></a></td>
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
<script type="text/ng-template" id="Edit.modal">
<div>
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" ui-sref="list-user({userCode:''})" ng-click="vm.ok()">
        <span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title">Edit User Account Information</h4>
    </div>
    <div class="modal-body">
      <!-- Custom Tabs (Pulled to the right) -->
      <form class="form-horizontal" id="">
        <div class="form-group col-sm-12">
          <label for="controlnumber" class="col-sm-3 control-label">Control Number</label>
          <div class="col-sm-6"><input type="text" class="form-control"  ng-model="vm.data.employee_code" disabled></div>
        </div>
        <div class="form-group col-sm-12">
          <label for="controlnumber" class="col-sm-3 control-label">Employee Name</label>
          <div class="col-sm-6">

            <%vm.data.employee_name%>
            <!-- <select class="form-control select2" style="width: 100%;" required="">
            <option value="" selected disabled hidden>Select Employee</option>
            <option value="1">Supnet, Erikson Taguiam</option>
            <option value="2">Bulan, Jay Tagayun</option>
            </select> -->
          </div>
        </div>
     <!--    <div class="form-group col-sm-12">
          <label for="controlnumber" class="col-sm-3 control-label"></label>
          <div class="col-sm-9"><code class="text-green">NOTE: The default password is set to <b>"pulsar"</b></code></div>
        </div> -->
        <div class="form-group col-sm-12">
          <label for="controlnumber" class="col-sm-3 control-label">Access Group</label>
          <div class="col-sm-9">

            <select class="form-control select2" style="width: 100%;" required="" ng-model="vm.data.role_code">
              <option value="">- - select role - -</option>
              <option ng-value="role.role_code" ng-repeat="role in vm.roles"><%role.role_name%></option>
            </select>

          </div>
        </div>
        <div class="form-group col-sm-12">
        </div>
                <!-- /.box-body -->   
      </form>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default pull-left" ui-sref="list-user({userCode:''})" ng-click="vm.ok()">Close</button>
      <button class="btn btn-large btn-danger pull-left" data-toggle="confirmation"
        data-btn-ok-label="Yes" data-btn-ok-icon="fa fa-check" data-btn-ok-class="btn-success"
        data-btn-cancel-label="No" data-btn-cancel-icon="fa fa-times" data-btn-cancel-class="btn-danger"
        data-title="Confirmation." data-content="Are you sure?" style="width: 10%;"> Delete
      </button>
      <button class="btn btn-large btn-success pull-right" data-toggle="confirmation"
        data-btn-ok-label="Yes" data-btn-ok-icon="fa fa-check" data-btn-ok-class="btn-success"
        data-btn-cancel-label="No" data-btn-cancel-icon="fa fa-times" data-btn-cancel-class="btn-danger"
        data-title="Confirm data entry." data-content="Update entry?" style="width: 20%;" ng-click="vm.updateUserBtn(vm.data)"> Update
      </button>
      <!-- nav-tabs-custom -->
    </div>
  </div>
  <!-- /.modal-dialog -->
</div>
</script>
<!-- /.modal -->
