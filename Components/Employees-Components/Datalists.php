<datalist id="positions">
    <?php 
        $positions = getPositions();
        foreach($positions as $position){
    ?>
    <option value="<?php echo $position['positionID']?>"><?php echo $position['positionName']?></option>
    <?php } ?>
</datalist>
<datalist id="residents">
    <?php 
        $residents = getResidents();
        foreach($residents as $resident){
    ?>
    <option value="<?php echo $resident['residentID']?>"><?php echo $resident['fullName']?></option>
    <?php } ?>
</datalist>