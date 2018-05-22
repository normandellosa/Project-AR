<?php
	session_start();
	date_default_timezone_set('Asia/Manila');
	
	require_once('../dao/dao.rewards.php');

	switch ($_GET['action']) {
		case 'add_rewards': rewards_controller::add_rewards(); break;
		case 'update_rewards': rewards_controller::update_rewards(); break;
		case 'delete_rewards': rewards_controller::delete_rewards(); break;
	}

	class rewards_controller {
		
		public static function add_rewards() {
			$rno_type = 'Rewards';

			$rno_date = date('Y-m-d');
			if (!empty($_POST['rno_date_start']) && isset($_POST['rno_date_start'])) {
				$rno_date_start  = date('Y-m-d',strtotime($_POST['rno_date_start']));
			} else {
				$rno_date_start = '';
			}
			if (!empty($_POST['rno_date_end']) && isset($_POST['rno_date_end'])) {
				$rno_date_end  = date('Y-m-d',strtotime($_POST['rno_date_end']));
			} else {
				$rno_date_end = '';
			}

			$rno_title = $_POST['rno_title'];
			$rno_subtitle = $_POST['rno_subtitle'];
			$rno_details = $_POST['rno_details'];
			$rno_url = $_POST['rno_url'];

			$rno_category_fk = $_POST['rno_category_fk'];
			$rno_id = rewards_dao::rewards_id();

			if($_FILES["rno_image"]["tmp_name"] != '' && !empty($rno_subtitle)) {

				$now = date('U = Y-m-d H:i:s:u') . rand(1000000,9999999) . $rno_id;
				$temp = explode(".", $_FILES['rno_image']["name"]);
				$tempFile = $_FILES['rno_image']['tmp_name'];
				$extension = end($temp);
				list($w, $h) = getimagesize($_FILES['rno_image']['tmp_name']);
				$extensions = array("jpg","JPG","jpeg","JPEG");
				
				// Check if file is NOT "jpg" / "JPG" / "jpeg" / "JPEG"
				if (in_array($extension,$extensions) === false) {

					echo 	'<script>
								alert("The Reward was not added due to incorrect image type. Only JPG files are accepted. Please try again.");
								window.history.back();
							</script>';

				} else {

					if($w == '300') {

						$dir = "../../uploads/"; //directory of the images
						$filename = $rno_title;
						$filename = str_replace(' ', '-', $filename);
						$filename = str_replace('%', '', $filename);
						$rno_image = $filename . "." . $extension;
						$targetFile = $dir . $rno_image;
					    move_uploaded_file($tempFile, $targetFile);

						$add = rewards_dao::rewards_add($rno_type,$rno_date,$rno_image,$rno_title,$rno_subtitle,$rno_date_start,$rno_date_end,$rno_details,$rno_category_fk,$rno_url);

					    if ($add) {

				    		// INSERTING LOG
							require_once('../dao/logDao.php');
							$log_date = date('Y-m-d H:i:s A');
							$log_description = "Added <span class='green'>".$rno_title."</span> as new <span class='red'>Reward</span>";
							$log_account_id = $_SESSION['account_id'];
							logDao::addLog($log_date, $log_description, $log_account_id);

							echo 	'<script>
										alert("The Reward was successfully added!");
										location.href = "../pages/manage-rewards.php";
									</script>';
					    } else {

							echo 	'<script>
										alert("There was an error adding the Reward into the database. Please try again.");
										window.history.back();
									</script>';
					    }

					} else {

						echo 	'<script>
									alert("The Reward Data was not added due to incorrect image dimensions. Please try again.");
									window.history.back();
								</script>';
					}
				}

			} else if (empty($rno_subtitle)) {

				echo 	'<script>
							alert("The Reward Data was not added due to incomplete information. Please try again.");
							window.history.back();
						</script>';
			}
			
		} // END OF FUNCTION


		public static function update_rewards() {
			
			$rno_id = $_POST['rno_id'];
			$rno_title = $_POST['rno_title'];
			$rno_url = $_POST['rno_url'];
			
			$rno_image_dir_old = "../../uploads/"; //directory of rewards images
			$rno_image_old = end(explode("/",$_POST['rewards_image1']));

			if($_FILES["rewards_image2"]["tmp_name"] != '') {

				$now = date('U = Y-m-d H:i:s:u') . rand(1000000,9999999) . $rno_id;
				$temp = explode(".", $_FILES['rewards_image2']["name"]);
				$tempFile = $_FILES['rewards_image2']['tmp_name'];
				$extension = end($temp);
				list($w, $h) = getimagesize($_FILES['rewards_image2']['tmp_name']);
				$extensions = array("jpg","JPG","jpeg","JPEG");

				// Check if file is NOT "jpg" / "JPG" / "jpeg" / "JPEG"
				if (in_array($extension,$extensions) === false) {

					echo 	'<script>
								alert("The Reward was not updated due to incorrect image type. Only JPG files are accepted. Please try again.");
								window.history.back();
							</script>';
					return;

				} else {

					if($w == '300') {

						$dir = "../../uploads/"; //directory of the images
						$filename = $rno_title;
						$filename = str_replace(' ', '-', $filename);
						$filename = str_replace('%', '', $filename);
						$rno_image_new = $filename . "." . $extension;
						$targetFile = $dir . $rno_image_new;
					    move_uploaded_file($tempFile, $targetFile);

					    // INSERTING LOG
						require_once('../dao/logDao.php');
						$log_date = date('Y-m-d H:i:s A');
						$log_description = "Replaced <span class='green'>".$rno_title."</span> (<span class='red'>Reward ID#".$rno_id."</span>)";
						$log_account_id = $_SESSION['account_id'];
						logDao::addLog($log_date, $log_description, $log_account_id);

					} else {

						echo 	'<script>
									alert("The Reward Data was not updated due to incorrect image dimensions. Please try again.");
									window.history.back();
								</script>';
						return;
					}
				}

			} else {

				$rno_image_new = $rno_image_old;

			}

			$rno_subtitle = $_POST['rno_subtitle'];
			$rno_details = $_POST['rno_details'];
			$rno_category_fk = $_POST['rno_category_fk'];
			$rno_status = $_POST['rno_status'];

			if (!empty($_POST['rno_date_start']) && isset($_POST['rno_date_start'])) {
				$rno_date_start  = date('Y-m-d',strtotime($_POST['rno_date_start']));
			} else {
				$rno_date_start = '';
			}
			if (!empty($_POST['rno_date_end']) && isset($_POST['rno_date_end'])) {
				$rno_date_end  = date('Y-m-d',strtotime($_POST['rno_date_end']));
			} else {
				$rno_date_end = '';
			}

			$update = rewards_dao::rewards_update($rno_image_new,$rno_title,$rno_subtitle,$rno_category_fk,$rno_status,$rno_date_start,$rno_date_end,$rno_details,$rno_id,$rno_url);

			if($update) {

				// INSERTING LOG
				require_once('../dao/logDao.php');
				$log_date = date('Y-m-d H:i:s A');
				$log_description = "Updated <span class='green'>".$rno_title."</span> (<span class='red'>Reward ID#".$rno_id."</span>) details";
				$log_account_id = $_SESSION['account_id'];
				logDao::addLog($log_date, $log_description, $log_account_id);

				echo 	'<script>
							alert("This Reward Data was successfully updated.");
							location.href="../pages/manage-rewards.php";
						</script>';

			}  else {

				echo 	'<script>
							alert("There was an error updating the Reward Data. Please try again.");
							window.history.back();
						</script>';
			}
			
		} // END OF FUNCTION


		public static function delete_rewards() {

			$rno_id = $_GET['id'];
			$rnoList = rewards_dao::rewards_view($rno_id);

			if (file_exists('../../uploads/'.$rnoList['rno_image'])) {
				unlink('../../uploads/'.$rnoList['rno_image']);
			}
			$delete = rewards_dao::rewards_delete($rno_id);

			if($delete) {

				// INSERTING LOG
				require_once('../dao/logDao.php');
				$log_date = date('Y-m-d H:i:s A');
				$log_description = "Deleted <span class='green'>".$rno_title."</span> (<span class='red'>Reward ID#".$rno_id."</span>) and all image/s attached from database";
				$log_account_id = $_SESSION['account_id'];
				logDao::addLog($log_date, $log_description, $log_account_id);

				echo 	'<script>
							alert("The Reward Data was permanently deleted from the database.");
							location.href="../pages/manage-rewards.php";
						</script>';

			} else {

				echo 	'<script>
							alert("There was an error deleting the Reward Data. Please try again.");
							location.href="../pages/manage-rewards.php";
						</script>';
			}

		} // END OF FUNCTION	


	} // END OF CLASS


?>