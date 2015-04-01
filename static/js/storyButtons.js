$(document.body).on('click', ".StoryRecommendButton", function(event){
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

			if(data)
			{
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
			else
			{
				$("#NotLoggedInModal").modal();
			}
		}
	});
});



$(document.body).on('click', ".StoryFlagButton", function(event){
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

			if(data)
			{
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
			else
			{
				$("#NotLoggedInModal").modal();
			}
		}
	});
});