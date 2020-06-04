<!-- Content Header (Page header) -->
<style>
        body {
            padding: 15px;
        }

        .select2 > .select2-choice.ui-select-match {
            /* Because of the inclusion of Bootstrap */
            height: 29px;
        }

        .selectize-control > .selectize-dropdown {
            top: 36px;
        }
        /* Some additional styling to demonstrate that append-to-body helps achieve the proper z-index layering. */
        .select-box {
          background: #fff;
          position: relative;
          z-index: 1;
        }
        .alert-info.positioned {
          margin-top: 1em;
          position: relative;
          z-index: 10000; /* The select2 dropdown has a z-index of 9999 */
        }
    </style>

<section class="content-header">
  <h1><span class="fa fa-bus"> </span> Supply Status</h1>
  <ol class="breadcrumb">
    <li><a href="../../index.html"><i class="fa fa-th"></i> Dashboard</a></li>
    <li class="active">Maintenance</li>
  </ol>
</section>

<!-- Main content -->

<section class="content">

<!-- LIST RS -->
      <div class="box">
        <div class="box-body">
          <div export-to-xlsx data="sc.supplies" bind-to-table="'tb-requisitions-2'" filename="'Supply Status Items'"></div>
          <table datatable="ng"  class="table table-bordered table-hover" name="tb-supplies" width="100%">
            <thead>
            <tr>
            <th>Control Number</th>
            <th>Category</th>
            <th>Name</th>
            <th>Description</th>
            <th>Supply Unit</th>
            <th>Re-order Level</th>
            <th>Supply Qty</th> 
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="supply in sc.supplies">
            <td><a href="#" ui-sref="list-supplyCopy({supplyCode:supply.supply_code})"><b> <%supply.supply_code%> </b></a></td>
            <td><%supply.supply_category_name%></td>
            <td><%supply.supply_name%></td>
            <td><%supply.description%></td> 
            <td><%supply.stock_unit_name%></td> 
            <td><%supply.re_order_level%></td> 
            <td><%supply.quantity%></td>  
            </tr>
            </tbody>
        </table>
        </div> 
      </div>
  </section>

<script type="text/javascript">
$(function () {

$('.select2').select2();

//   $('#datepicker').datepicker({
//    autoclose: true
//   })

});
</script>
 
