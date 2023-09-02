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
<div class="filter-select-container action-controls-container">
    <select class="filter-select" onchange="redirectToPage()" id="filter-select">
        <option <?php if(!isset($_GET['filter']) or $_GET['filter'] !== 'unverified') { echo 'selected'; } ?> value="?filter=verified">Registered Residents</option>
        <option <?php if(isset($_GET['filter']) and $_GET['filter'] === 'unverified') { echo 'selected'; } ?> value="?filter=unverified">Unverified Residents</option>
    </select>
</div>
<div class="filter-nav-container action-controls-container">
    <div class="settings-nav">
        <ul class="nav-list">
            <li><a class="<?php echo $verified?>" href="?">Registered Residents</a></li>
            <li><a class="<?php echo $unverified?>" href="?filter=unverified">Unverified Residents</a></li>
        </ul>
    </div>
    <form action="" method="get" class="search-button-container">
        <input value="<?php if(isset($_GET['search'])){echo $_GET['search'];}else{echo "";}?>" autocomplete="off"
            name="search" placeholder="Enter the Resident's Name here" class="input searchbar"
            type="text">
        <input type="hidden" name="filter" value ="<?php
            if(isset($_GET['filter']) && $_GET['filter'] == "unverified"){
                echo "unverified";
            }else{
                echo "verified";
            }
        ?>">
        <button type="submit" class="search-button">
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