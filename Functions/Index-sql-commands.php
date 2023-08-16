<?php
include "db_conn.php";

function getEvents($limit){
    $conn = openCon();
    $command = "SELECT *
                FROM tbl_events
                WHERE `end` < CURDATE()
                AND archive = 'false'
                ORDER BY `end` DESC
                $limit";
    $result = mysqli_query($conn, $command);
    $events = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
    return $events;
}
function getLatestEvents(){
    return getEvents('LIMIT 4');
}
function getAllEvents(){
    return getEvents('');
}
function getSingleEvent(){
    $conn = openCon();
    $id = $_GET['id'];
    $command = "SELECT * FROM `tbl_events` WHERE `eventID` = '$id'";
    $result = mysqli_query($conn, $command);
    $events = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    mysqli_close($conn);
    return $events;
}
function getImages(){
    $conn = openCon();
    $id = $_GET['id'];
    $command = "SELECT * FROM `tbl_eventGallery` WHERE `eventID` = '$id'";
    $result = mysqli_query($conn, $command);
    $images = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
    return $images;
}
function getContacts(){
    $conn = openCon();
    $command = "SELECT * FROM `tbl_contacts` WHERE 1";
    $result = mysqli_query($conn, $command);
    $contacts = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    mysqli_close($conn);
    return $contacts;
}
?>