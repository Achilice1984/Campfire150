$(function(){

	$("#penndingStoryModal").modal('show');
	$("#draftStoryModal").modal('show');
});


$(document.body).on("keyup", "#About", function(){
	$("#AboutSubmitButton").fadeIn();
});

$(document.body).on("keyup", "#UserActionStatement", function(){
	$("#UserActionSubmitButton").fadeIn();
});

$(function(){

	if($('textarea#Content').length)
	{
		$('textarea#Content').maxlength({
	        alwaysShow: true
	    });
    }
});

$(document.body).on('click', "#EditProfileButton", function(event){
	event.preventDefault();
	event.stopPropagation();

	$.ajax({
		type: "GET",
		url: $("#EditProfileButton").attr("data-action"),
		success: function(data){
			if(data)
			{	
				$("#profileContentContainer").html(data);				

				$('textarea#About').maxlength({
		            alwaysShow: true
		        });
		        $('textarea#UserActionStatement').maxlength({
		            alwaysShow: true
		        });

		        init_validation();
		        init_tooltip();
			}
			else
			{

			}
		},
		beforeSend: function(){
			$(".regularContent").hide();
			$("#profileContentLoader .spinner_large").removeClass("hide");
		},
		complete: function(){
			$(".profileContent").fadeIn();
			$("#profileContentLoader .spinner_large").addClass("hide");
		}
	});


	$("#EditProfileButton").hide();
	$(".CancelProfileButton").show();

	$("#AboutDiv").hide();
	$("#AboutFormDiv").show();

	$("#ActionStatementDiv").hide();
	$("#ActionStatementFormDiv").show();

	$("#ShareStoryButtonProfile").hide();
});

$(document.body).on('click', ".CancelProfileButton", function(event){
	event.preventDefault();
	event.stopPropagation();

	$(".profileContent").hide();
	$(".regularContent").fadeIn();

	$("#AboutFormDiv").hide();
	$("#AboutDiv").show();

	$("#ActionStatementFormDiv").hide();
	$("#ActionStatementDiv").show();

	$(".CancelProfileButton").hide();
	$("#EditProfileButton").show();	

	$("#ShareStoryButtonProfile").show();	

	$(".messageDiv .alert").remove();

	$("#AboutSubmitButton").hide();
	$("#UserActionSubmitButton").hide();

	$("#About").val($("#AboutDivText").text().trim()); 
	$("#UserActionStatement").val($("#ActionStatementDivText").text().trim());  	 
});



/*******************************
*
*	Background Picture
*
********************************/


$(document.body).on('click', "#headerImageChange", function(){
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

        $("#HeaderImgInfoDiv").show("slow");     
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
			autoCropArea: 0.99,
			guides: true,
			highlight: true,
			resizable: false,
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


$(document.body).on('click', "#cropImage_header", function(){
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
			$('#imgPreviewer_header').attr("src", "");
		},
		beforeSend: function(){
			$("#CropBackgroundSpinerDiv .spinner_small").removeClass("hide");
		},
		complete: function(){
			$("#CropBackgroundSpinerDiv .spinner_small").addClass("hide");
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


$(document.body).on('click', "#profileImageChange", function(){
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

        $("#ProfileImgInfoDiv").show("slow");  
    }
}

$(document.body).on('change', "#ProfileImage", function(){
    readURL_profile(this);     
});

function initCrop_profile(url) {

	 $(function(){ $('#imgPreviewer_profile').cropper({
			aspectRatio: 4 / 4,
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


$(document.body).on('click', "#cropImage_profile", function(){
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
			$('#imgPreviewer_profile').attr("src", "");
		},
		beforeSend: function(){
			$("#CropProfileSpinerDiv .spinner_small").removeClass("hide");
		},
		complete: function(){
			$("#CropProfileSpinerDiv .spinner_small").addClass("hide");
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



/*******************************
*
*	AJAX Stories
*
********************************/
// $("#").click(function(event){
// 	event.preventDefault();
// 	event.stopPropagation();

// });

/*******************************
*
*	AJAX Users
*
********************************/
$(document.body).on('click', "#AboutSubmitButton", function(event){
	event.preventDefault();
	event.stopPropagation();

	$.ajax({
		type: "POST",
		url: $("#AboutForm").attr("action"),
		data: $("#AboutForm").serialize(),
		success: function(data){
			if(data)
			{
				$("#AboutFormDiv").find(".messageDiv").html(data);
				$("#AboutDivText").text($("#About").val());

				$("#AboutSubmitButton").fadeOut();
			}
			else
			{

			}
		},
		beforeSend: function(){
			$("#AboutSpinerDiv .spinner_small").removeClass("hide");
		},
		complete: function(){
			$("#AboutSpinerDiv .spinner_small").addClass("hide");
		}
	});	
});

$(document.body).on('click', "#UserActionSubmitButton", function(event){
	event.preventDefault();
	event.stopPropagation();

	$.ajax({
		type: "POST",
		url: $("#ActionStatementForm").attr("action"),
		data: $("#ActionStatementForm").serialize(),
		success: function(data){
			if(data)
			{
				$("#Content").val("");

				$("#ActionStatementFormDiv").find(".messageDiv").html(data);
				$("#ActionStatementDivText").text($("#UserActionStatement").val());

				$("#UserActionSubmitButton").fadeOut();
			}
			else
			{

			}
		},
		beforeSend: function(){
			$("#ActionStatementSpinerDiv .spinner_small").removeClass("hide");
		},
		complete: function(){
			$("#ActionStatementSpinerDiv .spinner_small").addClass("hide");
		}
	});	
	
});

$(document.body).on('click', "#ActionTakenSubmitButton", function(event){
	event.preventDefault();
	event.stopPropagation();

	$.ajax({
		type: "POST",
		url: $("#ActionTakenForm").attr("action"),
		data: $("#ActionTakenForm").serialize(),
		success: function(data){
			if(data)
			{
				$("#ActionsTakenListContainer").html(data);
			}
			else
			{

			}
		},
		beforeSend: function(){
			$("#ActionTakenForm .spinner_small").removeClass("hide");
		},
		complete: function(){
			$("#ActionTakenForm .spinner_small").addClass("hide");
		}
	});	
});

$(document.body).on('click', "#ProfileSubmitButton", function(event){
	event.preventDefault();
	event.stopPropagation();

	$.ajax({
		type: "POST",
		url: $("#profileForm").attr("action"),
		data: $("#profileForm").serialize(),
		success: function(data){
			if(data)
			{
				$("#userNameDiv").html($("#FirstName").val() + " " + $("#LastName").val());
				$("#LoginNameSpan").html(" " + $("#FirstName").val() + " " + $("#LastName").val());

				$("#ProfileMessageDiv").html(data);
			}
			else
			{

			}
		},
		beforeSend: function(){
			$("#ProfileSpinerDiv .spinner_small").removeClass("hide");
		},
		complete: function(){
			$("#ProfileSpinerDiv .spinner_small").addClass("hide");
		}		
	});	
});

$(document.body).on('click', "#PasswordSubmitButton", function(event){
	event.preventDefault();
	event.stopPropagation();
	
	$.ajax({
		type: "POST",
		url: $("#changePasswordForm").attr("action"),
		data: $("#changePasswordForm").serialize(),
		success: function(data){
			if(data)
			{
				$("#changePasswordForm").find(".messageDiv").html(data);
			}
			else
			{

			}
		},
		beforeSend: function(){
			$("#PasswordSpinerDiv .spinner_small").removeClass("hide");
		},
		complete: function(){
			$("#PasswordSpinerDiv .spinner_small").addClass("hide");
		}
	});
});

$(document.body).on('click', "#SecurityQuestionSubmitButton", function(event){
	event.preventDefault();
	event.stopPropagation();
	
	$.ajax({
		type: "POST",
		url: $("#ChangeSecurityQuestionForm").attr("action"),
		data: $("#ChangeSecurityQuestionForm").serialize(),
		success: function(data){
			if(data)
			{
				$("#ChangeSecurityQuestionForm").find(".messageDiv").html(data);
			}
			else
			{

			}
		},
		beforeSend: function(){
			$("#SecurityQuestionSpinerDiv .spinner_small").removeClass("hide");
		},
		complete: function(){
			$("#SecurityQuestionSpinerDiv .spinner_small").addClass("hide");
		}
	});
});



/*****************************
*
*		SHOW MORE BUTTONS
*
******************************/

$(document.body).on('click', "#NewFeedContentMoreButton", function(event){

	var pageInputName  = "#NewFeedContentPage";
	var urlInputName   = "#NewFeedContentUrl";
	var contentDivName = "#NewFeedContent";
	var infoBarName    = "#NewFeedContentInfoBar";
	var moreButtonName = "#NewFeedContentMoreButton";

	$(pageInputName).val(parseInt($(pageInputName).val()) + 1);

	$.ajax({
		type: "POST",
		url: $(urlInputName).val(),
		data: { Page: $(pageInputName).val() },
		success: function(data){
			if(data)
			{
				$(contentDivName).append(data).show("slow");

				init_tooltip();
			}
			else
			{
				$(infoBarName).show();

				$(moreButtonName).hide();
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

$(document.body).on('click', "#Stories_ContentMoreButton", function(event){

	var pageInputName  = "#Stories_ContentPage";
	var urlInputName   = "#Stories_ContentUrl";
	var contentDivName = "#Stories_Content";
	var infoBarName    = "#Stories_ContentInfoBar";
	var moreButtonName = "#Stories_ContentMoreButton";
	var userid         = $("#userid").val();

	$(pageInputName).val(parseInt($(pageInputName).val()) + 1);

	$.ajax({
		type: "POST",
		url: $(urlInputName).val(),
		data: { Page: $(pageInputName).val(), UserId: userid },
		success: function(data){
			if(data)
			{
				$(contentDivName).append(data).show("slow");

				init_tooltip();
			}
			else
			{
				$(infoBarName).show();

				$(moreButtonName).hide();
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

$(document.body).on('click', "#StoryRecommendationContentMoreButton", function(event){

	var pageInputName  = "#StoryRecommendationContentPage";
	var urlInputName   = "#StoryRecommendationContentUrl";
	var contentDivName = "#StoryRecommendationContent";
	var infoBarName    = "#StoryRecommendationContentInfoBar";
	var moreButtonName = "#StoryRecommendationContentMoreButton";
	var userid         = $("#userid").val();

	$(pageInputName).val(parseInt($(pageInputName).val()) + 1);

	$.ajax({
		type: "POST",
		url: $(urlInputName).val(),
		data: { Page: $(pageInputName).val(), UserId: userid },
		success: function(data){
			if(data)
			{
				$(contentDivName).append(data).show("slow");

				init_tooltip();
			}
			else
			{
				$(infoBarName).show();

				$(moreButtonName).hide();
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

$(document.body).on('click', "#UserFollowingContentMoreButton", function(event){

	var pageInputName  = "#UserFollowingContentPage";
	var urlInputName   = "#UserFollowingContentUrl";
	var contentDivName = "#UserFollowingContent";
	var infoBarName    = "#UserFollowingContentInfoBar";
	var moreButtonName = "#UserFollowingContentMoreButton";
	var userid         = $("#userid").val();

	$(pageInputName).val(parseInt($(pageInputName).val()) + 1);

	$.ajax({
		type: "POST",
		url: $(urlInputName).val(),
		data: { Page: $(pageInputName).val(), UserId: userid },
		success: function(data){
			if(data)
			{
				$(contentDivName).append(data).show("slow");

				init_tooltip();
			}
			else
			{
				$(infoBarName).show();

				$(moreButtonName).hide();
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

$(document.body).on('click', "#UserFollowersContentMoreButton", function(event){

	var pageInputName  = "#UserFollowersContentPage";
	var urlInputName   = "#UserFollowersContentUrl";
	var contentDivName = "#UserFollowersContent";
	var infoBarName    = "#UserFollowersContentInfoBar";
	var moreButtonName = "#UserFollowersContentMoreButton";
	var userid         = $("#userid").val();

	$(pageInputName).val(parseInt($(pageInputName).val()) + 1);

	$.ajax({
		type: "POST",
		url: $(urlInputName).val(),
		data: { Page: $(pageInputName).val(), UserId: userid },
		success: function(data){
			if(data)
			{
				$(contentDivName).append(data).show("slow");

				init_tooltip();
			}
			else
			{
				$(infoBarName).show();

				$(moreButtonName).hide();
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


/*****************************
*
*		SHOW MORE BUTTONS
*
*		CURRENT USER SECTION
*
******************************/

$(document.body).on('click', "#CurrentPublishedContentMoreButton", function(event){

	var pageInputName  = "#CurrentPublishedContentPage";
	var urlInputName   = "#CurrentPublishedContentUrl";
	var contentDivName = "#CurrentPublishedContent";
	var infoBarName    = "#CurrentPublishedContentInfoBar";
	var moreButtonName = "#CurrentPublishedContentMoreButton";

	$(pageInputName).val(parseInt($(pageInputName).val()) + 1);

	$.ajax({
		type: "POST",
		url: $(urlInputName).val(),
		data: { Page: $(pageInputName).val() },
		success: function(data){
			if(data)
			{
				$(contentDivName).append(data).show("slow");

				init_tooltip();
			}
			else
			{
				$(infoBarName).show();

				$(moreButtonName).hide();
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

$(document.body).on('click', "#CurrentDraftsContentMoreButton", function(event){

	var pageInputName  = "#CurrentDraftsContentPage";
	var urlInputName   = "#CurrentDraftsContentUrl";
	var contentDivName = "#CurrentDraftsContent";
	var infoBarName    = "#CurrentDraftsContentInfoBar";
	var moreButtonName = "#CurrentDraftsContentMoreButton";

	$(pageInputName).val(parseInt($(pageInputName).val()) + 1);

	$.ajax({
		type: "POST",
		url: $(urlInputName).val(),
		data: { Page: $(pageInputName).val() },
		success: function(data){
			if(data)
			{
				$(contentDivName).append(data).show("slow");

				init_tooltip();
			}
			else
			{
				$(infoBarName).show();

				$(moreButtonName).hide();
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

$(document.body).on('click', "#CurrentPendingContentMoreButton", function(event){

	var pageInputName  = "#CurrentPendingContentPage";
	var urlInputName   = "#CurrentPendingContentUrl";
	var contentDivName = "#CurrentPendingContent";
	var infoBarName    = "#CurrentPendingContentInfoBar";
	var moreButtonName = "#CurrentPendingContentMoreButton";

	$(pageInputName).val(parseInt($(pageInputName).val()) + 1);

	$.ajax({
		type: "POST",
		url: $(urlInputName).val(),
		data: { Page: $(pageInputName).val() },
		success: function(data){
			if(data)
			{
				$(contentDivName).append(data).show("slow");

				init_tooltip();
			}
			else
			{
				$(infoBarName).show();

				$(moreButtonName).hide();
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

$(document.body).on('click', "#CurrentRejectedContentMoreButton", function(event){

	var pageInputName  = "#CurrentRejectedContentPage";
	var urlInputName   = "#CurrentRejectedContentUrl";
	var contentDivName = "#CurrentRejectedContent";
	var infoBarName    = "#CurrentRejectedContentInfoBar";
	var moreButtonName = "#CurrentRejectedContentMoreButton";

	$(pageInputName).val(parseInt($(pageInputName).val()) + 1);

	$.ajax({
		type: "POST",
		url: $(urlInputName).val(),
		data: { Page: $(pageInputName).val() },
		success: function(data){
			if(data)
			{
				$(contentDivName).append(data).show("slow");

				init_tooltip();
			}
			else
			{
				$(infoBarName).show();

				$(moreButtonName).hide();
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


$(document.body).on('click', "#CurrentCommentsContentMoreButton", function(event){

	var pageInputName  = "#CurrentCommentsContentPage";
	var urlInputName   = "#CurrentCommentsContentUrl";
	var contentDivName = "#CurrentCommentContent";
	var infoBarName    = "#CurrentCommentsContentInfoBar";
	var moreButtonName = "#CurrentCommentsContentMoreButton";

	$(pageInputName).val(parseInt($(pageInputName).val()) + 1);

	$.ajax({
		type: "POST",
		url: $(urlInputName).val(),
		data: { Page: $(pageInputName).val() },
		success: function(data){
			if(data)
			{
				$(contentDivName).append(data).show("slow");

				init_tooltip();
			}
			else
			{
				$(infoBarName).show();

				$(moreButtonName).hide();
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

$(document.body).on('click', ".commentAction", function(event){
	event.preventDefault();
	event.stopPropagation();

	var commentID  = $(this).attr("data-comment-id");
	var action = $(this).attr("data-action");
	var thisComment = $(this);

	$.ajax({
		type: "POST",
		url: action,
		data: { CommentID: commentID },
		success: function(data){
			if(data)
			{
				thisComment.closest(".commentDiv").remove();
			}
			else
			{
			}
		},
		beforeSend: function(){
			$(event.target).parent().find(".spinner_small").removeClass("hide");
		},
		complete: function(){
			$(event.target).parent().find(".spinner_small").addClass("hide");
		}
	});
});

$(document.body).on('change', ".storyPrivacyDropDown", function(event){
	event.preventDefault();
	event.stopPropagation();

	var storyID  = $(this).attr("data-story-id");
	var action = $(this).attr("data-action");
	var privacyType = $(this).val();
	var thisStory = $(this);

	$.ajax({
		type: "POST",
		url: action,
		data: { StoryID: storyID, PrivacyType: privacyType },
		success: function(data){
			if(data)
			{
				//thisComment.closest(".commentDiv").remove();
			}
			else
			{
			}
		}
	});
});


$(document.body).on('click', ".removeAction", function(event){
	event.preventDefault();
	event.stopPropagation();

	var actionID  = $(this).attr("data-action-id");
	var action = $(this).attr("data-action");
	var thisAction = $(this);

	$.ajax({
		type: "POST",
		url: action,
		data: { ActionID: actionID },
		success: function(data){
			if(data)
			{
				thisAction.closest(".actionTakenTd").remove();
			}
			else
			{
			}
		},
		beforeSend: function(){
			$(event.target).parent().find(".spinner_small").removeClass("hide");
		},
		complete: function(){
			$(event.target).parent().find(".spinner_small").addClass("hide");
		}
	});
});


// $(document.body).on('click', "#MoreButton", function(){

// 	var pageInputName  = "#Page";
// 	var urlInputName   = "#Url";
// 	var contentDivName = "#Content";
// 	var infoBarName    = "#InfoBar";
// 	var moreButtonName = "#MoreButton";

// 	$(pageInputName).val(parseInt($(pageInputName).val()) + 1);

// 	$.ajax({
// 		type: "POST",
// 		url: $(urlInputName).val(),
// 		data: { Page: $(pageInputName).val() },
// 		success: function(data){
// 			if(data)
// 			{
// 				$(contentDivName).append(data).show("slow");
// 			}
// 			else
// 			{
// 				$(infoBarName).show();

// 				$(moreButtonName).hide();
// 			}
// 		}
// 	});
// });