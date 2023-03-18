<?php
// create a sub navbar that highlights when you click
$new=""; $processed=""; $finished="";
    if(isset($_GET['page'])){
        if($_GET['page'] == "Processed"){
            $processed = "underline";
        }elseif($_GET['page'] == "Finished"){
            $finished = "underline";
        }else{
            $new = "underline";
        }

    }else{
        $new = "underline";
    }
?>

<div class="action-controls-container">
    <div class="settings-nav">
        <ul class="nav-list">
            <li><a class="<?php echo $new?>" href="?">New Transaction</a></li>
            <li><a class="<?php echo $processed?>" href="?page=Processed">Processed Certificates</a></li>
            <li><a class="<?php echo $finished?>" href="?page=Finished">History</a></li>
        </ul>
    </div>
    <?php
    if(isset($_GET['page'])){
        if($_GET['page'] == "Processed" or $_GET['page'] == "Finished"){
    ?>
    <form method="post" class="search-button-container">
        <input type="hidden" name="page" value="<?php echo $_GET['page']?>">
        <input autocomplete="off" value="<?php if(isset($_GET['search'])){
         echo $_GET['search'];
        }?>" name="search_input_transactions"
            placeholder="Enter the Name of the Issuer here" class="searchbar-transactions" type="text">
        <button name="search_button_transactions" type="submit" class="search-button-transactions">
            <ion-icon name="search-outline"></ion-icon>
        </button>
    </form>
    <?php
    }
    }
    ?>
</div>