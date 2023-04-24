<?php 
require "db_conn.php";
require "insertLogs.php";

function getAnnouncements(){
    $conn = openCon();
    $command = "SELECT CONCAT(r.firstName, ' ', LEFT(r.middleName, 1),' ', r.lastName, ' ', r.extension) as `fullName`, `message`, `datePosted`, `postedBy`, `recepients` 
    FROM `tbl_announcements` as a inner JOIN tbl_residents as r on r.residentID = postedBy ";
    $result = mysqli_query($conn, $command);
    $announcements = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
    return $announcements;
}
if(isset($_POST['send_message'])){
    $conn = openCon();
    $message = $_POST['message'];
    $postedBy = $_SESSION['residentID'];
    $recepients = "";

    //if the filter is in custom, 
    if($_POST['filter_value'] == "Custom"){
        if(isset($_POST['purok'])){
            $purok = $_POST['purok'];
            $recepients = $recepients . "($purok) ";
        }if(isset($_POST['age'])){
            $age = $_POST['age'];
            $recepients = $recepients . "($age) ";
        }if(isset($_POST['sex'])){
            $sex = $_POST['sex'];
            $recepients = $recepients . "($sex) ";
        }
    }else{
        $recepients = $_POST['filter_value'];
    }
    $command = "INSERT INTO `tbl_announcements`(`message`, `postedBy`, `recepients`) 
                                        VALUES ('$message','$postedBy','$recepients')";
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
        $purok = $_POST['purok'];
        $command = $command . " and `purok` = '$purok'";
    }
    if(isset($_POST['sex'])){
        $sex = $_POST['sex'];
        $command = $command . " and `sex` = '$sex'";
    }
    if(isset($_POST['age'])){
        $age = $_POST['age'];
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
    $sex = $user['sex'];
    $age = $user['age'];
    $command = "SELECT CONCAT(r.firstName, ' ', LEFT(r.middleName, 1),' ', r.lastName, ' ', r.extension) as `fullName`, `message`, `datePosted`, `postedBy`, `recepients`
     FROM `tbl_announcements` as a inner join `tbl_residents` as r on a.postedBy = r.residentID WHERE `recepients` LIKE '%All Residents%' or `recepients` LIKE '%$sex%' or `recepients` LIKE '%$age%'";
    if($user['is_employee'] == true){
        $command = $command . " or `recepients` LIKE '%All Employees%'";
    }
    if($user['familyHead'] == true){
        $command = $command . " or `recepients` LIKE '%Family Heads%'";
    }
    $result = mysqli_query($conn, $command);
    $announcements = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
    return $announcements;
}
?>