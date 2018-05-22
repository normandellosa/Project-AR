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

	<!-- CUSTOM STYLES AND SCRIPTS -->
	<link rel="stylesheet" type="text/css" href="css/style.css?v=2">
	<script type="text/javascript" src="js/user-global.js"></script>
	<script type="text/javascript" src="js/user-main.js"></script>
</head>
<body>
	<div class="container">
		<!-- HEADER AND MENU -->
		<?php include("inc/sticky-header.php"); ?>

		<!-- CONTENT -->
		<div id="main-container">

			<div class="max-width">

				<!-- FLEXSLIDER -->
				<div id="featured-ad" class="bordered">
					<ul class="slides">
						<?php foreach($carousels as $homeslider) { ?>
							<?php if(empty($homeslider['carousel_url'])) { ?>	
								<li><img src="uploads/<?= $homeslider['carousel_feature_img'] ?>" alt="<?= $homeslider['carousel_feature_alt']?>" title="<?= $homeslider['carousel_feature_alt']?>" /></li>
							<?php } else { ?>
								<li><a href="<?= $homeslider['carousel_url']; ?>" target="<?= $homeslider['carousel_target']; ?>" style="text-decoration:none;"><img src="uploads/<?= $homeslider['carousel_feature_img'] ?>" alt="<?= $homeslider['carousel_feature_alt']?>" title="<?= $homeslider['carousel_feature_alt']?>" /></a></li>
							<?php } ?>
						<?php } ?>
					</ul>
				</div><!-- ../endof #featured-ad -->

				<!-- HOME WIDGET -->
				<div id="home-widget" class="widget-section">

					<!-- BECOME A MEMBER -->
					<div id="membership-widget" class="widget">
						<div class="ws-header">
							<h2>Become a Member</h2>
						</div>
						<div class="ws-content">
							<a href="uploads/allrewards-membership-form.pdf" download="AllRewards Membership Form" class="ws-membership-thumb ws-thumb bordered"><img src="images/apply-now.jpg" alt="Download the AllRewards Membership Form"></a>
						</div>
					</div><!-- ../endof #membership-widget -->
				

					<!-- PROMOS, NEWS & OFFERS -->
					<div id="promos-widget" class="widget">
						<div class="ws-header">
							<h2>News &#38; Events</h2>
							<a href="news-and-events.php" class="ws-btn btn">View All</a>
						</div>
						<div class="ws-content">
							<?php foreach($promos as $promo) { ?>
							<a class="ws-promo-thumb ws-thumb bordered" href="news.php?id=<?= $promo['rno_id'] ?>">
								<div class="ws-promo-thumb-preview" style="background:url('uploads/<?= $promo['rno_image']?>');background-size:100% auto;background-position:center center;"></div>
								<span class="ws-promo-title"><?= $promo['rno_title']; ?></span>
								
								<span class="ws-promo-date">
								<?php if (empty($promo['rno_date_end'])) { ?>

								<?php } else if (empty($promo['rno_date_start']) && !empty($promo['rno_date_end'])) {
									$endDateFull = date("M j, Y",strtotime($promo['rno_date_end'])); ?>

									<!-- only START DATE is BLANK -->
									Up to <?= $endDateFull ?>

								<?php } else {

									/*START and END DATES are not BLANK*/
									$startYear = date("Y",strtotime($promo['rno_date_start']));
									$endYear = date("Y",strtotime($promo['rno_date_end']));

									$startDateFull = date("M j, Y",strtotime($promo['rno_date_start']));
									$startDate = date("M j",strtotime($promo['rno_date_start']));
									$endDateFull = date("M j, Y",strtotime($promo['rno_date_end']));

									if ($startYear <> $endYear) { ?>
										<?= $startDateFull.' - '.$endDateFull ?>
									<?php } else { ?>
										<?= $startDate.' - '.$endDateFull ?>
									<?php }
								} ?>
								</span>


							</a>
							<?php } ?>
						</div>
					</div><!-- ../endof #promos-widget -->

					

				</div><!-- ../endof #home-widget.widget-section -->
				
			</div><!-- ../endof .max-width -->
			
		</div><!-- ../endof #main-container -->

		<!-- FOOTER -->
		<?php include("inc/footer.php"); ?>
		
	</div>
</body>

<script type="text/javascript">
	$(".menu-home").addClass("active");
</script>
</html>