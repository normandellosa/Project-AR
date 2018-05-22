<?php
	session_start();

	require_once('../dao/accessDao.php');

	if (isset($_SESSION['account_id']) && $_SESSION['account_id'] != '') {
		$rnoAdd    = accessDao::accessPage($_SESSION['account_id'], 9);
		$rnoEdit   = accessDao::accessPage($_SESSION['account_id'], 10);
		$rnoDelete = accessDao::accessPage($_SESSION['account_id'], 12);		

	} else {
		echo '<script> window.history.back(); </script>';
	}

	// list of rewards
	require_once('../dao/dao.rewards.php');
	$rnoList = rewards_dao::rewards_all('News & Events'); 
	$rewards_view_last_highlight = rewards_dao::rewards_view_last_highlight();
	// echo json_encode($rewards_view_last_highlight);
	// return;
 ?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>AllRewards cPanel | Manage News &amp; Events</title> 

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

	<style>
		.row-block {
    		overflow: auto;
    		padding-bottom: 20px; 
    		margin-bottom: 20px; 
    		border-bottom: 1px solid #ddd;
		}
		.row-block-bg {
    		overflow: auto;
		    background: #fff;
    		border-bottom: 10px solid #ccc;
		    margin: -20px;
		    margin-bottom: 20px;
		    padding: 20px;
		    position: relative;
		}
		.row-block:before {
		    content: "";
		    clear: both;
		    display: table;
		}
		.block-el{
			padding-bottom: 15px; 
			margin-bottom: 15px; 
			border-bottom: 1px solid #ddd; 
			display: block;
		}
		.cms-btn.btn__update{
			float: left;
		    padding: 7px 22px;
		    margin: 0;
		    background-color: #101010;
		}
		.row-loader{
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			z-index: 11;
			background-color: #fff;
			opacity: 0.7;
			display: none;
		}

		.va-block {
		    display: table;
		    height: 100%;
		    width: 100%;
		}

		.va-middle{
		    display: table-cell;
		    vertical-align: middle;
		    text-align: center;
		}
	</style>
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
							<h1>Manage News &amp; Events</h1>

							<?php if($rnoAdd || $_SESSION['account_type'] == 'Administrator') { ?>
							<a href="manage-newsevents_add.php" class="cms-btn btn"><i class="btn-icon fa-plus"></i>Add Article</a>
							<!-- <a href="manage-highlight-image.php" class="cms-btn btn" style="background: #ee2225;"><i class="btn-icon fa-plus"></i>Add Highlight Image</a> -->
							<?php } ?>
						</div><!-- ../endof .span-content-header -->

						<div class="span-content-container">

							<form id="js-form_highlights" enctype="multipart/form-data" class="formular" name="example1" method="post" action="">
								<input type="hidden" name="action" value="highlights_newsevents">
								<div class="row-block-bg form-add">
									<div class="fleft" style="width: 70%;">
										<?php if ($rewards_view_last_highlight) { ?>
											<img id="js-highlight_image" src="../../uploads/<?= $rewards_view_last_highlight['rno_highlight_image'] ?>?v=<?= date("Y-m-d").date("h:i:sa"); ?>" alt="" style="width: 100%;">
										<?php }?>
									</div>
									
									<div class="fleft" style="width: 30%;">
										<div style="padding-left: 20px;">
											<div class="block-el row-block" style="border-color: transparent;">
												<label for="rnoList">Choose Article you want to add Highlight Image <span class="highlight">*</span></label>
												<select id="rnoList" name="rnoList" tabindex="1" required>
													<option selected value="">Choose one</option>
													<?php if($rnoList) {
														foreach($rnoList as $rno) { ?>	
														<option value="<?= $rno['rno_id'] ?>" <?php if($rno['rno_highlight_image'] != NULL) {?> selected <?php } ?>><?= $rno['rno_title'] ?></option>
														<?php } ?>
													<?php } ?>
												</select>
											</div>

											<div class="block-el row-block">
												<label for="rno_category_fk">Upload Highlight Image<span class="highlight">*</span></label>
												<div class="remark"><b>Dimensions:</b> Size must be 1200x280 pixels<br/><b>File Type:</b> JPG / JPEG only</div>
												<input id="rnoList_file" type="file" name="rnoList_file" />
											</div>
											<button type="submit" class="cms-btn btn btn__update" style="padding:0 15px">
													<i class="btn-icon fa-refresh"></i>Update
											</button>
										</div>
									</div>
									<div class="row-loader">
										<div class="va-block">
											<div class="va-middle">
												<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
											</div>
										</div>
									</div>
								</div>
							</form>	

							<table class="datatable-rewards dataTable">
							
								<thead>
									<tr>
									  <th width="10%">Date Added</th>
									  <th width="5%">Preview</th>
									  <th width="30%">Details</th>
									  <th width="15%">Promo Period</th>
									  <th>Start Date</th>
									  <th>End Date</th>
									  <th>Partner Name</th>
									  <th width="20%">Partner</th>
									  <th width="5%">Status</th>
									  <th width="15%">Action</th>
									</tr>
								</thead>

								<tbody>

								<?php if($rnoList) {
									foreach($rnoList as $rno) { ?>	
									<tr>
										<!-- DATE ADDED -->
										<td align="center"><?= $rno['rno_date'] ?></td>

										<!-- CAROUSEL IMAGE -->
										<td align="center"><img src="../../uploads/<?= $rno['rno_image'] ?>?v=<?= date("Y-m-d").date("h:i:sa"); ?>" alt="<?= $rno['rno_title'] ?>" title="<?= $rno['rno_title'] ?>" class="preview-thumb rewards-thumb"/></td>

										<!-- DETAILS -->
										<td>
											<div class="table-subheader"><?= $rno['rno_title'] ?></div>
											<div class="table-description">
												<?php 
													if (strlen($rno['rno_subtitle']) > 100) {
														echo substr($rno['rno_subtitle'], 0, 100) . "...";  
													} else {
														echo $rno['rno_subtitle'];
													}	
												?>	
											</div>
										</td>

										<!-- PROMO PERIOD -->
										<td align="center">
										<?php if (empty($rno['rno_date_end'])) { ?>

											<!-- if END DATE is BLANK, regardless if START DATE is blank or not -->
											<span class="status-metro status-indefinite">Indefinite</span>

										<?php } else if (empty($rno['rno_date_start']) && !empty($rno['rno_date_end'])) {
											$endDateFull = date("M j, Y",strtotime($rno['rno_date_end'])); ?>

											<!-- only START DATE is BLANK -->
											Up to <?= $endDateFull ?>

										<?php } else {

											/*START and END DATES are not BLANK*/
											$startYear = date("Y",strtotime($rno['rno_date_start']));
											$endYear = date("Y",strtotime($rno['rno_date_end']));

											$startDateFull = date("M j, Y",strtotime($rno['rno_date_start']));
											$startDate = date("M j",strtotime($rno['rno_date_start']));
											$endDateFull = date("M j, Y",strtotime($rno['rno_date_end']));

											if ($startYear <> $endYear) { ?>
												<?= $startDateFull.' - '.$endDateFull ?>
											<?php } else { ?>
												<?= $startDate.' - '.$endDateFull ?>
											<?php }
										} ?>
										</td>

										<!-- PROMO START DATE -->
										<td><?= $rno['rno_date_start']; ?></td>

										<!-- PROMO END DATE -->
										<td><?= $rno['rno_date_end']; ?></td>

										<!-- CATEGORY NAME -->
										<td align="center"><?= $rno['category_name'] ?></td>

										<!-- CATEGORY PREVIEW LOGO -->
										<td align="center"><img src="../../images/logo-<?php echo strtolower($rno['category_code']).'.png' ?>" class="preview-thumb logo-thumb"></td>

										<!-- STATUS -->
										<td align="center">
											<?php if($rno['rno_status'] == 'active') { ?>
											<span class="status-metro status-active"><?= $rno['rno_status'] ?></span>
											<?php } else { ?>
											<span class="status-metro"><?= $rno['rno_status'] ?></span>
											<?php } ?>
										</td>

										<!-- ACTION -->
										<td align="center">

											<!-- EDIT -->
											<?php if($rnoEdit || $_SESSION['account_type'] == 'Administrator') { ?>
											<a href="manage-newsevents_edit.php?id=<?= $rno['rno_id'] ?>" class="action-btn"><i class="fa fa-edit"></i> Edit</a> | 
											
											<?php } else { ?>
											<span class="action-btn disabled"><i class="fa fa-edit"></i> Edit</span> |

											<?php } ?>
											<!-- ../endof EDIT -->

											<!-- DELETE -->
											<?php if($rnoDelete || $_SESSION['account_type'] == 'Administrator') { ?>
												<a href="javascript:void();" onclick="if(confirm('Are you sure you want to delete this Article?')){location.href='../controller/controller.newsevents.php?id=<?= $rno['rno_id'] ?>&action=delete_newsevents';} else {e.preventDefault();return false;}" class="action-btn"><i class="fa fa-trash"></i> Delete</a>
											
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
							<a href="manage-newsevents_add.php" class="cms-btn btn"><i class="btn-icon fa-plus"></i>Add Article</a>
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
	$(".datatable-rewards").DataTable({
        order        : [[ 0, "desc" ]],
        aoColumnDefs : [
            {
                //non-sortable columns
                aTargets  : [1,9],
                bSortable : false
            },
            {
                //hidden columns
                aTargets  : [4,5,6],
                bVisible  : false
            },
            {
                //promo period column -- using end date and start date to sort
                aTargets  : [3],
                aDataSort : [5,4]
            },
            {
                //category preview column -- using category name to sort
                aTargets  : [7],
                aDataSort : [6]
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
		
		$("#menu-news").addClass('active');

		$(".dataTable td .preview-thumb").show();

		$('body').on('submit', '#js-form_highlights', function (e) {
			e.preventDefault();
			// $('#js-highlight_image').attr('src', '../../uploads/1af08c86c58ac887acdf76bb2e15b31cc452aeeb.jpg');
			// $('#js-highlight_image').attr('src', '../../uploads/Save-P1,&000.jpg');
			
			// return;

			$('.row-loader').css('display', 'block');

			if($('#rnoList').val() == '' || $('#rnoList_file').val() == '')
			{
				$('.row-loader').css('display', 'none');
				alert('Article category and Highlight Image are required.');
				return;
			}

			var formData = new FormData($(this)[0]);
			$.ajax({
				url : '../controller/controller.newsevents.php',
				type : 'POST',
				dataType : 'JSON',
				data : formData,
				processData : false,
				contentType : false,
				success : function (res) {
					// console.log(res.data.rno_id);
						// $('#js-highlight_image').attr('src', res.image);

					if (res.errCode == 0)
					{
						$('#js-highlight_image').attr('src', res.image);
						//alert(res.message);
						location.reload();
					}
					else
					{
						alert(res.message);
					}
				}
			});
		});
	
	});
</script>

</body>
</html>