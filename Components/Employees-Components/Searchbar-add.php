<div class="action-controls-container">
    <div class="add-button-container">
        <button onclick="openAddModal()" class="main-button">
            <ion-icon name="add-sharp"></ion-icon>
            <p>Assign Role</p>
        </button>
    </div>
    <form action="" method="get" class="search-button-container">
        <input value="<?php if(isset($_GET['search'])){echo $_GET['search'];}?>" autocomplete="off"
            name="search" placeholder="Enter the employee's Name here" class="searchbar input"
            type="text">
        <button type="submit" class="search-button">
            <ion-icon name="search-outline"></ion-icon>
        </button>
    </form>
</div>