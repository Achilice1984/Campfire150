
<div class="container">
 
    <h1>Admin Portal</h1> 

    <div role="tabpanel">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#Stories" aria-controls="Stories" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-file"></span> Stories</a></li>
            <li role="presentation"><a href="#Comments" aria-controls="Comments" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-comment"></span> Comments</a></li>
            <li role="presentation"><a href="#Users" aria-controls="Users" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-user"></span> Users</a></li>
            <li role="presentation"><a href="#Story_Questionaire" aria-controls="Story_Questionaire" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-question-sign"></span> Story Questionaire</a></li>
            <li role="presentation"><a href="#User_Questions" aria-controls="User_Questions" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-question-sign"></span> User Questions</a></li>
            <li role="presentation"><a href="#Website_Dropdowns" aria-controls="Website_Dropdowns" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-list"></span> Website Dropdowns</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content" style="padding:20px;">
            <div role="tabpanel" class="tab-pane active" id="Stories"> 

                <ul class="nav nav-pills">
                    <li role="presentation" class="active"><a href="#Stories_PendingApproal" aria-controls="Stories_PendingApproal" role="tab" data-toggle="tab">Pending Approval</a></li>
                    <li role="presentation"><a href="#Stories_Rejected" aria-controls="Stories_Rejected" role="tab" data-toggle="tab">Rejected</a></li>
                    <li role="presentation"><a href="#Stories_Inappropriate" aria-controls="Stories_Inappropriate" role="tab" data-toggle="tab">Inappropriate</a></li>
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
                </ul>   

                <div class="tab-content" style="padding:20px;">
                    <div role="tabpanel" class="tab-pane active" id="Comments_Rejected">
                        <table class="display dataTableAuto" data-table-url="<?php echo BASE_URL; ?>Admin/AjaxCommentListRejected" style="display:none;">
                            <thead>
                                <tr>
                                    <th>Story Title</th>
                                    <th>Comment Owner</th>
                                    <th>Comment Date</th>                                    
                                   
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
                                    <th>Comment Owner</th>
                                    <th>Comment Date</th>                                    
                                   
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
                    <li role="presentation" class="active"><a href="#Users_Find" aria-controls="Users_Find" role="tab" data-toggle="tab">Find Users</a></li>
                    <li role="presentation"><a href="#Users_Disabled_Account" aria-controls="Users_Disabled_Account" role="tab" data-toggle="tab">Disabled Accounts</a></li>
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
                                   
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div> 
                </div>

            </div>
            <div role="tabpanel" class="tab-pane" id="Story_Questionaire">

             <!--   List of questions for story questionaire -->
                <ul class="nav nav-pills">
                    <li role="presentation" class="active"><a href="#Questions_Find" aria-controls="Users_Find" role="tab" data-toggle="tab">Find Questions</a></li>
                    <li role="presentation"><a href="#Users_Disabled_Account" aria-controls="Users_Disabled_Account" role="tab" data-toggle="tab">Disabled Accounts</a></li>
                    <li role="presentation"><a href="#Users_Inappropriate" aria-controls="Users_Inappropriate" role="tab" data-toggle="tab">Ranked By Inappropriate Flags Issued</a></li>
                </ul>   

                <div class="tab-content" style="padding:20px;">
                    <div role="tabpanel" class="tab-pane active" id="Questions_Find">
                        <!--This table will contain all users -->
                        <table class="display dataTableAuto" data-table-url="<?php echo BASE_URL; ?>Admin/AjaxStoryQuestionList" style="display:none;">
                            <thead>
                                <tr>
                                    <th>English Name</th>
                                    <th>French Name</th>
                                    <th>Date Created</th>
                                   
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
                                   
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div> 
                </div>

            </div>
            <div role="tabpanel" class="tab-pane" id="User_Questions">

                List of questions that may be asked

            </div>
            <div role="tabpanel" class="tab-pane" id="Website_Dropdowns">

                List of dropdowns used in the website

            </div>
        </div>

    </div>
</div>