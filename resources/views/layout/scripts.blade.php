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

<!-- <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.6.1/angular-animate.js"></script> -->
<!-- <script src="//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-2.5.0.js"></script> -->
<!-- <script type="text/javascript" src="{{URL::to('bower_components/angular1-ui-bootstrap4/dist/ui-bootstrap-tpls.js')}}"></script> -->
<!--   <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular-animate.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular-sanitize.js"></script> -->

<script type="text/javascript" src="{{URL::to('bower_components/ui-bootstrap-tpls-2.3.0.js')}}"></script>

<script src="{{URL::to('js/pulsarApp.js')}}"></script>

<!-- Services -->
<script src="{{URL::to('js/services/employees.srvcs.js')}}"></script> 
<script src="{{URL::to('js/services/assets.srvcs.js')}}"></script> 
<script src="{{URL::to('js/services/maintenance.srvcs.js')}}"></script> 
<script src="{{URL::to('js/services/organizations.srvcs.js')}}"></script> 
<script src="{{URL::to('js/services/jobOrders.srvcs.js')}}"></script> 
<script src="{{URL::to('js/services/projects.srvcs.js')}}"></script> 
<script src="{{URL::to('js/services/addresses.srvcs.js')}}"></script> 
<script src="{{URL::to('js/services/requisitions.srvcs.js')}}"></script> 
<script src="{{URL::to('js/services/receipts.srvcs.js')}}"></script> 
<script src="{{URL::to('js/services/warranties.srvcs.js')}}"></script> 

<!-- Controllers -->
<script src="{{URL::to('js/controller/employees.js')}}"></script> 
<script src="{{URL::to('js/controller/assets.js')}}"></script> 
<script src="{{URL::to('js/controller/maintenance.js')}}"></script>
<script src="{{URL::to('js/controller/jobOrders.js')}}"></script> 
<script src="{{URL::to('js/controller/projects.js')}}"></script> 
<script src="{{URL::to('js/controller/addresses.js')}}"></script> 
<script src="{{URL::to('js/controller/requisitions.js')}}"></script> 
<script src="{{URL::to('js/controller/receipts.js')}}"></script> 

@yield('additionalScripts')