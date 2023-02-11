<?php
require "db_conn.php";

function getResidents(){
    $conn = openCon();
    $command = "SELECT `residentID`,`firstName`,`middleName`,`lastName`,`birthDate`,`image`, p.purokName 
                FROM tbl_residents INNER JOIN tbl_purok as p 
                on tbl_residents.Purok = p.purokID Where tbl_residents.archive = 'false'";
    
     $result = mysqli_query($conn, $command);
     $residents = mysqli_fetch_all($result, MYSQLI_ASSOC);
     mysqli_free_result($result);
     mysqli_close($conn);
     return $residents;
}

?>