<?php
$host = "localhost";
$port = 3306;
$user = "root";
$pass = "";
$db = "test";

try {
  $conn = new PDO("mysql:host=" . $host . ";port=" . $port . ";dbname=" . $db, $user, $pass);;
} catch(PDOException $e) {
  echo "". $e->getMessage() ."";
}
?>