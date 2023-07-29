<?php
$today; $recent; $yesterday;
if(!isset($_GET['filter']) or $_GET['filter'] == 'recent'){
    $recent = 'gray-highlight';
}elseif($_GET['filter'] == 'today'){
    $today = 'gray-highlight';
}elseif($_GET['filter'] == 'yesterday'){
    $yesterday = 'gray-highlight';
}
?>
<div class="filtering">
    <a class="filter-item <?php echo $recent?>" href="?filter=recent">Most Recent</a>
    <a class="filter-item <?php echo $today?>" href="?filter=today">Today</a>
    <a class="filter-item <?php echo $yesterday?>" href="?filter=yesterday">Yesterday</a>
    <form method="get" class="filter-input">
        <label style="font-size: 13px" for="filter">Filter by Date: </label>
        <input name="filter" id="filter" placeholder="Input date" onfocus="(this.type = 'date')" type="text"
            placeholder="Filter by date">
        <button type="submit">Filter</button>
    </form>
</div>