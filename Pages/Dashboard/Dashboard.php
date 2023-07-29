<?php 
session_start();

require "../../Functions/dashboard-sql-commands.php";

//if the user is logged in direct them to their dashboard.
//if the user wants to go to the registration page(which is here) they must log out first 
if (isset($_SESSION['userType']) && isset($_SESSION['username']) && ($_SESSION['userType'] == "Administrator" || $_SESSION['userType'] == "Staff")) {
	?>
<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <link rel="shortcut icon" href="../../Images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="../../Images/favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../Styles/Navbar.css">
    <link rel="stylesheet" type="text/css" href="../../Styles/Dashboard.css">
    <link rel="stylesheet" type="text/css" href="../../Styles/Tab-title.css">
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
        attachNavbar("dashboard");
    }elseif($_SESSION['userType'] == "Staff"){
        require "../../Components/Navbar/Staff-Navbar.php";
        attachNavbar("dashboard");
    }?>


    <div class="dashboard-content">
        <!-- Attach the Tab title/header -->
        <?php require "../../Components/Dashboard-components/DashboardHeader.php";?>

        <div class="system-stat">
            <div class="left">
                <div class="upper-left">
                    <?php
                    //require the needed components
                    include "../../Components/Dashboard-components/ResidentSection.php";
                    include "../../Components/Dashboard-components/OtherDatas.php"
                    ?>
                </div>
                <div class="lower-left">
                <?php
                    //require the annual revenues graph
                    include "../../Components/Dashboard-components/AnnualRevenue.php";
                    ?>
                </div>
            </div>
            <div class="right">
                <?php
                    //require the needed components
                    include "../../Components/Dashboard-components/VoterGraph.php";
                    include "../../Components/Dashboard-components/Events.php"
                    ?>
            </div>
        </div>
        <div class="barangay-officials">
            <?php require "../../Components/Dashboard-components/OfficialsList.php"?>
        </div>
    </div>

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