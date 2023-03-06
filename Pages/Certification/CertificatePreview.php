<?php 
session_start();
// this contains all the functions
require "../../Functions/certification-sql-command.php";

//get the data of issuer
$issuer = getIssuer($_GET['id']);
//get the baranggay captain and its signiture for certificate
$captain = getEmployee('Barangay Captain');
//get the baranggay secretary and its signiture for certificate
$secretary = getEmployee('Barangay Secretary');
//get the type of certificate issued and ammount in the table services
$service = getServices();


//determine if the user accessing the url is logged in
if (isset($_SESSION['userType']) && isset($_SESSION['username'])) {
 ?>
<!DOCTYPE html>
<html>

<head>
    <title>Management Information System for Barangay Sapang</title>

    <link rel="stylesheet" type="text/css" href="../../Styles/Navbar.css">
    <link rel="stylesheet" type="text/css" href="../../Styles/Certification.css">

    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Domine:wght@400;500;600;700&family=PT+Serif:wght@400;700&family=Noto+Serif:wght@700&family=Open+Sans:ital,wght@0,600;0,700;0,800;1,800&family=PT+Serif:wght@400;700&family=Tinos:wght@400;700&display=swap"
        rel="stylesheet">

    <!-- a script to prevent the "confirm resubmission" alert -->
    <script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
    </script>
</head>

<body>
    <!-- Attach the navbar -->
    <?php 
    if($_SESSION['userType'] == "Administrator"){
        require "../../Components/Navbar/Administrator-Navbar.php";
        attachNavbar("services");
    }elseif($_SESSION['userType'] == "Staff"){
        require "../../Components/Navbar/Staff-Navbar.php";
        attachNavbar("services");
    }?>

    <div class="main-content">
        <?php include "../../Components/Certification-components/Header.php"?>
        <div class="certificate-container">
            <div id="certificate" class="certificate-paper">

                <?php 
                // Attach the header
                include "../../Components/Certification-components/Certificate-header.php";
                attachCertificateHeader($service['serviceName']);
                
                // include the body
                include "../../Components/Certification-components/Certificate-body.php";
                ?>
                
            </div>
        </div>

        <!-- Package for ionic icons -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>

<?php 
}else{
     header("Location: ../index.php");
     exit();
}
 ?>