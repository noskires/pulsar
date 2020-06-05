<section class="content-header">
  <h1>Dashboard</h1>
  <ol class="breadcrumb">
    <li class="active"><a href="#"><i class="fa fa-th"></i> Dashboard</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
<br>
  <!-- Left -->
  <div class="col-md-5">
    <div class="row">
      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="small-box bg-success">
          <div class="inner">
            <h3><%dashboardCtrlr.employee | number:0%></h3>
            <p>Pulsar Construction Employees</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-stalker"></i>
          </div>
          <a href="pages/employees/employee-manager.html" class="small-box-footer">Employee Manager <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="small-box bg-primary">
          <div class="inner">
            <h3><%dashboardCtrlr.asset | number:0%></h3>
            <p>Construction Equipments</p>
          </div>
          <div class="icon">
            <i class="ion ion-pricetags"></i>
          </div>
          <a href="pages/asset/list-equipments.html" class="small-box-footer">View Assets <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="small-box bg-green">
          <div class="inner">
            <h3><%dashboardCtrlr.project | number:0%></h3>
            <p>Construction Projects</p>
          </div>
          <div class="icon">
            <i class="ion ion-cube"></i>
          </div>
          <a href="pages/project/list-projects.html" class="small-box-footer">View Projects <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3><%dashboardCtrlr.jobOrder | number:0%></h3>
            <p>Open Job Orders</p>
          </div>
          <div class="icon">
            <i class="ion ion-folder"></i>
          </div>
          <a href="pages/job-order/list-jo.html" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3><%dashboardCtrlr.requisition | number:0%></h3>
            <p>Open Requisition Slips</p>
          </div>
          <div class="icon">
            <i class="ion ion-clipboard"></i>
          </div>
          <a href="pages/requisition/list-rs.html" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="small-box bg-red">
          <div class="inner">
            <h3><%dashboardCtrlr.pos | number:0%></h3>
            <p>Open Purchase Orders</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="pages/purchase-order/po.html" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
  </div>
  <!-- End::Left -->
  <!-- Right -->
  <div class="col-md-7">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Version History</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-wrapper-scroll-y my-custom-scrollbar"
          style="position:relative; height:383px; overflow:auto;">
          <table class="table table-bordered" style="font-size: 1.4rem;">
            <tr>
              <th style="width: 7%;">Version</th>
              <th style="width: 10%;">Date</th>
              <th style="width: 83%;">Updates/Features</th>
            </tr>
            <tr>
              <td>1.0.0</td>
              <td>06/06/2020</td>
              <td>
                <ul>
                <li>Daily Operating Report
                  <ul>
                    <li>The user is not allowed to input operating report if the equipment status is under repair, maintenance sold, missing, lost, disposed, donated</li>
                    <li>Only daily operating reports on or before the date of the system are allowed to be recorded in the system</li>
                  </ul>
                </li>
                <li>Job Order
                  <ul>
                    <li>Allows the user to create job order for the “Active” equipment</li>
                    <li>Job Order must be created in order to make a Requisition and Issue Slip (RIS) for repairs and maintenance supplies</li>
                    <li>The user is allowed to make multiple RIS under the same JO is allowed</li>
                    <li>To close the JO, the user must manually input the date conducted and date of completion, conducted by, approved by, approved date, accepted by and date accepted</li>
                    <li>Once the JO has been closed, the user is no longer allowed to make a RIS for the particular JO</li>
                  </ul>
                </li>
                <li>Requisition and Issue Slip
                  <ul>
                    <li>To allow users to select supplies for the maintenance of the equipment, the Requisition and Issue Slip (RIS) must be created and connected in the JO.</li>
                    <li>The category of the supplies for the maintenance of the equipment must have a keyword “repairs” or “maintenance” </li>
                  </ul>
                </li>
                <li>Purchase Order
                  <ul>
                    <li>The user must select the associated RIS upon creation of PO</li>
                  </ul>
                </li>
                <li>Receipts (Delivery)
                  <ul>
                    <li>The user must select the associated PO upon creation of Receipt (Delivery)</li>
                  </ul>
                </li>
                <li>Voucher
                  <ul>
                    <li>The user cannot add anymore new supply in the particular Receipt if it already included in the Voucher item </li>
                  </ul>
                </li>
                <li>Alerts
                  <ul>
                    <li>All supplies equal or below the re-order level quantity are shown</li>
                    <li>All supplies returned to the supplier are shown</li>
                    <li>All expired equipment insurance are shown</li>
                  </ul>
                </li>
              </ul>
              </td>
            </tr>
          </table>
        </div>
      </div>
  </div>
  <!-- End::Right -->
</section>