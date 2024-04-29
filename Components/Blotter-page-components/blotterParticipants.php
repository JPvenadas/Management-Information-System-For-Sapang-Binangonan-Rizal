<h3 class="title">Participants</h3>
<div class="participants-container">
    <div class="participant-item">
        <div class="resident">
            <?php 
            include '../../Components/Residents-Components/Resident-item.php';
            $complainant = getSingleResident($blotter['complainant']);
            generateResidentItem($complainant, 'Complainant');
            ?>
        </div>
        <div onclick="openResidentModal('complainant')" class="change-button">
            <ion-icon name="ellipsis-horizontal"></ion-icon>
        </div>
    </div>
    <div class="participant-item">
        <div class="resident">
            <?php
                $defendant = getSingleResident($blotter['defendant']);
                generateResidentItem($defendant, 'Defendant');
            ?>
        </div>
        <div onclick="openResidentModal('defendant')" class="change-button">
            <ion-icon title="Change" name="ellipsis-horizontal"></ion-icon>
        </div>
    </div>
    <div class="participant-item">
        <div class="resident">
            <?php
                $mediator = getSingleResident($blotter['mediator']);
                generateResidentItem($mediator, 'Assigned Mediator');
            ?>
        </div>
        <div onclick="openResidentModal('mediator')" class="change-button">
            <ion-icon title="Change" name="ellipsis-horizontal"></ion-icon>
        </div>
    </div>
</div>