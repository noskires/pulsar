
<!-- Page Loader -->
<div id="loader" ng-if="dashboardCtrlr.loader_status"></div>


<section class="content-header">
  <h1>Dashboard</h1>
  <ol class="breadcrumb">
    <li class="active"><a href="#"><i class="fa fa-th"></i> Dashboard</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content" id="load_div" ng-if="!dashboardCtrlr.loader_status">
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
          <a href="" ui-sref="list-employees" class="small-box-footer">Employee Manager <i class="fa fa-arrow-circle-right"></i></a>
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
          <a href="" ui-sref="asset-list-equipments" class="small-box-footer">View Assets <i class="fa fa-arrow-circle-right"></i></a>
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
          <a href="" ui-sref="list-projects" class="small-box-footer">View Projects <i class="fa fa-arrow-circle-right"></i></a>
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
          <a href="" ui-sref="list-jo2" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
          <a href="" ui-sref="list-requesition2" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
          <a href="" ui-sref="list-po2" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
            <tr style="background: #f1f1f1;">
              <th style="width: 7%;">Version</th>
              <th style="width: 10%;">Date</th>
              <th style="width: 83%;">Updates/Features</th>
            </tr>
          <!-- VERSION 1.1.0 -->  
            <tr>
              <td>1.1.0</td>
              <td>06/09/2020</td>
              <td>
                <ul>
                <li>Password Resetting of User
                  <ul>
                    <li>Upon resetting of password, the user must log-in and must change the password immediately</li>
                    <li>The administrator can now globally deactivate all users via Group Roles (Access Rights) especially during audit and inspection</li>
                    <li>If the account of the user has been deactivated via Group Roles (Access Rights) and the user has requested for activation, the administrator must reset the password upon activation of the account</li>
                  </ul>
                </li>
                <li>Returned Items in the Receipt
                  <ul>
                    <li>The user is allowed to return the items to the supplier in the receipt (delivery). If the items have been delivered, the user must click the “remove” link to exclude the items in the list of returned items and immediately add the received items from the supplier. </li>
                  </ul>
                </li>
                <li>Closing of RIS
                  <ul>
                    <li>To close the RIS, the user must provide all the details under “Withdrawal Information” and click the “Finalize” button. Once the RIS has been closed, the user is no allowed anymore to insert additional items.</li>
                  </ul>
                </li>
                <li>Closing of PO
                  <ul>
                    <li>To close the PO, the user must provide all the details under “Delivery Information” and click the “Finalize” button. Once the PO has been closed, the user is not allowed anymore to insert additional items and the particular PO will not be available anymore in the dropdown list of PO under the receipt (delivery) module</li>
                  </ul>
                </li>
                <li>Closing of Receipt
                  <ul>
                    <li>To close the Receipt, the user must include the receipt item in the voucher module. Once the receipt has been selected and included in the voucher, the user is not allowed anymore to insert additional items under the receipt.</li>
                  </ul>
                </li>
                <li>Splitting of RIS Containing Items with Different Supply Category
                  <ul>
                    <li>The user is not allowed to request for Repairs and Maintenance (R&M) supplies without the Job Order. If the R&M supplies are requested in the RIS along with non-R&M supplies, the user must split the RIS. To split the RIS in the system, the user must create two (2) Reference numbers with extension names. (Example: RS06072020-1, RS06072020-2)</li>
                  </ul>
                </li>
                <li>RIS for Repairs and Maintenance Supply
                  <ul>
                    <li>The RIS containing Asset ID and Asset Name is intended for Repairs and Maintenance supply for asset. Under this RIS, the user is not allowed to insert non-Repairs and Maintenance supply</li>
                  </ul>
                </li>
                <li>Create Multiple PO using One (1) RIS
                  <ul>
                    <li>The user is allowed to create multiple PO transactions using one (1) RIS if the particular RIS is still “Open</li>
                    <li></li>
                  </ul>
                </li>
                <li>Create Multiple Receipt using One (1) PO
                  <ul>
                    <li>The user is allowed to create multiple Receipt transactions using one (1) PO if the particular PO is still “Open</li>
                  </ul>
                </li>
              </ul>
              </td>
            </tr>
          <!-- VERSION 1.0.0 -->
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