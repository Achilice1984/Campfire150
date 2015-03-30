
	<ul id="User_Current_Tabs" class="nav nav-tabs marginBottom15">
	    <li role="presentation" class="active"><a href="#User_Current_Published" aria-controls="User_Current_Published" role="tab" data-toggle="tab"><?php echo gettext("Published"); ?></a></li>
	    <li role="presentation"><a href="#User_Current_Drafts" aria-controls="User_Current_Drafts" role="tab" data-toggle="tab"><?php echo gettext("Drafts"); ?></a></li>
	    <li role="presentation"><a href="#User_Current_Pending" aria-controls="User_Current_Pending" role="tab" data-toggle="tab"><?php echo gettext("Pending"); ?></a></li>
	    <li role="presentation"><a href="#User_Current_Rejected" aria-controls="User_Current_Rejected" role="tab" data-toggle="tab"><?php echo gettext("Rejected"); ?></a></li>
	    <li role="presentation"><a href="#User_Current_Comments" aria-controls="User_Current_Comments" role="tab" data-toggle="tab"><?php echo gettext("Comments"); ?></a></li>
	</ul> 

	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="User_Current_Published">
			
			<?php if (isset($accountHomeViewModel->publishedStories) && is_array($accountHomeViewModel->publishedStories) && count($accountHomeViewModel->publishedStories) > 0) { ?>
				<div id="CurrentPublishedContent">
					<?php 
						if(isset($accountHomeViewModel->publishedStories) && count($accountHomeViewModel->publishedStories))
						{
							foreach ($accountHomeViewModel->publishedStories as $story)
							{
								include(APP_DIR . "views/Account/_publishedStories.php");
							}
						}			
					?>
				</div>	

				<div class="alert alert-info alert-dismissible" id="CurrentPublishedContentInfoBar" role="alert" style="display:none;">
			  		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  		<strong><?php echo gettext("Info!"); ?></strong> <?php echo gettext("You have reached the end of your search results."); ?>
				</div>

				<input type="hidden" name="CurrentPublishedContentPage" id="CurrentPublishedContentPage" value="1">
				<input type="hidden" name="CurrentPublishedContentUrl" id="CurrentPublishedContentUrl" value="<?php echo BASE_URL; ?>account/publishedList">

				<div class="text-center" id="CurrentPublishedContentMoreButton">
					<?php include(APP_DIR . 'views/shared/_spinner_large.php'); ?>

					<button type="button" class="btn btn-warning btn-lg btn-block"><?php echo gettext("Show More Stories!"); ?></button>
				</div>	
			<?php } else { include(APP_DIR . "views/shared/noResults.php"); } ?>
		</div>
		<div role="tabpanel" class="tab-pane" id="User_Current_Drafts">
			
			<?php if (isset($accountHomeViewModel->draftStories) && is_array($accountHomeViewModel->draftStories) && count($accountHomeViewModel->draftStories) > 0) { ?>
				<div id="CurrentDraftsContent">
					<?php 
						if(isset($accountHomeViewModel->draftStories) && count($accountHomeViewModel->draftStories) > 0)
						{
							foreach ($accountHomeViewModel->draftStories as $story)
							{
								include(APP_DIR . "views/Account/_draftStories.php");
							}
						}			
					?>
				</div>

				<div class="alert alert-info alert-dismissible" id="CurrentDraftsContentInfoBar" role="alert" style="display:none;">
			  		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  		<strong><?php echo gettext("Info!"); ?></strong> <?php echo gettext("You have reached the end of your search results."); ?>
				</div>

				<input type="hidden" name="CurrentDraftsContentPage" id="CurrentDraftsContentPage" value="1">
				<input type="hidden" name="CurrentDraftsContentUrl" id="CurrentDraftsContentUrl" value="<?php echo BASE_URL; ?>account/draftsList">

				<div class="text-center" id="CurrentDraftsContentMoreButton">
					<?php include(APP_DIR . 'views/shared/_spinner_large.php'); ?>

					<button type="button" class="btn btn-warning btn-lg btn-block"><?php echo gettext("Show More Stories!"); ?></button>
				</div>
			<?php } else { include(APP_DIR . "views/shared/noResults.php"); } ?>
		</div>
		<div role="tabpanel" class="tab-pane" id="User_Current_Pending">
			
			<?php if (isset($accountHomeViewModel->pendingStories) && is_array($accountHomeViewModel->pendingStories) && count($accountHomeViewModel->pendingStories) > 0) { ?>
				<div id="CurrentPendingContent">
					<?php 
						if(isset($accountHomeViewModel->pendingStories) && count($accountHomeViewModel->pendingStories) > 0)
						{
							foreach ($accountHomeViewModel->pendingStories as $story)
							{
								include(APP_DIR . "views/Account/_pendingStories.php");
							}
						}			
					?>
				</div>

				<div class="alert alert-info alert-dismissible" id="CurrentPendingContentInfoBar" role="alert" style="display:none;">
			  		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  		<strong><?php echo gettext("Info!"); ?></strong> <?php echo gettext("You have reached the end of your search results."); ?>
				</div>

				<input type="hidden" name="CurrentPendingContentPage" id="CurrentPendingContentPage" value="1">
				<input type="hidden" name="CurrentPendingContentUrl" id="CurrentPendingContentUrl" value="<?php echo BASE_URL; ?>account/pendingList">

				<div class="text-center" id="CurrentPendingContentMoreButton">
					<?php include(APP_DIR . 'views/shared/_spinner_large.php'); ?>

					<button type="button" class="btn btn-warning btn-lg btn-block"><?php echo gettext("Show More Stories!"); ?></button>
				</div>
			<?php } else { include(APP_DIR . "views/shared/noResults.php"); } ?>
		</div>
		<div role="tabpanel" class="tab-pane" id="User_Current_Rejected">
			
			<?php if (isset($accountHomeViewModel->rejectedStories) && is_array($accountHomeViewModel->rejectedStories) && count($accountHomeViewModel->rejectedStories) > 0) { ?>
				<div id="CurrentRejectedContent">
					<?php 
						if(isset($accountHomeViewModel->rejectedStories) && count($accountHomeViewModel->rejectedStories) > 0)
						{
							foreach ($accountHomeViewModel->rejectedStories as $story)
							{
								include(APP_DIR . "views/Account/_rejectedStories.php");
							}
						}			
					?>
				</div>

				<div class="alert alert-info alert-dismissible" id="CurrentRejectedContentInfoBar" role="alert" style="display:none;">
			  		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  		<strong><?php echo gettext("Info!"); ?></strong> <?php echo gettext("You have reached the end of your search results."); ?>
				</div>

				<input type="hidden" name="CurrentRejectedContentPage" id="CurrentRejectedContentPage" value="1">
				<input type="hidden" name="CurrentRejectedContentUrl" id="CurrentRejectedContentUrl" value="<?php echo BASE_URL; ?>account/rejectedList">

				<div class="text-center" id="CurrentRejectedContentMoreButton">
					<?php include(APP_DIR . 'views/shared/_spinner_large.php'); ?>

					<button type="button" class="btn btn-warning btn-lg btn-block"><?php echo gettext("Show More Stories!"); ?></button>
				</div>
			<?php } else { include(APP_DIR . "views/shared/noResults.php"); } ?>
		</div>  
		<div role="tabpanel" class="tab-pane" id="User_Current_Comments">
			
			<?php if (isset($accountHomeViewModel->pendingComments) && is_array($accountHomeViewModel->pendingComments) && count($accountHomeViewModel->pendingComments) > 0) { ?>
				<div id="CurrentCommentContent">
					<?php 
						if(isset($accountHomeViewModel->pendingComments) && count($accountHomeViewModel->pendingComments) > 0)
						{
							foreach ($accountHomeViewModel->pendingComments as $comment)
							{
								include(APP_DIR . "views/Account/_comments.php");
							}
						}			
					?>
				</div>

				<div class="alert alert-info alert-dismissible" id="CurrentCommentsContentInfoBar" role="alert" style="display:none;">
			  		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  		<strong><?php echo gettext("Info!"); ?></strong> <?php echo gettext("You have reached the end of your search results."); ?>
				</div>

				<input type="hidden" name="CurrentCommentsContentPage" id="CurrentCommentsContentPage" value="1">
				<input type="hidden" name="CurrentCommentsContentUrl" id="CurrentCommentsContentUrl" value="<?php echo BASE_URL; ?>account/commentsPendingApprovalList">

				<div class="row text-center" id="CurrentCommentsContentMoreButton" style="margin-bottom: 100px;">
					<?php include(APP_DIR . 'views/shared/_spinner_large.php'); ?>
					
					<button type="button" class="btn btn-warning btn-lg btn-block"><?php echo gettext("Show More Comments!"); ?></button>
				</div>
			<?php } else { include(APP_DIR . "views/shared/noResults.php"); } ?>
		</div>  		
	</div>

