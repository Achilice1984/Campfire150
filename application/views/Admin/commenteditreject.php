
<?php
	// debugit($storyViewModel);
	// debugit($userViewModel);
	// debugit($aprovalViewModel);
?>
<div class="container" style="margin-top:100px;">

	<h1>Edit reject COMMENT</h1>

    <div class="row">
		
		<div class="col-md-6">
			<form action="<?php echo BASE_URL; ?>account/login" method="post" id="loginForm">

				<input type="hidden" name="Id" value="<?php echo $aprovalViewModel->Id; ?>">

	            <?php 
	                //Add error message block to the page
	                include(APP_DIR . 'views/shared/displayErrors.php'); 

	                //Add success message block to the page
	                include(APP_DIR . 'views/shared/displaySuccess.php'); 
	            ?>

	            <div class="checkbox">
	                <label>
	                    <input type="checkbox" name="Approved" value="<?php echo $aprovalViewModel->Approved; ?>"> <?php echo gettext("Approve Story"); ?>
	                </label>
	            </div>
	            <div class="form-group">
	                <label for="Content"><?php echo gettext("Response"); ?></label>
	                <textarea class="form-control" id="Password" name="Password"><?php echo $aprovalViewModel->Content; ?></textarea>
	            </div>
	            

	            <button type="submit" class="btn btn-default"><?php echo gettext("Submit"); ?></button>
	        </form>
        </div>
    </div>
</div>