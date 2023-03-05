<?php
require "db_conn.php";

function getServices(){
    $conn = openCon();
    $command = "SELECT * FROM `tbl_services` where `archive` = 'false'";
    $result = mysqli_query($conn, $command);
    $services = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
    return $services;
}
function getRequests(){
    $conn = openCon();
    $command = "SELECT `transactionID`, CONCAT(r.firstName,' ', r.middleName,' ', r.lastName, ' ' ,r.extension) as `fullName`, `serviceName`, `purpose`,`dateRequested`
                FROM `tbl_transactions` as t inner JOIN tbl_residents as r
                on r.residentID = t.residentID WHERE `transactionStatus` = 'Unprocessed'";
    $result = mysqli_query($conn, $command);
    $requests = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
    return $requests;
}
function getTransactions(){
    $conn = openCon();
    $status = $_GET['page'];
    $command = "SELECT `transactionID`, CONCAT(r.firstName,' ', r.middleName,' ', r.lastName, ' ' ,r.extension) as `fullName`, `serviceName`, `purpose`,`dateRequested`, `paymentDate`, `amountPaid`, CONCAT(emp.firstName,' ', emp.middleName,' ', emp.lastName, ' ' ,emp.extension) as `assistedBy`
                FROM `tbl_transactions` as t inner JOIN tbl_residents as r
                on r.residentID = t.residentID inner join tbl_residents as emp
                on emp.residentID = t.assistedBy
                WHERE `transactionStatus` = '$status'";
    $result = mysqli_query($conn, $command);
    $requests = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
    return $requests;
}
function getResidents(){
    $conn = openCon();
    $command = "SELECT r.residentID, CONCAT(`firstName`,' ', LEFT(`middleName`, 1),' ',`lastName`,' ', `extension`) as `fullName`,`birthDate`,`image`, `purok`
                FROM tbl_residents as r INNER JOIN tbl_userAccounts as u on u.residentID = r.residentID
                WHERE r.archive = 'false'";
    $result = mysqli_query($conn, $command);
    $residents = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
    return $residents;
}
//registration of new transaction
if(isset($_POST['add_transaction'])){
    $conn = openCon();
    $serviceName = $_POST['serviceName'];
    $residentID = $_POST['residentID'];
    $purpose = $_POST['purpose'];
    $dateRequested = date('F d, Y');
    $paymentDate = date('F d, Y');
    $amountPaid = $_POST['serviceFee'];
    $transactionStatus = "Processed";
    $archive = 'false';
    $assistedBy = $_SESSION['residentID'];
    $command = "INSERT INTO `tbl_transactions`(`serviceName`, `residentID`, `purpose`, `dateRequested`, `paymentDate`, `amountPaid`, `transactionStatus`, `archive`, `assistedBy`)  
                                              VALUES ('$serviceName','$residentID','$purpose','$dateRequested','$paymentDate','$amountPaid','$transactionStatus','$archive','$assistedBy')";
    mysqli_query($conn, $command);
    mysqli_close($conn);
}
?>