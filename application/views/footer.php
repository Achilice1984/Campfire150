	
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo BASE_URL; ?>/static/plugins/jquery/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo BASE_URL; ?>static/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo BASE_URL; ?>static/plugins/fittext/jquery.fittext.js"></script>  

    <script src="<?php echo BASE_URL; ?>static/plugins/validation/js/formValidation.min.js"></script> 
    <script src="<?php echo BASE_URL; ?>static/plugins/validation/js/framework/bootstrap.min.js"></script> 

    
    <script type="text/javascript" src="<?php echo BASE_URL; ?>static/plugins/validation/js/language/en_US.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>static/plugins/validation/js/language/fr_FR.js"></script>

    <input type="hidden" id="LanguagePreference" value="<?php if($_SESSION['languagePreference'] == "en_CA") { echo "en_US"; } else{ echo "fr_FR"; } ?>">

    <!-- Custom Scripts -->
    <script src="<?php echo BASE_URL; ?>static/js/validation.js"></script>



    <?php //Loads js files
        foreach (@$this->js as $js) { ?>
            <script src="<?php echo $js;?>"></script>
    <?php } ?>

  </body>
</html>