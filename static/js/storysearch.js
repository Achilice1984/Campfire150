$("#StorySearchMoreButton").click(function(){

	$("#StorySearchPage").val($("#StorySearchPage").val() + 1);

	$.ajax({
		type: "POST",
		url: $("#StorySearchForm").attr("data-ajax-action"),
		data: $("#StorySearchForm").serialize(),
		success: function(data){
			if(data)
			{
				$("#StorySearchContainer").append(data).show("slow");
			}
			else
			{
				$("#StorySearchInfoBar").show();
			}
		}
	});
});

$("#StorySearchForm").submit(function(event){

	// event.preventDefault();
	// $("#StorySearchPage").val(1);

	// $("#StorySearchContainer").hide();

	// $.ajax({
	// 	type: "POST",
	// 	url: $("#StorySearchForm").attr("data-ajax-action"),
	// 	data: $("#StorySearchForm").serialize(),
	// 	success: function(data){		

	// 		$("#StorySearchContainer").html(data).show("slow");

	// 		if(data)
	// 		{
	// 			$("#StorySearchMoreButton").show();
	// 		}
	// 	}
	// });

});