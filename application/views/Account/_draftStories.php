
<div class="row StoryRowSection" style="padding:0px; padding-top: 10px;">

	<div class="col-md-12">	
		<div class="row">

			<div class="col-md-4 storyStatsDiv">

		      	<img style="width: 250px;" class="img-responsive" src="<?php echo image_get_path_basic($story->User_UserId, $story->PictureId, IMG_STORY, IMG_SMALL); ?>" alt="...">

				<div style="clear: both;"></div>
			</div>
	  		<div class="col-lg-8 col-md-7">
	    		<h4><?php echo $story->StoryTitle; ?></h4>
    			<?php echo getSubText($story->Content); ?>

    			<div style="padding-top: 5px;" class="row">
					<a class="btn btn-primary" href="<?php echo BASE_URL . "story/publish/" . $story->StoryId; ?>"><?php echo gettext("Publish"); ?></a>
					<a class="btn btn-warning" href="<?php echo BASE_URL . "story/edit/" . $story->StoryId; ?>"><?php echo gettext("Edit"); ?></a>
				</div>
  			</div>
	
		</div>
	</div>
</div>  
<hr />