<?php
require "db_conn.php";
require "insertLogs.php";

// add condition to filter verified to non-verified users
function addFilters(){
    $additionalCommands = " and ";
    if(isset($_GET['filter']) && $_GET['filter'] == "staffs"){
        $additionalCommands = $additionalCommands . "userType = 'Staff'" . addsearchFilter();
        return $additionalCommands;
    }elseif(isset($_GET['filter']) && $_GET['filter'] == "residents"){
        $additionalCommands = $additionalCommands . "userType = 'Resident'" . addsearchFilter();
        return $additionalCommands;
    }
    else{
        $additionalCommands = $additionalCommands . "userType = 'Administrator'" . addsearchFilter();
        return $additionalCommands;
    }
}
// filter users to what the user searches
function addsearchFilter(){
    if(isset($_GET['search'])){
        $search = validate($_GET['search']);
        $additionalCommand = " and (CONCAT(firstName,' ', middleName,' ', lastName ) LIKE '%$search%' or userName  LIKE '%$search%')";
        return $additionalCommand;
    }else{
        return "";
    }
}
// this will run if the search button is clicked
if(isset($_POST['search_button_users'])){
    $search = $_POST['search_input_users'];
    $filter = $_POST['search_filter'];
    header("Location: ../Pages/Users/Users.php?filter=$filter&search=$search");
	exit();
}
// get the lists of the users
function getUsers(){
    $conn = openCon();
    $command = "SELECT r.firstName, r.middleName, r.lastName, r.extension, r.image, a.residentID, `userName`, `userType`, `accountStatus`
                FROM `tbl_userAccounts` as a 
                INNER JOIN `tbl_residents` as r
                on r.residentID = a.residentID
                WHERE r.archive = 'false' and r.registrationStatus = 'Verified'";
     $command = $command . addFilters() . " ORDER BY `accountStatus` <> 'Active', `firstName` ASC";  
     $result = mysqli_query($conn, $command);
     $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
     mysqli_free_result($result);
     mysqli_close($conn);
     return $users;
}
function getAccessFields(){
    $conn = openCon();
    $command = "SHOW COLUMNS FROM tbl_accessControl where `Field` != 'userName'";
    $result = mysqli_query($conn, $command);
    $fields = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
    return $fields;
}
function changeUserType($userType){
    if(checkAdminNumber()){
        $conn = openCon();
        $userName = validate($_POST['userName']);
        $command = "UPDATE `tbl_userAccounts` SET `userType`='$userType' WHERE `userName` = '$userName'";
        mysqli_query($conn, $command);
        mysqli_close($conn);
        insertLogs("Change the user type of $userName to $userType");
    }else{
        header("Location: ../../Pages/Users/Users.php?error=There must be atleast one Administrator");
	    exit();
    }
}
if(isset($_POST['changeAccess'])){
    if(checkIfEmployee()){
        removeExistingAccess();
        $conn = openCon();
        $userName = $_POST['userName'];
        $residents = $_POST['residents'];
        $employees = $_POST['employees'];
        $services = $_POST['services'];
        $inventory = $_POST['inventory'];
        $events = $_POST['events'];
        $announcements = $_POST['announcements'];
        $incidents = $_POST['incidents'];
        $attendance = $_POST['attendance'];
        $reports = $_POST['reports'];
        $command = "INSERT INTO `tbl_accessControl`(`userName`, `residents`, `employees`, `services`, `inventory`, `events`, `announcements`, `incidents`, `attendance`, `reports`) 
                                            VALUES ('$userName','$residents','$employees','$services','$inventory','$events','$announcements','$incidents','$attendance','$reports')";
        mysqli_query($conn, $command);
        mysqli_close($conn);
        changeUserType('Staff');
    }else{
        header("Location: ../../Pages/Users/Users.php?error=The resident is not an employee");
	    exit();
    }
}
function removeExistingAccess(){
    $conn = openCon();
    $userName = $_POST['userName'];
    $command = "DELETE FROM `tbl_accessControl` WHERE `userName` = '$userName'";
    mysqli_query($conn, $command);
    mysqli_close($conn);
}
if(isset($_POST['changeToResident'])){
    removeExistingAccess();
    changeUserType('Resident');
}
if(isset($_POST['changeToAdmin'])){
    removeExistingAccess();
    if(checkIfEmployee()){
        changeUserType('Administrator');
    }else{
        header("Location: ../../Pages/Users/Users.php?error=The resident is not an employee");
	    exit();
    }
}
if(isset($_POST['deactivate'])){
   changeAccountStatus('Inactive');
}
if(isset($_POST['activate'])){
    changeAccountStatus('Active');
 }
function changeAccountStatus($status){
    $conn = openCon();
    $userName = validate($_POST['userName']);
    $command = "UPDATE `tbl_userAccounts` SET `accountStatus`='$status' WHERE `userName` = '$userName'";
    mysqli_query($conn, $command);
    mysqli_close($conn);
    insertLogs("Change the account status of $userName to $status");
}
if(isset($_POST['change_password'])){
    $conn = openCon();
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $userName = validate($_POST['userName']);
    $command = "UPDATE tbl_userAccounts SET `password` = '$password' WHERE `userName` = '$userName'";
    mysqli_query($conn, $command);
    mysqli_close($conn);
    insertLogs("Change the user password of $userName");
}
function checkIfEmployee(){
    $conn = openCon();
    $userName = validate($_POST['userName']);
    $command = "SELECT e.residentID FROM `tbl_employees` as e INNER JOIN tbl_userAccounts as u on u.residentID = e.residentID WHERE u.userName = '$userName'";
    $result = mysqli_query($conn, $command);
    if (mysqli_num_rows($result) > 0) {
        // User is present in the table
        mysqli_close($conn);
        return true;
      } else {
        // User is not present in the table
        mysqli_close($conn);
        return false;
      }
      
      // Close the database connection
}
function checkAdminNumber(){
    $conn = openCon();
    $userName = validate($_POST['userName']);
    $command = "SELECT userType FROM `tbl_userAccounts` WHERE `userName` = '$userName'";
    $result = mysqli_query($conn, $command);
    $user = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    if($user[0]['userType'] == "Administrator"){
        $conn = openCon();
        $command = "SELECT userName  FROM `tbl_userAccounts` WHERE `userType` ='Administrator' and `accountStatus` = 'Active'";
        $result = mysqli_query($conn, $command);
        if (mysqli_num_rows($result) > 1) {
            mysqli_close($conn);
            return true;
        }else{
            mysqli_close($conn);
            return false;
        }
    }else{
        mysqli_close($conn);
        return true;
    }
}
?>