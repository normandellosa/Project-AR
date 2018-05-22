<?php
	session_start();
	date_default_timezone_set('Asia/Manila');

	require_once('../dao/accountDao.php');
	require_once('../dao/accessDao.php');

	switch ($_GET['action']) {
		case 'add_account': account_controller::add_account(); break;
		case 'update_account': account_controller::update_account(); break;
		case 'delete_account': account_controller::delete_account(); break;
	}

	class account_controller {
		
		public static function add_account() {

			$account_id = accountDao::selectId();

			$account_username = $_POST['username'];
			$account_password = sha1($_POST['password']);
			$account_email = $_POST['email_address'];
			$account_display_name = $_POST['display_name'];
			$account_type = $_POST['user_type'];

			$add = accountDao::addAccount($account_username,$account_password,$account_email,$account_display_name,$account_type);

			if($add) {

				if($account_type != 'Administrator') {

					if(isset($_POST['carousel'])) {
						foreach($_POST['carousel'] as $access1) {
							accessDao::createAccess($account_id, $access1);
						}
					}

					if(isset($_POST['reward'])) {
						foreach($_POST['reward'] as $access2) {
							accessDao::createAccess($account_id, $access2);
						}
					}

					if(isset($_POST['offer'])){
						foreach($_POST['offer'] as $access3) {
							accessDao::createAccess($account_id, $access3);
						}
					}

					if(isset($_POST['partner'])){
						foreach($_POST['partner'] as $access4) {
							accessDao::createAccess($account_id, $access4);
						}
					}

					if(isset($_POST['recipient'])) {
						foreach($_POST['recipient'] as $access5) {
							accessDao::createAccess($account_id, $access5);
						}
					}
				}


		 		// INSERTING LOG
				require_once('../dao/logDao.php');
				date_default_timezone_set('Asia/Manila');
				$log_date = date('Y-m-d H:i:s A');
				$log_description = "Added <span class='green'>".$account_username."</span> as <span class='red'>".$account_type."</span>";
				$log_account_id = $_SESSION['account_id'];
				logDao::addLog($log_date, $log_description, $log_account_id);

				echo 	'<script>
							alert("You have successfully created a new user account.");
							location.href = "../pages/manage-accounts.php";
						</script>';
			 
			} else {

				echo 	'<script>
							alert("Failed to create a new user account. Please try again.");
							window.history.back();
						</script>';
			}
			
		} // END OF FUNCTION


		public static function update_account() {

			$account_username     = $_POST['username'];
			$account_email        = $_POST['email_address'];
			$account_display_name = $_POST['display_name'];
			$account_id           = $_POST['id'];

			if(isset($_POST['user_type']) && $_POST['user_type'] != '') {
				$account_type = $_POST['user_type'];
			} else {
				$account_type = "Moderator";
			}

			//COUNT THE ADMIN
			$accList = accountDao::accountAdminList();
			$num = sizeof($accList);

			if($_SESSION['account_id'] != '1' && $account_id == '1' && $_SESSION['account_type'] != $account_type) {

				echo 	'<script>
							alert("Changing the account type of this account is not permitted.");
							window.history.back();
						</script>';

				return;	
			} else {
				if($account_id == '1') {
					$account_type = 'Administrator';
				}

				$edit = accountDao::editAccount($account_username,$account_email,$account_display_name,$account_type,$account_id);
				$cleanAccess = accessDao::deleteAccess($account_id);

				if($edit) {

					if(isset($_POST['password']) && trim($_POST['password']) != '') { //if POST password not empty,

						$account_password = sha1($_POST['password']);
						$pass = accountDao::editPassword($account_password, $account_id); //UPDATE PASSWORD

					}

					if($account_type != 'Administrator') {

						if(isset($_POST['carousel'])) {
							foreach($_POST['carousel'] as $access1) {
								accessDao::createAccess($account_id, $access1);
							}
						}

						if(isset($_POST['reward'])) {
							foreach($_POST['reward'] as $access2) {
								accessDao::createAccess($account_id, $access2);
							}
						}

						if(isset($_POST['offer'])){
							foreach($_POST['offer'] as $access3) {
								accessDao::createAccess($account_id, $access3);
							}
						}

						if(isset($_POST['partner'])){
							foreach($_POST['partner'] as $access4) {
								accessDao::createAccess($account_id, $access4);
							}
						}

						if(isset($_POST['recipient'])) {
							foreach($_POST['recipient'] as $access5) {
								accessDao::createAccess($account_id, $access5);
							}
						}
					}

				 	// INSERTING LOG
					require_once('../dao/logDao.php');
					date_default_timezone_set('Asia/Manila');
					$log_date = date('Y-m-d H:i:s A');
					$log_description = "Updated <span class='green'>".$account_username."</span> details";
					$log_account_id = $_SESSION['account_id'];
					logDao::addLog($log_date, $log_description, $log_account_id);


					if($_SESSION['account_id'] == $account_id) { //if the user modified his own account

						echo 	'<script>
									alert("You have successfully updated your account. You will be automatically logged-out and will be required to log-in again.");
									location.href = "../logout.php";
								</script>';

					} else {

						echo 	'<script>
									alert("The User Account was successfully updated!");
									location.href = "../pages/manage-accounts.php";
								</script>';
					}
				 
				} else {

					echo 	'<script>
								alert("There was an error updating this user account. Please try again.");
								window.history.back();
							</script>';
				}
			}

			
		} // END OF FUNCTION


		public static function delete_account() {
			$accList = accountDao::accountAdminList();
			$num = sizeof($accList);
			$id = $_GET['id'];

			$account = accountDao::accountDetail($id);
			$account_username = $account['account_username'];
			$account_type = $account['account_type'];

			if($num < 2 && $_SESSION['account_id'] == $id) {

				echo 	'<script>
							alert("This account cannot be deleted.");
							window.history.back();
						</script>';
			} else {
				$delete = accountDao::deleteAccount($id);

			}


			if($delete) {


		 		// INSERTING LOG
				require_once('../dao/logDao.php');
				date_default_timezone_set('Asia/Manila');
				$log_date = date('Y-m-d H:i:s A');
				$log_description = "Deleted <span class='green'>".$account_username."</span> (<span class='red'>".$account_type."</span>) from database";
				$log_account_id = $_SESSION['account_id'];
				logDao::addLog($log_date, $log_description, $log_account_id);

				echo 	'<script>
							alert("The User Account was successfully deleted!");
							location.href = "../pages/manage-accounts.php";
						</script>';

			} else {

				echo 	'<script>
							alert("There was an error deleting this user account. Please try again.");
							window.history.back();
						</script>';
			}

		} // END OF FUNCTION	


	} // END OF CLASS


?>