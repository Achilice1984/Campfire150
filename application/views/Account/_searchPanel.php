<?php require_once(APP_DIR . 'helpers/image_get_path.php'); ?>


<section class="col-sm-6 StoryRowSection">
	<div class="storySummary marginBottom15">
	<div class="row">
		<div class="col-sm-5">

			<a href="<?php echo BASE_URL . "account/home/" . $user->UserId; ?>">
  				<img class="img-responsive storyProfilePic" src="<?php echo image_get_path_basic($user->UserId, $user->UserProfilePicureId, IMG_PROFILE, IMG_XSMALL) ?>" alt="<?php echo gettext("Profile Picture"); ?>">
			</a>		
		</div>
		<div class="col-sm-7">
			<h2 class="storyTitle"><?php echo $user->FirstName . " " . $user->LastName; ?></h2>
			<div class="storyStats marginTop15 clearfix">
			    <div>
			        <span class="glyphicon glyphicon-user"></span> 
					<?php echo $user->totalFollowers; ?>
			    </div>
			    <div>
			        <span class="glyphicon glyphicon-book"></span> 
					<?php echo $user->totalPublishedStories; ?>
			    </div>
			    <div>
			        <span class="glyphicon glyphicon-comment"></span> 
					<?php echo $user->totalPublishedComments; ?>
			    </div>
			    <div>
			        <span class="glyphicon glyphicon-thumbs-up"></span>
					<?php echo $user->totalRecommends; ?>
			    </div>		
			</div>
			
			<?php
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
</section>
