  <!--Content Header (Page header) -->
  <section class="content-header">
  <h1><span class="fa fa-user"> </span> Manage Employees</h1>
  <ol class="breadcrumb">
    <li><a href="../../index.html"><i class="fa fa-th"></i> Dashboard</a></li>
    <li class="active">Employee Manager</li>
  </ol>
  </section>

  <!-- Main content -->
    
  <section class="content">
    <div class="row">
      <div id="button-top" class="col-md-9"> 
  <!-- BUTTONS -->
        <button class="btn btn-primary" data-toggle="collapse" data-target="#create-voucher" data-parent="#btn-top">
            <span class="glyphicon glyphicon-plus"></span> New Employee
        </button> &nbsp;&nbsp;&nbsp;
        <button class="btn btn-primary" data-toggle="collapse" data-target="#filter" data-parent="#btn-top">
            <span class="glyphicon glyphicon-refresh"></span> Filter Display
        </button> &nbsp;&nbsp;&nbsp;
        <button type="button" class="btn btn-primary" ng-click="ec.addNewPosition()"> 
          <span class="glyphicon glyphicon-plus"></span> New Position
        </button>
          <br>

  <!-- NEW EMPLOYEE -->
        <div id="create-voucher" class="collapse"><br>
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Add a New Employee</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form id="from-unit" class="form-horizontal" role="form">
            <div class="box-body">
              <div class="form-group col-sm-12">
                <label for="controlnumber" class="col-sm-2 control-label">Employee ID</label>
                <div class="col-sm-3"><input type="number" class="form-control" ng-model="ec.employeeDetails.employeeID"></div>
                <label for="dv-payee-type" class="col-sm-3 control-label">Gender</label>
                <div class="radio col-sm-3">
                  <label><input type="radio" ng-model="ec.employeeDetails.gender" value="Male">Male</label>
                  &nbsp;&nbsp;&nbsp;
                  <label><input type="radio" ng-model="ec.employeeDetails.gender" value="Female">Female</label>
                </div>
              </div>

              <div class="form-group col-sm-12">
                <label for="controlnumber" class="col-sm-2 control-label">Last Name</label>
                <div class="col-sm-4"><input type="text" class="form-control" ng-model="ec.employeeDetails.lname" required=""></div>
                <label for="controlnumber" class="col-sm-2 control-label">Birthdate</label>
                <div class="col-sm-2">
                  <div class="input-group date">
                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                    <input type="text" class="form-control pull-right" id="datepicker-bday" ng-model="ec.employeeDetails.bday" datepicker autocomplete="off">
                  </div>
                </div>
                <label for="controlnumber" class="col-sm-1 control-label">Suffix</label>
                <div class="col-sm-1"><input type="text" class="form-control"></div>
              </div>

              <div class="form-group col-sm-12">
                <label for="controlnumber" class="col-sm-2 control-label">First Name</label>
                <div class="col-sm-4"><input type="text" class="form-control" ng-model="ec.employeeDetails.fname" required=""></div>
                <label for="controlnumber" class="col-sm-2 control-label">Phone Number</label>
                <div class="col-sm-3"><input type="number" class="form-control" ng-model="ec.employeeDetails.phone_no"></div>
              </div>

              <div class="form-group col-sm-12">
                <label for="controlnumber" class="col-sm-2 control-label">Middle Name</label>
                <div class="col-sm-4"><input type="text" class="form-control" ng-model="ec.employeeDetails.mname"></div>
                <label for="controlnumber" class="col-sm-2 control-label">Email Address</label>
                <div class="col-sm-3"><input type="text" class="form-control" ng-model="ec.employeeDetails.email"></div>
              </div>

              <div class="form-group col-sm-12">
                <hr style="border-color:#e1e1e1;border-width:1px 0;">
                <!-- <label class="col-sm-2 control-label"></label>
                <div class="col-sm-10 text-blue"><h4><i class="fa fa-clone"></i><b> Assignment</b></h4></div> -->
              </div>

              <div class="form-group col-sm-12">
                <label class="col-sm-2 control-label">Job Title</label>
                <div class="col-sm-4">
                  <select class="form-control select2" style="width: 100%;" required="" ng-model="ec.employeeDetails.position_code">
                    <option selected="selected" value="">- - SELECT JOB TITLE- -</option>
                    <option ng-value="position.position_code" ng-repeat="position in ec.positions"><%position.position_text%></option>
                  </select>
                </div>
                <label class="col-sm-2 control-label">Department</label>
                <div class="col-sm-4">
                  <select class="form-control select2" style="width: 100%;" required="" ng-model="ec.employeeDetails.department" ng-change="ec.selectDepartment(ec.employeeDetails.department)">
                    <option selected="selected" value="">- - SELECT DEPARTMENT - -</option>
                    <option ng-value="department.org_code" ng-repeat="department in ec.departments"><%department.department_name%></option>
                  </select>
                </div>
              </div>

              <div class="form-group col-sm-12">
                <label class="col-sm-2 control-label">Division</label>
                <div class="col-sm-4">
                  <select class="form-control select2" style="width: 100%;" required="" ng-model="ec.employeeDetails.division" ng-change="ec.selectDivision(ec.employeeDetails.division)">
                    <option selected="selected" value="">- - SELECT DIVISION - -</option>
                    <option ng-value="division.org_code" ng-repeat="division in ec.divisions"><%division.division_name%></option>
                  </select>
                </div>
                <label class="col-sm-2 control-label">Unit</label>
                <div class="col-sm-4">
                    <select class="form-control select2" style="width: 100%;" required="" ng-model="ec.employeeDetails.unit">
                      <option selected="selected" value="">- - SELECT UNIT - -</option>
                      <option ng-value="unit.org_code" ng-repeat="unit in ec.units"><%unit.unit_name%></option>
                    </select>
                </div>
              </div>
                          
              <div class="form-group col-sm-12">
                <hr style="border-color:#e1e1e1;border-width:1px 0;">
                <!-- <label class="col-sm-2 control-label"></label>
                <div class="col-sm-9 text-blue"><h4><i class="fa fa-address-book-o"></i><b> Address</b></h4></div> -->
              </div>

              <div class="form-group col-sm-12">           
                <div class="col-sm-8"></div>
                <div class="col-sm-4">
                <button class="btn btn-large btn-primary btn-block" data-toggle="confirmation"
                data-btn-ok-label="Save" data-btn-ok-icon="fa fa-check" data-btn-ok-class="btn-success"
                data-btn-cancel-label="Cancel" data-btn-cancel-icon="fa fa-times" data-btn-cancel-class="btn-danger"
                data-title="Confirm data entry." data-content="Are you sure?" ng-click="ec.submit(ec.employeeDetails)"> CONFIRMATION
                </button></div></div>
            </div>
          </form>
        </div>
        <!-- /.box -->
        </div>

  <!-- FILTER DISPLAY -->
        <div id="filter" class="collapse"><br>
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Filter Displayed Data</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
          <!-- form start -->
          <form id="from-unit" class="form-horizontal" role="form">
            <div class="form-group col-sm-12"">
              <div class="col-sm-3">
              <select class="form-control select2" style="width: 100%;" required="">
              <option selected="selected" value="0">Select Division</option>
              <option value="1">ACCOUNTING</option>
              <option value="2">CONSTRUCTION</option>
              <option value="3">ENGINEERING</option>
              <option value="4">OPERATIONS</option>
              </select>
              </div>
              <div class="col-sm-4">
                <button type="button" class="btn btn-default btn-flat">Filter Display</button></div>
            </div>
          </form>
        </div>
        </div>
        <!-- /.box -->
        </div>
      </div>
    </div>
    <br>
    <div class="box box-primary">
      <div class="box-body">
        <div export-to-xlsx data="ec.employees" bind-to-table="'tb-employee'" filename="'Employee Masterfile'"></div>
        <table datatable="ng" class="table table-bordered table-hover" name="tb-employee" width="100%">
          <thead>
          <tr>
            <th>Employee ID</th>
            <th>Last Name</th>
            <th>Suffix</th>
            <th>First Name</th>
            <th>Middle Name</th>
            <th>Job Title</th>
            <th>Birthdate</th>
            <th>Email Account</th>
            <th>Phone No.</th>
            <th>Department</th>
            <th>Division</th>
            <th>TIN</th>
            <th>SSS</th>
            <th>Philhealth</th>
            <th>Pag-ibig</th>
            <!-- <th>Unit</th> -->
          </tr>
          </thead>
          <tbody>
          <tr ng-repeat="employee in ec.employees" >
            <td><a href="#" ng-click="ec.employeeInfo(employee.employee_code)"><b><%employee.employee_code%></b></a></td>
            <td><%employee.lname%></td>
            <td><%employee.affix%></td>
            <td><%employee.fname%></td>
            <td><%employee.mname%></td>
            <td><%employee.position_text%></td>
            <td><%employee.birthdate%></td>
            <td><%employee.email_account%></td>
            <td><%employee.phone_number%></td>
            <td><%employee.department%></td>
            <td><%employee.division%></td>
            <td><%employee.tin%></td>
            <td><%employee.sss_number%></td>
            <td><%employee.philhealth_number%></td>
            <td><%employee.pagibig_number%></td>
            <!-- <td><%employee.unit%></td> -->
          </tr>
          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
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
  <script type="text/ng-template" id="employeeEditTpl.modal">
  <div>
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" ng-click="vm.ok()">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Edit Employee Information</h4>
        </div>
        <div class="modal-body">
          <!-- Custom Tabs (Pulled to the right) -->
          <div class="nav-tabs-custom">
    
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1-1">
                <!-- form start -->
                  <form class="form-horizontal" id="">
                    <div class="box-body">
                      <!-- <div class="form-group col-sm-12">
                        <label for="controlnumber" class="col-sm-3 control-label">Employee ID</label>
                        <div class="col-sm-9"><input type="text" class="form-control" id="emp_id" ng-model="vm.formData.employee_code"></div>
                      </div> -->
                      <div class="form-group col-sm-12">
                        <label for="controlnumber" class="col-sm-3 control-label">Last Name</label>
                        <div class="col-sm-9"><input type="text" class="form-control" id="emp_lname" ng-model="vm.formData.lname"></div>
                      </div>
                      <div class="form-group col-sm-12">
                        <label for="controlnumber" class="col-sm-3 control-label">Suffix</label>
                        <div class="col-sm-9"><input type="text" class="form-control" id="emp_sfx" ng-model="vm.formData.affix"></div>
                      </div>
                      <div class="form-group col-sm-12">
                        <label for="controlnumber" class="col-sm-3 control-label">First Name</label>
                        <div class="col-sm-9"><input type="text" class="form-control" id="emp_fname" ng-model="vm.formData.fname"></div>
                      </div>
                      <div class="form-group col-sm-12">
                        <label for="controlnumber" class="col-sm-3 control-label">Middle Name</label>
                        <div class="col-sm-9"><input type="text" class="form-control" id="emp_mname" ng-model="vm.formData.mname"></div>
                      </div>  
                      <div class="form-group col-sm-12">
                        <label class="col-sm-3 control-label">Gender</label>
                        <div class="col-sm-9">
                        <select class="form-control select2" style="width: 100%;" required="" ng-model="vm.formData.gender">
                          <option selected="selected" value="">- - SELECT GENDER - -</option>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                        </select>
                        </div>
                      </div>                  
                      <div class="form-group col-sm-12">
                        <label class="col-sm-3 control-label">Job Title</label>
                        <div class="col-sm-9">
                        <select class="form-control select2" style="width: 100%;" required="" ng-model="vm.formData.position_code">
                          <option selected="selected" value="0">- - select job title - -</option>
                          <option ng-value="position.position_code" ng-repeat="position in vm.positions"><%position.position_text%></option>
                        </select></div> 
                      </div>
                      <div class="form-group col-sm-12">
                        <label class="col-sm-3 control-label">Birth Date</label>
                        <div class="col-sm-9">
                        <div class="input-group date">
                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                        <input type="text" class="form-control pull-right" ng-model="vm.formData.birthdate" datepicker autocomplete="off">
                      </div></div>
                      </div>
                      <div class="form-group col-sm-12">
                        <label for="controlnumber" class="col-sm-3 control-label">Email Account</label>
                        <div class="col-sm-9"><input type="text" class="form-control" id="emp_sfx" ng-model="vm.formData.email_account"></div>
                      </div>
                      <div class="form-group col-sm-12">
                        <label for="controlnumber" class="col-sm-3 control-label">Phone No.</label>
                        <div class="col-sm-9"><input type="text" class="form-control" id="emp_sfx" ng-model="vm.formData.phone_number"></div>
                      </div>

                      <div class="form-group col-sm-12">
                        <label class="col-sm-3 control-label">Department</label>
                        <div class="col-sm-9">
                        <select class="form-control select2" style="width: 100%;" required="" ng-model="vm.formData.department_code" ng-change="vm.selectDepartment(vm.formData.department_code)">
                          <option selected="selected" value="">- - SELECT DEPARTMENT - -</option>
                          <option ng-value="department.org_code" ng-repeat="department in vm.departments"><%department.department_name%></option>
                        </select></div>
                      </div>
                      <div class="form-group col-sm-12">
                        <label class="col-sm-3 control-label">Division</label>
                        <div class="col-sm-9">
                        <select class="form-control select2" style="width: 100%;" required="" ng-model="vm.formData.division_code" ng-change="vm.selectDivision(vm.formData.division_code)">
                          <option selected="selected" value="">- - SELECT DIVISION - -</option>
                          <option ng-value="division.org_code" ng-repeat="division in vm.divisions"><%division.division_name%></option>
                        </select></div>
                      </div>
                      <div class="form-group col-sm-12">
                        <label class="col-sm-3 control-label">Unit</label>
                        <div class="col-sm-9">
                        <select class="form-control select2" style="width: 100%;" required="" ng-model="vm.formData.unit_code">
                          <option ng-value="">- - SELECT UNIT - -</option>
                          <option ng-value="unit.org_code" ng-repeat="unit in vm.units"><%unit.unit_name%></option>
                        </select></div>
                      </div>

                      <div class="form-group col-sm-12">
                        <label class="col-sm-3 control-label">Date Hired</label>
                        <div class="col-sm-9"><input type="text" class="form-control" id="emp_sfx" ng-model="vm.formData.date_hired" datepicker autocomplete="off"></div>
                      </div>

                      <div class="form-group col-sm-12">
                        <label class="col-sm-3 control-label">TIN</label>
                        <div class="col-sm-9"><input type="text" class="form-control" id="emp_sfx" ng-model="vm.formData.tin"></div>
                      </div>
                      
                      <div class="form-group col-sm-12">
                        <label class="col-sm-3 control-label">SSS</label>
                        <div class="col-sm-9"><input type="text" class="form-control" id="emp_sfx" ng-model="vm.formData.sss_number"></div>
                      </div>

                      <div class="form-group col-sm-12">
                        <label class="col-sm-3 control-label">Philhealth</label>
                        <div class="col-sm-9"><input type="text" class="form-control" id="emp_sfx" ng-model="vm.formData.philhealth_number"></div>
                      </div>

                      <div class="form-group col-sm-12">
                        <label class="col-sm-3 control-label">PagIbig Number</label>
                        <div class="col-sm-9"><input type="text" class="form-control" id="emp_sfx" ng-model="vm.formData.pagibig_number"></div>
                      </div>

                      <div class="form-group col-sm-12">
                        <label class="col-sm-3 control-label">Address</label>
                        <div class="col-sm-9"><input type="text" class="form-control" id="emp_sfx" ng-model="vm.formData.address"></div>
                      </div>

                    </div>
                    <!-- /.box-body -->
                  </form>
              </div>
              <!-- /.tab-pane -->

          
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" ng-click="vm.ok()">Close</button>
          <button type="button" class="btn btn-primary" ng-click="vm.updateEmployee(vm.formData)">Save changes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <script type="text/javascript">
  $(function () {

    $('.select2').select2();

  //   $('#datepicker').datepicker({
  //    autoclose: true
  //   })
  });
  </script>
  </script>
  <!-- /.modal

    <!-- MODAL CONTENTS -->
  <script type="text/ng-template" id="positionNewTpl.modal">
  <div>
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" ng-click="vm.ok()">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title">Add New Position</h4>
        </div>
        <div class="modal-body">
          <!-- Custom Tabs (Pulled to the right) -->
          <div class="nav-tabs-custom">
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1-1">
                <!-- form start -->
                  <form class="form-horizontal" id="" ng-model="vm.positionDetails">
                    <div class="box-body">
                      <!-- <div class="form-group col-sm-12">
                        <label for="controlnumber" class="col-sm-3 control-label">Employee ID</label>
                        <div class="col-sm-9"><input type="text" class="form-control" id="emp_id" ng-model="vm.employeeDetails.emp_id"></div>
                      </div> -->
                      <div class="form-group col-sm-12">
                        <label for="controlnumber" class="col-sm-3 control-label">Position Title</label>
                        <div class="col-sm-9"><input type="text" class="form-control" id="position_text" ng-model="vm.positionDetails.position_text"></div>
                      </div>
                    </div>
                    <!-- /.box-body -->
                  </form>
              </div>
              <!-- /.tab-pane -->
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" ng-click="vm.ok()">Close</button>
          <button type="button" class="btn btn-primary" ng-click="vm.submit(vm.positionDetails)">Save</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <!-- /.modal -->