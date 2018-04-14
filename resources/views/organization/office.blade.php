<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><span class="fa fa-building"> </span> Office Locations</h1>
  <p>Manage Departments, Divisions and Units. Each office may have a specific location.</p>
  <ol class="breadcrumb">
    <li><a href="../../index.html"><i class="fa fa-th"></i> Dashboard</a></li>
    <li><i class="fa fa-cloud"></i> Advanced</li>
    <li class="active"><i class="fa fa-building"></i> Office Locations</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12"> 
      <div id="add-department" class="collapse department">
        <div class="panel panel-default">
          <div class="panel-body">
<!-- NEW DEPARTMENT -->
            <form id="from-department" class="form-inline" role="form">
              <div class="form-group">
                <label style="margin-right:15px;" for="dept-name">Department Name:</label>
                <input type="text" class="form-control" id="dept-name" size="125" required="">
              </div><!-- form group -->
                <div class="form-group col-sm-12">
                  <hr style="border-color:#e1e1e1;border-width:1px 0;">
                  <h4>Department Address:</h4><br>
                </div>
                <div class="form-group col-sm-12">
                  <label class="col-sm-1 control-label">Region</label>
                  <div class="col-sm-4">
                  <select class="form-control select2" style="width: 100%;" required="">
                  <option selected="selected" value="1">Region II</option>
                  <option value="2">Region I</option>
                  <option value="3">Region III</option>
                  </select>
                  </div>
                  <label class="col-sm-1 control-label">Province</label>
                  <div class="col-sm-3">
                  <select class="form-control select2" style="width: 100%;" required="">
                  <option selected="selected" value="1">Cagayan</option>
                  <option value="2">Isabela</option>
                  <option value="3">Vizcaya</option>
                  <option value="4">Batanes</option>
                  <option value="5">Quirino</option>
                  </select>
                  </div>
                  <div class="col-sm-1"><input type="text" class="form-control" id="dept-zipcode" placeholder="Zip Code" disabled required=""></div>
                </div>
                <div class="form-group col-sm-12">
                  <label class="col-sm-1 control-label">Municipality</label>
                  <div class="col-sm-4">
                  <select class="form-control select2" style="width: 100%;" required="">
                  <option selected="selected" value="1">Tuguegarao City</option>
                  <option value="2">Iguig</option>
                  <option value="3">Solana</option>
                  <option value="4">Enrile</option>
                  <option value="5">Peñablanca</option>
                  <option value="6">Gonzaga</option>
                  <option value="7">Sta. Ana</option>
                  </select>
                  </div>
                  <label class="col-sm-1 control-label">Barangay</label>
                  <div class="col-sm-3">
                  <select class="form-control select2" style="width: 100%;" required="">
                  <option selected="selected" value="1">Ugac Norte</option>
                  <option value="2">Caritan</option>
                  <option value="3">Pallua</option>
                  </select>
                  </div>
                </div>
                <div class="form-group col-sm-12">
                  <label for="zipcode" class="col-sm-1 control-label">St/Bldg/Unit</label>
                  <div class="col-sm-4"><input type="text" class="form-control" id="dept-street" style="width: 100%;" required=""></div>
                  <div class="col-sm-1"> </div>
                  <div class="col-sm-3">
                  <hr style="border-color:#e1e1e1;border-width:1px 0;">
                  <button class="btn btn-large btn-success btn-block" data-toggle="confirmation"
                  data-btn-ok-label="Save" data-btn-ok-icon="fa fa-check" data-btn-ok-class="btn-success"
                  data-btn-cancel-label="Cancel" data-btn-cancel-icon="fa fa-times" data-btn-cancel-class="btn-danger"
                  data-title="Confirm data entry." data-content="Are you sure?"> CONFIRMATION
                  </button>
                </div>
                </div>
            </form>
          </div>
        </div>
      </div>
<!-- NEW DIVISION -->
      <div id="add-division" class="collapse division">
        <div class="panel panel-default">
          <div class="panel-body">
            <form id="from-division" class="form-inline" role="form">
              <div class="form-group">
                <div class="col-sm-4">
                <label style="margin-right:15px;" for="dept-name">Department Name:</label>
                <select class="form-control select2" style="width: 100%;" required="">
                <option selected="selected" value="">Select Department</option>
                <option value="1">Pulsar</option>
                <option value="2">JJE Construction</option>
                </select>
                </div>
                <div class="col-sm-8">
                <label style="margin-right:15px;" for="division-name">Division Name:</label> <br>
                <input type="text" class="form-control" id="division-name" size="92" required="">
                </div>
              </div>
              <div class="form-group col-sm-12">
                <hr style="border-color:#e1e1e1;border-width:1px 0;">
                <h4>Division Address:</h4><br>
              </div>
              <div class="form-group col-sm-12">
                <label class="col-sm-1 control-label">Region</label>
                <div class="col-sm-4">
                <select class="form-control select2" style="width: 100%;" required="">
                <option selected="selected" value="1">Region II</option>
                <option value="2">Region I</option>
                <option value="3">Region III</option>
                </select>
                </div>
                <label class="col-sm-1 control-label">Province</label>
                <div class="col-sm-3">
                <select class="form-control select2" style="width: 100%;" required="">
                <option selected="selected" value="1">Cagayan</option>
                <option value="2">Isabela</option>
                <option value="3">Vizcaya</option>
                <option value="4">Batanes</option>
                <option value="5">Quirino</option>
                </select>
                </div>
                <div class="col-sm-1"><input type="text" class="form-control" id="division-zipcode" placeholder="Zip Code" disabled required=""></div>
              </div>
              <div class="form-group col-sm-12">
                <label class="col-sm-1 control-label">Municipality</label>
                <div class="col-sm-4">
                <select class="form-control select2" style="width: 100%;" required="">
                <option selected="selected" value="1">Tuguegarao City</option>
                <option value="2">Iguig</option>
                <option value="3">Solana</option>
                <option value="4">Enrile</option>
                <option value="5">Peñablanca</option>
                <option value="6">Gonzaga</option>
                <option value="7">Sta. Ana</option>
                </select>
                </div>
                <label class="col-sm-1 control-label">Barangay</label>
                <div class="col-sm-3">
                <select class="form-control select2" style="width: 100%;" required="">
                <option selected="selected" value="1">Ugac Norte</option>
                <option value="2">Caritan</option>
                <option value="3">Pallua</option>
                </select>
                </div>
              </div>
              <div class="form-group col-sm-12">
                <label for="zipcode" class="col-sm-1 control-label">St/Bldg/Unit</label>
                <div class="col-sm-4"><input type="text" class="form-control" id="division-street" style="width: 100%;" required=""></div>
                <div class="col-sm-1"> </div>
                <div class="col-sm-3">
                <hr style="border-color:#e1e1e1;border-width:1px 0;">
                <button class="btn btn-large btn-success btn-block" data-toggle="confirmation"
                data-btn-ok-label="Save" data-btn-ok-icon="fa fa-check" data-btn-ok-class="btn-success"
                data-btn-cancel-label="Cancel" data-btn-cancel-icon="fa fa-times" data-btn-cancel-class="btn-danger"
                data-title="Confirm data entry." data-content="Are you sure?"> CONFIRMATION
                </button>
              </div>
              </div>
            </form>
          </div>
        </div>
      </div>
<!-- NEW UNIT -->
      <div id="add-unit" class="collapse unit">
        <div class="panel panel-default">
          <div class="panel-body">
            <form id="from-unit" class="form-inline" role="form">
              <div class="form-group">
                <div class="col-sm-4">
                <label style="margin-right:15px;" for="dept-name">Department Name:</label>
                <select class="form-control select2" style="width: 100%;" required="">
                <option selected="selected" value="">Select Department</option>
                <option value="1">Pulsar</option>
                <option value="2">JJE Construction</option>
                </select>
                </div>
                <div class="col-sm-4">
                <label style="margin-right:15px;" for="division-name">Division Name:</label> <br>
                <select class="form-control select2" style="width: 100%;" required="">
                <option selected="selected" value="">Select Division</option>
                <option value="1">Engineering</option>
                <option value="2">General Services</option>
                </select>
                </div>
                <div class="col-sm-4">
                <label style="margin-right:15px;" for="division-name">Unit Name:</label> <br>
                <input type="text" class="form-control" id="division-name" size="51" required="">
                </div>
              </div>
              <div class="form-group col-sm-12">
                <hr style="border-color:#e1e1e1;border-width:1px 0;">
                <h4>Unit Address:</h4><br>
              </div>
              <div class="form-group col-sm-12">
                <label class="col-sm-1 control-label">Region</label>
                <div class="col-sm-4">
                <select class="form-control select2" style="width: 100%;" required="">
                <option selected="selected" value="1">Region II</option>
                <option value="2">Region I</option>
                <option value="3">Region III</option>
                </select>
                </div>
                <label class="col-sm-1 control-label">Province</label>
                <div class="col-sm-3">
                <select class="form-control select2" style="width: 100%;" required="">
                <option selected="selected" value="1">Cagayan</option>
                <option value="2">Isabela</option>
                <option value="3">Vizcaya</option>
                <option value="4">Batanes</option>
                <option value="5">Quirino</option>
                </select>
                </div>
                <div class="col-sm-1"><input type="text" class="form-control" id="unit-zipcode" placeholder="Zip Code" disabled required=""></div>
              </div>
              <div class="form-group col-sm-12">
                <label class="col-sm-1 control-label">Municipality</label>
                <div class="col-sm-4">
                <select class="form-control select2" style="width: 100%;" required="">
                <option selected="selected" value="1">Tuguegarao City</option>
                <option value="2">Iguig</option>
                <option value="3">Solana</option>
                <option value="4">Enrile</option>
                <option value="5">Peñablanca</option>
                <option value="6">Gonzaga</option>
                <option value="7">Sta. Ana</option>
                </select>
                </div>
                <label class="col-sm-1 control-label">Barangay</label>
                <div class="col-sm-3">
                <select class="form-control select2" style="width: 100%;" required="">
                <option selected="selected" value="1">Ugac Norte</option>
                <option value="2">Caritan</option>
                <option value="3">Pallua</option>
                </select>
                </div>
              </div>
              <div class="form-group col-sm-12">
                <label for="zipcode" class="col-sm-1 control-label">St/Bldg/Unit</label>
                <div class="col-sm-4"><input type="text" class="form-control" id="unit-street" style="width: 100%;" required=""></div>
                <div class="col-sm-1"> </div>
                <div class="col-sm-3">
                <hr style="border-color:#e1e1e1;border-width:1px 0;">
                <button class="btn btn-large btn-success btn-block" data-toggle="confirmation"
                data-btn-ok-label="Save" data-btn-ok-icon="fa fa-check" data-btn-ok-class="btn-success"
                data-btn-cancel-label="Cancel" data-btn-cancel-icon="fa fa-times" data-btn-cancel-class="btn-danger"
                data-title="Confirm data entry." data-content="Are you sure?"> CONFIRMATION
                </button>
              </div>
              </div>
            </form>
          </div>
        </div>
      </div>
<!-- BUTTONS -->
      <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#add-department">
          <span class="glyphicon glyphicon-plus"></span> New Department
      </button> &nbsp;
      <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#add-division">
          <span class="glyphicon glyphicon-plus"></span> New Division
      </button> &nbsp;
      <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#add-unit">
          <span class="glyphicon glyphicon-plus"></span> New Unit
      </button>
    </div>
  </div><br>  
<!-- TABLES -->
  <div class="row">
    <div class="col-md-6"> 
<h4><b>Units Table</b></h4>
      <div class="box box-primary">
        <div class="box-body">
          <table id="employees" class="table table-bordered table-hover" width="100%">
            <thead>
            <tr>
              <th>Department</th>
              <th>Division</th>
              <th>Unit</th>
              <th>Address</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td>Pulsar</td>
              <td>Engineering</td>
              <td><a href="#" data-toggle="modal" data-target="#modal-default"><b>Construction</b></a></td>
              <td>Centro, Penablanca, Cagayan</td>
            </tr>
            <tr>
              <td>Pulsar</td>
              <td>General Services</td>
              <td><a href="#" data-toggle="modal" data-target="#modal-default"><b>Accounting</b></a></td>
              <td>123, Cabbo, Penablanca, Cagayan</td>
            </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-6"> 
<h4><b>Divisions Table</b></h4>
      <div class="box box-primary">
        <div class="box-body">
          <table id="employees" class="table table-bordered table-hover" width="100%">
            <thead>
            <tr>
              <th>Department</th>
              <th>Division</th>
              <th>Address</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td>Pulsar</td>
              <td><a href="#" data-toggle="modal" data-target="#modal-default"><b>Engineering</b></a></td>
              <td>Centro, Penablanca, Cagayan</td>
            </tr>
            <tr>
              <td>Pulsar</td>
              <td><a href="#" data-toggle="modal" data-target="#modal-default"><b>Accounting</b></a></td>
              <td>123, Cabbo, Penablanca, Cagayan</td>
            </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-6"> 
<h4><b>Departments Table</b></h4>
      <div class="box box-primary">
        <div class="box-body">
          <table id="employees" class="table table-bordered table-hover" width="100%">
            <thead>
            <tr>
              <th>Department</th>
              <th>Address</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <td><a href="#" data-toggle="modal" data-target="#modal-default"><b>Pulsar</b></a></td>
              <td>123, Cabbo, Penablanca, Cagayan</td>
            </tr>
            <tr>
              <td><a href="#" data-toggle="modal" data-target="#modal-default"><b>JJE Construction</b></a></td>
              <td>444, guig, Cagayan</td>
            </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>