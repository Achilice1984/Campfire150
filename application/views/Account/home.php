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
            
            <img id="imgPreviewer_header" src="" class="img-responsive center-block" alt="" />
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
      	
        <div id="addImageDiv_profile" class="center-block" style="border-radius: 10px !important; position: relative; min-height:200px; border: 1px solid #E8E8E8; overflow: hidden; padding: 0; margin: 0;">
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

<?php if (isset($_SESSION["Story_Pending"])): ?>
	<?php unset($_SESSION["Story_Pending"]); ?>

	<div id="penndingStoryModal" class="modal fade">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><?php echo gettext("Story Pending Approval"); ?></h4>
	      </div>
	      <div class="modal-body">
	      	
	        <p><?php echo gettext("Your story is pending approval and will be published within the next 48 hours."); ?></p>
	       
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
<?php endif ?>

<?php if (isset($_SESSION["Story_Draft"])): ?>
	<?php unset($_SESSION["Story_Draft"]); ?>

	<div id="draftStoryModal" class="modal fade">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><?php echo gettext("Story Saved as Draft"); ?></h4>
	      </div>
	      <div class="modal-body">
	      	
	        <p><?php echo gettext("Your story has been saved as a draft."); ?></p>
	        <p><?php echo gettext("You can access this story in your drafts list below."); ?></p>
	       
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
<?php endif ?>


<div style="margin-top: -15px;"></div>
<div id="headerImageBanner" class="bg-primary row" style="position: relative; margin-top: -5px;">
	<div id="headerImageChange" class="profileContent" style="margin-top: 0px; display:none;  position: absolute; height: 100%; width: 100%; opacity:0.6; background-color: black; text-align: center; cursor: pointer;">
		<span style="top: 50%; bottom:50%; font-size: 5em;" class="glyphicon glyphicon-camera text-primary"></span>
	</div>
	<!-- <div style="min-height: 450px;"></div> -->
	<img id="backgroundImage" class="img-responsive" src="<?php echo isset($accountHomeViewModel->backgroundPictureURL) ? $accountHomeViewModel->backgroundPictureURL : ""; ?>" alt="">
</div>

<div class="container">
    <div class="row">
    	<div style="margin-top: -150px;" class="col-md-3">
    		<div id="profileImageContainer" style="position: relative;  max-width: 100%; width: 200px; height: 200px;">
	    		<div id="profileImageChange" class="profileContent" style="display:none; cursor: pointer; position: absolute;  width: 200px; height: 200px; opacity:0.6; background-color: black; text-align: center; ">
	    			<span style="top: 50%; bottom:50%; font-size: 2em; max-height: 100px;" class="glyphicon glyphicon-camera text-primary"></span>	  				
				</div>
				<img style="width: 200px; height: 200px;" id="profilePicture" class="img-thumbnail img-responsive" src="<?php echo isset($accountHomeViewModel->profilePictureURL) ? $accountHomeViewModel->profilePictureURL : BASE_URL . "static/images/default-user-image.png"; ?>" alt="<?php echo gettext("Profile Picture"); ?>">
			</div>
				<h1 class="h2">
					<?php echo $accountHomeViewModel->userDetails->FirstName . " " . $accountHomeViewModel->userDetails->LastName; ?>
				</h1>
				<?php

					if($currentUser->IsAuth)
					{
						if(isset($accountHomeViewModel->userDetails->UserId) && $accountHomeViewModel->userDetails->UserId != $currentUser->UserId && $currentUser->IsAuth)
			            {
			                if(isset($accountHomeViewModel->userDetails->FollowingUser) && $accountHomeViewModel->userDetails->FollowingUser == TRUE)
			                {
			                    echo '<button  class="FollowButton btn btn-primary btn-block" data-userId="' . $accountHomeViewModel->userDetails->UserId . '" data-additional-text="' . gettext("Follow") . '" data-ajaxurl="' . BASE_URL . 'account/follow"><span class="glyphicon glyphicon-user"></span> ' . gettext("Following") . '</button>';
			                }
			                else
			                {
			                    echo '<button class="FollowButton btn btn-default btn-block" data-userId="' . $accountHomeViewModel->userDetails->UserId . '" data-additional-text="' . gettext("Following") . '" data-ajaxurl="' . BASE_URL . 'account/follow"><span class="glyphicon glyphicon-user"></span> ' . gettext("Follow") . '</button>';
			                }
			            }
			            else
			            {
			            	?> 
			            		<p><button id="EditProfileButton" class="btn btn-default btn-block" data-action="<?php echo BASE_URL . "account/profile/" . $accountHomeViewModel->userDetails->UserId; ?>"><span class="glyphicon glyphicon-user"></span> <?php echo gettext("Edit Profile"); ?></button></p>
			            		<p><button class="CancelProfileButton btn btn-primary btn-block" style="display: none;"  data-action="<?php echo BASE_URL . "account/profile/" . $accountHomeViewModel->userDetails->UserId; ?>"><span class="glyphicon glyphicon-user"></span> <?php echo gettext("Finish Editing"); ?></button></p>
			            		<p><a id="ShareStoryButtonProfile" class="btn btn-primary btn-block marginBottom15" href="<?php echo BASE_URL . "story/add/" ?>"><span class="glyphicon glyphicon-pencil"></span> <?php echo gettext("Share A Story"); ?></a></p>
		            		<?php
			            }
		            }
				?>			
			
			<div id="AboutDiv">
			
				<div class="panel panel-default marginTop15">
					<div class="panel-heading"><span class="glyphicon glyphicon-user"></span> <?php echo gettext("About"); ?></div>
					<div class="panel-body">
						<div id="AboutDivText" style="word-wrap: break-word;">
							<?php if(isset($accountHomeViewModel->userDetails->About) && trim($accountHomeViewModel->userDetails->About) != "") { ?>
								<?php echo $accountHomeViewModel->userDetails->About; ?>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
			<div id="AboutFormDiv" style="display:none;">

				<div class="messageDiv"></div>

				<form id="AboutForm" action="<?php echo BASE_URL; ?>account/updateAbout" method="post">									    														
						
					<div class="form-group">
		             	<textarea  data-toggle="tooltip" title="<?php echo gettext("Tell us a little bit about yourself."); ?>" maxlength="150" name="About" id="About" class="form-control" rows="3" placeholder="<?php echo gettext("Tell us a little bit about yourself."); ?>"><?php echo $accountHomeViewModel->userDetails->About; ?></textarea>
	             	</div>

		             <p>
						<div style="margin-left:10px" id="AboutSpinerDiv">
		             		<?php include(APP_DIR . 'views/shared/_spinner_small.php'); ?>
	             		</div>
		             	<button style="display:none;" id="AboutSubmitButton" type="submit" class="btn btn-default btn-block"><?php echo gettext("Update About"); ?></button></p>
					
		         </form>	
			</div>
			<div id="ActionStatementDiv">				
				
				<div class="panel panel-default marginTop15">
					<div class="panel-heading"><span class="glyphicon glyphicon-bullhorn"></span> <?php echo gettext("My Pledge"); ?></div>
					<div class="panel-body">
						<div id="ActionStatementDivText" style="word-wrap: break-word;">
							<?php if(isset($accountHomeViewModel->userDetails->UserActionStatement) && trim($accountHomeViewModel->userDetails->UserActionStatement) != "") { ?>
								
								<?php echo $accountHomeViewModel->userDetails->UserActionStatement; ?>
								
							<?php } ?>	
						</div>
					</div>
				</div>			
			</div>		

			<div id="ActionStatementFormDiv" style="display:none;">

				<div class="messageDiv"></div>

				<form id="ActionStatementForm" action="<?php echo BASE_URL; ?>account/updateActionStatement" method="post">									    														
						
					<div class="form-group">
		             	<textarea data-toggle="tooltip" title="<?php echo gettext("What do you pledge to do to make your story about Canada’s future a reality?"); ?>" maxlength="100" name="UserActionStatement" id="UserActionStatement" class="form-control" rows="3" placeholder="<?php echo gettext("What do you pledge to do to make your story about Canada’s future a reality?"); ?>"><?php echo isset($accountHomeViewModel->userDetails->UserActionStatement) ? $accountHomeViewModel->userDetails->UserActionStatement : ""; ?></textarea>
	             	</div>

		             <p>
						<div style="margin-left:10px" id="ActionStatementSpinerDiv">
		             		<?php include(APP_DIR . 'views/shared/_spinner_small.php'); ?>
	             		</div>
		             	<button style="display:none;" id="UserActionSubmitButton" type="submit" class="btn btn-default btn-block"><?php echo gettext("Update My Pledge"); ?></button></p>
		             
		         </form>	
			</div>	
    	</div>
    	

    	<div class="col-md-9"> 

    		<?php include(APP_DIR . 'views/shared/messages.php'); ?>

    		<div class="regularContent">
				<ul id="User_Tabs" class="nav nav-tabs paddingTop15 marginBottom15">
					<?php if($isCurrentUser) { ?>
				    	<li role="presentation" class="active"><a href="#User_NewsFeed" aria-controls="User_NewsFeed" role="tab" data-toggle="tab"><?php echo gettext("News Feed"); ?></a></li>
			    	<?php } ?>
				    <li role="presentation" <?php if(!$isCurrentUser) { echo 'class="active"'; } ?>><a href="#User_MyStories" aria-controls="User_MyStories" role="tab" data-toggle="tab"><?php echo gettext("Stories"); ?> <?php if(!$isCurrentUser) { echo '<span class="label label-primary">' . $accountHomeViewModel->totalApprovedStories . '</span>'; } ?></a></li>
				    <li role="presentation"><a href="#User_MyRecommendations" aria-controls="User_MyRecommendations" role="tab" data-toggle="tab"><?php echo gettext("Recommendations"); ?> <span class="label label-primary"><?php echo $accountHomeViewModel->totalRecommendations; ?></span></a></li>
				    <li role="presentation"><a href="#User_Following" aria-controls="User_Following" role="tab" data-toggle="tab"><?php echo gettext("Following"); ?> <span class="label label-primary"><?php echo $accountHomeViewModel->totalFollowing; ?></span></a></li>
				    <li role="presentation"><a href="#User_Followers" aria-controls="User_Followers" role="tab" data-toggle="tab"><?php echo gettext("Followers"); ?> <span class="label label-primary"><?php echo $accountHomeViewModel->totalFollowers; ?></span></a></li>
				    <li role="presentation"><a href="#User_ActionsTaken" aria-controls="User_ActionsTaken" role="tab" data-toggle="tab"><?php echo gettext("Actions Taken"); ?></a></li>
				</ul>   
				
				
				<div class="tab-content">
					<?php if($isCurrentUser) { ?>
					    <div role="tabpanel" class="tab-pane active" id="User_NewsFeed">

					    	<?php if (isset($accountHomeViewModel->newsFeed) && is_array($accountHomeViewModel->newsFeed) && count($accountHomeViewModel->newsFeed) > 0) { ?>

						    	<div id="NewFeedContent">
							    	<?php 
							    		foreach ($accountHomeViewModel->newsFeed as $feed)
										{
											include(APP_DIR . "views/Account/_newsFeed.php");
										}			
									?>  
								</div>
								
								<div class="alert alert-info alert-dismissible" id="NewFeedContentInfoBar" role="alert" style="display:none;">
							  		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							  		<strong><?php echo gettext("Info."); ?></strong> <?php echo gettext("You have reached the end of your search results."); ?>
								</div>

								<input type="hidden" name="NewFeedContentPage" id="NewFeedContentPage" value="1">
								<input type="hidden" name="NewFeedContentUrl" id="NewFeedContentUrl" value="<?php echo BASE_URL; ?>account/newsFeed">

								<div class="text-center" id="NewFeedContentMoreButton">
									<?php include(APP_DIR . 'views/shared/_spinner_large.php'); ?>

									<button type="button" class="btn btn-warning btn-lg btn-block"><?php echo gettext("Show More Stories"); ?></button>
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
									echo "<div id='Stories_Content'>";

									foreach ($accountHomeViewModel->usersStoryList as $story)
									{
										include(APP_DIR . "views/Account/_myStories.php");
									}

									echo "</div>";

									?> 
										<div class="alert alert-info alert-dismissible" id="Stories_ContentInfoBar" role="alert" style="display:none;">
									  		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									  		<strong><?php echo gettext("Info."); ?></strong> <?php echo gettext("You have reached the end of your search results."); ?>
										</div>

										<input type="hidden" name="Stories_ContentPage" id="Stories_ContentPage" value="1">
										<input type="hidden" name="Stories_ContentUrl" id="Stories_ContentUrl" value="<?php echo BASE_URL; ?>account/userStories">

										<div class="text-center" id="Stories_ContentMoreButton">
											<?php include(APP_DIR . 'views/shared/_spinner_large.php'); ?>

											<button type="button" class="btn btn-warning btn-lg btn-block"><?php echo gettext("Show More Stories"); ?></button>
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

					    	<div id="StoryRecommendationContent">
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
						  		<strong><?php echo gettext("Info."); ?></strong> <?php echo gettext("You have reached the end of your search results."); ?>
							</div>

							<input type="hidden" name="StoryRecommendationContentPage" id="StoryRecommendationContentPage" value="1">
							<input type="hidden" name="StoryRecommendationContentUrl" id="StoryRecommendationContentUrl" value="<?php echo BASE_URL; ?>account/recommendations">

							<div class="row text-center" id="StoryRecommendationContentMoreButton" style="margin-bottom: 100px;">
								<?php include(APP_DIR . 'views/shared/_spinner_large.php'); ?>

								<button type="button" class="btn btn-warning btn-lg btn-block"><?php echo gettext("Show More Stories"); ?></button>
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
						  		<strong><?php echo gettext("Info."); ?></strong> <?php echo gettext("You have reached the end of your search results."); ?>
							</div>

							<input type="hidden" name="UserFollowingContentPage" id="UserFollowingContentPage" value="1">
							<input type="hidden" name="UserFollowingContentUrl" id="UserFollowingContentUrl" value="<?php echo BASE_URL; ?>account/followinglist">

							<div class="text-center" id="UserFollowingContentMoreButton">
								<?php include(APP_DIR . 'views/shared/_spinner_large.php'); ?>

								<button type="button" class="btn btn-warning btn-lg btn-block"><?php echo gettext("Show More Stories"); ?></button>
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
						  		<strong><?php echo gettext("Info."); ?></strong> <?php echo gettext("You have reached the end of your search results."); ?>
							</div>

							<input type="hidden" name="UserFollowersContentPage" id="UserFollowersContentPage" value="1">
							<input type="hidden" name="UserFollowersContentUrl" id="UserFollowersContentUrl" value="<?php echo BASE_URL; ?>account/followerslist">

							<div class="text-center" id="UserFollowersContentMoreButton">
								<?php include(APP_DIR . 'views/shared/_spinner_large.php'); ?>
								
								<button type="button" class="btn btn-warning btn-lg btn-block"><?php echo gettext("Show More Stories"); ?></button>
							</div>
						<?php } else { include(APP_DIR . "views/shared/noResults.php"); } ?>
				    </div> 
				    <div role="tabpanel" class="tab-pane" id="User_ActionsTaken">
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
								             	<textarea maxlength="250" name="Content" id="Content" class="form-control" rows="3" placeholder="<?php echo gettext("What did you do to take action?"); ?>"></textarea>
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

			<div id="profileContentLoader">
				<?php include(APP_DIR . 'views/shared/_spinner_large.php'); ?>						
			</div>		

			<div id="profileContentContainer" class="profileContent" style="display:none;"> 				 
			</div>
			

    	</div>
    </div>
</div>