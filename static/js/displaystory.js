$("#CommentStoryMoreButton").click(function(){

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
			}
			else
			{
				$("#CommentInfoBar").show();

				$("#CommentStoryMoreButton").hide();
			}
		}
	});
});

$("#ShowCommentsButton").click(function(){
	$("#commentsContainer").show();
	$("#ShowCommentsButton").hide();
});

$("#postCommentButton").click(function(event){
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
		}
	});
});


$(".StoryRecommendButton").on("click", function(event){
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
	});
});



$(".StoryFlagButton").on("click", function(event){
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
	});
});

$(".FollowButton").click(function (event) {
	event.preventDefault();

	var thisButton = $(this);

	var url = $(this).attr("data-ajaxurl");
	var userId = $(this).attr("data-userId");
	var newText = $(this).attr("data-additional-text");
	var oldText = $(this).text();

	var followUser = 1;

	if($(this).hasClass("btn-info"))
	{
		followUser = 0;
	}	

	$.ajax({
		type: "POST",
		url: url,
		data: { FollowUser: followUser, UserID: userId },
		success: function(data){

			thisButton.html('<span class="glyphicon glyphicon-user"></span> ' + newText);
			thisButton.attr("data-additional-text", oldText);

			if(followUser === 1)
			{
				thisButton.removeClass("btn-default");
				thisButton.addClass("btn-info");
			}
			else
			{
				thisButton.removeClass("btn-info");
				thisButton.addClass("btn-default");
			}
		}
	});
});