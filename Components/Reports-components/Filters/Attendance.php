<form method="GET" class="filter-content">
    <p class="white-text">Filter by:</p>
    <input type="hidden" name="content" value="Attendance">
    <select class="input" name="employee" id="">
        <option value="" hidden disabled selected>Filter by Employee</option>
        <?php 
            $employees = getEmployeesWithAttendance();
            foreach($employees as $employee){
        ?>
            <option <?php if(isset($_GET['employee']) and $_GET['employee'] === $employee['employeeID']) { echo 'selected'; } ?> value="<?php echo $employee['employeeID']?>"><?php echo $employee['fullName']?></option>
        <?php }?>
    </select>
    <p class="white-text">Filter by Attendance Date</p>
    <input value="<?php if(isset($_GET['start'])){echo $_GET['start'];}?>" name="start" class="input" placeholder="Start date" onfocus="(this.type = 'date')" type="text">
    <input value="<?php if(isset($_GET['end'])){echo $_GET['end'];}?>" name="end" class="input" placeholder="End date" onfocus="(this.type = 'date')" type="text">
    <div class="filter-button-container">
        <button class="filter-button">Apply Filters</button>
    </div>
</form>
<script>
  // Get the current URL
  const url = new URL(window.location.href);

  // Remove the userType and accountStatus parameters
  url.searchParams.delete('employee');
  url.searchParams.delete('start');
  url.searchParams.delete('end');

  // Replace the current URL with the updated URL
  window.history.replaceState(null, null, url);
</script>