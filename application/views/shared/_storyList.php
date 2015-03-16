<!-- <div class="col-md-4 col-sm-6">
    <div class="thumbnail">
        <h2 style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo $story->StoryTitle; ?>asasdadasdasdasdasd</h2>
        <div class="thumbnailContainer">
	        <a style="" href="#">
	            <img src="http://placekitten.com/g/600/400" class=" img-responsive" alt="" />
	            <span class="text-content"><span><?php echo $story->StoryTitle; ?></span></span>
	        </a>
        </div>
    </div>
</div>

 -->


<?php require_once(APP_DIR . 'helpers/image_get_path.php'); ?>


 <div style="min-width: 350px;" class="col-lg-4 col-md-6 col-sm-6">
 	<h2 style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-size: 1.8em;"><?php echo $story->StoryTitle; ?></h2>
    <div  class="thumbnail">
        
        <div class="caption">
            <h4><?php echo $story->StoryTitle; ?></h4>
            <div style="padding-left: 15px; font-size: 1.2em;" class="storyStatsContainer row">
			    <div style="float: left; padding-left: 10px;">
			        <span class="glyphicon glyphicon-comment"></span> 
			        <span class="totalCommentSpan"><?php echo $story->totalComments; ?></span>
			    </div>
			    <div style="float: left; padding-left: 10px;">
			        <span class="glyphicon glyphicon-thumbs-up"></span>
			        <span class="totalRecommendsSpan"><?php echo $story->totalRecommends; ?></span>
			    </div>
			    <div style="float: left; padding-left: 10px;">
			        <span class="glyphicon glyphicon-flag"></span> 
			        <span class="totalFlagsSpan"><?php echo $story->totalFlags; ?></span>
			    </div>
			</div>
			<div class="responsive_content" style="display:block; width:100%; margin-top: 10px;">
				<?php echo substr($story->Content, 0, 255) . " ..."; ?>
			</div>
            <p style="display: block; position: absolute; bottom: 0; width: 100%; padding-right: 18px;">
            	<a style="width: 100%;" href="<?php echo BASE_URL . "story/display/" . $story->StoryId; ?>" class="btn btn-warning"><?php echo gettext("Read"); ?></a>
            </p>
        </div>
		
		<a href="<?php echo BASE_URL . "story/display/" . $story->StoryId; ?>">
        	<img style="min-height: 203px;" class=" img-responsive" src="<?php echo image_get_path_basic($story->UserId, $story->PictureId, isset($story->Picturetype_PictureTypeId) ? $story->Picturetype_PictureTypeId : IMG_STORY, IMG_MEDIUM); ?>"  alt="" />
    	</a>
    </div>
</div>