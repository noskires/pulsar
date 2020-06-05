
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

    <!-- User Account: style can be found in dropdown.less -->
    <li class="dropdown user user-menu">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <img src="public/<%mc.users[0].profile_photo || 'uploads/profile_photo/default-logo.jpg'%>" class="user-image" alt="User Image">
        <span class="hidden-xs">{{Auth::user()->name}}</span>
      </a>
      <ul class="dropdown-menu">
        <!-- User image -->
        <li class="user-header">
          <img src="public/<%mc.users[0].profile_photo || 'uploads/profile_photo/default-logo.jpg'%>" class="img-circle" alt="User Image">

          <p>
            {{Auth::user()->name}} <br>
            <small> <kbd> ID: {{Auth::user()->employee_code}} </kbd> <br>
            Member since {{Auth::user()->created_at}} </small>
          </p>
        </li>
        <!-- Menu Body -->
        <!-- Menu Footer-->
        <li class="user-footer">
          <div class="pull-left">
            <a href="" class="btn btn-light text-black">Hello there.</a>
          </div>
          <div class="pull-right">

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();" ng-click="hc.routeTo('/logout')" class="btn btn-default btn-flat">
                         <i class="fa fa-sign-out text-danger"></i> Sign Out</a>
          </div>
        </li>
      </ul>
    </li>
  </ul>
</div>

</nav>
</header>
