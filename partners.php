<?php 
require_once('dao/dao.partners.php');
$partners = partners_dao::partners_list();
$locations = partners_dao::partners_locations();

require_once('dao/categoriesDao.php');
$categories = AllRewardsCategoryDao::categoryList();

require_once("inc/truncate.php");
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" /> 
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<link rel="icon" type="image/png" href="images/favicon.png">

	<title>AllRewards | Partners</title> 

	<!-- FONT AWESOME -->
	<link rel="stylesheet" type="text/css" href="lib/font-awesome/font-awesome.min.css">

	<script type="text/javascript" src="lib/jquery-3.1.1.min.js"></script>

	<!-- IMAGESLOADED -->
	<script type="text/javascript" src="lib/imagesloaded/imagesloaded.pkgd.min.js"></script>

	<!-- MASONRY & ISOTOPE -->
	<script type="text/javascript" src="lib/isotope/isotope.pkgd.min.js"></script>

	<!-- CUSTOM STYLES AND SCRIPTS -->
	<link rel="stylesheet" type="text/css" href="css/style.css?v=2">
	<script type="text/javascript" src="js/user-global.js"></script>
	<script type="text/javascript" src="js/user-isotope.js"></script>
</head>
<body>
	<div class="container">
		<?php include("inc/sticky-header.php"); ?>

		<!-- CONTENT -->
		<div id="main-container">

			<div class="max-width">

				<!-- SIDE WIDGET -->
				<div id="side-widget" class="widget-section">

					<!-- FILTER WIDGET -->
					<div id="filter-widget" class="widget">

						<div class="ws-header">
							<h2>Partners</h2>
						</div>
						<div class="ws-content">
							<ul class="ws-filter">
								<li class="ws-filter-btn active" data-filter="*">Show All</li>
								<?php foreach($categories as $category) { ?>
								<li class="ws-filter-btn disabled category-<?= $category['category_id'] ?>" data-filter=".category-<?= $category['category_id'] ?>"><?= $category['category_name'] ?></li>
								<?php } ?>	
							</ul>
						</div>

					</div><!-- ../endof #filter-widget -->

					<!-- FILTER BY LOCATION WIDGET -->
					<div id="filter2-widget" class="widget">

						<div class="ws-header">
							<h2>Location</h2>
						</div>
						<div class="ws-content">
							<ul class="ws-filter">
								<li class="ws-filter-btn active" data-filter="*">Show All</li>
								<?php if(!empty($locations)) { ?>
									<?php foreach($locations as $loc) { ?>
										<?php $locFilter = ".loc-".str_replace(" ","",$loc['partners_cityprovince']); ?>
										<li class="ws-filter-btn" data-filter="<?= $locFilter; ?>"><?= $loc['partners_cityprovince'] ?></li>
									<?php } ?>	
								<?php } ?>	
								<li class="ws-filter-btn" data-filter=".mm-1">Outside Metro Manila</li>
							</ul>
						</div>

					</div><!-- ../endof #filter-widget -->

				</div><!-- ../endof #side-widget.widget-section -->

				<!-- GRID CONTENT -->
				<div id="grid-content">
					<div class="grid-sizer"></div>
					<?php if($partners) {
						foreach($partners as $partner) { ?>
						<?php $partnerLoc = "loc-".str_replace(" ","",$partner['partners_cityprovince']); ?>
						<a class="partner-item grid-item <?php echo "category-".$partner['rno_category_fk'] ?> <?= $partnerLoc; ?> <?php echo "mm-".$partner['partners_location'] ?>" href="partner.php?id=<?= $partner['partners_ID'] ?>">
							<img class="gi-preview" src="images/logo-<?= $partner['category_code']?>.png" title="<?= $partner['partners_name']; ?>" alt="<?= $partner['partners_name']; ?>" style="max-width: 250px;" />
							<div class="gi-details">
								<div class="gi-desc">
									<h3><?= $partner['partners_name']; ?></h3>
									<p><strong>Address: </strong><?= $partner['partners_address']; ?></p>
									<?php if (!empty($partner['partners_email'])) { ?>
									<p><strong>Email: </strong><?= $partner['partners_email']; ?></p>
									<?php } ?>
									<?php if (!empty($partner['partners_tel'])) { ?>
									<p><strong>Tel. / Mobile: </strong><?= $partner['partners_tel']; ?></p>
									<?php } ?>
								</div>
							</div>
						</a><!-- ../endof .grid-item -->
						<?php
						echo '<script>$(".category-'.$partner['rno_category_fk'].'").removeClass("disabled");</script>';
						}
					} else { ?>
					<p>There are currently no Rewards. Please check back again another time!</p>
					<?php } ?>
				</div><!-- ../endof #grid-content -->
				
			</div><!-- ../endof .max-width -->
			
		</div><!-- ../endof #main-container -->

		<!-- FOOTER -->
		<?php include("inc/footer.php"); ?>

	</div>

</body>

<script type="text/javascript">
	$(".menu-partners").addClass("active");
</script>

</html>