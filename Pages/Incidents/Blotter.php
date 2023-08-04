<?php 
session_start();

//require the sql functions
require "../../Functions/incidents-sql-commands.php";

$blotter = getSingleBlotter();
$hearings = getHearings();

//if the user is logged in direct them to their dashboard.
//if the user wants to go to the registration page(which is here) they must log out first 
if (isset($_SESSION['userType']) && isset($_SESSION['username']) && $_SESSION['userType'] === "Administrator" || (isset($_SESSION['access']) && $_SESSION['access']['incidents'])) {
	?>
<!DOCTYPE html>
<html>

<head>
    <title>Incidents</title>
    <link rel="shortcut icon" href="../../Images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="../../Images/favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../Styles/ColorCoding.css">
    <link rel="stylesheet" type="text/css" href="../../Styles/Navbar.css">
    <link rel="stylesheet" type="text/css" href="../../Styles/Blotter.css">
    <link rel="stylesheet" type="text/css" href="../../Styles/Tab-title.css">
    <link rel="stylesheet" href="../../lightbox2-2.11.4/dist/css/lightbox.min.css">

    <!-- a script to prevent the "confirm resubmission" alert -->
    <script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
    </script>
</head>

<body>
    <div class="error-container">
        <?php if (isset($_GET['error'])) { ?>
        <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
    </div>


    <?php 
    //attach the navbar
    //if administrator use the navbar for admin
    if($_SESSION['userType'] == "Administrator"){
        require "../../Components/Navbar/Administrator-Navbar.php";
        attachNavbar("incidents");

    //else if staff
    }elseif($_SESSION['userType'] == "Staff"){
        require "../../Components/Navbar/Staff-Navbar.php";
        attachNavbar("incidents");
    }?>

    <main class="main-content">
        <!-- Attach the Tab title/header -->
        <?php require "../../Components/Tab-title.php";
        attachTabTitle("Blotter Report")?>

        <div class="page-body">
            <?php include "../../Components/Blotter-page-components/blotterHeader.php"?>
            <div class="divider"></div>
            <?php include "../../Components/Blotter-page-components/blotterParticipants.php"?>
            <div class="divider"></div>
            <?php include "../../Components/Blotter-page-components/blotterConflict.php"?>
            <div class="divider"></div>
            <?php include "../../Components/Blotter-page-components/blotterHearing.php"?>
        </div>
    </main>

    <script src="../../lightbox2-2.11.4/dist/js/lightbox-plus-jquery.min.js"></script>

    <!-- Script for Ionic Icons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
<?php
}else{
    header("Location: ../../index.php");
	exit();
}
?>