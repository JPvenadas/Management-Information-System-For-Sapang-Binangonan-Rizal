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
?>