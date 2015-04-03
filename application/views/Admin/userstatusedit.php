<div class="container">
	
	<h1><?php echo gettext("Edit User Status"); ?></h1>
	<div class="row">
  		<div class="col-md-3">
  			<div class="thumbnail">
      			<img class="img-rounded" src="../../static/images/default-user-image.png" alt="">
  				<h2><?php echo gettext("Owner Information"); ?></h2>
  				<ul>
  					<li><?php echo $userViewModel->FirstName ?></li>
  					<li><?php echo $userViewModel->LastName ?></li>
  					<li><?php echo $userViewModel->ActionStatement ?></li>
  					<?php
	            		if($userViewModel->AdminFlag)
	            			print '<li>Administrator</li>';
	            		else
	            			print '<li>Regular User</li>';
	            	?>
					<li>.....</li>
  				</ul>
  			</div>

  		</div>
  		<div class="col-md-6">
  			<div class="thumbnail">
      			<img src="../../static/images/default_story_image.jpg" alt=""><br/>
 				<h2>More user information click <a href= "<?php echo BASE_URL . 'account/profile/' . $activeViewModel->Id; ?>"> here </a> </h2> 				
  			</div>
  		</div>
	</div>
    <div class="row">
		
		<div class="col-md-9">
			<form action="<?php echo BASE_URL . 'admin/userstatusedit/' . $userViewModel->UserId; ?>" method="post" id="editForm">

				<input type="hidden" name="Id" value="<?php echo $activeViewModel->Id; ?>">

	            <?php include(APP_DIR . 'views/shared/messages.php'); ?>

	            <div class="radio">
	                <label>
	                    <input type="radio" name="Active" value='TRUE'> <?php echo gettext("Active this user"); ?>
	                </label>
	                <label>
	                    <input type="radio" name="Active" value='FALSE'> <?php echo gettext("Deactive this user"); ?>
	                </label>
	              
	            </div>

	            <div class="form-group">
	                <label for="Reason"><?php echo gettext("Reason"); ?></label>
	               <textarea class="form-control" id="Reason" name="Reason" value="<?php echo $activeViewModel->Reason; ?>"></textarea>
	            </div>
	            

	            <button type="submit" class="btn btn-default"><?php echo gettext("Submit"); ?></button>

	            <div class="row">
			    	<hr style="border:2; height:2px; width:85%; color:#333; weight:2em;"/>

			        <div style="color:red">
			            <div class="form-group">
			            	<?php echo gettext("<h3> CAUTION! </h3>Following Action is opotional. 
			            						<br/>But if you checked and confirmed this Action,
			            						<br/>it may put your website into risk! <br/><br/>"
			            						); 
			            	?>

			                <div class="radio">
				                <label>
				                    <input type="radio" name="Flag" value='TRUE' > <?php echo gettext("Administrator"); ?>
				                </label>
				                <label>
				                    <input type="radio" name="Flag" value='FALSE'> <?php echo gettext("Regular User"); ?>
				                </label>
				              
				            </div>
			            </div>
			            <button type="submit" name="btnDeactive" class="btn btn-default"><?php echo gettext("Confirm"); ?></button>
			        </div>
			    </div>
	        </form>
        </div>
    </div>
</div>