<?php 
include('connectPDO.php');

class LogDao {

	public static function addLog($log_date, $log_description, $log_account_id) {
		global $db;
		try {
			$sql = "INSERT INTO log_tb SET log_date = :log_date, 
										   log_description = :log_description, 
										   log_account_id = :log_account_id";

			$stmt = $db->prepare($sql);
			$stmt->bindParam(':log_date', $log_date, PDO::PARAM_STR);
			$stmt->bindParam(':log_description', $log_description, PDO::PARAM_STR);
			$stmt->bindParam(':log_account_id', $log_account_id, PDO::PARAM_STR);
			

			return $stmt->execute() ? true : false;

			
		} catch (Exception $e) {
			echo 'Error: ' . $e->getMessage();
		}
	}


	public static function logsList() {
		global $db;
		$query = "SELECT * FROM log_tb WHERE 1";
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

}

 ?>