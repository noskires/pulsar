<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><span class="fa fa-folder-open"> </span> List of Job Orders</h1>
  <ol class="breadcrumb">
    <li><a href="../../index.html"><i class="fa fa-th"></i> Dashboard</a></li>
    <li class="active">Job Order</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="box">
        <div class="box-body">
          <table id="equipments" class="table table-bordered table-hover">
            <thead>
            <tr>
              <th>Control No.</th>
              <th>Job Order Date</th>
              <th>Request Purpose</th>
              <th>Asset Name</th>
              <th>Asset Tag</th>
              <th>Location</th>
              <th>Requesting Employee</th>
              <th>Date Started</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td><a href="#" data-toggle="modal" data-target="#modal-default"><b>JO-03122018-1</b></a></td>
              <td>03/12/2018</td>
              <td>REPAIRS & MAINTENANCE -CONSTRUCTION EQUIPMENT</td>
              <td>Dumpt Truck</td>
              <td>CONE-03082018-DT1</td>
              <td>Tuguegarao City</td>
              <td>Mykee Caparas</td>
              <td>03/13/2018</td>
            </tr> 
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
  </div>
    <div class="modal fade" id="modal-default">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Job Order No: <b>JO-03122018-1</b></h4>
          </div>
          <div class="modal-body">
            <!-- Custom Tabs (Pulled to the right) -->
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs pull-right">
                <li class="active"><a href="#tab_1-1" data-toggle="tab">Details</a></li>
                <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    Options <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Print</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Close J.O. (Completed)</a></li>
                  </ul>
                </li>
                <li class="pull-left header"><i class="fa fa-bus"></i> Dump Truck: <b>CONE-03082018-DT1</b></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1-1">
                  <div class="pull-left image col-xs-3">
                    <img src="{{URL::to('assets/dist/img/dumptruck.jpg')}}" height="230px" class="img-square">
                  </div>
                  <div class="col-xs-9"> 
      <!-- general form elements -->
        <div class="box-header with-border">
          <h3 class="box-title"></h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" id="">
          <div class="box-body">
            <div class="form-group">
              <label for="jodate" class="col-sm-4 control-label">Job Order Date</label>
              <div class="col-sm-8"><input type="text" class="form-control" id="jodate" disabled="" placeholder="03/12/2018"></div>
            </div>
            <div class="form-group">
              <label for="requestpurpose" class="col-sm-4 control-label">Request Purpose</label>
              <div class="col-sm-8"><input type="text" class="form-control" id="requestpurpose" disabled="" placeholder="REPAIRS & MAINTENANCE -CONSTRUCTION EQUIPMENT"></div>
            </div>
            <div class="form-group">
              <label for="location" class="col-sm-4 control-label">Location</label>
              <div class="col-sm-8"><input type="text" class="form-control" id="location" disabled="" placeholder="Tuguegarao City"></div>
            </div>
            <div class="form-group">
              <label for="requestingemp" class="col-sm-4 control-label">Requesting Employee</label>
              <div class="col-sm-8"><input type="text" class="form-control" id="requestingemp" disabled="" placeholder="Mykee Caparas"></div>
            </div>
            <div class="form-group">
              <label for="particulars" class="col-sm-4 control-label">Particulars</label>
              <div class="col-sm-8"><textarea name="particulars" rows="3" cols="30"></textarea></div></div>
            </div>
            <div class="form-group">
              <label class="col-sm-4 control-label">Date Started</label>
              <div class="col-sm-8">
              <div class="input-group date">
              <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
              <input type="text" class="form-control pull-right" id="datestarted">
            </div></div>
            </div>
            <div class="form-group">
              <label class="col-sm-4 control-label">Date Completed</label>
              <div class="col-sm-8">
              <div class="input-group date">
              <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
              <input type="text" class="form-control pull-right" id="datecompleted">
            </div></div>
            </div>
            <div class="form-group">
              <label for="workduration" class="col-sm-4 control-label">Work Duration</label>
              <div class="col-sm-8"><input type="text" class="form-control" id="workduration" placeholder="Total Days"></div>
            </div>
            <div class="form-group">
            <label class="col-sm-4 control-label">Conducted by</label>
              <div class="col-sm-8">
              <select class="form-control select2" style="width: 100%;" required="">
              <option selected="selected" value="0">- - select employee - -</option>
              <option value="1">Driver 1</option>
              <option value="2">Driver 2</option>
              <option value="3">Driver 3</option>
              </select>
              </div>
            </div>
            <div class="form-group">
              <label for="assessedby" class="col-sm-4 control-label">Assessed by</label>
              <div class="col-sm-8"><input type="text" class="form-control" id="dateassessed" placeholder=""></div>
            </div>
            <div class="form-group">
              <label class="col-sm-4 control-label">Date Assessed</label>
              <div class="col-sm-8">
              <div class="input-group date">
              <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
              <input type="text" class="form-control pull-right" id="datepicker2">
            </div></div>
            </div>
            <div class="form-group">
            <label class="col-sm-4 control-label">Approved by</label>
              <div class="col-sm-8">
              <select class="form-control select2" style="width: 100%;" required="">
              <option selected="selected" value="0">- - select employee - -</option>
              <option value="1">Driver 1</option>
              <option value="2">Driver 2</option>
              <option value="3">Driver 3</option>
              </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-4 control-label">Date Approved</label>
              <div class="col-sm-8">
              <div class="input-group date">
              <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
              <input type="text" class="form-control pull-right" id="datepicker2">
            </div></div>
            </div>
            <div class="form-group">
            <label class="col-sm-4 control-label">Inspected by</label>
              <div class="col-sm-8">
              <select class="form-control select2" style="width: 100%;" required="">
              <option selected="selected" value="0">- - select employee - -</option>
              <option value="1">Driver 1</option>
              <option value="2">Driver 2</option>
              <option value="3">Driver 3</option>
              </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-4 control-label">Date Inspected</label>
              <div class="col-sm-8">
              <div class="input-group date">
              <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
              <input type="text" class="form-control pull-right" id="dateinspected">
            </div></div>
            </div>
            <div class="form-group">
            <label class="col-sm-4 control-label">Tested by</label>
              <div class="col-sm-8">
              <select class="form-control select2" style="width: 100%;" required="">
              <option selected="selected" value="0">- - select employee - -</option>
              <option value="1">Driver 1</option>
              <option value="2">Driver 2</option>
              <option value="3">Driver 3</option>
              <option value="4">Driver 4</option>
              <option value="5">Driver 5</option>
              <option value="6">Driver 6</option>
              </select>
              </div>
            </div>
            <div class="form-group">
            <label class="col-sm-4 control-label">Accepted by</label>
              <div class="col-sm-8">
              <select class="form-control select2" style="width: 100%;" required="">
              <option selected="selected" value="0">- - select employee - -</option>
              <option value="1">Driver 1</option>
              <option value="2">Driver 2</option>
              <option value="3">Driver 3</option>
              <option value="4">Driver 4</option>
              <option value="5">Driver 5</option>
              <option value="6">Driver 6</option>
              </select>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <div class="pull-right"></div>
            <button class="btn btn-sm btn-primary pull-right" data-toggle="confirmation"
            data-btn-ok-label="Save" data-btn-ok-icon="fa fa-check" data-btn-ok-class="btn-success"
            data-btn-cancel-label="Cancel" data-btn-cancel-icon="fa fa-times" data-btn-cancel-class="btn-danger"
            data-title="Comfirmation" data-content="Are you sure?"> Confirmation </button>
          </div>
        </form>
      <!-- /.box -->


              </div>
              <!-- /.tab-content -->
            </div>
            <!-- nav-tabs-custom -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-info"><li class="fa fa-print"></li> Print</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

</section>