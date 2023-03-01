<div>
<?php
if(isset($_GET['page'])){

    if($_GET['page'] == "services"){
        require "Services/ServicesList.php";
    }elseif($_GET['page'] == "purok"){
        require "Purok/PurokList.php";
    }elseif($_GET['page'] == "positions"){
        require "Positions/positionList.php";
    }elseif($_GET['page'] == "backupRestore"){
        require "BackupRestore.php";
    }elseif($_GET['page'] == "committees"){
        require "Committees/ComList.php";
    }else{
        require "Contacts/ContactList.php";
    }
}else{
    require "Contacts/ContactList.php";
}
   
?>
</div>