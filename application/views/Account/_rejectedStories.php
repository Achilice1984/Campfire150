<?php require_once(APP_DIR . 'helpers/image_get_path.php'); ?>

<div class="row StoryRowSection" style="padding:0px; padding-top: 10px;">

	<div class="col-md-12">	
		<div class="row">

			<div class="col-md-4 storyStatsDiv">
			    <a href="<?php echo BASE_URL . "story/display/" . $story->StoryId; ?>">
			      	<img style="width: 250px;" class="img-responsive" src="<?php echo image_get_path_basic($story->UserId, $story->PictureId, isset($story->Picturetype_PictureTypeId) ? $story->Picturetype_PictureTypeId : IMG_STORY, IMG_SMALL); ?>" alt="...">
			    </a>
			</div>
	  		<div class="col-lg-8 col-md-7">
	    		<h4><?php echo $story->StoryTitle; ?></h4>
    			<?php echo substr($story->Content, 0, 255) . " ..."; ?>
  			</div>
	
		</div>
	</div>
</div>  
<hr />