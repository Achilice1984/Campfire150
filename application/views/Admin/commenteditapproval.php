
<div class="container" style="margin-top:100px;">

	<h1><?php echo gettext("Edit Comment Status"); ?></h1>
    <div class="row">
  		<div class="col-md-3">
  			<div class="thumbnail">
  				<div id="profileImageContainer" style="position: relative;  max-width: 100%; width: 200px; height: 200px;">
		    		<div id="profileImageChange" class="profileContent" style="display:none; cursor: pointer; position: absolute;  width: 200px; height: 200px; opacity:0.6; background-color: black; text-align: center; ">
		    			<span style="top: 50%; bottom:50%; font-size: 2em; max-height: 100px;" class="glyphicon glyphicon-camera text-primary"></span>	  				
					</div>
					<img style="width: 200px; height: 200px;" id="profilePicture" class="img-thumbnail img-responsive" src="<?php echo isset($userViewModel->profilePictureURL) ? $userViewModel->profilePictureURL : BASE_URL . "static/images/default-user-image.png"; ?>" alt="<?php echo gettext("Profile Picture"); ?>">
				</div>
      			<br />
  				<ul>
  					<li><?php echo gettext("First Name: ") . $userViewModel->FirstName ?></li>
  					<li><?php echo gettext("Last Name: ") . $userViewModel->LastName ?></li>
  					<li><?php echo gettext("Action Statement: ") . $userViewModel->ActionStatement ?></li>
					<li>... ...</li>

  				</ul>
  			</div>

  		</div>
  		<div class="col-md-6">
  			<div class="thumbnail">
      			<img style="width: 1200px;" class="img-responsive img-rounded" src="<?php echo image_get_path_basic($userViewModel->UserId, $storyViewModel->PictureId, IMG_STORY, (IS_MOBILE ? IMG_MEDIUM : IMG_LARGE)); ?>" alt="<?php echo gettext('Story Picture'); ?>" />
  				<h2><?php echo $storyViewModel->StoryTitle ?></h2>
  					<div class="thumbnail">
  						<p><?php echo $storyViewModel->Content ?></p>
						<h3><?php echo gettext("Comment"); ?></h3>
  						<p><?php echo $commentViewModel->Content ?></p>
  					</div>
  			</div>
  		</div>
	</div>
    <div class="row">
		
		<div class="col-md-9">
			<form action="<?php echo BASE_URL . 'admin/commenteditapproval/' . $commentViewModel->CommentId; ?>" method="post" id="editForm">
				<input type="hidden" name="Id" value="<?php echo $approvalViewModel->Id; ?>">

	            <?php include(APP_DIR . 'views/shared/messages.php'); ?>
	            
	            <div class="radio">
	                <label>
	                    <input type="radio" name="Approval" value='TRUE'> <?php echo gettext("Approve Comment"); ?>
	                </label>
	                <label>
	                    <input type="radio" name="Approval" value='FALSE'> <?php echo gettext("Reject Comment"); ?>
	                </label>
	              
	            </div>

	            <div class="form-group">
	                <label for="Content"><?php echo gettext("Reason"); ?></label>
	                <textarea class="form-control" id="Content" name="Content"><?php echo $approvalViewModel->Content; ?></textarea>

	            </div>
	            

	            <button type="submit" class="btn btn-default"><?php echo gettext("Submit"); ?></button>
	        </form>
        </div>
    </div>
</div>