<div class="action-controls-container">
    <div class="add-button-container">
        <button onclick="openAddModal()" class="add-employee-button">
            <ion-icon name="add-sharp"></ion-icon>
            <p>Assign Role</p>
        </button>
    </div>
    <form action="../../Functions/employees-sql-commands.php" method="post" class="search-button-container">
        <input value="<?php if(isset($_GET['search'])){echo $_GET['search'];}?>" autocomplete="off"
            name="search_input_employees" placeholder="Enter the employee's Name here" class="searchbar-employees"
            type="text">
        <button name="search_button_employees" type="submit" class="search-button-employees">
            <ion-icon name="search-outline"></ion-icon>
        </button>
    </form>
</div>