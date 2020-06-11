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

<!-- Page Loader -->
<div id="loader" ng-if="poc.loader_status"></div>

<section class="content-header">
  <h1><span class="fa fa-bus"> </span> Purchase Orders Status</h1>
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
          <div export-to-xlsx data="roc.poItems" bind-to-table="'tb-requisitions-2'" filename="'List of PO Items'"></div>
          <table datatable="ng" class="table table-bordered table-hover" name="tb-requisitions-2" width="100%">
            <thead>
            <tr>
              <th>Control No. (PO)</th>
              <th>Old Reference</th>
              <th>Supply Name</th>
              <th>Description</th> 
              <th>Stock Unit</th> 
              <th>Qty in Purchase Order</th>
              <th>Qty in Receipt</th>
              <th>Balance</th>
              <th>Reference Name</th>
              <th>Asset ID</th>
              <th>Asset Name</th> 
              <th>Requested By</th> 
              <th>Date Requested</th> 
            </tr>
            </thead>
            <tbody>
            <tr ng-repeat="poItem in poc.poItems" ng-if="(poItem.item_quantity-poItem.receipt_item_quantity)!=0" >
              <td><%poItem.po_code%></td>
              <td><%poItem.old_reference%></td>
              <td><%poItem.supply_name%></td>
              <td><%poItem.item_description%></td>  
              <td><%poItem.item_stock_unit%></td>    
              <td><%poItem.item_quantity%></td>     
              <td><%poItem.receipt_item_quantity%></td>
              <td><%poItem.item_quantity-poItem.receipt_item_quantity%></td>     
              <td><%poItem.reference_name%></td>  
              <td><%poItem.asset_code%></td>
              <td><%poItem.asset_name%></td>
              <td><%poItem.requesting_employee_name%></td>
              <td><%poItem.date_requested%></td>
             </tr> 
            </tbody>
          </table>
        </div>
            <!-- /.box-body -->
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
 
