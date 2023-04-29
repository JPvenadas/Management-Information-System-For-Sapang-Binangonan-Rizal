<div class="filter-section">
    <div class="left">
        <input autocomplete="off" id="search" class="filter-input" type="text" placeholder="Filter by Name or Position">
    </div>
    <form class="right" method="post" action="../../Pages/Attendance/Attendance.php">
        <p>Browse Records from:</p>
        <div class="browse-container">
            <input max="<?php echo date('Y-m-d');?>" name="record_date" type="date">
            <button class="search-button" name="browse_records" type='submit'>
                <ion-icon name="search"></ion-icon>
            </button>
        </div>
    </form>
</div>

