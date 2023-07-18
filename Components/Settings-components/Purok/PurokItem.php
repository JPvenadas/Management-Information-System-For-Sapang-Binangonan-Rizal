<?php function generateItem($purok){?>
<div onclick="openEditPurok('<?php echo $purok['purok']?>')" class="item">
    <div class="left">
        <p><?php echo $purok['purok']?></p>
    </div>
    <div class="right">
        <div>
            <p>Click to edit</p>
        </div>
    </div>
</div>
<?php }?>