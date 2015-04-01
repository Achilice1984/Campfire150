
<div class="row StoryRowSection" style="padding:0px; padding-top: 10px;">
 	<div class="col-md-2 hidden-sm hidden-xs">
		<div class="row">
			<a href="<?php echo BASE_URL . "account/home/" . $feed->UserId; ?>">
  				<img style="max-height: 115px;" class="img-responsive storyProfilePic" src="<?php echo image_get_path_basic($feed->UserId, $feed->UserProfilePicureId, IMG_PROFILE, IMG_XSMALL) ?>" alt="<?php echo gettext("Profile Picture"); ?>">
			</a>
			<div class="storyAuthorDetails">
				<h4><?php echo $feed->FirstName . " " . $feed->LastName; ?></h4>
				<p>
					<?php echo gettext("Posted:") . " " . $feed->DatePosted; ?>
				</p>
			</div>				
		</div>			
	</div>
	<div class="col-md-10">	
		<div class="row">

			<div class="col-md-4 storyStatsDiv">
			    <a href="<?php echo BASE_URL . "story/display/" . $feed->StoryId; ?>">
			      	<img style="width: 250px;" class="img-responsive" src="<?php echo image_get_path_basic($feed->UserId, $feed->PictureId, IMG_STORY, IMG_SMALL); ?>" alt="...">
			    </a>
			    <div style="font-size: 1.2em;" class="storyStatsContainer">
				    <div style="float: left; padding-left: 10px;">
				        <a data-toggle="tooltip" title="<?php echo gettext("Go to Comments"); ?>" style="text-decoration: none;" class="StoryActionButtons" href="#comments">
				            <span class="glyphicon glyphicon-comment"></span> 
				        </a>
				        <span class="totalCommentSpan"><?php echo $feed->totalComments; ?></span>
				    </div>
				    <div style="float: left; padding-left: 10px;">
				        <a data-toggle="tooltip" title="<?php echo gettext("Recommend Story"); ?>" style="text-decoration: none;" data-request-type="<?php echo (isset($feed->Opinion) && $feed->Opinion == TRUE ? "0" : "1"); ?>" class="StoryRecommendButton <?php echo (isset($feed->Opinion) && $feed->Opinion == TRUE) ? "text-default" : "StoryActionButtons"; ?>" href="<?php echo BASE_URL . "story/recommendStory/" . $feed->StoryId . "/" . (isset($feed->Opinion) && $feed->Opinion == TRUE ? "0" : "1"); ?>">
				            <span class="glyphicon glyphicon-thumbs-up"></span>
				        </a>
				        <span class="totalRecommendsSpan"><?php echo $feed->totalRecommends; ?></span>
				    </div>
				    <div style="float: left; padding-left: 10px;">
				        <a data-toggle="tooltip" title="<?php echo gettext("Flag as Inappropriate"); ?>" style="text-decoration: none;" data-request-type="<?php echo (isset($feed->Opinion) && $feed->Opinion == FALSE ? "0" : "1"); ?>" class="StoryFlagButton <?php echo (isset($feed->Opinion) && $feed->Opinion == FALSE) ? "text-danger" : "StoryActionButtons"; ?>" href="<?php echo BASE_URL . "story/flagInappropriate/" . $feed->StoryId . "/" . (isset($feed->Opinion) && $feed->Opinion == FALSE ? "0" : "1"); ?>">
				            <span class="glyphicon glyphicon-flag"></span> 
				        </a>
				        <span class="totalFlagsSpan"><?php echo $feed->totalFlags; ?></span>
				    </div>

				</div>
				<div style="clear: both;"></div>
			</div>
	  		<div class="col-lg-8 col-md-7">
	    		<h4><?php echo $feed->StoryTitle; ?></h4>
    			<?php echo getSubText($feed->Content); ?>
  			</div>
	
		</div>
	</div>
</div>  
<hr />