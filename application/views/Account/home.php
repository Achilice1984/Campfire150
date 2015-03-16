<?php

 	//You have access to the Account/AccountHomeViewModel.php
	
	//You can access everything from this variable:
	//uncomment to view structure in browser
	//debugit($accountHomeViewModel);

?>

<div class="bg-primary" style="min-width: 100%; min-height: 200px; margin-top: -15px;">
	<img style="" class="img-responsive hidden-xs" src="<?php echo BASE_URL; ?>static/images/default_background_image.jpg" alt="<?php echo gettext("Background Picture"); ?>">
</div>

<div class="container" style="padding-top: 50px; padding-bottom: 50px;">
    <div class="row">
    	<div style="margin-top: -200px; padding-right: 40px;" class="col-md-3">
    		<div class="row">
	    		<a href="<?php echo BASE_URL . "account/home/" . $accountHomeViewModel->userDetails->UserId; ?>">
	  				<img style="max-height: 270px;" class="img-responsive img-thumbnail storyProfilePic" src="<?php echo BASE_URL; ?>static/images/default-user-image.png" alt="<?php echo gettext("Profile Picture"); ?>">
				</a>
			</div>
			<div class="row">
				<h2>
					<?php echo $accountHomeViewModel->userDetails->FirstName . " " . $accountHomeViewModel->userDetails->LastName; ?>
				</h2>
			</div>
			<div style="margin-bottom: 10px;" class="row">
				<?php
					if(isset($accountHomeViewModel->userDetails->UserId) && $accountHomeViewModel->userDetails->UserId != $currentUser->UserId && $currentUser->IsAuth)
		            {
		                if(isset($accountHomeViewModel->userDetails->FollowingUser) && $accountHomeViewModel->userDetails->FollowingUser == TRUE)
		                {
		                    echo '<button style="display:block; width: 100%; margin-top: 5px;" data-userId="' . $accountHomeViewModel->userDetails->UserId . '" data-additional-text="' . gettext("Follow") . '" data-ajaxurl="' . BASE_URL . 'account/follow" class="FollowButton btn btn-primary btn-sm"><span class="glyphicon glyphicon-user"></span> ' . gettext("Following") . '</button>';
		                }
		                else
		                {
		                    echo '<button style="display:block; width: 100%; margin-top: 5px;" data-userId="' . $accountHomeViewModel->userDetails->UserId . '" data-additional-text="' . gettext("Following") . '" data-ajaxurl="' . BASE_URL . 'account/follow" class="FollowButton btn btn-default btn-sm"><span class="glyphicon glyphicon-user"></span> ' . gettext("Follow") . '</button>';
		                }
		            }
		            else
		            {
		            	?> <a class="btn btn-default btn-sm" style="display:block; width: 100%; margin-top: 5px;" href="<?php echo BASE_URL . "account/profile/" . $accountHomeViewModel->userDetails->UserId; ?>"><?php echo gettext("Edit Profile"); ?></a> <?php
		            }
				?>
    		</div> 
			
			<div style="color: #333;" class="row">
				<?php echo $accountHomeViewModel->userDetails->About; ?>
			</div>
			<div style="margin-bottom: 50px; margin-top: 10px;" class="row">
				<?php if(isset($accountHomeViewModel->userDetails->UserActionStatement)) { ?>
					<span class="glyphicon glyphicon-bullhorn"></span> <?php echo $accountHomeViewModel->userDetails->UserActionStatement; ?>
				<?php } ?>
			</div>
			
    	</div>
    	<div style="margin-top: -40px;" class="col-md-9">    		  
    		<div class="row">
				<ul style="border-bottom: 1px solid #eee" class="nav nav-pills">
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