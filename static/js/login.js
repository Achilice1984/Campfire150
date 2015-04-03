$(document.body).on('click', "#RestPasswordButton", function(event){
	event.preventDefault();
	event.stopPropagation();

	$.ajax({
		type: "POST",
		url: $("#forgotPasswordForm").attr("action"),
		data: { ResetEmail: $("#ResetEmail").val() },
		success: function(data){
			if(data)
			{
				$("#ResetMessage").fadeIn();
			}
			else
			{
				$("#ResetMessage").fadeIn();
			}
		},
		beforeSend: function(){
			$("#RestPasswordSpinerDiv").find(".spinner_small").removeClass("hide");
		},
		complete: function(){
			$("#RestPasswordSpinerDiv").find(".spinner_small").addClass("hide");
		}
	});
});

$(function(){
	$("#VerifyEmailModal").modal();
});