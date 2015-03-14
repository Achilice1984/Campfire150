$("#StorySearchMoreButton").click(function(){

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

$("#RecommendedStoryMoreButton").click(function(){

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

$("#LatestStoryMoreButton").click(function(){

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


$(".StoryRecommendButton").on("click", function(event){
	event.preventDefault();

	var thisRecom = $(this);
	var recomSpan = thisRecom.closest(".storyStatsDiv").find(".totalRecommendsSpan");
	var flagButton = thisRecom.closest(".storyStatsDiv").find(".StoryFlagButton");
	var flagSpan = thisRecom.closest(".storyStatsDiv").find(".totalFlagsSpan");

	var reqType = thisRecom.attr("data-request-type");

	var url = $(this).attr("href");
	url = url.substring(0, url.length - 1) + reqType;

	$.ajax({
		type: "GET",
		url: url,
		success: function(data){

			thisRecom.attr("data-request-type", (reqType == 1 ? "0" : "1"));

			if(thisRecom.hasClass("text-default"))
			{
				thisRecom.removeClass("text-default").addClass("StoryActionButtons");

				recomSpan.html(parseInt(recomSpan.text()) - 1);
			}
			else
			{
				thisRecom.removeClass("StoryActionButtons").addClass("text-default");

				recomSpan.html(parseInt(recomSpan.text()) + 1);

				if(flagButton.hasClass("text-danger"))
				{
					flagButton.removeClass("text-danger").addClass("StoryActionButtons");

					flagSpan.html(parseInt(flagSpan.text()) - 1);

					flagButton.attr("data-request-type", "1");
				}
			}
		}
	});
});



$(".StoryFlagButton").on("click", function(event){
	event.preventDefault();

	var thisFlag = $(this);
	var flagSpan = thisFlag.closest(".storyStatsDiv").find(".totalFlagsSpan");
	var recommendButton = thisFlag.closest(".storyStatsDiv").find(".StoryRecommendButton");
	var recommendSpan = thisFlag.closest(".storyStatsDiv").find(".totalRecommendsSpan");

	var reqType = thisFlag.attr("data-request-type");

	var url = $(this).attr("href");
	url = url.substring(0, url.length - 1) + reqType;

	$.ajax({
		type: "GET",
		url: url,
		success: function(data){

			thisFlag.attr("data-request-type", (reqType == 1 ? "0" : "1"));

			if(thisFlag.hasClass("text-danger"))
			{
				thisFlag.removeClass("text-danger").addClass("StoryActionButtons");

				flagSpan.html(parseInt(flagSpan.text()) - 1);
			}
			else
			{
				thisFlag.removeClass("StoryActionButtons").addClass("text-danger");

				flagSpan.html(parseInt(flagSpan.text()) + 1);

				if(recommendButton.hasClass("text-default"))
				{
					recommendButton.removeClass("text-default").addClass("StoryActionButtons");

					recommendSpan.html(parseInt(recommendSpan.text()) - 1);

					recommendButton.attr("data-request-type", "1");
				}
			}
		}
	});
});