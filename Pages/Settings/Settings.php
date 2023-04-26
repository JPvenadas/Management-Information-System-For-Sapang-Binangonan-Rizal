<?php 
session_start();

require "../../Functions/settings-sql-commands.php";

//determine if the user accessing the url is logged in
if (isset($_SESSION['userType']) && isset($_SESSION['username']) && $_SESSION['userType'] == "Administrator") {
 ?>
<!DOCTYPE html>
<html>

<head>
    <title>Settings</title>
    <link rel="stylesheet" type="text/css" href="../../Styles/Navbar.css">
    <link rel="stylesheet" type="text/css" href="../../Styles/Settings.css">
    <link rel="stylesheet" type="text/css" href="../../Styles/Tab-title.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,800&display=swap"
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
        attachNavbar("settings");
    }elseif($_SESSION['userType'] == "Staff"){
        require "../../Components/Navbar/Staff-Navbar.php";
        attachNavbar("settings");
    }?>

    <?php if (isset($_GET['error'])) { ?>
        <div class="error-container">
            <p class="error"><?php echo $_GET['error']; ?></p>
        </div>
    <?php } ?>

    <!-- Main content of the residents-section -->
    <div class="main-content">

        <!-- Attach the Tab title/header -->
        <?php require "../../Components/Tab-title.php";
        attachTabTitle("Settings");
        require "../../Components/Settings-components/SettingsNav.php";
        require "../../Components/Settings-components/SettingsContent.php";
        ?>

    </div>


    <?php
    //include the modals
    include "../../Components/Settings-components/Purok/AddPurokModal.php";
    include "../../Components/Settings-components/Purok/EditPurokModal.php";
    include "../../Components/Settings-components/Services/AmountModal.php";
    include "../../Components/Settings-components/Positions/AddPositionModal.php";
    include "../../Components/Settings-components/Positions/EditPositionModal.php";
    include "../../Components/Settings-components/Committees/AddComModal.php";
    include "../../Components/Settings-components/Committees/EditComModal.php";
    include "../../Components/Settings-components/Services/AddServiceModal.php";
    ?>
    <!-- Package for ionic icons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>

<?php 
}else{
     header("Location: /bmis/index.php");
     exit();
}
 ?>