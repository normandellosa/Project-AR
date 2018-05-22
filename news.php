<?php 
require_once('dao/rewardsNewsDao.php');
require_once('dao/categoriesDao.php');

$id = $_GET['id'];
$rno = RewardsNewsDao::rno_View($id);
$rno_Gallery = RewardsNewsDao::rno_Gallery($id);
$rno_Documents = RewardsNewsDao::rno_Documents($id);

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" /> 
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<link rel="icon" type="image/png" href="images/favicon.png">

	<title>AllRewards | <?= $rno['rno_title'] ?> at <?= $rno['category_name'] ?></title> 

	<!-- PHOTOSWIPE -->
	<link rel="stylesheet" href="lib/photoswipe/photoswipe.css"> 
	<link rel="stylesheet" href="lib/photoswipe/default-skin/default-skin.css"> 

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
					<a href="index.php">Home</a> <i class="fa fa-angle-right"></i> <a href="news-and-events.php">News &amp; Events</a> <i class="fa fa-angle-right"></i> <?= $rno['category_name'] ?>
				</div>

				<div class="breadcrumbs mobile-only">
					<a href="news-and-events.php">Back to All News &amp; Events</a>
				</div>

				<!-- PREVIEW WIDGET -->
				<div id="preview-widget" class="widget-section">
					<img src="uploads/<?= $rno['rno_image'] ?>" class="preview-image bordered" alt="<?= $rno['rno_title'] ?> at <?= $rno['category_name'] ?>"/>
					<img src="images/logo-<?= $rno['category_code']?>.png" class="category-logo" alt="<?= $rno['category_name'] ?>" title="<?= $rno['category_name'] ?>"/>

					<?php if (!empty($rno['rno_url'])) { ?>
					<a href="<?=$rno['rno_url'];?>" class="btn btn-youtube" target="_blank"><i class="fa fa-youtube"></i> Watch Promo Video</a>
					<?php } ?>

					<?php if ($rno_Gallery == true) { ?>
					<a href="javascript:void(0);" class="btn btn-gallery"><i class="fa fa-image"></i> View Related Image/s</a>
					<?php } ?>
				</div><!-- ../endof #preview-widget.widget-section -->

				<div id="inside-content" class="content">

					<h2><?= $rno['rno_title'] ?></h2>

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

					<?php if ($rno_Documents == true) { ?>
						<?php foreach ($rno_Documents as $doc) { ?>
						<a href="uploads/<?= $doc['doc_filename']; ?>" target="_blank" class="btn btn-documents"><i class="fa fa-download"></i> <?= $doc['doc_title']; ?></a>
						<?php } ?>
					<?php } ?>


				</div><!-- ../endof .content -->
				
			</div><!-- ../endof .max-width -->
			
		</div><!-- ../endof #main-container -->

		<!-- FOOTER -->
		<?php include("inc/footer.php"); ?>
		
	</div>

	<!-- Root element of PhotoSwipe. Must have class pswp. -->
	<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

	    <!-- Background of PhotoSwipe. 
	         It's a separate element as animating opacity is faster than rgba(). -->
	    <div class="pswp__bg"></div>

	    <!-- Slides wrapper with overflow:hidden. -->
	    <div class="pswp__scroll-wrap">

	        <!-- Container that holds slides. 
	            PhotoSwipe keeps only 3 of them in the DOM to save memory.
	            Don't modify these 3 pswp__item elements, data is added later on. -->
	        <div class="pswp__container">
	            <div class="pswp__item"></div>
	            <div class="pswp__item"></div>
	            <div class="pswp__item"></div>
	        </div>

	        <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
	        <div class="pswp__ui pswp__ui--hidden">

	            <div class="pswp__top-bar">

	                <!--  Controls are self-explanatory. Order can be changed. -->

	                <div class="pswp__counter"></div>

	                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

	                <button class="pswp__button pswp__button--share" title="Share"></button>

	                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

	                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

	                <!-- Preloader demo http://codepen.io/dimsemenov/pen/yyBWoR -->
	                <!-- element will get class pswp__preloader--active when preloader is running -->
	                <div class="pswp__preloader">
	                    <div class="pswp__preloader__icn">
	                      <div class="pswp__preloader__cut">
	                        <div class="pswp__preloader__donut"></div>
	                      </div>
	                    </div>
	                </div>
	            </div>

	            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
	                <div class="pswp__share-tooltip"></div> 
	            </div>

	            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
	            </button>

	            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
	            </button>

	            <div class="pswp__caption">
	                <div class="pswp__caption__center"></div>
	            </div>

	        </div>

	    </div>

	</div>

	<script type="text/javascript" src="lib/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="lib/jssocials/jssocials.min.js"></script> 
	<script src="lib/photoswipe/photoswipe.min.js"></script> 
	<script src="lib/photoswipe/photoswipe-ui-default.min.js"></script> 
	<script type="text/javascript" src="js/user-global.js"></script>
	<script type="text/javascript" src="js/user-sharing.js"></script>
	<script>
        $(".menu-promos").addClass("active");

        $(".btn-gallery").click(function(e){
        	e.preventDefault();
        	var pswpElement = document.querySelectorAll('.pswp')[0];

			// build items array
		    var items = [
			<?php if ($rno_Gallery == true) { ?>
				<?php $i = 0; $len = count($rno_Gallery); ?>
				<?php foreach ($rno_Gallery as $img) { ?>
					<?php list($width, $height) = getimagesize("uploads/".$img['image_filename']); ?>
					{
						src   : "uploads/<?= $img['image_filename']; ?>",
						w     : "<?= $width; ?>",
						h     : "<?= $height; ?>",
						title : "<?= $img['image_caption']; ?>"
					}
					<?php if ($i != $len - 1) { echo ","; } $i++; ?>
				<?php } ?>
			<?php } ?>
			];
		    
		    // define options (if needed)
		    var options = {      
		        history               : false,
		        showHideOpacity       : true,
		        bgOpacity             : .95,
		        zoomEl                : true,
		        hideAnimationDuration : 333,
		        showAnimationDuration : 333,
		        shareEl               : false
		    };
		    
		    var gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options);
		    gallery.init();
        });
    </script>
</body>
</html>