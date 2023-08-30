<?php
require "db_conn.php";
require "insertLogs.php";
require "upload-image.php";

/*a function that you can call if you want to retain the inputs made by the user.
so that if they click the previous button. the inputs will still be saved*/
function inputContent($content){
    if(isset($_SESSION["registration-$content"])){
        echo $_SESSION["registration-$content"];
    }
}

function checkradio($content){
    if(isset($_SESSION['registration-familyHead'])){
        if($_SESSION['registration-familyHead'] == $content){
            echo "checked";
        }
    }
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

//if the next button is clicked in the step 2 registration. the inputs will be saved
if(isset($_POST['next2'])){
    $_SESSION['registration-firstName'] = $_POST['firstName'];
    $_SESSION['registration-middleName'] = $_POST['middleName'];
    $_SESSION['registration-lastName'] = $_POST['lastName'];
    $_SESSION['registration-extension'] = $_POST['extension'];
    $_SESSION['registration-birthDate'] = $_POST['birthDate'];
    $userName = "@" . $_POST['firstName'] . $_POST['middleName'] . $_POST['lastName'] . $_POST['extension'];
    $userName = str_replace(' ', '', $userName);

    if(checkExistingResidents($userName)){
        header("Location: ../../index.php?error=You are already registered");
        exit();
    }else{
        header("Location: ?step=3");
        exit();
    }
}

if(isset($_POST['next3'])){
    $_SESSION['registration-sex'] = $_POST['sex'];
    $_SESSION['registration-purok'] = $_POST['purok'];
    $_SESSION['registration-address'] = $_POST['address'];
    $_SESSION['registration-voterStatus'] = $_POST['voterStatus'];
    $_SESSION['registration-maritalStatus'] = $_POST['maritalStatus'];
    $_SESSION['registration-occupation'] = $_POST['occupation'];
    $_SESSION['registration-residentCategory'] = $_POST['residentCategory'];
    $_SESSION['registration-familyHead'] = $_POST['familyHead'];
    $_SESSION['registration-familyMembers'] = $_POST['familyMembers'];
}
if(isset($_POST['next4'])){
    if(!isset($_SESSION['registration-profilePicture']) and !isset($_SESSION['registration-residenceProof'])){
        //save the profile picture
        $profilePicture = saveImage($_FILES['profilePicture'], "../../Upload-img/");
        if($profilePicture['saved']){
            $_SESSION['registration-profilePicture'] = $profilePicture['result'];
        }else{
            //if there is an error show it
            $error = $profilePicture['result'];
            header("Location: ?step=4&error=$error");
            exit();
        }
        //save the residence proof
        $residenceProof = saveImage($_FILES['residenceProof'], "../../Upload-img/");
        if($residenceProof['saved']){
            $_SESSION['registration-residenceProof'] = $residenceProof['result'];
        }else{
            //if there is an error show it
            $error = $residenceProof['result'];
            header("Location: ?step=4&error=$error");
            exit();
        }
    }
    //save the mobile number
    $_SESSION['registration-mobileNumber'] = $_POST['mobileNumber'];
}

if(isset($_POST['signup'])){
    $conn = openCon();
    $firstName = validate($_SESSION['registration-firstName']);
    $lastName = validate($_SESSION['registration-lastName']);
    $middleName = validate($_SESSION['registration-middleName']);
    $extension = validate($_SESSION['registration-extension']);
    $birthDate = validate($_SESSION['registration-birthDate']);
    $address = validate($_SESSION['registration-address']);
    $profilePicture = $_SESSION['registration-profilePicture'];
    $sex = validate($_SESSION['registration-sex']);
    $purok = validate($_SESSION['registration-purok']);
    $voterStatus = validate($_SESSION['registration-voterStatus']);
    $maritalStatus = validate($_SESSION['registration-maritalStatus']);
    $occupation = validate($_SESSION['registration-occupation']);
    $familyHead = validate($_SESSION['registration-familyHead']);
    $familyMembers = $_SESSION['registration-familyMembers'];
    $archive = "false";
    $registrationStatus = 'Unverified';
    $mobileNumber = '09' . validate($_SESSION['registration-mobileNumber']);
    $residenceProof = $_SESSION['registration-residenceProof'];
    $userName = "@$firstName$middleName$lastName$extension";
    $userName = str_replace(' ', '', $userName);

    $command = "INSERT INTO `tbl_residents`(`firstName`, `middleName`, `lastName`, `extension`, `birthDate`, `image`, `purok`, `exactAddress`, `voterStatus`, `sex`, `maritalStatus`, `occupation`, `familyHead`, `familyMembers`, `archive`, `contactNo`, `residenceProof`, `registrationStatus`) 
    VALUES ('$firstName','$middleName','$lastName','$extension','$birthDate','$profilePicture','$purok','$address','$voterStatus','$sex','$maritalStatus','$occupation','$familyHead','$familyMembers','$archive','$mobileNumber','$residenceProof', '$registrationStatus')";
    mysqli_query($conn, $command);
    $residentID =  mysqli_insert_id($conn);
    mysqli_close($conn);

    $conn = openCon();
    //user account registration
    $firstName = validate($_SESSION['registration-firstName']);
    $middleName = validate($_SESSION['registration-middleName']);
    $lastName = validate($_SESSION['registration-lastName']);
    $extension = validate($_SESSION['registration-extension']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $userType = "Resident";
    $accountStatus = "Inactive";
    $command = "INSERT INTO `tbl_userAccounts`(`userName`, `residentID`, `password`, `userType`, `accountStatus`) 
                VALUES ('$userName','$residentID','$password','$userType','$accountStatus')" ;
    mysqli_query($conn, $command);
    mysqli_close($conn);
    session_unset();
    header("Location: ?step=done&username=$userName");
    exit();
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