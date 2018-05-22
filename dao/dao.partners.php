<?php 
include('connectDB.php');

class partners_dao {



  public static function partners_details($id) {
    global $db;
    $query = "SELECT * FROM partners_tb as partners JOIN allreward_category_tb as category ON(partners.rno_category_fk = category.category_id) WHERE partners_ID = $id";
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


  public static function partners_list() {
    include("connectDB.php");
    $query = "SELECT * FROM partners_tb as partners JOIN allreward_category_tb as category ON(partners.rno_category_fk = category.category_id) ORDER BY partners_location ASC, partners_cityprovince ASC, partners_name ASC";
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


  public static function partners_locations() {
    include("connectDB.php");
    $query = "SELECT * FROM partners_tb WHERE partners_location = 0 GROUP BY partners_cityprovince ORDER BY partners_cityprovince";
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