<form method="GET" class="filter-content">
    <p class="white-text">Filter by:</p>
    <input type="hidden" name="content" value="Activity Logs">
    <select class="input" name="user" id="">
        <option value="" hidden disabled selected>Filter by User</option>
        <?php 
            $users = getUsersWithLogs();
            foreach($users as $user){
        ?>
            <option <?php if(isset($_GET['user']) and $_GET['user'] === $user['userName']) { echo 'selected'; } ?> value="<?php echo $user['userName']?>"><?php echo $user['fullName']?></option>
        <?php }?>
    </select>
    <p class="white-text">Filter by Activity Date</p>
    <input value="<?php if(isset($_GET['start'])){echo $_GET['start'];}?>" value="<?php if(isset($_GET['start'])){echo $_GET['start'];}?>" name="start" class="input" placeholder="Start date" onfocus="(this.type = 'date')" type="text">
    <input value="<?php if(isset($_GET['end'])){echo $_GET['end'];}?>" value="<?php if(isset($_GET['end'])){echo $_GET['end'];}?>" name="end" class="input" placeholder="End date" onfocus="(this.type = 'date')" type="text">
    <div class="filter-button-container">
        <button type="submit" class="filter-button">Apply Filters</button>
    </div>
</form>
<script>
  // Get the current URL
  const url = new URL(window.location.href);

  // Remove the userType and accountStatus parameters
  url.searchParams.delete('user');
  url.searchParams.delete('start');
  url.searchParams.delete('end');

  // Replace the current URL with the updated URL
  window.history.replaceState(null, null, url);
</script>