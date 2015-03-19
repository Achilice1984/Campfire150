$(document.body).on('click', "#StorySearchMoreButton", function(){

	$("#StorySearchPage").val(parseInt($("#StorySearchPage").val()) + 1);

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

				$("#StorySearchMoreButton").hide();
			}
		}
	});
});

$(document.body).on('click', "#RecommendedStoryMoreButton", function(){

	$("#RecommendedStoryPage").val(parseInt($("#RecommendedStoryPage").val()) + 1);

	$.ajax({
		type: "POST",
		url: $("#RecommendedStoryUrl").val(),
		data: { RecommendedStoryPage: $("#RecommendedStoryPage").val() },
		success: function(data){
			if(data)
			{
				$("#RecommendedStoryContainer").append(data).show("slow");
			}
			else
			{
				$("#RecommendedStoryInfoBar").show();

				$("#RecommendedStoryMoreButton").hide();
			}
		}
	});
});

$(document.body).on('click', "#LatestStoryMoreButton", function(){

	$("#LatestStoryPage").val(parseInt($("#LatestStoryPage").val()) + 1);

	$.ajax({
		type: "POST",
		url: $("#LatestStoryUrl").val(),
		data: { LatestStoryPage: $("#LatestStoryPage").val() },
		success: function(data){
			if(data)
			{
				$("#LatestStoryContainer").append(data).show("slow");
			}
			else
			{
				$("#LatestStoryhInfoBar").show();

				$("#LatestStoryMoreButton").hide();
			}
		}
	});
});

// $("#StorySearchForm").submit(function(event){	
	
// 	event.stopPropagation();
// 	//event.preventDefault();

// 	$("#StorySearchPage").val(1);

// 	$("#StorySearchContainer").hide();
// 	$("#StorySearchMoreButton").hide();

// 	$.ajax({
// 		type: "POST",
// 		url: $("#StorySearchForm").attr("data-ajax-action"),
// 		data: $("#StorySearchForm").serialize(),
// 		success: function(data){		

// 			$("#StorySearchContainer").html(data).show("fast");

// 			if(data)
// 			{
// 				$("#StorySearchMoreButton").show();
// 			}
// 		}
// 	});
// });


// $(".StoryRecommendButton").click(function(event){	
	
// 	event.preventDefault();

// 	$.ajax({
// 		type: "GET",
// 		url: $(this).attr("href"),
// 		success: function(data){
// 			if($("#StoryRecommendButton").hasClass("text-default"))
// 			{
// 				$("#StoryRecommendButton").removeClass("text-default").addClass("StoryActionButtons");

// 				$("#totalRecommendsSpan").html(parseInt($("#totalRecommendsSpan").text()) - 1);
// 			}
// 			else
// 			{
// 				$("#StoryRecommendButton").removeClass("StoryActionButtons").addClass("text-default");

// 				$("#totalRecommendsSpan").html(parseInt($("#totalRecommendsSpan").text()) + 1);

// 				if($("#StoryFlagButton").hasClass("text-danger"))
// 				{
// 					$("#StoryFlagButton").removeClass("text-danger").addClass("StoryActionButtons");

// 					$("#totalFlagsSpan").html(parseInt($("#totalFlagsSpan").text()) - 1);
// 				}
// 			}
// 		}
// 	});
// });
