
<div class="container" style="padding-top: 50px; padding-bottom: 50px; min-height: 600px;">
	<ul class="nav nav-pills UserSearchBar">
	    <li role="presentation" class="active"><a href="#User_Search" aria-controls="User_Search" role="tab" data-toggle="tab"><?php echo gettext("Search"); ?></a></li>
	    <li role="presentation"><a href="#User_MostFollowers" aria-controls="User_MostFollowers" role="tab" data-toggle="tab"><?php echo gettext("Most Followers"); ?></a></li>
	    <li role="presentation"><a href="#User_Latest" aria-controls="User_Latest" role="tab" data-toggle="tab"><?php echo gettext("Latest"); ?></a></li>
	</ul>   

	<div class="tab-content" style="padding:20px;">
	    <div role="tabpanel" class="tab-pane active" id="User_Search">
			<div class="row text-center">
				<div class="col-md-12">
					<form action="<?php echo BASE_URL; ?>account/search" data-ajax-action="<?php echo BASE_URL; ?>account/ajaxSearch" id="UserSearchForm" method="post">
						<input type="hidden" name="UserSearchPage" id="UserSearchPage" value="1">

						<div class="input-group">
				            <input type="text" name="UserSearch" id="UserSearch" value="<?php echo (isset($_POST["UserSearch"]) ? $_POST["UserSearch"] : ""); ?>" class="form-control" placeholder="<?php echo gettext("Search Users!"); ?>">
				            <div class="input-group-btn">
				                <button id="UserSearchButton" class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
				            </div>
				        </div>						
					</form>
				</div>
			</div>			
			<div id="UserSearchContainer">
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

			<div class="row text-center" id="UserSearchMoreButton" style="margin-bottom: 100px; <?php echo count($searchResults) <= 0 ? "display:none;" : "" ?>">
				<button type="button" class="btn btn-default btn-lg" style="background-color: orange; color:white; width:100%;"><?php echo gettext("Show More Users!"); ?></button>
			</div>
	    </div>  <!-- <div role="tabpanel" class="tab-pane active" id="Story_Search"> -->


	    <div role="tabpanel" class="tab-pane" id="User_MostFollowers">

			<div id="UserMostFollowersContainer">
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

			<div class="row text-center" id="UserMostFollowersMoreButton" style="margin-bottom: 100px;">
				<button type="button" class="btn btn-default btn-lg" style="background-color: orange; color:white; width:100%;"><?php echo gettext("Show More Users!"); ?></button>
			</div>
	    </div>   <!-- <div role="tabpanel" class="tab-pane active" id="Story_Recommended"> -->


	    <div role="tabpanel" class="tab-pane" id="User_Latest">
			
			<div id="UsersLatestContainer">
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

			<div class="row text-center" id="UsersLatestMoreButton" style="margin-bottom: 100px;">
				<button type="button" class="btn btn-default btn-lg" style="background-color: orange; color:white; width:100%;"><?php echo gettext("Show More Users!"); ?></button>
			</div>
	    </div> 
	</div>  
</div>
<?php //debugit($searchResults); ?>