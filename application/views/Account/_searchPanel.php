<?php require_once(APP_DIR . 'helpers/image_get_path.php'); ?>

<div class="row StoryRowSection" style="margin-top: 0px; padding:20px; padding-bottom: 0px;">
	<div class="col-md-2">
		<div class="row">
			<a href="<?php echo BASE_URL . "account/home/" . $user->UserId; ?>">
  				<img style="max-height: 150px;" class="img-responsive storyProfilePic" src="<?php echo image_get_path_basic($user->UserId, $user->UserProfilePicureId, IMG_PROFILE, IMG_SMALL) ?>" alt="<?php echo gettext("Profile Picture"); ?>">
			</a>			
		</div>			
	</div>
	<div class="col-md-10" style="display: block; position: relative; min-height: 150px;">	

		<h3><?php echo $user->FirstName . " " . $user->LastName; ?></h3>
		
		<div class="col-md-4 userStatsDiv" style="padding-left: 0px;">
		    <div style="font-size: 1.2em;" class="storyStatsContainer">
			    <div style="float: left;">
			        <span class="glyphicon glyphicon-user"></span> 
					<span class="totalFollowersSpan"><?php echo $user->totalFollowers; ?></span>
			    </div>
			    <div style="float: left; padding-left: 10px;">
			        <span class="glyphicon glyphicon-book"></span> 
					<span class="totalStoriesSpan"><?php echo $user->totalPublishedStories; ?></span>
			    </div>
			    <div style="float: left; padding-left: 10px;">
			        <span class="glyphicon glyphicon-comment"></span> 
					<span class="totalCommentSpan"><?php echo $user->totalPublishedComments; ?></span>
			    </div>
			    <div style="float: left; padding-left: 10px;">
			        <span class="glyphicon glyphicon-thumbs-up"></span>
					<span class="totalRecommendsSpan"><?php echo $user->totalRecommends; ?></span>
			    </div>

			</div>			
		</div>
		<div style="clear: both;"></div>
		
		<?php

			// if(isset($user->ActionStatement))
			// {
			// 	echo "<div class='row' style='padding-left:15px; margin-top:10px;'>";
			// 	//echo "<h4>" . gettext("Action Statement") . "</h4>";
			// 	echo $user->ActionStatement;
			// 	echo "</div>";
			// }

			if(isset($user->About))
			{
				echo "<div class='row' style='padding-left:15px; margin-top:10px;'>";
				//echo "<h4>" . gettext("About") . "</h4>";
				echo $user->About;
				echo "</div>";
			}			

            if(isset($user->UserId) && $user->UserId != $currentUser->UserId && $currentUser->IsAuth)
            {
                if(isset($user->FollowingUser) && $user->FollowingUser == TRUE)
                {
                    echo '<button style="margin-top: 10px;" data-userId="' . $user->UserId . '" data-additional-text="' . gettext("Follow") . '" data-ajaxurl="' . BASE_URL . 'account/follow" class="FollowButton btn btn-primary btn-lg"><span class="glyphicon glyphicon-user"></span> ' . gettext("Following") . '</button>';
                }
                else
                {
                    echo '<button style="margin-top: 10px;" data-userId="' . $user->UserId . '" data-additional-text="' . gettext("Following") . '" data-ajaxurl="' . BASE_URL . 'account/follow" class="FollowButton btn btn-default btn-lg"><span class="glyphicon glyphicon-user"></span> ' . gettext("Follow") . '</button>';
                }
            }
        ?>

	</div>
</div>  
<hr />