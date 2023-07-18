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
<div class="filter-select-container action-controls-container">
    <select class="filter-select" onchange="redirectToPage()" id="filter-select">
        <option <?php if(!isset($_GET['page']) or $_GET['page'] !== 'contacts') { echo 'selected'; } ?> value="?page=contacts">Barangay Contacts</option>
        <option <?php if(isset($_GET['page']) and $_GET['page'] === 'purok') { echo 'selected'; } ?> value="?page=purok">Purok</option>
        <option <?php if(isset($_GET['page']) and $_GET['page'] === 'services') { echo 'selected'; } ?> value="?page=services">Services</option>
        <option <?php if(isset($_GET['page']) and $_GET['page'] === 'positions') { echo 'selected'; } ?> value="?page=positions">Employee Positions</option>
        <option <?php if(isset($_GET['page']) and $_GET['page'] === 'committees') { echo 'selected'; } ?> value="?page=committees">Committees</option>
        <option <?php if(isset($_GET['page']) and $_GET['page'] === 'backupRestore') { echo 'selected'; } ?> value="?page=backupRestore">Backup and Restore</option>
    </select>
</div>
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
<script>
    function redirectToPage() {
    var selectElement = document.getElementById("filter-select");
    var selectedValue = selectElement.options[selectElement.selectedIndex].value;
    if (selectedValue !== "") {
        window.location.href = selectedValue;
    }
}
</script>