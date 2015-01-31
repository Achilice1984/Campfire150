	
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo BASE_URL; ?>/static/plugins/jquery/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo BASE_URL; ?>/static/plugins/bootstrap/js/bootstrap.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo BASE_URL; ?>/static/plugins/fittext/jquery.fittext.js"></script>
    <script src="<?php echo BASE_URL; ?>/static/plugins/DataTables/media/js/jquery.dataTables.js"></script>

    <script type="text/javascript">
    	// A set of initializers
    	$(document).ready( function () {
    		$('.dataTableAuto').each(function(){
    			$(this).DataTable({
			  		"processing": true,
		        	"serverSide": true,
		        	"ajax": {
			            "url": $(this).attr("data-table-url"),
			            "type": "POST"
			        }
				});
    		});		    
		} );
    </script>

  </body>
</html>