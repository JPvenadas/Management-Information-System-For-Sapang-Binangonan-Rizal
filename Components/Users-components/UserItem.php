<?php function generateItem($user){
    $userFullname = $user['firstName'] . ' ' . $user['middleName'][0]. '.' . ' ' . $user['lastName'] . ' ' . $user['extension'];
    
?>

<input name="userID" type="hidden" value="dddkkd">
<button onclick="openEditModal('<?php echo $user['residentID']?>',
                                   '<?php echo $userFullname?>',
                                   '<?php echo $user['userName']?>',
                                   '<?php echo $user['userType']?>',
                                   '<?php echo $user['accountStatus']?>')" type="submit" class="user-item-record">
    <div class="user-info-container">
        <div class="user-image-container">
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($user['image']); ?>"
                class="user-image" src="" loading="lazy" alt="">
        </div>
        <div class="user-info">
            <p class="user-fullname"><?php echo $userFullname?></p>
            <p class="user-age">Username: <?php echo $user['userName']?></p>
            <p class="user-purok">Type: <?php echo $user['userType']?></p>
        </div>
    </div>

    <?php if($user['accountStatus'] == "Active"){?>
    <div class="action-text">
        <div class="dot"></div>
        <p>Active</p>
    </div>
    <?php }else{?>
    <div class="action-text">
        <div class="dot red"></div>
        <p>Inactive</p>
    </div>
    <?php }?>
</button>

<?php } ?>