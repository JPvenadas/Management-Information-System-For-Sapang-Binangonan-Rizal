<?php 
$secretaryFullName = $secretary['fullName'];
$captainFullname = $captain['fullName'];
$captainSign = $captain['signiture'];
$secratarySign = $secretary['signiture'];
?>
<div class="attest">
    <p>Attested by:</p>
</div>
<div class="certificate-footer2">
<div class="footer-container">
        <img class="signiture" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($secratarySign); ?>" alt="">
        <p class="captain"><?php echo $secretaryFullName?></p>
        <p>Barangay Secretary</p>
    </div>
    <div class="footer-container">
        <img class="signiture" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($captainSign); ?>" alt="">
        <p class="captain">hon. <?php echo $captainFullname?></p>
        <p>Punong Barangay</p>
    </div>
</div>