<?php

    //You have access to the Account/LoginViewModel.php
    
    //You can access everything from this variable:
    //uncomment to view structure in browser
    //debugit($loginViewModel);

?>

<div id="forgotPasswordModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
        <form id="forgotPasswordForm" action="<?php echo BASE_URL; ?>account/sendPasswordReset" method="post">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?php echo gettext("Forgot Password"); ?></h4>
              </div>
              <div class="modal-body">

                <h2><?php echo gettext("Forgot your password?"); ?></h2>

                <p style="font-size: 1.2em;"><?php echo gettext("Don't worry! Give us your email and we will reset your password."); ?></p>                
                
                <div style="padding-top: 25px;" class="form-group">
                    <div class="alert alert-success alert-dismissible" role="alert" id="ResetMessage" style="display: none;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong><?php echo gettext("Success!"); ?></strong> <?php echo gettext("Check your email for your reset password!"); ?>
                    </div>
                    <input type="email" class="form-control" id="ResetEmail" name="ResetEmail" placeholder="<?php echo gettext("Enter Email"); ?>" value="">
                </div>
               
              </div>
              <div class="modal-footer">
                <div class="form-group" style="">   

                    <button id="RestPasswordButton" class="btn btn-primary"><?php echo gettext("Reset Password"); ?></button>
                    <div style="float: right; margin-left:10px" id="RestPasswordSpinerDiv">
                        <?php include(APP_DIR . 'views/shared/_spinner_small.php'); ?>
                    </div>
                    
                  </div>          
              </div>
        </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="container" style="padding-top: 50px; padding-bottom: 50px;">
    <div class="row">

        <div class="panel panel-default">
            <div class="panel-heading" style="font-size:1.4em; background-color:#337ab7; color:white;">
                <?php echo gettext("Login to Campfire 150"); ?>
            </div>
            <div class="panel-body">
                <div class="col-md-6"> 

                    <form action="<?php echo BASE_URL; ?>account/login" method="post" id="loginForm">

                        <?php include(APP_DIR . 'views/shared/messages.php'); ?>

                        <div class="form-group">
                            <label for="Email"><?php echo gettext("Email address"); ?></label>
                            <input type="Email" class="form-control" id="Email" name="Email" placeholder="<?php echo gettext("Enter Email"); ?>" value="<?php echo $loginViewModel->Email; ?>">
                        </div>
                        <div class="form-group">
                            <label for="Password"><?php echo gettext("Password"); ?></label>
                            <input type="password" class="form-control" id="Password" name="Password" placeholder="<?php echo gettext("Password"); ?>">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="RememberMe" value="<?php echo $loginViewModel->RememberMe; ?>"> <?php echo gettext("Remember Me"); ?>
                            </label>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-2">
                                <button style="margin-bottom: 5px;" type="submit" class="btn btn-default"><?php echo gettext("Login"); ?></button>
                            </div>
                            <div class="col-md-6">
                                <a class="btn btn-warning" href="#"  data-toggle="modal" data-target="#forgotPasswordModal"><?php echo gettext("Forgot your password?"); ?></a>
                            </div>
                        </div>
                    </form>

                    <div style="padding-top:25px;">  
                        <?php echo gettext("Not registered yet?"); ?> <a href="<?php echo BASE_URL; ?>account/register"><?php echo gettext("Register Me Now!"); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>