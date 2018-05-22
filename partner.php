<?php 
require_once('dao/dao.partners.php');

$id = $_GET['id'];
$partner = partners_dao::partners_details($id);

require_once('dao/categoriesDao.php');

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" /> 
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<link rel="icon" type="image/png" href="images/favicon.png">

	<title>AllRewards | <?= $partner['partners_name']; ?></title> 

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
					<a href="index.php">Home</a> <i class="fa fa-angle-right"></i> <a href="partners.php">Partners</a> <i class="fa fa-angle-right"></i> <?= $partner['partners_name']; ?>
				</div>

				<div class="breadcrumbs mobile-only">
					<a href="partners.php">Back to Partners</a>
				</div>

				<!-- PREVIEW WIDGET -->
				<div id="preview-widget" class="widget-section">
					<img src="images/logo-<?= $partner['category_code']?>.png" class="preview-image" alt="<?= $partner['partners_name']; ?>"/>
				</div><!-- ../endof #preview-widget.widget-section -->

				<div id="inside-content" class="content">

					<h2 class="rno-title"><?= $partner['partners_name']; ?></h2>

					<p><b>Address: </b><?= $partner['partners_address']; ?></p>
					<?php if (!empty($partner['partners_email'])) { ?>
					<p><b>Email: </b><?= $partner['partners_email']; ?></p>
					<?php } ?>
					<?php if (!empty($partner['partners_tel'])) { ?>
					<p><b>Tel./Mobile No.: </b><?= $partner['partners_tel']; ?></p>
					<?php } ?>
					
				</div><!-- ../endof .content -->


				
			</div><!-- ../endof .max-width -->
			
		</div><!-- ../endof #main-container -->

		<!-- FOOTER -->
		<?php include("inc/footer.php"); ?>
		
	</div>
</body>

<script type="text/javascript" src="lib/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="js/user-global.js"></script>
<script>
    $(".menu-partners").addClass("active");
</script>

</html>