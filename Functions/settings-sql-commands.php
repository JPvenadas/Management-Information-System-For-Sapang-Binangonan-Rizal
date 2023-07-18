<?php
// connection to mysql
require "db_conn.php";
require "insertLogs.php";

// get services offered in the database
function getServices(){
    $conn = openCon();
    $command = "SELECT * FROM `tbl_services` where archive = 'false'";
    $result = mysqli_query($conn, $command);
    $services = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
    return $services;
}
// get all the puroks in the database
function getPurok(){
    $conn = openCon();
    $command = "SELECT * FROM `tbl_purok` WHERE archive = 'false'";
    $result = mysqli_query($conn, $command);
    $purok = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
    return $purok;
}
// get all the personnel's position in the database
function getPositions(){
    $conn = openCon();
    $command = "SELECT * FROM `tbl_positions` WHERE archive = 'false'";
    $result = mysqli_query($conn, $command);
    $position = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
    return $position;
}
function getCommittees(){
    $conn = openCon();
    $command = "SELECT * FROM `tbl_committee` WHERE archive = 'false' and committee != 'N/A'";
    $result = mysqli_query($conn, $command);
    $position = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
    return $position;
}
//change the amount/fee of the service if the "change amount" button is clicked
if(isset($_POST['change_amount'])){
    $conn = openCon();
    $newAmount = validate($_POST['serviceFee']);
    $serviceID = $_POST['serviceID'];
    $command = "UPDATE `tbl_services` SET `serviceFee`='$newAmount' WHERE `serviceName` = '$serviceID'";
    mysqli_query($conn, $command);
    mysqli_close($conn);
    insertLogs("Change the amount of a service with ID: $serviceID");
}
// add the purok in the database
if(isset($_POST['add_purok'])){
    $conn = openCon();
    $purokName = validate($_POST['purokName']);
    if(checkExistingRecord('tbl_purok', 'purok', $purokName)){
        header("Location: ?page=purok&error=Name already taken");
        exit();
    }else{
        $command = "INSERT INTO `tbl_purok`(`purok`, `archive`) VALUES ('$purokName','false')";
        mysqli_query($conn, $command);
        mysqli_close($conn);
        insertLogs("Added a purok");
    }
}
// edit and update the purok
if(isset($_POST['edit_purok'])){
    $conn = openCon();
    $purokID = validate($_POST['purokID']);
    $purokName = validate($_POST['purokName']);
    if(checkExistingRecord('tbl_purok', 'purok', $purokName)){
        header("Location: ?page=purok&error=Name already taken");
        exit();
    }else{
        $command = "UPDATE `tbl_purok` SET `purok`='$purokName' WHERE `purok` = '$purokID'";
        mysqli_query($conn, $command);
        mysqli_close($conn);
        insertLogs("Updated a Purok information with a name: $purokID");
    }
}
// archive a certain purok if the archived button is clicked
if(isset($_POST['archive_purok'])){
    $conn = openCon();
    $purokID = validate($_POST['purokID']);
    $command = "UPDATE `tbl_purok` SET `archive`= 'true' WHERE `purok` = '$purokID'";
    mysqli_query($conn, $command);
    mysqli_close($conn);
    insertLogs("Archived a Purok with a name: $purokID");
}
// add new personnel's position
if(isset($_POST['add_position'])){
    $conn = openCon();
    $positionName = validate($_POST['positionName']);
    if(checkExistingRecord('tbl_positions', 'position', $positionName)){
        header("Location: ?page=positions&error=Position already exists");
        exit();
    }else{
        $command = "INSERT INTO `tbl_positions`(`position`, `archive`) VALUES ('$positionName','false')";
        mysqli_query($conn, $command);
        mysqli_close($conn);
        insertLogs("Added an employee position");
    }
}
// edit a certain personnel's position
if(isset($_POST['edit_position'])){
    $conn = openCon();
    $positionID = validate($_POST['positionID']);
    $positionName = validate($_POST['positionName']);
    if(checkExistingRecord('tbl_positions', 'position', $positionName)){
        header("Location: ?page=positions&error=Position already exists");
        exit();
    }else{
        $command = "UPDATE `tbl_positions` SET `position`='$positionName' WHERE `position` = '$positionID'";
        mysqli_query($conn, $command);
        mysqli_close($conn);
        insertLogs("Updated a position information with a name: $positionID");
    }
}
// archive a certain position if the "archive" button is clicked
if(isset($_POST['archive_position'])){
    $conn = openCon();
    $positionID = validate($_POST['positionID']);
    $command = "UPDATE `tbl_positions` SET `archive`='true' WHERE `position` = '$positionID'";
    mysqli_query($conn, $command);
    mysqli_close($conn);
    insertLogs("Archived a Position with a Name: $positionID");
}
if(isset($_POST['add_committee'])){
    $conn = openCon();
    $committee = validate($_POST['committee']);
    if(checkExistingRecord('tbl_committee', 'committee', $committee)){
        header("Location: ?page=positions&error=Committee already exists");
        exit();
    }else{
        $command = "INSERT INTO `tbl_committee`(`committee`, `archive`) VALUES ('$committee','false')";
        mysqli_query($conn, $command);
        mysqli_close($conn);
        insertLogs("Added a committee");
    }
}
// edit a certain personnel's position
if(isset($_POST['edit_committee'])){
    $conn = openCon();
    $committeeID = $_POST['committeeID'];
    $committee = $_POST['committee'];
    if(checkExistingRecord('tbl_committee', 'committee', $committee)){
        header("Location: ?page=positions&error=Committee already exists");
        exit();
    }else{
        $command = "UPDATE `tbl_committee` SET `committee`='$committee' WHERE `committee` = '$committeeID'";
        mysqli_query($conn, $command);
        mysqli_close($conn);
        insertLogs("Updated a committe information with a Name: $committee");
    }
}
// archive a certain position if the "archive" button is clicked
if(isset($_POST['archive_committee'])){
    $conn = openCon();
    $committeeID = $_POST['committeeID'];
    $command = "UPDATE `tbl_committee` SET `archive`='true' WHERE `committee` = '$committeeID'";
    mysqli_query($conn, $command);
    mysqli_close($conn);
    insertLogs("Archived a committee with  a Name: $committeeID");
}
//create backup
if(isset($_POST['create_backup'])){
    insertLogs("Generated a backup file");
    EXPORT_DATABASE('localhost','id20695988_root','-I=cKF^|&6+|pB}2','id20695988_db_sapangmis'); 
    
}
if(isset($_POST['restore_backup'])){
     $conn = openCon();
     $file = $_FILES["backup"]["tmp_name"];
     insertLogs("Restored a backup file");
     restoreMysqlDB($file, $conn);
}
function EXPORT_DATABASE($host,$user,$pass,$name,       $tables=false, $backup_name=false)
{ 
	 $mysqli = new mysqli($host,$user,$pass,$name); $mysqli->select_db($name); $mysqli->query("SET NAMES 'utf8'");
	$queryTables = $mysqli->query('SHOW TABLES'); while($row = $queryTables->fetch_row()) { $target_tables[] = $row[0]; }	if($tables !== false) { $target_tables = array_intersect( $target_tables, $tables); } 
	$content = "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\r\nSET time_zone = \"+00:00\";\r\n\r\n\r\n/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;\r\n/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;\r\n/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;\r\n/*!40101 SET NAMES utf8 */;\r\n--\r\n-- Database: `".$name."`\r\n--\r\n\r\n\r\n";
	foreach($target_tables as $table){
		if (empty($table)){ continue; } 
		$result	= $mysqli->query('SELECT * FROM `'.$table.'`');  	$fields_amount=$result->field_count;  $rows_num=$mysqli->affected_rows; 	$res = $mysqli->query('SHOW CREATE TABLE '.$table);	$TableMLine=$res->fetch_row(); 
		$content .= "\n\n".$TableMLine[1].";\n\n";   $TableMLine[1]=str_ireplace('CREATE TABLE `','CREATE TABLE IF NOT EXISTS `',$TableMLine[1]);
		for ($i = 0, $st_counter = 0; $i < $fields_amount;   $i++, $st_counter=0) {
			while($row = $result->fetch_row())	{ //when started (and every after 100 command cycle):
				if ($st_counter%100 == 0 || $st_counter == 0 )	{$content .= "\nINSERT INTO ".$table." VALUES";}
					$content .= "\n(";    for($j=0; $j<$fields_amount; $j++){ $row[$j] = str_replace("\n","\\n", addslashes($row[$j]) ); if (isset($row[$j])){$content .= '"'.$row[$j].'"' ;}  else{$content .= '""';}	   if ($j<($fields_amount-1)){$content.= ',';}   }        $content .=")";
				//every after 100 command cycle [or at last line] ....p.s. but should be inserted 1 cycle eariler
				if ( (($st_counter+1)%100==0 && $st_counter!=0) || $st_counter+1==$rows_num) {$content .= ";";} else {$content .= ",";}	$st_counter=$st_counter+1;
			}
		} $content .="\n\n\n";
	}
	$content .= "\r\n\r\n/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;\r\n/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;\r\n/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;";
	$backup_name = $backup_name ? $backup_name : $name.'___('.date('H-i-s').'_'.date('d-m-Y').').sql';
	ob_get_clean(); header('Content-Type: application/octet-stream');  header("Content-Transfer-Encoding: Binary");  header('Content-Length: '. (function_exists('mb_strlen') ? mb_strlen($content, '8bit'): strlen($content)) );    header("Content-disposition: attachment; filename=\"".$backup_name."\""); 
	echo $content; exit;
}
function DropTables(){
    $conn = openCon();
    $command = "DROP TABLE IF EXISTS tbl_accessControl, tbl_attendance, tbl_committee, tbl_contacts, tbl_employees, tbl_events, tbl_inventoryList, tbl_positions, tbl_purok, tbl_residents, tbl_services, tbl_transactions, tbl_userAccounts, tbl_announcements, tbl_curfewViolators, tbl_hearings, tbl_blotters, tbl_activityLogs, tbl_addedStocks, tbl_inventoryTransaction";
    mysqli_query($conn, $command);
}
function restoreMysqlDB($filePath, $conn)
{
    DropTables();
    $sql = '';
    $error = '';
    
    if (file_exists($filePath)) {
        $lines = file($filePath);
        
        foreach ($lines as $line) {
            
            // Ignoring comments from the SQL script
            if (substr($line, 0, 2) == '--' || $line == '') {
                continue;
            }
            
            $sql .= $line;
            
            if (substr(trim($line), - 1, 1) == ';') {
                $result = mysqli_query($conn, $sql);
                if (! $result) {
                    $error .= mysqli_error($conn) . "\n";
                }
                $sql = '';
            }
        } // end foreach
        
       
    }
}

//function to get all the contacts in the database
function getContacts(){
    $conn = openCon();
    $command = "SELECT* FROM `tbl_contacts`";
    $result = mysqli_query($conn, $command);
    $contacts = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_close($conn);
    return $contacts[0];

}
if(isset($_POST['save-contacts'])){
    $conn = openCon();
    $webLink = validate($_POST['contact-webLink']);
    $phone = validate($_POST['contact-phone']);
    $facebook = validate($_POST['contact-facebook']);
    $email = validate($_POST['contact-email']);
    $telegram = validate($_POST['contact-telegram']);
    $address = validate($_POST['contact-address']);
    $gcash = validate($_POST['contact-gcash']);
    $command = "UPDATE `tbl_contacts` SET `webLink`='$webLink',`phone`='$phone',`facebook`='$facebook',`email`='$email',`telegram`='$telegram',`address`='$address',`gcash`='$gcash' WHERE 1";
    mysqli_query($conn, $command);
    mysqli_close($conn);
    insertLogs("Updated the baranggay Contacts");
}
if(isset($_POST['add_service'])){
    $conn = openCon();
    $serviceName = validate($_POST['serviceName']);
    $serviceFee = validate($_POST['serviceFee']);
    if(checkExistingRecord('tbl_services', 'serviceName', $serviceName)){
        header("Location: ?page=services&error=Service already exists");
        exit();
    }else{
        $command = "INSERT INTO `tbl_services`(`serviceName`, `serviceFee`, `archive`, `serviceType`)  
                                    VALUES ('$serviceName','$serviceFee','false','Non-document')";
        mysqli_query($conn, $command);
        $addedService = mysqli_insert_id($conn);
        mysqli_close($conn);
        insertLogs("Add a service with ID: $addedService");
    }
}
if(isset($_POST['archive_service'])){
    $conn = openCon();
    $serviceID = $_POST['serviceID'];
    $command = "UPDATE `tbl_services` SET `archive`='true' WHERE `serviceName` = '$serviceID'";
    mysqli_query($conn, $command);
    mysqli_close($conn);
    insertLogs("Archived a service with ID: $serviceID");
}

function checkExistingRecord($table, $primaryField, $value){
    $conn = openCon();
    $command = "SELECT * from $table WHERE `$primaryField` = '$value'";
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