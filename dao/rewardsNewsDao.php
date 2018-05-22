<?php 
include('connectDB.php');

class RewardsNewsDao {

  public static function rno_Search($title,$subtitle,$details) {

    global $db; 
  
    $query = "SELECT * FROM reward_news_tb JOIN allreward_category_tb ON(category_id=rno_category_fk) WHERE rno_status='active' 
    AND (rno_title LIKE '%$title%' OR rno_subtitle LIKE '%$subtitle%' OR rno_details LIKE '%$details%')";

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

  public static function rno_ListByPromoEndDate($rno_type) {
    global $db;
    $query = "SELECT * FROM reward_news_tb JOIN allreward_category_tb ON(category_id=rno_category_fk) WHERE rno_type = '$rno_type' ORDER BY rno_date_end DESC";
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

	public static function rno_ListByAlphabetical($rno_type,$now) {
		global $db;
		$query = "SELECT *
              FROM reward_news_tb
              JOIN allreward_category_tb ON(category_id=rno_category_fk)
              WHERE rno_type = '$rno_type'
              AND ((rno_date_end IS NULL) or (rno_date_end = '') or (rno_date_end >= '$now'))
              ORDER BY category_code ASC, rno_title ASC";

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

  public static function rno_ListForHomePage($rno_type,$now) {

    global $db; 
  
    $query = "SELECT *
              FROM reward_news_tb
              JOIN allreward_category_tb ON(category_id=rno_category_fk)
              WHERE rno_type = '$rno_type'
              AND rno_status='active'
              AND ((rno_date_end IS NULL) or (rno_date_end = '') or (rno_date_end >= '$now'))
              ORDER BY category_code ASC, rno_title ASC LIMIT 4";
              
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

  public static function rno_View($id) {
    global $db;
    $query = "SELECT * FROM reward_news_tb JOIN allreward_category_tb ON(category_id=rno_category_fk) WHERE rno_id = $id";
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

  public static function rno_Gallery($id) {
    global $db;
    $query = "SELECT * FROM reward_news_tb JOIN allreward_category_tb ON(category_id=rno_category_fk) JOIN images_tb ON(rno_id=rno_id_fk) WHERE rno_type = 'News & Events' AND rno_id = $id ORDER BY image_sequence ASC";
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

  public static function rno_Documents($id) {
    global $db;
    $query = "SELECT * FROM reward_news_tb JOIN allreward_category_tb ON(category_id=rno_category_fk) JOIN documents_tb ON(rno_id=rno_id_fk) WHERE rno_type = 'News & Events' AND rno_id = $id ORDER BY doc_sequence ASC";
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