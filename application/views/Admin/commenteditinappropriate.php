
<?php
<<<<<<< HEAD
	debugit($storyViewModel);
	debugit($userViewModel);
	debugit($approvalViewModel);
=======
		debugit($storyViewModel);
		ebugit($userViewModel);
		debugit($aprovalViewModel);
>>>>>>> master
?>
<div class="container" style="margin-top:100px;">

	<h1><?php echo gettext(">Edit inappropriate comment"); ?></h1>
    <div class="row">
  		<div class="col-md-3">
  			<div class="thumbnail">
      			<img src="../../static/images/default-user-image.png" alt="">
  				<h2><?php echo gettext("Owner Information"); ?></h2>
  				<ul>
  					<li><?php echo $userViewModel->FirstName ?></li>
  					<li><?php echo $userViewModel->LastName ?></li>
  					<li><?php echo $userViewModel->ActionStatement ?></li>
					<li>.....</li>
  				</ul>
  			</div>

  		</div>
  		<div class="col-md-6">
  			<div class="thumbnail">
      			<img src="../../static/images/default_story_image.jpg" alt="">
  				<h2><?php echo $storyViewModel->StoryTitle ?></h2>
  					<div class="thumbnail">
						<h3><?php echo gettext("Comment"); ?></h3>
  						<p><?php echo $storyViewModel->Content ?></p>
  					</div>
  			</div>
  		</div>
	</div>
    <div class="row">
		
		<div class="col-md-9">
			<form action="<?php echo BASE_URL; ?>admin/commenteditinappropriate" method="post" id="editForm">

<<<<<<< HEAD
		<div class="col-md-6">
			<form action="<?php echo BASE_URL; ?>account/login" method="post" id="loginForm">

				<input type="hidden" name="Id" value="<?php echo $approvalViewModel->Id; ?>">

	            <?php 
	                //Add error message block to the page
	                include(APP_DIR . 'views/shared/displayErrors.php'); 

	                //Add success message block to the page
	                include(APP_DIR . 'views/shared/displaySuccess.php'); 
	            ?>
=======
				<input type="hidden" name="Id" value="<?php echo $approvalViewModel->Id; ?>">
>>>>>>> master

	            <?php include(APP_DIR . 'views/shared/messages.php'); ?>
	            
	            <div class="checkbox">
	                <label>
<<<<<<< HEAD
	                    <input type="checkbox" name="Approved" value="<?php echo $approvalViewModel->Approved; ?>"> <?php echo gettext("Approve Story"); ?>
	                </label>
	            </div>
	            <div class="form-group">
	                <label for="Content"><?php echo gettext("Response"); ?></label>
	                <textarea class="form-control" id="Password" name="Password"><?php echo $approvalViewModel->Content; ?></textarea>
=======
	                    <input type="checkbox" name="Approved" value="<?php echo $aprovalViewModel->Approved; ?>"> <?php echo gettext("Approve Comment"); ?>
	                </label>
	            </div>
	            <div class="form-group">
	                <label for="Content"><?php echo gettext("Reason"); ?></label>
	                <textarea class="form-control" id="Content" name="Content"><?php echo $aprovalViewModel->Content; ?></textarea>
>>>>>>> master
	            </div>
	            

	            <button type="submit" class="btn btn-default"><?php echo gettext("Submit"); ?></button>
	        </form>
        </div>
    </div>
</div>