
$(document.body).on('click', "#latestStoryListButton", function(){
	var button = $(this);

	$.ajax({
		type: "POST",
		url: $("#latestStoryListButton").attr("data-request-url"),
		success: function(data){
			if(data)
			{
				$("#StoryListContainer").html(data);
				initThumbs();

				button.closest('.container').find(".active").removeClass('active');

				button.closest('li').addClass('active');
			}
			else
			{

			}
		},
		beforeSend: function(){
			$("#StoryListContainer").hide();
			$("#storyListRow .spinner_large").removeClass("hide");
		},
		complete: function(){
			$("#StoryListContainer").fadeIn();
			$("#storyListRow .spinner_large").addClass("hide");
		}
	});
});

$(document.body).on('click', "#recommendedStoryListButton", function(){
	var button = $(this);

	$.ajax({
		type: "POST",
		url: $("#recommendedStoryListButton").attr("data-request-url"),
		success: function(data){
			if(data)
			{
				$("#StoryListContainer").html(data);
				initThumbs();

				button.closest('.container').find(".active").removeClass('active');

				button.closest('li').addClass('active');
			}
			else
			{

			}
		},
		beforeSend: function(){
			$("#StoryListContainer").hide();
			$("#storyListRow .spinner_large").removeClass("hide");
		},
		complete: function(){
			$("#StoryListContainer").fadeIn();
			$("#storyListRow .spinner_large").addClass("hide");
		}
	});
});

$(document.body).on('click', ".categoryListButton", function(){

	var button = $(this);
	var challengeId = $(this).attr("data-challengeId");
	var url 		= $(this).attr("data-request-url");

	$.ajax({
		type: "POST",
		url: url,
		data: { ChallengeId: challengeId },
		success: function(data){
			if(data)
			{
				$("#StoryListContainer").html(data);
				initThumbs();

				button.closest('.container').find(".active").removeClass('active');

				button.closest('li').addClass('active');
			}
			else
			{

			}
		},
		beforeSend: function(){
			$("#StoryListContainer").hide();
			$("#storyListRow .spinner_large").removeClass("hide");
		},
		complete: function(){
			$("#StoryListContainer").fadeIn();
			$("#storyListRow .spinner_large").addClass("hide");
		}
	});
});

/*********************************************
*
*			COUNT DOWN
*
**********************************************/

$(document).ready(function() {
$('.countdown').final_countdown({
	start: '1362139200',
	end: $("#END_DATE").val(),
	now: $("#NOW_DATE").val(),
	selectors: {
	    value_seconds: '.clock-seconds .val',
	    canvas_seconds: 'canvas_seconds',
	    value_minutes: '.clock-minutes .val',
	    canvas_minutes: 'canvas_minutes',
	    value_hours: '.clock-hours .val',
	    canvas_hours: 'canvas_hours',
	    value_days: '.clock-days .val',
	    canvas_days: 'canvas_days'
	},
	seconds: {
	    borderColor: '#7995D5',
	    borderWidth: '6'
	},
	minutes: {
	    borderColor: '#ACC742',
	    borderWidth: '6'
	},
	hours: {
	    borderColor: '#ECEFCB',
	    borderWidth: '6'
	},
	days: {
	    borderColor: '#FF9900',
	    borderWidth: '6'
	}}, function() {
	// Finish callback
	});
});