<?php 
include('connectPDO.php');

class hotline_dao {


	public static function hotline_list() {
		include("connectPDO.php");
		$query = "SELECT * FROM allreward_hotline_tb";
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


	public static function hotline_add($hotline_title, $hotline_number) {
		
		include("connectPDO.php");
		try {
			$sql = "INSERT INTO allreward_hotline_tb SET 
			hotline_title = :hotline_title,
			hotline_number = :hotline_number";


			$stmt = $db->prepare($sql);
			$stmt->bindParam(':hotline_title', $hotline_title, PDO::PARAM_STR);
			$stmt->bindParam(':hotline_number', $hotline_number, PDO::PARAM_STR);

			return $stmt->execute() ? true : false;

			
		} catch (Exception $e) {
			echo 'Error: ' . $e->getMessage();
		}
	}


	public static function hotline_update($hotline_title, $hotline_number, $hotline_ID) {
		
		include("connectPDO.php");
		try {
			$sql = "UPDATE allreward_hotline_tb SET 
			hotline_title = :hotline_title,
			hotline_number = :hotline_number
			WHERE hotline_ID = :hotline_ID";


			$stmt = $db->prepare($sql);
			$stmt->bindParam(':hotline_title', $hotline_title, PDO::PARAM_STR);
			$stmt->bindParam(':hotline_number', $hotline_number, PDO::PARAM_STR);
			$stmt->bindParam(':hotline_ID', $hotline_ID, PDO::PARAM_INT);

			return $stmt->execute() ? true : false;

			
		} catch (Exception $e) {
			echo 'Error: ' . $e->getMessage();
		}
	}



	public static function hotline_details($hotline_ID) {
		include("connectPDO.php");
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


	public static function hotline_delete($hotline_ID) {
		include("connectPDO.php");
		try{
		$query = "DELETE FROM allreward_hotline_tb WHERE hotline_ID = :hotline_ID";
			
			$stmt = $db->prepare($query);
			$stmt->bindParam(':hotline_ID', $hotline_ID, PDO::PARAM_INT);
			return $stmt->execute() ? true : false;

       } catch(PDOException $exception){ 
        	echo "Error: " . $exception->getMessage();
       } 
   }



	/*



	

	*/


	

} // END OF CLASS


 ?>