<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><span class="fa fa-cube"> </span> List of Projects</h1>
  <ol class="breadcrumb">
    <li><a href="../../index.html"><i class="fa fa-th"></i> Dashboard</a></li>
    <li><a href="../../pages/maintenance/list-equipments.html">Maintenance</a></li>
    <li class="active">Projects Monitoring</li>
  </ol>
</section>

<section class="content">
   <div class="row">

<!-- NEW JOB ORDER SLIDE -->
    <div class="col-md-12"> 
      <div id="create-rs" class="collapse rs">
        <div class="panel panel-default">
          <div class="panel-body">
        <form class="form-horizontal" id="">
          <div class="box-body">
            <div class="form-group col-sm-12">
              <label class="col-sm-1 control-label">Department</label>
                <div class="col-sm-5">

                  <select class="form-control select2" style="width: 100%;" required="" ng-change="pc.selectDepartment(pc.projectDetails.department)" ng-model="pc.projectDetails.department">
                    <option selected="selected" value="">-- SELECT DEPARTMENT --</option>
                    <option value="<%department.org_code%>" ng-repeat="department in pc.departments"><% department.org_name%></option>
                  </select>

                </div>
              <label class="col-sm-1 control-label">Division</label>
                <div class="col-sm-5">

                  <select class="form-control select2" style="width: 100%;" required="" ng-model="pc.projectDetails.division">
                    <option selected="selected" value="">-- SELECT DIVISION --</option>
                    <option value="<%division.org_code%>" ng-repeat="division in pc.divisions"><% division.org_name%></option>
                  </select>

                </div>
              <hr style="border-color:#e1e1e1;border-width:1px 0;">
                
            </div>
            <div class="form-group col-sm-12">
            </div>

            <div class="form-group col-sm-12"">
              <label for="controlnumber" class="col-sm-2 control-label">Control Number</label>
              <div class="col-sm-6"><input type="text" class="form-control" id="controlnumber" placeholder="PROJ-01012017-5310001" disabled></div>
            </div>
            <div class="form-group col-sm-12"">
              <label for="projectid" class="col-sm-2 control-label">Project ID</label>
              <div class="col-sm-6"><input type="text" class="form-control" ng-model="pc.projectDetails.code" placeholder="" required=""></div>
            </div>
            <div class="form-group col-sm-12"">
              <label for="projectname" class="col-sm-2 control-label">Project Name</label>
              <div class="col-sm-10"><input type="text" class="form-control" ng-model="pc.projectDetails.name" placeholder="" required=""></div>
            </div>

            <div class="form-group col-sm-12"">
              <label class="col-sm-2 control-label">Description</label>
              <div class="col-sm-10">
                <div class="input-group date">
                  <textarea class="col-sm-12 form-control" id="" rows="2" ng-model="pc.projectDetails.description"></textarea>
                </div>
              </div>
            </div>

            <div class="form-group col-sm-12"">
              <label for="projectname" class="col-sm-2 control-label">Client</label>
              <div class="col-sm-10">
              <select class="form-control select2" style="width: 100%;" required="">
              <option selected="selected" value="1">Client 1</option>
              <option value="2">Client 2</option>
              </select>
              </div>
            </div>

            <div class="form-group col-sm-12"">
              <label for="projectcost" class="col-sm-2 control-label">Project Cost</label>
              <div class="col-sm-4"><input type="number" class="form-control" ng-model="pc.projectDetails.cost" placeholder="" required=""></div>
            </div>

            <div class="form-group col-sm-12">
              <hr style="border-color:#e1e1e1;border-width:1px 0;">
            </div>
            <div class="form-group col-sm-12">
              <label class="col-sm-2 control-label">Region</label>
              <div class="col-sm-4">
                <select class="form-control select2" style="width: 100%;" required="" ng-model="pc.projectDetails.region" ng-change="pc.selectRegion(pc.projectDetails.region)">
                  <option selected="selected" value="">- - - SELECT REGION - - -</option>
                  <option value="<%region.region_code%>" ng-repeat="region in pc.regions"><% region.region_text_short%></option>
                </select>
             
              </div>
              <label class="col-sm-2 control-label">Province</label>
              <div class="col-sm-4">
                <select class="form-control select2" style="width: 100%;" required="" ng-model="pc.projectDetails.province" ng-change="pc.selectProvince(pc.projectDetails.province)">
                  <option selected="selected" value="">- - - SELECT PROVINCE - - -</option>
                  <option value="<%province.province_code%>" ng-repeat="province in pc.provinces"><% province.province_text%></option>
                </select>
              </div>
            </div>
            <div class="form-group col-sm-12">
              <label class="col-sm-2 control-label">Municipality</label>
              <div class="col-sm-6">
              
                <select class="form-control select2" style="width: 100%;" required="" ng-model="pc.projectDetails.municipality">
                  <option selected="selected" value="">- - - SELECT MUNICIPALITY - - -</option>
                  <option value="<%municipality.municipality_code%>" ng-repeat="municipality in pc.municipalities"><% municipality.municipality_text%></option>
                </select>

              </div>
              <label for="zipcode" class="col-sm-2 control-label">Zip Code</label>
              <div class="col-sm-2"><input type="text" class="form-control" ng-model="pc.projectDetails.zipCode" placeholder="" disabled required=""></div>
            </div>
            <div class="form-group col-sm-12">
              <label class="col-sm-2 control-label">Barangay</label>
              <div class="col-sm-4">
                <input type="text" class="form-control" ng-model="pc.projectDetails.barangay" placeholder="">
              </div>
              <label for="zipcode" class="col-sm-2 control-label">Street/Bldg/Unit</label>
              <div class="col-sm-4"><input type="text" class="form-control" ng-model="pc.projectDetails.streetBldgUnit" placeholder=""></div>
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
              data-title="Confirm data entry." data-content="Are you sure?" style="width: 40%;margin-left: 5%;" ng-click="pc.newProject(pc.projectDetails)">CONFIRMATION</button>
              </div>
            </div>
          </div>
        </form>
          </div>
        </div>
      </div>
    </div>

<!-- FILTER SLIDE -->
    <div class="col-md-12"> 
      <div id="filter-rs" class="collapse department">
        <div class="panel panel-default">
          <div class="panel-body">
            <form class="form-horizontal" id="">
              <div class="box-body">
                <div class="form-group col-sm-12">

                  <label class="col-sm-1 control-label">Date</label>
                  <div class="col-sm-2">
                  <div class="input-group date">
                  <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                  <input type="text" class="form-control pull-right" id="daterange-filter">
                  </div></div>

                  <label for="assetname" class="col-sm-1 control-label">Project Status</label>
                  <div class="col-sm-2">
                  <label class="checkbox-inline"><input type="checkbox" value="">On-going</label>
                  <label class="checkbox-inline"><input type="checkbox" value="">Finished</label>
                  </div>

                  <div class="col-sm-1">
                  <button class="btn btn-large btn-success">FILTER DISPLAY</button>
                  </div>

                </div>
              </div>
              <!-- /.box-body -->
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>     

<!-- BUTTONS -->
<button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#create-rs">
    <span class="glyphicon glyphicon-plus"></span> Add Construction Project
</button> &nbsp; 
<button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#filter-rs">
    <span class="glyphicon glyphicon-filter"></span> Filter
</button>
<br><br>

<!-- LIST OF PROJECTS  -->     
  <div class="box">
        <div class="box-header">
          <h4 class="box-title">List of Construction Projects</h4>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table datatable="ng" class="table table-bordered table-hover" width="100%">
            <thead>
            <tr>
              <th>Control No.</th>
              <th>Project ID</th>
              <th>Project Name</th>
              <th>Project Description</th>
              <th>Project Cost</th>
              <th>Address</th>
              <th>Municipality</th>
              <th>Zip Code</th>
              <th>Date Started</th>
              <th>Date Completed</th>
              <th>Project Engineer</th>
              <th>Date Assigned</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="project in pc.projects">
              <td><a href="#" ui-sref="list-projectsCopy({projectCode:project.project_code})" ng-bind="project.project_code"> </b></a></td>
              <td ng-bind="project.code"></td>
              <td ng-bind="project.name"></td>
              <td ng-bind="project.description"></td>
              <td ng-bind="project.cost | number:2"></td>
              <td ng-bind="project.zip_code"></td>
              <td ng-bind="project.municipality_text"></td>
              <td ng-bind="project.zip_code"></td>
              <td ng-bind="project.date_started"</td>
              <td ng-bind="project.date_completed"</td>
              <td ng-bind="project.employee_name"</td>
              <td ng-bind="project.date_assigned"</td>
            </tr>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
  </div>
  <!-- MODAL CONTENTS -->
    <div class="modal fade" id="modal-default">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><i class="fa fa-cube"></i> Project Profile: <b>5310001</b></h4>
          </div>
          <div class="modal-body">
            <!-- Custom Tabs (Pulled to the right) -->
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs pull-right">
                <li class="active"><a href="#tab_1-1" data-toggle="tab">Details</a></li>
                <li class="pull-left header"> BUNTUN BRIDGE PROJECT</li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1-1">
                  <form action="view-project.html">
                    <table id="projects-modal-tbl" class="table table-bordered">
                      <tr>
                        <td>Control No.</td>
                        <td>2017-5310001</td>
                      </tr>
                      <tr>  
                        <td>Project ID</td>
                        <td>5310001</td>
                      </tr>
                      <tr>
                        <td>Project Name</td>
                        <td>BUNTUN BRIDGE PROJECT</td>
                      </tr>  
                      <tr>
                        <td>Project Cost</td>
                        <td>₱ 1,234,567.00</td>
                      </tr>
                      <tr>
                        <td>Region</td>
                        <td>Region II</td>
                      </tr>
                      <tr>
                        <td>Province</td>
                        <td>Cagayan</td>
                      </tr>
                      <tr>
                        <td>Municipality</td>
                        <td>Tuguegarao City</td>
                      </tr>
                      <tr>
                        <td>Zip Code</td>
                        <td>3500</td>
                      </tr>
                      <tr>
                        <td>Barangay</td>
                        <td>Buntun</td>
                      </tr>
                      <tr>
                        <td>Department</td>
                        <td>Pulsar Construction</td>
                      </tr>
                      <tr>
                        <td>Division</td>
                        <td>Construction</td>
                      </tr>
                      <tr>
                        <td>Date Assigned</td>
                        <td>01/30/2017</td>
                      </tr>
                      <tr>
                        <td>Target Date</td>
                        <td>12/25/2018</td>
                      </tr>
                      <tr>
                        <td>Date Started</td>
                        <td>01/01/2017</td>
                      </tr> 
                      <tr>
                        <td>Project Engineer</td>
                        <td><a href="../employee/list-employees.html" target="_blank">ENGR. MICHAEL CAPARAS</a></td>
                      </tr>
                      <tr>
                        <td>Date Completed</td>
                        <td></td>
                      </tr>
                      
                  </table>
                </div>
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div>
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary pull-right" formtarget="_blank">
              <li class="fa fa-navicon "></li> More Details</button>
            <button type="button" class="btn btn-info pull-right" style="margin-right: 7px;"><li class="fa fa-print"></li> Print</button>
            <!-- nav-tabs-custom -->
          </div>
          <div class="modal-footer">
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->       

</section>


<script type="text/javascript">
$(function () {

$('.select2').select2();

//   $('#datepicker').datepicker({
//    autoclose: true
//   })

});
</script>

  <script type="text/ng-template" id="projectInfo.modal">
    <!-- MODAL CONTENTS -->
    <div>
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><i class="fa fa-cube"></i> Project Profile: <b><%vm.formData.project_code%></b></h4>
          </div>
          <div class="modal-body">
            <!-- Custom Tabs (Pulled to the right) -->
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs pull-right">
                <li class="active"><a href="#tab_1-1" data-toggle="tab">Details</a></li>
                <li class="pull-left header"> <%vm.formData.name%></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1-1">
                  <form action="view-project.html">
                    <table id="projects-modal-tbl" class="table table-bordered">
                      <!-- <tr>
                        <td>Control No.</td>
                        <td>2017-5310001</td>
                      </tr> -->
                      <tr>  
                        <td>Project ID</td>
                        <td><%vm.formData.code%></td>
                      </tr>
                      <!-- <tr>
                        <td>Project Name</td>
                        <td>BUNTUN BRIDGE PROJECT</td>
                      </tr>   -->
                      <tr>
                        <td>Project Cost</td>
                        <td><%vm.formData.cost%></td>
                      </tr>
                      <tr>
                        <td>Region</td>
                        <td>Region II</td>
                      </tr>
                      <tr>
                        <td>Province</td>
                        <td>Cagayan</td>
                      </tr>
                      <tr>
                        <td>Municipality</td>
                        <td>Tuguegarao City</td>
                      </tr>
                      <tr>
                        <td>Zip Code</td>
                        <td>3500</td>
                      </tr>
                      <tr>
                        <td>Barangay</td>
                        <td>Buntun</td>
                      </tr>
                      <tr>
                        <td>Department</td>
                        <td>Pulsar Construction</td>
                      </tr>
                      <tr>
                        <td>Division</td>
                        <td>Construction</td>
                      </tr>
                      <tr>
                        <td>Date Assigned</td>
                       <td><%vm.formData.date_assigned%></td>
                      </tr>
                      <tr>
                        <td>Target Date</td>
                        <td></td>
                      </tr>
                      <tr>
                        <td>Date Started</td>
                        <td><%vm.formData.date_started%></td>
                      </tr> 
                      <tr>
                        <td>Project Engineer</td>
                        <td><%vm.formData.project_engineer%></td>
                        <!-- <td><a href="../employee/list-employees.html" target="_blank">ENGR. MICHAEL CAPARAS</a></td> -->
                      </tr>
                      <tr>
                        <td>Date Completed</td>
                        <td><%vm.formData.date_completed%></td>
                      </tr>
                      
                  </table>
                </div>
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div>
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary pull-right" formtarget="_blank">
              <li class="fa fa-navicon "></li> More Details</button>
            <button type="button" class="btn btn-info pull-right" style="margin-right: 7px;"><li class="fa fa-print"></li> Print</button>
            <!-- nav-tabs-custom -->
          </div>
          <div class="modal-footer">
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->       
  </script>
</section>