<?php

// $host="mysql.build.com.ph";
// $username="allrewards_admin";
// $password="4llR3w@Rd5_pass";
// $db_name="allrewards_db1";

$host="localhost";
$username="allrpzhi_admin";
$password="dTxT1IBnGK28";
$db_name="allrpzhi_webrewards_db";

/*$host="localhost";
$username="root";
$password="";
$db_name="allrewards_db1";*/


try {
    $db = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
} catch(PDOException $exception){
    echo "Connection error: " . $exception->getMessage();
}

?>
