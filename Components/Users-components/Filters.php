<?php
// create a sub navbar that highlights when you click
$administators=""; $staffs=""; $residents="";
    if(isset($_GET['filter'])){
        if($_GET['filter'] == "residents"){
            $residents = "underline";
        }elseif($_GET['filter'] == "staffs"){
            $staffs = "underline";
        }else{
            $administators = "underline";
        }

    }else{
        $administators = "underline";
    }
?>

<div class="filter-select-container action-controls-container">
    <select class="filter-select" onchange="redirectToPage()" id="filter-select">
        <option <?php if(!isset($_GET['filter']) or $_GET['filter'] !== 'administrators') { echo 'selected'; } ?> value="?filter=administrators">Administrators</option>
        <option <?php if(isset($_GET['filter']) and $_GET['filter'] === 'staffs') { echo 'selected'; } ?> value="?filter=staffs">Staffs</option>
        <option <?php if(isset($_GET['filter']) and $_GET['filter'] === 'residents') { echo 'selected'; } ?> value="?filter=residents">Residents</option>
    </select>
</div>
<div class="filter-nav-container action-controls-container">
    <div class="settings-nav">
        <ul class="nav-list">
            <li><a class="<?php echo $administators?>" href="?">Administrators</a></li>
            <li><a class="<?php echo $staffs?>" href="?filter=staffs">Staffs</a></li>
            <li><a class="<?php echo $residents?>" href="?filter=residents">Residents</a></li>
        </ul>
    </div>
    <form action="../../Functions/users-sql-commands.php" method="post" class="search-button-container">
        <input value="<?php if(isset($_GET['search'])){echo $_GET['search'];}else{echo "";}?>" autocomplete="off"
            name="search_input_users" placeholder="Enter the UserName or Resident Name here" class="searchbar-users"
            type="text">
        <input type="hidden" name="search_filter" value ="<?php
            if(isset($_GET['filter']) && $_GET['filter'] == "staffs"){
                echo "staffs";
            }elseif(isset($_GET['filter']) && $_GET['filter'] == "residents"){
                echo "residents";
            }else{
                echo "administrators";
            }
        ?>">
        <button name="search_button_users" type="submit" class="search-button-users">
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