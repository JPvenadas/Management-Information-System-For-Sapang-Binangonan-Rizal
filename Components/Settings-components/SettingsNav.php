<?php
$services=""; $purok=""; $positions=""; $backupRestore=""; $contacts = ""; $committees = "";
if(isset($_GET['page'])){

  switch ($_GET['page']) {
        case "services":
         $services="underline";
          break;
        case "purok":
         $purok="underline";
          break;
        case "positions":
         $positions="underline";
          break;
        case "committees":
          $committees="underline";
          break;
        case "backupRestore":
          $backupRestore="underline";
          break;
        default:
          $contacts="underline";
      }

}else{
  $contacts = "underline";
}

?>
<nav class="settings-nav">
    <ul class="nav-list">
        <li><a class="<?php echo $contacts?>" href="../../Pages/Settings/Settings.php?page=contacts">Barangay Contacts</a></li>
        <li><a class="<?php echo $purok?>" href="../../Pages/Settings/Settings.php?page=purok">Purok</a></li>
        <li><a class="<?php echo $services?>" href="../../Pages/Settings/Settings.php?page=services">Services</a></li>
        <li><a class="<?php echo $positions?>" href="../../Pages/Settings/Settings.php?page=positions">Employee Positions</a></li>
        <li><a class="<?php echo $committees?>" href="../../Pages/Settings/Settings.php?page=committees">Committees</a></li>
        <li><a class="<?php echo $backupRestore?>" href="../../Pages/Settings/Settings.php?page=backupRestore">Backup and Restore</a></li>
    </ul>
</nav>