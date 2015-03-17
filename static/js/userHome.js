$("#EditProfileButton").click(function(event){
	event.preventDefault();
	event.stopPropagation();

	$(".regularContent").hide();

	$.ajax({
		type: "GET",
		url: $("#EditProfileButton").attr("href"),
		success: function(data){
			if(data)
			{
				$("#profileContentContainer").html(data);
			}
			else
			{

			}
		}
	});

	$("#EditProfileButton").hide();
	$("#CancelProfileButton").show();

	$(".profileContent").show();
});

$("#CancelProfileButton").click(function(event){
	event.preventDefault();
	event.stopPropagation();

	$(".profileContent").hide();
	$(".regularContent").show();

	$("#CancelProfileButton").hide();
	$("#EditProfileButton").show();	
});



/*******************************
*
*	Background Picture
*
********************************/


$("#headerImageChange").click(function(){
	$('#headerImgModal').modal();	
});

function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            //$('#imgPreviewer').attr('src', e.target.result);
            initCrop(e.target.result);

            $("#cropImage_header").show();
        }

        reader.readAsDataURL(input.files[0]);        
    }
}

$("#HeaderImage").change(function(){
    readURL(this);     
});

function initCrop(url) {

	 $(function(){ $('#imgPreviewer_header').cropper({
			aspectRatio: 1200 / 400,
			autoCrop: true,
			movable: true,
			modal: true,
			responsive: true,
			autoCropArea: 0.8,
			guides: true,
			highlight: true,
			resizable: true,
			minContainerWidth:100,
			zoomable: false,
			crop: function(data) {

				$("#image_header_x").val(Math.round(data.x));
				$("#image_header_y").val(Math.round(data.y));
				$("#image_header_height").val(Math.round(data.height));
				$("#image_header_width").val(Math.round(data.width));
				//$("#dataRotate").val(Math.round(data.rotate));
			},
			 built: cropper_handler,
			dragmove: cropper_handler,
			dragend: cropper_handler 
		});  
	});

	$('#imgPreviewer_header').cropper('replace', url);
}


 $("#cropImage_header").click(function(){
 	var formData = new FormData(document.getElementById("imgHeaderForm"));

 	$.ajax({
		type: "POST",
		data: formData, 
		url: $("#imgHeaderForm").attr("action"),
		enctype: 'multipart/form-data',
		processData: false,
    	contentType: false,
		success: function(data){
			if(data)
			{
				$(".close").click();

				$("#backgroundImage").attr("src", data);
			}
			else
			{

			}

			$('#imgPreviewer_header').cropper('destroy');
		}
	});	

	//$("#cropImage_header").hide();

	return true;
 });







/*******************************
*
*	Profile Picture
*
********************************/


$("#profileImageChange").click(function(){
	$('#profileImgModal').modal();	
});

function readURL_profile(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            //$('#imgPreviewer').attr('src', e.target.result);
            initCrop_profile(e.target.result);

            $("#cropImage_profile").show();
        }

        reader.readAsDataURL(input.files[0]);        
    }
}

$("#ProfileImage").change(function(){
    readURL_profile(this);     
});

function initCrop_profile(url) {

	 $(function(){ $('#imgPreviewer_profile').cropper({
			aspectRatio: 4 / 4,
			autoCrop: true,
			movable: true,
			modal: true,
			responsive: true,
			autoCropArea: 0.8,
			guides: true,
			highlight: true,
			resizable: true,
			minContainerWidth:100,
			zoomable: false,
			crop: function(data) {

				$("#image_profile_x").val(Math.round(data.x));
				$("#image_profile_y").val(Math.round(data.y));
				$("#image_profile_height").val(Math.round(data.height));
				$("#image_profile_width").val(Math.round(data.width));
				//$("#dataRotate").val(Math.round(data.rotate));
			},
			 built: cropper_handler,
			dragmove: cropper_handler,
			dragend: cropper_handler 
		});  
	});

	$('#imgPreviewer_profile').cropper('replace', url);
}


 $("#cropImage_profile").click(function(){
 	var formData = new FormData(document.getElementById("imgProfileForm"));

 	$.ajax({
		type: "POST",
		data: formData, 
		url: $("#imgProfileForm").attr("action"),
		enctype: 'multipart/form-data',
		processData: false,
    	contentType: false,
		success: function(data){
			if(data)
			{
				$(".close").click();

				$("#profilePicture").attr("src", data);
			}
			else
			{

			}

			$('#imgPreviewer_profile').cropper('destroy');
		}
	});	

	//$("#cropImage_header").hide();

	return true;
 });




 var cropper_handler = function(event){
// It was fine for me to hardcode dimensions
// You will likely want to pass these to cropper constructor or get via data attributes on cropper container, or whatever
var header = {width: 1140, height: 200};
 
var $cropper = $(event.target);
var image_size = $cropper.cropper('getImageData', true);
 
// First step - calculate ratio by which to multiply current image dimensions to cover entire cropper area.
if (image_size.width < header.width || image_size.height < header.height) {
var zoom_multipliers = [header.width / image_size.width,
header.height / image_size.height];
var max_zoom = Math.max.apply(null, zoom_multipliers);
$cropper.cropper('zoom', max_zoom);
}
 
// get image size after zooming
var image_size = $cropper.cropper('getImageData', true);
 
// if image doesn't cover cropper area and there is blank space, move it to the edge
if (image_size.left > 0) {
$cropper.cropper('move', -image_size.left, 0);
}
else if (image_size.left < 0 && image_size.left + image_size.width < header.width) {
$cropper.cropper('move', -(image_size.left + image_size.width - header.width), 0);
}
 
if (image_size.top > 0) {
$cropper.cropper('move', 0, -image_size.top);
}
else if (image_size.top < 0 && image_size.top + image_size.height < header.height) {
$cropper.cropper('move', 0, -(image_size.top + image_size.height - header.height));
}
}; 