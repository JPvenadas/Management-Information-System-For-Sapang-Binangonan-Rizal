<?php
function openCon(){

$sname= "localhost";
$unmae= "root";
$password = "";

$db_name = "db_SapangMIS";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$conn) {
	echo "Connection failed!";
}
return $conn;
}
?>