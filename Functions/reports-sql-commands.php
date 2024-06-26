<?php 

require "db_conn.php";
require "insertLogs.php";

    function applyFilterIfSet($field, $value){
        $command = " AND $field='$value' ";
        return $command;
    }
    function applyDateFilter($field, $start, $end){
        $command = " AND $field >= DATE_FORMAT('$start', '%Y-%m-%d') AND $field <= DATE_FORMAT('$end', '%Y-%m-%d')";
        return $command;
    }
    function getUsers(){
        $conn = openCon();
        $command = "SELECT `userName`,CONCAT(r.firstName,' ', r.middleName,' ', r.lastName, ' ' ,r.extension) as `fullName` , `userType`,`accountStatus` FROM `tbl_userAccounts` as u INNER JOIN tbl_residents as r on u.residentID = r.residentID Where 1";

        //apply the filters. if there is
        if(isset($_GET['userType'])){
           $command .= applyFilterIfSet('userType', validate($_GET['userType']));
        }
        if(isset($_GET['accountStatus'])){
            $command .= applyFilterIfSet('accountStatus', validate($_GET['accountStatus']));
        }
    
        $result = mysqli_query($conn, $command);
        $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        mysqli_close($conn);
        insertLogs("Generated Users Report");
        return $users;
    }

    function getTransactions(){
        $conn = openCon();
        $command = "SELECT CONCAT(r.firstName,' ', r.middleName,' ', r.lastName, ' ' ,r.extension) as `resident`, `serviceName`,DATE_FORMAT(dateRequested, '%b, %e %Y') as `dateRequested`,`amountPaid`,DATE_FORMAT(paymentDate, '%b, %e %Y') as `paymentDate`,`transactionStatus`, `purpose` FROM `tbl_transactions` as t inner JOIN tbl_residents as r on r.residentID = t.residentID WHERE transactionStatus != 'Unprocessed'";
        
        //apply the filters
        if(isset($_GET['service'])){
            $command .= applyFilterIfSet('serviceName', validate($_GET['service']));
        }
        if(isset($_GET['start']) and isset($_GET['end']) and !empty($_GET['start']) and !empty($_GET['end'])){
             $command .= applyDateFilter('paymentDate', $_GET['start'], $_GET['end'] );
        }

         $command .= " ORDER BY transactionID ";
        $result = mysqli_query($conn, $command);
        $transactions = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        mysqli_close($conn);
        insertLogs("Generated Transactions Report");
        return $transactions;
    }
    function getRevenues(){
        $conn = openCon();
        $command = "SELECT  SUM(`amountPaid`) as `totalRevenue`,  MIN(`paymentDate`) as `oldestPaymentDate` FROM `tbl_transactions` Where transactionStatus != 'Unprocessed'";
         //apply the filters
         if(isset($_GET['service'])){
            $command .= applyFilterIfSet('serviceName', validate($_GET['service']));
        }
        if(isset($_GET['start']) and isset($_GET['end']) and !empty($_GET['start']) and !empty($_GET['end'])){
             $command .= applyDateFilter('paymentDate', $_GET['start'], $_GET['end'] );
        }
        $result = mysqli_query($conn, $command);
        $revenue = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        mysqli_close($conn);
        return $revenue[0];
    }
    function getEmployees(){
        $conn = openCon();
        $command = "SELECT `employeeID`, CONCAT(r.firstName,' ', r.middleName,' ', r.lastName, ' ' ,r.extension) as `fullName`, `position`, IF(`committee` = 'N/A', 'none', `committee`) AS `committee` ,DATE_FORMAT(termStart, '%b, %e %Y') as `termStart`, DATE_FORMAT(termEnd, '%b, %e %Y') as `termEnd`, `termStatus` FROM `tbl_employees` e INNER JOIN tbl_residents as r on e.residentID = r.residentID WHERE 1";
        
        //apply the filters
        if(isset($_GET['position'])){
            $command .= applyFilterIfSet('position', validate($_GET['position']));
        }
        if(isset($_GET['termStatus'])){
            $command .= applyFilterIfSet('termStatus', validate($_GET['termStatus']));
        }

        $result = mysqli_query($conn, $command);
        $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        mysqli_close($conn);
        insertLogs("Generated Employees Report");
        return $users;
    }
    function getAttendance(){
        $conn = openCon();
        $command = "SELECT `attendanceID`, CONCAT(r.firstName,' ', r.middleName,' ', r.lastName, ' ' ,r.extension) as `fullName` ,e.position, DATE_FORMAT(a.date, '%b, %e %Y') as `date`, DATE_FORMAT(`timeIn`, '%h:%i %p') as `timeIn`, DATE_FORMAT(`timeOut`, '%h:%i %p') as `timeOut` FROM `tbl_attendance` as a INNER JOIN tbl_employees as e on e.employeeID = a.employeeID INNER JOIN tbl_residents as r on e.residentID = r.residentID";
        
        //apply the filters
        if(isset($_GET['employee'])){
            $command .= applyFilterIfSet('a.employeeID', validate($_GET['employee']));
        }
        if(isset($_GET['start']) and isset($_GET['end']) and !empty($_GET['start']) and !empty($_GET['end'])){
             $command .= applyDateFilter('Date', $_GET['start'], $_GET['end'] );
        }

        $result = mysqli_query($conn, $command);
        $attendance = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        mysqli_close($conn);
        insertLogs("Generated Attendance Report");
        return $attendance;
    }
    function getInventoryTransactions(){
        $conn = openCon();
        $command = "SELECT `transactionID`, CONCAT(r.firstName,' ', r.middleName,' ', r.lastName, ' ' ,r.extension) as `fullName`, l.itemName, DATE_FORMAT(t.date, '%b, %e %Y') as `date`, `quantity`,`status` FROM `tbl_inventoryTransaction` as t INNER JOIN tbl_inventoryList as l on t.itemID = l.itemID INNER JOIN tbl_residents as r on r.residentID = t.residentID";
        
         //apply the filters
        if(isset($_GET['item'])){
            $command .= applyFilterIfSet('t.itemID', validate($_GET['item']));
        }
        if(isset($_GET['start']) and isset($_GET['end']) and !empty($_GET['start']) and !empty($_GET['end'])){
             $command .= applyDateFilter('t.date', $_GET['start'], $_GET['end'] );
        }
        
        $result = mysqli_query($conn, $command);
        $transactions = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        mysqli_close($conn);
        insertLogs("Generated Inventory Transactions Report");
        return $transactions;
    }
    function getEvents(){
        $conn = openCon();
        $command = "SELECT `eventID`,`eventName`, CONCAT(DATE_FORMAT(start, '%b, %e %Y'), ' - ' ,DATE_FORMAT(end, '%b, %e %Y')) as `date`, `eventDescription` FROM `tbl_events` WHERE `archive` = 'false'";
        
        if(isset($_GET['start']) and isset($_GET['end']) and !empty($_GET['start']) and !empty($_GET['end'])){
            $command .= applyDateFilter('start', $_GET['start'], $_GET['end'] );
        }
        
        $result = mysqli_query($conn, $command);
        $events = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        mysqli_close($conn);
        insertLogs("Generated Events Report");
        return $events;
    }
    function getBlotters(){
        $conn = openCon();
        $command = "SELECT b.`blotterID`, b.`summary`, CONCAT(complainant.firstName, ' ', LEFT(complainant.middleName, 1), '. ', complainant.lastName, ' ', complainant.extension) AS `complainant`, CONCAT(defendant.firstName, ' ', LEFT(defendant.middleName, 1), '. ', defendant.lastName, ' ', defendant.extension) AS `defendant`, b.`caseStatus`, (SELECT COUNT(*) FROM `tbl_hearing` WHERE `blotterId` = b.`blotterID`) AS `totalHearing`, (SELECT MAX(`date`) FROM `tbl_hearing` WHERE `blotterId` = b.`blotterID`) AS `latestHearing` FROM `tbl_blotters` AS b INNER JOIN `tbl_residents` AS complainant ON complainant.residentID = b.complainant INNER JOIN `tbl_residents` AS defendant ON defendant.residentID = b.defendant WHERE b.archive = 'false'";
        
         //apply the filters
         if(isset($_GET['caseStatus'])){
            $command .= applyFilterIfSet('caseStatus', validate($_GET['caseStatus']));
        }
        if(isset($_GET['start']) and isset($_GET['end']) and !empty($_GET['start']) and !empty($_GET['end'])){
             $command .= applyDateFilter('COALESCE(hearing3, hearing2, hearing1)', $_GET['start'], $_GET['end'] );
        }
        
        $result = mysqli_query($conn, $command);
        $blotters = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        mysqli_close($conn);
        insertLogs("Generated Blotters Report");
        return $blotters;
    }
    function getAnnouncements(){
        $conn = openCon();
        $command = "SELECT `announcementID`, CONCAT(r.firstName, ' ', LEFT(r.middleName, 1),' ', r.lastName, ' ', r.extension) as `fullName`, `message`, DATE_FORMAT(datePosted, '%b, %e %Y') as `datePosted`, `postedBy`, `recepients` 
        FROM `tbl_announcements` as a inner JOIN tbl_residents as r on r.residentID = postedBy ";
        
        if(isset($_GET['start']) and isset($_GET['end']) and !empty($_GET['start']) and !empty($_GET['end'])){
            $command .= applyDateFilter('datePosted', $_GET['start'], $_GET['end'] );
        }
        
        $result = mysqli_query($conn, $command);
        $announcements = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        mysqli_close($conn);
        insertLogs("Generated Announcements Report");
        return $announcements;
    }

    function getLogs(){
        $conn = openCon();
        $command = "SELECT * FROM `tbl_activityLogs` WHERE 1";
         
         //apply the filters
         if(isset($_GET['user'])){
            $command .= applyFilterIfSet('userName', validate($_GET['user']));
        }
        if(isset($_GET['start']) and isset($_GET['end']) and !empty($_GET['start']) and !empty($_GET['end'])){
             $command .= applyDateFilter('date', $_GET['start'], $_GET['end'] );
        }

        $result = mysqli_query($conn, $command);
        $logs = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        mysqli_close($conn);
        return $logs;
    }

    function getResidents(){
        $conn = openCon();
        $command = "SELECT `residentID`, CONCAT(`firstName`, ' ',`middleName`, ' ', `lastName`, ' ', `extension`) as `fullName`, DATE_FORMAT(birthDate, '%b, %e %Y') as `birthDate`,`image`,`purok`,`exactAddress`,`voterStatus`,`sex`,`maritalStatus`, `occupation`,`contactNo`,`familyHead`,`archive`, `archiveReason`
        FROM `tbl_residents` WHERE `registrationStatus` = 'Verified'";

        //apply the filters. if set
        if(isset($_GET['sex'])){
            $command .= applyFilterIfSet('sex', validate($_GET['sex']));
         }
        if(isset($_GET['purok'])){
             $command .= applyFilterIfSet('purok', validate($_GET['purok']));
        }
        if(isset($_GET['voterStatus'])){
            $command .= applyFilterIfSet('voterStatus', validate($_GET['voterStatus']));
        }

        $result = mysqli_query($conn, $command);
        $residents = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        mysqli_close($conn);
        return $residents;
    }
    function getPuroks(){
        $conn = openCon();
        $command = "SELECT * FROM `tbl_purok` WHERE `archive` = 'false'";
        $result = mysqli_query($conn, $command);
        $puroks = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        mysqli_close($conn);
        return $puroks;
    }

    function getPositions(){
        $conn = openCon();
        $command = "SELECT * FROM `tbl_positions` WHERE `archive` = 'false'";
        $result = mysqli_query($conn, $command);
        $positions = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        mysqli_close($conn);
        return $positions;
    }
    function getServices(){
        $conn = openCon();
        $command = "SELECT * FROM `tbl_services` WHERE `archive` = 'false'";
        $result = mysqli_query($conn, $command);
        $services = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        mysqli_close($conn);
        return $services;
    }
    function getEmployeesWithAttendance(){
        $conn = openCon();
        $command = "SELECT DISTINCT a.employeeID, CONCAT(r.firstName,' ', r.middleName, ' ', r.lastName, ' ', r.extension) as fullName FROM tbl_attendance as a 
                    INNER JOIN tbl_employees as e on e.employeeID = a.employeeID
                    INNER JOIN tbl_residents as r on r.residentID = e.residentID";
        $result = mysqli_query($conn, $command);
        $employees = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        mysqli_close($conn);
        return $employees;
    }
    function getItemList(){
        $conn = openCon();
        $command = "SELECT * FROM `tbl_inventoryList` WHERE `archive` = 'false'";
        $result = mysqli_query($conn, $command);
        $items = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        mysqli_close($conn);
        return $items;
    }
    function getUsersWithLogs(){
        $conn = openCon();
        $command = "SELECT DISTINCT a.userName, CONCAT(r.firstName,' ', r.middleName, ' ', r.lastName, ' ', r.extension) as fullName FROM tbl_activityLogs as a INNER JOIN tbl_userAccounts as u on u.userName = a.userName INNER JOIN tbl_residents as r on r.residentID = u.residentID;";
        $result = mysqli_query($conn, $command);
        $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        mysqli_close($conn);
        return $users;
    }
?>