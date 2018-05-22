<?php 
require_once('dao/dao.hotline.php');
$hotline_list=hotline_dao::hotline_list();
$tel = str_replace("-","",$hotline_list['hotline_number']);
$tel = intval($tel);
?>

<div id="sticky-header" class="navigation">

	<div class="max-width">

		<div class="top-strip fleft desktop-only">
			<a href="uploads/allrewards-membership-form.pdf" download="AllRewards Membership Form" class="fleft">Become a Member Now</a>
			<a href="tel:<?= $tel; ?>" class="fright"><?= $hotline_list['hotline_title'] ?> at: <?= $hotline_list['hotline_number'] ?></a>
		</div><!-- ../endof .top-strip -->

		<div id="mobile-nav-btn" class="btn fleft mobile-only"><i class="fas fa-bars"></i></div>
		<!-- ../endof #mobile-nav-btn -->

		<div class="left-section fleft" style="max-width: 350px;">
			<a href="index.php" class="logo fleft"><img src="images/AllRewards-Logo.png" alt="AllRewards Logo"></a>
		</div><!-- ../endof .left-section -->

		<div class="right-section fright">

			<div id="mobile-search-btn" class="btn fright mobile-only"><i class="fa fa-search"></i></div>
			<!-- ../endof #mobile-search-btn -->

			<form id="search-form" class="upper-section fright" action="search.php">
				<div class="open-search btn"><i class="fa fa-search"></i></div>

				<div class="overlay">
					<div class="popup">
						<span>What are you looking for?</span>
						<input type="search" name="search"/>
						<button type="submit" class="search-btn btn">Search</button>
						<div class="cancel-btn btn">Cancel</div>
					</div>
				</div>
			</form><!-- ../endof .upper-section -->

			<div class="lower-section fright desktop-only">
				<ul class="top-menu fright">
					<li class="menu-contact"><a href="contact-us.php">Contact Us</a></li>
					<li class="menu-promos"><a href="news-and-events.php">Ongoing Promos</a></li>
					<li class="menu-partners"><a href="partners.php">Partners</a></li>
					<li class="menu-rewards"><a href="rewards.php">Rewards</a></li>
					<li class="menu-membership"><a href="membership.php">Membership</a></li>
				</ul>
			</div><!-- ../endof .lower-section -->
			
		</div><!-- ../endof .desktop-only.right-section -->
		
	</div><!-- ../endof .max-width -->

</div><!-- ../endof #sticky-header.navigation -->

<div id="mobile-nav" class="mobile-only">
	<ul class="side-menu">
		<li class="menu-home"><a href="index.php">Home</a></li>
		<li class="menu-membership"><a href="membership.php">Membership</a></li>
		<li class="menu-rewards"><a href="rewards.php">Rewards</a></li>
		<li class="menu-partners"><a href="partners.php">Partners</a></li>
		<li class="menu-promos"><a href="news-and-events.php">Ongoing Promos</a></li>
		<li class="menu-contact"><a href="contact-us.php">Contact Us</a></li>
		<li class="menu-faqs"><a href="faqs.php">Frequently Asked Questions</a></li>
		<li class="menu-terms"><a href="terms-and-conditions.php">Terms &amp; Conditions</a></li>
		<li class="menu-terms"><a href="uploads/allrewards-membership-form.pdf" download="AllRewards Membership Form" target="_blank">Become a Member Now</a></li>
		<li class="menu-terms"><a href="tel:<?= $tel; ?>"><?= $hotline_list['hotline_title'] ?> at: <?= $hotline_list['hotline_number'] ?></a></li>
	</ul>
</div><!-- ../endof #mobile-nav -->