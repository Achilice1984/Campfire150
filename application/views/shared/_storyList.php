<?php require_once(APP_DIR . 'helpers/image_get_path.php'); ?>


 <div class="col-md-4 col-sm-6">
 	<h2 class="storyTitle"><?php echo $story->StoryTitle; ?></h2>
    <div  class="thumbnail">
        
        <div class="caption">
        	<div class="storyStats clearfix">
			    <div>
			        <span class="glyphicon glyphicon-comment"></span> 
			        <?php echo $story->totalComments; ?>
			    </div>
			    <div>
			        <span class="glyphicon glyphicon-thumbs-up"></span>
			        <?php echo $story->totalRecommends; ?>
			    </div>
			    <div>
			        <span class="glyphicon glyphicon-flag"></span> 
			        <?php echo $story->totalFlags; ?>
			    </div>
			</div>
			<div>
				<?php echo substr($story->Content, 0, 245) . " ..."; ?>
			</div>
            <p class="readBtn">
            	<a href="<?php echo BASE_URL . "story/display/" . $story->StoryId; ?>" class="btn btn-warning btn-block"><?php echo gettext("Read"); ?></a>
            </p>
        </div>
		
		<a href="<?php echo BASE_URL . "story/display/" . $story->StoryId; ?>">
        	<img style="min-height: 203px;" class=" img-responsive" src="<?php echo image_get_path_basic($story->UserId, $story->PictureId, isset($story->Picturetype_PictureTypeId) ? $story->Picturetype_PictureTypeId : IMG_STORY, IMG_MEDIUM); ?>"  alt="" />
    	</a>

    </div>
</div>