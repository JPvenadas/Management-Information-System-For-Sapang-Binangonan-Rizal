<?php 
session_start();

//require the sql functions
require "../../Functions/inventory-sql-commands.php";

//if the user is logged in direct them to their dashboard.
//if the user wants to go to the registration page(which is here) they must log out first 
if (isset($_SESSION['userType']) && isset($_SESSION['username']) && $_SESSION['userType'] === "Administrator" || (isset($_SESSION['access']) && $_SESSION['access']['inventory'])) {
	?>
<!DOCTYPE html>
<html>

<head>
    <title>Login: Sapang Management Information System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../Styles/Navbar.css">
    <link rel="stylesheet" type="text/css" href="../../Styles/Inventory.css">
    <link rel="stylesheet" type="text/css" href="../../Styles/Tab-title.css">

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
    <!-- Attach the navbar -->
    <?php 
    if($_SESSION['userType'] == "Administrator"){
        require "../../Components/Navbar/Administrator-Navbar.php";
        attachNavbar("inventory");
    }elseif($_SESSION['userType'] == "Staff"){
        require "../../Components/Navbar/Staff-Navbar.php";
        attachNavbar("inventory");
    }?>

    <main class="main-content">

        <!-- Attach the Tab title/header -->
        <?php require "../../Components/Tab-title.php";
        attachTabTitle("Inventory Management")?>

        <?php include "../../Components/Inventory-components/Filters.php";?>
         <div class="list">
            <?php include "../../Components/Inventory-components/PageContent.php";?>
        </div>
        <?php include "../../Components/Inventory-components/floatingButton.php";
        
        //include the modals
        include "../../Components/Inventory-components/addItemModal.php";
        include "../../Components/Inventory-components/editTransactionModal.php";
        ?>
    </main>

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

<div class="box-container">
     <div class="left">
        <div class="green-boxes">
                <div class="green1"></div>
                <div class="green2"></div>
            </div>
            <div class="red-boxes">
                <div class="red1"></div>
                <div class="red2"></div>
        </div>
     </div>
    <div class="blue">
         <div class="blue1"></div>
         <div class="blue2"></div>
    </div>
</div>