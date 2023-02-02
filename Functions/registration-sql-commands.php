<?php
require "db_conn.php";

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
    setFileContent('profilePicture');
    $_SESSION['registration-profilePictureTitle'] = $_POST['profilePictureTitle'];
    setFileContent('residenceProof');
    $_SESSION['registration-residenceProofTitle'] = $_POST['residenceProofTitle'];
    $_SESSION['registration-mobileNumber'] = $_POST['mobileNumber'];
}
function setFileContent($content){
    if("" != trim($_POST["$content"])){
        $_SESSION["registration-$content"] = $_POST["$content"];
    }
}
?>