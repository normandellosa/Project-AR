<?php
	session_start();
	date_default_timezone_set('Asia/Manila');
	
	require_once('../dao/dao.carousel.php');

	switch ($_GET['action']) {
		case 'add_carousel': carousel_controller::add_carousel(); break;
		case 'update_carousel': carousel_controller::update_carousel(); break;
		case 'delete_carousel': carousel_controller::delete_carousel(); break;
	}

	class carousel_controller {
		
		public static function add_carousel() {
			$carousel_date = date('Y-m-d');

			$carousel_url = $_POST['carousel_url'];
			$carousel_target = $_POST['carousel_target'];

			$carousel_feature_alt = $_POST['carousel_alt'];
			$carousel_id = carousel_dao::selectId();

			if($_FILES["carousel_image"]["tmp_name"] != '' && !empty($carousel_feature_alt)) {

				$now = date('U = Y-m-d H:i:s:u') . rand(1000000,9999999) . $carousel_id;
				$temp = explode(".", $_FILES['carousel_image']["name"]);
				$tempFile = $_FILES['carousel_image']['tmp_name'];
				$extension = end($temp);
				list($w, $h) = getimagesize($_FILES['carousel_image']['tmp_name']);
				$extensions = array("jpg","JPG","jpeg","JPEG");
				
				// Check if file is NOT "jpg" / "JPG" / "jpeg" / "JPEG"
				if (in_array($extension,$extensions) === false) {

					echo 	'<script>
								alert("The Featured Ad was not added due to incorrect image type. Only JPG files are accepted. Please try again.");
								window.history.back();
							</script>';

				} else {

					if($w == '540' && $h == '700') {

						$width  = 320;
					    $height = $h * $width / $w; //get image height in proportion to original size

					    /*============== calculate new image size with ratio ================*/
					    $ratio     = max($width/$w, $height/$h);
					    $h         = ceil($height / $ratio);
					    $x         = ($w - $width / $ratio) / 2;
					    $w         = ceil($width / $ratio);

						$dir       = "../../uploads/";
						$filename  = $carousel_feature_alt;
						$filename = str_replace(' ', '-', $filename);
						$filename = str_replace('%', '', $filename);
					    $name      = $filename . '.' . $extension;

					    $thumb     = $filename . "_th." . $extension;
					    $path      = $dir.$thumb; //thumbnail name with directory

						/*========== read binary data from image file ========*/
						$imgString = file_get_contents($_FILES['carousel_image']['tmp_name']);

						/*============ create image from string ===================*/
						$images = imagecreatefromstring($imgString);
						$tmp = imagecreatetruecolor($width, $height);
						imagecopyresampled($tmp, $images, 0, 0, $x, 0, $width, $height, $w, $h);

						if(!empty($carousel_feature_alt)) { //is carousel alt empty

							$add = carousel_dao::carousel_add($name, $thumb, $carousel_feature_alt, $carousel_date, $carousel_url, $carousel_target); //adding into database

							if ($add) { //inserting into database is true

								//transfer LARGE image in the directory
								move_uploaded_file($_FILES['carousel_image']["tmp_name"],  $dir.$name);

								switch ($_FILES['carousel_image']['type']) {

									case 'image/jpeg':
										imagejpeg($tmp, $path, 100);
										continue;

									case 'image/png':
										imagepng($tmp, $path, 0);
										continue;

									case 'image/gif':
										imagegif($tmp, $path);
										continue;	
								}

								// INSERTING LOG
								require_once('../dao/logDao.php');
								date_default_timezone_set('Asia/Manila');
								$log_date = date('Y-m-d H:i:s A');
								$log_description = "Added <span class='green'>".$name."</span> as new <span class='red'>Featured Ad</span>";
								$log_account_id = $_SESSION['account_id'];
								logDao::addLog($log_date, $log_description, $log_account_id);

								echo 	'<script>
											alert("The Featured Ad was successfully added!");
											location.href = "../pages/manage-carousel.php";
										</script>';
					
							} else { 

								echo 	'<script>
											alert("There was an error adding the Featured Ad into the database. Please try again.");
											window.history.back();
										</script>';

							}

						} else {

							echo 	'<script>
										alert("The Featured Ad Data was not added due to incomplete information. Please try again.");
										window.history.back();
									</script>';

						}

					} else {

						echo 	'<script>
									alert("The Featured Ad Data was not added due to incorrect image dimensions. Please try again.");
									window.history.back();
								</script>';

					}

				}

			} else {
				echo 	'<script>
							alert("There was an error uploading the Featured Ad. Please try again.");
							window.history.back();
						</script>';
			}
			
		} // END OF FUNCTION


		public static function update_carousel() {
			
			$carousel_status = $_POST['carousel_status'];

			$carousel_date = date('Y-m-d');
			// $carousel_date = $_POST['carousel_date'];
			$carousel_id = $_POST['carousel_id'];

			$carousel_url = $_POST['carousel_url'];
			$carousel_target = $_POST['carousel_target'];

			$carousel_feature_alt = $_POST['carousel_alt'];
			
			$carousel_old = $_POST['carousel_image1'];

			$carousel_thumb_old = explode(".",$_POST['carousel_image1']);
			$carousel_thumb_old = $carousel_thumb_old[0] . "_th." . $carousel_thumb_old[1];

			if($_FILES["carousel_image2"]["tmp_name"] != '') {

				$now = date('U = Y-m-d H:i:s:u') . rand(1000000,9999999) . $carousel_id;
				$temp = explode(".", $_FILES['carousel_image2']["name"]);
				$tempFile = $_FILES['carousel_image2']['tmp_name'];
				$extension = end($temp);
				list($w, $h) = getimagesize($_FILES['carousel_image2']['tmp_name']);
				$extensions = array("jpg","JPG","jpeg","JPEG");
				
				// Check if file is NOT "jpg" / "JPG" / "jpeg" / "JPEG"
				if (in_array($extension,$extensions) === false) {

					echo 	'<script>
								alert("The Featured Ad was not updated due to incorrect image type. Only JPG files are accepted. Please try again.");
								window.history.back();
							</script>';

				} else {

					if($w == '540' && $h == '700') {

						$width  = 320;
					    $height = $h * $width / $w; //get image height in proportion to original size

					    /*============== calculate new image size with ratio ================*/
					    $ratio     = max($width/$w, $height/$h);
					    $h         = ceil($height / $ratio);
					    $x         = ($w - $width / $ratio) / 2;
					    $w         = ceil($width / $ratio);

					    $dir       = "../../uploads/";
						$filename  = $carousel_feature_alt;
						$filename  = str_replace(' ', '-', $filename);
						$filename  = str_replace('%', '', $filename);
					    $carousel_new      = $filename . "." . $extension;

					    $carousel_thumb_new     = $filename . "_th." . $extension;
					    $path      = $dir.$carousel_thumb_new; //thumbnail name with directory

						/*========== read binary data from image file ========*/
						$imgString = file_get_contents($_FILES['carousel_image2']['tmp_name']);

						/*============ create image from string ===================*/
						$images = imagecreatefromstring($imgString);
						$tmp = imagecreatetruecolor($width, $height);
						imagecopyresampled($tmp, $images, 0, 0, $x, 0, $width, $height, $w, $h);

						//transfer LARGE image in the directory
						move_uploaded_file($_FILES['carousel_image2']["tmp_name"],  $dir.$carousel_new);

						switch ($_FILES['carousel_image2']['type']) {

							case 'image/jpeg':
								imagejpeg($tmp, $path, 100);
								continue;

							case 'image/png':
								imagepng($tmp, $path, 0);
								continue;

							case 'image/gif':
								imagegif($tmp, $path);
								continue;	
						}

						// INSERTING LOG
						require_once('../dao/logDao.php');
						date_default_timezone_set('Asia/Manila');
						$log_date = date('Y-m-d H:i:s A');
						$log_description = "Added <span class='green'>".$carousel_new."</span> as new <span class='red'>Featured Ad</span>";
						$log_account_id = $_SESSION['account_id'];
						logDao::addLog($log_date, $log_description, $log_account_id);

						echo 	'<script>
									alert("The Featured Ad was successfully updated!");
									location.href = "../pages/manage-carousel.php";
								</script>';

					} else {

						echo 	'<script>
									alert("The Featured Ad Data was not updated due to incorrect image dimensions. Please try again.");
									window.history.back();
								</script>';

					}

				}

			} else {
				$carousel_new = $carousel_old;
				$carousel_thumb_new = $carousel_thumb_old;
			}

			$update = carousel_dao::carousel_update($carousel_new, $carousel_feature_alt, $carousel_thumb_new, $carousel_url, $carousel_status, $carousel_target, $carousel_id);

			if($update) {

				// INSERTING LOG
				require_once('../dao/logDao.php');
				$log_date = date('Y-m-d H:i:s A');
				$log_description = "Updated <span class='green'>".$carousel_feature_alt."</span> (<span class='red'>Featured Ad ID#".$carousel_id."</span>) details";
				$log_account_id = $_SESSION['account_id'];
				logDao::addLog($log_date, $log_description, $log_account_id);

				echo 	'<script>
							alert("This Featured Ad was successfully updated.");
							location.href="../pages/manage-carousel.php";
						</script>';

			}  else {

				echo 	'<script>
							alert("There was an error updating the Featured Ad Data. Please try again.");
							window.history.back();
						</script>';
			}
			
		} // END OF FUNCTION


		public static function delete_carousel() {
			$carousel_id = $_GET['id'];

			$carousel = carousel_dao::carousel_details($carousel_id);

			if (file_exists('../../uploads/'.$carousel['carousel_feature_img'])) {
				unlink('../../uploads/'.$carousel['carousel_feature_img']);
			}
			if (file_exists('../../uploads/'.$carousel['carousel_thumb_img'])) {
				unlink('../../uploads/'.$carousel['carousel_thumb_img']);
			}
			$delete = carousel_dao::carousel_delete($carousel_id);

			if($delete) {

				// INSERTING LOG
				require_once('../dao/logDao.php');
				$log_date = date('Y-m-d H:i:s A');
				$log_description = "Deleted <span class='green'>".$carousel_feature_alt."</span> (<span class='red'>Featured Ad ID#".$rno_id."</span>) and all image/s attached from database";
				$log_account_id = $_SESSION['account_id'];
				logDao::addLog($log_date, $log_description, $log_account_id);

				echo 	'<script>
							alert("The Featured Ad Data was permanently deleted from the database.");
							location.href="../pages/manage-carousel.php";
						</script>';

			} else {

				echo 	'<script>
							alert("There was an error deleting the Featured Ad Data. Please try again.");
							location.href="../pages/manage-carousel.php";
						</script>';
			}

		} // END OF FUNCTION	


	} // END OF CLASS


?>