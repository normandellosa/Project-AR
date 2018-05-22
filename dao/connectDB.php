<?php

$host="localhost"; //mysql server
$username="root"; //your mysql username
$password=""; //your mysql password
$db_name="allrpzhi_webrewards_db"; // your database name



try {
    $db = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
}

catch(PDOException $exception){
    echo "Connection error: " . $exception->getMessage();
}

?>
