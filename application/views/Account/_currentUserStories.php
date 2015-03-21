<div>
	<ul style="border-bottom: 1px solid #eee" id="User_Current_Tabs" class="nav nav-pills">
	    <li role="presentation" class="active"><a href="#User_Current_Published" aria-controls="User_Current_Published" role="tab" data-toggle="tab"><?php echo gettext("Published"); ?></a></li>
	    <li role="presentation"><a href="#User_Current_Drafts" aria-controls="User_Current_Drafts" role="tab" data-toggle="tab"><?php echo gettext("Drafts"); ?></a></li>
	    <li role="presentation"><a href="#User_Current_Pending" aria-controls="User_Current_Pending" role="tab" data-toggle="tab"><?php echo gettext("Pending"); ?></a></li>
	    <li role="presentation"><a href="#User_Current_Rejected" aria-controls="User_Current_Rejected" role="tab" data-toggle="tab"><?php echo gettext("Rejected"); ?></a></li>
	</ul> 

	<div class="tab-content" style="padding:20px;">
		<div role="tabpanel" class="tab-pane active" id="User_Current_Published">

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

			<div class="row text-center" id="CurrentPublishedContentMoreButton" style="margin-bottom: 100px;">
				<button type="button" class="btn btn-default btn-lg" style="background-color: orange; color:white; width:100%;"><?php echo gettext("Show More Stories!"); ?></button>
			</div>		
		</div>
		<div role="tabpanel" class="tab-pane" id="User_Current_Drafts">

			<div id="CurrentDraftsContent">
				<?php 
					if(isset($accountHomeViewModel->draftStories) && count($accountHomeViewModel->draftStories))
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

			<div class="row text-center" id="CurrentDraftsContentMoreButton" style="margin-bottom: 100px;">
				<button type="button" class="btn btn-default btn-lg" style="background-color: orange; color:white; width:100%;"><?php echo gettext("Show More Stories!"); ?></button>
			</div>
		</div>
		<div role="tabpanel" class="tab-pane" id="User_Current_Pending">

			<div id="CurrentPendingContent">
				<?php 
					if(isset($accountHomeViewModel->pendingStories) && count($accountHomeViewModel->pendingStories))
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

			<div class="row text-center" id="CurrentPendingContentMoreButton" style="margin-bottom: 100px;">
				<button type="button" class="btn btn-default btn-lg" style="background-color: orange; color:white; width:100%;"><?php echo gettext("Show More Stories!"); ?></button>
			</div>
		</div>
		<div role="tabpanel" class="tab-pane" id="User_Current_Rejected">

			<div id="CurrentRejectedContent">
				<?php 
					if(isset($accountHomeViewModel->rejectedStories) && count($accountHomeViewModel->rejectedStories))
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

			<div class="row text-center" id="CurrentRejectedContentMoreButton" style="margin-bottom: 100px;">
				<button type="button" class="btn btn-default btn-lg" style="background-color: orange; color:white; width:100%;"><?php echo gettext("Show More Stories!"); ?></button>
			</div>
		</div>  
	</div>
</div>
