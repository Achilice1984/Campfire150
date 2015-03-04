<script type="text/javascript">
    var WordCloudWords = <?php echo $homeViewModel->WordCloud; ?>;
</script>   

<div class="container">

    <h1>Campfire 150 | Home</h1>
    
    <?php 
        //Add error message block to the page
        include(APP_DIR . 'views/shared/displayErrors.php'); 

        //Add success message block to the page
        include(APP_DIR . 'views/shared/displaySuccess.php'); 
    ?>

    <div class="row">
        <a href="<?php echo BASE_URL . "account/search/"; ?>">Users</a>    
        <br />
        <a href="<?php echo BASE_URL . "story/search/"; ?>">Stories</a>    
        <br />
        <a href="<?php echo BASE_URL . "home/about/"; ?>">About</a>
        <br />
        <a href="<?php echo BASE_URL . "home/domore/"; ?>">Do More</a>
        <br />
        <a href="<?php echo BASE_URL . "story/add/"; ?>">Write a Story</a>
    </div>

    <div class="row">
         <canvas id="wordCloudCanvas" width="500" height="400"></canvas> 
    </div>
</div>
    