<?php
	session_start();
	date_default_timezone_set('Asia/Manila');

	require_once('../dao/recipientDao.php');

	switch ($_GET['action']) {
		case 'add_recipient': recipient_controller::add_recipient(); break;
		case 'update_recipient': recipient_controller::update_recipient(); break;
		case 'delete_recipient': recipient_controller::delete_recipient(); break;
	}

	class recipient_controller {
		
		public static function add_recipient() {

			$recipient_name = $_POST['recipient_name'];
			$recipient_email = $_POST['recipient_email'];

			$add = recipientDao::addRecipient($recipient_name, $recipient_email);

			if($add) {

				// INSERTING LOG
				require_once('../dao/logDao.php');
				date_default_timezone_set('Asia/Manila');
				$log_date = date('Y-m-d H:i A');
				$log_description = "Added <span class='green'>".$recipient_email."</span> as <span class='red'>Web Inquiry E-mail Recipient</span>";
				$log_account_id = $_SESSION['account_id'];
				logDao::addLog($log_date, $log_description, $log_account_id);

				echo 	'<script>
							alert("You have successfully added a new inquiry recipient.");
							location.href = "../pages/manage-recipients.php";
						</script>';
			 
			} else {

				echo 	'<script>
							alert("Failed to create a new inquiry recipient. Please try again.");
							window.history.back();
						</script>';
			}
			
		} // END OF FUNCTION


		public static function update_recipient() {

			$recipient_name = $_POST['recipient_name'];
			$recipient_email = $_POST['recipient_email'];
			$recipient_status = $_POST['recipient_status'];
			$recipient_id = $_POST['id'];

			$edit = recipientDao::editRecipient($recipient_name, $recipient_email, $recipient_status, $recipient_id);

			if($edit) {

		 		// INSERTING LOG
				require_once('../dao/logDao.php');
				date_default_timezone_set('Asia/Manila');
				$log_date = date('Y-m-d H:i A');
				$log_description = "Updated <span class='green'>".$recipient_name."</span> details";
				$log_account_id = $_SESSION['account_id'];
				logDao::addLog($log_date, $log_description, $log_account_id);

				echo 	'<script>
							alert("The Inquiry Recipient was successfully updated!");
							location.href = "../pages/manage-recipients.php";
						</script>';
				 
			} else {

				echo 	'<script>
							alert("There was an error updating this inquiry recipient. Please try again.");
							window.history.back();
						</script>';
			}

			
		} // END OF FUNCTION


		public static function delete_recipient() {
			$recipients = recipientDao::recipientList(); // list of rewards
			$count = sizeof($recipients);

			if(($access || $_SESSION['account_type'] == 'Administrator') && $count > 1) {
				$id = $_GET['id'];
				$recipient = recipientDao::recipientView($id);
				$recipient_name = $recipient['recipient_name'];
				$recipient_email = $recipient['recipient_email'];
				$delete = recipientDao::deleteRecipient($id);

				if($delete) {

					// INSERTING LOG
					require_once('../dao/logDao.php');
					date_default_timezone_set('Asia/Manila');
					$log_date = date('Y-m-d H:i A');
					$log_description = "Deleted <span class='green'>".$recipient_name."</span> (<span class='red'>".$recipient_email."</span>) from database";
					$log_account_id = $_SESSION['account_id'];
					logDao::addLog($log_date, $log_description, $log_account_id);

					echo 	'<script>
								alert("The Inquiry Recipient was successfully deleted!");
								location.href = "../pages/manage-recipients.php";
							</script>';

				} else {

					echo 	'<script>
								alert("There was an error deleting this inquiry recipient. Please try again.");
								window.history.back();
							</script>';

				}

			} else {

				echo 	'<script>
							alert("You cannot delete this inquiry recipient. There should always be at least one (1) recipient.");
							window.history.back();
						</script>';

			}

		} // END OF FUNCTION	


	} // END OF CLASS


?>