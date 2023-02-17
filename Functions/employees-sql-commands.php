<?php
require "db_conn.php";

// function to get the employees list and display it on the screen
function getEmployees(){
    $conn = openCon();
    $command =  "SELECT CONCAT(r.firstName, ' ', r.middleName, ' ', r.lastName) as fullName, e.employeeID, r.image, r.residentID, e.position, p.positionName, `committee`, c.committeeID, `termStart`, `termEnd`, `termStatus` 
    FROM `tbl_employees` as e 
    INNER JOIN tbl_positions as p on e.position = p.positionID
    INNER JOIN tbl_residents as r on e.residentID = r.residentID
    INNER JOIN tbl_committee as c on e.committee = c.committeeID
    WHERE e.archive = 'false'";


    //command to be added if there were another operation involved ex. Searching or filtering
    $additionalCommand = "";
    if (isset($_GET['search'])){
        $search = $_GET['search'];
        $additionalCommand = " and CONCAT(firstName,' ', middleName,' ', lastName ) LIKE '%$search%';";
    }
    
    $command = $command . $additionalCommand;
     $result = mysqli_query($conn, $command);
     $employees = mysqli_fetch_all($result, MYSQLI_ASSOC);
     mysqli_free_result($result);
     mysqli_close($conn);
     return $employees;
}

//function to redirect with the new link with search parameter, if the search button is clicked
if(isset($_POST["search_button_employees"])){
   $searchInput = $_POST["search_input_employees"];
    header("Location: ../Modules/employees/employees.php?search=$searchInput");
}

function getResidents(){
    $conn = openCon();
    $command = "SELECT `residentID`, CONCAT(`firstName`,' ',`middleName`,' ',`lastName`) as 'fullName' from tbl_residents where `archive` = 'false'";
    $result = mysqli_query($conn, $command);
    $residents = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
    return $residents;
}
function getPositions(){
    $conn = openCon();
    $command = "SELECT `positionID`,`positionName` FROM `tbl_positions` WHERE `archive` = 'false'";
    $result = mysqli_query($conn, $command);
    $positions = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
    return $positions;
}
function existingResidents(){
    $conn = openCon();
    $residentsID = $_POST['residentsID'];
    $command = "SELECT residentsID from tbl_employees as WHERE `residentsID` = '$residentsID' and `termStatus` = 'Active'";
    $result = mysqli_query($conn, $command);
    if(mysqli_num_rows($result) === 1){
        mysqli_close($conn);
        return false;
    }else{
        mysqli_close($conn);
        return true;
    }
}
if(isset($_POST['add_employee'])){
    if(existingResidents()){
        $conn = openCon();
        $residentsID = $_POST['residentsID'];
        $position = $_POST['position'];
        $termstart = $_POST['termstart'];
        $termend = $_POST['termend'];
        $termStatus = 'Active';
        $signiture = $_FILES["signiture"]["tmp_name"];
        $signitureContent = addslashes(file_get_contents($signiture));
        $command = "INSERT INTO tbl_employees as(`residentsID`, `position`, `termstart`, `termend`, `termStatus`, `Signiture`) 
                                    VALUES ('$residentsID','$position','$termstart','$termend','$termStatus','$signitureContent')";
        mysqli_query($conn, $command);
        $addedemployeeID = mysqli_insert_id($conn);
        mysqli_close($conn);
    }else{
        header("Location: ../../Modules/employees/employees.php?error=the selected resident is already a employee");
        exit();
    }
}
if(isset($_POST['edit_employee'])){
    $conn = openCon();
    $employeeID = $_POST['employeeID'];
    $residentsID = $_POST['residentsID'];
    $position = $_POST['position'];
    $termstart = $_POST['termstart'];
    $termend = $_POST['termend'];
    $command = "";
    if(isset($_FILES['signiture'])){
        $signiture = $_FILES["signiture"]["tmp_name"];
        $signitureContent = addslashes(file_get_contents($signiture));
        $command = "UPDATE `tbl_employees as` SET `residentsID`='$residentsID',
                                            `position`='$position',
                                            `termstart`='$termstart',
                                            `termend`='$termend',
                                            `signiture` = $signitureContent 
                                            where `employeeID` = '$employeeID'";
    }else{
        $command = "UPDATE `tbl_employees as` SET `residentsID`='$residentsID',
                                            `position`='$position',
                                            `termstart`='$termstart',
                                            `termend`='$termend'
                                            where `employeeID` = '$employeeID'";
    }
    mysqli_query($conn, $command);
    mysqli_close($conn);
}

if(isset($_POST['deactivate_term'])){
    $conn = openCon();
    $termend = date('y-m-d');
    $employeeID = $_POST['employeeID'];
    $command = "UPDATE tbl_employees as set `termStatus` = 'Inactive', 
                                         `termend` = '$termend' 
                                        where `employeeID` = '$employeeID'";
    mysqli_query($conn, $command);
    mysqli_close($conn);
}