<?php 
include('connectPDO.php');

class gallery_dao {

	// DISPLAY GALLERY DETAILS
    public static function display_gallery_details($image_id) {
		include("connectPDO.php");
		try {
			$query = "SELECT * FROM images_tb WHERE image_id = :image_id";

			$stmt = $db->prepare($query);
			$stmt->bindParam(':image_id', $image_id, PDO::PARAM_INT);
			$stmt->execute();

			if ($stmt->rowCount() > 0) {
		  		return $stmt->fetch(PDO::FETCH_ASSOC);
			} else {
		  		return 0;
			}
		} catch(PDOException $exception){ 
			echo "Error: " . $exception->getMessage();
		}  
    }


    public static function update_image_relation_sequence($image_sequence, $image_id) {
      include("connectPDO.php");
      try {
        $query="UPDATE images_tb SET image_sequence = :image_sequence WHERE image_id = :image_id";
      
        $stmt = $db->prepare($query);
        $stmt->bindParam(':image_sequence', $image_sequence, PDO::PARAM_INT);
        $stmt->bindParam(':image_id', $image_id, PDO::PARAM_INT);
      
        return $stmt->execute() ? true : false;
      
     } catch (PDOException $exception) { 
        echo "Error: " . $exception->getMessage();
     } 
    }


    // UPDATE GALLERY INFO
    public static function update_gallery_info($image_id, $image_caption) {
      include("connectPDO.php");
      try {
        $query="UPDATE images_tb SET
		        image_caption = :image_caption
		        WHERE image_id = :image_id";
      
        $stmt = $db->prepare($query);
        $stmt->bindParam(':image_id', $image_id, PDO::PARAM_INT);
        $stmt->bindParam(':image_caption', $image_caption, PDO::PARAM_STR);
        
        return $stmt->execute() ? true : false;
      
     } catch (PDOException $exception) { 
        echo "Error: " . $exception->getMessage();
     } 
    }


    //=========================== DELETE GALLERY IMAGE =====================
    public static function gallery_delete_image_data($image_id) {
      include("connectPDO.php");
      try{

        $query = "DELETE FROM images_tb WHERE image_id = :image_id";

        $stmt = $db->prepare($query);
        $stmt->bindParam(':image_id', $image_id, PDO::PARAM_INT);

        return $stmt->execute() ? true : false;
        
      } catch(PDOException $exception){ 
        echo "Error: " . $exception->getMessage();
      }
    }

}



 ?>