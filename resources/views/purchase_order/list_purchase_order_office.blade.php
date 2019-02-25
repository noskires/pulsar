<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><span class="fa fa-file-text"> </span> Purchase Orders </h1><br>
    
  <ol class="breadcrumb">
    <li><a href="../../index.html"><i class="fa fa-th"></i> Dashboard</a></li>
    <li><i class="fa fa-tags"></i> Asset Database</li>
    <li class="active">Utilization</li>
  </ol>
</section>  

<!-- Main content -->
<section class="content">
  <div class="row">
    <div id="button-top" class="col-md-12"> 
 

<!-- FILTER DISPLAY -->
      <div id="filter" ><br>
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Generate Purchase Order Report</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
        <!-- form start -->
        <form id="from-unit" class="form-horizontal" role="form">
          <div class="form-group col-sm-12"">
            <div class="col-sm-2"> 
      
              <input type="text" class="form-control pull-right" datepicker2 ng-model="poc.purchaseOrderDetails.date_from" required="" readonly="">
            </div>
            <div class="col-sm-2"> 
              <input type="text" class="form-control pull-right" datepicker2 ng-model="poc.purchaseOrderDetails.date_to" required="" readonly="">
            </div>

            <div class="col-sm-2">
              <select class="form-control select2" style="width: 100%;" ng-model="poc.purchaseOrderDetails.request_type" required="">
                <option value="">--Select Request Type--</option>
                <option value="Office">Office</option>
                <option value="Project">Project</option>
              </select>
            </div>

            <div class="col-sm-3">
              <select class="form-control select2" style="width: 100%;" ng-model="poc.purchaseOrderDetails.reference_code" required="" ng-change="poc.selectPurchaseOrders(poc.purchaseOrderDetails.reference_code)">
                <option value="">--Select--</option>
                <option ng-if="poc.purchaseOrderDetails.request_type=='Office'" value="<%organization.org_code%>" ng-repeat="organization in poc.organizations"><%organization.org_name%></option>
                <option ng-if="poc.purchaseOrderDetails.request_type=='Project'" value="<%project.project_code%>" ng-repeat="project in poc.projects"><%project.name%></option>
              </select>
            </div>

            <div class="col-sm-2">
              <select class="form-control select2" style="width: 100%;" ng-model="poc.purchaseOrderDetails.purchase_order_code" required="">
                <option value="">--Select PO--</option>
                <option value="<%po.po_code%>" ng-repeat="po in poc.pos"><%po.po_code%></option>
              </select>
            </div>
          
            <div class="col-sm-1">
              <a type="button" class="btn btn-primary btn-flat" ng-click="poc.printPurchaseOrderOfficeDetails(poc.purchaseOrderDetails)" target="_blank" ng-href="<%poc.url%>">Generate</a></div>
          </div>
        </form>
      </div>
      </div>
      <!-- /.box -->
      </div>
    </div>
  </div><br>       

      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
</script>