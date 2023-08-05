<?php
  require "db_conn.php";
  require "insertLogs.php";

  function getBlotters(){
        $conn = openCon();
        $command = "SELECT `blotterID` ,`summary`, `narrativeReport`, CONCAT(complainant.firstName,' ', LEFT(complainant.middleName,1), '. ', complainant.lastName, ' ', complainant.extension) as `complainant`, CONCAT(defendant.firstName,' ', LEFT(defendant.middleName,1), '. ', defendant.lastName, ' ', defendant.extension) as `defendant`, `caseStatus`
                    FROM `tbl_blotters` as b 
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
        $additionalCommand = " and (CONCAT(complainant.firstName,' ', LEFT(complainant.middleName, 1),' ', complainant.lastName ) LIKE '%$search%' 
                               or CONCAT(defendant.firstName,' ', LEFT(defendant.middleName, 1),' ', defendant.lastName ) LIKE '%$search%' or
                               `summary` LIKE '%$search%')";
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
function getMinorResidents(){
    $conn = openCon();
    $command = "SELECT r.residentID, CONCAT(`firstName`,' ', LEFT(`middleName`, 1),' ',`lastName`,' ', `extension`) as `fullName`,`birthDate`,`image`, `purok`
                FROM tbl_residents as r INNER JOIN tbl_userAccounts as u on u.residentID = r.residentID
                WHERE r.archive = 'false' and r.registrationStatus = 'Verified' and TIMESTAMPDIFF(YEAR, birthDate, CURDATE()) < 18";
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
    $mediator = validate($_POST['mediator']);
    $summary = validate($_POST['summary']);
    $schedule = $_POST['schedule'];
    $narrativeReport = $_FILES["narrativeReport"]["tmp_name"];
    $narrativeReportFile = addslashes(file_get_contents($narrativeReport));
    $command = "INSERT INTO `tbl_blotters`(`summary`, `complainant`, `defendant`, `mediator`, `narrativeReport`, `caseStatus`, `archive`) 
                                   VALUES ('$summary','$complainant','$defendant','$mediator','$narrativeReportFile','Pending','false')";
    mysqli_query($conn, $command);
    $addedID = mysqli_insert_id($conn);
    mysqli_close($conn);
    insertLogs("Added a blotter record with ID: $addedID");
    CompressImage($addedID);

    //add the hearing
    $conn = openCon();
    $command = "INSERT INTO `tbl_hearing`(`blotterID`, `date`,`hearingResult`) 
                                  VALUES ('$addedID','$schedule','Pending')";
    mysqli_query($conn, $command);
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

if(isset($_POST['back_to_pending'])){
    $conn = openCon();
    $blotterID = $_POST['blotterID'];
    $command = "UPDATE `tbl_blotters` SET `caseStatus`='Pending' WHERE blotterID = '$blotterID'";
    mysqli_query($conn, $command);
    mysqli_close($conn);
}
function CompressImage($blotterID){
    $conn = openCon();
    $command = "SELECT blotterID, narrativeReport FROM tbl_blotters where blotterID = $blotterID";
    $result = mysqli_query($conn, $command);

    // Set the maximum image size (in bytes)
    $max_image_size = 50000; // 50 KB in bytes

    // Compress the images and update the records
    $quality = 20; // Set the starting compression quality (0-100)
    while ($row = mysqli_fetch_assoc($result)) {
        // Create a GD image from the blob data
        $source = imagecreatefromstring($row['narrativeReport']);

        // Compress the image
        do {
            ob_start();
            imagejpeg($source, null, $quality);
            $compressedImage = ob_get_clean();
            $quality -= 5; // Decrease the quality value by 5 for each iteration
        } while (strlen($compressedImage) > $max_image_size && $quality >= 5);

        // Update the record with the compressed image
        $command = "UPDATE tbl_blotters SET narrativeReport = ? WHERE blotterID = ?";
        $stmt = mysqli_prepare($conn, $command);
        mysqli_stmt_bind_param($stmt, "si", $compressedImage, $blotterID);
        mysqli_stmt_execute($stmt);
    }

    // Close the database connection
    mysqli_close($conn);
}
function getSingleBlotter(){
    //get the data about the blotter
    $blotterID = $_GET['id'];
    $conn = openCon();
    $command = "SELECT * FROM `tbl_blotters` WHERE `blotterID` = '$blotterID'";
    $result = mysqli_query($conn, $command);
    $blotter = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    mysqli_close($conn);
    return $blotter;
}
function getSingleResident($id){
    $conn = openCon();
    $command = "SELECT `residentID`, CONCAT(`firstName`,' ', LEFT(`middleName`, 1),' ' ,`lastName`,' ',`extension`) as 'fullName', `birthDate`,`image`, `purok` FROM `tbl_residents` WHERE `residentID` = '$id';";
    $result = mysqli_query($conn, $command);
    $resident = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    mysqli_close($conn);
    return $resident;
}
function getHearings(){
    $conn = openCon();
    $id = $_GET['id'];
    $command = "SELECT  *, (ROW_NUMBER() OVER (ORDER BY `date`)) as number FROM `tbl_hearing` WHERE `blotterID` = '$id' ORDER BY `date` LIMIT 3;";
    $result = mysqli_query($conn, $command);
    $hearings = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
    return $hearings;
}
if(isset($_POST['delete_doc_photo'])){
    $conn = openCon();
    $hearingID = $_POST['hearingID'];
    $field = $_POST['field'];
    $command = "UPDATE `tbl_hearing` SET `$field` = NULL WHERE `hearingID` = '$hearingID'";
    mysqli_query($conn, $command);
    mysqli_close($conn);
}
if(isset($_FILES['photo_input'])){
    $conn = openCon();
    $hearingID = $_POST['hearingID'];
    $field = $_POST['field'];
    $image = $_FILES["photo_input"]["tmp_name"];
    $imageContent = addslashes(file_get_contents($image));
    $command = "UPDATE `tbl_hearing` SET `$field` = '$imageContent' WHERE `hearingID` = '$hearingID'";
    mysqli_query($conn, $command);
    mysqli_close($conn);
}
if(isset($_POST["add_next_hearing"])){
    $ID = $_GET['id'];
    $conn = openCon();
    $date = $_POST['date'];
    $command = "INSERT INTO `tbl_hearing`(`blotterID`, `date`, `hearingResult`) VALUES ('$ID','$date','Pending')";
    mysqli_query($conn, $command);
    mysqli_close($conn);
    insertLogs("Add another hearing to a blotter with ID: $ID");
}
if(isset($_POST["edit_hearing"])){
    $date = $_POST['date'];
    $hearingID = $_POST['hearingID'];
    $conn = openCon();
    $command = "UPDATE `tbl_hearing` SET `date` = '$date' WHERE `hearingID` = '$hearingID'";
    mysqli_query($conn, $command);
    mysqli_close($conn);
}
if(isset($_POST['edit_conflict'])){
    $ID = $_GET['id'];
    $conn = openCon();
    $conflict = $_POST['conflict'];
    $command = "UPDATE `tbl_blotters` SET `summary`= '$conflict' WHERE `blotterID` = '$ID'";
    mysqli_query($conn, $command);
    mysqli_close($conn);
}
if(isset($_POST['change_participants'])){
    $id = $_GET['id'];
    $field = $_POST['field'];
    $residentID = $_POST['residentID'];
    $conn = openCon();
    $command = "UPDATE `tbl_blotters` SET `$field`= '$residentID' WHERE `blotterID` = '$id'";
    mysqli_query($conn, $command);
    mysqli_close($conn);
}
?>
