$(function(){
	$("#WelcomeStoryModal").modal();
});

$(document.body).on('click', "#addStoryImgButton", function(){
	$('#storyImgModal').modal();	
});

function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            //$('#imgPreviewer').attr('src', e.target.result);
            initCrop(e.target.result);

            $("#cropImage").show();
        }

        reader.readAsDataURL(input.files[0]);        
    }
}

$("#Images").change(function(){
    readURL(this);     
});

function initCrop(url) {
	// $('#imgPreviewer').Jcrop({
 //        //onSelect:    showCoords,
 //        bgColor:     'black',
 //        bgOpacity:   .4,
 //        //setSelect:   [ 100, 100, 50, 50 ],
 //        minSize: [400, 300],
 //        aspectRatio: 16 / 9
 //    }); 

	 $(function(){ $('#imgPreviewer').cropper({
			aspectRatio: 16 / 9,
			autoCrop: true,
			movable: true,
			modal: true,
			responsive: true,
			autoCropArea: 0.99,
			guides: true,
			highlight: true,
			resizable: false,
			minContainerWidth:100,
			zoomable: false,
			crop: function(data) {

				$("#image_x").val(Math.round(data.x));
				$("#image_y").val(Math.round(data.y));
				$("#image_height").val(Math.round(data.height));
				$("#image_width").val(Math.round(data.width));
				//$("#dataRotate").val(Math.round(data.rotate));
			},
			 built: cropper_handler,
			dragmove: cropper_handler,
			dragend: cropper_handler 
		});  
	});

	$('#imgPreviewer').cropper('replace', url);
}


$(document.body).on('click', "#cropImage", function(){

	$("#CropStorySpinerDiv .spinner_small").removeClass("hide");

 	var url = $('#imgPreviewer').cropper('getDataURL');

 	$('#imgPreviewer').cropper('destroy');
 	$('#imgPreviewer').attr("src", "");

	$("#imgDisplayer").attr("src", url);

	$(".close").click();

	$("#cropImage").hide();
	$("#CropStorySpinerDiv .spinner_small").addClass("hide");

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