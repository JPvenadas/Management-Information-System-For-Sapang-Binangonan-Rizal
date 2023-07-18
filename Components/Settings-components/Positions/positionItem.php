<?php function generateItem($position){?>
<div onclick="openEditPosition('<?php echo $position['position']?>')" class="item">
    <div class="left">
        <p><?php echo $position['position']?></p>
    </div>
    <div class="right">
        <div>
            <p>Click to edit</p>
        </div>
    </div>
</div>
<?php }?>