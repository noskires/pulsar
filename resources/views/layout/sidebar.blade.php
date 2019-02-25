
<section class="sidebar" ng-controller="MainCtrl as mc">
  <!-- Sidebar user panel -->
  <div class="user-panel">
    <div class="pull-left image">
      <img src="{{url::to('assets/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
      <p>{{Auth::user()->name}}</p>
      <a href="#"><i class="fa fa-circle text-success"></i> Administrator</a>
    </div>
  </div>
  <!-- search form -->
  <form action="#" method="get" class="sidebar-form">
    <div class="input-group">
      <input type="text" name="q" class="form-control" placeholder="Search...">
      <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat">
              <i class="fa fa-search"></i>
            </button>
          </span>
    </div>
  </form>
  <!-- /.search form -->
  <!-- sidebar menu -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
    <li class="active"><a href="index"><i class="fa fa-th"></i> <span>Dashboard</span></a></li>
    <li class="treeview">
      <a href="#">
        <i class="fa fa-cogs"></i> <span>Maintenance</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
      <!--   <li><a href="#" ng-click="mc.routeTo('/maintenance/operation')"><i class="fa fa-circle-o"></i> Daily Operating Report</a></li> -->
      <li><a href="#" ui-sref="operation-create"><i class="fa fa-circle-o"></i> Daily Operating Report</a></li>
      <li><a href="#" ui-sref="list-operating"><i class="fa fa-circle-o"></i> Operating Records</a></li>
      <li><a href="#" ui-sref="list-monitoring"><i class="fa fa-circle-o"></i> Maintenance Monitoring</a></li> 
      <li><a href="#" ui-sref="list-jo"><i class="fa fa-list-ul"></i> List of J.O.</a></li>
        <!-- <li><a ui-sref="list-monitoring-view"><i class="fa fa-circle-o"></i> Maintenance Monitoring</a></li>  -->
      </ul>
      
    </li>
    <li class="treeview">
      <a href="#">
        <i class="fa fa-exclamation-triangle"></i> <span>Alerts</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
          <small class="label pull-right bg-yellow">12</small>
          <small class="label pull-right bg-red">15</small>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> Due for Maintenance</a></li>
        <li><a href="#"><i class="fa fa-circle-o text-green"></i> On-going Maintenance</a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Supply Levels</a></li>
      </ul>
    </li>   
    <li>
      <a href="#">
        <i class="fa fa-calendar"></i> <span>Calendar</span>
        <span class="pull-right-container">
          <small class="label pull-right bg-aqua">12</small>
          <small class="label pull-right bg-blue">15</small>
        </span>
      </a>
    </li>
    <li class="treeview">
      <a href="#" ui-sref="list-requesition2">
        <i class="fa fa-file-text"></i> <span>Requisition</span>
        <!-- <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span> -->
      </a>
      <!-- <ul class="treeview-menu"> -->
        <!-- <li><a href="#" ui-sref="list-requesition"><i class="fa fa-list-ul"></i> List of R.S.</a></li> -->
        <!-- <li><a href="#" ui-sref="list-requesition2"><i class="fa fa-list-ul"></i> List of R.S.</a></li> -->
        <!-- <li><a href="#" ui-sref="requesition-office-create"><i class="fa fa-list-ul"></i> Create R.S.</a></li> -->
        <!-- <li><a href="#"><i class="fa fa-check"></i> Supply Withdrawal</a></li> -->
      <!-- </ul> -->
    </li>
    <li class="treeview">
      <a href="#" ui-sref="list-po2">
        <i class="fa fa-shopping-basket"></i> <span>Purchase Order</span>
        <!-- <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span> -->
      </a>
      <!-- <ul class="treeview-menu">
        <li><a href="#" ui-sref="list-po"><i class="fa fa-list-ul"></i> List of P.O.</a></li>
        <li><a href="#"><i class="fa fa-pencil"></i> Create P.O.</a></li>
      </ul> -->
    </li> 

    <li class="treeview">
      <a href="#" ui-sref="list-jo2">
        <i class="fa fa-shopping-basket"></i> <span>Job Order</span>
        <!-- <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span> -->
      </a>
      <!--<ul class="treeview-menu">
        <li><a href="#" ui-sref="list-jo2"><i class="fa fa-list-ul"></i> List of J.O.</a></li>
        <li><a href="#"><i class="fa fa-pencil"></i> Create P.O.</a></li>
      </ul> -->
    </li>  

    <li class="treeview">
      <a href="#" ui-sref="list-utilization">
        <i class="fa fa-shopping-basket"></i> <span>Utilization</span>
        <!-- <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span> -->
      </a>
      <!-- <ul class="treeview-menu">
        <li><a href="#" ui-sref="list-utilization"><i class="fa fa-list-ul"></i> List of Utilization </a></li>
        <li><a href="#"><i class="fa fa-pencil"></i> Create P.O.</a></li>
      </ul> -->
    </li>   

     <li class="treeview">
      <a href="#" ui-sref="list-voucher">
        <i class="fa fa-credit-card"></i> <span> Vouchers</span>
        <!-- <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span> -->
      </a>
     <!--  <ul class="treeview-menu">
        <li><a href="#" ui-sref="list-voucher"><i class="fa fa-list-ul"></i> List of Vouchers</a></li>
        <li><a href="#" ui-sref="voucher-create"><i class="fa fa-plus"></i> Create a Voucher</a></li>
      </ul> -->
    </li>
    <li class="header">DATABASE</li>
    <li class="treeview">
      <a href="#">
        <i class="fa fa-tags"></i> <span>Assets</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="#" ui-sref="asset-list-equipments"><i class="fa fa-list-ul"></i> List of Assets</a></li>
        <li><a href="#" ui-sref="asset-create"><i class="fa fa-plus"></i> Add an Asset</a></li>
        <li><a href="#" ui-sref="list-ares"><i class="fa fa-file-text-o"></i> ARE </a></li>
      </ul>
    </li>
    <li class="treeview">
      <a href="#">
        <i class="fa fa-briefcase"></i> <span>Supplies</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="#" ui-sref="list-supply"><i class="fa fa-list-ul"></i> List of Supplies</a></li> 
        <li><a href="#" ui-sref="supply-create"><i class="fa fa-plus"></i> Add Supply</a></li>
      </ul>
    </li>
    <li class="treeview">
      <a href="#" ui-sref="list-receipt2">
        <i class="fa fa-file"></i> <span>Receipts</span>
        <!-- <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span> -->
      </a>
      <!-- <ul class="treeview-menu">
        <li><a href="#" ui-sref="list-receipt"><i class="fa fa-list-ul"></i> List of Receipts</a></li>
        <li><a href="#" ui-sref="receipt-create"><i class="fa fa-pencil"></i> Create Receipt</a></li> 
      </ul> -->
    </li>
    <li class="treeview"><a href="#" ui-sref="org-office-create"><i class="fa fa-building"></i> Office </a></li>
    <li class="treeview">
      <a href="#">
        <i class="fa fa-cube"></i> <span>Projects</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="#" ui-sref="list-projects"><i class="fa fa-list-ul"></i> List of Projects</a></li>
        <li><a href="#" ui-sref="project-create"><i class="fa fa-plus"></i> Add a Project</a></li>
      </ul>
    </li>
    <li><a href="#" ui-sref="list-employees"><i class="fa fa-user"></i> <span>Employees</span></a></li>
    <li class="header">TOOLS</li>
    <li class="treeview">
      <a href="#">
        <i class="fa fa-bar-chart"></i> <span>Reports</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="#"><i class="fa fa-paperclip"></i>Maintenance Reports</a></li>
        <li><a href="#"><i class="fa fa-paperclip"></i>Asset Reports</a></li>
        <li><a href="#"><i class="fa fa-paperclip"></i>Supplies Reports</a></li>
        <li><a href="#"><i class="fa fa-paperclip"></i>J.O. Reports</a></li>
        <li><a href="#"><i class="fa fa-paperclip"></i>R.S. Reports</a></li>
        <li><a href="#"><i class="fa fa-paperclip"></i>P.O. Reports</a></li>
        <li><a href="#"><i class="fa fa-paperclip"></i>Project Reports</a></li>
        <li><a href="#"><i class="fa fa-paperclip"></i>Status Reports</a></li>
        <li><a href="#" ui-sref="list-po-office"><i class="fa fa-paperclip"></i>Purchase Order Reports</a></li>
        <li><a href="#" ui-sref="list-utilization-office"><i class="fa fa-paperclip"></i>Utilization Reports</a></li>
        <li><a href="#"><i class="fa fa-paperclip"></i>Other Reports</a></li>
      </ul>
    </li>
    <li class="treeview">
      <a href="#"><i class="fa fa-wrench"></i> <span>Setup</span></a>
      <ul class="treeview-menu">
        <li>
            <a href="#" ui-sref="list-asset-categories"><i class="fa fa-list-ul"></i>Asset Category</a>
            <a href="#" ui-sref="list-supply-categories"><i class="fa fa-list-ul"></i>Supply Category</a>
            <a href="#" ui-sref="list-supply-unit"><i class="fa fa-list-ul"></i>Supply Unit</a>
            <a href="#" ui-sref="list-suppliers"><i class="fa fa-list-ul"></i>Supplier</a>
            <a href="#" ui-sref="list-particular"><i class="fa fa-list-ul"></i>Particular</a>
            <a href="#" ui-sref="list-particular"><i class="fa fa-list-ul"></i>Particular</a>
            <a href="#" ui-sref="list-particular"><i class="fa fa-list-ul"></i>Others</a>
            <a href="#" ui-sref="list-user"><i class="fa fa-list-ul"></i>Users</a>
            <a href="#" ui-sref="list-role"><i class="fa fa-list-ul"></i>Roles</a>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </li>
      </ul>
    </li>
    <li class="treeview">
          <a href="#">
            <i class="fa fa-cloud"></i> <span>Advanced</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#" ui-sref="list-banks"><i class="fa fa-bank"></i>Bank</a></li>
            <li><a href="#" ui-sref="list-insurance"><i class="fa fa-shield"></i>Insurance</a></li>
            <li><a href="#"><i class="fa fa-money"></i>Funding</a></li>
            <li><a href="#"><i class="fa fa-user"></i>Users</a></li>
            <li><a href="#"><i class="fa fa-users"></i>User's Group</a></li>
            <li><a href="pages/advanced/offices.html"><i class="fa fa-building"></i>Offices</a></li>
            <li><a href="#" ui-sref="list-client"><i class="fa fa-building"></i>Clients</a></li>
            <li><a href="#" ui-sref="list-fund"><i class="fa fa-building"></i>Funds</a></li>
          </ul>
        </li>
    <li><a href="#"><i class="fa fa-question-circle"></i> <span>Help/Support</span></a></li>
  </ul>
</section>