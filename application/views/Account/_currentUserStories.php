<div>
	<ul style="border-bottom: 1px solid #eee" id="User_Current_Tabs" class="nav nav-pills">
	    <li role="presentation" class="active"><a href="#User_Current_Published" aria-controls="User_Current_Published" role="tab" data-toggle="tab"><?php echo gettext("Published"); ?></a></li>
	    <li role="presentation"><a href="#User_Current_Drafts" aria-controls="User_Current_Drafts" role="tab" data-toggle="tab"><?php echo gettext("Drafts"); ?></a></li>
	    <li role="presentation"><a href="#User_Current_Pending" aria-controls="User_Current_Pending" role="tab" data-toggle="tab"><?php echo gettext("Pending"); ?></a></li>
	    <li role="presentation"><a href="#User_Current_Rejected" aria-controls="User_Current_Rejected" role="tab" data-toggle="tab"><?php echo gettext("Rejected"); ?></a></li>
	</ul> 

	<div class="tab-content" style="padding:20px;">
		<div role="tabpanel" class="tab-pane active" id="User_Current_Published">
			<?php 
				if(isset($accountHomeViewModel->usersStoryList) && count($accountHomeViewModel->usersStoryList))
				{
					foreach ($accountHomeViewModel->usersStoryList as $story)
					{
						include(APP_DIR . "views/Account/_myStories.php");
					}
				}			
			?>			
		</div>
		<div role="tabpanel" class="tab-pane" id="User_Current_Drafts">
			<?php 
				if(isset($accountHomeViewModel->draftStories) && count($accountHomeViewModel->draftStories))
				{
					foreach ($accountHomeViewModel->draftStories as $story)
					{
						include(APP_DIR . "views/Account/_rejectedStories.php");
					}
				}			
			?>
		</div>
		<div role="tabpanel" class="tab-pane" id="User_Current_Pending">
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
		<div role="tabpanel" class="tab-pane" id="User_Current_Rejected">
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
	</div>
</div>
