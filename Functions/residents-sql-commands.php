<?php
require "db_conn.php";

// add condition to filter verified to non-verified residents
function addFilters(){
    $additionalCommands = " and ";
    if(isset($_GET['filter']) && $_GET['filter'] == "unverified"){
        $additionalCommands = $additionalCommands . "r.registrationStatus = 'Unverified'" . addsearchFilter();
        return $additionalCommands;
    }else{
        $additionalCommands = $additionalCommands . "r.registrationStatus = 'Verified'" . addsearchFilter();
        return $additionalCommands;
    }
}
// filter residents to what the user searches
function addsearchFilter(){
    if(isset($_GET['search'])){
        $search = $_GET['search'];
        $additionalCommand = " and CONCAT(firstName,' ', middleName,' ', lastName ) LIKE '%$search%'";
        return $additionalCommand;
    }else{
        return "";
    }
}
// this will run if the search button is clicked
if(isset($_POST['search_button_residents'])){
    $search = $_POST['search_input_residents'];
    $filter = $_POST['search_filter'];
    header("Location: ../Pages/Residents/Residents.php?filter=$filter&search=$search");
	exit();
}
// get the lists of the residents
function getResidents(){
    $conn = openCon();
    $command = "SELECT r.residentID,`firstName`,`middleName`,`lastName`,`birthDate`,`image`, p.purokName
                FROM tbl_residents as r INNER JOIN tbl_purok as p on p.purokID = r.purok
                INNER JOIN tbl_userAccounts as u on u.residentID = r.residentID
                WHERE r.archive = 'false'";
    $command = $command . addFilters(); 
     $result = mysqli_query($conn, $command);
     $residents = mysqli_fetch_all($result, MYSQLI_ASSOC);
     mysqli_free_result($result);
     mysqli_close($conn);
     return $residents;
}
// get the list of puroks
function getPuroks(){
    $conn = openCon();
    $command = "SELECT * FROM `tbl_purok` where `archive` = 'false'";
    $result = mysqli_query($conn, $command);
    $puroks = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
     return $puroks;
}
// navigate to the profile page of the resident
if(isset($_POST["view_resident_button"])){
    $residentID = $_POST["residentID"];
    header("Location: ../Pages/Residents/Profile.php?id=$residentID");
    exit();
}
// get the information of a single resident.
function getSingleResident($residentID){
    $conn = openCon();
    $archive = 'false';
    $command = "SELECT r.residentID, `firstName`, `middleName`, `lastName`, `extension`, p.purokName, `purok`, `birthDate`, `image`,`exactAddress`, `voterStatus`, `sex`, `maritalStatus`, `residentCategory`, `occupation`, `familyHead`, `familyMembers`, `contactNo`, `residenceProof`, u.accountStatus, `registrationStatus`
                from tbl_residents as r INNER JOIN tbl_purok as p on r.purok = p.purokID
                INNER JOIN tbl_userAccounts as u on r.residentID = u.residentID
                where r.residentID = '$residentID' and r.archive = '$archive'";
    $result = mysqli_query($conn, $command);
    $resident = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
    return $resident[0];
}
//function to reject a residents verification
if(isset($_POST['reject'])){
    changeStatus('Rejected');
}
//function to confirm a residents verification
if(isset($_POST['confirm'])){
    changeStatus('Verified');
}
//function to change the registration Status of a resident. either confirmed or rejected
function changeStatus($status){
    $conn = openCon();
    $residentID = $_POST['residentID'];
    $command = "UPDATE `tbl_residents` SET `registrationStatus` = '$status' WHERE `residentID` = '$residentID'";
    mysqli_query($conn, $command);
    mysqli_close($conn);
}
//updating of a residents profile
if(isset($_POST['save-edit-profile'])){
    $conn = openCon();
    $residentID = $_GET['id'];
    $firstName = $_POST['personal-information-firstName'];
    $middleName = $_POST['personal-information-middleName'];
    $lastName = $_POST['personal-information-lastName'];
    $extension = $_POST['personal-information-extension'];
    $birthDate = $_POST['personal-information-birthDate'];
    $sex = $_POST['personal-information-sex'];
    $purok = $_POST['personal-information-purok'];
    $address = $_POST['personal-information-address'];
    $voterStatus = $_POST['personal-information-voterStatus'];
    $maritalStatus = $_POST['personal-information-maritalStatus'];
    $occupation = $_POST['personal-information-occupation'];
    $residentCategory = $_POST['personal-information-residentCategory'];
    if(isset($_POST['personal-information-familyMembers'])){
        $familyMembers = $_POST['personal-information-familyMembers'];
    }else{
        $familyMembers = "";
    }
    $familyHead = $_POST['personal-information-familyHead'];
    $contactNo = $_POST['personal-information-contactNo'];

    $command = "UPDATE `tbl_residents` 
    SET `firstName`='$firstName',
        `middleName`='$middleName',
        `lastName`='$lastName',
        `extension`='$extension',
        `birthDate`='$birthDate', 
        `purok`='$purok',
        `exactAddress`='$address',
        `voterStatus`='$voterStatus',
        `sex`='$sex',
        `maritalStatus`='$maritalStatus',
        `residentCategory`='$residentCategory',
        `occupation`='$occupation',
        `familyHead`='$familyHead',
        `familyMembers`='$familyMembers',
        `contactNo`='$contactNo' 
        WHERE `residentID` = '$residentID'";
    mysqli_query($conn, $command);
    mysqli_close($conn);
}
?>