<?php 
	session_start();

	require_once('../dao/accessDao.php');

	if (isset($_SESSION['account_id']) && $_SESSION['account_id'] != '') {
		$carouselAdd    = accessDao::accessPage($_SESSION['account_id'], 1);
		$carouselEdit   = accessDao::accessPage($_SESSION['account_id'], 2);
		$carouselDelete = accessDao::accessPage($_SESSION['account_id'], 4);
	} else {
		echo '<script> window.history.back(); </script>';
	}

	// list of rewards
	require_once('../dao/dao.carousel.php');
	$carousels = carousel_dao::carousel_all();

	// echo json_encode($carousels);
	// return;
	$count = sizeof($carousels);
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>AllRewards cPanel | Manage Featured Ads</title> 

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
							<h1>Manage Featured Ads</h1>

							<?php if($carouselAdd || $_SESSION['account_type'] == 'Administrator') { ?>
							<a href="manage-carousel_add.php" class="cms-btn btn"><i class="btn-icon fa-plus"></i>Add Featured Ad</a>
							<?php } ?>
						</div><!-- ../endof .span-content-header -->

						<div class="span-content-container">

							<table class="datatable-featured-ads">
								<thead>
									<tr>
									  <th width="10%">Date Added</th>
									  <th width="10%">Preview</th>
									  <th width="30%">Title</th>
									  <th width="10%">Status</th>
									  <th width="10%">Action</th>
									</tr>
								</thead>

								<tbody>

								<?php if ($carousels) {
									foreach ($carousels as $carousel) { ?>
									<tr>
										<!-- DATE ADDED -->
										<td align="center"><?= $carousel['carousel_date'] ?></td>

										<!-- CAROUSEL IMAGE -->
										<td align="center"><img src="../../uploads/<?= $carousel['carousel_feature_img'] ?>" alt="<?= $carousel['carousel_feature_alt'] ?>" title="<?= $carousel['carousel_feature_alt'] ?>" class="preview-thumb rewards-thumb"/></td>

										<!-- TITLE / CAPTION / ALT TAG -->
										<td>
											<?= $carousel['carousel_feature_alt'] ?>
											<?php if ( !empty($carousel['carousel_url']) ) { ?>
												<?php if ( $carousel['carousel_target'] == "_self" ) { ?>
													<a href="../../<?= $carousel['carousel_url']; ?>" target="_blank" class="label label-info">View Related URL</a>
												<?php } else { ?>
													<a href="<?= $carousel['carousel_url']; ?>" target="_blank" class="label label-info">View Related URL</a>
												<?php } ?>
											<?php } ?>
										</td>

										<!-- STATUS -->
										<td align="center">
											<?php if($carousel['carousel_status'] == 'active') { ?>
											<span class="status-metro status-active"><?= $carousel['carousel_status'] ?></span>
											<?php } else { ?>
											<span class="status-metro"><?= $carousel['carousel_status'] ?></span>
											<?php } ?>
										</td>

										<!-- ACTION -->
										<td align="center">

											<!-- EDIT -->
											<?php if($carouselEdit || $_SESSION['account_type'] == 'Administrator') { ?>
											<a href="manage-carousel_edit.php?id=<?= $carousel['carousel_id'] ?>" class="action-btn"><i class="fa fa-edit"></i> Edit</a> | 
											
											<?php } else { ?>
											<span class="action-btn disabled"><i class="fa fa-edit"></i> Edit</span> |

											<?php } ?>
											<!-- ../endof EDIT -->

											<!-- DELETE -->
											<?php if($carouselDelete || $_SESSION['account_type'] == 'Administrator') {
												if ($count > 1) { ?>
												<a href="javascript:void();" onclick="if(confirm('Are you sure you want to delete this Ad?')){location.href='../controller/controller.carousel.php?id=<?= $carousel['carousel_id'] ?>&action=delete_carousel';} else {e.preventDefault();return false;}" class="action-btn"><i class="fa fa-trash"></i> Delete</a>

												<?php } else if ($count < 2) { ?>
												<a href="javascript:void();" onclick="alert('You only have one (1) Featured Ad uploaded. You cannot delete this ad.')" class="action-btn"><i class="fa fa-trash"></i> Delete</a>

												<?php } else { ?>
												<span class="action-btn disabled"><i class="fa fa-trash"></i> Delete</span>

												<?php } ?>
											
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
							<?php if($carouselAdd || $_SESSION['account_type'] == 'Administrator') { ?>
							<a href="manage-carousel_add.php" class="cms-btn btn"><i class="btn-icon fa-plus"></i>Add Featured Ad</a>
							<?php } ?>
						</div><!-- ../endof .span-content-footer -->
					
					</form>	
					
					
				</div><!-- //SECTION GROUP -->
				
			</div><!-- //CONTENT CONTAINER -->
		</section><!-- //MAIN BODY SECTION -->
	</div><!-- //BODY BOX -->	
</div><!-- //MAIN CONTAINER -->

<script src="../lib/jquery-3.1.1.min.js" type="text/javascript"></script>
<script src="../lib/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script type="text/javascript" src="../lib/datatables/datatables.min.js"></script>

<!-- CUSTOM SCRIPTS -->
<script type="text/javascript">

	$(".datatable-featured-ads").DataTable({
        order        : [[ 0, "desc" ]],
        aoColumnDefs : [
            {
                bSortable : false,
                aTargets  : [2,4]
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
		
		$("#menu-carousel").addClass('active');

		$(".dataTable td .preview-thumb").show();
	});
</script>

</body>

</html>