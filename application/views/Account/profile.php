<div class="container">
    <h1>Title</h1>

    <?php
        $validationResult = $viewModel->getValidationResult();
        
        include(APP_DIR . 'views/shared/displayErrors.php');
    ?>

    <form action="<?php echo BASE_URL; ?>Account/update" method="post">
         <div class="form-group">
                <label for="userEmail">Email address</label>
                <input type="email" class="form-control" id="userEmail" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="userPassword">Password</label>
                <input type="password" class="form-control" id="userPassword" placeholder="Enter Password">
            </div>
            <div class="form-group">
                <label for="registerDate">Register Date</label>
                <input type="date" class="form-control" id="registerDate">
            </div>
            <div class="form-group">
                <label for="userAddress">Address</label>
                <input type="text" class="form-control" id="userAddress" placeholder="Enter Your Address">
            </div>
            <div class="form-group">
                <label for="pCode">Postal Code</label>
                <input type="text" class="form-control" id="pCode" placeholder="Enter Your Postal Code">
            </div>
            <div class="form-group">
                <label for="notes">Notes</label>
                <textarea class="form-control" id="notes"></textarea>
            </div>
            <div class="form-group">
                <label for="achievement">Achievement Level</label>
                <select class="form-control" id="achievement">
                    <option value="user1">New User</option>
                    <option value="user2">Regular User</option>
                    <option value="user3">Trusted User</option>
                </select>
            </div>        
            <label for="language">Language</label>      
            <div class="checkbox">
                <label>
                    <input type="checkbox" id="language" value="en">English &nbsp; &nbsp;
                </label>
                <label>    
                    <input type="checkbox" id="language" value="fr">French
                </label>
            </div>
            <div class="form-group">
                <label for="firstName">First Name</label>
                <input type="text" class="form-control" id="firstName" placeholder="Enter Your First Name">
            </div>
            <div class="form-group">
                <label for="midName">Middle Name</label>
                <input type="text" class="form-control" id="midName" placeholder="Enter Your Middle Name">
            </div>
            <div class="form-group">
                <label for="lastName">Last Name</label>
                <input type="text" class="form-control" id="lastName" placeholder="Enter Your Last Name">
            </div>
            <button type="submit" class="btn btn-default">Register</button>
            <br />
        </form>
</div>