<?php function generateItem($committee){?>
<div onclick="openEditcommittee('<?php echo $committee['committee']?>')" class="item">
    <div class="left">
        <p><?php echo $committee['committee']?></p>
    </div>
    <div class="right">
        <div>
            <p>Click to edit</p>
        </div>
    </div>
</div>
<?php }?>