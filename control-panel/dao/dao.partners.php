<?php 
include('connectPDO.php');

class partners_dao {


	public static function partners_list() {
		include("connectPDO.php");
		$query = "SELECT * FROM partners_tb as partners
		JOIN allreward_category_tb as category ON(partners.rno_category_fk = category.category_id)
		ORDER BY partners_name ASC";
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



	public static function partners_add(
	$partners_status,
	$rno_category_fk,
	$partners_name,
	$partners_location,
	$partners_cityprovince,
	$partners_address,
	$partners_email,
	$partners_tel) {
		
		include("connectPDO.php");
		try {
			$sql = "INSERT INTO partners_tb SET 
			partners_status = :partners_status,
			rno_category_fk = :rno_category_fk,
			partners_name = :partners_name,
			partners_location = :partners_location,
			partners_cityprovince = :partners_cityprovince,
			partners_address = :partners_address,
			partners_email = :partners_email,
			partners_tel = :partners_tel";


			$stmt = $db->prepare($sql);
			$stmt->bindParam(':partners_status', $partners_status, PDO::PARAM_STR);
			$stmt->bindParam(':rno_category_fk', $rno_category_fk, PDO::PARAM_STR);
			$stmt->bindParam(':partners_name', $partners_name, PDO::PARAM_STR);
			$stmt->bindParam(':partners_location', $partners_location, PDO::PARAM_INT);
			$stmt->bindParam(':partners_cityprovince', $partners_cityprovince, PDO::PARAM_STR);
			$stmt->bindParam(':partners_address', $partners_address, PDO::PARAM_STR);
			$stmt->bindParam(':partners_email', $partners_email, PDO::PARAM_STR);
			$stmt->bindParam(':partners_tel', $partners_tel, PDO::PARAM_STR);

			return $stmt->execute() ? true : false;

			
		} catch (Exception $e) {
			echo 'Error: ' . $e->getMessage();
		}
	}



	public static function partners_update(
	$partners_status,
	$rno_category_fk,
	$partners_name,
	$partners_location,
	$partners_cityprovince,
	$partners_address,
	$partners_email,
	$partners_tel,
	$partners_ID) {
		
		include("connectPDO.php");
		try {
			$sql = "UPDATE partners_tb SET 
			partners_status = :partners_status,
			rno_category_fk = :rno_category_fk,
			partners_name = :partners_name,
			partners_location = :partners_location,
			partners_cityprovince = :partners_cityprovince,
			partners_address = :partners_address,
			partners_email = :partners_email,
			partners_tel = :partners_tel
			WHERE partners_ID = :partners_ID
			";


			$stmt = $db->prepare($sql);
			$stmt->bindParam(':partners_status', $partners_status, PDO::PARAM_STR);
			$stmt->bindParam(':rno_category_fk', $rno_category_fk, PDO::PARAM_STR);
			$stmt->bindParam(':partners_name', $partners_name, PDO::PARAM_STR);
			$stmt->bindParam(':partners_location', $partners_location, PDO::PARAM_INT);
			$stmt->bindParam(':partners_cityprovince', $partners_cityprovince, PDO::PARAM_STR);
			$stmt->bindParam(':partners_address', $partners_address, PDO::PARAM_STR);
			$stmt->bindParam(':partners_email', $partners_email, PDO::PARAM_STR);
			$stmt->bindParam(':partners_tel', $partners_tel, PDO::PARAM_STR);
			$stmt->bindParam(':partners_ID', $partners_ID, PDO::PARAM_INT);

			return $stmt->execute() ? true : false;

			
		} catch (Exception $e) {
			echo 'Error: ' . $e->getMessage();
		}
	}



	public static function partners_details($partners_ID) {
		include("connectPDO.php");
		$query = "SELECT * FROM partners_tb as partners 
		JOIN allreward_category_tb as category ON(partners.rno_category_fk = category.category_id)
		WHERE partners.partners_ID = :partners_ID";
		$stmt = $db->prepare($query);

		$stmt->bindParam(':partners_ID', $partners_ID, PDO::PARAM_INT);
		
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


	public static function partners_delete($partners_ID) {
		include("connectPDO.php");
		try{
		$query = "DELETE FROM partners_tb WHERE partners_ID = :partners_ID";
			
			$stmt = $db->prepare($query);
			$stmt->bindParam(':partners_ID', $partners_ID, PDO::PARAM_INT);
			return $stmt->execute() ? true : false;

       } catch(PDOException $exception){ 
        	echo "Error: " . $exception->getMessage();
       } 
   }


	

} // END OF CLASS


 ?>