<?php
	$showSearch = isset($_GET["search"]);
?>

<div class="container"  style="min-height: 300px;">
	<ul class="nav nav-tabs marginBottom15">
		<li role="presentation" <?php echo (!$showSearch ? "class='active'" : "" ); ?>><a href="#User_Latest" aria-controls="User_Latest" role="tab" data-toggle="tab"><?php echo gettext("Latest"); ?></a></li>
	    <li role="presentation"><a href="#User_MostFollowers" aria-controls="User_MostFollowers" role="tab" data-toggle="tab"><?php echo gettext("Most Followers"); ?></a></li>
	    <li role="presentation" <?php echo ($showSearch ? "class='active'" : "" ); ?>><a href="#User_Search" aria-controls="User_Search" role="tab" data-toggle="tab"><?php echo gettext("Search"); ?></a></li>
	</ul>   

	<div class="tab-content">
		<div role="tabpanel" class="tab-pane <?php echo (!$showSearch ? "active" : "" ); ?>" id="User_Latest">
			
			<?php if (isset($latestUsersList) && is_array($latestUsersList) && count($latestUsersList) > 0) { ?>

				<div id="UsersLatestContainer" class="row">
					<?php 
						foreach ($latestUsersList as $user)
						{
							include(APP_DIR . "views/Account/_searchPanel.php");
						}			
					?>  
				</div> 									
			
				<div class="alert alert-info alert-dismissible" id="UsersLatestInfoBar" role="alert" style="display:none;">
			  		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  		<strong><?php echo gettext("Info!"); ?></strong> <?php echo gettext("You have reached the end of your search results."); ?>
				</div>

				<input type="hidden" name="UsersLatestPage" id="UsersLatestPage" value="1">
				<input type="hidden" name="UsersLatestUrl" id="UsersLatestUrl" value="<?php echo BASE_URL; ?>account/latestUserList">

				<div class="text-center" id="UsersLatestMoreButton">
					<?php include(APP_DIR . 'views/shared/_spinner_large.php'); ?>	

					<button type="button" class="ShowMoreButton btn btn-warning btn-lg btn-block"><?php echo gettext("Show More Users"); ?></button>
				</div>
			<?php } else { include(APP_DIR . "views/shared/noResults.php"); } ?>
	    </div> 

	    <div role="tabpanel" class="tab-pane" id="User_MostFollowers">
			
			<?php if (isset($mostFollowUsersList) && is_array($mostFollowUsersList) && count($mostFollowUsersList) > 0) { ?>
				<div id="UserMostFollowersContainer" class="row">
					<?php 
						foreach ($mostFollowUsersList as $user)
						{
							include(APP_DIR . "views/Account/_searchPanel.php");
						}			
					?>  
				</div> 
				
				<div class="alert alert-info alert-dismissible" id="UserMostFollowersInfoBar" role="alert" style="display:none;">
			  		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  		<strong><?php echo gettext("Info!"); ?></strong> <?php echo gettext("You have reached the end of your search results."); ?>
				</div>
				
				<input type="hidden" name="UserMostFollowersPage" id="UserMostFollowersPage" value="1">
				<input type="hidden" name="UserMostFollowersUrl" id="UserMostFollowersUrl" value="<?php echo BASE_URL; ?>account/mostFollowersUserList">

				<div class="text-center" id="UserMostFollowersMoreButton">
					<?php include(APP_DIR . 'views/shared/_spinner_large.php'); ?>	

					<button type="button" class="ShowMoreButton btn btn-warning btn-lg btn-block"><?php echo gettext("Show More Users"); ?></button>
				</div>
			<?php } else { include(APP_DIR . "views/shared/noResults.php"); } ?>
	    </div>   <!-- <div role="tabpanel" class="tab-pane active" id="Story_Recommended"> -->

	    <div role="tabpanel" class="tab-pane <?php echo ($showSearch ? "active" : "" ); ?>" id="User_Search" >
			<form action="<?php echo BASE_URL; ?>account/search" data-ajax-action="<?php echo BASE_URL; ?>account/ajaxSearch" id="UserSearchForm" method="post">
				<input type="hidden" name="UserSearchPage" id="UserSearchPage" value="1">

				<div class="input-group">
		            <input type="text" name="UserSearch" id="UserSearch" value="<?php echo (isset($_POST["UserSearch"]) ? $_POST["UserSearch"] : ""); ?>" class="form-control" placeholder="<?php echo gettext("Search Users"); ?>">
		            <div class="input-group-btn">
		                <button id="UserSearchButton" class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
		            </div>
		        </div>						
			</form>	

			<?php if (isset($searchResults) && is_array($searchResults) && count($searchResults) > 0) { ?>
				<div id="UserSearchContainer" class="row">
					<?php 
						foreach ($searchResults as $user)
						{
							include(APP_DIR . "views/Account/_searchPanel.php");
						}			
					?>  
				</div> 
				
				<div class="alert alert-info alert-dismissible" id="UserSearchInfoBar" role="alert" style="display:none;">
			  		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  		<strong><?php echo gettext("Info!"); ?></strong> <?php echo gettext("You have reached the end of your search results."); ?>
				</div>

				<div class="text-center" id="UserSearchMoreButton" style="<?php echo count($searchResults) <= 0 ? "display:none;" : "" ?>">
					<?php include(APP_DIR . 'views/shared/_spinner_large.php'); ?>	
					
					<button type="button" class="ShowMoreButton btn btn-warning btn-lg btn-block"><?php echo gettext("Show More Users"); ?></button>
				</div>
			<?php } ?>
	    </div>  <!-- <div role="tabpanel" class="tab-pane active" id="Story_Search"> -->
	</div>  
</div>
<?php //debugit($searchResults); ?>