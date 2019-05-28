<!DOCTYPE html>
<html ng-app="pulsarApp" ng-cloak>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Pulsar Construction</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  @include('layout.styles')
  <base href="/">
</head>
<body class="hold-transition skin-blue fixed sidebar-mini">
<div class="wrapper">
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
    <div class="pull-right hidden-xs"><b>Version</b> 1.0</div>
    <strong>Copyright &copy; <a target="_blank" href="http://bizlogiks.ph/">Bizlogiks-Business Solutions</a>.</strong> All rights
    reserved.
  </footer>
</div>
<!-- ./wrapper -->

@include('layout.scripts')

</body>
</html>

