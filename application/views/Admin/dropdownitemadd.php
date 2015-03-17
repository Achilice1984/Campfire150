<div class="container" style="margin-top:100px;">

	<h2>Add a new <?php echo gettext($dropdownListItemViewModel->TableName); ?></h2>

    <div class="row">
		
		<div class="col-md-6">
			<form action="<?php echo BASE_URL . "admin/dropdownitemadd/" . $dropdownListItemViewModel->TableName; ?>" 
				method="post" id="loginForm">

	            <?php include(APP_DIR . 'views/shared/messages.php'); ?>

	            <div class="form-group">
	                <label for="Content"><?php echo gettext("English Version"); ?></label>
	                <textarea class="form-control" id="NameE" name="NameE"><?php echo $dropdownListItemViewModel->NameE; ?></textarea>

	            </div>
	            <div class="form-group">
	                <label for="Content"><?php echo gettext("French Version"); ?></label>
	                <textarea class="form-control" id="NameE" name="NameF"><?php echo $dropdownListItemViewModel->NameF; ?></textarea>

	            </div>	            
	            <button type="submit" class="btn btn-default"><?php echo gettext("Add"); ?></button>
	        </form>

        </div>
    </div>
</div>