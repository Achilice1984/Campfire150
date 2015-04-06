$(document.body).on('click', "#CommentStoryMoreButton", function(){

	$("#CommentPage").val(parseInt($("#CommentPage").val()) + 1);

	$.ajax({
		type: "POST",
		url: $("#CommentUrl").val(),
		data: { 
			CommentPage: 	 $("#CommentPage").val(),
			Comment_StoryId: $("#Story_StoryId").val()
		},
		success: function(data){
			if(data)
			{
				$("#comment-list").append(data).show("slow");

				init_tooltip();
			}
			else
			{
				$("#CommentInfoBar").show();

				$("#CommentStoryMoreButton").hide();
			}
		},
		beforeSend: function(){
			$("#CommentStoryMoreButton .spinner_large").removeClass("hide");
		},
		complete: function(){
			$("#CommentStoryMoreButton .spinner_large").addClass("hide");
		}
	});
});

$(document.body).on('click', "#ShowCommentsButton", function(){
	$("#commentsContainer").show();
	$("#ShowCommentsButton").hide();
});

$(document.body).on('click', "#postCommentButton", function(event){
	event.preventDefault();
	event.stopPropagation();

	$("#CommentSubmitInfoBar").hide();
	$("#CommentSubmitInfoBarError").hide();

	$.ajax({
		type: "POST",
		url: $("#AddCommentForm").attr("action"),
		data: $("#AddCommentForm").serialize(),
		success: function(data){		

			if(data === "true")
			{
				$("#Content").val("");

				$("#CommentSubmitInfoBar").show();
			}
			else
			{
				$("#CommentSubmitInfoBarError").show();
			}
		},
		beforeSend: function(){
			$("#AddCommentSpinerDiv .spinner_small").removeClass("hide");
		},
		complete: function(){
			$("#AddCommentSpinerDiv .spinner_small").addClass("hide");
		}
	});
});


$(document.body).on('click', ".StoryRecommendButton", function(event){
	event.preventDefault();

	var thisRecom = $(this);
	// var recomSpan = thisRecom.closest("h4").find(".totalRecommendsSpan");
	// var flagButton = thisRecom.closest(".StoryRowSection").find(".StoryFlagButton");
	// var flagSpan = thisRecom.closest(".StoryRowSection").find(".totalFlagsSpan");

	var reqType = thisRecom.attr("data-request-type");

	var url = $(this).attr("href");
	url = url.substring(0, url.length - 1) + reqType;

	$.ajax({
		type: "GET",
		url: url,
		success: function(data){

			if(data)
			{
				$(".StoryRecommendButton").attr("data-request-type", (reqType == 1 ? "0" : "1"));

				if($(".StoryRecommendButton").hasClass("text-default"))
				{
					$(".StoryRecommendButton").removeClass("text-default").addClass("StoryActionButtons");

					$(".totalRecommendsSpan").html(parseInt($(".totalRecommendsSpan").first().text()) - 1);
				}
				else
				{
					$(".StoryRecommendButton").removeClass("StoryActionButtons").addClass("text-default");

					$(".totalRecommendsSpan").html(parseInt($(".totalRecommendsSpan").first().text()) + 1);

					if($(".StoryFlagButton").hasClass("text-danger"))
					{
						$(".StoryFlagButton").removeClass("text-danger").addClass("StoryActionButtons");

						$(".totalFlagsSpan").html(parseInt($(".totalFlagsSpan").first().text()) - 1);

						$(".StoryFlagButton").attr("data-request-type", "1");
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
	// var flagSpan = thisFlag.closest("h4").find(".totalFlagsSpan");
	// var recommendButton = thisFlag.closest(".StoryRowSection").find(".StoryRecommendButton");
	// var recommendSpan = thisFlag.closest(".StoryRowSection").find(".totalRecommendsSpan");

	var reqType = thisFlag.attr("data-request-type");

	var url = $(this).attr("href");
	url = url.substring(0, url.length - 1) + reqType;

	$.ajax({
		type: "GET",
		url: url,
		success: function(data){

			if(data)
			{
				$(".StoryFlagButton").attr("data-request-type", (reqType == 1 ? "0" : "1"));

				if($(".StoryFlagButton").hasClass("text-danger"))
				{
					$(".StoryFlagButton").removeClass("text-danger").addClass("StoryActionButtons");

					$(".totalFlagsSpan").html(parseInt($(".totalFlagsSpan").first().text()) - 1);
				}
				else
				{
					$(".StoryFlagButton").removeClass("StoryActionButtons").addClass("text-danger");

					$(".totalFlagsSpan").html(parseInt($(".totalFlagsSpan").first().text()) + 1);

					if($(".StoryRecommendButton").hasClass("text-default"))
					{
						$(".StoryRecommendButton").removeClass("text-default").addClass("StoryActionButtons");

						$(".totalRecommendsSpan").html(parseInt($(".totalRecommendsSpan").first().text()) - 1);

						$(".StoryRecommendButton").attr("data-request-type", "1");
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

$(document.body).on('click', ".CommentFlagButton", function(event){
	event.preventDefault();

	var thisFlag = $(this);
	// var flagSpan = thisFlag.closest("h4").find(".totalFlagsSpan");
	// var recommendButton = thisFlag.closest(".StoryRowSection").find(".StoryRecommendButton");
	// var recommendSpan = thisFlag.closest(".StoryRowSection").find(".totalRecommendsSpan");

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
				}
				else
				{
					thisFlag.removeClass("StoryActionButtons").addClass("text-danger");
				}
			}
			else
			{
				$("#NotLoggedInModal").modal();
			}
		}
	});
});
