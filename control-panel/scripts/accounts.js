$("#user_type").change(function(){
	if($("#user_type").val() == 'Administrator') {
		$("#permission-title, #permission-options").hide();

	} else {
		$("#permission-title, #permission-options").show();
	}
});

$(document).ready(function(){
	if($("#user_type").val() == 'Administrator') {
		$("#permission-title, #permission-options").hide();

	}
});