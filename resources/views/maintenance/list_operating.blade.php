<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><span class="fa fa-cogs"> </span> List of Operating Records</h1>
      <ol class="breadcrumb">
        <li><a href="../../index.html"><i class="fa fa-th"></i> Dashboard</a></li>
        <li class="active">Operating records</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- <div class="row">
        <div class="col-sm-4">
          <div class="box"> 
              <form role="form">
                <div class="box-body">
                  <div class="form-group">
                    <div class="col-sm-7"> 
                    <button type="button" class="btn btn-default" id="daterange-btn">
                      <span><i class="fa fa-calendar"></i> Date range picker </span> <i class="fa fa-caret-down"></i>
                    </button>
                    </div>
                    <div class="col-sm-3"> 
                    <button type="button" class="btn btn-default"><li class="fa fa-refresh"></li> Filter Display</button>
                    </div>
                  </div>
                </div> 
              </form>
          </div>
        </div>
      </div> -->
      <div class="box box-primary">
            <div class="box-body">
              <table datatable="ng" class="table table-bordered table-hover" width="100%">
                <thead>
                <tr>
                  <th>Control Number</th>
                  <th>Asset Code</th>
                  <th>Date</th>
                  <th>Equipment Name</th>
                  <th>Asset ID</th>
                  <th>Project Name</th>
                  <th>Project ID</th>
                  <th>Office Location</th>
                  <th>Activity/Remarks</th>
                  <th>Operating Time(HRS)</th>
                  <th>Distance Travelled(KM)</th>
                  <th>Diesel (L)</th>
                  <th>Gas (L)</th>
                  <th>Oil (L)</th>
                  <th>Loads</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                <tr ng-repeat="operation in loc.operations">
                  <td><a href="#" data-toggle="modal" data-target="#modal-default"><b><%operation.operation_code%></b></a></td>
                  <td><%operation.asset_code%></td>
                  <td><%operation.operation_date%></td>
                  <td><%operation.asset_name%></td>
                  <td><%operation.code%></td>
                  <td><%operation.project_name%></td>
                  <td><%operation.project_code%></td>
                  <td><%operation.barangay+' '+operation.municipality_text +' '+ operation.province_text+' '+ operation.region_text_short%></td>
                  <td><%operation.remarks%></td>
                  <td align="right"><%operation.operating_hours | number:2%></td>
                  <td align="right"><%operation.distance_travelled | number:2%></td>
                  <td align="right"><%operation.diesel_consumption | number:2%></td>
                  <td align="right"><%operation.gas_consumption | number:2%></td>
                  <td align="right"><%operation.oil_consumption | number:2%></td>
                  <td align="right"><%operation.number_loads | number:2%></td>
                  <td align="center"> <a href="#"> Edit </a> | <a href="#"> Delete </a> </td>
                </tr>
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
      </div>
    </section>