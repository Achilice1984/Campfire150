
<section class="storySummary">
	<h2 class="storyTitle"><?php echo $story->StoryTitle; ?></h2>
	<div class="row">
		<div class="col-md-4">
			<?php if ($story->StoryPrivacyType_StoryPrivacyTypeId == 1 && $story->ProfilePrivacyType_PrivacyTypeId == 1) { ?>				
			
			    <a href="<?php echo BASE_URL . "story/display/" . $story->StoryId; ?>">
			      	<img class="img-responsive" src="<?php echo image_get_path_basic($story->UserId, $story->PictureId, IMG_STORY, IMG_SMALL); ?>" alt="...">
			    </a>
			<?php } else { ?>
				<img class="img-responsive" src="<?php echo image_get_path_basic($story->UserId, $story->PictureId, IMG_STORY, IMG_SMALL); ?>" alt="...">
			<?php } ?>

			<div class="storyStats storyStatsDiv marginTop15 clearfix">
			    <div>
			    	<a data-toggle="tooltip" title="<?php echo gettext("Go to Comments"); ?>" href="<?php echo BASE_URL . "story/display/" . $story->StoryId; ?>#comments" class="StoryActionButtons">
				        <span class="glyphicon glyphicon-comment"></span>
				    </a> 
					<?php echo $story->totalComments; ?>
			    </div>
			    <div>
			    	<a data-toggle="tooltip" title="<?php echo gettext("Recommend Story"); ?>" data-request-type="<?php echo (isset($story->Opinion) && $story->Opinion == TRUE ? "0" : "1"); ?>" class="StoryRecommendButton <?php echo (isset($story->Opinion) && $story->Opinion == TRUE) ? "text-default" : "StoryActionButtons"; ?>" href="<?php echo BASE_URL . "story/recommendStory/" . $story->StoryId . "/" . (isset($story->Opinion) && $story->Opinion == TRUE ? "0" : "1"); ?>">
				        <span class="glyphicon glyphicon-thumbs-up"></span>
				    </a>
				    <span class="totalRecommendsSpan">
				    	<?php echo $story->totalRecommends; ?>
			    	</span>
			    </div>
			    <div>
			    	<a  data-toggle="tooltip" title="<?php echo gettext("Flag as Inappropriate"); ?>" data-request-type="<?php echo (isset($story->Opinion) && $story->Opinion == FALSE ? "0" : "1"); ?>" class="StoryFlagButton <?php echo (isset($story->Opinion) && $story->Opinion == FALSE) ? "text-danger" : "StoryActionButtons"; ?>" href="<?php echo BASE_URL . "story/flagInappropriate/" . $story->StoryId . "/" . (isset($story->Opinion) && $story->Opinion == FALSE ? "0" : "1"); ?>">
				        <span class="glyphicon glyphicon-flag"></span>
				    </a>
				    <span class="totalFlagsSpan">
				    	<?php echo $story->totalFlags; ?>
				    </span>
			    </div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="row">
				<p class="col-xs-6"><?php echo gettext("By:"); ?> <a href="<?php echo BASE_URL . "account/home/" . $story->UserId; ?>"><?php echo $story->FirstName . " " . $story->LastName; ?></a></p>
				<p class="col-xs-6 text-right"><?php echo gettext("Posted:") . " " . $story->DatePosted; ?></p>
			</div>
			<p>
				<?php echo getSubText($story->Content); ?>
				<a href="<?php echo BASE_URL . "story/display/" . $story->StoryId; ?>"><?php echo gettext("Continue Reading"); ?></a>
			</p>
			<div class="row">
				<div class="col-xs-6">
					<div class="form-group">
		    			<select class="form-control storyPrivacyDropDown" data-action="<?php echo BASE_URL . "account/changeStoryPrivacy/"; ?>" data-story-id="<?php echo $story->StoryId; ?>" name="StoryPrivacyType_StoryPrivacyTypeId">
		                    <?php 
		                        foreach ($privacyDropdownValues as $dropdownValue) {
		                            echo "<option " . ($story->StoryPrivacyType_StoryPrivacyTypeId == $dropdownValue->Value ? 'selected=selected' : "") . " value='" . $dropdownValue->Value . "'>"; 
		                                echo $dropdownValue->Name;
		                            echo "</option>";
		                        } 
		                    ?>
		                </select>
		            </div>
		        </div>
		        <div class="col-xs-6">
	                <a class="btn btn-primary btn-block" href="<?php echo BASE_URL . "story/edit/" . $story->StoryId; ?>"><?php echo gettext("Edit Story"); ?></a>
                </div>
            </div>
		</div>
	</div>
</section>