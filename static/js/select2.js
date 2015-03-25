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
		},
		// createTag:function(term, data) {
		// 	alert(term.toSource());
		//   if ($(data).filter(function() {
		//     return this.text.localeCompare(term)===0;
		//   }).length===0) {
		//     return {id:term, text:term};
		//   }
		// },
	});

	$('.multiSelect5').select2({
		allowClear: true,
		placeholder:"",
		maximumSelectionLength: 5
	});
});  


$(document.body).on('select2:select', function (event) {
	$('form').formValidation('revalidateField', $(event.target).parent("div").find(".form-control").attr("name"));
});

$(document.body).on('change', '[data-fv-field]', function (event) {
	$('form').formValidation('revalidateField', $(this).attr("name"));
});
