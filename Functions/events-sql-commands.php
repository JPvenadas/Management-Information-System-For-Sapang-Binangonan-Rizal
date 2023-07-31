<?php
require "db_conn.php";
require "insertLogs.php";

    function getSelectCommandByFilter(){
        if(isset($_GET['filter']) and $_GET['filter'] == 'history'){
            return "SELECT * FROM `tbl_events` WHERE `archive` = 'false' AND `start` < CURDATE()";
        }else{
            return "SELECT * FROM `tbl_events` WHERE `archive` = 'false' AND `start` >= CURDATE()";
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
        $eventName = validate($_POST['eventName']);
        $eventDescription = validate($_POST['eventDescription']);
        $start = $_POST['start'];
        $end = $_POST['end'];
        $command = "INSERT INTO `tbl_events`(`eventName`, `eventDescription`, `start`,`end`, `archive`) 
                                     VALUES ('$eventName','$eventDescription','$start','$end','false')";
        mysqli_query($conn, $command);
        $addedPersonnelID = mysqli_insert_id($conn);
        mysqli_close($conn);
        insertLogs("added an event with ID: $addedPersonnelID");
    }
    if(isset($_POST['save_event'])){
        $conn = openCon();
        $eventID = validate($_POST['eventID']);
        $eventName = validate($_POST['eventName']);
        $eventDescription = validate($_POST['eventDescription']);
        $start = $_POST['start'];
        $end = $_POST['end'];
        $command = "UPDATE `tbl_events` SET `eventName`='$eventName',`eventDescription`='$eventDescription',`start`='$start', `end`='$end' WHERE `eventID` = '$eventID'";
        mysqli_query($conn, $command);
        mysqli_close($conn);
        insertLogs("Updated an event with ID: $eventID");
    }
    if(isset($_POST['archive_event'])){
        $conn = openCon();
        $eventID = validate($_POST['eventID']);
        $command = "UPDATE `tbl_events` SET `archive`='true' WHERE `eventID` = '$eventID'";
        mysqli_query($conn, $command);
        mysqli_close($conn);
        insertLogs("Archived an event with ID: $eventID");
        header("Location: ../../Pages/Events/Events.php");
        
    }
    if(isset($_POST['announce_event'])){
        $start = date("F, d", strtotime($_POST['start']));
        $end = $_POST['end'];
        $description = $_POST['eventDescription'];
        $name = $_POST['eventName'];
        $message = "Good Day Kabarangay! our Barangay will be having $name starting this $start, ($description)";
        header("Location: ../../Pages/Announcements/Announcements.php?message=$message");
        exit();
    }
    if(isset($_FILES['coverPhoto'])){
        $conn = openCon();
        $coverPhoto = $_FILES['coverPhoto'];
        $id = $_GET['id'];
        $image = $_FILES["coverPhoto"]["tmp_name"];
        $imageContent = addslashes(file_get_contents($image));
        $command = "UPDATE `tbl_events` SET `coverPhoto`='$imageContent' WHERE `eventID` = '$id'";
        mysqli_query($conn, $command);
        mysqli_close($conn);
    }
    if(isset($_POST['delete_photo'])){
        $conn = openCon();
        $id = $_POST['photo_id'];
        $command = "DELETE FROM `tbl_eventGallery` WHERE `ID` = '$id'";
        mysqli_query($conn, $command);
        mysqli_close($conn);
    }
?>