<?php
	header('Content-Type: application/json');
	session_start();
	error_reporting(E_ALL & ~E_STRICT & ~E_NOTICE);
	date_default_timezone_set("Asia/Manila");

	/*FUNCTIONS*/
	switch ($_GET['action']) {
		case 'upload_gallery'  : uploader::upload_gallery(); break;
		case 'save_gallery'    : uploader::save_gallery(); break;
	}

	class uploader {
		public static function upload_gallery() {
			$dir           = '../../uploads/';

			if (!empty($_FILES['gallery_image'])) {
				$now        = date('U = Y-m-d H:i:s:u') . rand(1000000,9999999);
				$tempName   = $_FILES['gallery_image']['name'][0];
				$ext        = "." . pathinfo($tempName, PATHINFO_EXTENSION);
				$tempFile   = $_FILES['gallery_image']['tmp_name'][0];
				$tempInfo   = getimagesize($tempFile);
				$w          = $tempInfo[0];
				$h          = $tempInfo[1];
				$img        = sha1($now) . $ext;
				$targetFile = $dir . $img;

				move_uploaded_file($tempFile, $targetFile);

				echo json_encode(array('img'=>$img,'imgW'=>$w,'imgH'=>$h));
				return;
			}

		} // END OF FUNCTION

		public static function save_gallery() {
			require_once('../dao/dao.rewards.php');

			$rno_id_fk = $_GET['id'];

			$items         = sizeof($_POST['gallery_filename']);

			$imageSequence = rewards_dao::generate_image_sequence($rno_id_fk);
			$sequence      = $imageSequence['max'];

			if (empty($sequence)) {
				$sequence = 0;
			}

			for ($i=0;$i<$items;$i++) {
				$image_file = $_POST['gallery_filename'][$i];
				$image_width = $_POST['gallery_fileW'][$i];
				$image_height = $_POST['gallery_fileH'][$i];
				$image_caption = $_POST['gallery_caption'][$i];

				$sequence++;

				/*echo "image_file: ".$image_file."\n";
				echo "image_width: ".$image_width."\n";
				echo "image_height: ".$image_height."\n";
				echo "image_caption: ".$image_caption."\n";
				echo "sequence: ".$sequence."\n";
				echo "rno_id_fk: ".$rno_id_fk."\n";
				return;*/

				$add_image_details = rewards_dao::add_image_details($image_file,$image_width,$image_height,$image_caption,$sequence,$rno_id_fk);
			}

			header('Location: ' . $_SERVER['HTTP_REFERER']);

		}


		
	} // END OF CLASS

?>