<?php require_once(APP_DIR . 'helpers/image_get_path.php'); ?>

<div class="row StoryRowSection" style="padding:0px; padding-top: 10px;">

	<div class="col-md-12">	
		<div class="row">

			<div class="col-md-4 storyStatsDiv">
			    <a href="<?php echo BASE_URL . "story/display/" . $story->StoryId; ?>">
			      	<img style="width: 250px;" class="img-responsive" src="<?php echo image_get_path_basic($story->UserId, $story->PictureId, isset($story->Picturetype_PictureTypeId) ? $story->Picturetype_PictureTypeId : IMG_STORY, IMG_SMALL); ?>" alt="...">
			    </a>
			    <div style="font-size: 1.2em;" class="storyStatsContainer">
				    <div style="float: left; padding-left: 10px;">
				        <a style="text-decoration: none;" class="StoryActionButtons" href="#comments">
				            <span class="glyphicon glyphicon-comment"></span> 
				        </a>
				        <span class="totalCommentSpan"><?php echo $story->totalComments; ?></span>
				    </div>
				    <div style="float: left; padding-left: 10px;">
				        <a style="text-decoration: none;" data-request-type="<?php echo (isset($story->Opinion) && $story->Opinion == TRUE ? "0" : "1"); ?>" class="StoryRecommendButton <?php echo (isset($story->Opinion) && $story->Opinion == TRUE) ? "text-default" : "StoryActionButtons"; ?>" href="<?php echo BASE_URL . "story/recommendStory/" . $story->StoryId . "/" . (isset($story->Opinion) && $story->Opinion == TRUE ? "0" : "1"); ?>">
				            <span class="glyphicon glyphicon-thumbs-up"></span>
				        </a>
				        <span class="totalRecommendsSpan"><?php echo $story->totalRecommends; ?></span>
				    </div>
				    <div style="float: left; padding-left: 10px;">
				        <a style="text-decoration: none;" data-request-type="<?php echo (isset($story->Opinion) && $story->Opinion == FALSE ? "0" : "1"); ?>" class="StoryFlagButton <?php echo (isset($story->Opinion) && $story->Opinion == FALSE) ? "text-danger" : "StoryActionButtons"; ?>" href="<?php echo BASE_URL . "story/flagInappropriate/" . $story->StoryId . "/" . (isset($story->Opinion) && $story->Opinion == FALSE ? "0" : "1"); ?>">
				            <span class="glyphicon glyphicon-flag"></span> 
				        </a>
				        <span class="totalFlagsSpan"><?php echo $story->totalFlags; ?></span>
				    </div>

				</div>
				<div style="clear: both;"></div>
			</div>
	  		<div class="col-lg-8 col-md-7">
	    		<h4><?php echo $story->StoryTitle; ?></h4>
    			<?php echo substr($story->Content, 0, 255) . " ..."; ?>
  			</div>
	
		</div>
	</div>
</div>  
<hr />