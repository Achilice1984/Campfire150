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