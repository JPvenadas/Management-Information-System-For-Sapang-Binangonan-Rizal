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


// function to validate user input
function validate($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>