
<div class="row StoryRowSection" style="padding:0px; padding-top: 10px;">

	<div class="col-md-12">	
		<div class="row">

			<div class="col-md-4 storyStatsDiv">

		      	<img style="width: 250px;" class="img-responsive" src="<?php echo image_get_path_basic($story->User_UserId, $story->PictureId, IMG_STORY, IMG_SMALL); ?>" alt="...">

			</div>
	  		<div class="col-lg-8 col-md-7">
	    		<h4><?php echo $story->StoryTitle; ?></h4>
    			<?php echo getSubText($story->Content); ?>

    			<h4><?php echo gettext("Reason"); ?></h4>
    			<?php echo $story->Reason; ?>
  			</div>
	
		</div>
	</div>
</div>  
<hr />