   
<div class="container" style="margin-top:100px;">
    <div class="row">

        <div class="panel panel-default">
            <div class="panel-heading" style="font-size:1.4em; background-color:#3498db; color:white;">
                Login to Ecodevs!
            </div>
                <div class="panel-body">
                    <div class="col-md-6"> 

                        <form action="<?php echo BASE_URL; ?>account/login" method="post">
                            <?php
                                $validationResult = $viewModel->getValidationResult();
                                
                                include(APP_DIR . 'views/shared/displayErrors.php');
                            ?>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="Email" class="form-control" id="Email" name="Email" placeholder="Enter email" value="<?php echo $viewModel->Email; ?>">
                            </div>
                            <div class="form-group">
                                <label for="Password">Password</label>
                                <input type="password" class="form-control" id="Password" name="Password" placeholder="Password">
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="RememberMe"> Remember Me
                                </label>
                            </div>

                            <button type="submit" class="btn btn-default">Submit</button>
                        </form>

                        <div style="padding-top:5px;">                            
                            Not registered yet? click <a href="<?php echo BASE_URL; ?>account/register">here</a> to register!
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>

