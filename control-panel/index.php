<?php 
	session_start();

	if(isset($_SESSION['Login'])=="Ok") {
		header("Location: control-panel/pages/manage-carousel.php");			   
	}
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>AllRewards cPanel</title> 

	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" /> 
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<link rel="icon" type="image/png" href="../images/favicon.png">

	<link href="lib/jquery-ui/jquery-ui.structure.min.css" rel="stylesheet" type="text/css"/>
	<link href="lib/jquery-ui/jquery-ui.theme.min.css" rel="stylesheet" type="text/css"/>

	<link href="styles/normalize.css" rel="stylesheet" type="text/css"/>
	<link href="styles/component.css" rel="stylesheet" type="text/css" />

	<!-- FONTAWESOME -->
	<link href="lib/fontawesome/font-awesome.min.css" rel="stylesheet" type="text/css"/>

	<!-- RESPONSIVE GRID -->
	<link href="lib/responsiveGrid/responsivegrid.css" rel="stylesheet">

	<!-- MAIN STYLESHEETS and JS -->
	<link href="styles/main.css" rel="stylesheet" type="text/css" />
	<link href="styles/login.css" rel="stylesheet" type="text/css" />
</head>
<body>

<!-- ================LOGIN SECTION=============== -->
<div id="login-section">
	<div id="login-container">
		<div class="login-logo">
			<img src="../images/all-rewards-logo.png">
			<p>Content Management System</p>
		</div><!-- ../endof .login-logo -->
		
		<form id="login-form" name="login-form" method="post" action="controller/login-check.php">
			<!-- USERNAME --> 
			<div class="input_box" align="center">
				<label for="username">Username</label>
				<input placeholder="User Name" name="username" type="text" id="username" class="login-input" tabindex="1" required>
			</div>

			<!-- PASSWORD -->
			<div class="input_box" align="center">
				<label for="password">Password</label>
				<input placeholder="Password" name="password" type="password" id="password" class="login-input" tabindex="2" required>
			</div>
		
			<div class="login-warning" align="center"></div><!-- ../endof .login-warning -->
				
			<!-- LOGIN BUTTON -->
			<div class="input_box" align="center">
				<button id="login-btn" class="cms-btn btn" tabindex="3">Login</button>
			</div>

		</form><!-- ../endof #login-form -->
	</div><!-- ../endof #login-container -->
</div><!-- ../endof #login-section -->

<script src="lib/jquery-3.1.1.min.js" type="text/javascript"></script>
<script type="text/javascript" src="scripts/login.js"></script>

</body>
</html>