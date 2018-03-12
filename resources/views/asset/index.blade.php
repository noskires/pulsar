@extends('layout.master')

@section('additionalStyles')
<link rel="stylesheet" href="{{URL::to('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
<!-- datatables -->
<link rel="stylesheet" href="{{URL::to('bower_components/datatables.net/css/buttons.dataTables.min.css')}}">
<!-- daterange picker -->
<link rel="stylesheet" href="{{URL::to('bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{{URL::to('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{{URL::to('assets/plugins/iCheck/all.css')}}">
<!-- Bootstrap Color Picker -->
<link rel="stylesheet" href="{{URL::to('bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')}}">
<!-- Bootstrap time Picker -->
<link rel="stylesheet" href="{{URL::to('assets/plugins/timepicker/bootstrap-timepicker.min.css')}}">
<!-- Select2 -->
<link rel="stylesheet" href="{{URL::to('bower_components/select2/dist/css/select2.min.css')}}">
<style>
  .example-modal .modal {
    position: relative;
    top: auto;
    bottom: auto;
    right: auto;
    left: auto;
    display: block;
    z-index: 1;
  }

  .example-modal .modal {
    background: transparent !important;
  }

  #box-monitoring  {width: 100%; border-spacing:0;border-color:#282828;border-style:2px solid black;border-width:2px;overflow-x:scroll;}
</style>
@stop

@section('content')
<script type="text/ng-template" id="asset.create.view">
  @include('asset.add_asset')
</script> 

@endsection

@section('additionalScripts')
<script src="{{URL::to('js/app/assets.js')}}"></script>

<!-- Confirmation -->
<script src="{{URL::to('bower_components/Bootstrap-Confirmation-master/bootstrap-confirmation.js')}}"></script> 
<!-- Select2 -->
<script src="{{URL::to('bower_components/select2/dist/js/select2.full.min.js')}}"></script> 
<!-- InputMask -->
<script src="{{URL::to('assets/plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{URL::to('assets/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{URL::to('assets/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
<!-- date-range-picker -->
<script src="{{URL::to('bower_components/moment/min/moment.min.js')}}"></script> 
<script src="{{URL::to('bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script> 
<!-- bootstrap datepicker -->
<script src="{{URL::to('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<!-- bootstrap color picker -->
<script src="{{URL::to('bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>    
<!-- bootstrap time picker -->
<script src="{{URL::to('assets/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script> 
<!-- iCheck 1.0.1 -->
<script src="{{URL::to('assets/plugins/iCheck/icheck.min.js')}}"></script> 
<!-- DataTables -->
<script src="{{URL::to('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script> 
<script src="{{URL::to('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script> 
<script src="{{URL::to('bower_components/datatables.net/js/dataTables.buttons.min.js')}}"></script> 
<script src="{{URL::to('bower_components/datatables.net/js/jszip.min.js')}}"></script> 
<script src="{{URL::to('bower_components/datatables.net/js/pdfmake.min.js')}}"></script> 
<script src="{{URL::to('bower_components/datatables.net/js/vfs_fonts.js')}}"></script> 
<script src="{{URL::to('bower_components/datatables.net/js/buttons.html5.min.js')}}"></script> 
<script src="{{URL::to('bower_components/datatables.net/js/buttons.print.min.js')}}"></script> 

<script type="text/javascript">
 
$('[data-toggle=confirmation]').confirmation({
  rootSelector: '[data-toggle=confirmation]',
  // other options
});

$(function () {
    //Initialize Select2 Elements
    $('.select2').select2();

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })
    $('#datepicker2').datepicker({
      autoclose: true
    })
    $('#datepicker3').datepicker({
      autoclose: true
    })
    //iCheck for checkbox and radio inputs
    // $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
    //   checkboxClass: 'icheckbox_minimal-blue',
    //   radioClass   : 'iradio_minimal-blue'
    // })
    // //Red color scheme for iCheck
    // $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
    //   checkboxClass: 'icheckbox_minimal-red',
    //   radioClass   : 'iradio_minimal-red'
    // })
    // //Flat red color scheme for iCheck
    // $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
    //   checkboxClass: 'icheckbox_flat-green',
    //   radioClass   : 'iradio_flat-green'
    // })
    // //Colorpicker
    // $('.my-colorpicker1').colorpicker()
    // //color picker with addon
    // $('.my-colorpicker2').colorpicker()

    // //Timepicker
    // $('.timepicker').timepicker({
    //   showInputs: false
    // })
 })
</script>
@endsection