
<div class="row StoryRowSection" style="padding:0px; padding-top: 10px;">

	<div class="col-md-12">	
		<div class="row">

			<div class="col-md-4 storyStatsDiv">
			    <a href="<?php echo BASE_URL . "story/display/" . $story->StoryId; ?>">
			      	<img style="width: 250px;" class="img-responsive" src="<?php echo image_get_path_basic($story->UserId, $story->PictureId, IMG_STORY, IMG_SMALL); ?>" alt="...">
			    </a>
			    
				<div style="clear: both;"></div>
			</div>
	  		<div class="col-lg-8 col-md-7">
	    		<h4><?php echo $story->StoryTitle; ?></h4>
    			<?php echo getSubText($story->Content); ?>

    			<div style="clear:both;"></div>
				
				<div class="form-group col-md-6">
	    			<select class="form-control storyPrivacyDropDown" data-action="<?php echo BASE_URL . "account/changeStoryPrivacy/"; ?>" data-story-id="<?php echo $story->StoryId; ?>" name="StoryPrivacyType_StoryPrivacyTypeId" style="margin-left: -15px; margin-top: 10px;">
	                    <?php 
	                        foreach ($privacyDropdownValues as $dropdownValue) {
	                            echo "<option " . ($story->StoryPrivacyType_StoryPrivacyTypeId == $dropdownValue->Value ? 'selected=selected' : "") . " value='" . $dropdownValue->Value . "'>"; 
	                                echo $dropdownValue->Name;
	                            echo "</option>";
	                        } 
	                    ?>
	                </select>

	                <a style="width: 100%; margin-left: -15px; margin-top: 10px;" class="btn btn-warning" href="<?php echo BASE_URL . "story/edit/" . $story->StoryId; ?>"><?php echo gettext("Edit"); ?></a>
                </div>
  			</div>
	
		</div>
	</div>
</div>  
<hr />