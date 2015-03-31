<div style="padding-left: 15px; font-size: 1.2em;" class="storyStatsContainer row">
    <div style="float: left; padding-left: 10px;">
        <a data-toggle="tooltip" title="<?php echo gettext("Total Comments"); ?>" style="text-decoration: none;" class="StoryActionButtons" href="#comments">
            <span class="glyphicon glyphicon-comment"></span> 
        </a>
        <span class="totalCommentSpan"><?php echo $storyViewModel->totalComments; ?></span>
    </div>
    <div style="float: left; padding-left: 10px;">
        <a data-toggle="tooltip" title="<?php echo gettext("Total Recommends"); ?>" style="text-decoration: none;" data-request-type="<?php echo (isset($storyViewModel->Opinion) && $storyViewModel->Opinion == TRUE ? "0" : "1"); ?>" class="StoryRecommendButton <?php echo (isset($storyViewModel->Opinion) && $storyViewModel->Opinion == TRUE) ? "text-default" : "StoryActionButtons"; ?>" href="<?php echo BASE_URL . "story/recommendStory/" . $storyViewModel->StoryId . "/" . (isset($storyViewModel->Opinion) && $storyViewModel->Opinion == TRUE ? "0" : "1"); ?>">
            <span class="glyphicon glyphicon-thumbs-up"></span>
        </a>
        <span class="totalRecommendsSpan"><?php echo $storyViewModel->totalRecommends; ?></span>
    </div>
    <div style="float: left; padding-left: 10px;">
        <a data-toggle="tooltip" title="<?php echo gettext("Total Inappropriate Comments"); ?>" style="text-decoration: none;" data-request-type="<?php echo (isset($storyViewModel->Opinion) && $storyViewModel->Opinion == FALSE ? "0" : "1"); ?>" class="StoryFlagButton <?php echo (isset($storyViewModel->Opinion) && $storyViewModel->Opinion == FALSE) ? "text-danger" : "StoryActionButtons"; ?>" href="<?php echo BASE_URL . "story/flagInappropriate/" . $storyViewModel->StoryId . "/" . (isset($storyViewModel->Opinion) && $storyViewModel->Opinion == FALSE ? "0" : "1"); ?>">
            <span class="glyphicon glyphicon-flag"></span> 
        </a>
        <span class="totalFlagsSpan"><?php echo $storyViewModel->totalFlags; ?></span>
    </div>

</div>