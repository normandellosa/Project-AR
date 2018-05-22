<?php
	session_start();

	require_once('../dao/accessDao.php');

	if (isset($_SESSION['account_id']) && $_SESSION['account_id'] != '') {
		$rnoAdd    = accessDao::accessPage($_SESSION['account_id'], 5);
		$rnoEdit   = accessDao::accessPage($_SESSION['account_id'], 6);
		$rnoDelete = accessDao::accessPage($_SESSION['account_id'], 8);		

	} else {
		echo '<script> window.history.back(); </script>';
	}

	require_once('../dao/dao.hotline.php');
	$hotline_list = hotline_dao::hotline_list(); 

 ?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>AllRewards cPanel | Manage Hotline</title> 

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

	<!-- DATATABLES -->
	<link rel="stylesheet" type="text/css" href="../lib/datatables/datatables.min.css"/>

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
						
					<div class="span-content-header">
						<h1>Manage Hotline</h1>
						<?php if($hotline_list == false) { ?>
							<a href="manage-hotline_add.php" class="cms-btn btn"><i class="btn-icon fa-plus"></i>Add New Hotline</a>
						<?php } ?>
					</div><!-- ../endof .span-content-header -->

					<div class="span-content-container">

						<table class="datatable-partners">
						
							<thead>
								<tr>
								  <th align="left">Hotline Title</th>
								  <th align="left">Contact #</th>
								  <th>Actions</th>
								</tr>
							</thead>

							<tbody>

							<?php if($hotline_list == true) {
								foreach($hotline_list as $hotline) { ?>	
								<tr>
									<!-- HOTLINE TITLE -->
									<td><?= $hotline['hotline_title'] ?></td>

									<!-- CONTACT # -->
									<td><?= $hotline['hotline_number'] ?></td>

									<!-- ACTION -->
									<td align="center">
										<a href="manage-hotline_edit.php?id=<?= $hotline['hotline_ID'] ?>" class="action-btn"><i class="fa fa-edit"></i> Edit</a> | 

										<a href="../controller/controller.hotline.php?action=delete_hotline&id=<?= $hotline['hotline_ID'] ?>" class="action-btn"><i class="fa fa-trash"></i> Delete</a>
									</td>
									
								</tr>
							<?php } 
							} ?>
							</tbody>
							
						</table><!-- ../endof .datatable-table -->
						
					</div><!-- ../endof .span-content-container -->

					<div class="span-content-footer">
						<?php if($hotline_list == false) { ?>
						<a href="manage-hotline_add.php" class="cms-btn btn"><i class="btn-icon fa-plus"></i>Add New Hotline</a>
						<?php } ?>
					</div><!-- ../endof .span-content-footer -->
					
					
					
				</div><!-- ../endof .section.group -->
			</div><!-- ../endof #content-container -->
		</section><!-- ../endof #main-body-section -->
	</div><!-- ../endof #body-box -->
</div><!-- ../endof #main-container -->

<script src="../lib/jquery-3.1.1.min.js" type="text/javascript"></script>
<script src="../lib/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script type="text/javascript" src="../lib/datatables/datatables.min.js"></script>

<!-- CUSTOM SCRIPTS -->
<script type="text/javascript">
	$(document).ready(function(){

		$("#menu-logout").click(function(){
			var name = $("#dname").val();
			if ( confirm("You are currently logged-in as " + name + ". Are you sure you want to sign out?") == true) {
				location.href='../logout.php';
			} else {
				return;
			}
		});
		
		$("#menu-hotline").addClass('active');

		$(".datatable-partners").DataTable({
            order     : [[ 1, "asc" ]]
        });
	});
</script>

</body>

</html>