
$(function(){
	initThumbs();
});

function initThumbs()
{
	$("[rel='tooltip']").tooltip();    
	 
	$('.thumbnail').hover(
	    function(){
	        $(this).find('.caption').fadeIn('fast'); //.fadeIn(250)
	    },
	    function(){
	        $(this).find('.caption').fadeOut(); //.fadeOut(205)
	    }
	);
} 
