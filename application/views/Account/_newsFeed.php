<section class="storySummary">
	<h2 class="storyTitle"><?php echo $feed->StoryTitle; ?></h2>
	<div class="row">
		<div class="col-md-4">
		    <a href="<?php echo BASE_URL . "story/display/" . $feed->StoryId; ?>">
		      	<img class="img-responsive" src="<?php echo image_get_path_basic($feed->UserId, $feed->PictureId, IMG_STORY, IMG_SMALL); ?>" alt="...">
		    </a>
			<div class="storyStats storyStatsDiv marginTop15 clearfix">
			    <div>
			    	<a data-toggle="tooltip" title="<?php echo gettext("Go to Comments"); ?>" href="<?php echo BASE_URL . "story/display/" . $feed->StoryId; ?>#comments" class="StoryActionButtons">
				        <span class="glyphicon glyphicon-comment"></span>
				    </a> 
					<?php echo $feed->totalComments; ?>
			    </div>
			    <div>
			    	<a data-toggle="tooltip" title="<?php echo gettext("Recommend Story"); ?>" data-request-type="<?php echo (isset($feed->Opinion) && $feed->Opinion == TRUE ? "0" : "1"); ?>" class="StoryRecommendButton <?php echo (isset($feed->Opinion) && $feed->Opinion == TRUE) ? "text-default" : "StoryActionButtons"; ?>" href="<?php echo BASE_URL . "story/recommendStory/" . $feed->StoryId . "/" . (isset($feed->Opinion) && $feed->Opinion == TRUE ? "0" : "1"); ?>">
				        <span class="glyphicon glyphicon-thumbs-up"></span>
				    </a>
				    <span class="totalRecommendsSpan">
				    	<?php echo $feed->totalRecommends; ?>
			    	</span>
			    </div>
			    <div>
			    	<a data-toggle="tooltip" title="<?php echo gettext("Flag as Inappropriate"); ?>" data-request-type="<?php echo (isset($feed->Opinion) && $feed->Opinion == FALSE ? "0" : "1"); ?>" class="StoryFlagButton <?php echo (isset($feed->Opinion) && $feed->Opinion == FALSE) ? "text-danger" : "StoryActionButtons"; ?>" href="<?php echo BASE_URL . "story/flagInappropriate/" . $feed->StoryId . "/" . (isset($feed->Opinion) && $feed->Opinion == FALSE ? "0" : "1"); ?>">
				        <span class="glyphicon glyphicon-flag"></span>
				    </a>
				    <span class="totalFlagsSpan">
				    	<?php echo $feed->totalFlags; ?>
				    </span>
			    </div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="row">
				<p class="col-xs-6"><?php echo gettext("By:"); ?> <a href="<?php echo BASE_URL . "account/home/" . $feed->UserId; ?>"><?php echo $feed->FirstName . " " . $feed->LastName; ?></a></p>
				<p class="col-xs-6 text-right"><?php echo gettext("Posted:") . " " . $feed->DatePosted; ?></p>
			</div>
			<p>
				<?php echo getSubText($feed->Content); ?>
				<a href="<?php echo BASE_URL . "story/display/" . $feed->StoryId; ?>"><?php echo gettext("Continue Reading"); ?></a>
			</p>
		</div>
	</div>
</section>