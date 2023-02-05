<?php
require "db_conn.php";

if(isset($_POST['submitUserName'])){
    $conn = openCon();
    $userName = validate($_POST['userName']);
    $command = "SELECT u.userName, u.accountStatus, r.contactNo 
                from tbl_userAccounts AS u 
                INNER JOIN tbl_residents as r 
                ON r.residentID = u.residentID";
    $result = mysqli_query($conn, $command);
    $userName = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_close($conn);

    if (mysqli_num_rows($result) === 1) {

    }else{
        header("Location: ../../Pages/Recovery/AccountRecovery.php?error=No such Username");
	    exit();
    }
}

?>