<!-- Page Loader -->
<div id="loader" ng-if="pc.loader_status"></div>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><span class="fa fa-cube"> </span> List of Projects</h1>
  <ol class="breadcrumb">
    <li><a href="../../index.html"><i class="fa fa-th"></i> Dashboard</a></li>
    <li><a href="../../pages/maintenance/list-equipments.html">Maintenance</a></li>
    <li class="active">Projects Monitoring</li>
  </ol>
</section>

<section class="content"  id="load_div" ng-if="!pc.loader_status">
   <div class="row">

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
<button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#create-rs" ui-sref="project-create">
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
          <div export-to-xlsx data="pc.projects" bind-to-table="'tb-projects2'" filename="'List of Projects'"></div>
          <table datatable="ng" class="table table-bordered table-hover" name="tb-projects2" width="100%">
            <thead>
            <tr>
              <th>Control No.</th>
              <th>Project ID</th>
              <th>Project Name</th>
              <th>Project Description</th>
              <th>Project Cost</th>
              <th>Address</th>
              <th>Municipality</th>
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="project in pc.projects">
              <td><a href="#" ui-sref="list-projectsCopy({projectCode:project.project_code})" ng-bind="project.project_code"> </b></a></td>
              <td ng-bind="project.code"></td>
              <td title="<%project.name%>"> 
                <span ng-bind="project.name | limitTo:30"></span> </span>
                <span ng-if="project.name.length > 30">...</span>
              </td> 
              <td title="<%project.description%>"> 
                <span ng-bind="project.description | limitTo:30"></span> </span>
                <span ng-if="project.description.length > 30">...</span>
              </td>
              <td ng-bind="project.cost | number:2"></td>
              <td ng-bind="project.zip_code"></td>
              <td ng-bind="project.municipality_text"></td>
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
});
</script>

  <script type="text/ng-template" id="projectInfo.modal">
    <!-- MODAL CONTENTS -->
    <div>
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" ui-sref="list-projects" ng-click="vm.ok()">
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
                        <td><%vm.formData.region_text_long%></td>
                      </tr>
                      <tr>
                        <td>Province</td>
                        <td><%vm.formData.province_text%></td>
                      </tr>
                      <tr>
                        <td>Municipality</td>
                        <td><%vm.formData.municipality_text%></td>
                      </tr>
                      <tr>
                        <td>Zip Code</td>
                        <td></td>
                      </tr>
                      <tr>
                        <td>Barangay</td>
                        <td></td>
                      </tr>
                      <tr>
                        <td>Department</td>
                        <td><%vm.formData.department_name%></td>
                      </tr>
                      <tr>
                        <td>Division</td>
                        <td><%vm.formData.division_name%></td>
                      </tr>
                      <tr>
                        <td>Date Assigned</td>
                       <td><%vm.formData.date_assigned%></td>
                      </tr>
                      <tr>
                        <td>Target Date</td>
                        <td><%vm.formData.target_date%></td>
                      </tr>
                      <tr>
                        <td>Date Started</td>
                        <td><%vm.formData.date_started%></td>
                      </tr> 
                      <tr>
                        <td>Project Engineer</td>
                        <td><%vm.formData.project_engineer_name%></td>
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
            <!-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button> -->
            <button type="submit" class="btn btn-primary pull-right" formtarget="_blank" ui-sref="project-profile({projectCode:vm.formData.project_code})" ng-click="vm.ok()">
              <li class="fa fa-navicon "></li> More Details</button>
            <!-- <button type="button" class="btn btn-info pull-right" style="margin-right: 7px;"><li class="fa fa-print"></li> Print</button> -->
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