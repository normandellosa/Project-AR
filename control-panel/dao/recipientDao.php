<?php 
include('connectPDO.php');

class RecipientDao {

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


	public static function recipientView($recipient_id) {
		global $db;
		$query = "SELECT * FROM recipient_tb WHERE recipient_id = :recipient_id ORDER BY recipient_name ASC";
		$stmt = $db->prepare($query);
		$stmt->bindParam(':recipient_id', $recipient_id, PDO::PARAM_INT);
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


	public static function addRecipient($recipient_name, $recipient_email) {
		global $db;
		try {
			$sql = "INSERT INTO recipient_tb SET recipient_name = :recipient_name, 
												   recipient_email = :recipient_email";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':recipient_name', $recipient_name, PDO::PARAM_STR);
			$stmt->bindParam(':recipient_email', $recipient_email, PDO::PARAM_STR);

			return $stmt->execute() ? true : false;

			
		} catch (Exception $e) {
			echo 'Error: ' . $e->getMessage();
		}
	}


	public static function editRecipient($recipient_name, $recipient_email, $recipient_status, $recipient_id) {
		global $db;
		try {
			$sql = "UPDATE recipient_tb SET recipient_name = :recipient_name, recipient_email = :recipient_email, recipient_status = :recipient_status WHERE recipient_id = :recipient_id";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':recipient_name', $recipient_name, PDO::PARAM_STR);
			$stmt->bindParam(':recipient_email', $recipient_email, PDO::PARAM_STR);
			$stmt->bindParam(':recipient_status', $recipient_status, PDO::PARAM_STR);
			$stmt->bindParam(':recipient_id', $recipient_id, PDO::PARAM_INT);

			return $stmt->execute() ? true : false;

			
		} catch (Exception $e) {
			echo 'Error: ' . $e->getMessage();
		}
	}


	public static function deleteRecipient($recipient_id) {
		global $db;
		try{
		$query = "DELETE FROM recipient_tb WHERE recipient_id = :recipient_id";
			
			$stmt = $db->prepare($query);
			$stmt->bindParam(':recipient_id', $recipient_id, PDO::PARAM_INT);
			return $stmt->execute() ? true : false;

       } catch(PDOException $exception){ 
        	echo "Error: " . $exception->getMessage();
       } 
		
	}

}


 ?>