<?php 
require "db_conn.php";
require "insertLogs.php";

function getAnnouncements(){
    $conn = openCon();
    $command = "SELECT announcementID, CONCAT(r.firstName, ' ', LEFT(r.middleName, 1), ' ', r.lastName, ' ', r.extension) AS `fullName`, r.image AS `image`, `announcementType`, `message`, `datePosted`, `postedBy`, `recepients` 
    FROM `tbl_announcements` AS a
    INNER JOIN tbl_residents AS r ON r.residentID = postedBy " . addFilters() . " ORDER BY `datePosted` DESC";
    $result = mysqli_query($conn, $command);
    $announcements = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
    return $announcements;
}
function addFilters(){
    if(!isset($_GET['filter']) || $_GET['filter'] == "recent"){
        $command = "";
    }elseif($_GET['filter'] == "today"){
        $filter = $_GET['filter'];
        $command = " where DATE(`datePosted`) = CURDATE() ";
    }elseif($_GET['filter'] == "yesterday"){
        $filter = $_GET['filter'];
        $command = " where DATE(`datePosted`) = DATE(CURDATE() + INTERVAL 1 DAY) ";
    }
    else{
        $filter = $_GET['filter'];
        $formattedDate = date('Y-m-d', strtotime($filter));
        $command = " where DATE(`datePosted`) = '$formattedDate' ";
    }
    return $command;
}

if(isset($_POST['send_message'])){
    $conn = openCon();
    $message = validate($_POST['message']);
    $postedBy = validate($_SESSION['residentID']);
    $type = validate($_POST['type']);
    date_default_timezone_set('Asia/Manila');
    $date = date('Y-m-d H:i:s');
    $recepients = "";

    //if the filter is in custom, 
    if($_POST['filter_value'] == "Custom"){
        if(isset($_POST['purok'])){
            $purok = validate($_POST['purok']);
            $recepients = $recepients . "($purok) ";
        }if(isset($_POST['age'])){
            $age = validate($_POST['age']);
            $recepients = $recepients . "($age) ";
        }if(isset($_POST['sex'])){
            $sex = validate($_POST['sex']);
            $recepients = $recepients . "($sex) ";
        }
    }else{
        $recepients = validate($_POST['filter_value']);
    }
    $command = "INSERT INTO `tbl_announcements`(`message`,`announcementType`, `postedBy`, `recepients`, `datePosted`) 
                                        VALUES ('$message','$type','$postedBy','$recepients', '$date')";
    mysqli_query($conn, $command);
    $addedPersonnelID = mysqli_insert_id($conn);
    mysqli_close($conn);
    insertLogs("sent an announcement with ID: $addedPersonnelID");
}
function getPuroks(){
    $conn = openCon();
    $command = "SELECT * FROM `tbl_purok` where `archive` = 'false'";
    $result = mysqli_query($conn, $command);
    $puroks = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
     return $puroks;
}
function getFilteredContacts(){
    if($_POST['filter_value'] == "All Residents"){
        return getContacts("SELECT CONCAT(`firstName`,' ',LEFT(`middleName`, 1),' ',`lastName`) as Fullname, RIGHT(`contactNo`, 9) as contactNo FROM `tbl_residents` where archive = 'false'");
    }elseif($_POST['filter_value'] == "All Employees"){
        return getContacts("SELECT CONCAT(`firstName`,' ',LEFT(`middleName`, 1),' ',`lastName`) as Fullname, RIGHT(`contactNo`, 9) as contactNo FROM `tbl_residents` as r INNER JOIN tbl_employees as e on r.residentID = e.residentID where r.archive = 'false' and e.archive = 'false';");
    }elseif($_POST['filter_value'] == "Family Heads"){
        return getContacts("SELECT CONCAT(`firstName`,' ',LEFT(`middleName`, 1),' ',`lastName`) as Fullname, RIGHT(`contactNo`, 9) as contactNo FROM `tbl_residents` WHERE archive = 'false' and `familyHead` = 'Yes';");
    }elseif($_POST['filter_value'] == "Custom"){
        return getContactsCustom();
    }
}

function getContacts($sqlCommand){
    $conn = openCon();
    $command = $sqlCommand;
    $result = mysqli_query($conn, $command);
    $contact = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
     return $contact;
}
function getContactsCustom(){
    $conn = openCon();
    $command = "SELECT CONCAT(`firstName`,' ',LEFT(`middleName`, 1),' ',`lastName`) as Fullname, RIGHT(`contactNo`, 9) as contactNo FROM `tbl_residents` where archive = 'false'";
    if(isset($_POST['purok'])){ 
        $purok = validate($_POST['purok']);
        $command = $command . " and `purok` = '$purok'";
    }
    if(isset($_POST['sex'])){
        $sex = validate($_POST['sex']);
        $command = $command . " and `sex` = '$sex'";
    }
    if(isset($_POST['age'])){
        $age = validate($_POST['age']);
        if($age == "Youths"){
            $command = $command . " and DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(`birthDate`, '%Y') < 18";
        }elseif($age == "Adults"){
            $command = $command . " and DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(`birthDate`, '%Y') >= 18  
                                    and DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(`birthDate`, '%Y') <= 59";
        }elseif($age == "Seniors"){
            $command = $command . " and DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(`birthDate`, '%Y') >= 60";
        }
    }
    $result = mysqli_query($conn, $command);
    $contact = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
    return $contact;
}
// resident side announcements
function getResidentUser(){
    $conn = openCon();
    $residentID = $_SESSION['residentID'];
    $command = "SELECT 
                    purok, sex, 
                    CASE 
                    WHEN FLOOR(DATEDIFF(CURDATE(), birthDate) / 365.25) < 18 THEN 'Youths'
                    WHEN FLOOR(DATEDIFF(CURDATE(), birthDate) / 365.25) >= 18 
                    and FLOOR(DATEDIFF(CURDATE(), birthDate) / 365.25) < 60 THEN 'Adults'
                    ELSE 'Seniors' END AS age,
                    CASE 
                    WHEN e.residentID IS NOT NULL and e.archive = 'false' THEN true 
                    ELSE false END AS is_employee,
                    CASE
                    WHEN r.familyHead = 'Yes' THEN true
                    else false END as familyHead
                FROM tbl_residents as r
                LEFT JOIN tbl_employees as e ON r.residentID = e.residentID
                Where r.residentID = '$residentID'";
    $result = mysqli_query($conn, $command);
    $user = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
    return $user[0];
}
function getAnnouncementsResident(){
    $conn = openCon();
    $user = getResidentUser();
    $sex = validate($user['sex']);
    $age = validate($user['age']);
    $command = "SELECT announcementID, CONCAT(r.firstName, ' ', LEFT(r.middleName, 1), ' ', r.lastName, ' ', r.extension) AS `fullName`, r.image AS `image`, `announcementType`, `message`, `datePosted`, `postedBy`, `recepients`
     FROM `tbl_announcements` as a inner join `tbl_residents` as r on a.postedBy = r.residentID WHERE `recepients` LIKE '%All Residents%' or `recepients` LIKE '%$sex%' or `recepients` LIKE '%$age%'";
    if($user['is_employee'] == true){
        $command = $command . " or `recepients` LIKE '%All Employees%'";
    }
    if($user['familyHead'] == true){
        $command = $command . " or `recepients` LIKE '%Family Heads%'";
    }
    $command = $command . "  ORDER BY `datePosted` DESC";
    $result = mysqli_query($conn, $command);
    $announcements = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
    return $announcements;
}
?>