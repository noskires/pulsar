<!-- jQuery 3 -->
<script src="{{URL::to('bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 --> 
<script src="{{URL::to('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- FastClick -->
<script src="{{URL::to('bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- App -->
<script src="{{URL::to('assets/dist/js/app.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{URL::to('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- Angularjs -->
<script src="{{URL::to('bower_components/angular/angular.min.js')}}"></script>
<!-- Router -->
<script type="text/javascript" src="{{URL::to('bower_components/angular-ui-router/release/angular-ui-router.min.js')}}"></script>
<!-- Sanitize -->
<script type="text/javascript" src="{{URL::to('bower_components/angular-sanitize/angular-sanitize.min.js')}}"></script>
<!-- Pulsar App -->

<script src="{{URL::to('js/pulsarApp.js')}}"></script>

<!-- Services -->
<script src="{{URL::to('js/services/employees.srvcs.js')}}"></script> 
<script src="{{URL::to('js/services/assets.srvcs.js')}}"></script> 
<script src="{{URL::to('js/services/organizations.srvcs.js')}}"></script> 
<script src="{{URL::to('js/services/jobOrders.srvcs.js')}}"></script> 
<script src="{{URL::to('js/services/projects.srvcs.js')}}"></script> 

<!-- Controllers -->
<script src="{{URL::to('js/controller/assets.js')}}"></script> 
<script src="{{URL::to('js/controller/maintenance.js')}}"></script>
<script src="{{URL::to('js/controller/jobOrders.js')}}"></script> 
<script src="{{URL::to('js/controller/projects.js')}}"></script> 

@yield('additionalScripts')