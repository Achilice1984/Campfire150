<script type="text/javascript">
    var WordCloudWords = <?php echo $homeViewModel->WordCloud; ?>
</script>
    
<?php 
    //Add error message block to the page
    include(APP_DIR . 'views/shared/displayErrors.php'); 

    //Add success message block to the page
    include(APP_DIR . 'views/shared/displaySuccess.php'); 
?>

        <section>
            <div class="container">
                <h1>Campfire Stories</h1>
                <nav role="navigation">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#">Latest</a></li>
                        <li><a href="#">Recomended</a></li>
                        <li role="presentation" class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
                                By Category <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Art</a></li>
                                <li><a href="#">Weather</a></li>
                                <li><a href="#">Family</a></li>
                                <li><a href="#">Technology</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="thumbnail">
                            <h2>Image Title</h2>
                            <a href="#">
                                <img src="http://placekitten.com/g/600/400" class=" img-responsive" alt="" />
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="thumbnail">
                            <h2>Image Title</h2>
                            <a href="#">
                                <img src="http://placekitten.com/g/600/400" class=" img-responsive" alt="" />
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="thumbnail">
                            <h2>Image Title</h2>
                            <a href="#">
                                <img src="http://placekitten.com/g/600/400" class=" img-responsive" alt="" />
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 hidden-xs">
                        <div class="thumbnail">
                            <h2>Image Title</h2>
                            <a href="#">
                                <img src="http://placekitten.com/g/600/400" class=" img-responsive" alt="" />
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 hidden-sm hidden-xs">
                        <div class="thumbnail">
                            <h2>Image Title</h2>
                            <a href="#">
                                <img src="http://placekitten.com/g/600/400" class=" img-responsive" alt="" />
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 hidden-sm hidden-xs">
                        <div class="thumbnail">
                            <h2>Image Title</h2>
                            <a href="#">
                                <img src="http://placekitten.com/g/600/400" class=" img-responsive" alt="" />
                            </a>
                        </div>
                    </div>
                </div>
                <p class="clearfix"><a href="#" class="btn btn-warning pull-right">View More Stories</a></p>
            </div>
        </section>
        <section class="bg-grey text-center text-xl padding-xl">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3 col-xs-6">
                        <p class="h1">XX</p>
                        <p>Stat</p>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <p class="h1">XX</p>
                        <p>Stat</p>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <p class="h1">XX</p>
                        <p>Stat</p>
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <p class="h1">XX</p>
                        <p>Stat</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="bg-blue">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <canvas id="wordCloudCanvas"></canvas> 
                    </div>
                    <div class="col-md-6">
                        <h1>How the Campfire Works</h1>
                        <ol>
                            <li>Submit a story</li>
                            <li>Answer some simple questions</li>
                            <li>We all create a national story</li>
                            <li>Repeat</li>
                        </ol>
                        <p><a href="#" class="btn btn-warning btn-lg btn-block">Share a Story</a></p>
                    </div>
                </div>
            </div>
        </section>
    