
<?php
	// debugit($storyViewModel);
	// debugit($userViewModel);
	debugit($dropdownListItemViewModel);
?>
<div class="container">

	<h1><?php echo gettext("Edit answer for a website dropdown"); ?></h1>

    <div class="row">
		
		<div class="col-md-6">
			<form action="<?php echo BASE_URL; ?>admin/dropdownedit" method="post" id="dropdownForm">
				<input type="hidden" name="ID" value="<?php echo $dropdownItemViewModel->Id; ?>">

	            <?php include(APP_DIR . 'views/shared/messages.php'); ?>

	            <div class="form-group">
	                <label for="NameEng"><?php echo gettext("English"); ?></label>
	                <textarea class="form-control" id="eng" name="eng" value="<?php echo $dropdownListItemViewModel->NameE; ?>"></textarea>
	                <label for="NameFra"><?php echo gettext("French"); ?></label>
	                <textarea class="form-control" id="fra" name="fra" value="<?php echo $dropdownListItemViewModel->NameF; ?>"></textarea>
	            </div>
	            

	            <button type="submit" class="btn btn-default"><?php echo gettext("Submit"); ?></button>
	        </form>
        </div>
    </div>
</div>