
$(document.body).on('click', "#UserSearchMoreButton", function(){

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

$(document.body).on('click', "#UserMostFollowersMoreButton", function(){

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

$(document.body).on('click', "#UsersLatestMoreButton", function(){

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