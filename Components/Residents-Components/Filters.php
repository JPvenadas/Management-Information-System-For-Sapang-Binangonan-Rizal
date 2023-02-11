<?php
$verified=""; $unverified="";
    if(isset($_GET['filter'])){
        
        if($_GET['filter'] == "unverified"){
            $unverified = "underline";
        }else{
            $verified = "underline";
        }

    }else{
        $verified = "underline";
    }
?>

<div class="action-controls-container">
    <div class="settings-nav">
        <ul class="nav-list">
            <li><a class="<?php echo $verified?>" href="?">Registered Residents</a></li>
            <li><a class="<?php echo $unverified?>" href="?filter=unverified">Unverified Residents</a></li>
        </ul>
    </div>
    <form action="../../Functions/sql-command-residents.php" method="post" class="search-button-container">
        <input value="<?php if(isset($_GET['search'])){echo $_GET['search'];}else{echo "";}?>" autocomplete="off"
            name="search_input_residents" placeholder="Enter the Resident's Name here" class="searchbar-residents"
            type="text">
        <button name="search_button_residents" type="submit" class="search-button-residents">
            <ion-icon name="search-outline"></ion-icon>
        </button>
    </form>
</div>