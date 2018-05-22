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

	date_default_timezone_set('Asia/Manila');
	$date = date('Y-m-d');

	require_once('../dao/dao.hotline.php');
	$hotline_ID=$_GET['id'];
	$hotline_details=hotline_dao::hotline_details($hotline_ID);

?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>AllRewards cPanel | Update Hotline No.</title> 

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
				
					<form id="rewardForm" enctype="multipart/form-data" class="formular" name="example1" method="post" action="../controller/controller.hotline.php?action=update_hotline">

						<div class="span-content-header">
							<h1>Update Hotline</h1>
						</div><!-- ../endof .span-content-header -->

						<div class="span-content-container form-add">

							<input type="hidden" name="hotline_ID" id="hotline_ID" value="<?= $hotline_ID ?>">

							<table>
								<tr>
									<td>
										<h2><span class="highlight">IMPORTANT:</span> Fields with an asterisk (*) mean that they are required.</h2>
									</td>
								</tr>

								<!-- HOTLINE NAME -->
								<tr>
									<td>
										<label for="hotline_title">Hotline Name <span class="highlight">*</span></label>
										<input name="hotline_title" id="hotline_title" value="<?= $hotline_details['hotline_title'] ?>" type="text" tabindex="2"
											data-sanitize="trim"
											data-validation="required"/>
									</td>
								</tr>

								<!-- NUMBER -->
								<tr>
									<td>
										<label for="hotline_number">Hotline # <span class="highlight">*</span></label>
										<input name="hotline_number" id="hotline_number" value="<?= $hotline_details['hotline_number'] ?>" type="text" tabindex="2" data-sanitize="trim" data-validation="required"/>
									</td>
								</tr>

							
							</table><!-- ../endof table -->
							
						</div><!-- ../endof .span-content-container -->

						<div class="span-content-footer">
							<button class="cms-btn btn" tabindex="8">Update</button>
							<a href="manage-hotline.php" class="cms-btn cancel-btn btn">Cancel</a>
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
	$("#menu-hotline").addClass('active');

	$("#rewardForm").validate({
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