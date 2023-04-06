<?php
  require "db_conn.php";

  function getBlotters(){
        $conn = openCon();
        $command = "SELECT `blotterID` ,`summary`, CONCAT(complainant.firstName,' ', LEFT(complainant.middleName,1), '. ', complainant.lastName, ' ', complainant.extension) as `complainant`, CONCAT(defendant.firstName,' ', LEFT(defendant.middleName,1), '. ', defendant.lastName, ' ', defendant.extension) as `defendant`, `narrativeReport`, `hearing1`, `hearing2`, `hearing3`, `caseStatus`   FROM `tbl_blotters` as b 
                    INNER JOIN tbl_residents as complainant on complainant.residentID = b.complainant 
                    INNER JOIN tbl_residents as defendant on defendant.residentID = b.defendant WHERE b.archive = 'false'";
        $command = $command . addSearchFilterBlotters();
        $result = mysqli_query($conn, $command);
        $blotters = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        mysqli_close($conn);
        return $blotters;
  }
  function addSearchFilterBlotters(){
    if(isset($_GET['search'])){
        $search = $_GET['search'];
        $additionalCommand = " and CONCAT(complainant.firstName,' ', LEFT(complainant.middleName, 1),' ', complainant.lastName ) LIKE '%$search%' 
                               or CONCAT(defendant.firstName,' ', LEFT(defendant.middleName, 1),' ', defendant.lastName ) LIKE '%$search%' or
                               `summary` LIKE '%$search%' ";
        return $additionalCommand;
    }
    return "";
  }
  function getCurfewViolators(){
    $conn = openCon();
    $command = "SELECT `ID`, CONCAT(r.firstName,' ', LEFT(r.middleName,1), '. ', r.lastName, ' ', r.extension) as fullName , `date`, `time` FROM `tbl_curfewViolators` as c 
                INNER JOIN `tbl_residents` as r on r.residentID = c.residentID WHERE c.archive = 'false'";
    $command = $command . addSearchFilterCurfew();
    $result = mysqli_query($conn, $command);
    $violators = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
    return $violators;
}
function addSearchFilterCurfew(){
    if(isset($_GET['search'])){
        $search = $_GET['search'];
        $additionalCommand = " and CONCAT(r.firstName,' ', LEFT(r.middleName,1), '. ', r.lastName, ' ', r.extension) LIKE '%$search%'";
        return $additionalCommand;
    }
    return "";
  }

if(isset($_POST['search_button'])){
    $search = $_POST['search_input'];
    $filter = $_POST['search_filter'];
    header("Location: ../../Pages/Incidents/Incidents.php?filter=$filter&search=$search");
    exit();
}
function getResidents(){
    $conn = openCon();
    $command = "SELECT r.residentID, CONCAT(`firstName`,' ', LEFT(`middleName`, 1),' ',`lastName`,' ', `extension`) as `fullName`,`birthDate`,`image`, `purok`
                FROM tbl_residents as r INNER JOIN tbl_userAccounts as u on u.residentID = r.residentID
                WHERE r.archive = 'false' and r.registrationStatus = 'Verified' and birthDate > DATE_SUB(NOW(), INTERVAL 18 YEAR)";
    $result = mysqli_query($conn, $command);
    $residents = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
    return $residents;
}

if(isset($_POST['recordViolation'])){
    $conn = openCon();
    $residentID = $_POST['residentID'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    $command = "INSERT INTO `tbl_curfewViolators`(`residentID`, `date`, `time`, `archive`)
                                          VALUES ('$residentID','$date','$time','false')";
    mysqli_query($conn, $command);
    mysqli_close($conn);
}

if(isset($_POST['archive_curfew'])){
    $conn = openCon();
    $recordID = $_POST['recordID'];
    $command = "UPDATE `tbl_curfewViolators` SET `archive`='true' WHERE ID = '$recordID'";
    mysqli_query($conn, $command);
    mysqli_close($conn);
}
?>