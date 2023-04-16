<?php
require "db_conn.php";
require "insertLogs.php";

function getEmployeeAttendance(){
    $conn = openCon();
    $date = date('y/m/d');
    $command = "SELECT a.attendanceID, e.employeeID, r.image ,CONCAT(r.firstName,' ', LEFT(r.middleName,1), '. ', r.lastName, ' ', r.extension) as fullName, e.position, IF(a.date = CURDATE(), a.timeIn, null) as `timeIn`, IF(a.date = CURDATE(), a.timeOut, null) as `timeOut` FROM `tbl_employees` as e
                LEFT JOIN tbl_attendance as a on a.employeeID = e.employeeID AND DATE(a.date) = CURDATE()
                INNER JOIN tbl_residents as r on r.residentID = e.residentID";
    $result = mysqli_query($conn, $command);
    $attendance = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
    return $attendance;
}

if(isset($_POST['verify'])){
    checkPassword();
}

function checkPassword(){
    $conn = openCon();
    $employeeID = $_POST['employeeID'];
    $command = "SELECT r.residentID, e.employeeID, u.password FROM `tbl_employees` as e 
                inner JOIN tbl_residents as r on e.residentID = r.residentID
                INNER JOIN tbl_userAccounts as u on r.residentID = u.residentID 
                WHERE e.employeeID = '$employeeID'";
    $result = mysqli_query($conn, $command);
    if (mysqli_num_rows($result) === 1) {
        $passwords = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $password = $_POST['password'];
        mysqli_free_result($result);
        if(password_verify($password, $passwords[0]['password'])){
            if($_POST['process'] == 'timeIn'){
                    timeIn();
            }else{
                    timeOut();
            }
        }else{
            header("Location: ../../Pages/Attendance/Attendance.php?error=Incorrect Password");
            exit();
        }
    }
    mysqli_close($conn);
}

function timeIn(){
    $conn = openCon();
    $employeeID = $_POST['employeeID'];
    date_default_timezone_set('Asia/Manila');
    $date = date('y/m/d');
    $timeIn = date("h:i:s");
    $command = "INSERT INTO `tbl_attendance`(`employeeID`, `date`, `timeIn`) 
                                     VALUES ('$employeeID','$date','$timeIn')";                                 
    mysqli_query($conn, $command);
    mysqli_close($conn);
    insertLogs("Time in ( EmployeeID: $employeeID, Date: $date )");
}
function timeOut(){
    $conn = openCon();
    $employeeID = $_POST['employeeID'];
    $date = date('y/m/d');
    date_default_timezone_set('Asia/Manila');
    $timeOut = date("h:i:s");
    $command = "UPDATE `tbl_attendance` SET `timeOut`='$timeOut' 
                WHERE `employeeID` = '$employeeID' AND `date` = CURRENT_DATE";
    mysqli_query($conn, $command);
    mysqli_close($conn);
    insertLogs("Time out ( EmployeeID: $employeeID, Date: $date )");
}

if(isset($_POST["browse_records"])){
    $date = $_POST["record_date"];
    header("Location: ../../Pages/Attendance/Attendance.php?date=$date");
    exit();
}

function getEmployeeByDate(){
    $conn = openCon();
    $date = $_GET['date'];
    $command = "SELECT CONCAT(r.firstName,' ', LEFT(r.middleName,1), '. ', r.lastName, ' ', r.extension) as fullName, e.position, `timeIn`, `timeOut` FROM `tbl_attendance` as a 
                INNER JOIN tbl_employees as e on e.employeeID = a.employeeID
                INNER JOIN tbl_residents as r on r.residentID = e.residentID
                WHERE `date` = '$date'";
    $result = mysqli_query($conn, $command);
    $attendance = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
    return $attendance;
}


?>