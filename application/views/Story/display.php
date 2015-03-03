<?php

    //You have access to the shared/StoryViewModel.php
    
    //You can access everything from this variable:
    //uncomment to view structure in browser

	//debugit($storyQuestions);
    debugit($storyViewModel);
    //debugit($relatedStories);

?>
<?php echo $storyViewModel->StoryTitle; ?>
<h1>Display Story</h1>

<div class="col-md-6"> 

    <form action="<?php echo BASE_URL; ?>story/addcomment" method="post">

    	<input type="hidden" name="Story_StoryId" value="<?php echo $storyViewModel->StoryId; ?>">

        <?php 
            //Add error message block to the page
            include(APP_DIR . 'views/shared/displayErrors.php'); 

            //Add success message block to the page
            include(APP_DIR . 'views/shared/displaySuccess.php'); 
        ?>

        <div class="form-group">
            <label for="Content"><?php echo gettext("Comment"); ?></label>
            <textarea class="form-control" id="Content" name="Content" placeholder="<?php echo gettext("Enter A Comment"); ?>"> </textarea>
        </div>

        <button type="submit" class="btn btn-default"><?php echo gettext("Submit"); ?></button>
    </form>
</div>