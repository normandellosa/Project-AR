<?php
	session_start();
	date_default_timezone_set('Asia/Manila');

	require_once('../dao/dao.partners.php');

	switch ($_GET['action']) {
		case 'add_partners': partners_controller::add_partners(); break;
		case 'update_partners': partners_controller::update_partners(); break;
		case 'delete_partners': partners_controller::delete_partners(); break;
	}

	class partners_controller {
		
		public static function add_partners() {
			$partners_status = $_POST['partners_status'];
			$rno_category_fk = $_POST['rno_category_fk'];
			$partners_name = $_POST['partners_name'];
			$partners_location = $_POST['partners_location'];
			$partners_cityprovince = $_POST['partners_cityprovince'];
			$partners_address = $_POST['partners_address'];

			if (isset($_POST['partners_email'])) {
				$partners_email = $_POST['partners_email'];
			}

			if (isset($_POST['partners_tel'])) {
				$partners_tel = $_POST['partners_tel'];
			}

			if(empty($partners_status) || empty($rno_category_fk) || empty($partners_name)) {
				echo 	'<script>
							alert("Please fill up the required (*) fields.");
							window.history.back();
						</script>';
				return false;
			}

			$partners_add=partners_dao::partners_add($partners_status,$rno_category_fk,$partners_name,$partners_location,$partners_cityprovince,$partners_address,$partners_email,$partners_tel);

			if($partners_add == true) {

				echo 	'<script>
							alert("The Partner Data was successfully added!");
							location.href = "../pages/manage-partners.php"
						</script>';

			} else {

				echo 	'<script>
							alert("There was an error adding the Partner into the database. Please try again.");
							window.history.back();
						</script>';
			}

			
		} // END OF FUNCTION


		public static function update_partners() {
			$partners_ID = $_POST['partners_ID'];
			$partners_status = $_POST['partners_status'];
			$rno_category_fk = $_POST['rno_category_fk'];
			$partners_name = $_POST['partners_name'];
			$partners_location = $_POST['partners_location'];
			$partners_cityprovince = $_POST['partners_cityprovince'];
			$partners_address = $_POST['partners_address'];

			if (isset($_POST['partners_email'])) {
				$partners_email = $_POST['partners_email'];
			}

			if (isset($_POST['partners_tel'])) {
				$partners_tel = $_POST['partners_tel'];
			}

			if(empty($partners_status) || empty($rno_category_fk) || empty($partners_name)) {

				echo 	'<script>
							alert("Please fill up the required (*) fields.");
							window.history.back();
						</script>';

				return false;	
			}

			$partners_update=partners_dao::partners_update($partners_status,$rno_category_fk,$partners_name,$partners_location,$partners_cityprovince,$partners_address,$partners_email,$partners_tel,$partners_ID);

			if($partners_update == true) {

				echo 	'<script>
							alert("The Partner Data was successfully updated!");
							location.href = "../pages/manage-partners.php"
						</script>';

			} else {

				echo 	'<script>
							alert("There was an error updating the Partner data. Please try again.");
							window.history.back();
						</script>';
			}

			
		} // END OF FUNCTION


		public static function delete_partners() {
			$partners_ID=$_GET['id'];

			$partners_delete=partners_dao::partners_delete($partners_ID);

			if($partners_delete == true) {

				echo 	'<script>
							alert("The Partner Data was successfully deleted!");
							location.href = "../pages/manage-partners.php"
						</script>';

			} else {

				echo 	'<script>
							alert("There was an error deleting the Partner data. Please try again.");
							window.history.back();
						</script>';
			}

		} // END OF FUNCTION	


	} // END OF CLASS


?>