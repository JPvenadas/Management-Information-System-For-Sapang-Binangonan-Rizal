<?php 
session_start(); 
include "../Functions/db_conn.php";
require "insertLogs.php";
$conn = openCon();

if (isset($_POST['uname']) && isset($_POST['password'])) {

	$uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);

	if (empty($uname)) {
		header("Location: ../index.php?error=User Name is required");
	    exit();
	}else if(empty($pass)){
        header("Location: ../index.php?error=Password is required");
	    exit();
	}else{
		$sql = "SELECT u.userName, u.password, u.userType, u.accountStatus, r.residentID, r.firstName,r.middleName, r.lastName, r.extension, r.image, e.signiture
		from tbl_userAccounts as u INNER JOIN tbl_residents as r on u.residentID = r.residentID
		LEFT JOIN tbl_employees as e on e.residentID = r.residentID
        WHERE u.userName = '$uname'";
	
		$result = mysqli_query($conn, $sql);
		
		if (mysqli_num_rows($result) >= 1) {
			$row = mysqli_fetch_assoc($result);
			mysqli_close($conn);


			if($row['accountStatus'] !== "Active"){
				header("Location: ../index.php?error=Your Account is Either Inactive or yet to be verified");
				exit();
			}
			
            if ($row['userName'] === $uname && password_verify($pass, $row['password'])) {
            	$_SESSION['username'] = $row['userName'];
				$_SESSION['userType'] = $row['userType'];
				$_SESSION['image'] = $row['image'];
				$_SESSION['firstName'] = $row['firstName'];
				$_SESSION['middleName'] = $row['middleName'];
				$_SESSION['lastName'] = $row['lastName'];
				$_SESSION['extension'] = $row['extension'];
				$_SESSION['residentID'] = $row['residentID'];
				$_SESSION['signiture'] = $row['signiture'];
				insertLogs("logged in");

				//save the access control for the user who logged in
				if($row['userType'] == "Staff"){
					include "getAccess.php";
					$access = getAccess();
					$_SESSION['access'] = $access;
				}
            	
				//redirect to their respective dashboard page
				if($row['userType'] == "Resident"){
					header("Location: ../Pages/Dashboard/Resident-Dashboard.php");
		        	exit();
				}else{
					header("Location: ../Pages/Dashboard/Dashboard.php");
		        	exit();
				}

            }else{
				header("Location: ../index.php?error=Incorect Username or password");
		        exit();
			}
		}else{
			header("Location: ../index.php?error=No such Username");
	        exit();
		}
	}
	
}else{
	header("Location: ../index.php");
	exit();
}