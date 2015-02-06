


<div class="container" style="margin-top:100px;">
	<div class="row">

		<div class="panel panel-default">
            <div class="panel-heading" style="font-size:1.4em; background-color:#3498db; color:white;">
  				Your about to register for a pretty cool site!
			</div>
		  		<div class="panel-body">
					<div class="col-md-6"> 

				        <form action="<?php echo BASE_URL; ?>Account/register" method="post">
						<?php
						    $validationResult = $viewModel->getValidationResult();
						    
						    include(APP_DIR . 'views/shared/displayErrors.php');
						?>
				        	<h3>User Details</h3>
				        	<hr />

				            <div class="form-group">
				                <label for="Email">Email address</label>
				                <input type="email" class="form-control" id="Email" name="Email" placeholder="Enter email" value="<?php echo $viewModel->Email; ?>">
				            </div>
				            <div class="form-group">
				                <label for="Password">Password</label>
				                <input type="password" class="form-control" id="Password" name="Password" placeholder="Enter Password">
				            </div>
				            <div class="form-group">
				                <label for="RePassword">Re-Type Password</label>
				                <input type="password" class="form-control" id="RePassword" name="RePassword" placeholder="Re-Type Password">
				            </div>

				            <h3 style="padding-top:10px;">Contact Details</h3>
				            <hr />

				             <div class="form-group">
				                <label for="FirstName">First Name</label>
				                <input type="text" class="form-control" id="FirstName" name="FirstName" placeholder="Enter Your First Name" value="<?php echo $viewModel->FirstName; ?>">
				            </div>
				           <!--  <div class="form-group">
				                <label for="midName">Middle Name</label>
				                <input type="text" class="form-control" id="midName" placeholder="Enter Your Middle Name">
				            </div> -->
				            <div class="form-group">
				                <label for="LastName">Last Name</label>
				                <input type="text" class="form-control" id="LastName" name="LastName" placeholder="Enter Your Last Name" value="<?php echo $viewModel->LastName; ?>">
				            </div>
				            <div class="form-group">
				                <label for="Address">Address</label>
				                <input type="text" class="form-control" id="Address" name="Address" placeholder="Enter Your Address" value="<?php echo $viewModel->Address; ?>">
				            </div>
				            <div class="form-group">
				                <label for="PostalCode">Postal Code</label>
				                <input type="text" class="form-control" id="PostalCode" name="PostalCode" placeholder="Enter Your Postal Code" value="<?php echo $viewModel->PostalCode; ?>">
				            </div>       
				                                       
				            <button style="margin-top:10px;" type="submit" class="btn btn-default">Register</button>
				            <br />
				        </form>
				        <div style="padding-top:15px;"> 
				    		By clicking on 'Register', you confirm that you accept the <a href="<?php echo BASE_URL; ?>home/terms">Terms of Use</a>
				    	</div>
				    </div>
			</div>
		</div>
	</div>
</div>
