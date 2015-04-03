<div class="container" style="margin-top:100px;">

	<h2>Edit a <?php echo gettext($dropdownListItemViewModel->TableName); ?></h2>

    <div class="row">
		
		<div class="col-md-6">
			<form action="<?php echo BASE_URL . "admin/dropdownitemedit/" . $dropdownListItemViewModel->TableName . '/' . $dropdownListItemViewModel->Id; ?>" 
				method="post" id="loginForm">

				<input type="hidden" name="Id" value="<?php echo $dropdownListItemViewModel->Id; ?>">

	            <?php include(APP_DIR . 'views/shared/messages.php'); ?>

	            <div class="form-group">
	                <label for="Content"><?php echo gettext("English Version"); ?></label>
	                <textarea class="form-control" id="NameE" name="NameE"><?php echo $dropdownListItemViewModel->NameE; ?></textarea>

	            </div>
	            <div class="form-group">
	                <label for="Content"><?php echo gettext("French Version"); ?></label>
	                <textarea class="form-control" id="NameE" name="NameF"><?php echo $dropdownListItemViewModel->NameF; ?></textarea>

	            </div>	            
	            <button type="submit" class="btn btn-default"><?php echo gettext("Update"); ?></button>

	            <hr style="border:2; height:2px; width:85%; color:#333; weight:2em;"/>
	            <div style="color:red">
		            <div class="form-group">
		            	<h4><?php echo gettext("CAUTION! Following Deactive Action is opotional. But if you checked the check box and confirmed this Action, you will not find this item again. And it may affect some exist account!"); ?></h4>
		                <label>
		                    <input type="checkbox" name="Active" value='FALSE'> <?php echo gettext("Deactive."); ?>
		                </label>
		            </div>
		            <button type="submit" name="btnDeactive" class="btn btn-default"><?php echo gettext("Confirm"); ?></button>
	            </div>
	        </form>

        </div>
    </div>
</div>