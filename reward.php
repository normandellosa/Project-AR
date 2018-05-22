<?php 
require_once('dao/rewardsNewsDao.php');
require_once('dao/categoriesDao.php');

$id = $_GET['id'];
$rno = RewardsNewsDao::rno_View($id);

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" /> 
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<link rel="icon" type="image/png" href="images/favicon.png">

	<title>AllRewards | <?= $rno['rno_title'] ?> at <?= $rno['category_name'] ?></title> 

	<!-- FONT AWESOME -->
	<link rel="stylesheet" type="text/css" href="lib/font-awesome/font-awesome.min.css">

	<!-- CUSTOM STYLES AND SCRIPTS -->
	<link rel="stylesheet" type="text/css" href="css/style.css?v=2">

	<link rel="stylesheet" type="text/css" href="lib/jssocials/jssocials.css">
	<link rel="stylesheet" type="text/css" href="lib/jssocials/jssocials-theme-minima.css">
</head>
<body>
	<div class="container">
		<?php include("inc/sticky-header.php"); ?>

		<!-- CONTENT -->
		<div id="main-container">

			<div class="max-width">

				<div class="breadcrumbs desktop-only">
					<a href="index.php">Home</a> <i class="fa fa-angle-right"></i> <a href="rewards.php">Rewards</a> <i class="fa fa-angle-right"></i> <?= $rno['category_name'] ?>
				</div>

				<div class="breadcrumbs mobile-only">
					<a href="rewards.php">Back to Rewards</a>
				</div>

				<!-- PREVIEW WIDGET -->
				<div id="preview-widget" class="widget-section">
					<img src="uploads/<?= $rno['rno_image'] ?>" class="preview-image bordered" alt="<?= $rno['rno_title'] ?> at <?= $rno['category_name'] ?>"/>
					<img src="images/logo-<?= $rno['category_code']?>.png" class="category-logo" alt="<?= $rno['category_name'] ?>" title="<?= $rno['category_name'] ?>"/>
				</div><!-- ../endof #preview-widget.widget-section -->

				<div id="inside-content" class="content">

					<h2 class="rno-title"><?= $rno['rno_title'] ?></h2>

					<!-- PROMO PERIOD -->
					
					<?php if (empty($rno['rno_date_end'])) { ?>

					<?php } else if (empty($rno['rno_date_start']) && !empty($rno['rno_date_end'])) {
						$endDateFull = date("M j, Y",strtotime($rno['rno_date_end'])); ?>

						<!-- only START DATE is BLANK -->
						<p class="rno-period"><b>Promo Period:</b> Up to <?= $endDateFull ?></p>

					<?php } else {

						/*START and END DATES are not BLANK*/
						$startYear = date("Y",strtotime($rno['rno_date_start']));
						$endYear = date("Y",strtotime($rno['rno_date_end']));

						$startDateFull = date("M j, Y",strtotime($rno['rno_date_start']));
						$startDate = date("M j",strtotime($rno['rno_date_start']));
						$endDateFull = date("M j, Y",strtotime($rno['rno_date_end']));

						if ($startYear <> $endYear) { ?>
							<p class="rno-period"><b>Promo Period:</b> <?= $startDateFull.' - '.$endDateFull ?></p>
						<?php } else { ?>
							<p class="rno-period"><b>Promo Period:</b> <?= $startDate.' - '.$endDateFull ?></p>
						<?php }
					} ?>

					<div id="share"></div>
					
					<?php if (!empty($rno['rno_subtitle'])) {
						echo $rno['rno_subtitle'];
					}

					if (!empty($rno['rno_details'])) {
						echo $rno['rno_details'];
					} ?>
					
				</div><!-- ../endof .content -->


				
			</div><!-- ../endof .max-width -->
			
		</div><!-- ../endof #main-container -->

		<!-- FOOTER -->
		<?php include("inc/footer.php"); ?>
		
	</div>
</body>

<script type="text/javascript" src="lib/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="lib/jssocials/jssocials.min.js"></script>
<script type="text/javascript" src="js/user-global.js"></script>
<script type="text/javascript" src="js/user-sharing.js"></script>
<script>
    $(".menu-rewards").addClass("active");
</script>

</html>