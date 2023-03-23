<?php 
function generateItem($employee){
?>
<form method="post" action="" class="current-attendance-item">
    <div class="left">
        <h4><?php echo $employee['fullName']?></h4>
        <p><?php echo $employee['position']?></p>
    </div>
    <div class="right">
        <button class="timed-button">
            <ion-icon name="time"></ion-icon>
            <p>8:38 AM</p>
        </button>
        <button class="attendance-button">
            <ion-icon name="log-out"></ion-icon>
            <p>Time out</p>
        </button>
    </div>
</form>
<?php } ?>