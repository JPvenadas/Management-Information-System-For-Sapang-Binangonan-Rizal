<?php
 require "db_conn.php";
 require "insertLogs.php";

 function getItemList(){
    $conn = openCon();
    $command = "SELECT * FROM `tbl_inventoryList` WHERE archive = 'false'";
    $command = $command . addSearchFilterItems();
    $result = mysqli_query($conn, $command);
    $items = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
    return $items;
 }
 function getTransactions(){
   $conn = openCon();
   $command = "SELECT `transactionID`, t.residentID, CONCAT(r.firstName,' ', LEFT(r.middleName,1), '. ', r.lastName, ' ', r.extension) as `fullName`, t.itemID,i.itemName,`date`,`quantity`,`status` FROM `tbl_inventoryTransaction` as t INNER JOIN tbl_residents as r on t.residentID = r.residentID INNER JOIN tbl_inventoryList as i on t.itemID = i.itemID WHERE t.archive = 'false'";
   $command = $command . addFilters() . addSearchFilterTransaction() . " order by `transactionID` DESC";
   $result = mysqli_query($conn, $command);
   $transactions = mysqli_fetch_all($result, MYSQLI_ASSOC);
   mysqli_free_result($result);
   mysqli_close($conn);
   return $transactions;
 }
 function addSearchFilterTransaction(){
   if(isset($_GET['search'])){
      $search = validate($_GET['search']);
      $additionalCommand = " and CONCAT(r.firstName,' ', LEFT(r.middleName, 1),' ', r.lastName ) LIKE '%$search%'
      or i.itemName LIKE '%$search%' or i.itemID LIKE '%$search%'";
      return $additionalCommand;
   }
   return "";
 }
 function addSearchFilterItems(){
   if(isset($_GET['search'])){
      $search = $_GET['search'];
      $additionalCommand = " and itemName LIKE '%$search%' or itemID LIKE '%$search%'";
      return $additionalCommand;
   }
   return "";
 }
 function addFilters(){
   if(isset($_GET['filter']) and $_GET['filter'] == 'returned'){
      $additionalCommand = " and status = 'Returned'";
   }else{
      $additionalCommand = " and status = 'Borrowed'";
   }
   return $additionalCommand;
 }
 if(isset($_POST['search_button'])){
   $filter = $_POST['search_filter'];
   $search = $_POST['search_input'];
   header("Location: ../Pages/Inventory/Inventory.php?filter=$filter&search=$search");
	exit();
 }
 if(isset($_POST['add_item'])){
   $conn = openCon();
   $name = validate($_POST['item_name']);
   $quantity = validate($_POST['item_quantity']);
   $command = "INSERT INTO `tbl_inventoryList`(`itemName`, `totalNumber`, `archive`) 
                                       VALUES ('$name','$quantity','false')";
   mysqli_query($conn, $command);
   $addedID = mysqli_insert_id($conn);
   mysqli_close($conn);
   insertLogs("Added an item in inventory with ID: $addedID");
 }

 function getSingleItem(){
   $conn = openCon();
   $id = $_GET['id'];
   $command = "SELECT * FROM `tbl_inventoryList` WHERE itemID = '$id'";
   $result = mysqli_query($conn, $command);
   $items = mysqli_fetch_all($result, MYSQLI_ASSOC);
   mysqli_free_result($result);
   $addedID = mysqli_insert_id($conn);
   mysqli_close($conn);
   return $items[0];
 }
 if(isset($_POST['archive_item'])){
   $conn = openCon();
   $id = $_POST['itemID'];
   $command = "UPDATE `tbl_inventoryList` set `archive` = 'true' WHERE `itemID` = '$id'";
   mysqli_query($conn, $command);
   mysqli_close($conn);
   insertLogs("Archived an item with ID: $id");
   header("Location: ../../Pages/Inventory/Inventory.php");
	exit();
 }
 if(isset($_POST['add_stock_submit'])){
   updateQuantity($_POST['quantity'], "add");
   recordStocksAdded();

 }
 function updateQuantity($quantity, $operation){
   $conn = openCon();
   $id = validate($_POST['itemID']);
   if($operation == "add"){
    $command = "UPDATE tbl_inventoryList SET totalNumber = totalNumber + $quantity WHERE itemID = '$id'";
   }else{
    $command = "UPDATE tbl_inventoryList SET totalNumber = totalNumber - $quantity WHERE itemID = '$id'";
   }
   mysqli_query($conn, $command);
   mysqli_close($conn);
 }
 function recordStocksAdded(){
   $conn = openCon();
   $id = validate($_POST['itemID']);
   $quantity = validate($_POST['quantity']);
   $command = "INSERT INTO `tbl_addedStocks`(`itemID`, `stocksAdded`) VALUES ('$id','$quantity')";
   mysqli_query($conn, $command);
   mysqli_close($conn);
   insertLogs("Added stocks to an item with ID: $id");
 }
 function getResidents(){
  $conn = openCon();
  $command = "SELECT r.residentID, CONCAT(`firstName`,' ', LEFT(`middleName`, 1),' ',`lastName`,' ', `extension`) as `fullName`,`birthDate`,`image`, `purok`
              FROM tbl_residents as r INNER JOIN tbl_userAccounts as u on u.residentID = r.residentID
              WHERE r.archive = 'false' and r.registrationStatus = 'Verified'";
  $result = mysqli_query($conn, $command);
  $residents = mysqli_fetch_all($result, MYSQLI_ASSOC);
  mysqli_free_result($result);
  mysqli_close($conn);
  return $residents;
}
  function getAvailableItems(){
    $conn = openCon();
    $command = "SELECT * FROM `tbl_inventoryList` WHERE `archive` = 'false' and `totalNumber` > 0";
    $result = mysqli_query($conn, $command);
    $items = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
    return $items;
  }
  function addTransaction(){
    $conn = openCon();
    $residentID = validate($_POST['residentID']);
    $itemID = validate($_POST['itemID']);
    $quantity = validate($_POST['quantity']);

    $command = "INSERT INTO `tbl_inventoryTransaction`(`residentID`, `itemID`, `quantity`, `status`,`archive`) 
                                               VALUES ('$residentID','$itemID','$quantity','Borrowed','false')";
    mysqli_query($conn, $command);
    $addedID = mysqli_insert_id($conn);
    mysqli_close($conn);
    insertLogs("Assist in borrowing an item with Transaction ID: $addedID");
  }
  if(isset($_POST['borrow_item'])){
    updateQuantity($_POST['quantity'], "subtract");
    addTransaction();
  }
  function getTransactionsByItem(){
    $conn = openCon();
    $id = $_GET['id'];
    $command = "SELECT `transactionID`, t.residentID, CONCAT(r.firstName,' ', LEFT(r.middleName,1), '. ', r.lastName, ' ', r.extension) as `fullName`, t.itemID,i.itemName,`date`,`quantity`,`status` FROM `tbl_inventoryTransaction` as t INNER JOIN tbl_residents as r on t.residentID = r.residentID INNER JOIN tbl_inventoryList as i on t.itemID = i.itemID WHERE t.archive = 'false' and status='Borrowed' and t.itemID = '$id' ORDER by t.date DESC";
    $result = mysqli_query($conn, $command);
    $transactions = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
    return $transactions;
  }
  if(isset($_POST['edit_item_name'])){
   $conn = openCon();
   $id = validate($_POST['itemID']);
   $name = validate($_POST['itemName']);
   $command = "UPDATE tbl_inventoryList SET itemName = '$name' WHERE itemID = '$id'";
   mysqli_query($conn, $command);
   mysqli_close($conn);
   insertLogs("Edit the name of the item with ID: $id to $name");
  }
  if(isset($_POST['archive_transaction'])){
    $conn = openCon();
    $id = validate($_POST['transactionID']);
    $command = "UPDATE `tbl_inventoryTransaction` set `archive` = 'true' WHERE `transactionID` = '$id'";
    mysqli_query($conn, $command);
    mysqli_close($conn);
    insertLogs("Archive an inventory transaction with ID: $id");
    header("Location: ../../Pages/Inventory/Inventory.php");
	  exit();
  }
  if(isset($_POST['return_item'])){
    $conn = openCon();
    $id = $_POST['transactionID'];
    $command = "UPDATE `tbl_inventoryTransaction` set `status` = 'Returned' WHERE `transactionID` = '$id'";
    mysqli_query($conn, $command);
    mysqli_close($conn);
    insertLogs("Assists in returning of item with Transaction ID: $id");
    updateQuantity($_POST['quantity'], "add");
  }
?>