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
				<div class="row">
				<div class="col-sm-3 my-account-left-wrap">
					<div class="my-account-left">
					<div class="my-account-welcome">
					<h1>Welcome John!</h1>
						<p>Last login details:</p>
						<p>April 30, 2018 | 03:00 PM</p>
						<p><strong><a href="Logout" class="logout-link">Logout</strong></a>
					</div>
			
			
						<h2><span class="allvalue-red">My</span> Membership</h2>
				
					<div class="my-membership">	
						<ul>
							<li><strong>My Profile</strong>
							<ul>
								<li><a href="#">My Account</a></li>
								<li><a href="#">My Personal Details</a></li>
							</ul>
					
							</li>
					
					
					
							<li><strong>My Transactions</strong>
					
							<ul>
								<li><a href="#">Awarding and Redemption</a></li>
								<li><a href="#">Monthly Spending</a></li>
							</ul>
							</li>
						
						
						
						
					
					
					
						</ul>
				
				
					</div>
				</div>
						<img src="images/promo-square.jpg" class="img-responsive">
			
				</div>
		
			<div class="col-sm-8 my-account-main-wrap">
				<img src="images/promo-rectangle.jpg" class="img-responsive">
		
					<h2><span class="allvalue-red">Awarding</span> and Redemption</h2>
					<p>As of: <strong>April 30, 2018</strong>
			
			
			
			
			
						<form>
				
			    


						<div class="form-group row">
									      <label class="col-sm-2 col-form-label">Select Card</label>
									      <div class="col-sm-4">
						 						 <div class="form-group-select">
						 					    <select class="form-control">
						
						 						 <option>0000 0000 0000 0001</option>
												  <option>0000 0000 0000 0002</option>
												   <option>0000 0000 0000 0003</option>
 						 
						 					    </select>
						 					</div>
										</div>
			  			     
							 
										<div class="col-sm-6"></div> 
							 
										</div>
							
							
										<div class="form-group row">
									      <label class="col-sm-2 col-form-label">Start Date</label>
									      <div class="col-sm-4">
						 						 <div class="datepicker">
				 					
							 			      <input type="text" class="form-control">
						 					</div>
										</div>
						  			      <label class="col-sm-2 col-form-label">End Date</label>
						  			      <div class="col-sm-4">
						   						 <div class="datepicker">
				  					
							  			      <input type="text" class="form-control">
						   					</div>
									      </div>
										</div>
			   
			<input type="submit" class="submit-but-mini" value="Search Transactions">
			<div class="clearfix"></div>
					
									      </form>
			
			
			
			
			
			
			
			
			
						<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
						  <li class="nav-item col-sm-6 active">
						    <a class="nav-link active" id="points-awarding-tab" data-toggle="pill" href="#points-awarding" role="tab" aria-controls="points-awarding" aria-selected="true">Points Awarding History</a>
						  </li>
						  <li class="nav-item col-sm-6">
						    <a class="nav-link" id="points-redemption-tab" data-toggle="pill" href="#points-redemption" role="tab" aria-controls="points-redemption" aria-selected="false">Points Redemption History</a>
						  </li>
			  
						</ul>
			
						<!-- CONTENT FOR POINTS AWARDING -->
			
						<div class="tab-content" id="pills-tabContent">
						  <div class="tab-pane  fade in active" id="points-awarding" role="tabpanel" aria-labelledby="points-awarding-tab">
							  <div class="points-table table-responsive">
							<table class="table table-striped">
							  <thead>
							    <tr>
							      <th scope="col">Transaction Date</th>
							      <th scope="col">Transaction Time</th>
							      <th scope="col">Store</th>
							      <th scope="col">Branch</th>
								    <th scope="col">Total Receipt Amount</th>
								   <th scope="col">Points Earned</th>
							    </tr>
							  </thead>
							  <tbody>
							    <tr>
				    
							      <td>November 1, 2017</td>
							      <td>3:30 PM</td>
							      <td>All Home</td>
								  <td>Starmall Alabang</td>
								    <td>P 300.25</td>
								   <td>10</td>
							    </tr>
				   
				   
						    <tr>
			    
						      <td>November 1, 2017</td>
						      <td>3:30 PM</td>
						      <td>All Home</td>
							  <td>Starmall Alabang</td>
							  <td>P 300.25</td>
							   <td>10</td>
						    </tr>
				
						    <tr>
			    
						      <td>November 1, 2017</td>
						      <td>3:30 PM</td>
						      <td>All Home</td>
							  <td>Starmall Alabang</td>
							    <td>P 300.25</td>
							   <td>10</td>
						    </tr>
				
						    <tr>
			    
						      <td>November 1, 2017</td>
						      <td>3:30 PM</td>
						      <td>All Home</td>
				 
							  <td>Starmall Alabang</td>
							    <td>P 300.25</td>
							   <td>10</td>
						    </tr>
							  </tbody>
							</table>
						</div>
				
						  </div>
			  
						  <!-- CONTENT FOR POINTS REDEMPTION -->
						  <div class="tab-pane fade" id="points-redemption" role="tabpanel" aria-labelledby="points-redemption-tab">
			  	
				
								  <div class="points-table table-responsive">
								<table class="table table-striped">
								  <thead>
								    <tr>
								      <th scope="col">Transaction Date</th>
								      <th scope="col">Transaction Time</th>
								      <th scope="col">Store</th>
								      <th scope="col">Branch</th>
									   <th scope="col">Points Redeemed</th>
								    </tr>
								  </thead>
								  <tbody>
								    <tr>
				    
								      <td>November 1, 2017</td>
								      <td>3:30 PM</td>
								      <td>All Home</td>
									  <td>Starmall Alabang</td>
									   <td>10</td>
								    </tr>
				   
				   
							    <tr>
			    
							      <td>November 1, 2017</td>
							      <td>3:30 PM</td>
							      <td>All Home</td>
								  <td>Starmall Alabang</td>
								   <td>10</td>
							    </tr>
				
							    <tr>
			    
							      <td>November 1, 2017</td>
							      <td>3:30 PM</td>
							      <td>All Home</td>
								  <td>Starmall Alabang</td>
								   <td>10</td>
							    </tr>
				
							    <tr>
			    
							      <td>November 1, 2017</td>
							      <td>3:30 PM</td>
							      <td>All Home</td>
								  <td>Starmall Alabang</td>
								   <td>10</td>
							    </tr>
								  </tbody>
								</table>
							</div>
				
				
						  </div>
			 
						</div>
			
						<span class="save-print">
					<i class="far fa-file-pdf "></i> <a href="#">Save as PDF</a> <i class="fas fa-print"></i> <a href="#">Print</a></span>
				</div>
			
		
		
		
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