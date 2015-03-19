$(document.body).on('click', ".FollowButton", function (event) {
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