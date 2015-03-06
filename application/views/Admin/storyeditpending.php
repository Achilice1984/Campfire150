
<?php
	// debugit($storyViewModel);
	// debugit($userViewModel);
	//debugit($aprovalViewModel);
?>
<div class="container">
	
	<h1>Edit pending approval story</h1>
	<div class="row">
  		<div class="col-md-3">
  			<div class="thumbnail">
      			<img src="../../static/images/default-user-image.png" alt="">
  				<h2>Owner Information</h2>
  				<ul>
  					<li>First name</li>
  					<li>Last name</li>
  					<li>Created date</li>
					<li>.....</li>
  				</ul>
  			</div>

  		</div>
  		<div class="col-md-6">
  			<div class="thumbnail">
      			<img src="../../static/images/default_story_image.jpg" alt="">
  				<h2>Story Title</h2>
  				<p>As of May 2014, we've discontinued operation of Bootstrap v2.3.2's Customizer. It's been nearly a year since Bootstrap v2.3.2 was released. Bootstrap v3 was released soon after, and is now mature. We continue to encourage new projects to use Bootstrap v3.
  					As always, you can of course still build Bootstrap v2.3.2 from source yourself. See the Getting started docs and Bootstrap v2.3.2's README for instructions.</p>
  			</div>
  		</div>
	</div>
    <div class="row">
		
		<div class="col-md-9">
			<form action="<?php echo BASE_URL; ?>admin/storyeditpending" method="post" id="loginForm">

				<input type="hidden" name="Id" value="<?php echo $aprovalViewModel->Id; ?>">

	            <?php 
	                //Add error message block to the page
	                include(APP_DIR . 'views/shared/displayErrors.php'); 

	                //Add success message block to the page
	                include(APP_DIR . 'views/shared/displaySuccess.php'); 
	            ?>

	            <div class="checkbox">
	                <label>
	                    <input type="checkbox" name="Approved" value="<?php echo $aprovalViewModel->Approved; ?>"> <?php echo gettext("Approve Story"); ?>
	                </label>
	            </div>
	            <div class="form-group">
	                <label for="Content"><?php echo gettext("Reason"); ?></label>
	                <textarea class="form-control" id="Content" name="Content"><?php echo $aprovalViewModel->Content; ?></textarea>
	            </div>
	            

	            <button type="submit" class="btn btn-default"><?php echo gettext("Submit"); ?></button>
	        </form>
        </div>
    </div>
</div>