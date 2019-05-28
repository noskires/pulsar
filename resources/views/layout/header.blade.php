
<header class="main-header">
<!-- Logo -->
<a href="index.html" class="logo">
<!-- mini logo for sidebar mini 50x50 pixels -->
<span class="logo-mini"><b>P</b>C</span>
<!-- logo for regular state and mobile devices -->
<span class="logo-lg"><b></b>Pulsar Construction</span>
</a>

<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top">
<!-- Sidebar toggle button-->
<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
  <span class="sr-only">Toggle navigation</span>
</a>
<!-- Navbar Right Menu -->
<div class="navbar-custom-menu">
  <ul class="nav navbar-nav">
    <!-- Messages: style can be found in dropdown.less-->
    <!-- Notifications: style can be found in dropdown.less -->
    <li class="dropdown notifications-menu">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-bell-o"></i>
        <span class="label label-warning">10</span>
      </a>
      <ul class="dropdown-menu">
        <li class="header">You have 10 notifications</li>
        <li>
          <!-- inner menu: contains the actual data -->
          <ul class="menu">
            <li>
              <a href="#">
                <i class="fa fa-warning text-yellow"></i> Maintenance notifications
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-shopping-cart text-green"></i> Purchase order notifications
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-user text-red"></i> Employee notifications
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-warning text-yellow"></i> Maintenance notifications
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-calendar text-blue"></i> Calendar notifications
              </a>
            </li>
          </ul>
        </li>
        <li class="footer"><a href="#">View all</a></li>
      </ul>
    </li>
    <!-- Tasks: style can be found in dropdown.less -->
    <li class="dropdown tasks-menu">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-flag-o"></i>
        <span class="label label-danger">9</span>
      </a>
      <ul class="dropdown-menu">
        <li class="header">You have 9 tasks</li>
        <li>
          <!-- inner menu: contains the actual data -->
          <ul class="menu">
            <li><!-- Task item -->
              <a href="#">
                <h3>
                  Task 1
                  <small class="pull-right">20%</small>
                </h3>
                <div class="progress xs">
                  <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                       aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                    <span class="sr-only">20% Complete</span>
                  </div>
                </div>
              </a>
            </li>
            <!-- end task item -->
            <li><!-- Task item -->
              <a href="#">
                <h3>
                  Task 2
                  <small class="pull-right">40%</small>
                </h3>
                <div class="progress xs">
                  <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar"
                       aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                    <span class="sr-only">40% Complete</span>
                  </div>
                </div>
              </a>
            </li>
            <!-- end task item -->
            <li><!-- Task item -->
              <a href="#">
                <h3>
                  Task 3
                  <small class="pull-right">60%</small>
                </h3>
                <div class="progress xs">
                  <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar"
                       aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                    <span class="sr-only">60% Complete</span>
                  </div>
                </div>
              </a>
            </li>
            <!-- end task item -->
            <li><!-- Task item -->
              <a href="#">
                <h3>
                  Task 4
                  <small class="pull-right">80%</small>
                </h3>
                <div class="progress xs">
                  <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar"
                       aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                    <span class="sr-only">80% Complete</span>
                  </div>
                </div>
              </a>
            </li>
            <!-- end task item -->
          </ul>
        </li>
        <li class="footer">
          <a href="#">View all tasks</a>
        </li>
      </ul>
    </li>
    <!-- User Account: style can be found in dropdown.less -->
    <li class="dropdown user user-menu">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <img src="{{url::to('assets/dist/img/user2-160x160.jpg')}}" class="user-image" alt="User Image">
        <span class="hidden-xs">{{Auth::user()->name}}</span>
      </a>
      <ul class="dropdown-menu">
        <!-- User image -->
        <li class="user-header">
          <img src="{{url::to('assets/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">

          <p>
            {{Auth::user()->name}}
            <!-- <small>Member since Nov. 2018</small> -->
          </p>
        </li>
        <!-- Menu Body -->
        <!-- Menu Footer-->
        <li class="user-footer">
          <div class="pull-left">
            <a href="#" class="btn btn-default btn-flat">Profile</a>
          </div>
          <div class="pull-right">

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();" ng-click="hc.routeTo('/logout')" class="btn btn-default btn-flat">Sign out</a>
          </div>
        </li>
      </ul>
    </li>
  </ul>
</div>

</nav>
</header>
