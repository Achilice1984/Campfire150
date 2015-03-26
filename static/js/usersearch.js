
$(document.body).on('click', "#UserSearchMoreButton", function(event){

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
		},
		beforeSend: function(){
			$(event.target).parent().find(".spinner_large").removeClass("hide");
		},
		complete: function(){
			$(event.target).parent().find(".spinner_large").addClass("hide");
		}
	});
});

$(document.body).on('click', "#UserMostFollowersMoreButton", function(event){

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
		},
		beforeSend: function(){
			$(event.target).parent().find(".spinner_large").removeClass("hide");
		},
		complete: function(){
			$(event.target).parent().find(".spinner_large").addClass("hide");
		}
	});
});

$(document.body).on('click', "#UsersLatestMoreButton", function(event){

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
		},
		beforeSend: function(){
			$(event.target).parent().find(".spinner_large").removeClass("hide");
		},
		complete: function(){
			$(event.target).parent().find(".spinner_large").addClass("hide");
		}
	});
});