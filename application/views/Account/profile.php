<?php

    //You have access to the Account/ProfileViewModel.php
    
    //You can access everything from this variable:
    //uncomment to view structure in browser
    //debugit($userViewModel);

?>

<div class="row">
   <?php include(APP_DIR . 'views/shared/messages.php'); ?>
</div>

<div role="tabpanel">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs marginTop15 marginBottom15" role="tablist">
        <li role="presentation" class="active"><a href="#update_profile" aria-controls="update_profile" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-user"></span> <?php echo gettext("Profile"); ?></a></li>
        <li role="presentation"><a href="#dangerZone" aria-controls="dangerZone" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-console"></span> <?php echo gettext("Change Password"); ?></a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="update_profile">
            <div class="row">

                <div class="col-md-6"> 

                    <form id="profileForm" action="<?php echo BASE_URL; ?>account/profile" method="post">                            
                                                    
                        <h2><?php echo gettext("Profile Details"); ?></h2>

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

                        <div class="form-group">
                            <label for="YearsInCanada"><?php echo gettext("Years Living In Canada"); ?></label>
                            <select class="form-control" name="YearsInCanada">
                                <?php 
                                    for ($i=0; $i <= 100; $i++) { 
                                        echo "<option " . ($userViewModel->YearsInCanada == $i ? 'selected=selected' : "") . " value='" . $i . "'>"; 
                                            echo $i;
                                        echo "</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h2><?php echo gettext("Contact Details"); ?></h2>

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
                        <div class="form-group">
                            <label for="PostalCode"><?php echo gettext("Postal Code"); ?></label>
                            <input type="text" class="form-control" id="PostalCode" name="PostalCode" placeholder="<?php echo gettext("Enter Your Postal Code"); ?>" value="<?php echo $userViewModel->PostalCode; ?>">
                        </div>     

                        <div class="messageDiv"></div>  
                                                   
                        <div style="margin-left:10px" id="ProfileSpinerDiv">
                            <?php include(APP_DIR . 'views/shared/_spinner_small.php'); ?>
                        </div>
                        <button id="ProfileSubmitButton" type="submit" class="btn btn-primary btn-block"><?php echo gettext("Update Profile"); ?></button>
                        
                    </form>
                </div>

            </div>
        </div>

        <div role="tabpanel" class="tab-pane" id="dangerZone">

            <div class="row">
                <div class="col-md-6">                        

                    <form id="changePasswordForm" action="<?php echo BASE_URL; ?>Account/changepassword" method="post">
                        <h2><?php echo gettext("Password"); ?></h2>

                        <div class="messageDiv"></div>

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
                        
                        <div style=" margin-left:10px" id="PasswordSpinerDiv">
                            <?php include(APP_DIR . 'views/shared/_spinner_small.php'); ?>
                        </div>
                        <button id="PasswordSubmitButton" type="submit" class="btn btn-primary btn-block"><?php echo gettext("Change Password"); ?></button>
                        
                        <br />
                </div>
            </div>
        </div>
    </div>
</div>
