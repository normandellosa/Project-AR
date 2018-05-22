<?php 
	session_start();

	require_once('../dao/accessDao.php');

	if (isset($_SESSION['account_id']) && $_SESSION['account_id'] != '') {	
		$access = accessDao::accessPage($_SESSION['account_id'], 9);
	
		if(!$access && $_SESSION['account_type'] != 'Administrator') {
			echo '<script> window.history.back(); </script>';
		}
	} else {
		echo '<script> window.history.back(); </script>';
	}

	date_default_timezone_set('Asia/Manila');
	$date = date('Y-m-d');

	//list of category
	require_once('../dao/dao.categories.php');
	$categories = categories_dao::categories_list(); 
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>AllRewards cPanel | Add New Article</title> 

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
				
					<form id="promoForm" enctype="multipart/form-data" class="formular" name="example1" method="post" action="../controller/controller.newsevents.php?action=add_newsevents">

						<div class="span-content-header">
							<h1>Add New Article</h1>
						</div><!-- ../endof .span-content-header -->

						<input name="rno_date" id="	rno_date" value="<?= $date ?>" type="hidden">

						<div class="span-content-container form-add">

							<table>
								<tr>
									<td>
										<h2><span class="highlight">IMPORTANT:</span> Fields with an asterisk (*) mean that they are required.</h2>
									</td>
								</tr>

								<!-- CATEGORY -->
								<tr>
									<td>
										<label for="rno_category_fk">Partner <span class="highlight">*</span></label>
										<select id="rno_category_fk" name="rno_category_fk" tabindex="1" required>
											<option selected disabled>Choose one</option>
											<?php foreach($categories as $category) { ?>
											<option value="<?= $category['category_id'] ?>"><?= $category['category_name'] ?></option>
											<?php } ?>
										</select>
									</td>
								</tr>

								<!-- TITLE -->
								<tr>
									<td>
										<label for="rno_title">Article Title <span class="highlight">*</span></label>
										<input name="rno_title" id="rno_title" type="text" tabindex="2"
											data-sanitize="trim"
											data-validation="length"
											data-validation-length="min5"/>
									</td>
								</tr>

								<!-- PROMO PERIOD -->
								<tr class="no-divider">
									<td>
										<label>Period Coverage</label>
									</td>
								</tr>
								<tr class="no-divider">
									<!-- START DATE -->
									<td class="date-input">
										<label for="rno_date_start">Start Date</label>
										<input name="rno_date_start" id="rno_date_start" type="text" class="datepicker" placeholder="YYYY-MM-DD" tabindex="3"
											data-validation="date"
											data-validation-optional="true" />
									</td>

									<!-- END DATE -->
									<td class="date-input">
										<label for="rno_date_end">End Date</label>
										<input name="rno_date_end" id="rno_date_end" type="text" class="datepicker" placeholder="YYYY-MM-DD" tabindex="4"
											data-validation="date"
											data-validation-optional="true" />
									</td>
								</tr>
								<tr>
									<td>
										<div class="remark">
										When <b>START DATE</b> is blank, the <b>"Up to"</b> text will be shown at the beginning of the <b>Period Coverage</b> in the website.<br/>
										When only <b>END DATE</b> or both <b>START and END DATES</b> are blank, the News/Event will have no expiration or will be indefinite. The <b>Period Coverage</b> will not appear in the website.
										</div>
									</td>
								</tr>

								<!-- DESCRIPTION -->
								<tr class="no-divider">
									<td>
										<label>Description <span class="highlight">*</span></label>
										<div class="remark">About the latest News and/or Event. This will appear in the <b>Preview Thumbnail</b> in the website.</div>
									</td>
								</tr>
								<tr>
									<td>
										<textarea name="rno_subtitle" id="rno_subtitle" col="26" row="3" class="text-input" tabindex="5"></textarea>
									</td>
								</tr>

								<!-- IMAGE UPLOAD FIELD -->
								<tr>
									<td>
										<label for="rno_image">Featured Image <span class="highlight">*</span></label>
										<div class="remark"><b>Dimensions:</b> Width and Height must be 300 pixels(300x300)<br/><b>File Type:</b> JPG / JPEG only</div>
										<input type="file" name="rno_image" id="rno_image" size="40" tabindex="6"
											data-validation="mime"
											data-validation-allowing="jpg, JPG, jpeg, JPEG"
											data-validation-error-msg-mime="Incorrect File Type"
											/>
									</td>
								</tr>

								<!-- YOUTUBE / VIDEO -->
								<tr>
									<td>
										<label>YouTube Video URL</label>
										<input type="text" name="rno_url" id="rno_url" tabindex="7" placeholder="https://www.youtube.com/watch?v=" 
											data-sanitize="trim"
											data-validation="url"
											data-validation-error-msg="Input must be a valid YouTube link."
											data-validation-optional="true"/>
									</td>
								</tr>

								<!-- GALLERY -->
								<tr>
									<td>
										<label>Gallery</label>
										<div class="remark">To add images to the article, you must first save the article.</div>
									</td>
								</tr>

								<!-- DOCUMENTS -->
								<tr>
									<td>
										<label>Document/s</label>
										<div class="remark">To add documents to the article, you must first save the article.</div>
									</td>
								</tr>
							</table><!-- ../endof table -->
							
						</div><!-- ../endof .span-content-container -->

						<div class="span-content-footer">
							<button class="cms-btn btn" tabindex="8">Add</button>
							<a href="manage-newsevents.php" class="cms-btn cancel-btn btn">Cancel</a>
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
	$("#menu-news").addClass('active');

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
		form : '#promoForm',
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
});
</script>

</body>
</html>