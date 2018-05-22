<?php 
include('connectDB.php');

class hotline_dao {


	public static function hotline_list() {
		include("connectDB.php");
		$query = "SELECT * FROM allreward_hotline_tb";
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


	

	public static function hotline_details($hotline_ID) {
		include("connectDB.php");
		$query = "SELECT * FROM allreward_hotline_tb WHERE hotline_ID = :hotline_ID";
		$stmt = $db->prepare($query);
		$stmt->bindParam(':hotline_ID', $hotline_ID, PDO::PARAM_INT);
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


	

} // END OF CLASS


 ?>