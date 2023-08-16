<datalist id="positions">
    <?php 
        $positions = getPositions();
        foreach($positions as $position){
    ?>
    <option value="<?php echo $position['position']?>"></option>
    <?php } ?>
</datalist>
<datalist id="committee">
    <?php 
        $committees = getCommittees();
        foreach($committees as $committee){
    ?>
    <option value="<?php echo $committee['committee']?>"></option>
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
<datalist id="days">
    <option value="Monday">Monday</option>
    <option value="Tuesday">Tuesday</option>
    <option value="Wednesday">Wednesday</option>
    <option value="Thursday">Thursday</option>
    <option value="Friday">Friday</option>
    <option value="Saturday">Saturday</option>
    <option value="Sunday">Sunday</option>
    <option value="No fixed Schedule">No fixed Schedule</option>
</datalist>