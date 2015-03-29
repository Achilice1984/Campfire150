<?php
	echo "<tr><td class='actionTakenTd'><h3>" . ($currentUser->LanguagePreference == "en_CA" ? $action->NameE : $action->NameF) . " <small>" . date("Y-m-d", strtotime($action->DateCreated)) . "</small></h3>";

	echo "<div style='font-size:1.2em; padding-left:10px;'>" . $action->Content . "</div>";
?>
	<div class="actionTakenDiv">
		<?php if ($currentUser->UserId == $action->user_UserId): ?>
			
			<a style="float: left; margin-left:15px; margin-top:15px;" class="btn btn-danger removeAction" data-action="<?php echo BASE_URL . "account/removeAction/"; ?>" data-action-id="<?php echo $action->ActionsTakenId; ?>" href="#"><?php echo gettext("Remove"); ?></a>
			<div style="float: left; margin-left:10px" id="ActionTakenSpinerDiv">
				<?php include(APP_DIR . 'views/shared/_spinner_small.php'); ?>
			</div>
		<?php endif ?>
	</div>
<?php
	echo "</td></tr>";
?>