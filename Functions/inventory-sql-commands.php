<?php
 require "db_conn.php";

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
   $command = $command . addFilters() . addSearchFilterTransaction();
   $result = mysqli_query($conn, $command);
   $transactions = mysqli_fetch_all($result, MYSQLI_ASSOC);
   mysqli_free_result($result);
   mysqli_close($conn);
   return $transactions;
 }
 function addSearchFilterTransaction(){
   if(isset($_GET['search'])){
      $search = $_GET['search'];
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
   $name = $_POST['item_name'];
   $quantity = $_POST['item_quantity'];
   $command = "INSERT INTO `tbl_inventoryList`(`itemName`, `totalNumber`, `archive`) 
                                       VALUES ('$name','$quantity','false')";
   mysqli_query($conn, $command);
   mysqli_close($conn);
 }

 function getSingleItem(){
   $conn = openCon();
   $id = $_GET['id'];
   $command = "SELECT * FROM `tbl_inventoryList` WHERE itemID = '$id'";
   $result = mysqli_query($conn, $command);
   $items = mysqli_fetch_all($result, MYSQLI_ASSOC);
   mysqli_free_result($result);
   mysqli_close($conn);
   return $items[0];
 }
?>