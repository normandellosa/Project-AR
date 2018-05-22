<?php
	header('Content-Type: application/json');
	session_start();
	error_reporting(E_ALL & ~E_STRICT & ~E_NOTICE);
	date_default_timezone_set("Asia/Manila");

	/*FUNCTIONS*/
	switch ($_GET['action']) {
		case 'upload_documents' : uploader::upload_documents(); break;
		case 'save_documents' : uploader::save_documents(); break;
		case 'update_documents_info' : uploader::update_documents_info(); break;
		case 'delete_documents' : uploader::delete_documents(); break;
		case 'sort_documents' : uploader::sort_documents(); break;
	}

	class uploader {
		public static function upload_documents() {
			$dir           = '../../uploads/';

			if (!empty($_FILES['document_file'])) {
				$now        = date('U = Y-m-d H:i:s:u') . rand(1000000,9999999);
				$tempName   = $_FILES['document_file']['name'][0];
				$ext        = "." . pathinfo($tempName, PATHINFO_EXTENSION);
				$tempFile   = $_FILES['document_file']['tmp_name'][0];
				$file       = sha1($now) . $ext;
				$targetFile = $dir . $file;

				move_uploaded_file($tempFile, $targetFile);

				echo json_encode(array('doc'=>$file));
				return;
			}

		} // END OF FUNCTION

		public static function save_documents() {
			require_once('../dao/dao.rewards.php');

			$rno_id_fk = $_GET['id'];
			$items = $_GET['limit'];

			
			$docSequence = rewards_dao::generate_doc_sequence($rno_id_fk);
			$doc_sequence = $docSequence['max'];

			if (empty($doc_sequence)) {
				$doc_sequence = 0;
			}

			/*echo "items: ".$items."\n";
			echo "\n";*/

			for ($i=0;$i<$items;$i++) {
				$doc_filename = $_POST['document_filename'][$i];
				$doc_title = $_POST['document_title'][$i];

				$doc_sequence++;

				/*echo "document_filename: ".$doc_filename."\n";
				echo "document_title: ".$doc_title."\n";
				echo "doc_sequence: ".$doc_sequence."\n";
				echo "rno_id_fk: ".$rno_id_fk."\n";*/

				$add_doc_details = rewards_dao::add_doc_details($doc_filename,$doc_title,$doc_sequence,$rno_id_fk);
			}

			//return;

			header('Location: ' . $_SERVER['HTTP_REFERER']);

		}


		public static function update_documents_info() {
			require_once('../dao/dao.rewards.php');

			$doc_id=$_POST['id'];
			$doc_title=$_POST['doc_title'];

			$update_documents_info=rewards_dao::update_documents_info($doc_id, $doc_title);

		} // END OF FUNCTION


		public static function delete_documents() {
			require_once('../dao/dao.rewards.php');

			$doc_id=$_POST['id'];



			$display_doc_details = rewards_dao::display_doc_details($doc_id);
			$doc_filename=$display_doc_details['doc_filename'];
			$doc_directory='../../uploads/';

			// DELETE IMAGE FILE
			if(!empty($doc_filename)) {
				if(file_exists($doc_directory.$doc_filename)){
					unlink($doc_directory.$doc_filename);
				} 
			}

			$delete_document=rewards_dao::delete_document($doc_id);
			
			if($delete_document == true) {
				
				echo 'true';
			} else {
				echo 'false';
			}




		} // END OF FUNCTION


		// GALLERY SORTING
		public static function sort_documents() {
			require_once('../dao/dao.rewards.php');

			if(!empty($_POST['doc'])) :
				$x=1;
				foreach ($_POST['doc'] as $id) :
					$sequence=$x++;
					$update_doc_sequence=rewards_dao::update_doc_sequence($sequence, $id);
				endforeach;
			endif;	
		} // END OF FUNCTION


		
	} // END OF CLASS

?>