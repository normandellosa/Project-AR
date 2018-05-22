<?php
	session_start();

	require_once('../dao/accessDao.php');
	if (isset($_SESSION['account_type']) && $_SESSION['account_type'] == 'Administrator') {		

	} else {
		echo '<script> window.history.back(); </script>';
	}

	require_once('../dao/accountDao.php');

	if ($_SESSION['account_id'] == 1) {
		$accounts = accountDao::accountList();	
	} else {
		$accounts = accountDao::accountListLimited();
	}

?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>AllRewards cPanel | Manage User Accounts</title> 

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
					
					<form id="formID" enctype="multipart/form-data" class="formular" name="example1" method="post" action="">

						<div class="span-content-header">
							<h1>Manage User Accounts</h1>

							<a href="manage-accounts_add.php" class="cms-btn btn"><i class="btn-icon fa-plus"></i>Add New User Account</a>
						</div><!-- ../endof .span-content-header -->

						<div class="span-content-container">

							<table class="datatable-accounts">
							
								<thead>
									<tr>
									  <th>Account Details</th>
									  <th>Account Type</th>
									  <th>Action</th>
									</tr>
								</thead>

								<tbody>

								<?php if($accounts) {
									foreach($accounts as $account) { ?>
									<tr>
										<!-- DATE ADDED -->
										<td>
											<div class="account-subheader"><?= $account['account_display_name'] ?></div>
											<div class="account-description"><?= $account['account_email'] ?></div>
										</td>

										<!-- ACCOUNT TYPE -->
										<td align="center">
											<?php if($account['account_type'] == 'Administrator') { ?>
											<span class="status-metro status-active status-administrator"><?= $account['account_type'] ?></span>

											<?php } else if($account['account_type'] == 'Moderator') { ?>
											<span class="status-metro status-active status-moderator"><?= $account['account_type'] ?></span>

											<?php } ?>
										</td>

										<!-- ACTION -->
										<td align="center">

											<!-- EDIT -->
											<a href="manage-accounts_edit.php?id=<?= $account['account_id'] ?>" class="action-btn"><i class="fa fa-edit"></i> Edit</a> | 
											<!-- ../endof EDIT -->

											<!-- DELETE -->
											<?php if($_SESSION['account_id'] == $account['account_id']) { ?>
											<span class="action-btn disabled"><i class="fa fa-trash"></i> Delete</span>
											
											<?php } else { ?>
												<a href="javascript:void();" onclick="if(confirm('Are you sure you want to delete this User Account?')){location.href='../controller/controller.accounts.php?id=<?= $account['account_id'] ?>&action=delete_account';} else {e.preventDefault();return false;}" class="action-btn"><i class="fa fa-trash"></i> Delete</a>
											<?php } ?>
											<!-- ../endof DELETE -->
											
										</td>
										
									</tr>
								<?php } 
								} ?>
								</tbody>
								
							</table><!-- ../endof .datatable-table -->
							
						</div><!-- ../endof .span-content-container -->

						<div class="span-content-footer">
							<a href="manage-accounts_add.php" class="cms-btn btn"><i class="btn-icon fa-plus"></i>Add New User Account</a>
						</div><!-- ../endof .span-content-footer -->
					
					</form>	
					
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
		
		$("#menu-accounts").addClass('active');

		$(".datatable-accounts").DataTable({
            order     : [[ 1, "asc" ]]
        });
	});
</script>

</body>

</html>