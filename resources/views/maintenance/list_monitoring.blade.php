<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><span class="fa fa-cogs"> </span> Maintenance Monitoring</h1>
  <ol class="breadcrumb">
    <li><a href="../../index.html"><i class="fa fa-th"></i> Dashboard</a></li>
    <li class="active">Maintenance</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">

      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Please provide details of the Project</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form">
          <div class="box-body">
            <div class="form-group">
              <div class="col-sm-3">
              <select class="form-control select2" style="width: 100%;" required="">
              <option selected="selected" value="1">Select Project</option>
              <option value="2">LARION ROAD WIDENNING</option>
              <option value="3">Project 3</option>
              <option value="4">Project 4</option>
              <option value="5">Project 5</option>
              </select>
              </div>
              <div class="col-sm-3"> 
              <input type="text" class="form-control" id="location" placeholder="Project Location" disabled>
              </div>
              <div class="col-sm-3"> 
              <div class="input-group">
              <button type="button" class="btn btn-default pull-right" id="daterange-btn">
                <span>
                  <i class="fa fa-calendar"></i> Date range picker
                </span>
                <i class="fa fa-caret-down"></i>
              </button>
              </div>
              </div>  
            </div>
          </div>
          <!-- /.box-body -->
        </form>
      </div>
      <!-- /.box -->
              
    </div>
    </div>
  </section>
<!-- TABLE content -->          
<section class="content">
  <div class="box" id="box-monitoring">
        <div class="box-body">
            <table id="monitoring" class="table table-bordered table-hover">
              <thead style="background-color: #e1e1e1;">
            <tr>
              <th class="tg-7un6" rowspan="3">EQUIPMENT NAME</th>
              <th class="tg-pxng" rowspan="3">PLATE NO.</th>
              <th class="tg-pxng" rowspan="3">TOTAL OPERATING TIME</th>
              <th class="tg-pxng" rowspan="3">TOTAL DISTANCE TRAVELLED</th>
              <th class="tg-pxng" colspan="8">MAINTENANCE STATUS PER CHECKPOINTS BY OPERATING TIME</th>
              <th class="tg-pxng" colspan="4">MAINTENANCE STATUS PER CHECKPOINTS BY DISTANCE TRAVELLED</th>
            </tr>
            <tr>
              <td class="tg-kixb" colspan="2">500</td>
              <td class="tg-kixb" colspan="2">1000</td>
              <td class="tg-kixb" colspan="2">2500</td>
              <td class="tg-kixb" colspan="2">5000</td>
              <td class="tg-kixb" colspan="2">10000</td>
              <td class="tg-kixb" colspan="2">20000</td>
            </tr>
            <tr style="font-size: 10px;">
              <td class="tg-pxng">DATE STARTED</td>
              <td class="tg-pxng">DATE COMPLETED</td>
              <td class="tg-pxng">DATE STARTED</td>
              <td class="tg-pxng">DATE COMPLETED</td>
              <td class="tg-pxng">DATE STARTED</td>
              <td class="tg-pxng">DATE COMPLETED</td>
              <td class="tg-pxng">DATE STARTED</td>
              <td class="tg-pxng">DATE COMPLETED</td>
              <td class="tg-pxng">DATE STARTED</td>
              <td class="tg-pxng">DATE COMPLETED</td>
              <td class="tg-pxng">DATE STARTED</td>
              <td class="tg-pxng">DATE COMPLETED</td>
            </tr>
            </thead>
            <tbody>                
            <tr>
              <td class="tg-kixb">DUMPTRUCK</td>
              <td class="tg-kixb">DT-12345</td>
              <td class="tg-kixb">510</td>
              <td class="tg-kixb"></td>
              <td class="tg-kixb">3/1/2018</td>
              <td class="tg-kixb">3/3/2018</td>
              <td class="tg-kixb"></td>
              <td class="tg-kixb"></td>
              <td class="tg-kixb"></td>
              <td class="tg-kixb"></td>
              <td class="tg-kixb"></td>
              <td class="tg-kixb"></td>
              <td class="tg-kixb"></td>
              <td class="tg-kixb"></td>
              <td class="tg-kixb"></td>
              <td class="tg-kixb"></td>
            </tr>
            <tr>
              <td class="tg-kixb">DUMPTRUCK2</td>
              <td class="tg-kixb">DT-42345</td>
              <td class="tg-kixb">1200</td>
              <td class="tg-kixb"></td>
              <td class="tg-kixb">4/6/2018</td>
              <td class="tg-kixb">4/9/2018</td>
              <td class="tg-kixb">5/1/2018</td>
              <td class="tg-kixb"></td>
              <td class="tg-kixb"></td>
              <td class="tg-kixb"></td>
              <td class="tg-kixb"></td>
              <td class="tg-kixb"></td>
              <td class="tg-kixb"></td>
              <td class="tg-kixb"></td>
              <td class="tg-kixb"></td>
              <td class="tg-kixb"></td>
            </tr>
            <tr>
              <td class="tg-kixb">DUMPTRUCK3</td>
              <td class="tg-kixb">DT-32345</td>
              <td class="tg-kixb">2600</td>
              <td class="tg-kixb"></td>
              <td class="tg-kixb">7/1/2018</td>
              <td class="tg-kixb">7/3/2018</td>
              <td class="tg-kixb">8/4/2018</td>
              <td class="tg-kixb">8/5/2018</td>
              <td class="tg-kixb">9/1/2018</td>
              <td class="tg-kixb"></td>
              <td class="tg-kixb"></td>
              <td class="tg-kixb"></td>
              <td class="tg-kixb"></td>
              <td class="tg-kixb"></td>
              <td class="tg-kixb"></td>
              <td class="tg-kixb"></td>
            </tr> 
            <tr>
              <td class="tg-kixb">DUMPTRUCK4</td>
              <td class="tg-kixb">DT-22345</td>
              <td class="tg-kixb">600</td>
              <td class="tg-kixb"></td>
              <td class="tg-kixb"></td>
              <td class="tg-kixb"></td>
              <td class="tg-kixb"></td>
              <td class="tg-kixb"></td>
              <td class="tg-kixb"></td>
              <td class="tg-kixb"></td>
              <td class="tg-kixb"></td>
              <td class="tg-kixb"></td>
              <td class="tg-kixb"></td>
              <td class="tg-kixb"></td>
              <td class="tg-kixb"></td>
              <td class="tg-kixb"></td>
            </tr>                

            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
  </div>
    <div class="modal fade" id="modal-default">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Equipment Profile</h4>
          </div>
          <div class="modal-body">
            <!-- Custom Tabs (Pulled to the right) -->
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs pull-right">
                <li class="active"><a href="#tab_1-1" data-toggle="tab">Details</a></li>
                <li><a href="#tab_2-2" data-toggle="tab">History</a></li>
                <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    Options <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Edit</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">SAnother action action</a></li>
                    <li role="presentation" class="divider"></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action under</a></li>
                  </ul>
                </li>
                <li class="pull-left header"><i class="fa fa-bus"></i> Dumptruck FGR-254</li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1-1">
                  <b>PHOTO HERE PHOTO HERE.</b><br>
                  <b>TABLE HERE.</b><br>
                  A wonderful serenity has taken possession of my entire soul,
                  like these sweet mornings of spring which I enjoy with my whole heart.
                  I am alone, and feel the charm of existence in this spot,
                  which was created for the bliss of souls like mine. I am so happy,
                  my dear friend, so absorbed in the exquisite sense of mere tranquil existence,
                  that I neglect my talents. I should be incapable of drawing a single stroke
                  at the present moment; and yet I feel that I never was a greater artist than now.
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2-2">
                  <b>How to use:</b><br>
                  <b>TABLE HERE.</b><br>

                  A wonderful serenity has taken possession of my entire soul,
                  like these sweet mornings of spring which I enjoy with my whole heart.
                  I am alone, and feel the charm of existence in this spot,
                  which was created for the bliss of souls like mine. I am so happy,
                  my dear friend, so absorbed in the exquisite sense of mere tranquil existence,
                  that I neglect my talents. I should be incapable of drawing a single stroke
                  at the present moment; and yet I feel that I never was a greater artist than now.
                  A wonderful serenity has taken possession of my entire soul,
                  like these sweet mornings of spring which I enjoy with my whole heart.
                  I am alone, and feel the charm of existence in this spot,
                  which was created for the bliss of souls like mine. I am so happy,
                  my dear friend, so absorbed in the exquisite sense of mere tranquil existence,
                  that I neglect my talents. I should be incapable of drawing a single stroke
                  at the present moment; and yet I feel that I never was a greater artist than now.
                </div>
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div>
            <!-- nav-tabs-custom -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</section>