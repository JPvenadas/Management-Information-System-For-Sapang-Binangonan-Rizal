<?php 
session_start(); 
include "../Functions/db_conn.php";
$conn = openCon();

if (isset($_POST['uname']) && isset($_POST['password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);

	if (empty($uname)) {
		header("Location: ../index.php?error=User Name is required");
	    exit();
	}else if(empty($pass)){
        header("Location: ../index.php?error=Password is required");
	    exit();
	}else{
		$sql = "SELECT u.username, u.password, u.userType, u.verifyToken, pos.posName, r.residentsID, r.firstName,r.middleName, r.lastName, r.image
		from tbl_useraccounts as u inner JOIN tbl_personnel as p
		on u.personnelId = p.personnelID 
		inner join tbl_residents as r 
		on p.residentsID = r.residentsID
		inner join tbl_positions as pos 
		on p.position = pos.posID
		where u.username = '$uname'";
	
		$result = mysqli_query($conn, $sql);
		
		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
			mysqli_close($conn);

			if($row['verifyToken'] !== "Verified"){
				header("Location: ../index.php?error=Your Account needs to be validated");
				exit();
			}
			
            if ($row['username'] === $uname && password_verify($pass, $row['password'])) {
            	$_SESSION['username'] = $row['username'];
				$_SESSION['userType'] = $row['userType'];
				$_SESSION['position'] = $row['posName'];
				$_SESSION['image'] = $row['image'];
				$_SESSION['firstName'] = $row['firstName'];
				$_SESSION['middleName'] = $row['middleName'];
				$_SESSION['lastName'] = $row['lastName'];
				$_SESSION['residentsID'] = $row['residentsID'];
				insertLogs("Logged in");
            	header("Location: ../Modules/Dashboard/dashboard.php");
		        exit();
            }else{
				header("Location: ../index.php?error=Incorect User name or password");
		        exit();
			}
		}else{
			header("Location: ../index.php?error=Incorect User name or password");
	        exit();
		}
	}
	
}else{
	header("Location: ../index.php");
	exit();
}