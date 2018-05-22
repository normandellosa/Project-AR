<?php 
	session_start();

	require_once('../dao/accessDao.php');

	if (isset($_SESSION['account_id']) && $_SESSION['account_id'] != '') {	
		$access = accessDao::accessPage($_SESSION['account_id'], 18);
	
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

	// partner detail
	require_once('../dao/dao.partners.php');
	$partners_ID=$_GET['id'];
	$partners_details = partners_dao::partners_details($partners_ID);

?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>AllRewards cPanel | Update Partner Details</title> 

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
				
					<form id="rewardForm" enctype="multipart/form-data" class="formular" name="example1" method="post" action="../controller/controller.partners.php?action=update_partners">

						<div class="span-content-header">
							<h1>Update Partner</h1>
						</div><!-- ../endof .span-content-header -->

						<div class="span-content-container form-add">
							<input type="hidden" name="partners_ID" id="partners_ID" value="<?= $partners_details['partners_ID'] ?>">
							

							<table>
								<tr>
									<td>
										<h2><span class="highlight">IMPORTANT:</span> Fields with an asterisk (*) mean that they are required.</h2>
									</td>
								</tr>

								<!-- STATUS -->
								<tr style="display: none;">
									<td>
										<label for="partners_status">Category <span class="highlight">*</span></label>
										<select id="partners_status" name="partners_status" tabindex="1" data-validation="required">
											<option selected disabled>Choose one</option>
											<option value="Active" <?php if($partners_details['partners_status'] == 'Active') { echo 'selected'; } ?>>Active</option>
											<option value="Disabled" <?php if($partners_details['partners_status'] == 'Disabled') { echo 'selected'; } ?>>Disabled</option>
										</select>
									</td>
								</tr>

								<!-- CATEGORY -->
								<tr>
									<td>
										<label for="rno_category_fk">Category <span class="highlight">*</span></label>
										<select id="rno_category_fk" name="rno_category_fk" tabindex="1" required>
											<option selected disabled>Choose one</option>
											<?php foreach($categories as $category) { ?>
											<option value="<?= $category['category_id'] ?>" <?php if($partners_details['rno_category_fk'] == $category['category_id']) { echo 'selected'; } ?>><?= $category['category_name'] ?></option>
											<?php } ?>
										</select>
									</td>
								</tr>

								<!-- BRANCH NAME -->
								<tr>
									<td>
										<label for="partners_name">Branch Name <span class="highlight">*</span></label>
										<input name="partners_name" id="partners_name" value="<?= $partners_details['partners_name'] ?>" type="text" tabindex="2"
											data-sanitize="trim"
											data-validation="length"
											data-validation-length="min5"/>
									</td>
								</tr>

								<!-- ADDRESS -->
								<tr>
									<td>
										<label for="partners_address">Address <span class="highlight">*</span></label>
										<input name="partners_address" id="partners_address" value="<?= $partners_details['partners_address'] ?>" type="text" tabindex="3"
											data-sanitize="trim"
											data-validation="length"
											data-validation-length="min10"/>
									</td>
								</tr>

								<!-- WITHIN / OUTSIDE METRO MANILA -->
								<tr>
									<td>
										<label for="partners_cityprovince">City / Province <span class="highlight">*</span></label>
										<div class="remark">Enter the <b>City</b>, if within Metro Manila or <b>Province</b>, if outside Metro Manila.</div>

										<div>
											<label for="partners_location1" style="padding:0 5px;" class="fleft">Within Metro Manila <input type="radio" name="partners_location" id="partners_location1" value="0" tabindex="4" <?php if($partners_details['partners_location'] == 0) { echo 'checked'; } ?>></label>
											<label for="partners_location2" style="padding:0 5px;" class="fleft">Outside Metro Manila <input type="radio" name="partners_location" id="partners_location2" value="1" <?php if($partners_details['partners_location'] == 1) { echo 'checked'; } ?>></label>
										</div>	
										<?php if($partners_details['partners_location'] == 0) { ?>
											<input name="partners_cityprovince" id="partners_cityprovince"  value="<?= $partners_details['partners_cityprovince'] ?>" type="text" tabindex="5"
												data-sanitize="trim"
												data-validation="length"
												data-validation-length="min5"/>
										<?php } ?>
										<?php if($partners_details['partners_location'] == 1) { ?>
											<input name="partners_cityprovince" id="partners_cityprovince"  value="<?= $partners_details['partners_cityprovince'] ?>" type="hidden" tabindex="5"
												data-sanitize="trim"
												data-validation="length"
												data-validation-length="min5"/>
										<?php } ?>
									</td>
								</tr>

								<!-- EMAIL -->
								<tr>
									<td>
										<label for="partners_email">Email Address</label>
										<input name="partners_email" id="partners_email" value="<?= $partners_details['partners_email'] ?>" type="text" tabindex="6" 
											data-sanitize="trim"
											data-validation="email"
											data-validation-optional="true"/>
									</td>
								</tr>

								<!-- CONTACT NO/S -->
								<tr>
									<td>
										<label for="partners_tel">Contact No/s</label>
										<input name="partners_tel" id="partners_tel" value="<?= $partners_details['partners_tel'] ?>" type="text" tabindex="7"
											data-sanitize="trim"
											data-validation-optional="true"/>
									</td>
								</tr>
							</table><!-- ../endof table -->
							
						</div><!-- ../endof .span-content-container -->

						<div class="span-content-footer">
							<button class="cms-btn btn" tabindex="8">Update</button>
							<a href="manage-partners.php" class="cms-btn cancel-btn btn">Cancel</a>
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
	$("#menu-partners").addClass('active');

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

	$('input[type=radio][name=partners_location]').change(function() {
        if (this.value == 1) {
        	$('#partners_cityprovince').attr('type', 'hidden');
        }else{
        	$('#partners_cityprovince').attr('type', 'text');
        }
    });
});
</script>

</body>
</html>