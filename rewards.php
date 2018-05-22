<?php 
require_once('dao/rewardsNewsDao.php');
require_once('dao/categoriesDao.php');

require_once("inc/truncate.php");
date_default_timezone_set('Asia/Manila');
$now = date('Y-m-d');

$rnoList = RewardsNewsDao::rno_ListByAlphabetical('Rewards',$now);
$categories = AllRewardsCategoryDao::categoryList();

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" /> 
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<link rel="icon" type="image/png" href="images/favicon.png">

	<title>AllRewards | Rewards</title> 

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
							<h2>Rewards</h2>
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

				</div><!-- ../endof #side-widget.widget-section -->

				<!-- GRID CONTENT -->
				<div id="grid-content">
					<div class="grid-sizer"></div>
					<?php if($rnoList) {
						foreach($rnoList as $rno) { ?>
						<a class="reward-item grid-item <?= "category-".$rno['rno_category_fk'] ?>" href="reward.php?id=<?= $rno['rno_id'] ?>">
							<img class="gi-preview" src="uploads/<?= $rno['rno_image'] ?>"/>
							<div class="gi-details">
								<div class="gi-desc">
									<h3><?= $rno['rno_title']?></h3>
									<?php echo truncate($rno['rno_subtitle']); ?>
									<div class="gi-logo"><img src="images/logo-<?= $rno['category_code']?>.png"></div>
								</div>
							</div>
						</a><!-- ../endof .grid-item -->
						<?php
						echo '<script>$(".category-'.$rno['rno_category_fk'].'").removeClass("disabled");</script>';
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
	$(".menu-rewards").addClass("active");
</script>

</html>