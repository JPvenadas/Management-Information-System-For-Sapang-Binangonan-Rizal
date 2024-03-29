<?php 
session_start();

//require the sql functions
require "../../Functions/residents-sql-commands.php";
$resident = getSingleResident($_GET['id']);

//if the user is logged in direct them to their dashboard.
//if the user wants to go to the registration page(which is here) they must log out first 
if (isset($_SESSION['userType']) && isset($_SESSION['username'])) {
if($_SESSION['userType'] == "Administrator" or $_SESSION['residentID'] == $_GET['id']){
	?>
<!DOCTYPE html>
<html>

<head>
    <title><?php echo $resident['firstName'] . ' ' . $resident['lastName']?></title>
    <link rel="shortcut icon" href="../../Images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="../../Images/favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,800&display=swap"
        rel="stylesheet">

    <!-- color coding -->
    <link rel="stylesheet" type="text/css" href="../../Styles/ColorCoding.css">
    <!-- custom styles -->
    <link rel="stylesheet" type="text/css" href="../../Styles/Navbar.css">
    <link rel="stylesheet" type="text/css" href="../../Styles/Profile.css">
    <link rel="stylesheet" type="text/css" href="../../Styles/Tab-title.css">
    <link rel="stylesheet" href="../../lightbox2-2.11.4/dist/css/lightbox.min.css">
    <!-- script for lightbox -->
    <link rel="stylesheet" href="../../lightbox2-2.11.4/dist/css/lightbox.min.css">
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
        attachNavbar("residents");
    }elseif($_SESSION['userType'] == "Staff"){
        require "../../Components/Navbar/Staff-Navbar.php";
        attachNavbar("residents");
    }elseif($_SESSION['userType'] == "Resident"){
        require "../../Components/Navbar/Resident-Navbar.php";
        attachNavbar("residents");
    }?>

    <div class="residents-section-content">

        <?php require "../../Components/Tab-title.php";
            attachTabTitle("Residents Profiling");?>
        <?php require '../../Components/Residents-Components/Profile-header.php';
        attachProfileHeader($resident)?>


        <div class="edit-button-container">
            <div class="section-title">Personal Information</div>
            <?php if($resident['registrationStatus'] == "Unverified"){
            ?>
            <a href="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($resident['residenceProof']); ?>"
                data-lightbox="residenceProof" data-title="Residence proof">
                <button class="edit-button">View the Proof of Residence</button>
            </a>
            <?php
            }elseif($resident['registrationStatus'] == "Verified"){
            ?>
            <button onclick="enableEditing()" class="edit-button">Edit Personal Info</button>

            <?php
            
            }?>

        </div>
        <form method="post" action="?id=<?php echo $_GET['id']?>" class="edit-form" mehod="post" action="">
            <div class="personal-information-container">
                <input type="hidden" name="personal-information-residentsID"
                    value="<?php echo $resident['residentID']?>">
                <?php require '../../Components/Residents-Components/Profile-information.php';
            AttachPersonalInfo($resident)
            ?>
            </div>
            <?php require "../../Components/Residents-Components/Save-cancel.php"                    ?>
        </form>

    </div>

    <!-- Script for lightbox -->
    <script src="../../lightbox2-2.11.4/dist/js/lightbox-plus-jquery.min.js"></script>

    <!-- Script for Ionic Icons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script src="../../lightbox2-2.11.4/dist/js/lightbox-plus-jquery.min.js"></script>
</body>

</html>
<?php
    }else{
        header("Location: ../../index.php");
        exit();
    }
}else{
    header("Location: ../../index.php");
	exit();
}
?>