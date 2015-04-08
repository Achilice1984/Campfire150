<section class="storySummary">
	<?php
		echo "<h2>" . ($currentUser->LanguagePreference == "en_CA" ? $action->NameE : $action->NameF) . "</h2>";
		
	?>
	<div class="actionTakenDiv">
		<?php if ($currentUser->UserId == $action->user_UserId) { ?>
			<div class="row">
				<div class="col-xs-8">
				<p><?php echo date("M d, Y", strtotime($action->DateCreated)); ?></p>
				<p><?php echo $action->Content; ?></p>
			</div>
			<div class="col-xs-4">
				<p>
					<a class="btn btn-danger btn-block removeAction" data-action="<?php echo BASE_URL . "account/removeAction/"; ?>" data-action-id="<?php echo $action->ActionsTakenId; ?>" href="#"><?php echo gettext("Remove"); ?></a>
				</p>
				<div style="float: left; margin-left:10px" id="ActionTakenSpinerDiv">
					<?php include(APP_DIR . 'views/shared/_spinner_small.php'); ?>
				</div>
			</div>
		<?php } else { ?>
			<p><?php echo date("M d, Y", strtotime($action->DateCreated)); ?></p>
			<p><?php echo $action->Content; ?></p>
		<?php } ?>
	</div>
</section>
