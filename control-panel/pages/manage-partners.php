<?php
	session_start();

	require_once('../dao/accessDao.php');

	if (isset($_SESSION['account_id']) && $_SESSION['account_id'] != '') {
		$rnoAdd    = accessDao::accessPage($_SESSION['account_id'], 17);
		$rnoEdit   = accessDao::accessPage($_SESSION['account_id'], 18);
		$rnoDelete = accessDao::accessPage($_SESSION['account_id'], 20);		

	} else {
		echo '<script> window.history.back(); </script>';
	}

	// list of rewards
	require_once('../dao/dao.partners.php');
	$partners_list = partners_dao::partners_list(); 

 ?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>AllRewards cPanel | Manage Partners</title> 

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
							<h1>Manage Partners</h1>

							<?php if($rnoAdd || $_SESSION['account_type'] == 'Administrator') { ?>
							<a href="manage-partners_add.php" class="cms-btn btn"><i class="btn-icon fa-plus"></i>Add Branch</a>
							<?php } ?>
						</div><!-- ../endof .span-content-header -->

						<div class="span-content-container">

							<table class="datatable-partners dataTable">
							
								<thead>
									<tr>
									  <th align="left">Branch Details</th>
									  <th align="left">Contact Details</th>
									  <th>Partner Name</th>
									  <th>Partner</th>
									  <th>Status</th>
									  <th>Action</th>
									</tr>
								</thead>

								<tbody>

								<?php if($partners_list == true) {
									foreach($partners_list as $partners) { ?>	
									<tr>
										<!-- BRANCH DETAILS -->
										<td>
											<div class="table-subheader"><?= $partners['partners_name'] ?></div>
											<div class="table-description"><b>Address:</b> <?= $partners['partners_address'] ?></div>	
										</td>

										<!-- CONTACT DETAILS -->
										<td>
											<?php if (!empty($partners['partners_email'])) { ?>
											<div class="table-description"><b>Email:</b> <?= $partners['partners_email'] ?></div>
											<?php } ?>
											<?php if (!empty($partners['partners_tel'])) { ?>
											<div class="table-description"><b>Tel. / Mobile:</b> <?= $partners['partners_tel'] ?></div>
											<?php } ?>
										</td>

										<!-- CATEGORY NAME -->
										<td align="center"><?= $partners['category_name'] ?></td>

										<!-- CATEGORY PREVIEW LOGO -->
										<td align="center"><img src="../../images/logo-<?php echo strtolower($partners['category_code']).'.png' ?>" class="preview-thumb logo-thumb"></td>

										<!-- STATUS -->
										<td align="center"><?= $partners['partners_status'] ?></td>

										<!-- ACTION -->
										<td align="center">
											<!-- EDIT -->
											<?php if($rnoEdit || $_SESSION['account_type'] == 'Administrator') { ?>
												<a href="manage-partners_edit.php?id=<?= $partners['partners_ID'] ?>" class="action-btn"><i class="fa fa-edit"></i> Edit</a> | 
											
											<?php } else { ?>
												<span class="action-btn disabled"><i class="fa fa-edit"></i> Edit</span> |

											<?php } ?>

											<!-- DELETE -->
											<?php if($rnoDelete || $_SESSION['account_type'] == 'Administrator') { ?>
												<a href="javascript:void();" onclick="if(confirm('Are you sure you want to delete this Branch?')){location.href='../controller/controller.partners.php?id=<?= $partners['partners_ID'] ?>&action=delete_partners';} else {e.preventDefault();return false;}" class="action-btn"><i class="fa fa-trash"></i> Delete</a>
											
											<?php } else { ?>
												<span class="action-btn disabled"><i class="fa fa-trash"></i> Delete</span>

											<?php } ?>
											
										</td>
										
									</tr>
								<?php } 
								} ?>
								</tbody>
								
							</table><!-- ../endof .datatable-table -->
							
						</div><!-- ../endof .span-content-container -->

						<div class="span-content-footer">
							<?php if($rnoAdd || $_SESSION['account_type'] == 'Administrator') { ?>
							<a href="manage-partners_add.php" class="cms-btn btn"><i class="btn-icon fa-plus"></i>Add Branch</a>
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
	$(".datatable-partners").DataTable({
        order        : [[ 0, "asc" ]],
        aoColumnDefs : [
            {
                //non-sortable columns
                aTargets  : [5],
                bSortable : false
            },
            {
                //hidden columns
                aTargets  : [2],
                bVisible  : false
            },
            {
                //hidden columns
                aTargets  : [4],
                bVisible  : false
            },
            {
                //category preview column -- using category name to sort
                aTargets  : [3],
                aDataSort : [2]
            }
        ]
    });

	$(document).ready(function(){

		$("#menu-logout").click(function(){
			var name = $("#dname").val();
			if ( confirm("You are currently logged-in as " + name + ". Are you sure you want to sign out?") == true) {
				location.href='../logout.php';
			} else {
				return;
			}
		});
		
		$("#menu-partners").addClass('active');

		$(".dataTable td .preview-thumb").show();
	});
</script>

</body>

</html>