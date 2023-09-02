<?php

function getAccess(){
    $conn = openCon();
    $userName = $_SESSION['username'];
    $command = "SELECT * FROM `tbl_accessControl` WHERE `userName` = '$userName'";
    $result = mysqli_query($conn, $command);
    $userAccess = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
    return $userAccess[0];
}
?>