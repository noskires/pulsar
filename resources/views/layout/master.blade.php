<!DOCTYPE html>
<html ng-app="pulsarApp" ng-cloak>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Pulsar Construction</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  @include('layout.styles')

  @if(Config::get('defaults.default.is_local')==1)
  <base href="/pulsar-master/">
  @else
  <base href="/">
  @endif

  <style type="text/css">
  /*Page Loader Style*/
	/* Center the loader */
	#loader {
	  position: absolute;
	  left: 50%;
	  top: 50%;
	  z-index: 1;
	  width: 150px;
	  height: 150px;
	  margin: -75px 0 0 -75px;
	  border: 12px solid #f3f3f3;
	  border-radius: 50%;
	  border-top: 12px solid #3498db;
	  width: 70px;
	  height: 70px;
	  -webkit-animation: spin 2s linear infinite;
	  animation: spin 2s linear infinite;
	  opacity:0.75;
	}

	@-webkit-keyframes spin {
	  0% { -webkit-transform: rotate(0deg); }
	  100% { -webkit-transform: rotate(360deg); }
	}

	@keyframes spin {
	  0% { transform: rotate(0deg); }
	  100% { transform: rotate(360deg); }
	}

	/* Add animation to "page content" */
	.animate-bottom {
	  position: relative;
	  -webkit-animation-name: animatebottom;
	  -webkit-animation-duration: 1s;
	  animation-name: animatebottom;
	  animation-duration: 1s
	}

	@-webkit-keyframes animatebottom {
	  from { bottom:-100px; opacity:0 } 
	  to { bottom:0px; opacity:1 }
	}

	@keyframes animatebottom { 
	  from{ bottom:-100px; opacity:0 } 
	  to{ bottom:0; opacity:1 }
	}

	/* #load_div {
	  display: none;
	} */
  /*end Page loader style*/
  </style>

</head>
<body class="hold-transition skin-blue fixed sidebar-mini">
<div class="wrapper" ng-controller="MainCtrl as mc" ng-cloak>
  <!-- Header -->
  @include('layout.header')
  <!-- Header -->

  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
      @include('layout.sidebar')
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @yield('content')
    <div ui-view></div>
  </div>

  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <!-- Application Version Here --><div class="pull-right hidden-xs"><b>Version</b> 1.1.0</div><!-- /.Application Version -->
    Copyright &copy;2020 Bizlogiks.ph. All rights reserved.
    <code class="pull-right text-black">Software Licence #: BZLGS-2020-01010000 (Pulsar Construction)</code> 
    <!-- HexBinary"P"=01010000 -->
  </footer>
</div>
<!-- ./wrapper -->

@include('layout.scripts')

</body>
</html>