<?php

    //You have access to the shared/UserViewModel.php
    
    //You can access everything from this variable:
    //uncomment to view structure in browser
    //debugit($userViewModel);

?>   


<div class="container" style="margin-top:100px;">
    <div class="row">

        <div class="panel panel-default">
            <div class="panel-heading" style="font-size:1.4em; background-color:#3498db; color:white;">
                <?php echo gettext("Your about to register for Campfire 150"); ?>
            </div>
                <div class="panel-body">
                    <div class="col-md-6"> 

                        <form action="<?php echo BASE_URL; ?>account/register" method="post">
                            <?php 
                                //Add error message block to the page
                                include(APP_DIR . 'views/shared/displayErrors.php'); 

                                //Add success message block to the page
                                include(APP_DIR . 'views/shared/displaySuccess.php'); 
                            ?>

                            <h3><?php echo gettext("Profile Details"); ?></h3>
                            <hr />

                            <div class="form-group">
                                <label for="Email"><?php echo gettext("Email Address"); ?></label>
                                <input type="email" class="form-control" id="Email" name="Email" placeholder="<?php echo gettext("Enter Email"); ?>" value="<?php echo $userViewModel->Email; ?>">
                            </div>
                            <div class="form-group">
                                <label for="Password"><?php echo gettext("Password"); ?></label>
                                <input data-validation-match-match="RePassword" type="password" class="form-control" id="Password" name="Password" placeholder="<?php echo gettext("Enter Password"); ?>"><p class="help-block"></p>
                            </div>
                            <div class="form-group">
                                <label for="RePassword"><?php echo gettext("Re-Type Password"); ?></label>
                                <input type="password" class="form-control" id="RePassword" name="RePassword" placeholder="<?php echo gettext("Re-Type Password"); ?>"><p class="help-block"></p>
                            </div>

                            <div class="form-group">
                                <label for="SecurityQuestionId"><?php echo gettext("Security Question"); ?></label>
                                <select class="form-control" name="SecurityQuestionId">
                                    <?php 
                                        foreach ($secureityQuestionDropdownValues as $dropdownValue) {
                                            echo "<option " . ($userViewModel->SecurityQuestionId == $dropdownValue->Value ? 'selected=selected' : "") . " value='" . $dropdownValue->Value . "'>"; 
                                                echo $dropdownValue->Name;
                                            echo "</option>";
                                        } 
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="SecurityAnswer"><?php echo gettext("Security Question Answer"); ?></label>
                                <input type="text" class="form-control" id="SecurityAnswer" name="SecurityAnswer" placeholder="<?php echo gettext("Enter Your Answer"); ?>" value="<?php echo $userViewModel->SecurityAnswer; ?>">
                            </div>

                            <div class="form-group">
                                <label for="UserActionStatement"><?php echo gettext("User Action Statement"); ?></label>
                                <input type="text" class="form-control" id="UserActionStatement" name="UserActionStatement" placeholder="<?php echo gettext("Enter Your User Action Statement"); ?>" value="<?php echo $userViewModel->UserActionStatement; ?>">
                            </div>
                            
                            <h3><?php echo gettext("User Details"); ?></h3>
                            <hr />

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
                                <input type="text" class="form-control" id="PhoneNumber" name="PhoneNumber" placeholder="<?php echo gettext("Enter Your Phone Number"); ?>" value="<?php echo $userViewModel->PhoneNumber; ?>">
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
                                                       
                            <button style="margin-top:10px;" type="submit" class="btn btn-default"><?php echo gettext("Register"); ?></button>
                            <br />
                        </form>
                        <div style="padding-top:15px;"> 
                            <?php echo gettext("By clicking on 'Register', you confirm that you accept the Terms of Use."); ?> <a href="<?php echo BASE_URL; ?>home/terms"><?php echo gettext("Terms of Use"); ?></a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
