<?php 
include('connectDB.php');

class AllRewardsCategoryDao {

	public static function categoryList() {
		global $db;
		$query = "SELECT * FROM allreward_category_tb WHERE 1 ORDER BY category_name";
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