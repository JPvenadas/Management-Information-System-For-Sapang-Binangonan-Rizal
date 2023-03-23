<?php
require "db_conn.php";

function getEmployeeAttendance(){
    $conn = openCon();
    $date = date('y/m/d');
    $command = "SELECT a.attendanceID, r.image ,CONCAT(r.firstName,' ', LEFT(r.middleName,1), '. ', r.lastName, ' ', r.extension) as fullName, e.position, IF(a.timeIn = CURDATE(), a.timeIn, null) as `timeIn`, IF(a.timeOut = CURDATE(), a.timeOut, null) as `timeOut` FROM `tbl_employees` as e
                LEFT JOIN tbl_attendance as a on a.employeeID = e.employeeID
                INNER JOIN tbl_residents as r on r.residentID = e.residentID";
    $result = mysqli_query($conn, $command);
    $attendance = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
    return $attendance;
}
?>