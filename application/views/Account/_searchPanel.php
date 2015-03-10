<?php require_once(APP_DIR . 'helpers/image_get_path.php'); ?>

<div class="row StoryRowSection" style="margin-top: 40px; padding:20px; padding-bottom: 0px;">
	<div class="col-md-2">
		<div class="row">
			<a href="<?php echo BASE_URL . "account/user/" . $user->UserId; ?>">
  				<img class="img-responsive storyProfilePic" src="<?php echo BASE_URL; ?>static/images/default-user-image.png" alt="<?php echo gettext("Profile Picture"); ?>">
			</a>
			<div class="caption">
				<h4><?php echo $user->FirstName . " " . $user->LastName; ?></h4>
				<p>
					<?php echo gettext("Since:") . " " . $user->DateCreated; ?>
				</p>
			</div>				
		</div>			
	</div>
	<div class="col-md-9">	
		<h2>About</h2>

		<button>Follow</button>

	</div>
	<div class="col-md-1">	

		<div class="row">			
			<h4 style="font-size: 2em;">

				<span class="glyphicon glyphicon-user"></span> 
				<span class="totalFollowersSpan"><?php echo $user->totalFollowers; ?></span>
			</h4>			
		</div>
		<div class="row">			
			<h4 style="font-size: 2em;">

				<span class="glyphicon glyphicon-book"></span> 
				<span class="totalStoriesSpan"><?php echo $user->totalPublishedStories; ?></span>
			</h4>			
		</div>
		<div class="row">			
			<h4 style="font-size: 2em;">

				<span class="glyphicon glyphicon-comment"></span> 
				<span class="totalCommentSpan"><?php echo $user->totalPublishedComments; ?></span>
			</h4>			
		</div>
		<div class="row">
			
			<h4 style="font-size: 2em;">
				<span class="glyphicon glyphicon-thumbs-up"></span>
				<span class="totalRecommendsSpan"><?php echo $user->totalRecommends; ?></span>
			</h4>
			
		</div>		
	</div>
</div>  
<hr />