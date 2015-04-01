
<div class="container">
 
    <h1>Admin Portal</h1> 

    <div role="tabpanel">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#Stories" aria-controls="Stories" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-file"></span> Stories</a></li>
            <li role="presentation"><a href="#Comments" aria-controls="Comments" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-comment"></span> Comments</a></li>
            <li role="presentation"><a href="#Users" aria-controls="Users" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-user"></span> Users</a></li>
            <li role="presentation"><a href="#Story_Questionaire" aria-controls="Story_Questionaire" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-question-sign"></span> Story Questionaire</a></li>
            <li role="presentation"><a href="#Website_Dropdowns" aria-controls="Website_Dropdowns" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-list"></span> Website Dropdowns</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content" style="padding:20px;">
            <div role="tabpanel" class="tab-pane active" id="Stories"> 

                <ul class="nav nav-pills">
                    <li role="presentation" class="active"><a href="#Stories_PendingApproal" aria-controls="Stories_PendingApproal" role="tab" data-toggle="tab">Pending Approval</a></li>
                    <li role="presentation"><a href="#Stories_Rejected" aria-controls="Stories_Rejected" role="tab" data-toggle="tab">Rejected</a></li>
                    <li role="presentation"><a href="#Stories_Inappropriate" aria-controls="Stories_Inappropriate" role="tab" data-toggle="tab">Inappropriate</a></li>
                    <li role="presentation"><a href="#Stories_Published" aria-controls="Stories_Published" role="tab" data-toggle="tab">Published</a></li>  
                </ul>   

                <div class="tab-content" style="padding:20px;">
                    <div role="tabpanel" class="tab-pane active" id="Stories_PendingApproal">
                        <table class="display dataTableAuto" data-table-url="<?php echo BASE_URL; ?>Admin/AjaxStoryListPending" style="display:none;">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Owner</th>
                                    <th>Posted Date</th> 
                                    <th>Action</th>                              
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>  
                    <div role="tabpanel" class="tab-pane" id="Stories_Rejected">
                        <table class="display dataTableAuto" data-table-url="<?php echo BASE_URL; ?>Admin/AjaxStoryListRejected" style="display:none;">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Owner</th>
                                    <th>Posted Date</th> 
                                    <th>Action</th>                                    
                                   
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>  
                    <div role="tabpanel" class="tab-pane" id="Stories_Inappropriate">
                        <table class="display dataTableAuto" data-table-url="<?php echo BASE_URL; ?>Admin/AjaxStoryListInappropriate" style="display:none;">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Owner</th>
                                    <th>Posted Date</th>  
                                    <th>Action</th>                                   
                                   
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div> 
                    <div role="tabpanel" class="tab-pane" id="Stories_Published">
                        <table class="display dataTableAuto" data-table-url="<?php echo BASE_URL; ?>Admin/AjaxStoryListPublished" style="display:none;">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Owner</th>
                                    <th>Posted Date</th> 
                                    <th>Action</th>                                    
                                   
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div> 
                </div>       

            </div>
            <div role="tabpanel" class="tab-pane" id="Comments">

                <ul class="nav nav-pills">
                    <li role="presentation" class="active"><a href="#Comments_Rejected" aria-controls="Comments_Rejected" role="tab" data-toggle="tab">Rejected</a></li>
                    <li role="presentation"><a href="#Comments_Inappropriate" aria-controls="Comments_Inappropriate" role="tab" data-toggle="tab">Inappropriate</a></li>
                    <li role="presentation"><a href="#Comments_Published" aria-controls="Comments_Published" role="tab" data-toggle="tab">Published</a></li>
                </ul>   

                <div class="tab-content" style="padding:20px;">
                    <div role="tabpanel" class="tab-pane active" id="Comments_Rejected">
                        <table class="display dataTableAuto" data-table-url="<?php echo BASE_URL; ?>Admin/AjaxCommentListRejected" style="display:none;">
                            <thead>
                                <tr>
                                    <th>Story Title</th>
                                    <th>Comment Content</th>
                                    <th>Comment Date</th>
                                    <th>Action</th>                                    
                                   
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>  
                    <div role="tabpanel" class="tab-pane" id="Comments_Inappropriate">
                        <table class="display dataTableAuto" data-table-url="<?php echo BASE_URL; ?>Admin/AjaxCommentListInappropriate" style="display:none;">
                            <thead>
                                <tr>
                                    <th>Story Title</th>
                                    <th>Comment Content</th>
                                    <th>Inappropriate Flag Number</th> 
                                    <th>Action</th>                                     
                                   
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div> 
                    <div role="tabpanel" class="tab-pane" id="Comments_Published">
                        <table class="display dataTableAuto" data-table-url="<?php echo BASE_URL; ?>Admin/AjaxCommentListPublished" style="display:none;">
                            <thead>
                                <tr>
                                    <th>Story Title</th>
                                    <th>Comment Content</th>
                                    <th>Comment Date</th>
                                    <th>Action</th>                                    
                                   
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>  

            </div>
            <div role="tabpanel" class="tab-pane" id="Users">

                <ul class="nav nav-pills">
                    <li role="presentation" class="active"><a href="#Users_Find" aria-controls="Users_Find" role="tab" data-toggle="tab">Find Actived Users</a></li>
                    <li role="presentation"><a href="#Users_Disabled_Account" aria-controls="Users_Disabled_Account" role="tab" data-toggle="tab">Deactived Accounts</a></li>
                    <li role="presentation"><a href="#Users_Inappropriate" aria-controls="Users_Inappropriate" role="tab" data-toggle="tab">Ranked By Inappropriate Flags Issued</a></li>
                </ul>   

                <div class="tab-content" style="padding:20px;">
                    <div role="tabpanel" class="tab-pane active" id="Users_Find">
                        <!--This table will contain all users -->
                        <table class="display dataTableAuto" data-table-url="<?php echo BASE_URL; ?>Admin/AjaxUserList" style="display:none;">
                            <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>DateCreated</th>
                                    <th>Action</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>  
                    <div role="tabpanel" class="tab-pane" id="Users_Disabled_Account">
                        <!--This table will contain all users that are disabled -->
                        <table class="display dataTableAuto" data-table-url="<?php echo BASE_URL; ?>Admin/AjaxUserListDisabled" style="display:none;">
                            <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>DateCreated</th>
                                    <th>Action</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>  
                    <div role="tabpanel" class="tab-pane" id="Users_Inappropriate">
                        <!--This table will contain all users but order them by most inappropriate flags issued -->
                        <table class="display dataTableAuto" data-table-url="<?php echo BASE_URL; ?>Admin/AjaxUserListInappropriate" style="display:none;">
                            <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>DateCreated</th>
                                    <th>Inappropriate Flag Number</th> 
                                    <th>Action</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div> 
                </div>

            </div>

             <div role="tabpanel" class="tab-pane" id="Story_Questionaire">

                <ul class="nav nav-pills">
                    <li role="presentation" class="active"><a href="#Questions_Find" aria-controls="Questions_Find" role="tab" data-toggle="tab">Find Questions</a></li>
                    <li role="presentation"><a href="#Story_Answers_Find" aria-controls="Story_Answers_Find" role="tab" data-toggle="tab">Find Answers</a></li>
                </ul>   

                <div class="tab-content" style="padding:20px;">
                    <div role="tabpanel" class="tab-pane active" id="Questions_Find">
                       <table class="display dataTableAuto" data-table-url="<?php echo BASE_URL; ?>Admin/AjaxStoryQuestionList" style="display:none;">
                        
                            <thead>
                                <tr>
                                    <th>Question ID</th>
                                    <th>English Version</th>
                                    <th>French Version</th>
                                    <th>Date Created</th>
                                    <th>Action</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <h3> Add a new question <a href="<?php echo BASE_URL . 'admin/storyquestionadd' ?> ">here</a></h3>
                    </div>  
                    <div role="tabpanel" class="tab-pane" id="Story_Answers_Find">
                        <!--This table will contain all story answers -->
                        <table class="display dataTableAuto" data-table-url="<?php echo BASE_URL; ?>Admin/AjaxStoryAnswerList" style="display:none;">
                            <thead>
                                <tr>
                                    <th>Question ID</th>
                                    <th>Answer English Version</th>
                                    <th>Answer French Version</th>
                                    <th>Date Created</th>
                                    <th>Action</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <h3> Add a new answer <a href="<?php echo BASE_URL . 'admin/storyansweradd' ?> ">here</a></h3>
                    </div>
                </div>

            </div>
            <div role="tabpanel" class="tab-pane" id="Website_Dropdowns"> 

                <ul class="nav nav-pills">
                    <li role="presentation" class="active"><a href="#User_Questions_Find" aria-controls="User_Questions_Find" role="tab" data-toggle="tab">User' Security Questions</a></li>
                    <li role="presentation"><a href="#LanguageType_Find" aria-controls="LanguageType_Find" role="tab" data-toggle="tab">Language</a></li>
                    <li role="presentation"><a href="#GenderType_Find" aria-controls="GenderType_Find" role="tab" data-toggle="tab">Gender</a></li>
                    <li role="presentation"><a href="#AchievementLevelType_Find" aria-controls="AchievementLevelType_Find" role="tab" data-toggle="tab">Achievement</a></li>
                    <li role="presentation"><a href="#PictureType_Find" aria-controls="PictureType_Find" role="tab" data-toggle="tab">Picture</a></li>
                    <li role="presentation"><a href="#ProfilePrivacyType_Find" aria-controls="ProfilePrivacyType_Find" role="tab" data-toggle="tab">Profile Privacy</a></li>
                    <li role="presentation"><a href="#StoryPrivacyType_Find" aria-controls="StoryPrivacyType_Find" role="tab" data-toggle="tab">Story Privacy</a></li>
                </ul>   

                <div class="tab-content" style="padding:20px;">
                    <div role="tabpanel" class="tab-pane active" id="User_Questions_Find">
                        <!--This table will contain all users -->
                        <table class="display dataTableAuto" data-table-url="<?php echo BASE_URL; ?>Admin/AjaxUserSecurityQuestionList" style="display:none;">
                            <thead>
                                <tr>
                                    <th>English Version</th>
                                    <th>French Version</th>
                                    <th>Date Updated</th>
                                    <th>Action</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <h3> Add a new item <a href="<?php echo BASE_URL . 'admin/dropdownitemadd/securityquestion' ?> ">here</a></h3>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="LanguageType_Find">
                        <!--This table will contain all users -->
                        <table class="display dataTableAuto" data-table-url="<?php echo BASE_URL; ?>Admin/AjaxLanguageList" style="display:none;">
                            <thead>
                                <tr>
                                    <th>English Version</th>
                                    <th>French Version</th>
                                    <th>Date Updated</th>
                                    <th>Action</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <h3> Add a new item <a href="<?php echo BASE_URL . 'admin/dropdownitemadd/languagetype' ?> ">here</a></h3>
                    </div>  
                    <div role="tabpanel" class="tab-pane" id="GenderType_Find">
                        <!--This table will contain all users that are disabled -->
                        <table class="display dataTableAuto" data-table-url="<?php echo BASE_URL; ?>Admin/AjaxGenderList" style="display:none;">
                            <thead>
                                <tr>
                                    <th>English Version</th>
                                    <th>French Version</th>
                                    <th>Date Updated</th>
                                    <th>Action</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <h3> Add a new item <a href="<?php echo BASE_URL . 'admin/dropdownitemadd/gendertype' ?> ">here</a></h3>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="AchievementLevelType_Find">
                        <!--This table will contain all users -->
                        <table class="display dataTableAuto" data-table-url="<?php echo BASE_URL; ?>Admin/AjaxAchievementLevelList" style="display:none;">
                            <thead>
                                <tr>
                                    <th>English Version</th>
                                    <th>French Version</th>
                                    <th>Date Updated</th>
                                    <th>Action</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <h3> Add a new item <a href="<?php echo BASE_URL . 'admin/dropdownitemadd/achievementleveltype' ?> ">here</a></h3>
                    </div>  
                    <div role="tabpanel" class="tab-pane" id="PictureType_Find">
                        <!--This table will contain all users that are disabled -->
                        <table class="display dataTableAuto" data-table-url="<?php echo BASE_URL; ?>Admin/AjaxPictureTypeList" style="display:none;">
                            <thead>
                                <tr>
                                    <th>English Version</th>
                                    <th>French Version</th>
                                    <th>Date Updated</th>
                                    <th>Action</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <h3> Add a new item <a href="<?php echo BASE_URL . 'admin/dropdownitemadd/picturetype' ?> ">here</a></h3>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="ProfilePrivacyType_Find">
                        <!--This table will contain all users -->
                        <table class="display dataTableAuto" data-table-url="<?php echo BASE_URL; ?>Admin/AjaxProfilePrivacyTypeList" style="display:none;">
                            <thead>
                                <tr>
                                    <th>English Version</th>
                                    <th>French Version</th>
                                    <th>Date Updated</th>
                                    <th>Action</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <h3> Add a new item <a href="<?php echo BASE_URL . 'admin/dropdownitemadd/profileprivacytype' ?> ">here</a></h3>
                    </div>  
                    <div role="tabpanel" class="tab-pane" id="StoryPrivacyType_Find">
                        <!--This table will contain all users that are disabled -->
                        <table class="display dataTableAuto" data-table-url="<?php echo BASE_URL; ?>Admin/AjaxStoryPrivacyTypeList" style="display:none;">
                            <thead>
                                <tr>
                                    <th>English Version</th>
                                    <th>French Version</th>
                                    <th>Date Updated</th>
                                    <th>Action</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        <h3> Add a new item <a href="<?php echo BASE_URL . 'admin/dropdownitemadd/storyprivacytype' ?> ">here</a></h3>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>