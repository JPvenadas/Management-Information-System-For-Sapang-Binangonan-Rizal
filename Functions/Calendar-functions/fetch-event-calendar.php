<?php
    require_once "../db_conn.php";
    $conn = openCon();
    $json = array();
    $command = "SELECT `eventID` as 'id', `eventName` as 'title', `start`, `end` FROM `tbl_events` WHERE `archive` = 'false'";
    $result = mysqli_query($conn, $command);
    $eventArray = array();
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($eventArray, $row);
    }
    mysqli_free_result($result);

    mysqli_close($conn);
    echo json_encode($eventArray);
?>