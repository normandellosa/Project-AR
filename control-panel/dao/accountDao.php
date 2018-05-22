<?php
include('connectPDO.php'); 
class AccountDao {


	public static function checkLogin($account_username, $account_password) {
		global $db;
		$query = "SELECT * FROM accounts_tb WHERE account_username = :account_username AND account_password = :account_password";
		$stmt = $db->prepare($query);

		$stmt->bindParam(':account_username', $account_username, PDO::PARAM_STR);
		$stmt->bindParam(':account_password', $account_password, PDO::PARAM_STR);
		
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


	public static function accountDetail($account_id) {
		global $db;
		$query = "SELECT * FROM accounts_tb WHERE account_id = :account_id";
		$stmt = $db->prepare($query);

		$stmt->bindParam(':account_id', $account_id, PDO::PARAM_INT);
		
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
		$query="SHOW TABLE STATUS LIKE 'accounts_tb'";
		
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


	public static function addAccount($account_username,
							  $account_password,
							  $account_email,
							  $account_display_name,
							  $account_type) {
		global $db;
		try {
			$sql = "INSERT INTO accounts_tb SET account_username = :account_username, 
												   account_password = :account_password, 
												   account_email = :account_email,
												   account_display_name = :account_display_name,
												   account_type = :account_type";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(':account_username', $account_username, PDO::PARAM_STR);
			$stmt->bindParam(':account_password', $account_password, PDO::PARAM_STR);
			$stmt->bindParam(':account_email', $account_email, PDO::PARAM_STR);
			$stmt->bindParam(':account_display_name', $account_display_name, PDO::PARAM_STR);
			$stmt->bindParam(':account_type', $account_type, PDO::PARAM_STR);
			

			return $stmt->execute() ? true : false;

			
		} catch (Exception $e) {
			echo 'Error: ' . $e->getMessage();
		}
	}


	public static function editAccount($account_username,
									   $account_email,
									   $account_display_name,
									   $account_type,
									   $account_id) {
		global $db;
		try {
			$sql = "UPDATE accounts_tb SET account_username = :account_username,
										   account_email = :account_email,
										   account_display_name = :account_display_name,
										   account_type = :account_type
										   WHERE account_id = :account_id";
			$stmt = $db->prepare($sql);
			
			$stmt->bindParam(':account_username', $account_username, PDO::PARAM_STR);
			$stmt->bindParam(':account_email', $account_email, PDO::PARAM_STR);
			$stmt->bindParam(':account_display_name', $account_display_name, PDO::PARAM_STR);
			$stmt->bindParam(':account_type', $account_type, PDO::PARAM_STR);
			$stmt->bindParam(':account_id', $account_id, PDO::PARAM_INT);
			

			return $stmt->execute() ? true : false;

			
		} catch (Exception $e) {
			echo 'Error: ' . $e->getMessage();
		}
	}

	public static function editPassword($account_password, $account_id) {
		global $db;
		try {
			$sql = "UPDATE accounts_tb SET account_password = :account_password WHERE account_id = :account_id";
			$stmt = $db->prepare($sql);
			
			$stmt->bindParam(':account_password', $account_password, PDO::PARAM_STR);
			$stmt->bindParam(':account_id', $account_id, PDO::PARAM_INT);
			

			return $stmt->execute() ? true : false;

			
		} catch (Exception $e) {
			echo 'Error: ' . $e->getMessage();
		}
	}


	



	/*Show all accounts*/
	public static function accountList() {
		global $db;
		$query = "SELECT * FROM accounts_tb WHERE 1";
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

	/*Prevent other users even other Administrators to see ID#1*/
	public static function accountListLimited() {
		global $db;
		$query = "SELECT * FROM accounts_tb WHERE account_id <> 1";
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

	public static function accountAdminList() {
		global $db;
		$query = "SELECT * FROM accounts_tb WHERE account_type = 'Administrator'";
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


	public static function deleteAccount($account_id) {
		global $db;
		try {
			$sql = "DELETE FROM accounts_tb WHERE account_id = :account_id";
			$stmt = $db->prepare($sql);
			
			$stmt->bindParam(':account_id', $account_id, PDO::PARAM_INT);
			

			return $stmt->execute() ? true : false;

			
		} catch (Exception $e) {
			echo 'Error: ' . $e->getMessage();
		}
	}

}

 ?>