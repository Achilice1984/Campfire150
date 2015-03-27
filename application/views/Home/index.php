<script type="text/javascript">
    var WordCloudWords = <?php echo $homeViewModel->WordCloud; ?>
</script>

        <section>
            <div class="container">

                <?php include(APP_DIR . 'views/shared/messages.php'); ?>
                <nav role="navigation">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-request-url="<?php echo BASE_URL; ?>home/latestStoryHome" id="latestStoryListButton" href="#"><?php echo gettext("Latest"); ?></a></li>
                        <li><a data-request-url="<?php echo BASE_URL; ?>home/recommendedStoryHome" id="recommendedStoryListButton" href="#"><?php echo gettext("Recomended"); ?></a></li>
                        <li role="presentation" class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
                                <?php echo gettext("By Category"); ?> <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <?php foreach ($homeViewModel->ChallengesList as $challenge): ?>
                                    <li><a data-request-url="<?php echo BASE_URL; ?>home/storiesByCategory" class="categoryListButton" data-challengeId="<?php echo $challenge->AnswerId; ?>" href="#"><?php echo ($currentUser->LanguagePreference == "en_CA" ? $challenge->NameE : $challenge->NameF); ?></a></li>
                                <?php endforeach ?>                                
                            </ul>
                        </li>
                    </ul>
                </nav>
                
                <div id="storyListRow" class="row">
                    <?php include(APP_DIR . 'views/shared/_spinner_large.php'); ?>

                    <div id="StoryListContainer">
                        <?php foreach ($homeViewModel->LatestStories as $story): ?>
                           <?php include(APP_DIR . 'views/shared/_storyList.php') ?>
                        <?php endforeach ?>
                    </div>
                </div>
                <p class="clearfix"><a href="<?php echo BASE_URL; ?>story/search" class="btn btn-warning pull-right"><?php echo gettext("View More Stories"); ?></a></p>
            </div>
        </section>
        <section class="bg-grey text-center jumbotron marginBottom-15">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3 col-xs-6">
                        <p class="h1"><?php echo $homeViewModel->totalPublishedStories; ?></p>
                        <p><?php echo gettext("Stories"); ?></p>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <p class="h1"><?php echo $homeViewModel->totalActiveUsers; ?></p>
                        <p><?php echo gettext("Users"); ?></p>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <p class="h1"><?php echo $homeViewModel->totalPublishedComments; ?></p>
                        <p><?php echo gettext("Comments"); ?></p>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <p class="h1"><?php echo $homeViewModel->totalRecommendations; ?></p>
                        <p><?php echo gettext("Recommendations"); ?></p>
                    </div>
                </div>
            </div>
        </section>
        
        <section style="padding-top: 20px; padding-bottom: 20px;" class="bg-blue marginBottom-15">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <canvas id="wordCloudCanvas" height="400" width="500"></canvas> 
                    </div>
                    <div style="" class="col-md-6">
                        <h1><?php echo gettext("How the Campfire Works"); ?></h1>
                        <ol style="font-size: 1.4em; padding-bottom: 25px;">
                            <li><?php echo gettext("Submit a story"); ?></li>
                            <li><?php echo gettext("Answer some simple questions"); ?></li>
                            <li><?php echo gettext("We all create a national story"); ?></li>
                            <li><?php echo gettext("Repeat"); ?></li>
                        </ol>
                        <p style=""><a href="<?php echo BASE_URL; ?>story/add" class="btn btn-warning btn-lg btn-block"><?php echo gettext("Share a Story"); ?></a></p>
                    </div>
                </div>
            </div>
        </section>
        <section class="hidden-xs">
            <input type="hidden" id="END_DATE" value="<?php echo strtotime(COUNTDOWN_END); ?>">
            <input type="hidden" id="NOW_DATE" value="<?php echo strtotime("now"); ?>">

            <?php include(APP_DIR . 'views/Home/_countdown.php') ?>
        </section>
    