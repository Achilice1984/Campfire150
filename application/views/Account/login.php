   
<div class="container" style="margin-top:100px;">
    <div class="row">

        <div class="panel panel-default">
            <div class="panel-heading" style="font-size:1.4em; background-color:#3498db; color:white;">
                <?php echo gettext("Login to Campfire 150"); ?>
            </div>
                <div class="panel-body">
                    <div class="col-md-6"> 

                        <form action="<?php echo BASE_URL; ?>account/login" method="post">

                            <?php 
                                //Add error message block to the page
                                include(APP_DIR . 'views/shared/displayErrors.php'); 
                            ?>

                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo gettext("Email address"); ?></label>
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

                            <button type="submit" class="btn btn-default"><?php echo gettext("Submit"); ?></button>
                        </form>

                        <div style="padding-top:10px;">  
                            <?php echo gettext("Not registered yet?"); ?> <a href="<?php echo BASE_URL; ?>account/register"><?php echo gettext("Register Me Now!"); ?></a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>

