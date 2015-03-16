
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

	jQuery(".responsive_content").fitText(1.2, { minFontSize: '11px', maxFontSize: '40px' });
} 
