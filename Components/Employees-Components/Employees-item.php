<?php

function generateEmployeeItem($employee){
    $image = $employee['image']
?>
<input name="employeeID" type="hidden" value='<?php echo $employee['employeeID']?>'>
<div class="list-item" onclick="openEditModal('<?php echo $employee['employeeID']?>',
                                                         '<?php echo $employee['residentID']?>',
                                                         '<?php echo $employee['position']?>',
                                                         '<?php echo $employee['committee']?>',
                                                         '<?php echo $employee['termStart']?>',
                                                         '<?php echo $employee['termEnd']?>',
                                                         '<?php echo $employee['schedule']?>')">
            <div class="left">
                <div class="list-item-image">
                    <img loading="lazy" src="../../Upload-img/<?php echo $employee['image']?>" alt="">
                </div>
                <div class="list-item-info">
                    <h4><?php echo $employee['fullName']?></h4>
                    <p><?php echo $employee['position']?></p>
                    <p><?php if($employee['committee'] == "N/A"){
                        echo "Not part of any Committee";
                    }else{
                        echo $employee['committee'];
                    }?></p>
                </div>
            </div>
            <div class="right">
                <p><?php echo $employee['termStatus']?> Term</p>
            </div>
        </div>
<?php }?>