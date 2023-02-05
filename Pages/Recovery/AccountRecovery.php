<?php 
session_start();

//require the Functions and sql commands

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
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../Styles/Register.css">

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
        ?>
        <div class="registration-container">
            <?php
                if($_GET['page'] === "provide otp"){
                    include "../../Components/Recovery/ProvideOTP.php";
                }elseif($_GET['page'] === "no contacts"){
                    include "../../Components/Recovery/NoNumber.php";
                }elseif($_GET['page'] === "change password"){
                    include "../../Components/Recovery/ChangePassword.php";
                }else{
                    include "../../Components/Recovery/InputUsername.php"
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