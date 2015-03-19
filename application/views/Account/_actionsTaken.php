<?php
	echo "<tr><td><h3>" . ($currentUser->LanguagePreference == "en_CA" ? $action->NameE : $action->NameF) . " <small>" . date("Y-m-d", strtotime($action->DateCreated)) . "</small></h3>";

	echo "<div style='font-size:1.2em; padding-left:10px;'>" . $action->Content . "</div>";

	echo "</td></tr>";
?>