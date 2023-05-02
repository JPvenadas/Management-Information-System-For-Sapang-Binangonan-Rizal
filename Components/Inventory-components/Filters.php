<?php
// create a sub navbar that highlights when you click
$list=""; $borrowed=""; $returned="";
    if(isset($_GET['filter'])){
        if($_GET['filter'] == "returned"){
            $returned = "underline";
        }elseif($_GET['filter'] == "borrowed"){
            $borrowed = "underline";
        }else{
            $list = "underline";
        }

    }else{
        $list = "underline";
    }
?>
<div class="filter-select-container action-controls-container">
    <select class="filter-select" onchange="redirectToPage()" id="filter-select">
        <option <?php if(!isset($_GET['filter']) or $_GET['filter'] !== 'list') { echo 'selected'; } ?> value="?">Items
            List</option>
        <option <?php if(isset($_GET['filter']) and $_GET['filter'] === 'borrowed') { echo 'selected'; } ?>
            value="?filter=borrowed">Currently Borrowed/In use</option>
        <option <?php if(isset($_GET['filter']) and $_GET['filter'] === 'returned') { echo 'selected'; } ?>
            value="?filter=returned">Returned</option>
    </select>
</div>
<div class="filter-nav-container action-controls-container">
    <div class="settings-nav">
        <ul class="nav-list">
            <li><a class="<?php echo $list?>" href="?">Items List</a></li>
            <li><a class="<?php echo $borrowed?>" href="?filter=borrowed">In use</a></li>
            <li><a class="<?php echo $returned?>" href="?filter=returned">Returned</a></li>
        </ul>
    </div>
    <form action="../../Functions/inventory-sql-commands.php" method="post" class="search-button-container">
        <input value="<?php if(isset($_GET['search'])){echo $_GET['search'];}else{echo "";}?>" autocomplete="off"
            name="search_input" placeholder="Enter the Information here" class="searchbar" type="text">
        <input type="hidden" name="search_filter" value="<?php
            if(isset($_GET['filter'])){
                echo $_GET['filter'];
            }
        ?>">
        <button name="search_button" type="submit" class="search-button">
            <ion-icon name="search-outline"></ion-icon>
        </button>
    </form>
</div>
<script>
function redirectToPage() {
    var selectElement = document.getElementById("filter-select");
    var selectedValue = selectElement.options[selectElement.selectedIndex].value;
    if (selectedValue !== "") {
        window.location.href = selectedValue;
    }
}
</script>