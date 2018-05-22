<?php
	//$_POST['search'];
	$keyword=$_GET['search'];
	require_once('dao/rewardsNewsDao.php');
	require_once('dao/categoriesDao.php');

	require_once("inc/truncate.php");


	$string = trim(addslashes($keyword));
	$string_text = preg_replace('/\s+/', ' ', $string);

	$search_string_text = explode(' ', $string_text);

	$title = implode("%' OR rno_title LIKE '%", $search_string_text);
	$subtitle = implode("%' OR rno_subtitle = '%", $search_string_text);
	$details = implode("%' OR rno_details = '%", $search_string_text);


	$search_result=rewardsNewsDao::rno_Search($title,$subtitle,$details);
	$categories = AllRewardsCategoryDao::categoryList();



?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" /> 
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<link rel="icon" type="image/png" href="images/favicon.png">

	<title>AllRewards | Search Results for "<?= $keyword ?>"</title> 

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

				<?php if(strlen($keyword) > 2) {
					if($search_result == true) { ?>
						<h2 class="search-header">Search Results for "<span class="red"><?= $keyword ?></span>":</h2>

						<!-- SIDE WIDGET -->
						<div id="side-widget" class="widget-section">

							<!-- FILTER WIDGET -->
							<div id="filter-widget" class="widget">

								<div class="ws-header">
									<h2>Partner</h2>
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
							<?php foreach($search_result as $rno) {
								if ($rno['rno_type'] == 'Rewards') { ?>
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
								<?php } else { ?>
									<a class="promo-item grid-item <?= "category-".$rno['rno_category_fk'] ?>" href="promo.php?id=<?= $rno['rno_id'] ?>">
										<img class="gi-preview" src="uploads/<?= $rno['rno_image'] ?>"/>
										<div class="gi-details">
											<div class="gi-desc">
												<h3><?= $rno['rno_title']?></h3>
												<!-- <?php echo truncate($rno['rno_subtitle']); ?> -->

												<?php if (empty($rno['rno_date_end'])) { ?>
													<p>Promo Period: Indefinite</p>

												<?php } else if (empty($rno['rno_date_start']) && !empty($rno['rno_date_end'])) {
													$endDateFull = date("M j, Y",strtotime($rno['rno_date_end'])); ?>

													<!-- only START DATE is BLANK -->
													<p>Up to <?= $endDateFull ?></p>

												<?php } else {

													/*START and END DATES are not BLANK*/
													$startYear = date("Y",strtotime($rno['rno_date_start']));
													$endYear = date("Y",strtotime($rno['rno_date_end']));

													$startDateFull = date("M j, Y",strtotime($rno['rno_date_start']));
													$startDate = date("M j",strtotime($rno['rno_date_start']));
													$endDateFull = date("M j, Y",strtotime($rno['rno_date_end']));

													if ($startYear <> $endYear) { ?>
														<p><?= $startDateFull.' - '.$endDateFull ?></p>
													<?php } else { ?>
														<p><?= $startDate.' - '.$endDateFull ?></p>
													<?php }
												} ?>
												<div class="gi-logo"><img src="images/logo-<?= $rno['category_code']?>.png"></div>
											</div>
										</div>
									</a><!-- ../endof .grid-item -->
								<?php } ?>
							<?php
							echo '<script>$(".category-'.$rno['rno_category_fk'].'").removeClass("disabled");</script>';
							} ?>
						
						</div><!-- ../endof #grid-content -->

					<?php } else { ?>
					<div class="content">
						<h2>Your search "<span class="red"><?= $keyword ?></span>" did not match any records.</h2>
						<p>Suggestions:</p>
						<ul>
							<li>Make sure all words are spelled correctly.</li>
							<li>Try different keywords.</li>
							<li>Try more general keywords.</li>
						</ul>
						<p>Or you can try your luck at:</p>
						<ul>
							<li><a href="membership.php">Membership</a></li>
							<li><a href="faqs.php">Frequently Asked Questions</a></li>
							<li><a href="terms-and-conditions.php">Terms and Conditions</a></li>
						</ul>
					</div>
					<?php } ?>

				<?php } else { ?>
				<div class="content">
					<h2>Search Results for "<span class="red"><?= $keyword ?></span>":</h2>
					<p>Please enter at least 3 characters!</p>
					<p>Or you can try your luck at:</p>
					<ul>
						<li><a href="membership.php">Membership</a></li>
						<li><a href="faqs.php">Frequently Asked Questions</a></li>
						<li><a href="terms-and-conditions.php">Terms and Conditions</a></li>
					</ul>
				</div>
				<?php } ?>
				
			</div><!-- ../endof .max-width -->
			
		</div><!-- ../endof #main-container -->

		<!-- FOOTER -->
		<?php include("inc/footer.php"); ?>

	</div>

</body>
</html>