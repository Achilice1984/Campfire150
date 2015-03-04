
<div class="container">
	<ul class="nav nav-pills storySearchBar">
	    <li role="presentation" class="active"><a href="#Story_Search" aria-controls="Story_Search" role="tab" data-toggle="tab">Search</a></li>
	    <li role="presentation"><a href="#Story_Recommended" aria-controls="Story_Recommended" role="tab" data-toggle="tab">Most Recommended</a></li>
	    <li role="presentation"><a href="#Story_Latest" aria-controls="Story_Latest" role="tab" data-toggle="tab">Latest</a></li>
	</ul>   

	<div class="tab-content" style="padding:20px;">
	    <div role="tabpanel" class="tab-pane active" id="Story_Search">
			<div class="row text-center">
				<div class="col-md-12">
					<form action="<?php echo BASE_URL; ?>story/search" data-ajax-action="<?php echo BASE_URL; ?>story/ajaxSearch" id="StorySearchForm" method="post">
						<input type="hidden" name="StorySearchPage" id="StorySearchPage" value="1">

						<div class="input-group">
				            <input type="text" name="StorySearch" id="StorySearch" value="<?php echo (isset($_POST["StorySearch"]) ? $_POST["StorySearch"] : ""); ?>" class="form-control" placeholder="<?php echo gettext("Search Stories!"); ?>">
				            <div class="input-group-btn">
				                <button id="StorySearchButton" class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
				            </div>
				        </div>						
					</form>
				</div>
			</div>			
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

			<div class="row text-center" id="StorySearchMoreButton" style="margin-bottom: 100px; <?php echo count($searchResults) <= 0 ? "display:none;" : "" ?>">
				<button type="button" class="btn btn-default btn-lg" style="background-color: orange; color:white; width:100%;"><?php echo gettext("Show More Stories!"); ?></button>
			</div>
	    </div>  <!-- <div role="tabpanel" class="tab-pane active" id="Story_Search"> -->


	    <div role="tabpanel" class="tab-pane" id="Story_Recommended">
			<input type="hidden" name="RecommendedStoryPage" id="RecommendedStoryPage" value="1">
			<div id="RecommendedStoryContainer">
				<?php 
					foreach ($searchResults as $story)
					{
						include(APP_DIR . "views/Story/_searchPanel.php");
					}			
				?>  
			</div> 
			
			<div class="alert alert-info alert-dismissible" id="RecommendedStoryInfoBar" role="alert" style="display:none;">
		  		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  		<strong><?php echo gettext("Info!"); ?></strong> <?php echo gettext("You have reached the end of your search results."); ?>
			</div>

			<div class="row text-center" style="margin-bottom: 100px;">
				<button type="button" class="btn btn-default btn-lg" style="background-color: orange; color:white; width:100%;"><?php echo gettext("Show More Stories!"); ?></button>
			</div>
	    </div>   <!-- <div role="tabpanel" class="tab-pane active" id="Story_Recommended"> -->


	    <div role="tabpanel" class="tab-pane" id="Story_Latest">
			<input type="hidden" name="LatestStoryPage" id="RecommendedStoryPage" value="1">
			<div id="LatestStoryContainer">
				<?php 
					foreach ($searchResults as $story)
					{
						include(APP_DIR . "views/Story/_searchPanel.php");
					}			
				?>  
			</div> 
			
			<div class="alert alert-info alert-dismissible" id="LatestStoryhInfoBar" role="alert" style="display:none;">
		  		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  		<strong><?php echo gettext("Info!"); ?></strong> <?php echo gettext("You have reached the end of your search results."); ?>
			</div>

			<div class="row text-center" style="margin-bottom: 100px;">
				<button type="button" class="btn btn-default btn-lg" style="background-color: orange; color:white; width:100%;"><?php echo gettext("Show More Stories!"); ?></button>
			</div>
	    </div> 
	</div>  
</div>
<?php //debugit($searchResults); ?>