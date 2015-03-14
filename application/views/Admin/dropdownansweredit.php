<?php
	// debugit($storyViewModel);
	// debugit($userViewModel);
	debugit($dropdownListItemViewModel);
?>
<div class="container" style="margin-top:100px;">

	<h1>Edit answer for a website dropdown</h1>

    <div class="row">
		
		<div class="col-md-6">
			<form action="<?php echo BASE_URL; ?>account/login" method="post" id="loginForm">


	            <?php include(APP_DIR . 'views/shared/messages.php'); ?>

	            <div class="checkbox">
	                <label>
	                    <input type="checkbox" name="Approved" value="xx"> <?php echo gettext($dropdownListItemViewModel->NameE); ?>
	                </label>
	            </div>
	            <div class="form-group">
	                <label for="Content"><?php echo gettext("Response"); ?></label>
	                <textarea class="form-control" id="Password" name="Password"><?php echo $dropdownListItemViewModel->NameF; ?></textarea>
	            </div>
	            

	            <button type="submit" class="btn btn-default"><?php echo gettext("Submit"); ?></button>
	        </form>
        </div>
    </div>
</div>