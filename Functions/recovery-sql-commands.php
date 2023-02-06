<?php
require "db_conn.php";

if(isset($_POST['submitUserName'])){
    $conn = openCon();
    $userName =$_POST['userName'];
    $command = "SELECT u.userName, u.accountStatus, r.contactNo 
                from tbl_userAccounts AS u 
                INNER JOIN tbl_residents as r 
                ON r.residentID = u.residentID
                where userName = '$userName'";
    $result = mysqli_query($conn, $command);
    $userName = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);

    if (sizeof($userName) === 1) {
        if($userName[0]['accountStatus'] == "Inactive"){
            header("Location: ../../Pages/Recovery/AccountRecovery.php?error=The User account is Inactive or yet to be verified");
	        exit();
        }
        elseif($userName[0]['contactNo'] == ""){
            header("Location: ../../Pages/Recovery/AccountRecovery.php?page=no contacts&hd=$ss");
	        exit();
        }else{
            $_SESSION['recovery-userName'] = $userName[0]['userName'];
            $_SESSION['recovery-contactNo'] = substr($userName[0]['contactNo'], -9);
            $_SESSION['OTP'] = generateRandomNumber();
        }

    }else{
        header("Location: ../../Pages/Recovery/AccountRecovery.php?error=No such Username");
	    exit();
    }
   
}


//function to generate 6 digit OTP
function generateRandomNumber() {
    return mt_rand(100000, 999999);
}
//if the resend code button is clicked.
if(isset($_POST['anotherCode'])){
    $_SESSION['OTP'] = generateRandomNumber();
}

//verify if the OTP is correct
if(isset($_POST['checkOTP'])){
    if($_POST['OTP'] == $_SESSION['OTP']){
        $_SESSION['OTP-approved'] = "Success";
        header("Location: ../../Pages/Recovery/AccountRecovery.php?page=change password");
	    exit();
    }else{
        header("Location: ../../Pages/Recovery/AccountRecovery.php?page=provide otp&error=Incorrect One time pin");
	    exit();
    }
}

if(isset($_POST['changePassword'])){
    $conn = openCon();
    $userName = validate($_SESSION['recovery-userName']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $command = "UPDATE `tbl_userAccounts` SET `password`='$password' WHERE `userName` = '$userName'";
    mysqli_query($conn, $command);
    mysqli_close($conn);
    session_unset();
    header("Location: ../../index.php?notif=Successfully changed Your Password");
	exit();
}

//function to get all the contacts in the database
function getContacts(){
    $conn = openCon();
    $command = "SELECT* FROM `tbl_contacts`";
    $result = mysqli_query($conn, $command);
    $contacts = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $contacts;

}
?>