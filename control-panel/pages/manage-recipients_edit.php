<?php 
	session_start();

	require_once('../dao/accessDao.php');
	if(isset($_SESSION['account_id']) && $_SESSION['account_id'] != '') {	
		$access = accessDao::accessPage($_SESSION['account_id'], 14);
	
		if(!$access && $_SESSION['account_type'] != 'Administrator') {
			echo '<script> window.history.back(); </script>';
		}	
	} else {
		echo '<script> window.history.back(); </script>';
	}
	require_once('../dao/recipientDao.php');
	$id=$_GET['id'];
	$recipient = recipientDao::recipientView($id);

	

 ?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>AllRewards cPanel | Update Inquiry Recipient Details</title> 

	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" /> 
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<link rel="icon" type="image/png" href="../favicon.png">

	<link href="../lib/jquery-ui/jquery-ui.structure.min.css" rel="stylesheet" type="text/css"/>
	<link href="../lib/jquery-ui/jquery-ui.theme.min.css" rel="stylesheet" type="text/css"/>

	<link href="../styles/normalize.css" rel="stylesheet" type="text/css"/>
	<link href="../styles/component.css" rel="stylesheet" type="text/css" />

	<!-- FONTAWESOME -->
	<link href="../lib/fontawesome/font-awesome.min.css" rel="stylesheet" type="text/css"/>

	<!-- RESPONSIVE GRID -->
	<link href="../lib/responsiveGrid/responsivegrid.css" rel="stylesheet">

	<!-- FORM VALIDATOR -->
	<link href="../lib/form-validator/theme-default.min.css" rel="stylesheet" type="text/css" />

	<!-- MAIN STYLESHEETS and JS -->
	<link href="../styles/main.css" rel="stylesheet" type="text/css" />
</head>
<body>

<div id="main-container">

	<div id="body-box">

		<section id="side-menu-section">
			<?php include('../inc/menu-sidemenu.php') ?>
		</section><!-- ../endof #side-menu-section -->

		<section id="main-body-section">

			<div id="content-container">

				<div class="section group col span_2_of_2">
						
					<form id="recipientForm" enctype="multipart/form-data" class="formular" name="example1" method="post" action="../controller/controller.recipients.php?action=update_recipient">

						<div class="span-content-header">
							<h1>Update E-mail Recipient Details</h1>
						</div><!-- ../endof .span-content-header -->

						<input name="id" value="<?= $id ?>" type="hidden">

						<div class="span-content-container form-add">

							<table>
								<tr>
									<td>
										<h2><span class="highlight">IMPORTANT:</span><br/>
										Fields with an asterisk (*) mean that they are required.<br/>
										Any e-mail address added in this section will get to receive <b>inquiries</b> from the website.</h2>
									</td>
								</tr>
								
								<!-- STATUS -->
								<tr>
									<td>
										<label for="recipient_status">Status <span class="highlight">*</span></label>
										<select id="recipient_status" name="recipient_status" tabindex="1">
											<option value="active" <?php if($recipient['recipient_status'] == 'active'){ echo 'selected'; } ?> >Active</option>
											<option value="disabled" <?php if($recipient['recipient_status'] == 'disabled'){ echo 'selected'; } ?> >Disabled</option>
										</select>
										<div class="remark">When an Inquiry Recipient is <b>disabled</b>, the person will not receive inquiry e-mails from the website.</div>
									</td>
								</tr>

								<tr>
									<td>
										<label for="recipient_name">Full Name <span class="highlight">*</span></label>
										<input name="recipient_name" id="recipient_name" type="text" value="<?= $recipient['recipient_name'] ?>" placeholder="Juan Dela Cruz" tabindex="2"
											data-sanitize="trim"
											data-validation="custom length"
											data-validation-regexp="^[a-zA-Z\s]*$"
											data-validation-length="min3"/>
									</td>
								</tr>

								<tr>
									<td>
										<label for="recipient_email">E-mail Address <span class="highlight">*</span></label>
										<input name="recipient_email" id="recipient_email" type="email" value="<?= $recipient['recipient_email'] ?>" placeholder="juan.delacruz@allrewards.com.ph" tabindex="3"
											data-sanitize="trim"
											data-validation="email"/>
									</td>
								</tr>

							</table>
							</table><!-- ../endof table -->
							
						</div><!-- ../endof .span-content-container -->

						<div class="span-content-footer">
							<button class="cms-btn btn" tabindex="3">Update</button>
							<a href="manage-recipients.php" class="cms-btn cancel-btn btn">Cancel</a>
						</div><!-- ../endof .span-content-footer -->
					
					</form>	

				</div><!-- ../endof .section.group -->
				
			</div><!-- ../endof #content-container -->
			
		</section><!-- ../endof #main-body-section -->

	</div><!-- ../endof #body-box -->

</div><!-- ../endof #main-container -->

<script src="../lib/jquery-3.1.1.min.js" type="text/javascript"></script>
<script src="../lib/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>

<!-- FORM VALIDATOR -->
<script src="../scripts/custom-file-input.js" type="text/javascript"></script>
<script src="../lib/form-validator/jquery.form-validator.min.js" type="text/javascript"></script>

<!-- CUSTOM SCRIPTS -->
<script type="text/javascript">
$(document).ready(function(){
	$("#menu-email").addClass('active');

	$.validate({
		modules   : 'file, sanitize'
	});

	$("#menu-logout").click(function(){
		var name = $("#dname").val();
		if ( confirm("You are currently logged-in as " + name + ". Are you sure you want to sign out?") == true) {
			location.href='../logout.php';
		} else {
			return;
		}
	});
});
</script>

</body>
</html>