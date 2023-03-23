<h3 class="section-title">Today's Attendance</h3>
<div class="current-attendance-container">
    <?php 
    require "AttendanceItem.php";
    $employees = getEmployeeAttendance();
    foreach($employees as $employee){
        generateItem($employee);
    }
    ?>
</div>