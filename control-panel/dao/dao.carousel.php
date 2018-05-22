<?php 
include('connectPDO.php');

class carousel_dao {

	public static function carousel_add($carousel_feature_img, $carousel_thumb_img, $carousel_feature_alt, $carousel_date, $carousel_url, $carousel_target) {
		global $db;
		try {
			$sql = "INSERT INTO carousel_tb SET 
			carousel_feature_img = :carousel_feature_img, 
			carousel_thumb_img = :carousel_thumb_img, 
			carousel_feature_alt = :carousel_feature_alt, 
			carousel_date = :carousel_date,
			carousel_url = :carousel_url,
			carousel_target = :carousel_target";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':carousel_feature_img', $carousel_feature_img, PDO::PARAM_STR);
			$stmt->bindParam(':carousel_thumb_img', $carousel_thumb_img, PDO::PARAM_STR);
			$stmt->bindParam(':carousel_feature_alt', $carousel_feature_alt, PDO::PARAM_STR);
			$stmt->bindParam(':carousel_date', $carousel_date, PDO::PARAM_STR);
			$stmt->bindParam(':carousel_url', $carousel_url, PDO::PARAM_STR);
			$stmt->bindParam(':carousel_target', $carousel_target, PDO::PARAM_STR);
			

			return $stmt->execute() ? true : false;

			
		} catch (Exception $e) {
			echo 'Error: ' . $e->getMessage();
		}
	}


	public static function carousel_update($carousel_feature_img, $carousel_feature_alt, $carousel_thumb_img, $carousel_url, $carousel_status, $carousel_target, $carousel_id) {
		global $db;
		try {
			$sql = "UPDATE carousel_tb SET 
			carousel_feature_img = :carousel_feature_img, 
			carousel_feature_alt = :carousel_feature_alt,
			carousel_thumb_img = :carousel_thumb_img,
			carousel_url = :carousel_url,
			carousel_status = :carousel_status,
			carousel_target = :carousel_target 
			WHERE carousel_id = :carousel_id";
			
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':carousel_feature_img', $carousel_feature_img, PDO::PARAM_STR);
			$stmt->bindParam(':carousel_feature_alt', $carousel_feature_alt, PDO::PARAM_STR);
			$stmt->bindParam(':carousel_thumb_img', $carousel_thumb_img, PDO::PARAM_STR);
			$stmt->bindParam(':carousel_url', $carousel_url, PDO::PARAM_STR);
			$stmt->bindParam(':carousel_status', $carousel_status, PDO::PARAM_STR);
			$stmt->bindParam(':carousel_target', $carousel_target, PDO::PARAM_STR);
			$stmt->bindParam(':carousel_id', $carousel_id, PDO::PARAM_INT);
			

			return $stmt->execute() ? true : false;

			
		} catch (Exception $e) {
			echo 'Error: ' . $e->getMessage();
		}
	}


	public static function carousel_delete($carousel_id) {
		global $db;
		try{
			$query = "DELETE FROM carousel_tb WHERE carousel_id = $carousel_id";
			
			$stmt = $db->prepare($query);
			return $stmt->execute() ? true : false;

       } catch(PDOException $exception){ 
        	echo "Error: " . $exception->getMessage();
       } 
		
	}


	public static function carousel_all() {
		global $db;
		$query = "SELECT * FROM carousel_tb";
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

	public static function carouselListLimited($max) {
		global $db;
		$query = "SELECT * FROM carousel_tb WHERE 1 LIMIT $max";
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



	public static function carousel_details($carousel_id) {
		global $db;
		$query = "SELECT * FROM carousel_tb WHERE carousel_id = $carousel_id";
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




	public static function selectId() {

		global $db;
		try{
		$query="SHOW TABLE STATUS LIKE 'carousel_tb'";
		
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

}



 ?>