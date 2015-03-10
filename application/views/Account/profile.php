<?php

    //You have access to the Account/ProfileViewModel.php
    
    //You can access everything from this variable:
    //uncomment to view structure in browser
    //debugit($userViewModel);

?>

<div class="container" style="padding-top: 50px; padding-bottom: 50px;">

    <div class="row">
        <?php 
            //Add error message block to the page
            include(APP_DIR . 'views/shared/displayErrors.php'); 

            //Add success message block to the page
            include(APP_DIR . 'views/shared/displaySuccess.php'); 
        ?>
    </div>

    <div role="tabpanel">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#update_profile" aria-controls="update_profile" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-user"></span> <?php echo gettext("Profile"); ?></a></li>
            <li role="presentation"><a href="#dangerZone" aria-controls="dangerZone" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-console"></span> <?php echo gettext("Danger Zone"); ?></a></li>
            <li role="presentation"><a href="#update_profile_picture" aria-controls="update_profile_picture" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-picture"></span> <?php echo gettext("Profile Picture"); ?></a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content" style="padding:20px;">
            <div role="tabpanel" class="tab-pane active" id="update_profile">
                <div class="row">

                    <div class="col-md-6"> 

                        <form action="<?php echo BASE_URL; ?>account/profile" method="post">                            

                            <h3><?php echo gettext("Profile Details"); ?></h3>
                            <hr />

                            <div class="form-group">
                                <label for="Email"><?php echo gettext("Email address"); ?></label>
                                <input type="email" class="form-control" id="Email" name="Email" placeholder="<?php echo gettext("Enter Email"); ?>" value="<?php echo $userViewModel->Email; ?>">
                            </div>
                            
                            <label for="LanguageType_LanguageId"><?php echo gettext("Language Preference"); ?></label>
                            <div class="form-group">                                
                                <label class="radio-inline">
                                    <input type="radio" name="LanguageType_LanguageId" id="LanguageType_LanguageId1" <?php if($userViewModel->LanguageType_LanguageId == 1 || !isset($userViewModel->LanguageType_LanguageId)) { echo "checked"; } ?> value="1"> <?php echo gettext("English"); ?>
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="LanguageType_LanguageId" id="LanguageType_LanguageId2" <?php if($userViewModel->LanguageType_LanguageId == 2) { echo "checked"; } ?> value="2"> <?php echo gettext("French"); ?>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="ProfilePrivacyType_PrivacyTypeId"><?php echo gettext("Profile Privacy Type"); ?></label>
                                <select class="form-control" name="ProfilePrivacyType_PrivacyTypeId">
                                    <?php 
                                        foreach ($privacyDropdownValues as $dropdownValue) {
                                            echo "<option " . ($userViewModel->ProfilePrivacyType_PrivacyTypeId == $dropdownValue->Value ? 'selected=selected' : "") . " value='" . $dropdownValue->Value . "'>"; 
                                                echo $dropdownValue->Name;
                                            echo "</option>";
                                        } 
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="Gender_GenderId"><?php echo gettext("Gender"); ?></label>
                                <select class="form-control" name="Gender_GenderId">
                                    <?php 
                                        foreach ($genderDropdownValues as $dropdownValue) {
                                            echo "<option " . ($userViewModel->Gender_GenderId == $dropdownValue->Value ? 'selected=selected' : "") . " value='" . $dropdownValue->Value . "'>"; 
                                                echo $dropdownValue->Name;
                                            echo "</option>";
                                        } 
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="Ethnicity"><?php echo gettext("Ethnicity"); ?></label>
                                <input type="text" class="form-control" id="Ethnicity" name="Ethnicity" placeholder="<?php echo gettext("Enter Your Ethnicity (optional)"); ?>" value="<?php echo $userViewModel->Ethnicity; ?>">
                            </div>  

                            <div class="form-group">
                                <label for="Birthday"><?php echo gettext("Birthday"); ?></label>
                                <input type="text" class="form-control" id="Birthday" name="Birthday" placeholder="<?php echo gettext("YYYY-MM-DD"); ?>" value="<?php echo $userViewModel->Birthday; ?>">
                            </div>

                            <h3 style="padding-top:10px;"><?php echo gettext("Contact Details"); ?></h3>
                            <hr />

                             <div class="form-group">
                                <label for="FirstName"><?php echo gettext("First Name"); ?></label>
                                <input type="text" class="form-control" id="FirstName" name="FirstName" placeholder="<?php echo gettext("Enter Your First Name"); ?>" value="<?php echo $userViewModel->FirstName; ?>">
                            </div>
                           <div class="form-group">
                                <label for="MidName"><?php echo gettext("Middle Name"); ?></label>
                                <input type="text" class="form-control" id="MidName" name="MidName" placeholder="<?php echo gettext("Enter Your Middle Name"); ?>" value="<?php echo $userViewModel->MidName; ?>">
                            </div>
                            <div class="form-group">
                                <label for="LastName"><?php echo gettext("Last Name"); ?></label>
                                <input type="text" class="form-control" id="LastName" name="LastName" placeholder="<?php echo gettext("Enter Your Last Name"); ?>" value="<?php echo $userViewModel->LastName; ?>">
                            </div>
                            <!-- <div class="form-group">
                                <label for="PhoneNumber"><?php echo gettext("Phone Number"); ?></label>
                                <input type="phone" class="form-control" id="PhoneNumber" name="PhoneNumber" placeholder="<?php echo gettext("Enter Your Phone Number"); ?>" value="<?php echo $userViewModel->PhoneNumber; ?>">
                            </div> -->

                            <!-- <h3 style="padding-top:10px;"><?php echo gettext("Address"); ?></h3>
                            <hr />

                            <div class="form-group">
                                <label for="Address"><?php echo gettext("Address"); ?></label>
                                <input type="text" class="form-control" id="Address" name="Address" placeholder="<?php echo gettext("Enter Your Address"); ?>" value="<?php echo $userViewModel->Address; ?>">
                            </div> -->
                            <div class="form-group">
                                <label for="PostalCode"><?php echo gettext("Postal Code"); ?></label>
                                <input type="text" class="form-control" id="PostalCode" name="PostalCode" placeholder="<?php echo gettext("Enter Your Postal Code"); ?>" value="<?php echo $userViewModel->PostalCode; ?>">
                            </div>       
                                                       
                            <button style="margin-top:10px;" type="submit" class="btn btn-default"><?php echo gettext("Update Profile"); ?></button>
                            <br />
                        </form>
                    </div>

                </div>
            </div>

            <div role="tabpanel" class="tab-pane" id="dangerZone">

                <div class="row">
                    <div class="col-md-6"> 
                        <h2><?php echo gettext("Password"); ?></h2>

                        <form action="<?php echo BASE_URL; ?>Account/changepassword" method="post">
                            <div class="form-group">
                                <label for="OldPassword"><?php echo gettext("Old Password"); ?></label>
                                <input type="password" class="form-control" id="OldPassword" name="OldPassword" placeholder="<?php echo gettext("Enter Old Password"); ?>">
                            </div>
                            <div class="form-group">
                                <label for="Password"><?php echo gettext("Password"); ?></label>
                                <input type="password" class="form-control" id="Password" name="Password" placeholder="<?php echo gettext("Enter Password"); ?>">
                            </div>
                            <div class="form-group">
                                <label for="RePassword"><?php echo gettext("Re-Type Password"); ?></label>
                                <input type="password" class="form-control" id="RePassword" name="RePassword" placeholder="<?php echo gettext("Re-Type Password"); ?>">
                            </div>

                            <button style="margin-top:10px;" type="submit" class="btn btn-default"><?php echo gettext("Change Password"); ?></button>
                            <br />
                        </form>
                        
                        <h2><?php echo gettext("Security Question"); ?></h2>
                        <form action="<?php echo BASE_URL; ?>Account/changesecurityquestion" method="post">
                            <div class="form-group">
                                <label for="Password"><?php echo gettext("Password"); ?></label>
                                <input type="password" class="form-control" id="Password" name="Password" placeholder="<?php echo gettext("Enter Password"); ?>">
                            </div>

                            <div class="form-group">
                                <label for="SecurityQuestionId"><?php echo gettext("Security Question"); ?></label>
                                <select class="form-control" name="SecurityQuestionId">
                                    <?php 
                                        foreach ($secureityQuestionDropdownValues as $dropdownValue) {
                                            echo "<option value='" . $dropdownValue->Value . "'>"; 
                                                echo $dropdownValue->Name;
                                            echo "</option>";
                                        } 
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="SecurityAnswer"><?php echo gettext("Security Question Answer"); ?></label>
                                <input type="text" class="form-control" id="SecurityAnswer" name="SecurityAnswer" placeholder="<?php echo gettext("Enter Your Answer"); ?>" value="">
                            </div>

                            <button style="margin-top:10px;" type="submit" class="btn btn-default"><?php echo gettext("Change Answer"); ?></button>
                            <br />
                        </form>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="update_profile_picture">

                <h2><?php echo gettext("Profile Picture"); ?></h2>

                <form action="<?php echo BASE_URL; ?>Account/changeprofilepicture" method="post" enctype="multipart/form-data">                    
                    <div class="form-group">
                        <input type="file" id="ProfilePicture" name="PictureFile" placeholder="<?php echo gettext("Re-Type Password"); ?>">
                    </div>

                    <button style="margin-top:10px;" type="submit" class="btn btn-default"><?php echo gettext("Change Profile Picture"); ?></button>
                    <br />
                </form>
                <hr />

                <h2><?php echo gettext("Background Picture"); ?></h2>

                <form action="<?php echo BASE_URL; ?>Account/changebackgroundpicture" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <!-- <label for="BackgroundPicture"><?php echo gettext("Re-Type Password"); ?></label> -->
                        <input type="file" id="BackgroundPicture" name="PictureFile" placeholder="<?php echo gettext("Re-Type Password"); ?>">
                    </div>

                    <button style="margin-top:10px;" type="submit" class="btn btn-default"><?php echo gettext("Change Background Picture"); ?></button>
                    <br />
                </form>
            </div>
        </div>
    </div>
</div>
