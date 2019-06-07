<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><span class="fa fa-users"> </span> Profile</h1>
    <p>Viewing of personal information & account setting.</p>
  <ol class="breadcrumb">
    <li><a href="../../index.html"><i class="fa fa-th"></i> Dashboard</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content" ng-controller="EmployeeProfileCtrl as ep">
    <div class="row">
    <div class="col-md-3">
        <!-- Profile Image -->
        <div class="box box-primary">
        <div class="box-body box-profile">
            <img class="profile-user-img img-responsive img-circle" src="assets/dist/img/user2-160x160.jpg" style="width:70%;" alt="User profile picture">
            <br>
            <h3 class="profile-username text-center" ng-bind="ep.employee.employee_name"></h3>
            <p class="text-muted text-center"><%ep.employee.employee_code%> | <%ep.employee.role_name%></p>
            <p class="text-muted text-center"><%ep.employee.position_text%></p>
            <br>
            <!-- <button type="button" class="btn btn-info pull-right" style="margin-right: 7px;"><li class="fa fa-print"></li> Print</button> -->
        </div>
        <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </div>
    <!-- /.col -->
    <div class="col-md-9">
        <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="" data-toggle="tab" ng-click="ep.tabSelect('employee_info')">Employee Information</a></li>
            <li><a href="" data-toggle="tab" ng-click="ep.tabSelect('setting')">Settings</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane" ng-class="{'active': ep.tabs.employee_info}">
                <form class="form-horizontal">
                    <div class="box-body">
                        <div class="form-group col-sm-12">
                            <!-- <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-9 text-blue"><h4><i class="fa fa-user-o"></i><b> Employee Info</b></h4></div> -->
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="controlnumber" class="col-sm-2 control-label">Employee ID</label>
                            <div class="col-sm-4"><input type="text" class="form-control" ng-model="ep.employee.employee_name" disabled></div>
                            <label for="dv-payee-type" class="col-sm-2 control-label">Gender</label>
                        <div class="radio col-sm-4">
                            <label><input type="radio" name="optionsRadios" id="optionsRadios1" value="Male" ng-checked="ep.employee.gender === 'Male'">Male</label>
                            &nbsp;&nbsp;&nbsp;
                            <label><input type="radio" name="optionsRadios" id="optionsRadios2" value="Female" ng-checked="ep.employee.gender === 'Female'">Female</label>
                        </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="controlnumber" class="col-sm-2 control-label">Last Name</label>
                            <div class="col-sm-4"><input type="text" class="form-control" id="emp_lname" ng-model="ep.employee.lname" disabled></div>
                            <label for="controlnumber" class="col-sm-2 control-label">Suffix</label>
                            <div class="col-sm-2"><input type="text" class="form-control" id="emp_sfx" disabled></div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="controlnumber" class="col-sm-2 control-label">First Name</label>
                            <div class="col-sm-4"><input type="text" class="form-control" id="emp_fname" ng-model="ep.employee.fname" disabled></div>
                            <label class="col-sm-2 control-label">Birth Date</label>
                            <div class="col-sm-4">
                            <div class="input-group date">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            <input type="text" class="form-control pull-right" id="datepicker-bday" ng-model="ep.employee.birthdate" disabled>
                        </div></div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="controlnumber" class="col-sm-2 control-label">Middle Name</label>
                            <div class="col-sm-4"><input type="text" class="form-control" id="emp_email" ng-model="ep.employee.mname" disabled></div>
                            <label for="controlnumber" class="col-sm-2 control-label">Phone No.</label>
                            <div class="col-sm-4"><input type="text" class="form-control" id="emp_phone" ng-model="ep.employee.phone_number" disabled></div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="controlnumber" class="col-sm-2 control-label">Email Address</label>
                            <div class="col-sm-4"><input type="text" class="form-control" id="emp_email" ng-model="ep.employee.email_account" disabled></div>
                        </div>

                        <div class="form-group col-sm-12">
                            <hr style="border-color:#e1e1e1;border-width:1px 0;">
                            <!-- <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-10 text-blue"><h4><i class="fa fa-clone"></i><b> Assignment</b></h4></div> -->
                        </div>

                        <div class="form-group col-sm-12">
                            <label class="col-sm-2 control-label">Job Title</label>
                            <div class="col-sm-10">
                                <select class="form-control" style="width: 100%;" required="" disabled>
                                    <option selected="selected"><%ep.employee.position_text%></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label class="col-sm-2 control-label">Department</label>
                            <div class="col-sm-10">
                                <select class="form-control" style="width: 100%;" required="" disabled>
                                    <option selected="selected"><%ep.employee.department%></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label class="col-sm-2 control-label">Division</label>
                            <div class="col-sm-4">
                                <select class="form-control" style="width: 100%;" disabled>
                                <option selected="selected"><%ep.employee.division%></option>
                                </select>

                            </div>
                            <label class="col-sm-2 control-label">Unit</label>
                            <div class="col-sm-4">
                                <select class="form-control" style="width: 100%;" required="" disabled>
                                <option selected="selected"><%ep.employee.unit%></option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group col-sm-12">
                            <hr style="border-color:#e1e1e1;border-width:1px 0;">
                            <!-- <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-9 text-blue"><h4><i class="fa fa-address-book-o"></i><b> Address</b></h4></div> -->
                        </div>

                        <div class="form-group col-sm-12">
                            <label class="col-sm-2 control-label">Region</label>
                            <div class="col-sm-4">
                            <select class="form-control" style="width: 100%;" required="" disabled>
                            <option selected="selected" value="1">Region II</option>
                            <option value="2">Region I</option>
                            <option value="3">Region III</option>
                            </select>
                            </div>
                            <label class="col-sm-2 control-label">Province</label>
                            <div class="col-sm-4">
                            <select class="form-control" style="width: 100%;" required="" disabled>
                            <option selected="selected" value="1">Cagayan</option>
                            <option value="2">Isabela</option>
                            <option value="3">Vizcaya</option>
                            <option value="4">Batanes</option>
                            <option value="5">Quirino</option>
                            </select>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label class="col-sm-2 control-label">Municipality</label>
                            <div class="col-sm-6">
                            <select class="form-control" style="width: 100%;" required="" disabled>
                            <option selected="selected" value="1">Tuguegarao City</option>
                            <option value="2">Iguig</option>
                            <option value="3">Solana</option>
                            <option value="4">Enrile</option>
                            <option value="5">Peñablanca</option>
                            <option value="6">Gonzaga</option>
                            <option value="7">Sta. Ana</option>
                            </select>
                            </div>
                            <label for="zipcode" class="col-sm-2 control-label">Zip Code</label>
                            <div class="col-sm-2"><input type="text" class="form-control" id="emp_barangay" placeholder="" disabled required=""></div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label class="col-sm-2 control-label">Barangay</label>
                            <div class="col-sm-4">
                            <select class="form-control" style="width: 100%;" required="" disabled>
                            <option selected="selected" value="1">Ugac Norte</option>
                            <option value="2">Caritan</option>
                            <option value="3">Pallua</option>
                            </select>
                            </div>
                            <label for="zipcode" class="col-sm-2 control-label">Street/Bldg/Unit</label>
                            <div class="col-sm-4"><input type="text" class="form-control" id="emp_street" placeholder="" disabled></div>
                        </div>
                        <div class="form-group col-sm-12"></div>
                    </div>
                    <!-- /.box-body -->
                </form>
            </div>
            <!-- /.tab-pane -->

            <div class="tab-pane" ng-class="{'active': ep.tabs.setting}">
                <br>
                <form class="form-horizontal">
                    <div class="form-group">
                    <label class="col-sm-2 control-label"><h4>Upload Profile Picture</h4></label>
                    </div>
                    <div class="form-group">
                    <label for="picture" class="col-sm-2 control-label">Select Picture</label>

                    <div class="col-sm-10">
                        <input id="picture" type="file" name="pic" accept="image/*">
                    </div>
                    </div>
                    <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Uplaod</button>
                    </div>
                    </div>

                    <div class="form-group col-sm-12">
                    <hr style="border-color:#e1e1e1;border-width:1px 0;">
                    </div>

                    <div class="form-group">
                    <label class="col-sm-2 control-label"><h4>Change Password</h4></label>
                    </div>

                    <div class="form-group"  ng-class="{'has-error': ep.resetResponse.hasError}">
                    <label for="inputPword" class="col-sm-2 control-label">Current Password</label>

                    <div class="col-sm-6">
                        <input  type="password" class="form-control" id="inputPword" placeholder="Input current password" ng-model="ep.resetForm.password_current">
                    </div>
                    </div>
                    <div class="form-group"  ng-class="{'has-error': ep.resetResponse.hasError}">
                    <label for="inputPword2" class="col-sm-2 control-label">New Password</label>

                    <div class="col-sm-6">
                        <input  type="password" class="form-control" id="inputPword2" placeholder="Input new password" ng-model="ep.resetForm.password">
                    </div>
                    </div>
                    <div class="form-group"  ng-class="{'has-error': ep.resetResponse.hasError}">
                        <label for="inputPword3" class="col-sm-2 control-label">Confirm New Password</label>
                        <div class="col-sm-6">
                            <input  type="password" class="form-control" id="inputPword3" placeholder="Confirm new password" ng-model="ep.resetForm.password_confirmation">
                            <span class="help-block" ng-repeat="error in ep.resetResponse.data" ng-if="ep.resetResponse.hasError">
                                <strong><% error %></strong>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" ng-click="ep.changePassword(ep.resetForm)">Change Password</button>
                    </div>
                    </div>
                </form>
            </div>
            <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
        </div>
        <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
    </div>
</section>
