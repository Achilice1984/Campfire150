<?php require_once(APP_DIR . 'helpers/image_get_path.php'); ?>

<div class="row StoryRowSection" style="margin-top: 40px; padding:20px; padding-bottom: 0px;">
	<div class="col-md-2">
		<div class="row">
			<a href="<?php echo BASE_URL . "account/user/" . $user->UserId; ?>">
  				<img style="max-height: 150px;" class="img-responsive storyProfilePic" src="<?php echo BASE_URL; ?>static/images/default-user-image.png" alt="<?php echo gettext("Profile Picture"); ?>">
			</a>
			<div>
				<h4><?php echo $user->FirstName . " " . $user->LastName; ?></h4>
				<p>
					<?php echo gettext("Since:") . " " . isset($user->DateCreated) ? date_format(date_create($user->DateCreated), 'Y-m-d') : ""; ?>
				</p>
			</div>				
		</div>			
	</div>
	<div class="col-md-9" style="display: block; position: relative; min-height: 150px;">	
		
		<?php

			if(isset($user->ActionStatement))
			{
				echo "<div class='row'>";
				echo "<h4>" . gettext("Action Statement") . "</h4>";
				echo $user->ActionStatement;
				echo "</div>";
			}

			if(isset($user->About))
			{
				echo "<div class='row' style='padding-top:10px;'>";
				echo "<h4>" . gettext("About") . "</h4>";
				echo $user->About;
				echo "</div>";
			}			

            if(isset($user->UserId) && $user->UserId != $currentUser->UserId && $currentUser->IsAuth)
            {
                if(isset($user->FollowingUser) && $user->FollowingUser == TRUE)
                {
                    echo '<button style="position:absolute; display: block;  bottom: 0;" data-userId="' . $user->UserId . '" data-additional-text="' . gettext("Follow") . '" data-ajaxurl="' . BASE_URL . 'account/follow" class="FollowButton btn btn-primary btn-lg"><span class="glyphicon glyphicon-user"></span> ' . gettext("Following") . '</button>';
                }
                else
                {
                    echo '<button style="position:absolute; display: block;  bottom: 0;" data-userId="' . $user->UserId . '" data-additional-text="' . gettext("Following") . '" data-ajaxurl="' . BASE_URL . 'account/follow" class="FollowButton btn btn-default btn-lg"><span class="glyphicon glyphicon-user"></span> ' . gettext("Follow") . '</button>';
                }
            }
        ?>

	</div>
	<div class="col-md-1">	

		<div class="row">			
			<h4 style="font-size: 1.3em;">

				<span class="glyphicon glyphicon-user"></span> 
				<span class="totalFollowersSpan"><?php echo $user->totalFollowers; ?></span>
			</h4>			
		</div>
		<div class="row">			
			<h4 style="font-size: 1.3em;">

				<span class="glyphicon glyphicon-book"></span> 
				<span class="totalStoriesSpan"><?php echo $user->totalPublishedStories; ?></span>
			</h4>			
		</div>
		<div class="row">			
			<h4 style="font-size: 1.3em;">

				<span class="glyphicon glyphicon-comment"></span> 
				<span class="totalCommentSpan"><?php echo $user->totalPublishedComments; ?></span>
			</h4>			
		</div>
		<div class="row">
			
			<h4 style="font-size: 1.3em;">
				<span class="glyphicon glyphicon-thumbs-up"></span>
				<span class="totalRecommendsSpan"><?php echo $user->totalRecommends; ?></span>
			</h4>
			
		</div>		
	</div>
</div>  
<hr />