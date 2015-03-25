<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=1552763704998872&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>


<?php

    //You have access to the shared/StoryViewModel.php
    
    //You can access everything from this variable:
    //uncomment to view structure in browser

	//debugit($storyQuestions);
    //debugit($storyViewModel);
    //debugit($relatedStories);

?>

<div class="container" style="padding-top: 50px; padding-bottom: 50px;">  
    
    <div class="col-md-12"> 
        

        <img style="width: 1200px;" class="img-responsive img-rounded" src="<?php echo $storyViewModel->Images["PictureUrl"]; ?>" alt="<?php echo gettext("Story Picture"); ?>" />

        <div style="padding-top: 5px;"></div>
        <div class="fb-like" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
        
        <div style="margin-top: 5px;">
            <a href="https://twitter.com/share" class="twitter-share-button" data-via="Campfire150">Tweet</a>
        </div>

        <h1 style="font-size: 4em; font-weight: bold;"><?php echo $storyViewModel->StoryTitle; ?></h1>

        <?php include(APP_DIR . "views/Story/_storyStats.php"); ?>

        <div style="padding: 10px; font-size: 1.2em; font-style: italic;">
            <?php 
                for ($i=0; $i < count($storyViewModel->Tags); $i++) { 
                    echo $storyViewModel->Tags[$i]->Tag;

                    if(count($storyViewModel->Tags) != $i + 1)
                    {
                        echo ", ";
                    }
                }
            ?>
        </div>

        <div style="font-size: 1.5em; line-height: 180%; color: #444444; font-family: 'Georgia', serif; margin-top: 20px;" id="storyContentContainer">
            <?php echo $storyViewModel->Content; ?>
        </div>
        
        <div style="margin-top: 50px;" id="StorySignatureContainer">
            
            <?php include(APP_DIR . "views/Story/_storyStats.php"); ?>

            <hr />

            <article class="row">
                <div class="col-md-2 col-sm-2 hidden-xs">
                    <figure class="thumbnail">
                        <a href="<?php echo BASE_URL . "account/home/" . $storyViewModel->UserId; ?>">
                            <img class="img-responsive" style="height: 150px;" src="<?php echo image_get_path_basic($storyViewModel->UserId, $storyViewModel->UserProfilePicureId, IMG_PROFILE, IMG_XSMALL); ?>" />
                        </a>
                    </figure>
                </div>
                <div style="padding-top: 25px; font-size: 1.2em;" class="col-md-8 col-sm-8">
                    
                    <div class="row">
                        <?php echo gettext("Posted On:") . " " . $storyViewModel->DatePosted; ?>
                    </div>
                    <div style="font-size: 1.5em; font-weight: bold;" class="row">
                        <?php echo $storyViewModel->UserProfile->FirstName . " " . $storyViewModel->UserProfile->LastName; ?>
                    </div>
                    <div class="row" style="padding-top: 20px; font-style: italic;">
                        <?php echo isset($storyViewModel->ActionStatement) ? $storyViewModel->ActionStatement : ""; ?>                               
                    </div>
                </div>
                <div style="padding-top: 60px; font-size: 1.2em;" class="col-md-2 col-sm-2">
                    <?php
                        if(isset($storyViewModel->UserId) && $storyViewModel->UserId != $currentUser->UserId && $currentUser->IsAuth)
                        {
                            if(isset($storyViewModel->FollowingUser) && $storyViewModel->FollowingUser == TRUE)
                            {
                                echo '<button data-userId="' . $storyViewModel->UserId . '" data-additional-text="' . gettext("Follow") . '" data-ajaxurl="' . BASE_URL . 'account/follow" class="FollowButton btn btn-primary btn-lg"><span class="glyphicon glyphicon-user"></span> ' . gettext("Following") . '</button>';
                            }
                            else
                            {
                                echo '<button data-userId="' . $storyViewModel->UserId . '" data-additional-text="' . gettext("Following") . '" data-ajaxurl="' . BASE_URL . 'account/follow" class="FollowButton btn btn-default btn-lg"><span class="glyphicon glyphicon-user"></span> ' . gettext("Follow") . '</button>';
                            }
                        }
                    ?>
                    
                </div>
            </article>

            <hr />

        </div>
        
        
        <a name="comments"></a>        
        <div style="display:none;" id="commentsContainer">

            <h2 style="margin-top: 40px;"><?php echo gettext("Comments"); ?></h2>

            <section id="comment-list">
                <?php 

                    foreach ($storyViewModel->Comments as $comment)
                    {
                        include(APP_DIR . "views/Story/_comments.php");
                    }           
                ?>  
            </section>

            <div class="alert alert-info alert-dismissible" id="CommentInfoBar" role="alert" style="display:none;">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong><?php echo gettext("Info!"); ?></strong> <?php echo gettext("You have reached the end of the comments."); ?>
            </div>
            
            <input type="hidden" name="CommentPage" id="CommentPage" value="1">
            <input type="hidden" name="CommentUrl" id="CommentUrl" value="<?php echo BASE_URL; ?>story/getStoryComments">

            <div class="row text-center" id="CommentStoryMoreButton" style="margin-bottom: 50px; <?php echo count($storyViewModel->Comments) <= 0 ? "display:none;" : "";  ?>">
                <button type="button" class="btn btn-default btn-lg" style="background-color: orange; color:white; width:100%;"><?php echo gettext("Show More Comments!"); ?></button>
            </div>
            
            <?php if($currentUser->IsAuth) { ?>
                <form id="AddCommentForm" action="<?php echo BASE_URL; ?>story/addcomment" method="post">

                    <input type="hidden" name="Story_StoryId" id="Story_StoryId" value="<?php echo $storyViewModel->StoryId; ?>">

                    <?php include(APP_DIR . 'views/shared/messages.php'); ?>


                    <div class="alert alert-success" id="CommentSubmitInfoBar" role="alert" style="display:none;">
                        <strong><?php echo gettext("Success!"); ?></strong> <?php echo gettext("Your comment was successfully submitted, and is now awaiting approval."); ?>
                    </div>

                    <div class="alert alert-danger" id="CommentSubmitInfoBarError" role="alert" style="display:none;">
                        <strong><?php echo gettext("Error!"); ?></strong> <?php echo gettext("An error occurred while attempting to save your comment."); ?>
                    </div>

                    <div class="form-group">
                        <!-- <label for="Content"><?php echo gettext("Comment"); ?></label> -->
                        <textarea class="form-control" id="Content" name="Content" placeholder="<?php echo gettext("Enter A Comment"); ?>"> </textarea>
                    </div>

                    <button id="postCommentButton" class="btn btn-default"><?php echo gettext("Post A Comment"); ?></button>
                </form>
            <?php } ?>
        </div>

        <div class="row text-center" id="ShowCommentsButton" style="margin-top: 50px;">
            <button type="button" class="btn btn-default btn-lg" style="background-color: orange; color:white; width:100%;"><?php echo gettext("Show Story Comments!"); ?></button>
        </div>       
        
    </div>
    
</div>

<?php if(count($relatedStories) > 0 && !(count($relatedStories) == 1) && $relatedStories[0]->StoryId != $storyViewModel->StoryId) { ?>
    <div class="bg-grey padding-xl">
        <div class="container">
            <h2 style="font-size: 3em;"><?php echo gettext("Related Stories"); ?><small> <?php echo gettext("keep on reading!"); ?></small></h2>
            <div id="StoryListContainer" class="row">
               <?php foreach ($relatedStories as $story): ?>
                   <?php if($story->StoryId != $storyViewModel->StoryId) { include(APP_DIR . 'views/shared/_storyList.php'); } ?>
               <?php endforeach ?>
            </div>
        </div>
    </div>
<?php } ?>

<?php //debugit($storyViewModel); 

//debugit($relatedStories);?>