<?php
	session_start();

	require_once('../dao/accessDao.php');
	if(isset($_SESSION['account_id']) && $_SESSION['account_id'] != '') {
	} else {
		echo '<script> window.history.back(); </script>';
	}

	require_once('../dao/logDao.php');
	require_once('../dao/accountDao.php');

	$logs = logDao::logsList();
	if(isset($_GET['data']) && $_GET['data'] != '') {
		$data = $_GET['data'];
	} else {
		$data = 5;
	}


 ?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>AllRewards cPanel | User Activity Log</title> 

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
						
					<pre><?php echo json_encode($logs, JSON_PRETTY_PRINT) ?></pre>

					<form id="formID" enctype="multipart/form-data" class="formular" name="example1" method="post" action="">

						<div class="span-content-header">
							<h1>User Activity Log</h1>
						</div><!-- ../endof .span-content-header -->

						<div class="span-content-container">

							<table class="datatable-log">
							
								<thead>
									<tr>
									  <th>Date</th>
									  <th>Time</th>
									  <th>Activity</th>
									  <th>User</th>
									</tr>
								</thead>

								<tbody>

								<?php if($logs) {
									foreach($logs as $log) {
										$acc = accountDao::accountDetail($log['log_account_id']);
										$date = date("Y-m-d",strtotime($log['log_date']));
										$time = date("H:i:s A",strtotime($log['log_date']));
										?>

									<tr>
										<td align="center"><?= $date; ?></td>
										<td align="center"><?= $time; ?></td>
										<td class="activity-desc"><?= $log['log_description'] ?></td>
										<td>
											<div class="account-subheader"><?= $acc['account_display_name'] ?></div>
											<div class="account-description"><?= $acc['account_type'] ?></div>
										</td>
									</tr>

								<?php } 
								} ?>

								</tbody>
								
							</table><!-- ../endof .datatable-table -->
							
						</div><!-- ../endof .span-content-container -->
					
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
		
		$("#menu-log").addClass('active');

		$(".datatable-log").DataTable({
            order        : [[ 0, "desc" ],[ 1, "desc" ]],
            pageLength   : 30,
            aoColumnDefs : [
                {
                    //non-sortable columns
                    aTargets  : [1],
                    bSortable : false
                },
                {
                    //always sort DATE and TIME together
                    aTargets  : [0],
                    aDataSort : [0,1]
                }
            ]
        });
	});
</script>

</body>
</html>