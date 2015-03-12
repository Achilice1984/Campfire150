<?php
	// debugit($storyViewModel);
	// debugit($userViewModel);
	debugit($dropdownListItemViewModel);
?>
<div class="container" style="margin-top:100px;">

	<h1>Add new item table <?php echo gettext($dropdownListItemViewModel->TableName); ?></h1>

    <div class="row">
		
		<div class="col-md-6">
			<form action="<?php echo BASE_URL . "admin/dropdownitemadd/" . $dropdownListItemViewModel->TableName; ?>" method="post" id="loginForm">


	            <?php include(APP_DIR . 'views/shared/messages.php'); ?>
	            <div class="form-group">
	                <label for="Content"><?php echo gettext("Reason"); ?></label>
	                <textarea class="form-control" id="NameE" name="NameE" value="<?php echo $dropdownListItemViewModel->NameE; ?>"></textarea>
	            </div>
	            <div class="form-group">
	                <label for="Content"><?php echo gettext("Reason"); ?></label>
	                <textarea class="form-control" id="NameF" name="NameF" value="<?php echo $dropdownListItemViewModel->NameF; ?>"></textarea>
	            </div>
	            

	            <button type="submit" class="btn btn-default"><?php echo gettext("Submit"); ?></button>
	        </form>
        </div>
    </div>
</div>