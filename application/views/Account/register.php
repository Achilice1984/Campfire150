
<div class="container" style="margin-top:100px;">
	<div class="row">

		<div class="panel panel-default">
            <div class="panel-heading" style="font-size:1.4em; background-color:#3498db; color:white;">
  				<?php echo gettext("Your about to register for Campfire 150"); ?>
			</div>
		  		<div class="panel-body">
					<div class="col-md-6"> 

				        <form action="<?php echo BASE_URL; ?>account/register" method="post">
							<?php 
                                //Add error message block to the page
                                include(APP_DIR . 'views/shared/displayErrors.php'); 
                            ?>

				        	<h3><?php echo gettext("User Details"); ?></h3>
				        	<hr />

				            <div class="form-group">
				                <label for="Email"><?php echo gettext("Email address"); ?></label>
				                <input type="email" class="form-control" id="Email" name="Email" placeholder="<?php echo gettext("Enter Email"); ?>" value="<?php echo $userViewModel->Email; ?>">
				            </div>
				            <div class="form-group">
				                <label for="Password"><?php echo gettext("Password"); ?></label>
				                <input type="password" class="form-control" id="Password" name="Password" placeholder="<?php echo gettext("Enter Password"); ?>">
				            </div>
				            <div class="form-group">
				                <label for="RePassword"><?php echo gettext("Re-Type Password"); ?></label>
				                <input type="password" class="form-control" id="RePassword" name="RePassword" placeholder="<?php echo gettext("Re-Type Password"); ?>">
				            </div>

				            <h3 style="padding-top:10px;"><?php echo gettext("Contact Details"); ?></h3>
				            <hr />

				             <div class="form-group">
				                <label for="FirstName"><?php echo gettext("First Name"); ?></label>
				                <input type="text" class="form-control" id="FirstName" name="FirstName" placeholder="<?php echo gettext("Enter Your First Name"); ?>" value="<?php echo $userViewModel->FirstName; ?>">
				            </div>
				           <!--  <div class="form-group">
				                <label for="midName">Middle Name</label>
				                <input type="text" class="form-control" id="midName" placeholder="Enter Your Middle Name">
				            </div> -->
				            <div class="form-group">
				                <label for="LastName"><?php echo gettext("Last Name"); ?></label>
				                <input type="text" class="form-control" id="LastName" name="LastName" placeholder="<?php echo gettext("Enter Your Last Name"); ?>" value="<?php echo $userViewModel->LastName; ?>">
				            </div>
				            <div class="form-group">
				                <label for="Address"><?php echo gettext("Address"); ?></label>
				                <input type="text" class="form-control" id="Address" name="Address" placeholder="<?php echo gettext("Enter Your Address"); ?>" value="<?php echo $userViewModel->Address; ?>">
				            </div>
				            <div class="form-group">
				                <label for="PostalCode"><?php echo gettext("Postal Code"); ?></label>
				                <input type="text" class="form-control" id="PostalCode" name="PostalCode" placeholder="<?php echo gettext("Enter Your Postal Code"); ?>" value="<?php echo $userViewModel->PostalCode; ?>">
				            </div>       
				                                       
				            <button style="margin-top:10px;" type="submit" class="btn btn-default"><?php echo gettext("Register"); ?></button>
				            <br />
				        </form>
				        <!-- <div style="padding-top:15px;"> 
				    		By clicking on 'Register', you confirm that you accept the <a href="<?php echo BASE_URL; ?>home/terms">Terms of Use</a>
				    	</div> -->
				    </div>
			</div>
		</div>
	</div>
</div>
