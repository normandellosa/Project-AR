<?php 
include "classes/class.smtp.php";
include "classes/class.phpmailer.php";

require_once('dao/recipientDao.php');
$recipients = RecipientDao::recipientList();

	$firstname = $_POST['firstname'];
	$lastname  = $_POST['lastname'];
	$mobileno  = $_POST['mobileno'];
	$email     = $_POST['email'];
	$msg       = $_POST['message'];
	$msg       = wordwrap($msg,70);
	$message   = "Hello! Someone has sent a message using the AllRewards Website Inquiry Form.<br/><br/>
		Below are his/her contact information and message:<br/><br/>
		<b>Full Name:</b><br/>".$firstname." ".$lastname."<br/><br/>
		<b>Mobile No.:</b><br/>".$mobileno."<br/><br/>
		<b>E-mail Address:</b><br/>".$email."<br/><br/>
		<b>Message:</b><br/>".$msg;

$mail = new PHPMailer;
$mail->IsSMTP();								// Set mailer to use SMTP
$mail->Host = 'mail.build.com.ph';				// Specify main and backup SMTP servers
$mail->Port = 587;								// TCP port to connect to
$mail->SMTPAuth = true;							// Enable SMTP authentication
$mail->Username = 'no-reply@build.com.ph';	// SMTP username
$mail->Password = '8Lg*9hhd';				// SMTP password
//$mail->SMTPSecure = 'tls';					// Enable TLS encryption, `ssl` also accepted

$mail->setFrom('no-reply@build.com.ph', 'AllRewards Auto-Mailer');
// echo json_encode($recipients);
// return;
// Add a recipients
foreach ($recipients as $recipient) {
	if($recipient['recipient_status'] == 'active'){
		$mail->AddAddress($recipient['recipient_email'], $recipient['recipient_name']);     
	}
}

$mail->MsgHTML($msg);							// Set email format to HTML

$mail->Subject = 'AllRewards Website Inquiry';
$mail->Body    = $message;

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" /> 
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<link rel="icon" type="image/png" href="images/favicon.png">

	<title>AllRewards | Thank You</title> 

	<!-- FONT AWESOME -->
	<link rel="stylesheet" type="text/css" href="lib/font-awesome/font-awesome.min.css">

	<script type="text/javascript" src="lib/jquery-3.1.1.min.js"></script>

	<!-- CUSTOM STYLES AND SCRIPTS -->
	<link rel="stylesheet" type="text/css" href="css/style.css?v=2">
	<script type="text/javascript" src="js/user-global.js"></script>
</head>
<body>
	<div class="container">
		<?php include("inc/sticky-header.php"); ?>

		<!-- CONTENT -->
		<div id="main-container">

			<div class="max-width">

				<div class="content">

					<?php if (!$mail->Send()) { ?>

						<h2>There was an error sending the message!</h2>

						<p>Please try again.</p>

						<a href="contact-us.php">Return to Inquiry Form</a>

					<?php } else { ?>

						<h2>Thank you for contacting us!</h2>

						<p>You are very important to us, all information received will always remain confidential. We will contact you as soon as we review your message.</p>

						<a href="index.php">Back to Home Page</a>

					<?php } ?>

				</div><!-- ../endof .content -->
				
			</div><!-- ../endof .max-width -->
			
		</div><!-- ../endof #main-container -->

		<!-- FOOTER -->
		<?php include("inc/footer.php"); ?>
		
	</div>
</body>

<script type="text/javascript">
	$(".menu-contact").addClass('active');
</script>
</html>