<?php
require "db_conn.php";

function addFilters(){
    $additionalCommands = " and ";
    if(isset($_GET['filter']) && $_GET['filter'] == "unverified"){
        $additionalCommands = $additionalCommands . "u.accountStatus = 'Inactive'";
        return $additionalCommands;
    }else{
        $additionalCommands = $additionalCommands . "u.accountStatus = 'Active'";
        return $additionalCommands;
    }
}

function getResidents(){
    $conn = openCon();
    $command = "SELECT r.residentID,`firstName`,`middleName`,`lastName`,`birthDate`,`image`, p.purokName
                FROM tbl_residents as r INNER JOIN tbl_purok as p on p.purokID = r.purok
                INNER JOIN tbl_userAccounts as u on u.residentID = r.residentID
                WHERE r.archive = 'false'";
    $command = $command . addFilters(); 
     $result = mysqli_query($conn, $command);
     $residents = mysqli_fetch_all($result, MYSQLI_ASSOC);
     mysqli_free_result($result);
     mysqli_close($conn);
     return $residents;
}

?>