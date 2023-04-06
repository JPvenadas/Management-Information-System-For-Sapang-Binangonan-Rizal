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
    $command = "SELECT `transactionID`,t.residentID, CONCAT(r.firstName,' ', r.middleName,' ', r.lastName, ' ' ,r.extension) as `fullName`, t.serviceName, s.serviceFee, s.serviceType, `transactionStatus`, `purpose`,`dateRequested`,paymentProof, paymentProof IS NOT NULL AS paymentNotNull
                FROM `tbl_transactions` as t inner JOIN tbl_residents as r
                on r.residentID = t.residentID inner join tbl_services as s
                on s.serviceName = t.serviceName WHERE `transactionStatus` = 'Unprocessed'";
    $result = mysqli_query($conn, $command);
    $requests = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
    return $requests;
}
// filter residents to what the user searches
function addsearchFilter(){
    if(isset($_GET['search'])){
        $search = $_GET['search'];
        $additionalCommand = " and CONCAT(r.firstName,' ', r.middleName,' ', r.lastName ) LIKE '%$search%' or t.serviceName LIKE '%$search%' ";
        return $additionalCommand;
    }else{
        return "";
    }
}
function getTransactions(){
    $conn = openCon();
    $status = $_GET['page'];
    $command = "SELECT `transactionID`, t.residentID, CONCAT(r.firstName,' ', r.middleName,' ', r.lastName, ' ' ,r.extension) as `fullName`, t.serviceName,s.serviceFee, s.serviceType , `purpose`,`dateRequested`, `transactionStatus`, `paymentDate`, `amountPaid`, CONCAT(emp.firstName,' ', emp.middleName,' ', emp.lastName, ' ' ,emp.extension) as `assistedBy`
                FROM `tbl_transactions` as t inner JOIN tbl_residents as r
                on r.residentID = t.residentID inner join tbl_residents as emp
                on emp.residentID = t.assistedBy inner join tbl_services as s
                on s.serviceName = t.serviceName where 
                transactionStatus = '$status' and t.archive = 'false' ";
    $command = $command . addsearchFilter() . " ORDER by paymentDate DESC";
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
                WHERE r.archive = 'false' and r.registrationStatus = 'Verified'";
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
    $dateRequested = date('y/m/d');
    $paymentDate = date('y/m/d');
    $amountPaid = $_POST['serviceFee'];
    $serviceType = $_POST['serviceType'];
    if($serviceType == "Document"){
        $transactionStatus = "Processed";
    }else{
        $transactionStatus = "Finished";
    }
    $archive = 'false';
    $assistedBy = $_SESSION['residentID'];
    $command = "INSERT INTO `tbl_transactions`(`serviceName`, `residentID`, `purpose`, `dateRequested`, `paymentDate`, `amountPaid`, `transactionStatus`, `archive`, `assistedBy`)  
                                              VALUES ('$serviceName','$residentID','$purpose','$dateRequested','$paymentDate','$amountPaid','$transactionStatus','$archive','$assistedBy')";
    mysqli_query($conn, $command);
    mysqli_close($conn);
    
    if($serviceType == "Document"){
        header("Location: ../Certification/CertificatePreview.php?service=$serviceName&id=$residentID");
        exit();
    }else{
        header("Location: ../Services/Services.php");
        exit();
    }
}
if(isset($_POST['process_transaction'])){
    $conn = openCon();
    $transactionID = $_POST['transactionID'];
    $date = date('y/m/d');
    $amountPaid = $_POST['serviceFee'];
    $serviceName = $_POST['serviceName'];
    $residentID = $_POST['residentID'];
    $assistedBy = $_SESSION['residentID'];

    $command = "UPDATE `tbl_transactions` SET 
    `paymentDate`='$date',
    `amountPaid`='$amountPaid',
    `transactionStatus`='Processed',
    `assistedBy` = '$assistedBy' 
    WHERE `transactionID` = '$transactionID'";

    mysqli_query($conn, $command);
    mysqli_close($conn);
    header("Location: ../Certification/CertificatePreview.php?service=$serviceName&id=$residentID");
    exit();
}

if(isset($_POST['claim_transaction'])){
    $conn = openCon();
    $transactionID = $_POST['transactionID'];

    $command = "UPDATE `tbl_transactions` SET 
    `transactionStatus`= 'Finished'
    WHERE `transactionID` = '$transactionID'";

    mysqli_query($conn, $command);
    mysqli_close($conn);
}
if(isset($_POST['archive_transaction'])){
    $conn = openCon();
    $transactionID = $_POST['transactionID'];

    $command = "UPDATE `tbl_transactions` SET 
    `archive`='true'
    WHERE `transactionID` = '$transactionID'";

    mysqli_query($conn, $command);
    mysqli_close($conn);
}
if(isset($_POST['search_button_transactions'])){
    $search = $_POST['search_input_transactions'];
    $page = $_POST['page'];
    header("Location: ../../Pages/Services/Services.php?page=$page&search=$search");
	exit();
}

//resident side

function getTransactionsbyResident(){
    $conn = openCon();
    $residentUser = $_SESSION['residentID'];
    $command = " SELECT `transactionID`, t.residentID, CONCAT(r.firstName,' ', r.middleName,' ', r.lastName, ' ' ,r.extension) as `fullName`, t.serviceName,s.serviceFee, s.serviceType , `purpose`,`dateRequested`, `transactionStatus`, `paymentDate`, `amountPaid`, COALESCE(CONCAT(emp.firstName,' ', emp.middleName,' ', emp.lastName, ' ' ,emp.extension), 'null') as `assistedBy`, `paymentProof`
                    FROM `tbl_transactions` as t inner JOIN tbl_residents as r
                    on r.residentID = t.residentID LEFT join tbl_residents as emp
                    on t.assistedBy = emp.residentID inner join tbl_services as s
                    on s.serviceName = t.serviceName where 
                    t.residentID = '$residentUser' and t.archive = 'false'
                    ORDER bY t.transactionStatus = 'Unprocessed' DESC,
                    t.transactionStatus = 'Processed' DESC,
                    t.transactionStatus = 'Finished' DESC, 
                    IFNULL(`paymentDate`, `dateRequested`) ASC";
    $result = mysqli_query($conn, $command);
    $Transactions = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
    return $Transactions;
}

//resident side services
if(isset($_POST['submit_request'])){
    $conn = openCon();
    $serviceName = $_POST['serviceName'];
    $purpose = $_POST['purpose'];
    $dateRequested = date('y/m/d');
    if($_POST['serviceType'] == "Document"){
        $transactionStatus = "Unprocessed";
    }else{
        $transactionStatus = "Finished";
    }
    $archive = 'false';
    $residentID = $_SESSION['residentID'];
    if(!empty($_FILES["paymentProof"]["tmp_name"])){
        $image = $_FILES["paymentProof"]["tmp_name"];
        $imageContent = addslashes(file_get_contents($image));
    }else{
        $imageContent = null;
    }
    $command = "INSERT INTO `tbl_transactions`(`serviceName`, `residentID`, `purpose`,`dateRequested`, `transactionStatus`, `archive`, `paymentProof`)  
    VALUES ('$serviceName','$residentID','$purpose','$dateRequested','$transactionStatus','$archive', '$imageContent')";
    mysqli_query($conn, $command);
    mysqli_close($conn);
}
?>