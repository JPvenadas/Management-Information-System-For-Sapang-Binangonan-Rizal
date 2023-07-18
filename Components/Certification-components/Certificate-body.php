<?php
    if($_GET['service'] == "Certificate of Indigency"){
        include "CertInd-content.php";
        attachCertificateBody($issuer);
        include "Certificate-footer1.php";
    }elseif($_GET['service'] == "Barangay Clearance"){
        include "BrgyClr.content.php";
        attachCertificateBody($issuer);
        include "Certificate-footer1.php";
    }else{
        include "BrgyCert-content.php";
        attachCertificateBody($issuer);
        include "Certificate-footer2.php";
    }

?>