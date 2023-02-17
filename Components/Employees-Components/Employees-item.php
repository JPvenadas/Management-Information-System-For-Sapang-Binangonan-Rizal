<?php

function generateEmployeeItem($employee){
    $image = $employee['image']
?>
<input name="employeeID" type="hidden" value='<?php echo $employee['employeeID']?>'>
<div class="employee-item-record" onclick="openEditModal('<?php echo $employee['employeeID']?>',
                                                         '<?php echo $employee['residentID']?>',
                                                         '<?php echo $employee['position']?>',
                                                         '<?php echo $employee['termStart']?>',
                                                         '<?php echo $employee['termEnd']?>')">
            <div class="employee-info-container">
                <div class="employee-image-container">
                    <img class="employee-image"
                        src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($image); ?>" alt="">
                </div>
                <div class="employee-info">
                    <p class="employee-fullname"><?php echo $employee['fullName']?></p>
                    <p class="employee-position"><?php echo $employee['positionName']?></p>
                    <p class="employee-status"><?php echo $employee['termStatus']?></p>
                </div>
            </div>
            <div class="action-text">
                <p>Click to see Profile</p>
            </div>
        </div>
<?php }?>