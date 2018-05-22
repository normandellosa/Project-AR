<?php
	session_start();
	date_default_timezone_set('Asia/Manila');
	
	switch ($_GET['action']) {
		case 'display_gallery_details' : manageGallery::display_gallery_details(); break;
		case 'sort_gallery'            : manageGallery::sort_gallery(); break;
		case 'update_gallery_info'     : manageGallery::update_gallery_info(); break;
		case 'delete_image'            : manageGallery::delete_image(); break;
	}

	class manageGallery {
		
		//DISPLAY GALLERY DETAILS
		public static function display_gallery_details() {
			require_once('../dao/dao.gallery.php');
			$id=$_GET['id'];
			$display_gallery_details=gallery_dao::display_gallery_details($id);

			if($display_gallery_details == true) :
				echo json_encode($display_gallery_details);
			endif;

		} // END OF FUNCTION


		// GALLERY SORTING
		public static function sort_gallery() {
			require_once('../dao/dao.gallery.php');
			if(!empty($_POST['item'])) :
				$x=1;
				foreach ($_POST['item'] as $id) :
					$sequence=$x++;
					$update_image_relation_sequence=gallery_dao::update_image_relation_sequence($sequence, $id);
				endforeach;
			endif;	
		} // END OF FUNCTION


		public static function update_gallery_info() {
			require_once('../dao/dao.gallery.php');

			$image_id=$_POST['id'];
			$image_caption=$_POST['caption'];

			$update_gallery_info=gallery_dao::update_gallery_info($image_id, $image_caption);

		} // END OF FUNCTION


		public static function delete_image() {
			require_once('../dao/dao.gallery.php');
			$image_id=$_POST['id'];
			$display_gallery_details = gallery_dao::display_gallery_details($image_id);
			$image_filename=$display_gallery_details['image_filename'];
			$image_directory='../../uploads/';
			// DELETE IMAGE FILE
			if(!empty($image_filename)) {
				if(file_exists($image_directory.$image_filename)){
					unlink($image_directory.$image_filename);
				} 
			}

			$gallery_delete_image_data=gallery_dao::gallery_delete_image_data($image_id);
			
			if($gallery_delete_image_data == true) {
				
				echo 'true';
			} else {
				echo 'false';
			}




		} // END OF FUNCTION


	} // END OF CLASS


?>