<?php
require "Change-image-modal.php";
require "Archive-modal.php";

function solveAge($birthDate){
    $today = date("Y-m-d");
    $diff = date_diff(date_create($birthDate), date_create($today));
    return $diff->format('%y') . " years old";
}

 function attachProfileHeader($resident){
    $firstName = $resident['firstName'];
    $middleName = $resident['middleName'];
    $lastName = $resident['lastName'];
    $address = $resident['exactAddress'];
    $extension = $resident['extension'];
    $residentID = $resident['residentID'];
    $age = solveAge($resident['birthDate']);
    $purok = $resident['purokName'];
    $image = $resident['image']

?>
<div class="resident-profile-header">
    <div class="resident-profile-image">
        <img class="resident-profile-image-preview" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($image); ?>" alt="">
        <div onclick="openChangeImageModal()" class="resident-upload-button">
            <ion-icon name="arrow-up-circle"></ion-icon>
        </div>
    </div>
    <div class="resident-profile-information">
        <div class="resident-profile-name-ID-Container">
            <div class="resident-profile-fullname"><?php echo "$firstName $middleName $lastName $extension";?></div>
            <div class="resident-profile-ID"><?php echo "ID: #$residentID";?></div>
        </div>
        <div class="resident-profile-age"><?php echo $age?></div>
        <div class="resident-profile-location"><?php echo "Living in $address, $purok Sapang, Binangonan, Rizal";?></div>
        <div class="resident-profile-actions">
            <div class="resident-profile-archive-button">
                <button onclick="openArchiveModal()" class="archive-resident-button">
                    <ion-icon name="archive"></ion-icon>
                    <p>Archive</p>
                </button>
            </div>
        </div>
    </div>
</div>
<div class="divider"></div>
<?php }?>