<?php
	$showSearch = isset($_GET["search"]);
?>

<div class="container">
	<ul class="nav nav-tabs marginBottom15">
		<li role="presentation" <?php echo (!$showSearch ? "class='active'" : "" ); ?>><a href="#Story_Latest" aria-controls="Story_Latest" role="tab" data-toggle="tab"><?php echo gettext("Latest"); ?></a></li>
	    <li role="presentation"><a href="#Story_Recommended" aria-controls="Story_Recommended" role="tab" data-toggle="tab"><?php echo gettext("Most Recommended"); ?></a></li>
	    <li role="presentation" <?php echo ($showSearch ? "class='active'" : "" ); ?>><a href="#Story_Search" aria-controls="Story_Search" role="tab" data-toggle="tab"><?php echo gettext("Search"); ?></a></li>
	</ul>
	
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane <?php echo (!$showSearch ? "active" : "" ); ?>" id="Story_Latest">
			<div id="LatestStoryContainer">
				<?php 
					foreach ($latestResults as $story)
					{
						include(APP_DIR . "views/Story/_searchPanel.php");
					}			
				?>  
			</div> 
			
			<div class="alert alert-info alert-dismissible" id="LatestStoryhInfoBar" role="alert" style="display:none;">
		  		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  		<strong><?php echo gettext("Info!"); ?></strong> <?php echo gettext("You have reached the end of your search results."); ?>
			</div>

			<input type="hidden" name="LatestStoryPage" id="LatestStoryPage" value="1">
			<input type="hidden" name="LatestStoryUrl" id="LatestStoryUrl" value="<?php echo BASE_URL; ?>story/lateststories">

			<div id="LatestStoryMoreButton">
				<?php include(APP_DIR . 'views/shared/_spinner_large.php'); ?>	

				<button type="button" class="ShowMoreButton btn btn-warning btn-lg btn-block"><?php echo gettext("Show More Stories"); ?></button>
			</div>
		</div>

	
	    <div role="tabpanel" class="tab-pane <?php echo ($showSearch ? "active" : "" ); ?>" id="Story_Search">
			<form action="<?php echo BASE_URL; ?>story/search" data-ajax-action="<?php echo BASE_URL; ?>story/ajaxSearch" id="StorySearchForm" method="post">
				<input type="hidden" name="StorySearchPage" id="StorySearchPage" value="1">

				<div class="input-group">
		            <input type="text" name="StorySearch" id="StorySearch" value="<?php echo (isset($_POST["StorySearch"]) ? $_POST["StorySearch"] : ""); ?>" class="form-control" placeholder="<?php echo gettext("Search Stories"); ?>">
		            <div class="input-group-btn">
		                <button id="StorySearchButton" class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
		            </div>
		        </div>						
			</form>		
			<div id="StorySearchContainer">
				<?php 
					foreach ($searchResults as $story)
					{
						include(APP_DIR . "views/Story/_searchPanel.php");
					}			
				?>  
			</div> 
			
			<div class="alert alert-info alert-dismissible" id="StorySearchInfoBar" role="alert" style="display:none;">
		  		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  		<strong><?php echo gettext("Info!"); ?></strong> <?php echo gettext("You have reached the end of your search results."); ?>
			</div>

			<div id="StorySearchMoreButton" style="<?php echo count($searchResults) <= 0 ? "display:none;" : "" ?>">
				<?php include(APP_DIR . 'views/shared/_spinner_large.php'); ?>	

				<button type="button" class="ShowMoreButton btn btn-warning btn-lg btn-block"><?php echo gettext("Show More Stories"); ?></button>
			</div>
	    </div>  <!-- <div role="tabpanel" class="tab-pane active" id="Story_Search"> -->


	    <div role="tabpanel" class="tab-pane" id="Story_Recommended">

			<div id="RecommendedStoryContainer">
				<?php 
					foreach ($mostRecommendedResults as $story)
					{
						include(APP_DIR . "views/Story/_searchPanel.php");
					}			
				?>  
			</div> 
			
			<div class="alert alert-info alert-dismissible" id="RecommendedStoryInfoBar" role="alert" style="display:none;">
		  		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  		<strong><?php echo gettext("Info!"); ?></strong> <?php echo gettext("You have reached the end of your search results."); ?>
			</div>
			
			<input type="hidden" name="RecommendedStoryPage" id="RecommendedStoryPage" value="1">
			<input type="hidden" name="RecommendedStoryUrl" id="RecommendedStoryUrl" value="<?php echo BASE_URL; ?>story/recommendedstories">

			<div id="RecommendedStoryMoreButton">
				<?php include(APP_DIR . 'views/shared/_spinner_large.php'); ?>	

				<button type="button" class="ShowMoreButton btn btn-warning btn-lg btn-block"><?php echo gettext("Show More Stories"); ?></button>
			</div>
	    </div>   <!-- <div role="tabpanel" class="tab-pane active" id="Story_Recommended"> --> 
	</div>  
</div>
<?php //debugit($searchResults); ?>