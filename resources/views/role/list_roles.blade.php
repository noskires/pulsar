<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><span class="fa fa-key"> </span> Access Rights</h1>
    <p>Manage rights for user accounts grouping.</p>
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
<!-- NEW ACCESS GROUP -->
        <form class="form-horizontal" id="" ng-model="role">
          <div class="box-body">
            <div class="form-group col-sm-12">
              <label for="controlnumber" class="col-sm-2 control-label">Control Number</label>
              <div class="col-sm-4"><input type="text" class="form-control" placeholder="RIGHTS-001" disabled></div>
            </div>
            <div class="form-group col-sm-12">
              <label for="controlnumber" class="col-sm-2 control-label">Access Group Name</label>
              <div class="col-sm-4"><input type="text" class="form-control" autofocus="" ng-model="role.roleName"></div>
            </div>
            <div class="form-group col-sm-12">
              <label for="controlnumber" class="col-sm-2 control-label">Description</label>
              <div class="col-sm-10"><textarea class="form-control" rows="2" ng-model="role.description"></textarea> </div>
            </div>
            <!-- <div class="form-group col-sm-12">
              <label for="controlnumber" class="col-sm-2 control-label">Modules</label>
              <div class="col-sm-10">

              <input type="checkbox" checklist-model="role.modules" value="Assets"> Assets
              <input type="checkbox" checklist-model="role.modules" value="Projects"> Projects
              <input type="checkbox" checklist-model="role.modules" value="Employees"> Employees
              <input type="checkbox" checklist-model="role.modules" value="Finance"> Finance

              </div>
            </div> -->
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
              data-title="Confirm data entry." data-content="Are you sure?" style="width: 40%;margin-left: 5%;"
              ng-click="rc.createRoleBtn(role)"
              >CONFIRMATION</button>

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
              <th>Access Group Name</th>
              <th>Description</th>
              <th>Active Users</th>
              <th>Options</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="role in rc.roles">
              <td><a href="#" ui-sref="list-roleCopy({roleCode:role.role_code})"><b><%role.role_name%></b></a></td>
              <td><%role.description%></td>
              <td>1</td>
              <td><input type="checkbox" ng-model="role.is_active" ng-checked="role.is_active" ng-true-value="true" ng-false-value="false" ng-change="rc.activate(role)"/></td>
            </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- MODAL CONTENTS -->
<script type="text/ng-template" id="Edit.modal">
<div>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" ui-sref="list-user({roleCode:''})" ng-click="vm.ok()">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Access Group Rights Information</h4>
      </div>
      <div class="modal-body">
        <!-- Custom Tabs (Pulled to the right) -->
        <form class="form-horizontal" id="">
            <div class="box-body">
              <div class="form-group col-sm-12">
                <label for="controlnumber" class="col-sm-3 control-label">Control Number</label>
                <div class="col-sm-6"><input type="text" class="form-control" disabled value="<%vm.data.role_code%>"></div>
              </div>
              <div class="form-group col-sm-12">
                <label for="controlnumber" class="col-sm-3 control-label">Access Group Name</label>
                <div class="col-sm-6"><input type="text" class="form-control" autofocus="" ng-model="vm.data.role_name"></div>
              </div>
              <div class="form-group col-sm-12">
                <label for="controlnumber" class="col-sm-3 control-label">Description</label>
                <div class="col-sm-9"><textarea class="form-control" rows="2" ng-model="vm.data.description"></textarea> </div>
              </div>

              <hr>
              <br>
              <br>
              <br>

              <div class="form-group col-sm-12">
                <label for="controlnumber" class="col-sm-3 control-label">Modules</label>
                <div class="col-sm-9">
                  <div class="form-group col-sm-12">

                    <select class="form-control select2 col-sm-9" style="width: 60%;" required="" ng-model="roleItem.module_code">
                      <option value="">- - select module - -</option>
                      <option ng-value="module.module_code" ng-repeat="module in vm.modules"><%module.module_name%></option>
                    </select>
                  <div class="col-sm-3">
                  <a href="#" class="btn btn-default" ng-click="vm.createRoleItemBtn(roleItem)"> <code class="text-blue">ADD NEW MODULE</code></a>
                  </div>
                  </div>

                  <table>
                    <tr ng-repeat="roleItem in vm.roleItems">
                      <td>
                        <%roleItem.module_code%> | <%roleItem.module_name%>
                      </td>
                      <td>
                        <a href="#" ng-click="vm.deleteRoleItemBtn(roleItem)"> <code class="text-red">REMOVE</code></a>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
              <div class="form-group col-sm-12">
              </div>
            </div>
            <!-- /.box-body -->

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" ui-sref="list-role({roleCode:''})" ng-click="vm.ok()">Close</button>
        <button class="btn btn-large btn-danger pull-left" data-toggle="confirmation"
          data-btn-ok-label="Yes" data-btn-ok-icon="fa fa-check" data-btn-ok-class="btn-success"
          data-btn-cancel-label="No" data-btn-cancel-icon="fa fa-times" data-btn-cancel-class="btn-danger"
          data-title="Confirmation." data-content="Are you sure?" style="width: 10%;"> Delete
        </button>
        <button class="btn btn-large btn-success pull-right" data-toggle="confirmation"
          data-btn-ok-label="Yes" data-btn-ok-icon="fa fa-check" data-btn-ok-class="btn-success"
          data-btn-cancel-label="No" data-btn-cancel-icon="fa fa-times" data-btn-cancel-class="btn-danger"
          data-title="Confirm data entry." data-content="Update entry?" style="width: 20%;" ng-click="vm.updateRoleBtn(vm.data)"> Update
        </button>
        <!-- nav-tabs-custom -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
</script>
<!-- /.modal -->
