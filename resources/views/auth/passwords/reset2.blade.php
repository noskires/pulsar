<br><br><br><br><br>

<div class="container" ng-controller="ResetPasswordCtrl as rp">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" 
                style="-moz-box-shadow: 5px 5px 5px 1px #e6e6e6; -webkit-box-shadow: 5px 5px 5px 1px #e6e6e6; box-shadow: 5px 5px 5px 1px #e6e6e6;">

                <div class="panel-heading">Please nominate a new password</div>
                <div class="panel-body"> 
                    <br>
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Username</label>

                            <div class="col-md-7">
                                <input id="email" type="text" class="form-control" name="email" value="<%rp.form.employee_code%>" readonly>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group" ng-class="{'has-error': rp.response.hasError}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-7">
                                <div class="input-group" id="show_hide_password">
                                    <input id="password" type="password" class="form-control" name="password" ng-model="rp.form.password"  ng-change="rp.clearErrors()" required>
                                        <div class="input-group-addon">
                                            <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                        </div>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group"  ng-class="{'has-error': rp.response.hasError}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-7">
                                <div class="input-group" id="show_hide_password">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" ng-model="rp.form.password_confirmation" ng-change="rp.clearErrors()" required>
                                    <div class="input-group-addon">
                                        <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4"> <% error %> </div>
                            <div class="col-md-7">
                                <div class="small text-red" ng-repeat="error in rp.response.data" ng-if="rp.response.hasError">
                                  <% error %>
                                </div>
                                    
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-11">
                                <button class="btn btn-primary pull-right" ng-click="rp.submit(rp.form)">
                                    Submit
                                </button>

                                 <!-- Button trigger modal -->
                                <button type="button" class="btn btn-light pull-right" data-toggle="modal" data-target="#exampleModal" data-backdrop="static" data-keyboard="false">
                                  <span class="fa fa-question"> </span>  Password Guide
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"><span class="fa fa-question"> </span> Password Guide</h5>

          </div>
          <div class="modal-body">
            <p>
                Password and Confirm Password should match. <br>
                Password should be min 8 characters and max 16 characters. <br>
                Password should contain at least one digit (0123456789). <br>
                Password should contain at least one Capital Letter (A-Z). <br>
                Password should contain at least one special character (!@#$%^&*()_+,./).
            </p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

</div>

<script type="text/javascript">
    $(document).ready(function() {
    $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password input').attr("type") == "text"){
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass( "fa-eye-slash" );
            $('#show_hide_password i').removeClass( "fa-eye" );
        }else if($('#show_hide_password input').attr("type") == "password"){
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass( "fa-eye-slash" );
            $('#show_hide_password i').addClass( "fa-eye" );
        }
    });
});
</script>