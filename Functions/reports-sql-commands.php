<?php 

require "db_conn.php";

    function getUsers(){
        $conn = openCon();
        $command = "SELECT `userName`,CONCAT(r.firstName,' ', r.middleName,' ', r.lastName, ' ' ,r.extension) as `fullName` , `userType`,`accountStatus` FROM `tbl_userAccounts` as u INNER JOIN tbl_residents as r on u.residentID = r.residentID";
        $result = mysqli_query($conn, $command);
        $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        mysqli_close($conn);
        return $users;
    }
    function getTransactions(){
        $conn = openCon();
        $command = "SELECT CONCAT(r.firstName,' ', r.middleName,' ', r.lastName, ' ' ,r.extension) as `resident`, `serviceName`,DATE_FORMAT(dateRequested, '%b, %e %Y') as `dateRequested`,`amountPaid`,DATE_FORMAT(paymentDate, '%b, %e %Y') as `paymentDate`,`transactionStatus`, `purpose` FROM `tbl_transactions` as t inner JOIN tbl_residents as r on r.residentID = t.residentID WHERE transactionStatus != 'Unprocessed'  ORDER BY transactionID";
        $result = mysqli_query($conn, $command);
        $transactions = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        mysqli_close($conn);
        return $transactions;
    }
    function getEmployees(){
        $conn = openCon();
        $command = "SELECT `employeeID`, CONCAT(r.firstName,' ', r.middleName,' ', r.lastName, ' ' ,r.extension) as `fullName`, `position`, IF(`committee` = 'N/A', 'none', `committee`) AS `committee` ,DATE_FORMAT(termStart, '%b, %e %Y') as `termStart`, DATE_FORMAT(termEnd, '%b, %e %Y') as `termEnd` FROM `tbl_employees` e INNER JOIN tbl_residents as r on e.residentID = r.residentID;";
        $result = mysqli_query($conn, $command);
        $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        mysqli_close($conn);
        return $users;
    }
    function getAttendance(){
        $conn = openCon();
        $command = "SELECT `attendanceID`, CONCAT(r.firstName,' ', r.middleName,' ', r.lastName, ' ' ,r.extension) as `fullName` ,e.position, DATE_FORMAT(a.date, '%b, %e %Y') as `date`, DATE_FORMAT(`timeIn`, '%h, %i %p') as `timeIn`, DATE_FORMAT(`timeOut`, '%h, %i %p') as `timeOut` FROM `tbl_attendance` as a INNER JOIN tbl_employees as e on e.employeeID = a.employeeID INNER JOIN tbl_residents as r on e.residentID = r.residentID";
        $result = mysqli_query($conn, $command);
        $attendance = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        mysqli_close($conn);
        return $attendance;
    }
    function getInventoryTransactions(){
        $conn = openCon();
        $command = "SELECT `transactionID`, CONCAT(r.firstName,' ', r.middleName,' ', r.lastName, ' ' ,r.extension) as `fullName`, l.itemName, DATE_FORMAT(t.date, '%b, %e %Y') as `date`, `quantity`,`status` FROM `tbl_inventoryTransaction` as t INNER JOIN tbl_inventoryList as l on t.itemID = l.itemID INNER JOIN tbl_residents as r on r.residentID = t.residentID";
        $result = mysqli_query($conn, $command);
        $transactions = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        mysqli_close($conn);
        return $transactions;
    }
    function getEvents(){
        $conn = openCon();
        $command = "SELECT `eventID`,`eventName`, CONCAT(DATE_FORMAT(start, '%b, %e %Y'), ' - ' ,DATE_FORMAT(end, '%b, %e %Y')) as `date`, `eventDescription` FROM `tbl_events` WHERE `archive` = 'false'";
        $result = mysqli_query($conn, $command);
        $events = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        mysqli_close($conn);
        return $events;
    }
    function getBlotters(){
        $conn = openCon();
        $command = "SELECT `blotterID` ,`summary`, CONCAT(complainant.firstName,' ', LEFT(complainant.middleName,1), '. ', complainant.lastName, ' ', complainant.extension) as `complainant`, CONCAT(defendant.firstName,' ', LEFT(defendant.middleName,1), '. ', defendant.lastName, ' ', defendant.extension) as `defendant`, `caseStatus`, RIGHT(complainant.contactNo, 9) as `complainantContact`, RIGHT(defendant.contactNo, 9) as `defendantContact`, COALESCE(hearing3, hearing2, hearing1) AS latestHearing, ((hearing1 IS NOT NULL) + (hearing2 IS NOT NULL) + (hearing3 IS NOT NULL)) as totalHearing, `caseStatus` FROM `tbl_blotters` as b INNER JOIN tbl_residents as complainant on complainant.residentID = b.complainant INNER JOIN tbl_residents as defendant on defendant.residentID = b.defendant WHERE b.archive = 'false';";
        $result = mysqli_query($conn, $command);
        $blotters = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        mysqli_close($conn);
        return $blotters;
    }
    function getAnnouncements(){
        $conn = openCon();
        $command = "SELECT `announcementID`, CONCAT(r.firstName, ' ', LEFT(r.middleName, 1),' ', r.lastName, ' ', r.extension) as `fullName`, `message`, `datePosted`, `postedBy`, `recepients` 
        FROM `tbl_announcements` as a inner JOIN tbl_residents as r on r.residentID = postedBy ";
        $result = mysqli_query($conn, $command);
        $announcements = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        mysqli_close($conn);
        return $announcements;
    }
?>