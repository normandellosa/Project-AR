<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" /> 
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<link rel="icon" type="image/png" href="images/favicon.png">

	<title>AllRewards | Frequently Asked Questions</title> 

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

				<div id="faqs-content">

					<h2>Frequently Asked Questions</h2>

					<ul>
						<li id="faq-1" class="active">
							<h3>Who can apply for All Rewards Card?</h3>
							<p>Must be 18 years old and above and is a resident of the Philippines with valid identification cards.</p>
						</li>
						<li id="faq-2">
							<h3>How can I apply for All Rewards Card?</h3>
							<p>Here are two ways on how you can apply for All Rewards Card:<br/>
							1. You may receive a free AllRewards card, if you have an accumulated purchase of P5000 in a period of 60 days, from any of our participating stores.<br/>
							2. You may purchase AllRewards Card at the cashier counter of All Home, All Day Supermarket and All Shoppe Department Store for only 150 pesos.  After payment, you may then proceed to Customer Service for the application process.
							</p>
						</li>
						<li id="faq-3">
							<h3>How long does my membership last?</h3>
							<p>Membership doesn’t expire as long as you use the card. Points will expire after two years of zero transaction.</p>
						</li>
						<li id="faq-4">
							<h3>What is the All Rewards Temporary Card?</h3>
							<p>The temporary card allows you to earn points right after purchase. You can claim your permanent card  15 days from date of application at the store where you filed your application.</p>
						</li>
						<li id="faq-5">
							<h3>What will happen to the points I earned using AllRewards Temporary Card when I redeem my permanent card?</h3>
							<p>Points earned using All Rewards Temporary Card will automatically be transferred to your permanent card upon claim. </p>
						</li>
						<li id="faq-6">
							<h3>Does AllRewards Temporary Card expire?</h3>
							<p>No, but you cannot use the card to redeem points.</p>
						</li>
						<li id="faq-7">
							<h3>What happens to my points if I lose my AllRewards Temporary Card?</h3>
							<p>For loss cards, please see procedure on loss card replacement.</p>
							<p>Points will expire after two years of zero transaction. You can apply for card replacement for lost or damaged card.</p>
						</li>
						<li id="faq-8">
							<h3>How do I claim my AllRewards permanent card?</h3>
							<p>Surrender your AllRewards temporary card to the Customer Service Counter of the branch/store where you bought the card. You will then be given your permanent AllRewards Card.</p>
						</li>
						<li id="faq-9">
							<h3>How do I earn All Rewards points?</h3>
							<p>Just present your All Rewards card to the cashier at the start of every transaction. Every P400 purchase at any All Day (mart, convenience store and supermarket), All Home, AllShoppe, All Toys, All Baby and Kids and Coffee Project, entitles you to 1 point which is equivalent to P1.</p>
							<p>You may also earn a fraction of a point if you purchase below P400 i.e P100 will earn P0.25</p>
						</li>
						<li id="faq-10">
							<h3>I spent less than the minimum required amount of P400. Will I still earn points?</h3>
							<p>Yes, you can earn fractions of a point.  Every purchase is entitled to earn points.  Points are computed or based on every P400 purchase.</p>
						</li>
						<li id="faq-11">
							<h3>Will my AllReward points expire?</h3>
							<p>Points will expire after two years of zero transaction.</p>
						</li>
						<li id="faq-12">
							<h3>How can I use my points to redeem rewards?</h3>
							<p>AllRewards Card points, like cash can be used to pay for your purchases. A minimum balance of 30 points is required to start redeeming rewards. After the initial redemption, you may redeem using any amount.  No minimum amount required.</p>
						</li>
						<li id="faq-13">
							<h3>When can I start using my AllRewards points for redemption?</h3>
							<p>You can start using your points to redeem reward/s upon accumulation of at least 30 points. However, there is no minimum redeemable reward value. Also, you may choose to accumulate more points to redeem items of higher value.</p>
						</li>
						<li id="faq-14">
							<h3>How can I check my All Rewards points balance?</h3>
							<p>You can ask Cashiers to check available points at the check-out counter or email ALL Rewards Customer Service at customercare@allgroup.com.ph.</p>
						</li>
						<li id="faq-15">
							<h3>How long does it take for points to be credited to my account?</h3>
							<p>The points you earned will automatically credited to your account a day after the transaction.</p>
						</li>
						<li id="faq-16">
							<h3>What do I do if my All Rewards Card gets lost?</h3>
							<p>You can go to the Customer Service Area and requests the representative for a replacement.  For loss cards, please submit Affidavit of Loss, filled-up card replacement form in duplicate and a valid ID. A fee of P100 will be applied. All transaction record, if there’s any, shall automatically be credited to the newly issued loyalty card.</p>
						</li>
						<li id="faq-17">
							<h3>What should I do in case my card becomes defective?</h3>
							<p>For damaged cards, please submit the filled-up card replacement form in duplicate, a valid ID and the damaged card itself at any customer service counter of AllHome and All Day Supermarket.</p>
						</li>
						
					</ul>
					
				</div><!-- ../endof .content -->
				
			</div><!-- ../endof .max-width -->
			
		</div><!-- ../endof #main-container -->

		<!-- FOOTER -->
		<?php include("inc/footer.php"); ?>

	</div>

</body>

<script type="text/javascript">
	$(document).ready(function(){
		$("#faqs-content li").click(function(){
			if (!$(this).hasClass('active')) {
				$("#faqs-content li").removeClass('active');
				$(this).addClass('active');

				$("#faqs-content p").slideUp();
				$("#"+this.id+" p").slideToggle();
			}
		});
	});
</script>

<script type="text/javascript">
	$(".menu-faqs").addClass("active");
</script>

</html>