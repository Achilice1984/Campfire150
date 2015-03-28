
<div class="commentDiv">
	<div class="row StoryRowSection" style="padding:0px; padding-top: 10px;">
	 	<div class="col-md-2 hidden-sm hidden-xs">
			<div class="row">
				<a href="<?php echo BASE_URL . "account/home/" . $comment->commenterUserId; ?>">
	  				<img style="max-height: 115px;" class="img-responsive storyProfilePic" src="<?php echo image_get_path_basic($comment->commenterUserId, $comment->UserProfilePicureId, IMG_PROFILE, IMG_XSMALL) ?>" alt="<?php echo gettext("Profile Picture"); ?>">
				</a>
				<div class="storyAuthorDetails">
					<h4><?php echo $comment->FirstName . " " . $comment->LastName; ?></h4>
					<p>
						<?php echo gettext("Posted:") . " " . date("m-d-Y", strtotime($comment->DateCreated)); ?>
					</p>
				</div>				
			</div>			
		</div>
		<div class="col-md-10">	
			<div class="row">
		  		<div class="col-lg-8 col-md-7">
		    		<h4><?php echo gettext("Story"); ?></h4>
		    		<div>
		    			<?php echo $comment->StoryTitle; ?>
		    		</div>
		    		<h4><?php echo gettext("Comment"); ?></h4>
	    			<?php echo $comment->Content; ?>

	    			<div style="padding-top: 5px;">
						<a style="float: left;" class="btn btn-primary approveComment commentAction" data-action="<?php echo BASE_URL . "account/approveComment/"; ?>" data-comment-id="<?php echo $comment->CommentId; ?>" href="#"><?php echo gettext("Approve"); ?></a>
						<a style="float: left;" class="btn btn-danger rejectComment commentAction" data-action="<?php echo BASE_URL . "account/rejectComment/"; ?>" data-comment-id="<?php echo $comment->CommentId; ?>" href="#"><?php echo gettext("Reject"); ?></a>
						<div style="float: left; margin-left:10px" id="ApproveCommentSpinerDiv">
		             		<?php include(APP_DIR . 'views/shared/_spinner_small.php'); ?>
	             		</div>
					</div>
	  			</div>		
			</div>
			
		</div>
	</div>  
	<hr />
</div>