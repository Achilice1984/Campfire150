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
	}).show("slow");		    
} );    