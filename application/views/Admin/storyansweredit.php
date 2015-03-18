
<?php
	// debugit($storyViewModel);
	// debugit($userViewModel);
	// debugit($storyAnswerViewModel);
?>
<div class="container" style="margin-top:100px;">

	<h2>Edit a <?php echo gettext("Story Answer"); ?></h2>

    <div class="row">
		
		<div class="col-md-6">
			<form action="<?php echo BASE_URL . "admin/storyansweredit/" . $storyAnswerViewModel->AnswerId; ?>" 
				method="post" id="loginForm">

				<input type="hidden" name="AnswerId" value="<?php echo $storyAnswerViewModel->AnswerId; ?>">

	            <?php include(APP_DIR . 'views/shared/messages.php'); ?>

	            <div class="form-group">
	                <label for="Content"><?php echo gettext("English Version"); ?></label>
	                <textarea class="form-control" id="NameE" name="NameE"><?php echo $storyAnswerViewModel->NameE; ?></textarea>

	            </div>
	            <div class="form-group">
	                <label for="Content"><?php echo gettext("French Version"); ?></label>
	                <textarea class="form-control" id="NameE" name="NameF"><?php echo $storyAnswerViewModel->NameF; ?></textarea>

	            </div>	            
	            <button type="submit" class="btn btn-default"><?php echo gettext("Update"); ?></button>
	        </form>

        </div>
    </div>
</div>