
<div class="storyStats storyStatsDiv marginTop15 clearfix h4">
    <div>
        <a data-toggle="tooltip" title="<?php echo gettext("Go to Comments"); ?>" href="<?php echo BASE_URL . "story/display/" . $storyViewModel->StoryId; ?>#comments" class="StoryActionButtons">
            <span class="glyphicon glyphicon-comment"></span>
        </a> 
        <?php echo $storyViewModel->totalComments; ?>
    </div>
    <div>
        <a data-toggle="tooltip" title="<?php echo gettext("Recommend Story"); ?>" data-request-type="<?php echo (isset($storyViewModel->Opinion) && $storyViewModel->Opinion == TRUE ? "0" : "1"); ?>" class="StoryRecommendButton <?php echo (isset($storyViewModel->Opinion) && $storyViewModel->Opinion == TRUE) ? "text-default" : "StoryActionButtons"; ?>" href="<?php echo BASE_URL . "story/recommendStory/" . $storyViewModel->StoryId . "/" . (isset($storyViewModel->Opinion) && $storyViewModel->Opinion == TRUE ? "0" : "1"); ?>">

            <span class="glyphicon glyphicon-thumbs-up"></span>
        </a>
        <span class="totalRecommendsSpan">
            <?php echo $storyViewModel->totalRecommends; ?>
        </span>
    </div>

    <div>
        <a  data-toggle="tooltip" title="<?php echo gettext("Flag as Inappropriate"); ?>" data-request-type="<?php echo (isset($storyViewModel->Opinion) && $storyViewModel->Opinion == FALSE ? "0" : "1"); ?>" class="StoryFlagButton <?php echo (isset($storyViewModel->Opinion) && $storyViewModel->Opinion == FALSE) ? "text-danger" : "StoryActionButtons"; ?>" href="<?php echo BASE_URL . "story/flagInappropriate/" . $storyViewModel->StoryId . "/" . (isset($storyViewModel->Opinion) && $storyViewModel->Opinion == FALSE ? "0" : "1"); ?>">
            <span class="glyphicon glyphicon-flag"></span>
        </a>
        <span class="totalFlagsSpan">
            <?php echo $storyViewModel->totalFlags; ?>
        </span>
    </div>
</div>