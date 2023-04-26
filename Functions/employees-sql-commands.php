<?php
require "db_conn.php";
require "insertLogs.php";

// function to get the employees list and display it on the screen
function getEmployees(){
    $conn = openCon();
    $command =  "SELECT CONCAT(r.firstName, ' ', r.middleName, ' ', r.lastName) as fullName, e.employeeID, r.image, r.residentID, `position`, `committee`, `termStart`, `termEnd`, `termStatus` 
    FROM `tbl_employees` as e INNER JOIN tbl_residents as r on e.residentID = r.residentID
    WHERE e.archive = 'false' and termStatus = 'Active'";


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
    header("Location: ../Pages/Employees/Employees.php?search=$searchInput");
}

function getResidents(){
    $conn = openCon();
    $command = "SELECT `residentID`, CONCAT(`firstName`,' ',`middleName`,' ',`lastName`) as 'fullName' from tbl_residents where `archive` = 'false' and `registrationStatus` = 'Verified'";
    $result = mysqli_query($conn, $command);
    $residents = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
    return $residents;
}
function getPositions(){
    $conn = openCon();
    $command = "SELECT * FROM `tbl_positions` WHERE `archive` = 'false'";
    $result = mysqli_query($conn, $command);
    $positions = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
    return $positions;
}
function getCommittees(){
    $conn = openCon();
    $command = "SELECT * FROM `tbl_committee` WHERE `archive` = 'false'";
    $result = mysqli_query($conn, $command);
    $committee = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
    return $committee;
}
function existingResidents(){
    $conn = openCon();
    $residentID = $_POST['residentID'];
    $command = "SELECT residentID from tbl_employees WHERE `residentID` = '$residentID' and `termStatus` = 'Active'";
    $result = mysqli_query($conn, $command);
    if(mysqli_num_rows($result) === 1){
        mysqli_close($conn);
        return false;
    }else{
        mysqli_close($conn);
        return true;
    }
}
function existingRole(){
    $conn = openCon();
    $position = $_POST['position'];
    $committee = $_POST['committee'];
    if($position == "Barangay Kagawad"){
        $command = "SELECT residentID from tbl_employees WHERE `position` = '$position' and `committee` = '$committee' and `termStatus` = 'Active'";
    }
    else{
        $command = "SELECT residentID from tbl_employees WHERE `position` = '$position' and `termStatus` = 'Active'";
    }
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
        if(existingRole()){
            $conn = openCon();
            $residentID = validate($_POST['residentID']);
            $position = validate($_POST['position']);
            $termstart = $_POST['termstart'];
            $committee = validate($_POST['committee']);
            $termend = $_POST['termend'];
            $termStatus = 'Active';
            $signiture = $_FILES["signiture"]["tmp_name"];
            $signitureContent = addslashes(file_get_contents($signiture));
            $command = "INSERT INTO tbl_employees (`residentID`, `position`, `committee`, `termstart`, `termend`, `termStatus`, `Signiture`, `archive`) 
                                        VALUES ('$residentID','$position', '$committee','$termstart','$termend','$termStatus','$signitureContent', 'false')";
            mysqli_query($conn, $command);
            $addedemployeeID = mysqli_insert_id($conn);
            mysqli_close($conn);
            insertLogs("Added an Employee with ID: $addedemployeeID");
        }
        else{
            header("Location: ../../Pages/Employees/Employees.php?error=Position already Taken");
            exit();
        }
    }else{
        header("Location: ../../Pages/Employees/Employees.php?error=the selected resident is already an employee");
        exit();
    }
}
if(isset($_POST['edit_employee'])){
    $conn = openCon();
    $employeeID = validate($_POST['employeeID']);
    $residentID = validate($_POST['residentID']);
    $position = validate($_POST['position']);
    $termstart = $_POST['termstart'];
    $termend = $_POST['termend'];
    $committee = validate($_POST['committee']);
    $command = "";
    if(isset($_FILES['signiture'])){
        $signiture = $_FILES["signiture"]["tmp_name"];
        $signitureContent = addslashes(file_get_contents($signiture));
        $command = "UPDATE `tbl_employees` SET `residentID`='$residentID',
                                            `position`='$position',
                                            `termstart`='$termstart',
                                            `termend`='$termend',
                                            `committee` = '$committee',
                                            `signiture` = $signitureContent 
                                            where `employeeID` = '$employeeID'";
    }else{
        $command = "UPDATE `tbl_employees` SET `residentID`='$residentID',
                                            `position`='$position',
                                            `termstart`='$termstart',
                                            `termend`='$termend',
                                            `committee` = '$committee'
                                            where `employeeID` = '$employeeID'";
    }
    mysqli_query($conn, $command);
    mysqli_close($conn);
    insertLogs("Updated an Employee with ID: $employeeID");
}

if(isset($_POST['deactivate_term'])){
    $conn = openCon();
    $termend = date('y-m-d');
    $employeeID = validate($_POST['employeeID']);
    $command = "UPDATE tbl_employees set `termStatus` = 'Inactive', 
                                         `termend` = '$termend' 
                                        where `employeeID` = '$employeeID'";
    mysqli_query($conn, $command);
    mysqli_close($conn);
    insertLogs("Deactivated an employee with ID: $employeeID");
}