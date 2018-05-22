<?php 
include('connectPDO.php');

class AccessDao {

	public static function accessPage($account_id_fk, $permission_id_fk) {
		global $db;
		$query = "SELECT * FROM user_access_tb WHERE account_id_fk = :account_id_fk AND permission_id_fk = :permission_id_fk";
		$stmt = $db->prepare($query);

		$stmt->bindParam(':account_id_fk', $account_id_fk, PDO::PARAM_STR);
		$stmt->bindParam(':permission_id_fk', $permission_id_fk, PDO::PARAM_STR);
		
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


	public static function accessByGroup($permission_category) {
		global $db;
		$query = "SELECT * FROM permission_tb WHERE permission_category = :permission_category AND permission_status = 'Active'";
		$stmt = $db->prepare($query);
		$stmt->bindParam(':permission_category', $permission_category, PDO::PARAM_STR);
	
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

	public static function createAccess($account_id_fk, $permission_id_fk) {
		global $db;
		try {
			$sql = "INSERT INTO user_access_tb SET account_id_fk = :account_id_fk, 
												   permission_id_fk = :permission_id_fk";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':account_id_fk', $account_id_fk, PDO::PARAM_STR);
			$stmt->bindParam(':permission_id_fk', $permission_id_fk, PDO::PARAM_STR);
			
			

			return $stmt->execute() ? true : false;

			
		} catch (Exception $e) {
			echo 'Error: ' . $e->getMessage();
		}
	}


	public static function deleteAccess($account_id_fk) {
		global $db;
		try{
		$query = "DELETE FROM user_access_tb WHERE account_id_fk = :account_id_fk";
			
			$stmt = $db->prepare($query);
			$stmt->bindParam(':account_id_fk', $account_id_fk, PDO::PARAM_INT);
			return $stmt->execute() ? true : false;

       } catch(PDOException $exception){ 
        	echo "Error: " . $exception->getMessage();
       } 
		
	}

}


 ?>