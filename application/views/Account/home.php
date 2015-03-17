<?php
	
 	//You have access to the Account/AccountHomeViewModel.php
	
	//You can access everything from this variable:
	//uncomment to view structure in browser
	//debugit($accountHomeViewModel);

?>

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
	<img id="backgroundImage" style="" class="img-responsive" src="<?php echo isset($accountHomeViewModel->backgroundImage) ? $accountHomeViewModel->backgroundImage->PictureUrl : ""; ?>" alt="">
</div>

<div class="container" style="padding-top: 50px; padding-bottom: 50px;">
    <div class="row">
    	<div style="margin-top: -200px; padding-right: 40px;" class="col-md-3">
    		<div style="position:relative;" class="row">
	    		<div id="profileImageChange" class="profileContent" style="cursor: pointer; display:none; max-width: 270px; position: absolute;  height: 100%; width: 100%; opacity:0.6; background-color: black; text-align: center; ">
	    			<span style="top: 50%; bottom:50%; font-size: 2em;" class="glyphicon glyphicon-camera text-primary"></span>	  				
				</div>

				<img id="profilePicture" style="max-height: 270px;" class="img-responsive img-thumbnail" src="<?php echo isset($accountHomeViewModel->profileImage) ? $accountHomeViewModel->profileImage->PictureUrl : BASE_URL . "static/images/default-user-image.png"; ?>" alt="<?php echo gettext("Profile Picture"); ?>">
			</div>
			<div class="row">
				<h2>
					<?php echo $accountHomeViewModel->userDetails->FirstName . " " . $accountHomeViewModel->userDetails->LastName; ?>
				</h2>
			</div>
			<div style="margin-bottom: 10px;" class="row">
				<?php
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
				?>
    		</div> 
			
			<div style="color: #333;" class="row">
				<?php echo $accountHomeViewModel->userDetails->About; ?>
			</div>
			<div style="margin-bottom: 50px; margin-top: 10px;" class="row">
				<?php if(isset($accountHomeViewModel->userDetails->UserActionStatement)) { ?>
					<span class="glyphicon glyphicon-bullhorn"></span> <?php echo $accountHomeViewModel->userDetails->UserActionStatement; ?>
				<?php } ?>
			</div>
			
    	</div>
    	<div style="margin-top: -40px;" class="col-md-9"> 

    		<?php include(APP_DIR . 'views/shared/messages.php'); ?>

    		<div class="regularContent">   		  
	    		<div class="row">
					<ul style="border-bottom: 1px solid #eee" class="nav nav-pills">
					    <li role="presentation" class="active"><a href="#User_NewsFeed" aria-controls="User_NewsFeed" role="tab" data-toggle="tab"><?php echo gettext("News Feed"); ?></a></li>
					    <li role="presentation"><a href="#User_MyStories" aria-controls="User_MyStories" role="tab" data-toggle="tab"><?php echo gettext("My Stories"); ?> <span class="badge"><?php echo $accountHomeViewModel->totalApprovedStories; ?></span></a></li>
					    <li role="presentation"><a href="#User_MyRecommendations" aria-controls="User_MyRecommendations" role="tab" data-toggle="tab"><?php echo gettext("My Recommendations"); ?> <span class="badge"><?php echo $accountHomeViewModel->totalRecommendations; ?></span></a></li>
					    <li role="presentation"><a href="#User_Following" aria-controls="User_Following" role="tab" data-toggle="tab"><?php echo gettext("Following"); ?> <span class="badge"><?php echo $accountHomeViewModel->totalFollowing; ?></span></a></li>
					    <li role="presentation"><a href="#User_Followers" aria-controls="User_Followers" role="tab" data-toggle="tab"><?php echo gettext("Followers"); ?> <span class="badge"><?php echo $accountHomeViewModel->totalFollowers; ?></span></a></li>
					</ul>   

					<div class="tab-content" style="padding:20px;">
					    <div role="tabpanel" class="tab-pane active" id="User_NewsFeed">
					    	<?php 
								foreach ($accountHomeViewModel->newsFeed as $feed)
								{
									include(APP_DIR . "views/Account/_newsFeed.php");
								}			
							?>  
					    </div>


					    <div role="tabpanel" class="tab-pane" id="User_MyStories">
							<?php 
								foreach ($accountHomeViewModel->usersStoryList as $story)
								{
									include(APP_DIR . "views/Account/_myStories.php");
								}			
							?>
					    </div>


					    <div role="tabpanel" class="tab-pane" id="User_MyRecommendations">
							<?php 
								foreach ($accountHomeViewModel->recommendedStoryList as $story)
								{
									//debugit($story);
									include(APP_DIR . "views/Account/_myRecommendations.php");
								}			
							?> 
					    </div> 
					    <div role="tabpanel" class="tab-pane" id="User_Following">
							<?php 
								if(isset($accountHomeViewModel->followingList) && count($accountHomeViewModel->followingList) > 0)
								{
									foreach ($accountHomeViewModel->followingList as $user)
									{
										//debugit($story);
										include(APP_DIR . "views/Account/_searchPanel.php");
									}	
								}	
							?>
					    </div> 
					    <div role="tabpanel" class="tab-pane" id="User_Followers">
							<?php 
								if(isset($accountHomeViewModel->followerList) && count($accountHomeViewModel->followerList))
								{
									//debugit($accountHomeViewModel->followerList);
									foreach ($accountHomeViewModel->followerList as $user)
									{
										//debugit($story);
										include(APP_DIR . "views/Account/_searchPanel.php");
									}
								}			
							?>
					    </div> 
					</div> 
				</div> 		
			</div>

			<div id="profileContentContainer" class="profileContent" style="display:none;"> 
				 
			</div>

    	</div>
    </div>
</div>