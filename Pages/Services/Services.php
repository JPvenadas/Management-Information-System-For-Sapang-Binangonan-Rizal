<?php 
session_start();

//require the sql functions
require "../../Functions/services-sql-commands.php";

//if the user is logged in direct them to their dashboard.
//if the user wants to go to the registration page(which is here) they must log out first 
if (isset($_SESSION['userType']) && isset($_SESSION['username']) && $_SESSION['userType'] === "Administrator" || (isset($_SESSION['access']) && $_SESSION['access']['services'])) {
	?>
    <!DOCTYPE html>
<html>

<head>
    <title>Services</title>
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
    <link rel="stylesheet" type="text/css" href="../../Styles/Services.css">
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
            attachNavbar("services");
        }elseif($_SESSION['userType'] == "Staff"){
            require "../../Components/Navbar/Staff-Navbar.php";
            attachNavbar("services");
        }?>

        <!-- main content of the page -->
        <main class="main-content">
            <?php require "../../Components/Tab-title.php";
            attachTabTitle("Services");
            
            include "../../Components/Services-components/ServicesNav.php";
            if(isset($_GET['page'])){
                if($_GET['page'] == 'Processed' or $_GET['page'] == 'Finished'){
                    include "../../Components/Services-components/transactionsList.php";
                }else{
                    include "../../Components/Services-components/newTransactionPage.php";
                }
            }else{
                include "../../Components/Services-components/newTransactionPage.php";
            }


            //include the modals
            include "../../Components/Services-components/residentsModal.php";
            include "../../Components/Services-components/AddTransactionModal.php";
            include "../../Components/Services-components/EditTransactionModal.php";
            include "../../Components/Services-components/PaymentModal.php";
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