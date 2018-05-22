<?php 
require_once('dao/carouselDao.php');
require_once('dao/rewardsNewsDao.php');
date_default_timezone_set('Asia/Manila');
$now = date('Y-m-d');

$carousels = carouselDao::carouselList();
$promos = rewardsNewsDao::rno_ListForHomePage('News & Events',$now);

 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" /> 
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<link rel="icon" type="image/png" href="images/favicon.png">

	<title>AllRewards | Home Page</title> 

	<!-- FONT AWESOME -->
	<link rel="stylesheet" type="text/css" href="lib/font-awesome/font-awesome.min.css">

	<script type="text/javascript" src="lib/jquery-3.1.1.min.js"></script>

	<!-- IMAGESLOADED -->
	<script type="text/javascript" src="lib/imagesloaded/imagesloaded.pkgd.min.js"></script>

	<!-- FLEXSLIDER -->
	<script src="lib/flexslider/jquery.flexslider-min.js"></script>
	<link rel="stylesheet" type="text/css" href="lib/flexslider/flexslider.css">


    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
     <link href="css/style.css" rel="stylesheet">
	 <link rel="stylesheet" href="fonts/css/font-awesome.min.css">
	   <link rel="stylesheet" href="css/bootstrap-datepicker3.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
		

	<!-- CUSTOM STYLES AND SCRIPTS -->
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/style-new.css">
	<script type="text/javascript" src="js/user-global.js"></script>
	<script type="text/javascript" src="js/user-main.js"></script>
</head>
<body>
	<div class="container">
		<!-- HEADER AND MENU -->
		<?php include("inc/sticky-header.php"); ?>

</div>

			<div class="container inner-page">
				<div class="login-wrap">
		
					<form>
					  <div class="form-group">
					    <label>Email address</label>
					    <input type="email" class="form-control" placeholder="name@example.com">
						<small class="form-text text-muted">
						 Enter your registered AllRewards email address.
						</small>
					  </div>
		  
		  
		 
		  
		  
					  <div class="form-group">
					    <label>Password</label>
					    <input type="password" class="form-control">
						<small class="form-text text-muted">
						Enter the your AllRewards password.
						</small>
					  </div>
					  <div class="forgot-login">
					  <input type="submit" class="submit-but login-but" value="Login">
					<small> <a href="#" class="forgot-link">Forgot your password?</a></small>
		
				  </div>
	  
	    
					</form>
		
					<p class="login-signup">Don’t have an account? <a href="#">Sign Up</a></p>
		
				</div>
				

		</div>
		

		<!-- FOOTER -->
		<?php include("inc/footer.php"); ?>
		
	</div>
</body>

<script type="text/javascript">
	$(".menu-home").addClass("active");
</script>
</html>