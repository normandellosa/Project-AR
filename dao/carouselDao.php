<?php 

//including the database connection
include('connectDB.php');

class CarouselDao {

	//SHOW ALL THE DATA
	public static function carouselList() {

		global $db;	
	
		$query = "SELECT * FROM carousel_tb WHERE 1 AND carousel_status='active' ORDER BY carousel_date DESC";
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



	//SHOW SPECIFIC DATA USING INIQUE ID
	public static function carouselView($id) {
		global $db;

		$query = "SELECT * FROM carousel_tb WHERE carousel_id = $id";

		$stmt = $db->prepare($query);
		// $stmt->bindParam(':row_id', $id, PDO::PARAM_INT);
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


}


 ?>