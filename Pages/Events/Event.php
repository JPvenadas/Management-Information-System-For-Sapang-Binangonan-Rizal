<?php 
session_start();

//require the sql functions
require "../../Functions/events-sql-commands.php";

    //get the data of the event to be viewed

    $conn = openCon();
    $id = $_GET['id'];
    $command = "SELECT * FROM `tbl_events` WHERE `eventID` = '$id'";
    $result = mysqli_query($conn, $command);
    $event = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    mysqli_close($conn);

//if the user is logged in direct them to their dashboard.
//if the user wants to go to the registration page(which is here) they must log out first 
if (isset($_SESSION['userType']) && isset($_SESSION['username']) && $_SESSION['userType'] === "Administrator" || (isset($_SESSION['access']) && $_SESSION['access']['events'])) {
	?>
<!DOCTYPE html>
<html>

<head>
    <title>Events</title>
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
    <link rel="stylesheet" type="text/css" href="../../Styles/Events.css">
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
    <!-- Attach the navbar -->
    <?php 
    if($_SESSION['userType'] == "Administrator"){
        require "../../Components/Navbar/Administrator-Navbar.php";
        attachNavbar("events");
    }elseif($_SESSION['userType'] == "Staff"){
        require "../../Components/Navbar/Staff-Navbar.php";
        attachNavbar("events");
    }?>

    <main class="main-content gap-15">

        <?php
        // attach the tab-title/header
        require "../../Components/Tab-title.php";
        attachTabTitle("Baranggay Events");
        
        //attach the event information (body)
        include "../../Components/Events-components/EventInformation.php";

        //attach the event gallery
        include "../../Components/Events-components/Gallery.php";        
        ?>
       
    </main>

    <?php include '../../Components/Events-components/editEventModal.php'?>
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
?>