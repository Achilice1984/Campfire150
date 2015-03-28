<?php

    //You have access to the Account/LoginViewModel.php
    
    //You can access everything from this variable:
    //uncomment to view structure in browser
    //debugit($loginViewModel);

?>


<div class="container" style="padding-top: 50px; padding-bottom: 50px;">
    <div class="row">

        <div class="panel panel-default">
            <div class="panel-heading" style="font-size:1.4em; background-color:#337ab7; color:white;">
                <?php echo gettext("Reset your password"); ?>
            </div>
            <div class="panel-body">
                <div class="col-md-6"> 

                    <form action="<?php echo BASE_URL; ?>account/resetPassword" method="post" id="resetForm">

                        <?php include(APP_DIR . 'views/shared/messages.php'); ?>

                        <input type="hidden" name="Email" id="Email" value="<?php echo $email; ?>">
                        <input type="hidden" name="Hash" id="Hash" value="<?php echo $hash; ?>">

                        <div class="form-group">
                            <label for="Password"><?php echo gettext("Password"); ?></label>
                            <input type="password" class="form-control" id="Password" name="Password" placeholder="<?php echo gettext("Password"); ?>">
                        </div>

                        <div class="form-group">
                            <label for="RePassword"><?php echo gettext("Password"); ?></label>
                            <input type="password" class="form-control" id="RePassword" name="RePassword" placeholder="<?php echo gettext("Re-Type Password"); ?>">
                        </div>
                        
                        <div class="row">
                            <div class="col-md-2">
                                <button style="margin-bottom: 5px;" type="submit" class="btn btn-default"><?php echo gettext("Change Password"); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>