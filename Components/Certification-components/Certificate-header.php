<?php
function attachCertificateHeader($certificateName){
?>
<img class="back-logo" src="../../Images/barangayLogo.png" alt="">
<div class="certificate-header">
    <img class="logo" src="../../Images/barangayLogo.png" alt="">
    <div>
        <p class="country">REPUBLIC OF THE PHILIPPINES</p>
        <p class="province">Province of Rizal</p>
        <p class="municipal">Municipality of Binangonan</p>
        <p class="barangay">BARANGAY SAPANG</h4>
    </div>
    <p class="office">OFFICE OF THE BARANGAY CAPTAIN</h5>
    <div class="dividers">
        <div class="line-1"></div>
        <div class="line-2"></div>
    </div>
    <h2 class="certificate-title"> <?php echo $certificateName?></h2>
</div>
<?php }?>