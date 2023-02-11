<div class="resident-items-container">
    <?php require "Resident-item.php";
            foreach ($residents as $resident) {
               generateResidentItem($resident['residentID']
                                    ,$resident['firstName']
                                    ,$resident['middleName']
                                    ,$resident['lastName']
                                    ,$resident['image']
                                    ,$resident['birthDate']
                                    ,$resident['purokName']);
              }
    ?>
</div>