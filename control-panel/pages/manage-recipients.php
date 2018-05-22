<?php
	session_start();

	require_once('../dao/accessDao.php');
	if(isset($_SESSION['account_id']) && $_SESSION['account_id'] != '') {
		$recipientsAdd    = accessDao::accessPage($_SESSION['account_id'], 13);
		$recipientsEdit   = accessDao::accessPage($_SESSION['account_id'], 14);
		$recipientsDelete = accessDao::accessPage($_SESSION['account_id'], 16);		
	} else {
		echo '<script> window.history.back(); </script>';
	}

	require_once('../dao/recipientDao.php');
	$recipients = recipientDao::recipientList();
	$count      = sizeof($recipients);

 ?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>AllRewards cPanel | Manage Inquiry Recipients</title> 

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
							<h1>Manage Inquiry Recipients</h1>

							<?php if($recipientsAdd || $_SESSION['account_type'] == 'Administrator') { ?>
							<a href="manage-recipients_add.php" class="cms-btn btn"><i class="btn-icon fa-plus"></i>Add New Recipient</a>
							<?php } ?>
						</div><!-- ../endof .span-content-header -->

						<div class="span-content-container">

							<table class="datatable-recipients">
							
								<thead>
									<tr>
									  <th>Full Name</th>
									  <th>E-mail Address</th>
									  <th>Status</th>
									  <th>Action</th>
									</tr>
								</thead>

								<tbody>

								<?php if($recipients) {
									foreach($recipients as $recipient) { ?>
									<tr>
										<!-- FULL NAME -->
										<td><?= $recipient['recipient_name'] ?></td>

										<!-- EMAIL ADDRESS -->
										<td><?= $recipient['recipient_email'] ?></td>

										<!-- STATUS -->
										<td align="center">
											<?php if($recipient['recipient_status'] == 'active' || $recipient['recipient_status'] == 'Active') { ?>
											<span class="status-metro status-active"><?= $recipient['recipient_status'] ?></span>
											<?php } else { ?>
											<span class="status-metro"><?= $recipient['recipient_status'] ?></span>
											<?php } ?>
										</td>

										<!-- ACTION -->
										<td align="center">

											<!-- EDIT -->
											<?php if($recipientsEdit || $_SESSION['account_type'] == 'Administrator') { ?>
											<a href="manage-recipients_edit.php?id=<?= $recipient['recipient_id'] ?>" class="action-btn"><i class="fa fa-edit"></i> Edit</a> | 
											
											<?php } else { ?>
											<span class="action-btn disabled"><i class="fa fa-edit"></i> Edit</span> |

											<?php } ?>
											<!-- ../endof EDIT -->

											<!-- DELETE -->
											<?php if($recipientsDelete || $_SESSION['account_type'] == 'Administrator') { ?>
												<a href="javascript:void();" onclick="if(confirm('Are you sure you want to delete this Inquiry Recipient?')){location.href='../controller/controller.recipients.php?id=<?= $recipient['recipient_id'] ?>&action=delete_recipient';} else {e.preventDefault();return false;}" class="action-btn"><i class="fa fa-trash"></i> Delete</a>
											<?php } else { ?>
												<span class="action-btn disabled"><i class="fa fa-trash"></i> Delete</span>
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
							<?php if($rnoAdd || $_SESSION['account_type'] == 'Administrator') { ?>
							<a href="manage-recipients_add.php" class="cms-btn btn"><i class="btn-icon fa-plus"></i>Add New Reward</a>
							<?php } ?>
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
		
		$("#menu-email").addClass('active');

		$(".datatable-recipients").DataTable({
            order     : [[ 0, "asc" ]]
        });
	});
</script>

</body>

</html>