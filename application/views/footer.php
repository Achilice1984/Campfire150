	
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo BASE_URL; ?>/static/plugins/jquery/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo BASE_URL; ?>/static/plugins/bootstrap/js/bootstrap.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo BASE_URL; ?>/static/plugins/fittext/jquery.fittext.js"></script>

    <?php
        if(isset($datatables))
        {
            echo '<script src="' . BASE_URL . '/static/plugins/DataTables/media/js/jquery.dataTables.js"></script>';
        }

        if(isset($tinymce))
        {
            echo '<script src="' . BASE_URL . '/static/plugins/tinymce/js/tinymce/tinymce.min.js"></script>';
        }
    ?>   
    

    <script type="text/javascript">    	
        //A way to require javascript files in a page
        //Simply create an array of script files in a variable called: requiredScripts
        //for example, var requiredScripts = ["js/test", plugins/someplugin/someJsFile];

        //Checks to see if the variabel exists
        if(typeof requiredScripts !== 'undefined')
        {
            //insure scripts are rendered in correct order
            $.ajaxSetup({async:false});

            //An array of script files to include
            var scriptsToInclude = {};

            for (var i = 0; i < requiredScripts.length; i++) {
                
                //Add script file to array of scripts IF it doesn't already exist
                if(!scriptsToInclude[requiredScripts[i]]){
                    scriptsToInclude[requiredScripts[i]] = requiredScripts[i];   
                } 
            };

            for (var script in scriptsToInclude) {
                var baseURL = "<?php echo BASE_URL; ?>";
                baseURL += "static/";

                //Loop through an request all of the files
                $.getScript(baseURL + script + ".js", function( data, textStatus, jqxhr ) {
                    // console.log( data ); // Data returned
                    // console.log( textStatus ); // Success
                    // console.log( jqxhr.status ); // 200
                    // console.log( "Load was performed." );
                }); 
            };

            //Change back to default
            $.ajaxSetup({async:true});
        }

    </script>

  </body>
</html>