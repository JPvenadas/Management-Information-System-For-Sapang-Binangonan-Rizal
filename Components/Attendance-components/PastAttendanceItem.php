<?php 
function generateItem($employee){
?>
<div class="current-attendance-item">
    <div class="left">
        <h4><?php echo $employee['fullName']?></h4>
        <p><?php echo $employee['position']?></p>
    </div>
    <div class="right">
        <button class="timed-button">
            <ion-icon name="time"></ion-icon>
            <p><?php echo date("h:i A", strtotime($employee['timeIn']))?></p>
        </button>
        <button class="timed-button">
            <ion-icon name="log-out"></ion-icon>
            <p><?php if(empty($_POST['timeOut'])){
                echo "Not set";
            }else{
                echo date("h:i A", strtotime($employee['timeOut']));
            }?></p>
        </button>
    </div>
</div>
<?php } ?>
