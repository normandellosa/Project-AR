<?php 
	session_start();

	require_once('../dao/accessDao.php');

	if (isset($_SESSION['account_id']) && $_SESSION['account_id'] != '') {	
		$access = accessDao::accessPage($_SESSION['account_id'], 6);
	
		if(!$access && $_SESSION['account_type'] != 'Administrator') {
			echo '<script> window.history.back(); </script>';
		}
	} else {
		echo '<script> window.history.back(); </script>';
	}

	//list of category
	require_once('../dao/dao.categories.php');
	$categories = categories_dao::categories_list(); 

	// rewards detail
	require_once('../dao/dao.rewards.php');
	$id = $_GET['id'];
	$rno = rewards_dao::rewards_view($id); 

?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>AllRewards cPanel | Update Reward Details</title> 

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
						
					<form id="rewardForm" enctype="multipart/form-data" class="formular" name="example1" method="post" action="../controller/controller.rewards.php?action=update_rewards">

						<div class="span-content-header">
							<h1>Update Reward Details</h1>
						</div><!-- ../endof .span-content-header -->

						<input type="hidden" name="rno_id" value="<?= $rno['rno_id'] ?>">

						<div class="span-content-container form-add">

							<table>
								<tr>
									<td>
										<h2><span class="highlight">IMPORTANT:</span> Fields with an asterisk (*) mean that they are required.</h2>
									</td>
								</tr>
								
								<!-- STATUS -->
								<tr>
									<td>
										<label for="rno_status">Status <span class="highlight">*</span></label>
										<select id="rno_status" name="rno_status" tabindex="1">
											<option value="active" <?php if($rno['rno_status'] == 'active'){ echo 'selected'; } ?> >Active</option>
											<option value="disabled" <?php if($rno['rno_status'] == 'disabled'){ echo 'selected'; } ?> >Disabled</option>
										</select>
										<div class="remark">When a Reward is <b>disabled</b>, it will not appear in the website.</div>
									</td>
								</tr>

								<!-- CATEGORY -->
								<tr>
									<td>
										<label for="rno_category_fk">Partner <span class="highlight">*</span></label>
										<select id="rno_category_fk" name="rno_category_fk" tabindex="2" required>
											<option disabled>Choose one</option>
											<?php foreach($categories as $category) { ?>
											<option value="<?= $category['category_id'] ?>" <?php if($rno['rno_category_fk'] == $category['category_id']) { echo 'selected'; } ?>  ><?= $category['category_name'] ?></option>
											<?php } ?>
										</select>
									</td>
								</tr>

								<!-- HEADER -->
								<tr>
									<td>
										<label for="rno_title">Reward Title <span class="highlight">*</span></label>
										<div class="remark"><b>Sample Reward Titles</b>: <span class="highlight">Get 10% Off or Save P1,000 or Get One (1) Free, etc.</span><br/>This will also appear as the <b>Image Title</b>, <b>Caption</b> and/or <b>Alt Tag</b>.</div>
										<input name="rno_title" id="rno_title" value="<?= $rno['rno_title'] ?>" type="text" placeholder="Get % Off / Save Pesos" tabindex="3"
											data-sanitize="trim"
											data-validation="length"
											data-validation-length="min5"/>
									</td>
								</tr>

								<!-- DESCRIPTION -->
								<tr class="no-divider">
									<td>
										<label>Short Description <span class="highlight">*</span></label>
										<div class="remark">About the member-exclusive reward. This will appear in the <b>Reward Thumbnail</b> in the website.</div>
									</td>
								</tr>
								<tr>
									<td>
										<textarea name="rno_subtitle" id="rno_subtitle" col="26" row="3" class="text-input" tabindex="4" data-sanitize="trim" data-validation="required"><?= $rno['rno_subtitle'] ?></textarea>
									</td>
								</tr>

								<!-- PROMO PERIOD -->
								<tr class="no-divider">
									<td>
										<label>Promo Period</label>
									</td>
								</tr>
								<tr class="no-divider">
									<!-- START DATE -->
									<td class="date-input">
										<label for="rno_date_start">Start Date</label>
										<input name="rno_date_start" id="rno_date_start" type="text" value="<?= $rno['rno_date_start'] ?>" class="datepicker" placeholder="YYYY-MM-DD" tabindex="5"
											data-validation="date"
											data-validation-optional="true" />
									</td>

									<!-- END DATE -->
									<td class="date-input">
										<label for="rno_date_end">End Date</label>
										<input name="rno_date_end" id="rno_date_end" type="text" value="<?= $rno['rno_date_end'] ?>" class="datepicker text-input" placeholder="YYYY-MM-DD" tabindex="6"
											data-validation="date"
											data-validation-optional="true" />
									</td>
								</tr>
								<tr>
									<td>
										<div class="remark">
										When <b>START DATE</b> is blank, the <b>"Up to"</b> text will be shown at the beginning of the <b>Promo Period</b> in the website.<br/>
										When only <b>END DATE</b> or both <b>START and END DATES</b> are blank, the Promo will have no expiration or will be indefinite. The <b>Promo Period</b> will not appear in the website.
										</div>
									</td>
								</tr>

								<!-- OTHER DETAILS -->
								<tr class="no-divider">
									<td>
										<label>Other Information</label>
										<div class="remark">Other information, such as a <b>detailed description</b>, <b>applicable Branches</b>, <b>DTI Permit Nos.</b>, etc. that can be viewed when the <b>Reward Thumbnail</b> is clicked in the website.</div>
									</td>
								</tr>
								<tr>
									<td>
										<textarea name="rno_details" id="rno_details" col="26" row="3" class="text-input" tabindex="7"><?= $rno['rno_details'] ?></textarea>
									</td>
								</tr>

								<!-- IMAGE UPLOAD FIELD -->
								<tr>
									<td>
										<input type="hidden" name="rewards_image1" value="<?= $rno['rno_image'] ?>">

										<label>Featured Image</label>
										<div class="preview-image rno-image">
											<img src="../../uploads/<?= $rno['rno_image'] ?>">	
										</div>
									</td>
								</tr>
								<tr>
									<td>
										<label for="rewards_image2">Replace Image?</label>
										<div class="remark"><b>Dimensions:</b> Width must be 300 pixels<br/><b>File Type:</b> JPG / JPEG only</div>
										<input type="file" name="rewards_image2" size="40" tabindex="9"
											data-validation="mime"
											data-validation-allowing="jpg, JPG, jpeg, JPEG"
											data-validation-error-msg-mime="Incorrect File Type"
											/>
											
										<!-- YOUTUBE / VIDEO -->
										<input type="hidden" name="rno_url" id="rno_url" value=""/>
									</td>
								</tr>
							</table><!-- ../endof table -->
							
						</div><!-- ../endof .span-content-container -->

						<div class="span-content-footer">
							<button class="cms-btn btn" tabindex="10">Update</button>
							<a href="manage-rewards.php" class="cms-btn cancel-btn btn">Cancel</a>
						</div><!-- ../endof .span-content-footer -->
					
					</form>	

				</div><!-- ../endof .section.group -->
				
			</div><!-- ../endof #content-container -->
			
		</section><!-- ../endof #main-body-section -->

	</div><!-- ../endof #body-box -->

</div><!-- ../endof #main-container -->

<script src="../lib/jquery-3.1.1.min.js" type="text/javascript"></script>
<script src="../lib/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>

<!-- CKEDITOR -->
<script src="../ckeditor/ckeditor.js" type="text/javascript"></script>

<!-- FORM VALIDATOR -->
<script src="../scripts/custom-file-input.js" type="text/javascript"></script>
<script src="../lib/form-validator/jquery.form-validator.min.js" type="text/javascript"></script>

<!-- CUSTOM SCRIPTS -->
<script type="text/javascript">
$(document).ready(function(){
	$("#menu-updates").addClass('active');

	$(".datepicker").datepicker({
		dateFormat: "yy-mm-dd"
	});

	$("#rno_date_end").change(function(){
		if ($("#rno_date_start").val() != '') {
			if ($("#rno_date_start").val() >= $("#rno_date_end").val()) {
				$("#rno_date_end").val('')
			}
		}
	});

	$("#rno_date_start").change(function(){
		if ($("#rno_date_end").val() != '') {
			if ($("#rno_date_end").val() <= $("#rno_date_start").val()) {
				$("#rno_date_start").val('')
			}
		}
	});

	$.validate({
		form : '#rewardForm',
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

	/*CKEDITOR*/
	CKEDITOR.replace( 'rno_subtitle',
	{
		toolbar :
		[
			
			{ name: 'basicstyles', items : [ 'Bold','Italic' ] },
			{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
			{ name: 'styles', items : [ 'Format' ] },
			{ name: 'links', items : [ 'Link','Unlink','Anchor', 'NumberedList', 'BulletedList' ] },
			{ name: 'tools', items : [ 'Maximize'] }
		]
	});

	CKEDITOR.replace( 'rno_details',
	{
		toolbar :
		[
			
			{ name: 'basicstyles', items : [ 'Bold','Italic' ] },
			{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
			{ name: 'styles', items : [ 'Format' ] },
			{ name: 'links', items : [ 'Link','Unlink','Anchor', 'NumberedList', 'BulletedList' ] },
			{ name: 'tools', items : [ 'Maximize'] }
		]
	});
});
</script>

</body>
</html>