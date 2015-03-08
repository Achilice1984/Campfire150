$(function(){
	// $('select').select2({
	// 	allowClear: true,
	// 	placeholder:""
	// });

	$('#Tags').select2({
		tags: true,
		tokenSeparators: [',', ' '],
		minimumInputLength: 1,	
		placeholder: $('#Tags').attr("placeholder"),
		createSearchChoice: function(term) {
			alert("ss");
	  	},
	 	ajax: {		
			url: $("#base_url").val() + "story/searchtag",
			dataType: 'json',
			delay: 250,
			data: function (params) {
				return {
					q: params.term
				};
			},
			processResults: function (data) {
				// parse the results into the format expected by Select2.
				// since we are using custom formatting functions we do not need to
				// alter the remote JSON data
				return {
					results: data
				};
			},
			cache: true
		}
	});

	$('.multiSelect5').select2({
		allowClear: true,
		placeholder:"",
		maximumSelectionLength: 5
	});
});  
