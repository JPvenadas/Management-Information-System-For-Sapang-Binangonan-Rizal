<?php 
function generateItem($employee){
?>
<div class="current-attendance-item">
    <div class="left">
        <input type="hidden" value="<?php echo $employee['attendanceID']?>">
        <img id="image-<?php echo $employee['employeeID']?>" style="display:none;" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($employee['image']); ?>" alt="">
        <h4><?php echo $employee['fullName']?></h4>
        <p><?php echo $employee['position']?></p>
    </div>
    <div class="right">
        <?php if(!empty($employee['timeIn'])){?>
            <button class="timed-button">
                <ion-icon name="time"></ion-icon>
                <p><?php echo date("h:i A", strtotime($employee['timeIn']))?></p>
             </button>
        <?php }else{?>
            <button onclick="openVerifyModal('<?php echo $employee['employeeID']?>',
                                        '<?php echo $employee['fullName']?>',
                                        '<?php echo $employee['position']?>',
                                        'timeIn')" class="attendance-button">
            <ion-icon name="time"></ion-icon>
            <p>Time in</p>
            </button>
            
            <button disabled style="cursor:not-allowed" class="attendance-button">
            <ion-icon name="log-out"></ion-icon>
            <p>Time out</p>
            </button>
        <?php }?>
        
        <?php if(!empty($employee['timeIn']) and empty($employee['timeOut'])){?>
            <button onclick="openVerifyModal('<?php echo $employee['employeeID']?>',
                                        '<?php echo $employee['fullName']?>',
                                        '<?php echo $employee['position']?>',
                                        'timeOut')" class="attendance-button">
            <ion-icon name="log-out"></ion-icon>
            <p>Time out</p>
            </button>
        <?php }elseif(!empty($employee['timeOut'])){?>
            <button class="timed-button">
                <ion-icon name="log-out"></ion-icon>
                <p><?php echo date("h:i A", strtotime($employee['timeOut']))?></p>
             </button>
        <?php }?>
    </div>
</div>
<?php } ?>
