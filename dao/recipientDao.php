<?php 

//including the database connection
include('connectDB.php');

class RecipientDao {

	//SHOW ALL THE DATA
	public static function recipientList() {

		global $db;	
	
		$query = "SELECT * FROM recipient_tb WHERE 1";
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
	public static function recipientView($email) {
		global $db;

		$query = "SELECT * FROM recipient_tb WHERE recipient_email = $email";

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