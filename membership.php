<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" /> 
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<link rel="icon" type="image/png" href="images/favicon.png">

	<title>AllRewards | Membership</title> 

	<!-- FONT AWESOME -->
	<link rel="stylesheet" type="text/css" href="lib/font-awesome/font-awesome.min.css">

	<script type="text/javascript" src="lib/jquery-3.1.1.min.js"></script>

	<!-- CUSTOM STYLES AND SCRIPTS -->
	<link rel="stylesheet" type="text/css" href="css/style.css?v=2">
	<script type="text/javascript" src="js/user-global.js"></script>
	<style>
		.row {
			display: block;
		}
		.col-f-left{
			float: left;
			width: 70%;
			padding-right: 20px;
    		box-sizing: border-box;
		}
		.col-f-right{
			float: right;
			width: 30%;
		}
		.col-f-right img{
			padding-top: 25px;
		}
		@media screen and (max-width: 768px){
			.col-f-left{
				width: 100%;
			}
			.col-f-right{
				width: 100%;
			}
			.col-f-right img{
				padding-top: 0;
			}
		}
		@media screen and (max-width: 540px){
			.col-f-right img{
				padding-top: 15px;
			}
		}
	</style>
</head>
<body>
	<div class="container">
		<?php include("inc/sticky-header.php"); ?>

		<!-- CONTENT -->
		<div id="main-container">

			<div class="max-width">

				<div class="content">
					<div class="row">
					    <div class="col-f-right">
							<img src="images/all-reward-card-front.png" alt="" style="width: 100%;">
						</div>
					    <div class="col-f-left">

							<h1>About the <span class="red">All</span>Rewards Loyalty Program</h1>

							<p>We are the biggest loyalty program in the country with the widest network of stores like the AllHome, AllDay, and other establishments that lets our members earn and redeem points every time they shop.</p>

							<p>Aside from reward points, our members get exclusive access to sale events, discounts, special offers, and freebies within all our external partners.</p>

							<h2>Become an <span class="red">All</span>Rewards Member</h2>

							<p>Start earning reward points and enjoy members-only privileges by following these simple steps:</p>
							<p><strong>In-store</strong></p>
							<ol>
								<li>Buy an AllRewards Express Membership Kit at any Cashier Counter of AllHome, AllDay, or select retail partners for only P150.</li>
								<li>Use the temporary card to start earning points.</li>
								<li>Fill out the enclosed Membership Application Form and submit to the Customer Service Counter of any branch.</li>
								<li>Claim your personalized AllRewards Card at any Customer Service Counter in just a few minutes.</li>
							</ol>

							<p><strong>Online</strong></p>
							<ol>
								<li>Click <a href="uploads/allrewards-membership-form.pdf" download="AllRewards Membership Form">here</a> to download the AllRewards Membership Form.</li>
								<li>Submit the filled-in Membership Form to any AllDay or AllHome branch near you.</li>
								<li>You will receive a confirmation email on how to claim your card.</li>
							</ol>	

							<p><strong>Duration and Renewal</strong></p>
							<p>Your membership is valid for two years from date of application, and is renewable.</p>
							<p>To renew, simply go to any Cashier Counter of The All Retail Store and pay the renewal fee using cash (P100), points (80 points) or any other tender. Present the receipt together with your old AllRewards Card to the Customer Service Counter and your new card will be ready in just a few minutes.</p>
							<p>To renew your membership through a representative, the representative must bring the following: signed authorization letter; photocopies of your and your representative's valid government-issued IDs; and a photocopy of your AllRewards Card.</p>
					    </div>
					 </div>
					
				</div><!-- ../endof .content -->
				
			</div><!-- ../endof .max-width -->
			
		</div><!-- ../endof #main-container -->

		<!-- FOOTER -->
		<?php include("inc/footer.php"); ?>

	</div>

</body>

<script type="text/javascript">
	$(".menu-membership").addClass("active");
</script>
</html>