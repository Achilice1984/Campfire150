    </div> <!-- End #c150-body -->

    <div id="c150-foot">
        <footer class="container">
            <div class="row">
                <div class="col-md-6">     
                    <h3><?php echo gettext("Site Links"); ?></h3>   
                    <ul>
                       <!--  <li>
                            <a href="<?php echo BASE_URL; ?>"><?php echo gettext("Home"); ?></a>
                        </li>
                        <li>
                            <a href="<?php echo BASE_URL; ?>story/search"><?php echo gettext("Stories"); ?></a>
                        </li>
                        <li>
                            <a href="<?php echo BASE_URL; ?>account/search"><?php echo gettext("Users"); ?></a>
                        </li>
                        <li>
                            <a href="<?php echo BASE_URL; ?>home/domore"><?php echo gettext("Do More"); ?></a>
                        </li> -->
                        <li>
                            <a href="<?php echo BASE_URL; ?>home/mission"><?php echo gettext("Mission / Vision"); ?></a>
                        </li>
                        <li>
                            <a href="<?php echo BASE_URL; ?>home/partners"><?php echo gettext("Our Partners"); ?></a>
                        </li>
                        <li>
                            <a href="<?php echo BASE_URL; ?>home/contact"><?php echo gettext("Contact Us"); ?></a>
                        </li>
                    </ul>            
                </div>
                <div class="col-md-6">    
                    <h3><?php echo gettext("Social Links"); ?></h3>  

                    <a style="text-decoration: none; padding-top: 10px;" data-toggle="tooltip" title="<?php echo gettext("Find us on Facebook"); ?>" href="https://www.facebook.com/campfireproject" >
                        <img src="<?php echo BASE_URL; ?>static/images/fb_icon.png">  
                    </a>

                    <a style="text-decoration: none; padding-top: 10px;" data-toggle="tooltip" title="<?php echo gettext("Find us on Twitter"); ?>" href="https://twitter.com/campfire150" >
                        <img src="<?php echo BASE_URL; ?>static/images/tw_icon.png">  
                    </a>             
                </div>
            </div>
            <p style="padding-top: 10px;">&copy; <?php echo date("Y"); ?>, Campfire 150</p>
        </footer>
    </div> <!-- End #c150-foot -->	
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo BASE_URL; ?>static/plugins/jquery/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo BASE_URL; ?>static/plugins/bootstrap/js/bootstrap.min.js"></script>       

    <?php //Loads js files
        foreach (@$this->js as $js) { ?>
            <script src="<?php echo $js;?>"></script>
    <?php } ?>

    <script type="text/javascript">
        function init_tooltip()
        {
            $('[data-toggle="tooltip"]').tooltip();
        }

        $(function(){
            init_tooltip();
        });
    </script>
    
    <input type="hidden" id="base_url" value="<?php echo BASE_URL; ?>">
    <input type="hidden" id="LanguagePreference" value="<?php if($_SESSION['languagePreference'] == "en_CA") { echo "en_US"; } else{ echo "fr_FR"; } ?>">
     
  </body>
</html>