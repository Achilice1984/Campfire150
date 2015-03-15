$(".FollowButton").click(function (event) {
	event.preventDefault();

	var thisButton = $(this);

	var url = $(this).attr("data-ajaxurl");
	var userId = $(this).attr("data-userId");
	var newText = $(this).attr("data-additional-text");
	var oldText = $(this).text();

	var followUser = 1;

	if($(this).hasClass("btn-primary"))
	{
		followUser = 0;
	}	

	$.ajax({
		type: "POST",
		url: url,
		data: { FollowUser: followUser, UserID: userId },
		success: function(data){

			if(data)
			{
				thisButton.html('<span class="glyphicon glyphicon-user"></span> ' + newText);
				thisButton.attr("data-additional-text", oldText);

				if(followUser === 1)
				{
					thisButton.removeClass("btn-default");
					thisButton.addClass("btn-primary");
				}
				else
				{
					thisButton.removeClass("btn-primary");
					thisButton.addClass("btn-default");
				}
			}
		}
	});
});


$("#UserSearchMoreButton").click(function(){

	$("#UserSearchPage").val(parseInt($("#UserSearchPage").val()) + 1);

	$.ajax({
		type: "POST",
		url: $("#UserSearchForm").attr("data-ajax-action"),
		data: $("#UserSearchForm").serialize(),
		success: function(data){
			if(data)
			{
				$("#UserSearchContainer").append(data).show("slow");
			}
			else
			{
				$("#UserSearchInfoBar").show();

				$("#UserSearchMoreButton").hide();
			}
		}
	});
});

$("#UserMostFollowersMoreButton").click(function(){

	$("#UserMostFollowersPage").val(parseInt($("#UserMostFollowersPage").val()) + 1);

	$.ajax({
		type: "POST",
		url: $("#UserMostFollowersUrl").val(),
		data: { UserMostFollowersPage: $("#UserMostFollowersPage").val() },
		success: function(data){
			if(data)
			{
				$("#UserMostFollowersContainer").append(data).show("slow");
			}
			else
			{
				$("#UserMostFollowersInfoBar").show();

				$("#UserMostFollowersMoreButton").hide();
			}
		}
	});
});

$("#UsersLatestMoreButton").click(function(){

	$("#UsersLatestPage").val(parseInt($("#UsersLatestPage").val()) + 1);

	$.ajax({
		type: "POST",
		url: $("#UsersLatestUrl").val(),
		data: { UsersLatestPage: $("#UsersLatestPage").val() },
		success: function(data){
			if(data)
			{
				$("#UsersLatestContainer").append(data).show("slow");
			}
			else
			{
				$("#UsersLatestInfoBar").show();

				$("#UsersLatestMoreButton").hide();
			}
		}
	});
});