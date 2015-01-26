<?php 

echo gettext("welcome to the site");
echo gettext("welcometothesite");

echo "<br />";

echo gettext("testkey");
?>
	
<div id="content">
    
    <h1>Campfire 150</h1>
    
    <?php
    	$validationResult = $testViewModel->getValidationResult();
        
    	include(APP_DIR . 'views/shared/displayErrors.php');
    ?>

    <form action="<?php echo BASE_URL; ?>home/homeformsubmit" method="post">
		Name: <input type="text" name="name" value="<?php echo $testViewModel->name; ?>" <?php echo $testViewModel->getValidationAttribute("name") ?>><br>
		E-mail: <input type="text" name="email" value="<?php echo $testViewModel->email; ?>" <?php echo $testViewModel->getValidationAttribute("email") ?> ><br>
		<input type="submit">
	</form>
    
</div>