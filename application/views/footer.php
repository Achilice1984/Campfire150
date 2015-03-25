    </div> <!-- End #c150-body -->

    <div id="c150-foot" class="bg-grey">
        <footer class="container">
            <p>&copy; <?php echo date("Y"); ?>, Campfire 150</p>
        </footer>
    </div> <!-- End #c150-foot -->	
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo BASE_URL; ?>/static/plugins/jquery/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo BASE_URL; ?>static/plugins/bootstrap/js/bootstrap.min.js"></script>       

    <?php //Loads js files
        foreach (@$this->js as $js) { ?>
            <script src="<?php echo $js;?>"></script>
    <?php } ?>
    
    <input type="hidden" id="base_url" value="<?php echo BASE_URL; ?>">
    <input type="hidden" id="LanguagePreference" value="<?php if($_SESSION['languagePreference'] == "en_CA") { echo "en_US"; } else{ echo "fr_FR"; } ?>">

  </body>
</html>