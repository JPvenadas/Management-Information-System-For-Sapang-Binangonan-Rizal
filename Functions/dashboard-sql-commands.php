<?php
require "db_conn.php";

function getNumberofResidents(){
    $conn = openCon();
    $command = "SELECT COUNT(*) as 'number' from tbl_residents where `archive` = 'false' and `registrationStatus` = 'Verified'";
    $result = mysqli_query($conn, $command);
    $residentTotal = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_close($conn);
    return $residentTotal[0];
}
function getNumberofItems(){
    $conn = openCon();
    $command = "SELECT COUNT(*) as 'number' from tbl_inventoryList where `archive` = 'false'";
    $result = mysqli_query($conn, $command);
    $itemTotal = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_close($conn);
    return $itemTotal[0];
}
function getPendingRequests(){
    $conn = openCon();
    $command = "SELECT COUNT(*) as `number` FROM `tbl_transactions` WHERE `paymentDate` is Null";
    $result = mysqli_query($conn, $command);
    $totalPending = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_close($conn);
    return $totalPending[0];
}
function getNumberofPuroks(){
    $conn = openCon();
    $command = "SELECT COUNT(*) as 'number' from tbl_purok where `archive` = 'false'";
    $result = mysqli_query($conn, $command);
    $purok = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_close($conn);
    return $purok[0];
}
function getNumberofEmployees(){
    $conn = openCon();
    $command = "SELECT COUNT(*) as 'number' from tbl_employees where `termStatus` = 'Active'";
    $result = mysqli_query($conn, $command);
    $employeeTotal = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_close($conn);
    return $employeeTotal[0];
}
function getTotalVoters($status){
    $conn = openCon();
    $command = "SELECT COUNT(*) as 'number' from tbl_residents where `voterStatus` = '$status' and registrationStatus = 'Verified' and `archive` = 'false' ";
    $result = mysqli_query($conn, $command);
    $Total = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_close($conn);
    return $Total[0];
}
function getRevenues($month){
    $conn = openCon();
    $command = "SELECT SUM(`amountPaid`) as `revenue` from tbl_transactions WHERE MONTH(`paymentDate`) = '$month' and `archive` = 'false'";
    $result = mysqli_query($conn, $command);
    $revenue = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_close($conn);
    return $revenue[0];
}
function getUpcomingEvents(){
    $conn = openCon();
    $command = "SELECT * FROM tbl_events WHERE `start` >= CURDATE() ORDER BY `start` ASC LIMIT 3";
    $result = mysqli_query($conn, $command);
    $events = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_close($conn);
    return $events;
}
function getEmployees($position){
    $conn = openCon();
    $command = "SELECT e.residentID, r.firstName, r.middleName, r.lastName, r.extension, r.image, r.birthDate, r.purok, e.committee, e.position
                FROM `tbl_employees` as e INNER JOIN tbl_residents r on e.residentID = r.residentID
                where e.termStatus = 'Active' and r.archive = 'false' and e.position = '$position'";
    $result = mysqli_query($conn, $command);
    $employee = mysqli_fetch_all($result, MYSQLI_ASSOC);
    if(mysqli_num_rows($result) == 0){
        return $position;
    }else{
        return $employee[0];
    }  
}
function getCommittee(){
    $conn = openCon();
    $command = "Select * from tbl_committee where `archive` = 'false' and committee != 'N/A'";
    $result = mysqli_query($conn, $command);
    $committees = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_close($conn);
    return $committees;

}
function getKagawad($committee){
    $conn = openCon();
    $command = "SELECT e.residentID, r.firstName, r.middleName, r.lastName, r.extension, r.image, r.birthDate, r.purok, e.committee, e.position
                FROM `tbl_employees` as e INNER JOIN tbl_residents r on e.residentID = r.residentID
                where e.termStatus = 'Active' and r.archive = 'false' and e.position = 'Barangay Kagawad' and e.committee = '$committee'";
    $result = mysqli_query($conn, $command);
    $employee = mysqli_fetch_all($result, MYSQLI_ASSOC);
    if(mysqli_num_rows($result) == 0){
        return 'Barangay Kagawad';
    }else{
        return $employee[0];
    }
}

?>