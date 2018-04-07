<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><span class="fa fa-cube"> </span> List of Projects</h1>
  <ol class="breadcrumb">
    <li><a href="../../index.html"><i class="fa fa-th"></i> Dashboard</a></li>
    <li><a href="../../pages/maintenance/list-equipments.html">Maintenance</a></li>
    <li class="active">Projects Monitoring</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="box">
        <div class="box-header">
          <h4 class="box-title">Complete list of Active Projects</h4>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="projects" class="table table-bordered table-hover">
            <thead>
            <tr>
              <th>Control No.</th>
              <th>Project ID</th>
              <th>Project Name</th>
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
              <td><a href="#" data-toggle="modal" data-target="#modal-default" ng-bind="project.project_code"> </b></a></td>
              <td ng-bind="project.project_id"></td>
              <td ng-bind="project.name"></td>
              <td ng-bind="project.cost"></td>
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
            <h4 class="modal-title">Project Profile</h4>
          </div>
          <div class="modal-body">
            <!-- Custom Tabs (Pulled to the right) -->
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs pull-right">
                <li class="active"><a href="#tab_1-1" data-toggle="tab">Details</a></li>
                <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    Options <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Edit</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Mark as Finished</a></li>
                    <li role="presentation" class="divider"></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Print</a></li>
                  </ul>
                </li>
                <li class="pull-left header"><i class="fa fa-cube"></i> 5310001</li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1-1">
                  <b>BUNTUN BRIDGE PROJECT</b><br>
                  <b>TABLE HERE.</b><br>
                  A wonderful serenity has taken possession of my entire soul,
                  like these sweet mornings of spring which I enjoy with my whole heart.
                  I am alone, and feel the charm of existence in this spot,
                  which was created for the bliss of souls like mine. I am so happy,
                  my dear friend, so absorbed in the exquisite sense of mere tranquil existence,
                  that I neglect my talents. I should be incapable of drawing a single stroke
                  at the present moment; and yet I feel that I never was a greater artist than now.
                </div>
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div>
            <!-- nav-tabs-custom -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-info"><li class="fa fa-print"></li> Print</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

</section>