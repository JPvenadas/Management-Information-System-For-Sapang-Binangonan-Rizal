<?php
require "db_conn.php";
require "insertLogs.php";

// add condition to filter verified to non-verified residents
function addFilters(){
    $additionalCommands = " and ";
    if(isset($_GET['filter']) && $_GET['filter'] == "unverified"){
        $additionalCommands = $additionalCommands . "r.registrationStatus = 'Unverified'" . addsearchFilter();
        return $additionalCommands;
    }else{
        $additionalCommands = $additionalCommands . "r.registrationStatus = 'Verified'" . addsearchFilter();
        return $additionalCommands;
    }
}
// filter residents to what the user searches
function addsearchFilter(){
    if(isset($_GET['search'])){
        $search = validate($_GET['search']);
        $additionalCommand = " and CONCAT(firstName,' ', middleName,' ', lastName ) LIKE '%$search%'";
        return $additionalCommand;
    }else{
        return "";
    }
}
// this will run if the search button is clicked
if(isset($_POST['search_button_residents'])){
    $search = $_POST['search_input_residents'];
    $filter = $_POST['search_filter'];
    header("Location: ../Pages/Residents/Residents.php?filter=$filter&search=$search");
	exit();
}
// get the lists of the residents
function getResidents(){
    $conn = openCon();
    $command = "SELECT r.residentID, CONCAT(firstName, ' ', middleName, ' ', lastName, ' ', extension) as fullName,`birthDate`,`image`, `purok`
                FROM tbl_residents as r INNER JOIN tbl_userAccounts as u on u.residentID = r.residentID
                WHERE r.archive = 'false'";
    $command = $command . addFilters(); 
     $result = mysqli_query($conn, $command);
     $residents = mysqli_fetch_all($result, MYSQLI_ASSOC);
     mysqli_free_result($result);
     mysqli_close($conn);
     return $residents;
}
// get the list of puroks
function getPuroks(){
    $conn = openCon();
    $command = "SELECT * FROM `tbl_purok` where `archive` = 'false'";
    $result = mysqli_query($conn, $command);
    $puroks = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
    return $puroks;
}
// navigate to the profile page of the resident
if(isset($_POST["view_resident_button"])){
    $residentID = $_POST["residentID"];
    header("Location: ../Pages/Residents/Profile.php?id=$residentID");
    exit();
}
// get the information of a single resident.
function getSingleResident($residentID){
    $conn = openCon();
    $archive = 'false';
    $command = "SELECT r.residentID, `firstName`, `middleName`, `lastName`, `extension`, `purok`, `purok`, `birthDate`, `image`,`exactAddress`, `voterStatus`, `sex`, `maritalStatus`, `occupation`, `familyHead`, `familyMembers`, `contactNo`, `residenceProof`, u.accountStatus, `registrationStatus`
                from tbl_residents as r INNER JOIN tbl_userAccounts as u on r.residentID = u.residentID
                where r.residentID = '$residentID' and r.archive = '$archive'";
    $result = mysqli_query($conn, $command);
    $resident = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
    return $resident[0];
}
//change to inactive users to active
function activate(){
    $conn = openCon();
    $residentID = validate($_POST['residentID']);
    $command = "UPDATE `tbl_userAccounts` SET `accountStatus`='Active' WHERE residentID = '$residentID'";
    mysqli_query($conn, $command);
    mysqli_close($conn);
    insertLogs("Activated a user with resident ID: $residentID");
}
//function to reject a residents verification
if(isset($_POST['reject'])){
    changeStatus('Rejected');
}
//function to confirm a residents verification
if(isset($_POST['confirm'])){
    changeStatus('Verified');
    activate();
}
//function to archive a resident
if(isset($_POST['archive_resident'])){
    $conn = openCon();
    $residentID = $_POST['residentID'];
    $command = "UPDATE `tbl_residents` SET `archive` = 'true' WHERE `residentID` = '$residentID'";
    mysqli_query($conn, $command);
    mysqli_close($conn);
    insertLogs("Archived a user with ID: $residentID");
}
//function to change the registration Status of a resident. either confirmed or rejected
function changeStatus($status){
    $conn = openCon();
    $residentID = $_POST['residentID'];
    $command = "UPDATE `tbl_residents` SET `registrationStatus` = '$status' WHERE `residentID` = '$residentID'";
    mysqli_query($conn, $command);
    mysqli_close($conn);
    insertLogs("$status a user with ID: $residentID");
}
//updating of a residents profile
if(isset($_POST['save-edit-profile'])){
    $conn = openCon();
    $residentID = $_GET['id'];
    $firstName = validate($_POST['personal-information-firstName']);
    $middleName = validate($_POST['personal-information-middleName']);
    $lastName = validate($_POST['personal-information-lastName']);
    $extension = validate($_POST['personal-information-extension']);
    $birthDate = $_POST['personal-information-birthDate'];
    $sex = validate($_POST['personal-information-sex']);
    $purok = validate($_POST['personal-information-purok']);
    $address = validate($_POST['personal-information-address']);
    $voterStatus = validate($_POST['personal-information-voterStatus']);
    $maritalStatus = validate($_POST['personal-information-maritalStatus']);
    $occupation = validate($_POST['personal-information-occupation']);
    if(isset($_POST['personal-information-familyMembers'])){
        $familyMembers = validate($_POST['personal-information-familyMembers']);
    }else{
        $familyMembers = "";
    }
    $familyHead = validate($_POST['personal-information-familyHead']);
    $contactNo = validate($_POST['personal-information-contactNo']);

    $command = "UPDATE `tbl_residents` 
    SET `firstName`='$firstName',
        `middleName`='$middleName',
        `lastName`='$lastName',
        `extension`='$extension',
        `birthDate`='$birthDate', 
        `purok`='$purok',
        `exactAddress`='$address',
        `voterStatus`='$voterStatus',
        `sex`='$sex',
        `maritalStatus`='$maritalStatus',
        `occupation`='$occupation',
        `familyHead`='$familyHead',
        `familyMembers`='$familyMembers',
        `contactNo`='$contactNo' 
        WHERE `residentID` = '$residentID'";
    mysqli_query($conn, $command);
    mysqli_close($conn);
    insertLogs("Updated information about a resident with ID: $residentID");
}
//registration of new users/residents
if(isset($_POST['add_resident_button'])){
    $conn = openCon();
    $firstName = validate($_POST['firstName']);
    $middleName = validate($_POST['middleName']);
    $lastName =  validate($_POST['lastName']);
    $extension =  validate($_POST['extension']);
    $address =  validate($_POST['address']);
    $birthDate =  $_POST['birthDate'];

    //get the image contents
    $image = $_FILES["image"]["tmp_name"];
    $imageContent = addslashes(file_get_contents($image));

    $purok =  validate($_POST['purok']);
    $voterStatus =  validate($_POST['voterStatus']);
    $sex =  validate($_POST['sex']);
    $occupation =  validate($_POST['occupation']);
    $maritalStatus =  validate($_POST['maritalStatus']);
    $familyHead =  validate($_POST['familyHead']);
    $familyMembers =  validate($_POST['familyMembers']);
    $contactNo =  validate($_POST['contactNo']);
    $archive = "false";
    $registrationStatus = "Verified";

    //concat the username then remove spaces
    $userName = "$firstName$middleName$lastName$extension";
    $userName = str_replace(' ', '', $userName);

    //check if the resident is already registered if so void the registration
    if(checkExistingResidents("@$userName")){
        header("Location: ../../Pages/Residents/Residents.php?error=Resident is already registered");
        exit();
    }else{
        $command = "INSERT INTO `tbl_residents`(`firstName`, `middleName`, `lastName`, `extension`, `birthDate`, `image`, `purok`, `exactAddress`, `voterStatus`, `sex`, `maritalStatus`, `occupation`, `familyHead`, `familyMembers`, `archive`, `contactNo`, `registrationStatus`) 
        VALUES ('$firstName','$middleName','$lastName','$extension','$birthDate','$imageContent','$purok','$address','$voterStatus','$sex','$maritalStatus','$occupation','$familyHead','$familyMembers','$archive','$contactNo','$registrationStatus')";
        mysqli_query($conn, $command);
        $residentID = mysqli_insert_id($conn);
        insertLogs("Added a resident with ID: $residentID");

        // registration of user Accounts
        $password = password_hash($userName, PASSWORD_DEFAULT);
        $userType = "Resident";
        $accountStatus = "Active";
        $command = "INSERT INTO `tbl_userAccounts`(`userName`, `residentID`, `password`, `userType`, `accountStatus`) 
                    VALUES ('@$userName','$residentID','$password','$userType','$accountStatus')" ;
        mysqli_query($conn, $command);
        mysqli_close($conn);

        CompressImage($residentID);
   }
}
if(isset($_POST["change_image_button"])){
    $conn = openCon();
    $id = $_GET['id'];
    $image = $_FILES["change_image_input"]["tmp_name"];
    $imageContent = addslashes(file_get_contents($image));
    $command = "UPDATE `tbl_residents` SET `image`='$imageContent' WHERE `residentID` = '$id'";
    mysqli_query($conn, $command);
    mysqli_close($conn);
    insertLogs("Updated a profile picture of resident with ID: $id");
    CompressImage($id);
}

if(isset($_POST['submit_csv'])){
   
    // Check if a file was uploaded
    if (isset($_FILES['csvFile']) && $_FILES['csvFile']['error'] == UPLOAD_ERR_OK){
        // Open uploaded CSV file with read-only mode
        $csv_file = fopen($_FILES['csvFile']['tmp_name'], 'r');

        // Get the header row of the CSV file
        $header = fgetcsv($csv_file);

        // Validate the header row
        $expected_header =  array('First Name', 'Middle Name', 'Last Name', 'Name Extension', 'Birth Date', 'Purok', 'Exact Address', 'voterStatus', 'Sex', 'Marital Status', 'Occupation', 'Family Head (Yes/No)', 'Contact No', 'Number of Family members (Optional)');
        if ($header !== $expected_header) {
            header("Location: ../../Pages/Residents/Residents.php?error=Invalid CSV file. Column does not match");
            exit();
        }else{

            while (($row = fgetcsv($csv_file)) !== false) {
                // Insert data into the table
               
                $conn = openCon();
                $image = addslashes(file_get_contents("../../Images/profileBlank.png"));
                $command = "INSERT INTO `tbl_residents`(`firstName`, `middleName`, `lastName`, `extension`, `birthDate`, `purok`, `exactAddress`, `voterStatus`, `sex`, `maritalStatus`, `occupation`, `familyHead`, `familyMembers`, `contactNo`, `registrationStatus`, `archive`, `image`) 
                            VALUES ('{$row[0]}','{$row[1]}','{$row[2]}','{$row[3]}','{$row[4]}','{$row[5]}','{$row[6]}','{$row[7]}','{$row[8]}','{$row[9]}','{$row[10]}','{$row[11]}','{$row[13]}','{$row[12]}','Verified', 'false', '$image')";
                $userName = "{$row[0]}{$row[1]}{$row[2]}{$row[3]}";
                $userName = str_replace(' ', '', $userName);
                if(checkExistingResidents("@$userName")){
                }else{
                    //register the resident in tbl_residents
                    $result = $conn->query($command);
                    mysqli_query($conn, $command);
                    
                    //create an account
                    $residentID = mysqli_insert_id($conn);
                    $password = password_hash($userName, PASSWORD_DEFAULT);
                    $userType = "Resident";
                    $accountStatus = "Active";
                    $command = "INSERT INTO `tbl_userAccounts`(`userName`, `residentID`, `password`, `userType`, `accountStatus`) 
                                                        VALUES ('@$userName','$residentID','$password','$userType','$accountStatus')" ;
                    mysqli_query($conn, $command);
                    mysqli_close($conn);
                }
              }
        }
        fclose($csv_file);

        // Display success message
        header("Location: ../../Pages/Residents/Residents.php?notif=Data Imported Successfully");
        exit();
    }else{
        header("Location: ../../Pages/Residents/Residents.php?error=Error uploading the file");
        exit();
    }
}


function CompressImage($residentID){
    $conn = openCon();
    $command = "SELECT residentID, image FROM tbl_residents where residentID = $residentID";
    $result = mysqli_query($conn, $command);

        // Compress the images and update the records
        $quality = 50; // Set the compression quality (0-100)
        while ($row = mysqli_fetch_assoc($result)) {
            // Create a GD image from the blob data
            $source = imagecreatefromstring($row['image']);

            // Compress the image
            ob_start();
            imagejpeg($source, null, $quality);
            $compressedImage = ob_get_clean();

            // Update the record with the compressed image
            $id = $row['residentID'];
            $command = "UPDATE tbl_residents SET image = ? WHERE residentID = ?";
            $stmt = mysqli_prepare($conn, $command);
            mysqli_stmt_bind_param($stmt, "si", $compressedImage, $residentID);
            mysqli_stmt_execute($stmt);
        }
    // Close the database connection
    mysqli_close($conn);
}
function checkExistingResidents($userName){
    $conn = openCon();
    $command = "SELECT * from tbl_userAccounts WHERE `userName` = '$userName'";
    $result = mysqli_query($conn, $command);
    if(mysqli_num_rows($result) >= 1){
        mysqli_close($conn);
        return true;
    }else{
        mysqli_close($conn);
        return false;
    }
}
?>