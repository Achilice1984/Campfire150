
<<<<<<< HEAD
$(function(){
	initThumbs();
});

function initThumbs()
{
	$("[rel='tooltip']").tooltip();    
	 
	$('.thumbnail').hover(
	    function(){
	        $(this).find('.caption').fadeIn(); //.fadeIn(250)
	    },
	    function(){
	        $(this).find('.caption').fadeOut(); //.fadeOut(205)
	    }
	);
} 


=======
>>>>>>> master
$("#latestStoryListButton").click(function(){
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
		}
	});
});

$("#recommendedStoryListButton").click(function(){
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
		}
	});
});

$(".categoryListButton").click(function(){

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
		}
	});
});