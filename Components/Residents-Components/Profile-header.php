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
    $purok = $resident['purok'];
    $image = $resident['image'];

?>
<div class="resident-profile-header">
    <div class="resident-profile-image">
        <a href="../../Upload-img/<?php echo $image?>" data-lightbox="profile" data-title="<?php echo "$firstName $lastName profile" ?>">
            <img class="resident-profile-image-preview"
            src="../../Upload-img/<?php echo $image?>" alt="">
        </a>
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
        <div class="resident-profile-location"><?php echo "Living in $address, $purok Sapang, Binangonan, Rizal";?>
        </div>
        <div class="resident-profile-actions">

            <?php if($resident['registrationStatus'] == "Unverified"){
            ?>
            <form method="post" action="../../Pages/Residents/Residents.php" class="resident-profile-archive-button">
                <input type="hidden" name="residentID" value="<?php echo $resident['residentID']?>">
                <button type="submit" name="reject" class="archive-resident-button">
                    <ion-icon name="person-remove"></ion-icon>
                    <p>Reject</p>
                </button>
            </form>
            <form method="post" action="../../Pages/Residents/Residents.php" class="resident-profile-archive-button">
                <input type="hidden" name="residentID" value="<?php echo $resident['residentID']?>">
                <button type="submit" name="confirm" class="blue-button">
                    <ion-icon name="checkmark-circle"></ion-icon>
                    <p>Confirm Registration</p>
                </button>
            </form>
            <?php
            }elseif($resident['registrationStatus'] == "Verified"){
                //if the user is a resident dont show the archive button
                if($_SESSION['userType'] != "Resident"){
            ?>
            <div class="resident-profile-archive-button">
                <button onclick="openArchiveModal()" class="archive-resident-button">
                    <ion-icon name="archive"></ion-icon>
                    <p>Archive</p>
                </button>
            </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>
<div class="divider"></div>
<?php }?>