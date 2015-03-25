tinymce.init({
    selector: ".tinyMCE",
    menu : { // this is the complete default configuration
        edit   : {title : 'Edit'  , items : 'undo redo | cut copy paste pastetext | selectall'},
        format : {title : 'Format', items : 'bold italic underline strikethrough | formats | removeformat'}
    }, 
    theme : 'modern',
 	toolbar: false,
 	plugins: "autoresize",
 	autoresize_on_init: true,
	format : {title : 'Format', items : 'bold italic underline strikethrough | formats | removeformat'},
 	content_css : $("#tinymce_customCSS").val(),
    invalid_elements: "script"

 });



$(window).bind('scroll', function() {
	if($(window).scrollTop() >= $('#mceFixedNav').offset().top + $('#mceFixedNav').height() + 10) {

         $('#mceu_1').css({"position": "fixed", "top": "0px", "left":"0"});
     }
     else {
         $('#mceu_1').css({"position": "relative", "top": "0px", "left":"0"});
     }
});