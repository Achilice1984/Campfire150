<?php
	
 	//You have access to the Account/AccountHomeViewModel.php
	
	//You can access everything from this variable:
	//uncomment to view structure in browser
	//debugit($accountHomeViewModel);

	$isCurrentUser = $currentUser->UserId == $accountHomeViewModel->userDetails->UserId;

?>

<input type="hidden" name="userid" id="userid" value="<?php echo $accountHomeViewModel->userDetails->UserId; ?>">

<div id="headerImgModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo gettext("Header Photo"); ?></h4>
      </div>
      <div class="modal-body">
      	
        <div id="addImageDiv" class="img-rounded center-block" style="border-radius: 10px !important; position: relative; min-height:200px; border: 1px solid #E8E8E8; overflow: hidden; padding: 0; margin: 0;">
            
            <img id="imgPreviewer_header" src="" class="img-rounded img-responsive center-block" alt="" style="width:1200px; z-index: 10; " />
        </div>
       
      </div>
      <div class="modal-footer">
        <div class="form-group" style="">   
			<form id="imgHeaderForm" action="<?php echo BASE_URL; ?>account/changebackgroundpicture" method="post" enctype="multipart/form-data">
	    		<input type="hidden" name="image_header_x" id="image_header_x" value="">
	            <input type="hidden" name="image_header_y" id="image_header_y" value="">
	            <input type="hidden" name="image_header_height" id="image_header_height" value="">
	            <input type="hidden" name="image_header_width" id="image_header_width" value="">

	              <div class="fileUpload btn btn-default" style=" height: 35px;">  
	                    <span><?php echo gettext("Choose A Photo"); ?></span>
	                    <input style="font-size: 20px; cursor: pointer; opacity: 0; filter: alpha(opacity=0);" type="file" id="HeaderImage" name="HeaderImage" class="upload" placeholder="<?php echo gettext("Choose A Photo"); ?>" value="">
	              </div>

	              <div id="cropImage_header" class="btn btn-primary" style="display:none;"><?php echo gettext("Save"); ?></div>
	              <div style="float: right; margin-left:10px" id="CropBackgroundSpinerDiv">
	             		<?php include(APP_DIR . 'views/shared/_spinner_small.php'); ?>
	     			</div>
	         </form>
          </div>          
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div id="profileImgModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?php echo gettext("Profile Photo"); ?></h4>
      </div>
      <div class="modal-body">
      	
        <div id="addImageDiv_profile" class="img-rounded center-block" style="border-radius: 10px !important; position: relative; min-height:200px; border: 1px solid #E8E8E8; overflow: hidden; padding: 0; margin: 0;">
            
            <img id="imgPreviewer_profile" src="" class="img-rounded img-responsive center-block" alt="" style="width:1200px; z-index: 10; " />
        </div>
       
      </div>
      <div class="modal-footer">
        <div class="form-group" style="">   
			<form id="imgProfileForm" action="<?php echo BASE_URL; ?>account/changeprofilepicture" method="post" enctype="multipart/form-data">
	    		<input type="hidden" name="image_profile_x" id="image_profile_x" value="">
	            <input type="hidden" name="image_profile_y" id="image_profile_y" value="">
	            <input type="hidden" name="image_profile_height" id="image_profile_height" value="">
	            <input type="hidden" name="image_profile_width" id="image_profile_width" value="">

	              <div class="fileUpload btn btn-default" style=" height: 35px;">  
	                    <span><?php echo gettext("Choose A Photo"); ?></span>
	                    <input style="font-size: 20px; cursor: pointer; opacity: 0; filter: alpha(opacity=0);" type="file" id="ProfileImage" name="ProfileImage" class="upload" placeholder="<?php echo gettext("Choose A Photo"); ?>" value="">
	              </div>

	              	<div id="cropImage_profile" class="btn btn-primary" style="display:none;"><?php echo gettext("Save"); ?></div>
	              	<div style="float: right; margin-left:10px" id="CropProfileSpinerDiv">
	             		<?php include(APP_DIR . 'views/shared/_spinner_small.php'); ?>
	     			</div>
	         </form>
          </div>          
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<div class="bg-primary row" style="position: relative; margin-top: -15px; min-height: 225px;">
	<div id="headerImageChange" class="profileContent" style="display:none; position: absolute; height: 100%; width: 100%; opacity:0.6; background-color: black; text-align: center; cursor: pointer;">
		<span style="top: 50%; bottom:50%; font-size: 5em;" class="glyphicon glyphicon-camera text-primary"></span>
	</div>
	<!-- <div style="min-height: 450px;"></div> -->
	<img id="backgroundImage" style="" class="img-responsive" src="<?php echo isset($accountHomeViewModel->backgroundPictureURL) ? $accountHomeViewModel->backgroundPictureURL : ""; ?>" alt="">
</div>

<div class="container" style="padding-top: 50px; padding-bottom: 50px;">
    <div class="row">
    	<div style="margin-top: -200px;" class="col-md-3">
    		<div style="position:relative;" class="row">
	    		<div id="profileImageChange" class="profileContent img-responsive" style="cursor: pointer; display:none; max-width: 270px; position: absolute;  height: 100%; width: 100%; opacity:0.6; background-color: black; text-align: center; ">
	    			<span style="top: 50%; bottom:50%; font-size: 2em;" class="glyphicon glyphicon-camera text-primary"></span>	  				
				</div>

				<img id="profilePicture" style="max-height: 270px;" class="img-responsive img-thumbnail" src="<?php echo isset($accountHomeViewModel->profilePictureURL) ? $accountHomeViewModel->profilePictureURL : BASE_URL . "static/images/default-user-image.png"; ?>" alt="<?php echo gettext("Profile Picture"); ?>">
			</div>
			<div class="row">
				<h2>
					<?php echo $accountHomeViewModel->userDetails->FirstName . " " . $accountHomeViewModel->userDetails->LastName; ?>
				</h2>
			</div>
			<div style="margin-bottom: 10px;" class="row">
				<?php

					if($currentUser->IsAuth)
					{
						if(isset($accountHomeViewModel->userDetails->UserId) && $accountHomeViewModel->userDetails->UserId != $currentUser->UserId && $currentUser->IsAuth)
			            {
			                if(isset($accountHomeViewModel->userDetails->FollowingUser) && $accountHomeViewModel->userDetails->FollowingUser == TRUE)
			                {
			                    echo '<button style="display:block; width: 100%; margin-top: 5px;" data-userId="' . $accountHomeViewModel->userDetails->UserId . '" data-additional-text="' . gettext("Follow") . '" data-ajaxurl="' . BASE_URL . 'account/follow" class="FollowButton btn btn-primary btn-sm"><span class="glyphicon glyphicon-user"></span> ' . gettext("Following") . '</button>';
			                }
			                else
			                {
			                    echo '<button style="display:block; width: 100%; margin-top: 5px;" data-userId="' . $accountHomeViewModel->userDetails->UserId . '" data-additional-text="' . gettext("Following") . '" data-ajaxurl="' . BASE_URL . 'account/follow" class="FollowButton btn btn-default btn-sm"><span class="glyphicon glyphicon-user"></span> ' . gettext("Follow") . '</button>';
			                }
			            }
			            else
			            {
			            	?> 
			            		<a id="EditProfileButton" class="btn btn-default btn-sm" style="display:block; width: 100%; margin-top: 5px;" href="<?php echo BASE_URL . "account/profile/" . $accountHomeViewModel->userDetails->UserId; ?>"><?php echo gettext("Edit Profile"); ?></a> 
			            		<a id="CancelProfileButton" class="btn btn-primary btn-sm" style="display:none; width: 100%; margin-top: 5px;" href="<?php echo BASE_URL . "account/profile/" . $accountHomeViewModel->userDetails->UserId; ?>"><?php echo gettext("Finish Editing"); ?></a> 
		            		<?php
			            }
		            }
				?>
    		</div> 
			
			<div style="color: #333;" class="row">
				<div id="AboutDiv">
					<?php if(isset($accountHomeViewModel->userDetails->About) && trim($accountHomeViewModel->userDetails->About) != "") { ?>
						<span class="glyphicon glyphicon-user"></span> 
						<div id="AboutDivText">
							<?php echo $accountHomeViewModel->userDetails->About; ?>
						</div>
					<?php } else { ?>	
						<div id="AboutDivText"></div>
					<?php } ?>
				</div>
				<div id="AboutFormDiv" style="display:none;">

					<div class="messageDiv"></div>

					<form id="AboutForm" action="<?php echo BASE_URL; ?>account/updateAbout" method="post">									    														
							
						<div class="form-group">
			             	<textarea maxlength="150" name="About" id="About" class="form-control" rows="3" placeholder="<?php echo gettext("Tell us a little bit about yourself!"); ?>"><?php echo $accountHomeViewModel->userDetails->About; ?></textarea>
		             	</div>

			             <button style="float: left;" id="AboutSubmitButton" type="submit" class="btn btn-default"><?php echo gettext("Update About"); ?></button>
						<div style="float: left; margin-left:10px" id="AboutSpinerDiv">
		             		<?php include(APP_DIR . 'views/shared/_spinner_small.php'); ?>
	             		</div>
			         </form>	
				</div>
			</div>
			<div id="ActionStatementDiv" style="margin-bottom: 50px; margin-top: 10px;" class="row">				
				<?php if(isset($accountHomeViewModel->userDetails->UserActionStatement) && trim($accountHomeViewModel->userDetails->UserActionStatement) != "") { ?>
					<span class="glyphicon glyphicon-bullhorn"></span> 
					<div id="ActionStatementDivText">
						<?php echo $accountHomeViewModel->userDetails->UserActionStatement; ?>
					</div>
				<?php } else { ?>	
					<div id="ActionStatementDivText"></div>
				<?php } ?>			
			</div>		

			<div id="ActionStatementFormDiv" style="display:none; margin-top:15px; margin-left: -15px; margin-right: -15px; margin-bottom: 50px;">

				<div class="messageDiv"></div>

				<form id="ActionStatementForm" action="<?php echo BASE_URL; ?>account/updateActionStatement" method="post">									    														
						
					<div class="form-group">
		             	<textarea maxlength="100" name="UserActionStatement" id="UserActionStatement" class="form-control" rows="3" placeholder="<?php echo gettext("How are you making a difference?!"); ?>"><?php echo isset($accountHomeViewModel->userDetails->UserActionStatement) ? $accountHomeViewModel->userDetails->UserActionStatement : ""; ?></textarea>
	             	</div>

		             <button style="float: left;" id="UserActionSubmitButton" type="submit" class="btn btn-default"><?php echo gettext("Update Statement"); ?></button>
		             <div style="float: left; margin-left:10px" id="ActionStatementSpinerDiv">
	             		<?php include(APP_DIR . 'views/shared/_spinner_small.php'); ?>
             		</div>
		         </form>	
			</div>	
    	</div>
    	

    	<div style="margin-top: -40px; padding-left: 30px;" class="col-md-9"> 

    		<?php include(APP_DIR . 'views/shared/messages.php'); ?>

    		<div class="regularContent">   		  
	    		<div class="row">
					<ul style="border-bottom: 1px solid #eee" id="User_Tabs" class="nav nav-pills">

						<?php if($isCurrentUser) { ?>
					    	<li role="presentation" class="active"><a href="#User_NewsFeed" aria-controls="User_NewsFeed" role="tab" data-toggle="tab"><?php echo gettext("News Feed"); ?></a></li>
				    	<?php } ?>
					    <li role="presentation" <?php if(!$isCurrentUser) { echo 'class="active"'; } ?>><a href="#User_MyStories" aria-controls="User_MyStories" role="tab" data-toggle="tab"><?php echo gettext("Stories"); ?> <?php if(!$isCurrentUser) { echo '<span class="badge">' . $accountHomeViewModel->totalApprovedStories . '</span>'; } ?></a></li>
					    <li role="presentation"><a href="#User_MyRecommendations" aria-controls="User_MyRecommendations" role="tab" data-toggle="tab"><?php echo gettext("Recommendations"); ?> <span class="badge"><?php echo $accountHomeViewModel->totalRecommendations; ?></span></a></li>
					    <li role="presentation"><a href="#User_Following" aria-controls="User_Following" role="tab" data-toggle="tab"><?php echo gettext("Following"); ?> <span class="badge"><?php echo $accountHomeViewModel->totalFollowing; ?></span></a></li>
					    <li role="presentation"><a href="#User_Followers" aria-controls="User_Followers" role="tab" data-toggle="tab"><?php echo gettext("Followers"); ?> <span class="badge"><?php echo $accountHomeViewModel->totalFollowers; ?></span></a></li>
					    <li role="presentation"><a href="#User_ActionsTaken" aria-controls="User_ActionsTaken" role="tab" data-toggle="tab"><?php echo gettext("Actions Taken"); ?></a></li>
					</ul>   
					
					
					<div class="tab-content" style="padding:20px;">
						<?php if($isCurrentUser) { ?>
						    <div role="tabpanel" class="tab-pane active" id="User_NewsFeed">

						    	<?php if (isset($accountHomeViewModel->newsFeed) && is_array($accountHomeViewModel->newsFeed) && count($accountHomeViewModel->newsFeed) > 0) { ?>

							    	<div id="NewFeedContent" class="row">
								    	<?php 
								    		foreach ($accountHomeViewModel->newsFeed as $feed)
											{
												include(APP_DIR . "views/Account/_newsFeed.php");
											}			
										?>  
									</div>
									
									<div class="alert alert-info alert-dismissible" id="NewFeedContentInfoBar" role="alert" style="display:none;">
								  		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								  		<strong><?php echo gettext("Info!"); ?></strong> <?php echo gettext("You have reached the end of your search results."); ?>
									</div>

									<input type="hidden" name="NewFeedContentPage" id="NewFeedContentPage" value="1">
									<input type="hidden" name="NewFeedContentUrl" id="NewFeedContentUrl" value="<?php echo BASE_URL; ?>account/newsFeed">

									<div class="row text-center" id="NewFeedContentMoreButton" style="margin-bottom: 100px;">
										<?php include(APP_DIR . 'views/shared/_spinner_large.php'); ?>

										<button type="button" class="btn btn-default btn-lg" style="background-color: orange; color:white; width:100%;"><?php echo gettext("Show More Stories!"); ?></button>
									</div>	
								<?php } else { include(APP_DIR . "views/shared/noResults.php"); } ?>
						    </div>
						<?php } ?>


					    <div role="tabpanel" class="tab-pane <?php if(!$isCurrentUser) { echo "active"; } ?>" id="User_MyStories">
							<?php 
								if($currentUser->UserId != $accountHomeViewModel->userDetails->UserId)	
								{
									if (isset($accountHomeViewModel->usersStoryList) && is_array($accountHomeViewModel->usersStoryList) && count($accountHomeViewModel->usersStoryList) > 0)
									{
										echo "<div id='Stories_Content' class='row'>";

										foreach ($accountHomeViewModel->usersStoryList as $story)
										{
											include(APP_DIR . "views/Account/_myStories.php");
										}

										echo "</div>";

										?> 
											<div class="alert alert-info alert-dismissible" id="Stories_ContentInfoBar" role="alert" style="display:none;">
										  		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										  		<strong><?php echo gettext("Info!"); ?></strong> <?php echo gettext("You have reached the end of your search results."); ?>
											</div>

											<input type="hidden" name="Stories_ContentPage" id="Stories_ContentPage" value="1">
											<input type="hidden" name="Stories_ContentUrl" id="Stories_ContentUrl" value="<?php echo BASE_URL; ?>account/userStories">

											<div class="row text-center" id="Stories_ContentMoreButton" style="margin-bottom: 100px;">
												<?php include(APP_DIR . 'views/shared/_spinner_large.php'); ?>

												<button type="button" class="btn btn-default btn-lg" style="background-color: orange; color:white; width:100%;"><?php echo gettext("Show More Stories!"); ?></button>
											</div>									
										<?php
									}
									else { include(APP_DIR . "views/shared/noResults.php"); } 
								}
								else
								{
									include(APP_DIR . "views/Account/_currentUserStories.php");
								}			
							?>
					    </div>


					    <div role="tabpanel" class="tab-pane" id="User_MyRecommendations">

					    	<?php if (isset($accountHomeViewModel->recommendedStoryList) && is_array($accountHomeViewModel->recommendedStoryList) && count($accountHomeViewModel->recommendedStoryList) > 0) { ?>

						    	<div id="StoryRecommendationContent" class="row">
									<?php 
										foreach ($accountHomeViewModel->recommendedStoryList as $story)
										{
											//debugit($story);
											include(APP_DIR . "views/Account/_myRecommendations.php");
										}			
									?> 
								</div>

								<div class="alert alert-info alert-dismissible" id="StoryRecommendationContentInfoBar" role="alert" style="display:none;">
							  		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							  		<strong><?php echo gettext("Info!"); ?></strong> <?php echo gettext("You have reached the end of your search results."); ?>
								</div>

								<input type="hidden" name="StoryRecommendationContentPage" id="StoryRecommendationContentPage" value="1">
								<input type="hidden" name="StoryRecommendationContentUrl" id="StoryRecommendationContentUrl" value="<?php echo BASE_URL; ?>account/recommendations">

								<div class="row text-center" id="StoryRecommendationContentMoreButton" style="margin-bottom: 100px;">
									<?php include(APP_DIR . 'views/shared/_spinner_large.php'); ?>

									<button type="button" class="btn btn-default btn-lg" style="background-color: orange; color:white; width:100%;"><?php echo gettext("Show More Stories!"); ?></button>
								</div>
							<?php } else { include(APP_DIR . "views/shared/noResults.php"); } ?>
					    </div> 
					    <div role="tabpanel" class="tab-pane" id="User_Following">
							
							<?php if (isset($accountHomeViewModel->followingList) && is_array($accountHomeViewModel->followingList) && count($accountHomeViewModel->followingList) > 0) { ?>

						    	<div id="UserFollowingContent" class="row">
									<?php 
										foreach ($accountHomeViewModel->followingList as $user)
										{
											//debugit($story);
											include(APP_DIR . "views/Account/_searchPanel.php");
										}	
									?>
								</div>

								<div class="alert alert-info alert-dismissible" id="UserFollowingContentInfoBar" role="alert" style="display:none;">
							  		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							  		<strong><?php echo gettext("Info!"); ?></strong> <?php echo gettext("You have reached the end of your search results."); ?>
								</div>

								<input type="hidden" name="UserFollowingContentPage" id="UserFollowingContentPage" value="1">
								<input type="hidden" name="UserFollowingContentUrl" id="UserFollowingContentUrl" value="<?php echo BASE_URL; ?>account/followinglist">

								<div class="row text-center" id="UserFollowingContentMoreButton" style="margin-bottom: 100px;">
									<?php include(APP_DIR . 'views/shared/_spinner_large.php'); ?>

									<button type="button" class="btn btn-default btn-lg" style="background-color: orange; color:white; width:100%;"><?php echo gettext("Show More Stories!"); ?></button>
								</div>
							<?php } else { include(APP_DIR . "views/shared/noResults.php"); } ?>
					    </div> 
					    <div role="tabpanel" class="tab-pane" id="User_Followers">
							
							<?php if (isset($accountHomeViewModel->followerList) && is_array($accountHomeViewModel->followerList) && count($accountHomeViewModel->followerList) > 0) { ?>
						    	<div id="UserFollowersContent" class="row">
									<?php 
										//debugit($accountHomeViewModel->followerList);
										foreach ($accountHomeViewModel->followerList as $user)
										{
											//debugit($story);
											include(APP_DIR . "views/Account/_searchPanel.php");
										}			
									?>
								</div>

								<div class="alert alert-info alert-dismissible" id="UserFollowersContentInfoBar" role="alert" style="display:none;">
							  		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							  		<strong><?php echo gettext("Info!"); ?></strong> <?php echo gettext("You have reached the end of your search results."); ?>
								</div>

								<input type="hidden" name="UserFollowersContentPage" id="UserFollowersContentPage" value="1">
								<input type="hidden" name="UserFollowersContentUrl" id="UserFollowersContentUrl" value="<?php echo BASE_URL; ?>account/followerslist">

								<div class="row text-center" id="UserFollowersContentMoreButton" style="margin-bottom: 100px;">
									<?php include(APP_DIR . 'views/shared/_spinner_large.php'); ?>
									
									<button type="button" class="btn btn-default btn-lg" style="background-color: orange; color:white; width:100%;"><?php echo gettext("Show More Stories!"); ?></button>
								</div>
							<?php } else { include(APP_DIR . "views/shared/noResults.php"); } ?>
					    </div> 
					    <div role="tabpanel" class="tab-pane" id="User_ActionsTaken">
					    	<div class="row">
								<?php 
									echo "<table class='table table-hover' id='ActionsTakenListContainer'>";

									if(isset($accountHomeViewModel->ActionTakenList) && is_array($accountHomeViewModel->ActionTakenList) && count($accountHomeViewModel->ActionTakenList) > 0)
									{
										//debugit($accountHomeViewModel->followerList);
										foreach ($accountHomeViewModel->ActionTakenList as $action)
										{
											include(APP_DIR . "views/Account/_actionsTaken.php");
										}
									}
									else { include(APP_DIR . "views/shared/noResults.php"); } 

									echo "</table>";

									if($currentUser->UserId == $accountHomeViewModel->userDetails->UserId)	
									{
										?> 

											<form id="ActionTakenForm" action="<?php echo BASE_URL; ?>account/addActionsTaken" method="post">
									    															
												<div class="form-group">
					                               <!--  <label for="ActionTakenType"><?php echo gettext("Action Taken"); ?></label> -->
					                                <select class="form-control" name="ActionTakenType">
					                                    <?php 
					                                        foreach ($actionsTakenTypes as $dropdownValue) {
					                                            echo "<option value='" . $dropdownValue->Value . "'>"; 
					                                                echo $dropdownValue->Name;
					                                            echo "</option>";
					                                        } 
					                                    ?>
					                                </select>
					                            </div>
													
												<div class="form-group">
									             	<textarea maxlength="250" name="Content" id="Content" class="form-control" rows="3" placeholder="<?php echo gettext("What did you do to take action?!"); ?>"></textarea>
								             	</div>

									             <button style="float: left;" id="ActionTakenSubmitButton" type="submit" class="btn btn-default"><?php echo gettext("Add Action"); ?></button>
									             <div style="float: left; margin-left:10px" id="ActionTakenSpinerDiv">
								             		<?php include(APP_DIR . 'views/shared/_spinner_small.php'); ?>
							             		</div>
									         </form>

										<?php
									}		
								?>
								
							</div>
					    </div> 
					</div> 
				</div> 		
			</div>

			<div id="profileContentLoader" style="margin-top: 30px;">
				<?php include(APP_DIR . 'views/shared/_spinner_large.php'); ?>						
			</div>		

			<div id="profileContentContainer" class="profileContent" style="display:none;"> 				 
			</div>
			

    	</div>
    </div>
</div>