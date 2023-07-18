<?php 
$captainFullname = $captain['fullName'];
$image = $captain['signiture'];
?>
<div class="certificate-footer">
    <div class="footer-container">
        <img class="signiture" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($image); ?>" alt="">
        <p class="captain">hon. <?php echo $captainFullname?></p>
        <p>Punong Barangay</p>
    </div>
</div>