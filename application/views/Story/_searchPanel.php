<div class="row StoryRowSection" style="margin-top: 40px; padding:20px; padding-bottom: 0px;">
	<div class="col-md-2">
		<div class="row">
			<a href="<?php echo BASE_URL . "account/user/" . $story->UserId; ?>">
  				<img class="img-responsive storyProfilePic" src="<?php echo BASE_URL; ?>static/images/default-user-image.png" alt="<?php echo gettext("Profile Picture"); ?>">
			</a>
			<div class="caption">
				<h4><?php echo $story->FirstName . " " . $story->LastName; ?></h4>
				<p>
					<?php echo gettext("Posted:") . " " . $story->DatePosted; ?>
				</p>
			</div>				
		</div>			
	</div>
	<div class="col-md-9">	
		<div class="media">
				<div class="media-left">
			    <a href="<?php echo BASE_URL . "story/display/" . $story->StoryId; ?>">
			      	<img style="width: 250px;" class="media-object" src="<?php echo BASE_URL; ?>static/images/default_story_image.jpg" alt="...">
			    </a>
				</div>
	  		<div class="media-body">
	    		<h4 class="media-heading"><?php echo $story->StoryTitle; ?></h4>
    			<?php echo substr($story->Content, 0, 255) . " ..."; ?>
  			</div>
		</div>

	</div>
	<div class="col-md-1">	
		<div class="row">			
				<h4 style="font-size: 2em;">
					<a style="text-decoration: none;" class="StoryActionButtons" href="<?php echo BASE_URL . "story/display/" . $story->StoryId;  ?>">
						<span class="glyphicon glyphicon-comment"></span> 
					</a>
					<span class="totalCommentSpan"><?php echo $story->totalComments; ?></span>
				</h4>			
		</div>
		<div class="row">
			
				<h4 style="font-size: 2em;">
					<a style="text-decoration: none;" data-request-type="<?php echo (isset($story->Opinion) && $story->Opinion == TRUE ? "0" : "1"); ?>" class="StoryRecommendButton <?php echo (isset($story->Opinion) && $story->Opinion == TRUE) ? "text-default" : "StoryActionButtons"; ?>" href="<?php echo BASE_URL . "story/recommendStory/" . $story->StoryId . "/" . (isset($story->Opinion) && $story->Opinion == TRUE ? "0" : "1"); ?>">
						<span class="glyphicon glyphicon-thumbs-up"></span>
					</a>
					<span class="totalRecommendsSpan"><?php echo $story->totalRecommends; ?></span>
				</h4>
			
		</div>	
		<div class="row">			
				<h4 style="font-size: 2em;">
					<a style="text-decoration: none;" data-request-type="<?php echo (isset($story->Opinion) && $story->Opinion == FALSE ? "0" : "1"); ?>" class="StoryFlagButton <?php echo (isset($story->Opinion) && $story->Opinion == FALSE) ? "text-danger" : "StoryActionButtons"; ?>" href="<?php echo BASE_URL . "story/flagInappropriate/" . $story->StoryId . "/" . (isset($story->Opinion) && $story->Opinion == FALSE ? "0" : "1"); ?>">
						<span class="glyphicon glyphicon-flag"></span> 
					</a>
					<span class="totalFlagsSpan"><?php echo $story->totalFlags; ?></span>
				</h4>			
		</div>	
	</div>
</div>  
<hr />