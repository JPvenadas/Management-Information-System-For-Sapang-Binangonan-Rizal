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
</head>

<body>

        <?php
        
         include "../../Components/Registration/Navbar.php";
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
           }else{
            include "../../Components/Registration/Step5.php";
           }
            ?>
        </div>
        <!-- Script for Ionic Icons -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>