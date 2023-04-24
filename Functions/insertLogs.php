<?php
    function insertLogs($action){
        $conn = openCon();
        $userName = $_SESSION['username'];
        $userType = $_SESSION['userType'];
        $command = "INSERT INTO `tbl_activityLogs`(`userName`, `userType`, `action`) VALUES ('$userName','$userType','$action')";
        mysqli_query($conn, $command);
        mysqli_close($conn);
        return true;
        }
        function logout($userName, $userType){
            $conn = openCon();
            $command = "INSERT INTO `tbl_activityLogs`(`userName`, `userType`, `action`) VALUES ('$userName','$userType','Logged out')";
            mysqli_query($conn, $command);
            mysqli_close($conn);
            return true;
            }
?>