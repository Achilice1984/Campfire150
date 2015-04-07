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

<div class="container">
        

    <img class="img-responsive" src="<?php echo image_get_path_basic($storyViewModel->UserId, $storyViewModel->PictureId, IMG_STORY, (IS_MOBILE ? IMG_SMALL : IMG_MEDIUM)); ?>" alt="<?php echo gettext("Story Picture"); ?>" />
    <div class="social">
        <div class="fb-like paddingTop15" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
        <div class="paddingTop15">
            <a href="https://twitter.com/share" class="twitter-share-button" data-via="Campfire150">Tweet</a>
        </div>
    </div>

    <h1><?php echo $storyViewModel->StoryTitle; ?></h1>

    <?php include(APP_DIR . "views/Story/_storyStats.php"); ?>

    <p class="h4">
        <?php 
            for ($i=0; $i < count($storyViewModel->Tags); $i++) { 
                echo '<span class="label label-primary">' . $storyViewModel->Tags[$i]->Tag . '</span>';

                if(count($storyViewModel->Tags) != $i + 1)
                {
                    echo " ";
                }
            }
        ?>
    </p>

    <div id="storyContentContainer">
        <?php echo $storyViewModel->Content; ?>
    </div>
    
    <div id="StorySignatureContainer">
        
        <?php include(APP_DIR . "views/Story/_storyStats.php"); ?>

        <hr />

        <article class="row">
            <div class="col-sm-2 col-xs-3">
                <figure class="thumbnail">
                    <a href="<?php echo BASE_URL . "account/home/" . $storyViewModel->UserId; ?>">
                        <img class="img-responsive" src="<?php echo image_get_path_basic($storyViewModel->UserId, $storyViewModel->UserProfilePicureId, IMG_PROFILE, IMG_XSMALL); ?>" />
                    </a>
                </figure>
            </div>
            <div class="col-sm-10 col-xs-9">
                <div class="row">
                    <p class="col-xs-6">
                        <?php echo gettext("By:") . " <a href='" . BASE_URL . "account/home/" . $storyViewModel->UserId . "'>" .$storyViewModel->UserProfile->FirstName . " " . $storyViewModel->UserProfile->LastName . "</a>"; ?>
                    </p>
                    <p class="col-xs-6 text-right">
                        <?php echo gettext("Posted:") . " " . date("M d, Y", strtotime($storyViewModel->DatePosted)); ?>
                    </p>
                </div>
                <p>
                    <?php echo isset($storyViewModel->ActionStatement) ? $storyViewModel->ActionStatement : ""; ?>                               
                </p>
                <?php
                    if(isset($storyViewModel->UserId) && $storyViewModel->UserId != $currentUser->UserId && $currentUser->IsAuth)
                    {
                        if(isset($storyViewModel->FollowingUser) && $storyViewModel->FollowingUser == TRUE)
                        {
                            echo '<button data-userId="' . $storyViewModel->UserId . '" data-additional-text="' . gettext("Follow") . '" data-ajaxurl="' . BASE_URL . 'account/follow" class="FollowButton btn btn-primary"><span class="glyphicon glyphicon-user"></span> ' . gettext("Following") . '</button>';
                        }
                        else
                        {
                            echo '<button data-userId="' . $storyViewModel->UserId . '" data-additional-text="' . gettext("Following") . '" data-ajaxurl="' . BASE_URL . 'account/follow" class="FollowButton btn btn-default"><span class="glyphicon glyphicon-user"></span> ' . gettext("Follow") . '</button>';
                        }
                    }
                ?> 
            </div>
        </article>

        <hr />

    </div>
    
    
    <a name="comments"></a>        
    <div style="display:none;" id="commentsContainer">

        <h2><?php echo gettext("Comments"); ?></h2>
        
        <?php if (isset($storyViewModel->Comments) && is_array($storyViewModel->Comments) && count($storyViewModel->Comments) > 0) { ?>
            <section id="comment-list">
                <?php 

                    foreach ($storyViewModel->Comments as $comment)
                    {
                        include(APP_DIR . "views/Story/_comments.php");
                    }           
                ?>  
            </section>

            <div class="alert alert-info" id="CommentInfoBar" role="alert" style="display:none;">
                <?php echo gettext("You have reached the end of the comments."); ?>
            </div>
            
            <input type="hidden" name="CommentPage" id="CommentPage" value="1">
            <input type="hidden" name="CommentUrl" id="CommentUrl" value="<?php echo BASE_URL; ?>story/getStoryComments">

            <div class="text-center" id="CommentStoryMoreButton" style="margin-bottom: 50px; <?php echo count($storyViewModel->Comments) <= 0 ? "display:none;" : "";  ?>">
                <?php include(APP_DIR . 'views/shared/_spinner_large.php'); ?>
                
                <button type="button" class="btn btn-warning btn-lg btn-block"><?php echo gettext("Show More Comments"); ?></button>
            </div>
        <?php } else { include(APP_DIR . "views/shared/noResults.php"); } ?>
        
        <?php if($currentUser->IsAuth) { ?>
            <form id="AddCommentForm" action="<?php echo BASE_URL; ?>story/addcomment" method="post">

                <input type="hidden" name="Story_StoryId" id="Story_StoryId" value="<?php echo $storyViewModel->StoryId; ?>">

                <?php include(APP_DIR . 'views/shared/messages.php'); ?>


                <div class="alert alert-success" id="CommentSubmitInfoBar" role="alert" style="display:none;">
                    <strong><?php echo gettext("Success:"); ?></strong> <?php echo gettext("Your comment was successfully submitted, and is now awaiting approval."); ?>
                </div>

                <div class="alert alert-danger" id="CommentSubmitInfoBarError" role="alert" style="display:none;">
                    <strong><?php echo gettext("Error:"); ?></strong> <?php echo gettext("An error occurred while attempting to save your comment."); ?>
                </div>

                <div class="form-group">
                    <!-- <label for="Content"><?php echo gettext("Comment"); ?></label> -->
                    <textarea class="form-control" id="Content" name="Content" rows="5" placeholder="<?php echo gettext("Enter A Comment"); ?>"></textarea>
                </div>

                <p class="clearfix"><button id="postCommentButton" class="btn btn-default pull-right"><?php echo gettext("Post A Comment"); ?></button></p>
                <div id="AddCommentSpinerDiv">
                    <?php include(APP_DIR . 'views/shared/_spinner_small.php'); ?>
                </div>
            </form>
        <?php } ?>
    </div>

    <p class="text-center" id="ShowCommentsButton">
        <button type="button" class="btn btn-warning btn-lg btn-block"><?php echo gettext("Show Story Comments"); ?></button>
    </p> 
    
</div>

<?php if(count($relatedStories) > 0 && !(count($relatedStories) == 1) && $relatedStories[0]->StoryId != $storyViewModel->StoryId) { ?>
    <div class="bg-grey marginBottom-15">
        <div class="container">
            <h2><?php echo gettext("Related Stories"); ?> <small><?php echo gettext("Keep on reading!"); ?></small></h2>
            <div id="StoryListContainer" class="row">
               <?php 
                    $totalRelatedStories = 0; 

                    foreach ($relatedStories as $story) {
                        
                        if($totalRelatedStories != MAX_RELATED_STORIES)
                        {
                            if($story->StoryId != $storyViewModel->StoryId) 
                            { 
                                include(APP_DIR . 'views/shared/_storyList.php'); 

                                $totalRelatedStories++;
                            }
                        }
                        else
                        {
                            break;
                        }                    
                    } 
               ?>
            </div>
        </div>
    </div>
<?php } ?>

<?php //debugit($storyViewModel); 

//debugit($relatedStories);?>