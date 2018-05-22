<?php 
include('connectPDO.php');

class rewards_dao {

    public static function generate_image_id() {
      include("connectPDO.php");
      try {
        $query = "SHOW TABLE STATUS LIKE 'images_tb'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
          $row = $stmt->fetch(PDO::FETCH_ASSOC);
          return $row['Auto_increment'] - 1;
        } else {
          return false;
        }
      } catch(PDOException $exception){ 
        echo "Error: " . $exception->getMessage();
      }  
    }

    public static function generate_image_sequence($rno_id_fk) {
      include("connectPDO.php");
      try {
        $query = "SELECT max(image_sequence) as max FROM images_tb WHERE rno_id_fk = :rno_id_fk GROUP BY rno_id_fk";

        $stmt = $db->prepare($query);
        $stmt->bindParam(':rno_id_fk', $rno_id_fk, PDO::PARAM_INT);
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

    public static function generate_doc_sequence($rno_id_fk) {
      include("connectPDO.php");
      try {
        $query = "SELECT max(doc_sequence) as max FROM documents_tb WHERE rno_id_fk = :rno_id_fk GROUP BY rno_id_fk";

        $stmt = $db->prepare($query);
        $stmt->bindParam(':rno_id_fk', $rno_id_fk, PDO::PARAM_INT);
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


    public static function update_doc_sequence($doc_sequence, $doc_id) {
      include("connectPDO.php");
      try {
        $query="UPDATE documents_tb SET doc_sequence = :doc_sequence WHERE doc_id = :doc_id";
      
        $stmt = $db->prepare($query);
        $stmt->bindParam(':doc_sequence', $doc_sequence, PDO::PARAM_INT);
        $stmt->bindParam(':doc_id', $doc_id, PDO::PARAM_INT);
      
        return $stmt->execute() ? true : false;
      
     } catch (PDOException $exception) { 
        echo "Error: " . $exception->getMessage();
     } 
    }

    public static function add_doc_details($doc_filename,$doc_title,$doc_sequence,$rno_id_fk) {
      include("connectPDO.php");
      try {
        $query="INSERT INTO documents_tb SET 
                doc_filename = :doc_filename,
                doc_title = :doc_title,
                doc_sequence = :doc_sequence,
                rno_id_fk = :rno_id_fk";
      
        $stmt = $db->prepare($query);
        $stmt->bindParam(':doc_filename', $doc_filename, PDO::PARAM_STR);
        $stmt->bindParam(':doc_title', $doc_title, PDO::PARAM_STR);
        $stmt->bindParam(':doc_sequence', $doc_sequence, PDO::PARAM_INT);
        $stmt->bindParam(':rno_id_fk', $rno_id_fk, PDO::PARAM_INT);
      
        return $stmt->execute() ? true : false;
      
     } catch (PDOException $exception) { 
        echo "Error: " . $exception->getMessage();
     } 
    }

    public static function display_doc_details($doc_id) {
    include("connectPDO.php");
    try {
      $query = "SELECT * FROM documents_tb WHERE doc_id = :doc_id";

      $stmt = $db->prepare($query);
      $stmt->bindParam(':doc_id', $doc_id, PDO::PARAM_INT);
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


    public static function update_documents_info($doc_id, $doc_title) {
      include("connectPDO.php");
      try {
        $query="UPDATE documents_tb SET
            doc_title = :doc_title
            WHERE doc_id = :doc_id";
      
        $stmt = $db->prepare($query);
        $stmt->bindParam(':doc_id', $doc_id, PDO::PARAM_INT);
        $stmt->bindParam(':doc_title', $doc_title, PDO::PARAM_STR);
        
        return $stmt->execute() ? true : false;
      
     } catch (PDOException $exception) { 
        echo "Error: " . $exception->getMessage();
     } 
    }

    public static function delete_document($doc_id) {
      include("connectPDO.php");
      try{

        $query = "DELETE FROM documents_tb WHERE doc_id = :doc_id";

        $stmt = $db->prepare($query);
        $stmt->bindParam(':doc_id', $doc_id, PDO::PARAM_INT);

        return $stmt->execute() ? true : false;
        
      } catch(PDOException $exception){ 
        echo "Error: " . $exception->getMessage();
      }
    }

    public static function add_image_details($image_filename,$image_width,$image_height,$image_caption,$image_sequence,$rno_id_fk) {
      include("connectPDO.php");
      try {
        $query="INSERT INTO images_tb SET 
                image_filename = :image_filename,
                image_width = :image_width,
                image_height = :image_height,
                image_caption = :image_caption,
                image_sequence = :image_sequence,
                rno_id_fk = :rno_id_fk";
      
        $stmt = $db->prepare($query);
        $stmt->bindParam(':image_filename', $image_filename, PDO::PARAM_STR);
        $stmt->bindParam(':image_width', $image_width, PDO::PARAM_INT);
        $stmt->bindParam(':image_height', $image_height, PDO::PARAM_INT);
        $stmt->bindParam(':image_caption', $image_caption, PDO::PARAM_STR);
        $stmt->bindParam(':image_sequence', $image_sequence, PDO::PARAM_INT);
        $stmt->bindParam(':rno_id_fk', $rno_id_fk, PDO::PARAM_INT);
      
        return $stmt->execute() ? true : false;
      
     } catch (PDOException $exception) { 
        echo "Error: " . $exception->getMessage();
     } 
    }

    public static function rno_gallery($rno_id_fk) {
      include("connectPDO.php");
      try {
        $query="SELECT * FROM images_tb WHERE rno_id_fk = :rno_id_fk ORDER BY image_sequence ASC";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':rno_id_fk', $rno_id_fk, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
          $data = array();
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
          }
          return $data;
        } else {
          return false;
        }
      } catch(PDOException $exception) { 
        echo "Error: " . $exception->getMessage();
      }  
    }

    public static function rno_documents($rno_id_fk) {
      include("connectPDO.php");
      try {
        $query="SELECT * FROM documents_tb WHERE rno_id_fk = :rno_id_fk ORDER BY doc_sequence ASC";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':rno_id_fk', $rno_id_fk, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
          $data = array();
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
          }
          return $data;
        } else {
          return false;
        }
      } catch(PDOException $exception) { 
        echo "Error: " . $exception->getMessage();
      }  
    }

	public static function rewards_id() {
		global $db;
		try{
		$query="SHOW TABLE STATUS LIKE 'reward_news_tb'";
		
			$stmt = $db->prepare($query);
			$stmt->execute();
			if($stmt->rowCount() > 0){
           		$row = $stmt->fetch(PDO::FETCH_ASSOC);
           		return $row['Auto_increment'];
        	} else {
            	return false;
        	}

       } catch(PDOException $exception){ 
        	echo "Error: " . $exception->getMessage();
       } 
	}

	public static function rewards_view($id) {
		global $db;
		$query = "SELECT * FROM reward_news_tb JOIN allreward_category_tb ON(category_id=rno_category_fk) WHERE rno_id = $id";
		$stmt = $db->prepare($query);
		$stmt->execute();

		try {

			if($stmt->rowCount() > 0){
        		return $stmt->fetch(PDO::FETCH_ASSOC);

        	} else {

            	return false;
        	}

       } catch(PDOException $exception){ 
        	echo "Error: " . $exception->getMessage();

       }  
	}

	public static function rewards_add($rno_type,$rno_date,$rno_image,$rno_title,$rno_subtitle,$rno_date_start,$rno_date_end,$rno_details,$rno_category_fk,$rno_url) {
		global $db;
		try {
			$sql = "INSERT INTO reward_news_tb SET rno_type = '$rno_type',
												   rno_date = '$rno_date',
												   rno_image = '$rno_image',
												   rno_title = '$rno_title',
												   rno_subtitle = '$rno_subtitle',
												   rno_date_start = '$rno_date_start',
												   rno_date_end = '$rno_date_end',
												   rno_details = '$rno_details',
												   rno_category_fk = '$rno_category_fk',
                           rno_url = '$rno_url'";

			$stmt = $db->prepare($sql);
			$stmt->bindParam(':rno_type', $rno_type, PDO::PARAM_STR);
			$stmt->bindParam(':rno_date', $rno_date, PDO::PARAM_STR);
			$stmt->bindParam(':rno_image', $rno_image, PDO::PARAM_STR);
			$stmt->bindParam(':rno_title', $rno_title, PDO::PARAM_STR);
			$stmt->bindParam(':rno_subtitle', $rno_subtitle, PDO::PARAM_STR);
			$stmt->bindParam(':rno_date_start', $rno_date_start, PDO::PARAM_STR);
			$stmt->bindParam(':rno_date_end', $rno_date_end, PDO::PARAM_STR);
			$stmt->bindParam(':rno_details', $rno_details, PDO::PARAM_STR);
      $stmt->bindParam(':rno_category_fk', $rno_category_fk, PDO::PARAM_INT);
			$stmt->bindParam(':rno_url', $rno_url, PDO::PARAM_STR);


			return $stmt->execute() ? true : false;


			
		} catch (Exception $e) {
			echo 'Error: ' . $e->getMessage();
		}
	}
  


	public static function rewards_update($rno_image,
										 $rno_title,
										 $rno_subtitle,
										 $rno_category_fk,
										 $rno_status,
										 $rno_date_start,
										 $rno_date_end,
										 $rno_details,
										 $rno_id,
										 $rno_url) {
		global $db;
		try {
			$sql = "UPDATE reward_news_tb SET rno_image = :rno_image,
			 								  rno_title = :rno_title,
			 								  rno_subtitle = :rno_subtitle,
			 								  rno_category_fk = :rno_category_fk,
			 								  rno_status = :rno_status,
			 								  rno_date_start = :rno_date_start,
			 								  rno_date_end = :rno_date_end,
			 								  rno_details = :rno_details,
			 								  rno_url = :rno_url
			 								  WHERE rno_id = :rno_id";


			$stmt = $db->prepare($sql);
			$stmt->bindParam(':rno_image', $rno_image, PDO::PARAM_STR);
			$stmt->bindParam(':rno_title', $rno_title, PDO::PARAM_STR);
			$stmt->bindParam(':rno_subtitle', $rno_subtitle, PDO::PARAM_STR);
			$stmt->bindParam(':rno_category_fk', $rno_category_fk, PDO::PARAM_STR);
			$stmt->bindParam(':rno_status', $rno_status, PDO::PARAM_STR);
			$stmt->bindParam(':rno_date_start', $rno_date_start, PDO::PARAM_STR);
			$stmt->bindParam(':rno_date_end', $rno_date_end, PDO::PARAM_STR);
			$stmt->bindParam(':rno_details', $rno_details, PDO::PARAM_STR);
			$stmt->bindParam(':rno_url', $rno_url, PDO::PARAM_STR);
			$stmt->bindParam(':rno_id', $rno_id, PDO::PARAM_INT);
			

			return $stmt->execute() ? true : false;

			
		} catch (Exception $e) {
			echo 'Error: ' . $e->getMessage();
		}
	}

  
	public static function rewards_update_highlight($rno_id, $rno_highlight_image) {
      global $db;
      try {


        $sql = "UPDATE 
                reward_news_tb 
              SET
                rno_highlight_image = NULL
              WHERE 
              rno_highlight_image != ''";
  
        $stmt1 = $db->prepare($sql);
        $stmt1->execute();


        $sql = "UPDATE 
                  reward_news_tb 
                SET
                  rno_highlight_image = :rno_highlight_image
                WHERE 
                  rno_id = :rno_id";


        $stmt = $db->prepare($sql);
        $stmt->bindParam(':rno_highlight_image', $rno_highlight_image, PDO::PARAM_STR);
        $stmt->bindParam(':rno_id', $rno_id, PDO::PARAM_INT);


        return $stmt->execute() ? true : false;


      } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
      }
  }

  
	public static function rewards_view_last_highlight() {
		global $db;
    $sql = "SELECT 
              *
            FROM
              reward_news_tb
            WHERE 
              rno_highlight_image != ''";
		$stmt = $db->prepare($sql);
		$stmt->execute();

		try {

			if($stmt->rowCount() > 0){
        		return $stmt->fetch(PDO::FETCH_ASSOC);

        	} else {

            	return false;
        	}

       } catch(PDOException $exception){ 
        	echo "Error: " . $exception->getMessage();

       }  
  }
  
	public static function rewards_delete($rno_id) {
		global $db;
		try{
		$query = "DELETE FROM reward_news_tb WHERE rno_id = $rno_id";
			
			$stmt = $db->prepare($query);
			return $stmt->execute() ? true : false;

       } catch(PDOException $exception){ 
        	echo "Error: " . $exception->getMessage();
       } 
   }
	
	public static function rewards_all($rno_type) {
		global $db;
		$query = "SELECT * FROM reward_news_tb JOIN allreward_category_tb ON(category_id=rno_category_fk) WHERE rno_type = '$rno_type' ORDER BY rno_date DESC";
		$stmt = $db->prepare($query);
		$stmt->execute();

		try {

			if($stmt->rowCount() > 0){
        		$data = array();
           		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
           			$data[] = $row;
           		}
           		return $data;

        	} else {

            	return false;
        	}

       } catch(PDOException $exception){ 
        	echo "Error: " . $exception->getMessage();

       }  
	}
	
	public static function rewards_listLimited($rno_type,$rno_limit) {
		global $db;
		$query = "SELECT * FROM reward_news_tb JOIN allreward_category_tb ON(category_id=rno_category_fk) WHERE rno_type = '$rno_type' ORDER BY rno_date DESC LIMIT $rno_limit";
		$stmt = $db->prepare($query);
		$stmt->execute();

		try {

			if($stmt->rowCount() > 0){
        		$data = array();
           		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
           			$data[] = $row;
           		}
           		return $data;

        	} else {

            	return false;
        	}

       } catch(PDOException $exception){ 
        	echo "Error: " . $exception->getMessage();

       }  
	}


	

} // END OF CLASS


 ?>