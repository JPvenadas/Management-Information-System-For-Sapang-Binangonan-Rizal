<?php
  require "db_conn.php";
  require "insertLogs.php";

  function getBlotters(){
        $conn = openCon();
        $command = "SELECT `blotterID` ,`summary`, `narrativeReport`, CONCAT(complainant.firstName,' ', LEFT(complainant.middleName,1), '. ', complainant.lastName, ' ', complainant.extension) as `complainant`, CONCAT(defendant.firstName,' ', LEFT(defendant.middleName,1), '. ', defendant.lastName, ' ', defendant.extension) as `defendant`, `caseStatus`, hearing1, hearing2, hearing3, RIGHT(complainant.contactNo, 9) as `complainantContact`, RIGHT(defendant.contactNo, 9) as  `defendantContact`, COALESCE(hearing3, hearing2, hearing1) AS latestHearing,
                    ((hearing1 IS NOT NULL) + 
                    (hearing2 IS NOT NULL) + 
                    (hearing3 IS NOT NULL)) as totalHearing, 
                    `caseStatus`   FROM `tbl_blotters` as b 
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
                WHERE r.archive = 'false' and r.registrationStatus = 'Verified'";
    $result = mysqli_query($conn, $command);
    $residents = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
    return $residents;
}

if(isset($_POST['recordViolation'])){
    $conn = openCon();
    $residentID = validate($_POST['residentID']);
    $date = $_POST['date'];
    $time = $_POST['time'];

    $command = "INSERT INTO `tbl_curfewViolators`(`residentID`, `date`, `time`, `archive`)
                                          VALUES ('$residentID','$date','$time','false')";
    mysqli_query($conn, $command);
    $addedID = mysqli_insert_id($conn);
    mysqli_close($conn);
    insertLogs("Added a curfew violation record with ID: $addedID");
}

if(isset($_POST['archive_curfew'])){
    $conn = openCon();
    $recordID = validate($_POST['recordID']);
    $command = "UPDATE `tbl_curfewViolators` SET `archive`='true' WHERE ID = '$recordID'";
    mysqli_query($conn, $command);
    mysqli_close($conn);
    insertLogs("Archived a curfew violation record with ID: $recordID");
}

if(isset($_POST['add_blotter'])){
    $conn = openCon();
    $complainant = validate($_POST['complainant']);
    $defendant = validate($_POST['defendant']);
    $summary = validate($_POST['summary']);
    $schedule = $_POST['schedule'];
    $narrativeReport = $_FILES["narrativeReport"]["tmp_name"];
    $narrativeReportFile = addslashes(file_get_contents($narrativeReport));
    $command = "INSERT INTO `tbl_blotters`(`summary`, `complainant`, `defendant`, `narrativeReport`, `hearing1`, `caseStatus`, `archive`) 
                                   VALUES ('$summary','$complainant','$defendant','$narrativeReportFile','$schedule','Pending','false')";
    mysqli_query($conn, $command);
    $addedID = mysqli_insert_id($conn);
    mysqli_close($conn);
    insertLogs("Added a blotter record with ID: $addedID");
}

if(isset($_POST['archive_blotter'])){
    $conn = openCon();
    $blotterID = $_POST['blotterID'];
    $command = "UPDATE `tbl_blotters` SET `archive`='true' WHERE blotterID = '$blotterID'";
    mysqli_query($conn, $command);
    mysqli_close($conn);
    insertLogs("Archived a blotter record with ID: $blotterID");
}
if(isset($_POST['endorse_blotter'])){
    $conn = openCon();
    $blotterID = $_POST['blotterID'];
    $command = "UPDATE `tbl_blotters` SET `caseStatus`='Endorsed to the court' WHERE blotterID = '$blotterID'";
    mysqli_query($conn, $command);
    mysqli_close($conn);
    insertLogs("Mark the blotter with ID: $blotterID as something that is endorsed in the court");
}
if(isset($_POST['solve_blotter'])){
    $conn = openCon();
    $blotterID = $_POST['blotterID'];
    $command = "UPDATE `tbl_blotters` SET `caseStatus`='Solved' WHERE blotterID = '$blotterID'";
    mysqli_query($conn, $command);
    mysqli_close($conn);
    insertLogs("Mark the blotter wiht ID: $blotterID as solved");
}
if(isset($_POST['resched'])){
    if(isset($_POST['date_3'])){
        changeSched('hearing3',$_POST['date_3']);
    }elseif(isset($_POST['date_2'])){
        changeSched('hearing2',$_POST['date_2']);
    }else{
        changeSched('hearing1',$_POST['date_1']);
    }
    $ID = $_POST['blotterID'];
    insertLogs("Reschedule the hearing of a blotter with ID: $ID");
}
if(isset($_POST["add_next_hearing"])){
    if($_POST['totalHearing'] == 1){
        changeSched('hearing2',$_POST['date']);
    }elseif($_POST['totalHearing'] == 2){
        changeSched('hearing3',$_POST['date']);
    }
    $ID = $_POST['blotterID'];
    insertLogs("Add another hearing to a blotter with ID: $ID");
}

function changeSched($hearing, $value){
    $conn = openCon();
    $blotterID = $_POST['blotterID'];
    $command = "UPDATE `tbl_blotters` SET `$hearing`='$value' WHERE blotterID = '$blotterID'";
    mysqli_query($conn, $command);
    mysqli_close($conn);
}

if(isset($_POST['back_to_pending'])){
    $conn = openCon();
    $blotterID = $_POST['blotterID'];
    $command = "UPDATE `tbl_blotters` SET `caseStatus`='Pending' WHERE blotterID = '$blotterID'";
    mysqli_query($conn, $command);
    mysqli_close($conn);
}
?>