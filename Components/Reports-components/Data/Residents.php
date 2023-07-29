<div class="list">
    <?php
        $residents = getResidents();
        foreach($residents as $resident){
    ?>
    <div class="list-item">
        <div class="picture-container">
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($resident['image'])?>" alt="">
        </div>
        <div class="information-container">
            <div class="name-container">
                <p class="resident-name"> <span>Full Name:</span> <?php echo $resident['fullName']?> </p>

                <?php if($resident['archive'] == "true"){?>
                        <p class="resident-name"> <span>(Archived) </span>Reason:  <?php echo $resident['archiveReason']?> </p> 
                <?php }?>
            </div>
            <div class="other-info">
                <div class="left">
                    <div class="info-item"> <span>Resident ID:</span> <?php echo $resident['residentID']?> </div>
                    <div class="info-item"> <span>Birth Date:</span> <?php echo $resident['birthDate']?> </div>
                    <div class="info-item"> <span>Purok:</span> <?php echo $resident['purok']?></div>
                    <div class="info-item"> <span>Exact Address:</span> <?php echo $resident['exactAddress']?></div>
                    <div class="info-item"> <span>Sex:</span> <?php echo $resident['sex']?></div>
                </div>
                <div class="right">
                    <div class="info-item"><span>Voter Status:</span> <?php echo $resident['voterStatus']?></div>
                    <div class="info-item"> <span>Marital Status:</span> <?php echo $resident['maritalStatus']?></div>
                    <div class="info-item"> <span>Occupation:</span> <?php echo $resident['occupation']?></div>
                    <div class="info-item"> <span>Family Head:</span> <?php echo $resident['familyHead']?></div>
                    <div class="info-item"> <span>Contact Number:</span> <?php echo $resident['contactNo']?></div>
                </div>
            </div>
        </div>
    </div>
    <?php }?>
</div>