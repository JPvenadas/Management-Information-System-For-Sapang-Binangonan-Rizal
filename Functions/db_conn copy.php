<?php
function openCon(){

$sname= "localhost";
$unmae= "id20649330_root";
$password = "z4Lr4@jm<)I$]N-b";

$db_name = "id20649330_db_sapangmis";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$conn) {
	echo "Connection failed!";
}
return $conn;
}


// function to validate user input
function validate($data){
    $data = str_replace("'", "", $data);
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>