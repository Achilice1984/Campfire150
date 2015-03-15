<?php

 	//You have access to the Account/AccountHomeViewModel.php
	
	//You can access everything from this variable:
	//uncomment to view structure in browser
	//debugit($accountHomeViewModel);

?>

<div class="container" style="padding-top: 50px; padding-bottom: 50px;">
    <div class="row">
    	<div class="col-md-3">
    		<div class="row">
	    		<a href="<?php echo BASE_URL . "account/home/" . $accountHomeViewModel->userDetails->UserId; ?>">
	  				<img style="max-height: 200px;" class="img-responsive storyProfilePic" src="<?php echo BASE_URL; ?>static/images/default-user-image.png" alt="<?php echo gettext("Profile Picture"); ?>">
				</a>
			</div>
			<div class="row">
				<h3>About</h3>
				<?php echo $accountHomeViewModel->userDetails->About; ?>
			</div>
			<div class="row">
				<h3>Following</h3>
			</div>
			<div class="row">
				<h3>Followers</h3>
			</div>

			<div class="row">
				<h3>Stories</h3>
			</div>
    	</div>
    	<div class="col-md-9">
    		<div class="row">
    			<div class="col-md-9">
    				<h2>
    					<?php echo $accountHomeViewModel->userDetails->FirstName . " " . $accountHomeViewModel->userDetails->LastName; ?>
					</h2>
				</div>
				<div class="col-md-3">
					<a href="<?php echo BASE_URL; ?>story/add" class="btn btn-warning btn-lg btn-block"><?php echo gettext("Share a Story"); ?></a>
				</div>
    		</div>   
    		<div class="row">
    			<!-- <div class="btn-group btn-group-justified" role="group" aria-label="...">
					<div class="btn-group" role="group">
				    	<button type="button" class="btn btn-default"><?php echo gettext("News Feed"); ?></button>
					</div>
					<div class="btn-group" role="group">
				    	<button type="button" class="btn btn-default"><?php echo gettext("My Stories"); ?></button>
					</div>
					<div class="btn-group" role="group">
				    	<button type="button" class="btn btn-default"><?php echo gettext("My Recommendations"); ?></button>
					</div>
					<div class="btn-group" role="group">
				    	<button type="button" class="btn btn-default"><?php echo gettext("Following"); ?></button>
					</div>
				</div> -->
				<ul class="nav nav-pills">
				    <li role="presentation" class="active"><a href="#User_NewsFeed" aria-controls="User_NewsFeed" role="tab" data-toggle="tab"><?php echo gettext("News Feed"); ?></a></li>
				    <li role="presentation"><a href="#User_MyStories" aria-controls="User_MyStories" role="tab" data-toggle="tab"><?php echo gettext("My Stories"); ?> <span class="badge"><?php echo $accountHomeViewModel->totalApprovedStories; ?></span></a></li>
				    <li role="presentation"><a href="#User_MyRecommendations" aria-controls="User_MyRecommendations" role="tab" data-toggle="tab"><?php echo gettext("My Recommendations"); ?> <span class="badge"><?php echo $accountHomeViewModel->totalRecommendations; ?></span></a></li>
				    <li role="presentation"><a href="#User_Following" aria-controls="User_Following" role="tab" data-toggle="tab"><?php echo gettext("Following"); ?> <span class="badge"><?php echo $accountHomeViewModel->totalFollowing; ?></span></a></li>
				    <li role="presentation"><a href="#User_Followers" aria-controls="User_Followers" role="tab" data-toggle="tab"><?php echo gettext("Followers"); ?> <span class="badge"><?php echo $accountHomeViewModel->totalFollowers; ?></span></a></li>
				</ul>   

				<div class="tab-content" style="padding:20px;">
				    <div role="tabpanel" class="tab-pane active" id="User_NewsFeed">
				    	<?php 
							// foreach ($accountHomeViewModel->newsFeed as $feed)
							// {
							// 	include(APP_DIR . "views/Account/_newsFeed.php");
							// }			
						?>  
				    </div>


				    <div role="tabpanel" class="tab-pane" id="User_MyStories">
						<?php 
							foreach ($accountHomeViewModel->usersStoryList as $story)
							{
								include(APP_DIR . "views/Account/_myStories.php");
							}			
						?>
				    </div>


				    <div role="tabpanel" class="tab-pane" id="User_MyRecommendations">
						<?php 
							foreach ($accountHomeViewModel->recommendedStoryList as $story)
							{
								//debugit($story);
								include(APP_DIR . "views/Account/_myRecommendations.php");
							}			
						?> 
				    </div> 
				    <div role="tabpanel" class="tab-pane" id="User_Following">
						<?php 
							if(isset($accountHomeViewModel->followingList) && count($accountHomeViewModel->followingList) > 0)
							{
								foreach ($accountHomeViewModel->followingList as $user)
								{
									//debugit($story);
									include(APP_DIR . "views/Account/_searchPanel.php");
								}	
							}	
						?>
				    </div> 
				    <div role="tabpanel" class="tab-pane" id="User_Followers">
						<?php 
							if(isset($accountHomeViewModel->followerList) && count($accountHomeViewModel->followerList))
							{
								//debugit($accountHomeViewModel->followerList);
								foreach ($accountHomeViewModel->followerList as $user)
								{
									//debugit($story);
									include(APP_DIR . "views/Account/_searchPanel.php");
								}
							}			
						?>
				    </div> 
				</div> 
			</div> 		
    	</div>
    </div>
</div>