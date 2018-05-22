<?php 
	session_start();

	require_once('../dao/accessDao.php');

	if (isset($_SESSION['account_id']) && $_SESSION['account_id'] != '') {	
		$access = accessDao::accessPage($_SESSION['account_id'], 1);
	
		if(!$access && $_SESSION['account_type'] != 'Administrator') {
			echo '<script> window.history.back(); </script>';
		}
	} else {
		echo '<script> window.history.back(); </script>';
	}

?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>AllRewards cPanel | Add New Featured Ad</title> 

	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" /> 
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<link rel="icon" type="image/png" href="../favicon.png">

	<link href="../lib/jquery-ui/jquery-ui.structure.min.css" rel="stylesheet" type="text/css"/>
	<link href="../lib/jquery-ui/jquery-ui.theme.min.css" rel="stylesheet" type="text/css"/>

	<link href="../styles/normalize.css" rel="stylesheet" type="text/css"/>
	<link href="../styles/component.css" rel="stylesheet" type="text/css" />

	<!-- FONTAWESOME -->
	<link href="../lib/fontawesome/font-awesome.min.css" rel="stylesheet" type="text/css"/>

	<!-- RESPONSIVE GRID -->
	<link href="../lib/responsiveGrid/responsivegrid.css" rel="stylesheet">

	<!-- FORM VALIDATOR -->
	<link href="../lib/form-validator/theme-default.min.css" rel="stylesheet" type="text/css" />

	<!-- MAIN STYLESHEETS and JS -->
	<link href="../styles/main.css" rel="stylesheet" type="text/css" />
</head>
<body>

<div id="main-container">

	<div id="body-box">

		<section id="side-menu-section">
			<?php include('../inc/menu-sidemenu.php') ?>
		</section><!-- ../endof #side-menu-section -->

		<section id="main-body-section">

			<div id="content-container">

				<div class="section group col span_2_of_2">
						
					<form id="carouselForm" enctype="multipart/form-data" class="formular" name="example1" method="post" action="../controller/controller.carousel.php?action=add_carousel">

						<div class="span-content-header">
							<h1>Add Carousel Image</h1>
						</div><!-- ../endof .span-content-header -->

						<div class="span-content-container form-add">

							<table>
								<tr>
									<td>
										<h2><span class="highlight">IMPORTANT:</span> Fields with an asterisk (*) mean that they are required.</h2>
									</td>
								</tr>
								<!-- IMAGE CAPTION -->
								<tr>
									<td>
										<label for="carousel_alt">Image Caption <span class="highlight">*</span></label>
										<div class="remark">This will also appear as the <b>Image Title</b>, <b>Caption</b> and/or <b>Alt Tag</b>.</div>
										<input name="carousel_alt" id="carousel_alt" type="text" placeholder="Image Caption" tabindex="1"
											data-sanitize="trim"
											data-validation="length"
											data-validation-length="min5"/>
									</td>
								</tr>

								<!-- RELATED URL -->
								<tr>
									<td>
										<label for="carousel_url">Related URL</label>
										<div class="remark"><b>Absolute URL</b> or <b>Relative URL</b> you wish to redirect the user to if the Featured Ad is clicked.</div>
										<input name="carousel_url" id="carousel_url" type="text" placeholder="http://www.related.url/" tabindex="2"
											data-sanitize="trim"
											data-validation="url"
											data-validation-optional="true"
											/>

										<label>Open in:</label>
										<div>
											<label for="carousel_target1" style="padding:0 5px;" class="fleft">New Window <input type="radio" name="carousel_target" id="carousel_target1" value="_blank" checked></label>
											<label for="carousel_target2" style="padding:0 5px;" class="fleft">Same Window <input type="radio" name="carousel_target" id="carousel_target2" value="_self"></label>
										</div>	
									</td>
								</tr>

								<!-- IMAGE UPLOAD FIELD -->
								<tr>
									<td>
										<label for="carousel_image">Ad Image <span class="highlight">*</span></label>
										<div class="remark"><b>Dimensions:</b> 540 x 700 pixels (width x height)<br/><b>File Type:</b> JPG / JPEG only</div>
										<input type="file" name="carousel_image" id="carousel_image" size="40" tabindex="3"
											data-validation="dimension mime"
											data-validation-allowing="jpg, JPG, jpeg, JPEG"
											data-validation-dimension="540x700-540x700"
											data-validation-error-msg-mime="Incorrect File Type"
											data-validation-error-msg-dimension="Incorrect Image Dimensions"
											/>
									</td>
								</tr>
							</table><!-- ../endof table -->
							
						</div><!-- ../endof .span-content-container -->

						<div class="span-content-footer">
							<button class="cms-btn btn" tabindex="4">Add</button>
							<a href="manage-carousel.php" class="cms-btn cancel-btn btn">Cancel</a>
						</div><!-- ../endof .span-content-footer -->
					
					</form>	

				</div><!-- ../endof .section.group -->
				
			</div><!-- ../endof #content-container -->
			
		</section><!-- ../endof #main-body-section -->

	</div><!-- ../endof #body-box -->

</div><!-- ../endof #main-container -->

<script src="../lib/jquery-3.1.1.min.js" type="text/javascript"></script>
<script src="../lib/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>

<!-- FORM VALIDATOR -->
<script src="../scripts/custom-file-input.js" type="text/javascript"></script>
<script src="../lib/form-validator/jquery.form-validator.min.js" type="text/javascript"></script>

<!-- CUSTOM SCRIPTS -->
<script type="text/javascript">
$(document).ready(function(){
	$("#menu-carousel").addClass('active');

	$.validate({
		modules   : 'file, sanitize'
	});

	$("#menu-logout").click(function(){
		var name = $("#dname").val();
		if ( confirm("You are currently logged-in as " + name + ". Are you sure you want to sign out?") == true) {
			location.href='../logout.php';
		} else {
			return;
		}
	});
});
</script>

</body>

</html>