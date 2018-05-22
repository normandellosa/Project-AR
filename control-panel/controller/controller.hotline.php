<?php session_start(); ?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<?php include('../inc/head-main.php'); ?>
	<title>AllRewards Content Management System</title> 
</head>
<body>
<?php
require_once('../dao/dao.hotline.php');

switch ($_GET['action']) {
	case 'add_hotline': hotline_controller::add_hotline(); break;
	case 'update_hotline': hotline_controller::update_hotline(); break;
	case 'delete_hotline': hotline_controller::delete_hotline(); break;
}


class hotline_controller {
	
	public static function add_hotline() {
		$hotline_title=$_POST['hotline_title'];
		$hotline_number=$_POST['hotline_number'];

		if(empty($hotline_number) || empty($hotline_title)) {
			echo 	'<script>
					swal({
						title               : "Error!",
						text                : "Please fill-up the required (*) fields",
						type                : "warning",
						showLoaderOnConfirm : true,
					}, function(){   
						setTimeout(function(){     
							window.location.href = window.history.back();
						}, 200); 
					});
				</script>';	
				return false;
		}

		$hotline_add=hotline_dao::hotline_add($hotline_title, $hotline_number);

		if($hotline_add == true) {
			echo 	'<script>
						swal({
							title               : "Success!",
							text                : "The Hotline Data was successfully added.",
							type                : "info",
							showLoaderOnConfirm : true,
						}, function(){   
							setTimeout(function(){     
								window.location.href = "../pages/manage-hotline.php";
							}, 200); 
						});
					</script>';

		} else {
			echo 	'<script>
					swal({
						title               : "Error!",
						text                : "Adding Hotline Data failed, please try again later",
						type                : "warning",
						showLoaderOnConfirm : true,
					}, function(){   
						setTimeout(function(){     
							window.location.href = window.history.back();
						}, 200); 
					});
				</script>';
		}

		
	} // END OF FUNCTION



	public static function update_hotline() {
		$hotline_ID=$_POST['hotline_ID'];
		$hotline_title=$_POST['hotline_title'];
		$hotline_number=$_POST['hotline_number'];

		if(empty($hotline_number) || empty($hotline_title)) {
			echo 	'<script>
					swal({
						title               : "Error!",
						text                : "Please fill-up the required (*) fields",
						type                : "warning",
						showLoaderOnConfirm : true,
					}, function(){   
						setTimeout(function(){     
							window.location.href = window.history.back();
						}, 200); 
					});
				</script>';	
				return false;
		}

		$hotline_update=hotline_dao::hotline_update($hotline_title, $hotline_number, $hotline_ID);

		if($hotline_update == true) {
			echo 	'<script>
						swal({
							title               : "Success!",
							text                : "The Hotline Data was successfully updated.",
							type                : "info",
							showLoaderOnConfirm : true,
						}, function(){   
							setTimeout(function(){     
								window.location.href = "../pages/manage-hotline.php";
							}, 200); 
						});
					</script>';

		} else {
			echo 	'<script>
					swal({
						title               : "Error!",
						text                : "Updating Hotline Data failed, please try again later",
						type                : "warning",
						showLoaderOnConfirm : true,
					}, function(){   
						setTimeout(function(){     
							window.location.href = window.history.back();
						}, 200); 
					});
				</script>';
		}

		
	} // END OF FUNCTION


	

	public static function delete_hotline() {
		$hotline_ID=$_GET['id'];

		$hotline_delete=hotline_dao::hotline_delete($hotline_ID);
		if($hotline_delete == true) {
			echo 	'<script>
						swal({
							title               : "Success!",
							text                : "The Hotline Data was successfully added.",
							type                : "info",
							showLoaderOnConfirm : true,
						}, function(){   
							setTimeout(function(){     
								window.location.href = "../pages/manage-hotline.php";
							}, 200); 
						});
					</script>';

		} else {
			echo 	'<script>
					swal({
						title               : "Error!",
						text                : "Adding Hotline Data failed, please try again later",
						type                : "warning",
						showLoaderOnConfirm : true,
					}, function(){   
						setTimeout(function(){     
							window.location.href = window.history.back();
						}, 200); 
					});
				</script>';
		}

	} // END OF FUNCTION	


} // END OF CLASS


?>
</body>
</html>