
<?php
//		debugit($storyViewModel);
		debugit($userViewModel);
		debugit($aprovalViewModel);
?>
<div class="container">

    <h1><?php echo gettext("Edit inappropriate story"); ?></h1>
	<div class="row">
  		<div class="col-md-3">
  			<div class="thumbnail">
      			<img class="img-rounded" src="../../static/images/default-user-image.png" alt="">
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
  				<p><?php echo $storyViewModel->Content ?></p>
  			</div>
  		</div>
	</div>
    <div class="row">
		
		<div class="col-md-9">
			<form action="<?php echo BASE_URL; ?>admin/storyeditinappropriate" method="post" id="editForm">

				<input type="hidden" name="Id" value="<?php echo $approvalViewModel->Id; ?>">

	            <?php include(APP_DIR . 'views/shared/messages.php'); ?>

	            <div class="checkbox">
	                <label>
	                    <input type="checkbox" name="Approved" value="TRUE"> <?php echo gettext("Approve Story"); ?>
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