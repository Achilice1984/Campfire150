<?php

	//debugit($comment);
?>


<?php if ($comment->ProfilePrivacyType_PrivacyTypeId == 1 && $comment->IsUserActive == TRUE && (!isset($comment->IsAdminRejected) || $comment->IsAdminRejected == FALSE)) { ?>	
	  <!-- First Comment -->
	<article class="row">
		<div class="col-md-2 col-sm-2 hidden-md hidden-xs">
			<figure class="thumbnail">
				<a href="<?php echo BASE_URL . "account/home/" . $comment->User_UserId; ?>">
					<img class="img-responsive" style="height: 150px;" src="<?php echo image_get_path_basic($comment->User_UserId, 0, 1, IMG_SMALL); ?>" />
				</a>
			</figure>
		</div>
		<div class="col-md-10 col-sm-10">
			<div class="panel panel-default arrow left">
				<div class="panel-body">
					<div style="min-height: 82px;" class="comment-post">
						<div class="row">
							<div class="col-md-9" style="padding:10px; padding-left:20px; font-size: 1.2em;">
								<?php echo $comment->Content; ?>
							</div>
							<div class="col-md-3 hidden-md hidden-xs" style="position: absolute; bottom: 0; right: 0; padding: 25px;  padding-bottom: 30px;">
									
								<span style="padding-right: 5px;" class="glyphicon glyphicon-time"></span>	<strong><?php echo date("m-d-Y", strtotime($comment->DateCreated)); ?></strong>
								
								<br />
								<span style="padding-right: 5px;" class="glyphicon glyphicon-user"></span>  <strong><?php echo $comment->FirstName . " " . $comment->LastName; ?></strong>

								<br />
								<span style="padding-right: 5px;" class="glyphicon glyphicon-flag"></span>  <strong><?php echo gettext("Flag"); ?></strong>
							</div>
						</div>
						<div class="row hidden-lg">
							
							<hr />
							<div class="col-md-12" style="bottom: 0; right: 0;">
								
								<span style="padding-right: 5px;" class="glyphicon glyphicon-time"></span>	<strong><?php echo date("m-d-Y", strtotime($comment->DateCreated)); ?></strong>
								
								<br />
								<span style="padding-right: 5px;" class="glyphicon glyphicon-user"></span>  <strong><?php echo $comment->FirstName . " " . $comment->LastName; ?></strong>

								<br />
								<span style="padding-right: 5px;" class="glyphicon glyphicon-flag"></span>  <strong><?php echo gettext("Flag"); ?></strong>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</article>
<?php } else { ?>
	  <!-- First Comment -->
	<article class="row">
		<div class="col-md-2 col-sm-2 hidden-md hidden-xs">
			
		</div>
		<div class="col-md-10">
			<div class="panel panel-default arrow left">
				<div class="panel-body">
					<div style="min-height: 82px;" class="comment-post">
						<div class="row">
							<div class="col-md-9" style="padding:20px; font-size: 1.2em;">
								<div class="alert alert-info alert-dismissible" id="CurrentRejectedContentInfoBar" role="alert" style="display:none;">
							  		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							  		<strong><?php echo gettext("Info!"); ?></strong> <?php echo gettext("You have reached the end of your search results."); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</article>
<?php } ?>
