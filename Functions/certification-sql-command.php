<?php
require "db_conn.php";

    function getIssuer($residentID){
        $conn = openCon();
        $command = "SELECT CONCAT(firstName,' ',LEFT(middleName, 1),'. ',lastName,' ', extension) as fullName,`purok`, `birthDate` FROM tbl_residents  
                    Where  `residentID` = '$residentID' and archive = 'false'";
        $result = mysqli_query($conn, $command);
        $resident = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        mysqli_close($conn);
        return $resident[0];
    }

    function GetEmployee($position){
        $conn = openCon();
        $command = "SELECT CONCAT(firstName,' ',LEFT(middleName, 1),'. ',lastName,' ', extension) as fullName, extension, signiture, position FROM `tbl_residents` as r
                    INNER JOIN tbl_employees as e on r.residentID = e.residentID 
                    where position = '$position' and termStatus = 'Active'";
        $result = mysqli_query($conn, $command);
        $employee = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        mysqli_close($conn);
        return $employee[0];
    }
    function getServices(){
        $conn = openCon();
        $id = $_GET['service'];
        $command = "select * from tbl_services where serviceName = '$id'";
        $result = mysqli_query($conn, $command);
        $services = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        mysqli_close($conn);
        return $services[0];
    }
    
    function getSingleTransaction(){
        $conn = openCon();
        $id = $_GET['transaction'];
        $command = "select * from tbl_transactions where transactionID = '$id'";
        $result = mysqli_query($conn, $command);
        $transaction = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        mysqli_close($conn);
        if(isset($transaction[0])){
            return $transaction[0];
        }
        else{
            return;
        }
    }
    function verifyPayment($transaction){
        
        if(isset($transaction)){
            if($transaction['residentID'] == $_GET['id'] and $transaction['serviceName'] == $_GET['service']){
                return true;
            }
            else{
                return false;
            }

        }else{
            return false;
        }
    }
?>