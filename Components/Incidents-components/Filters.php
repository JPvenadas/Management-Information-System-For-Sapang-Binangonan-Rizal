<?php
$blotters=""; $curfew="";
    if(isset($_GET['filter'])){
        
        if($_GET['filter'] == "curfew"){
            $curfew = "underline";
        }else{
            $blotters = "underline";
        }

    }else{
        $blotters = "underline";
    }
?>

<div class="action-controls-container">
    <div class="events-nav">
        <ul class="nav-list">
            <li><a class="<?php echo $blotters?>" href="?">Blotters</a></li>
            <li><a class="<?php echo $curfew?>" href="?filter=curfew">Curfew Violators</a></li>
        </ul>
    </div>
    <form action="" method="post" class="search-button-container">
        <input value="<?php if(isset($_GET['search'])){echo $_GET['search'];}else{echo "";}?>" autocomplete="off"
            name="search_input" placeholder="Enter the information to be searched here here" class="searchbar"
            type="text">
        <input type="hidden" name="search_filter" value ="<?php
            if(isset($_GET['filter']) && $_GET['filter'] == "curfew"){
                echo "curfew";
            }else{
                echo "blotters";
            }
        ?>">
        <button name="search_button" type="submit" class="search-button">
            <ion-icon name="search-outline"></ion-icon>
        </button>
    </form>
</div>
