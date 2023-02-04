<?php 
session_start();

//require the Functions and sql commands
require "../../Functions/registration-sql-commands.php";

//if the user is logged in direct them to their dashboard.
//if the user wants to go to the registration page(which is here) they must log out first 
if (isset($_SESSION['userType']) && isset($_SESSION['username'])) {
	header("Location: Pages/Dashboard/dashboard.php");
	exit();
}else{


?>
<!DOCTYPE html>
<html>

<head>
    <title>Login: Sapang Management Information System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../Styles/register.css">

    <!-- a script to prevent the "confirm resubmission" alert -->
    <script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
    </script>
</head>

<body>

        <?php
         include "../../Components/Registration/Navbar.php";
         include "../../Components/Registration/Datalists.php"
        ?>
        <div class="registration-container">
            <?php
           if($_GET['step'] == "1"){
            include "../../Components/Registration/Step1.php";
           }elseif($_GET['step'] == "2"){
            include "../../Components/Registration/Step2.php";
           }elseif($_GET['step'] == "3"){
            include "../../Components/Registration/Step3.php";
           }elseif($_GET['step'] == "4"){
            include "../../Components/Registration/Step4.php";
           }elseif($_GET['step'] == "5"){
            include "../../Components/Registration/Step5.php";
           }elseif($_GET['step'] == "done"){
            include "../../Components/Registration/Done.php";
           }
            ?>
        </div>
        <!-- Script for Ionic Icons -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
<?php
}
?>