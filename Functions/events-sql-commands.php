<?php
require "db_conn.php";

    function getSelectCommandByFilter(){
        if(isset($_GET['filter']) and $_GET['filter'] == 'history'){
            return "SELECT * FROM `tbl_events` WHERE `archive` = 'false' AND `Schedule` < CURDATE()";
        }else{
            return "SELECT * FROM `tbl_events` WHERE `archive` = 'false' AND `Schedule` > CURDATE()";
        }
    }
    function searchFilter(){
        if(isset($_GET['search'])){
            $search = $_GET['search'];
            $additionalCommand = " and `eventName` LIKE '%$search%'";
            return $additionalCommand;
        }else{
            return "";
        }
    }

    if(isset($_POST['search_button'])){
        $search = $_POST['search_input'];
        $filter = $_POST['search_filter'];
        header("Location: ../../Pages/Events/Events.php?filter=$filter&search=$search");
        exit();
    }
    function getEvents(){
        $conn = openCon();
        $command = getSelectCommandByFilter();
        $command = $command . searchFilter();
        $result = mysqli_query($conn, $command);
        $events = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        mysqli_close($conn);
        return $events;
    }
    if(isset($_POST['add_event'])){
        $conn = openCon();
        $eventName = $_POST['eventName'];
        $eventDescription = $_POST['eventDescription'];
        $schedule = $_POST['schedule'];
        $command = "INSERT INTO `tbl_events`(`eventName`, `eventDescription`, `Schedule`, `archive`) 
                                     VALUES ('$eventName','$eventDescription','$schedule','false')";
        mysqli_query($conn, $command);
        mysqli_close($conn);
    }
    if(isset($_POST['save_event'])){
        $conn = openCon();
        $eventID = $_POST['eventID'];
        $eventName = $_POST['eventName'];
        $eventDescription = $_POST['eventDescription'];
        $schedule = $_POST['schedule'];
        $command = "UPDATE `tbl_events` SET `eventName`='$eventName',`eventDescription`='$eventDescription',`Schedule`='$schedule' WHERE `eventID` = '$eventID'";
        mysqli_query($conn, $command);
        mysqli_close($conn);
    }
    if(isset($_POST['archive_event'])){
        $conn = openCon();
        $eventID = $_POST['eventID'];
        $command = "UPDATE `tbl_events` SET `archive`='true' WHERE `eventID` = '$eventID'";
        mysqli_query($conn, $command);
        mysqli_close($conn);
    }
?>