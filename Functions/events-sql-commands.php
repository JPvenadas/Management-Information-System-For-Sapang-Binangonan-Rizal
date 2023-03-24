<?php
require "db_conn.php";
    function getEvents(){
        $conn = openCon();
        $command = "SELECT * FROM `tbl_events` WHERE `archive` = 'false'";
        $result = mysqli_query($conn, $command);
        $events = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        mysqli_close($conn);
        return $events;
    }
?>