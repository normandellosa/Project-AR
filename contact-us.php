<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" /> 
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<link rel="icon" type="image/png" href="images/favicon.png">

	<title>AllRewards | Contact Us</title> 

	<!-- FONT AWESOME -->
	<link rel="stylesheet" type="text/css" href="lib/font-awesome/font-awesome.min.css">

	<script type="text/javascript" src="lib/jquery-3.1.1.min.js"></script>

	<!-- INPUT MASK -->
	<script src="lib/inputmask/inputmask.js" type="text/javascript"></script>
	<script src="lib/inputmask/inputmask.phone.extensions.js" type="text/javascript"></script>
	<script src="lib/inputmask/jquery.inputmask.js" type="text/javascript"></script>

	<!-- FORM VALIDATOR -->
	<script src="lib/form-validator/jquery.form-validator.min.js" type="text/javascript"></script>
	<link href="lib/form-validator/theme-default.min.css" rel="stylesheet" type="text/css" />

	<!-- CUSTOM STYLES AND SCRIPTS -->
	<link rel="stylesheet" type="text/css" href="css/style.css?v=2">
	<script type="text/javascript" src="js/user-global.js"></script>

	<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
</head>
<body>
	<div class="container">
		<?php include("inc/sticky-header.php"); ?>

		<!-- CONTENT -->
		<div id="main-container">

			<div class="max-width">

				<!-- INQUIRY FORM -->
				<form method="POST" id="inquiry-form" action="thank-you.php">

					<div class="ws-header">
						<h2>Send us an E-mail</h2>
					</div>

					<div class="ws-field col_1_of_2">
						<label for="firstname">First Name <span class="red">*</span></label>
						<input id="firstname" name="firstname" type="text" tabindex="1"
							data-sanitize="trim"
							data-validation="custom length"
							data-validation-regexp="^[a-zA-Z\s]*$"
							data-validation-length="min2"
							data-validation-error-msg="You have not entered a valid First Name"
							data-validation-error-msg-container="#ws-field-validation-errors"/>
					</div>

					<div class="ws-field col_1_of_2">
						<label for="lastname">Last Name <span class="red">*</span></label>
						<input id="lastname" name="lastname" type="text" tabindex="2"
							data-sanitize="trim"
							data-validation="custom length"
							data-validation-regexp="^[a-zA-Z\s]*$"
							data-validation-length="min2"
							data-validation-error-msg="You have not entered a valid Last Name"
							data-validation-error-msg-container="#ws-field-validation-errors"/>
					</div>

					<div class="ws-field col_1_of_2">
						<label for="email">E-mail <span class="red">*</span></label>
						<input id="email" name="email" type="email" tabindex="3"
							data-sanitize="trim"
							data-validation="email"
							data-validation-error-msg="You have not entered a valid E-mail Address"
							data-validation-error-msg-container="#ws-field-validation-errors"/>
					</div>

					<div class="ws-field col_1_of_2">
						<label for="mobileno">Mobile No. <span class="red">*</span></label>
						<input id="mobileno" name="mobileno" type="text" tabindex="4"
							data-sanitize="trim"
							data-validation="number"
							data-validation-ignore="+-"
							data-validation-error-msg="You have not entered a valid Mobile No."
							data-validation-error-msg-container="#ws-field-validation-errors"/>
					</div>

					<div class="ws-field">
						<label for="message">Message <span class="red">*</span></label>
						<textarea id="message" name="message" rows="1" cols="20" tabindex="5"
							data-sanitize="trim"
							data-validation="required"
							data-validation-error-msg="You have not entered your Message"
							data-validation-error-msg-container="#ws-field-validation-errors"></textarea>
					</div>

					<div class="ws-field">
                        <input type="text" name="recaptcha" value="" id="required_captcha" pattern="1" style="visibility:hidden;height:1px;border-width:0;"
                        	data-errormessage-value-missing="Please validate your reCAPTCHA"
                        	data-validation="required"
                        	data-validation-error-msg="Please validate your reCAPTCHA"/>
                        <div id="g-recaptcha"></div>
					</div>

					<div class="ws-field">
						<button id="reset" type="reset" class="btn">Reset</button>
						<button id="submit" class="btn">Send</button>
					</div>

					<div id="ws-field-validation-errors"></div>

				</form><!-- ../endof #inquiry-form -->

				<!-- CONTACT WIDGET -->
				<div id="contact-widget" class="widget-section">

					<div class="ws-header">
						<h2>Contact Us</h2>
					</div>
					<div class="ws-content">
						<div class="ws-contact">
							<h3>Address:</h3>
							<p>All Day Convenience Store Inc.<br/>
							3rd Floor, Starmall Alabang,<br/>
							Muntinlupa City</p>
						</div>

						<div class="ws-contact">
							<h3>Tel. No.:</h3>
							<p><a href="tel:+6328360519">(02) 836 0519 loc 118</a></p>

							<h3>Hotline:</h3>
							<p><a href="tel:<?= $tel; ?>"><?= $hotline_list['hotline_number']; ?></a></p>
						</div>

						<div class="ws-contact">
							<h3>E-mail:</h3>
							<a href="mailto:allrewardsmarketing@gmail.com">allrewardsmarketing@gmail.com</a>
						</div>
					</div>

				</div><!-- ../endof #contact-widget.widget-section -->
				
			</div><!-- ../endof .max-width -->
			
		</div><!-- ../endof #main-container -->

		<!-- FOOTER -->
		<?php include("inc/footer.php"); ?>
		
	</div>
</body>

<script type="text/javascript">
	$(document).ready(function(){
		$(".menu-contact").addClass('active');

        $.validate({
			modules : 'sanitize',
			form                 : '#inquiry-form',
			validateOnBlur : false,
			errorMessagePosition : 'top',
			scrollToTopOnError : true,
			borderColorOnError : '#ee2325',
            onSuccess            : function(form) {
                
     //            var formData = {
     //            	'firstname' : $("#firstname").val(),
					// 'lastname' : $("#lastname").val(),
					// 'email' : $("#email").val(),
					// 'mobileno' : $("#mobileno").val(),
					// 'message' : $("#message").val()
     //            }
     //            $.ajax({
     //                type     : "POST",
     //                url      : 'thank-you.php',
     //                data     : formData,
     //                cache    : false,
     //                success  : function(data, status){
     //                    location.href = "thank-you.php"
     //                },
     //                error    : function(){  
     //                    alert("Your inquiry was not sent! Please try again later.")
     //                }
     //            });

     //            return false;
            },
            onError: function(form) {
                console.log("form validator error");
                window.scrollTo(0,0);
            }
        });

		$("#mobileno").inputmask("+63-999-999-99-99");
	});
</script>
<script type="text/javascript">
	var recaptcha;

	var onloadCallback = function() {
		var sitekey = '6LcOMjAUAAAAAHnTgKMSrBmL5EEM5dpJ8JKSBd02';  

        if ( $('#g-recaptcha').length ) {
            recaptcha = grecaptcha.render('g-recaptcha', {
                'sitekey': sitekey,
                'callback': verifyCallbackCaptcha
            });
        }
	};

    var verifyCallbackCaptcha = function(response) {
        $('#required_captcha').val(1);
        //$('#required_captcha').validationEngine('hide');
    };
</script>
</html>