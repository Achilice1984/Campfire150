<?php

	//debugit($comment);
?>


<?php if ($comment->ProfilePrivacyType_PrivacyTypeId == 1 && $comment->IsUserActive == TRUE && (!isset($comment->IsAdminRejected) || $comment->IsAdminRejected == FALSE)) { ?>	
	  <!-- First Comment -->
	<article class="row">
		<div class="col-sm-2 col-xs-3">
			<figure class="thumbnail">
				<a href="<?php echo BASE_URL . "account/home/" . $comment->User_UserId; ?>">
					<img class="img-responsive" src="<?php echo image_get_path_basic($comment->User_UserId, $comment->PictureId, IMG_PROFILE, IMG_XSMALL); ?>" />
				</a>
			</figure>
		</div>

		<div class="col-sm-10 col-xs-9">
			<div class="comment-post">
				<div class="row">
					<div class="col-md-9">
						<p><?php echo $comment->Content; ?></p>
					</div>
					<div class="col-md-3">
						<p><span class="glyphicon glyphicon-user"></span> <?php echo $comment->FirstName . " " . $comment->LastName; ?></p>
						<p><span class="glyphicon glyphicon-time"></span> <?php echo date("M d, Y", strtotime($comment->DateCreated)); ?></p>
						<p>
							<a data-toggle="tooltip" title="<?php echo gettext("Flag as Inappropriate"); ?>" style="text-decoration: none; padding-right: 5px;" data-request-type="<?php echo (isset($comment->IsFlagged) && $comment->IsFlagged == TRUE ? "0" : "1"); ?>" class="CommentFlagButton <?php echo (isset($comment->IsFlagged) && $comment->IsFlagged == TRUE) ? "text-danger" : "StoryActionButtons"; ?>" href="<?php echo BASE_URL . "story/flagCommentInappropriate/" . $comment->CommentId . "/" . (isset($comment->IsFlagged) && $comment->IsFlagged == TRUE ? "0" : "1"); ?>">
				            	<span class="glyphicon glyphicon-flag"></span> 
				        	</a>
							<?php echo gettext("Flag"); ?>
						</p>

					</div>
				</div>
				
			</div>
		</div>
	</article>
<?php } else { ?>
	  <!-- First Comment -->

	<div class="comment-post alert alert-warning" id="CurrentRejectedContentInfoBar" role="alert">
  		<?php echo (!isset($comment->IsAdminRejected) || $comment->IsAdminRejected == FALSE) ? gettext("This comment has been removed.") : gettext("This comment has been removed by an administrator."); ?>							
	</div>

<?php } ?>
