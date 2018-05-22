$("#login-btn").click( function() {
 
	if ( $("#username").val() == "" || $("#password").val() == "" ) {
	  	$(".login-warning").html("Please enter your Username and/or Password");
	} else {
	  	$.post( $("#login-form").attr("action"),
		$("#login-form :input").serializeArray(),
		
		function (info) {
			$(".login-warning").empty();
			$(".login-warning").html(info);
			clear();
		});
	}
 
	$("#login-form").submit(function() {
	   return false;	
	});
});

function clear() {
	$("#login-form :input").each(function() {
	      $(this).val("");
	});
}


