<?php
	session_start();
	date_default_timezone_set('Asia/Manila');
	
	require_once('../dao/dao.rewards.php');

	switch ($_REQUEST['action']) {
		case 'add_newsevents': newsevents_controller::add_newsevents(); break;
		case 'update_newsevents': newsevents_controller::update_newsevents(); break;
		case 'delete_newsevents': newsevents_controller::delete_newsevents(); break;
		case 'highlights_newsevents': newsevents_controller::highlights_newsevents(); break;
	}

	class newsevents_controller {
		
		public static function add_newsevents() {
			$rno_type = 'News & Events';

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

			$rno_category_fk = $_POST['rno_category_fk'];
			$rno_id = rewards_dao::rewards_id();

			$rno_url = $_POST['rno_url'];

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
								alert("The News/Event Article was not added due to incorrect image type. Only JPG files are accepted. Please try again.");
								window.history.back();
							</script>';

				} else {

					if($w == '300') {

						$dir = "../../uploads/"; //directory of the images
						
						$filename = $rno_title;
						$filename = str_replace(' ', '-', $filename);
						$filename = str_replace('%', '', $filename);
						$filename = $filename . '.' . $extension;
						$rno_image = $filename;
						$targetFile = $dir . $rno_image;
					    move_uploaded_file($tempFile, $targetFile);

					    /*echo "rno_type: ".$rno_type." || ";
					    echo "rno_date: ".$rno_date." || ";
					    echo "rno_image: ".$rno_image." || ";
					    echo "rno_title: ".$rno_title." || ";
					    echo "rno_subtitle: ".$rno_subtitle." || ";
					    echo "rno_date_start: ".$rno_date_start." || ";
					    echo "rno_date_end: ".$rno_date_end." || ";
					    echo "rno_details: ".$rno_details." || ";
					    echo "rno_category_fk: ".$rno_category_fk." || ";
					    echo "rno_url: ".$rno_url." || ";

					    return;*/

					    $add = rewards_dao::rewards_add($rno_type,$rno_date,$rno_image,$rno_title,$rno_subtitle,$rno_date_start,$rno_date_end,$rno_details,$rno_category_fk,$rno_url);

					    if ($add) {

				    		// INSERTING LOG
							require_once('../dao/logDao.php');
							$log_date = date('Y-m-d H:i:s A');
							$log_description = "Added <span class='green'>".$rno_title."</span> as new <span class='red'>News/Event Article</span>";
							$log_account_id = $_SESSION['account_id'];
							logDao::addLog($log_date, $log_description, $log_account_id);

							echo 	'<script>
										alert("The News/Event Article was successfully added!");
										location.href = "../pages/manage-newsevents.php";
									</script>';
					    } else {

							echo 	'<script>
										alert("There was an error adding the News/Event Article into the database. Please try again.");
										window.history.back();
									</script>';
					    }

					} else {

						echo 	'<script>
									alert("The News/Event Article Data was not added due to incorrect image dimensions. Please try again.");
									window.history.back();
								</script>';
					}
				}

			} else if (empty($rno_subtitle)) {

				echo 	'<script>
							alert("The News/Event Article Data was not added due to incomplete information. Please try again.");
							window.history.back();
						</script>';
			}
			
		} // END OF FUNCTION


		public static function update_newsevents() {
			
			$rno_id = $_POST['rno_id'];
			$rno_title = $_POST['rno_title'];
			
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
								alert("The News/Event Article was not updated due to incorrect image type. Only JPG files are accepted. Please try again.");
								window.history.back();
							</script>';
					return;

				} else {

					if($w == '300') {

						$dir = "../../uploads/"; //directory of the images
						$filename = $rno_title;
						$filename = str_replace(' ', '-', $filename);
						$filename = str_replace('%', '', $filename);
						$filename = $filename . '.' . $extension;
						$rno_image_new = $filename;
						$targetFile = $dir . $rno_image_new;
					    move_uploaded_file($tempFile, $targetFile);

					    // INSERTING LOG
						require_once('../dao/logDao.php');
						$log_date = date('Y-m-d H:i:s A');
						$log_description = "Replaced <span class='green'>".$rno_title."</span> (<span class='red'>News/Event Article ID#".$rno_id."</span>)";
						$log_account_id = $_SESSION['account_id'];
						logDao::addLog($log_date, $log_description, $log_account_id);

					} else {

						echo 	'<script>
									alert("The News/Event Article Data was not updated due to incorrect image dimensions. Please try again.");
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
			$rno_url = $_POST['rno_url'];

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
				$log_description = "Updated <span class='green'>".$rno_title."</span> (<span class='red'>News/Event Article ID#".$rno_id."</span>) details";
				$log_account_id = $_SESSION['account_id'];
				logDao::addLog($log_date, $log_description, $log_account_id);

				echo 	'<script>
							alert("This News/Event Article Data was successfully updated.");
							location.href="../pages/manage-newsevents.php";
						</script>';

			}  else {

				echo 	'<script>
							alert("There was an error updating the News/Event Article Data. Please try again.");
							window.history.back();
						</script>';
			}
			
		} // END OF FUNCTION


		public static function delete_newsevents() {

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
				$log_description = "Deleted <span class='green'>".$rno_title."</span> (<span class='red'>News/Event Article ID#".$rno_id."</span>) and all image/s attached from database";
				$log_account_id = $_SESSION['account_id'];
				logDao::addLog($log_date, $log_description, $log_account_id);

				echo 	'<script>
							alert("The News/Event Article Data was permanently deleted from the database.");
							location.href="../pages/manage-newsevents.php";
						</script>';

			} else {

				echo 	'<script>
							alert("There was an error deleting the News/Event Article Data. Please try again.");
							location.href="../pages/manage-newsevents.php";
						</script>';
			}

		} // END OF FUNCTION	

		public static function highlights_newsevents() {
			
			header('Content-type: application/json');
			if (!isset($_POST['rnoList']) || !isset($_POST['rnoList']))
			{
				echo json_encode(['errCode' => 1, 'message' =>'Article and Higlight Image are required.']);
				return;
			}

			$rnoList = (isset($_POST['rnoList']) ? $_POST['rnoList'] : NULL);;
			$rno_title = (isset($_POST['rnoList_file']) ? $_POST['rnoList_file'] : NULL);
			
			$rno_data = rewards_dao::rewards_view($rnoList);
			$rewards_view_last_highlight = rewards_dao::rewards_view_last_highlight();
			$rewards_update_highlight = rewards_dao::rewards_view($rno_data['rno_id']);
			
			// return;
			
			if($_FILES["rnoList_file"]["tmp_name"] != '') {

				$temp = explode(".", $_FILES['rnoList_file']["name"]);
				$tempFile = $_FILES['rnoList_file']['tmp_name'];
				$extension = end($temp);
				$filename = $rno_data['rno_title'];
				$filename = str_replace(' ', '-', $filename);
				$filename = str_replace('%', '', $filename);
				$filename = $filename. '-highlight-banner' . '.' . $extension;

				list($w, $h) = getimagesize($_FILES['rnoList_file']['tmp_name']);
				$extensions = array("jpg","JPG","png","PNG");

				// Check if file is NOT "jpg" / "JPG" / "jpeg" / "JPEG"
				if (in_array($extension,$extensions) === false) {

					echo 	'<script>
								alert("The News/Event Article was not updated due to incorrect image type. Only JPG files are accepted. Please try again.");
								window.history.back();
							</script>';
					return;

				} else {

					// if($w == '300') {

						$dir = "../../uploads/"; //directory of the images
						$targetFile = $dir . $filename;
						unlink('../../uploads/'.$rewards_view_last_highlight['rno_highlight_image']);
					    move_uploaded_file($tempFile, $targetFile);
						
						$rewards_update_highlight = rewards_dao::rewards_update_highlight($rnoList, $filename);
						
						$rewards_view_last_highlight = rewards_dao::rewards_view_last_highlight();
						echo json_encode(['errCode' => 0, 'image' => $dir.$rewards_view_last_highlight['rno_highlight_image'], 'message' => 'Highligh image successfully updated.']);
						return;
					    // INSERTING LOG
						// require_once('../dao/logDao.php');
						// $log_date = date('Y-m-d H:i:s A');
						// $log_description = "Replaced <span class='green'>".$rno_title."</span> (<span class='red'>News/Event Article ID#".$rno_id."</span>)";
						// $log_account_id = $_SESSION['account_id'];
						// logDao::addLog($log_date, $log_description, $log_account_id);

					// } else {

					// 	echo 	'<script>
					// 				alert("The News/Event Article Data was not updated due to incorrect image dimensions. Please try again.");
					// 				window.history.back();
					// 			</script>';
					// 	return;
					// }
				}

			} else {

				$rno_image_new = $rno_image_old;

			}


			// $rno_subtitle = $_POST['rno_subtitle'];
			// $rno_details = $_POST['rno_details'];
			// $rno_category_fk = $_POST['rno_category_fk'];
			// $rno_status = $_POST['rno_status'];
			// $rno_url = $_POST['rno_url'];

			// if (!empty($_POST['rno_date_start']) && isset($_POST['rno_date_start'])) {
			// 	$rno_date_start  = date('Y-m-d',strtotime($_POST['rno_date_start']));
			// } else {
			// 	$rno_date_start = '';
			// }
			// if (!empty($_POST['rno_date_end']) && isset($_POST['rno_date_end'])) {
			// 	$rno_date_end  = date('Y-m-d',strtotime($_POST['rno_date_end']));
			// } else {
			// 	$rno_date_end = '';
			// }

			// $update = rewards_dao::rewards_update($rno_image_new,$rno_title,$rno_subtitle,$rno_category_fk,$rno_status,$rno_date_start,$rno_date_end,$rno_details,$rno_id,$rno_url);

			// if($update) {

			// 	// INSERTING LOG
			// 	require_once('../dao/logDao.php');
			// 	$log_date = date('Y-m-d H:i:s A');
			// 	$log_description = "Updated <span class='green'>".$rno_title."</span> (<span class='red'>News/Event Article ID#".$rno_id."</span>) details";
			// 	$log_account_id = $_SESSION['account_id'];
			// 	logDao::addLog($log_date, $log_description, $log_account_id);

			// 	echo 	'<script>
			// 				alert("This News/Event Article Data was successfully updated.");
			// 				location.href="../pages/manage-newsevents.php";
			// 			</script>';

			// }  else {

			// 	echo 	'<script>
			// 				alert("There was an error updating the News/Event Article Data. Please try again.");
			// 				window.history.back();
			// 			</script>';
			// }
			
		} // END OF FUNCTION

	} // END OF CLASS



?>