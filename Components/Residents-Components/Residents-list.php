<div class="resident-items-container">
    <?php require "Resident-item.php";
            foreach ($residents as $resident) {
               generateResidentItem($resident, 'Click to see Profile');
              }
    ?>
</div>