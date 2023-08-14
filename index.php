<?php 
session_start();
include "Functions/Index-sql-commands.php";

if (isset($_SESSION['userType']) && isset($_SESSION['username'])) {
	if($_SESSION['userType'] == "Resident"){
        header("Location: Pages/Dashboard/Resident-Dashboard.php");
	    exit();
    }else{
        header("Location: Pages/Dashboard/Dashboard.php");
	    exit();
    }
}else{
    session_unset();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Sapang Management Information System</title>
    <link rel="shortcut icon" href="Images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="Images/favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    
    <link rel="stylesheet" type="text/css" href="Styles/ColorCoding.css">
    <link rel="stylesheet" type="text/css" href="Styles/Login.css">
</head>

<body>
    <!-- error and notifications alert -->
    <?php if (isset($_GET['error'])) { ?>
    <!-- error alert -->
    <div class="error-container">
        <p class="error"><?php echo $_GET['error']; ?></p>
    </div>
    <?php } ?>


    <?php if (isset($_GET['notif'])) { ?>
    <!-- notification alert -->
    <div class="error-container">
        <p class="notif"><?php echo $_GET['notif']; ?></p>
    </div>
    <?php }
    
    //include the navbar
    include "Components/Login-components/Navbar.php";?>

    <main>
        <?php
        if(!isset($_GET['page'])){
             //include the first section
             include "Components/Login-components/Section1.php";

             //include the second section
             include "Components/Login-components/Section2.php";
 
             //include the third section
             include "Components/Login-components/Section3.php";

        }
        
        elseif(isset($_GET['page']) and $_GET['page'] == "news"){
            //include all events
            include "Components/Login-components/All-events.php";
        }   

        elseif(isset($_GET['page']) and $_GET['page'] == "event"){
            //include all events
            include "Components/Login-components/Event-page.php";

            //include the latest events
            include "Components/Login-components/Section3.php";
        }  

        elseif(isset($_GET['page']) and $_GET['page'] == "privacypolicy"){
            //include the privacy policy section
            include "Components/Login-components/PrivacyPolicy.php";
        }   
        
        elseif(isset($_GET['page']) and $_GET['page'] == "support"){
            //include the privacy policy section
            include "Components/Login-components/helpAndSupport.php";
        }   
           
        ?>
    </main>
    <footer>
        <?php include "Components/Login-components/footer.php"?>
    </footer>
    
    <?php 
    //include the login modal
    include "Components/Login-components/Login-modal.php";
    ?>
</body>
<script>
const lazyPhotos = document.querySelectorAll('.lazy-load');

function lazyLoad() {
    lazyPhotos.forEach(photo => {
        if (photo.getBoundingClientRect().top <= window.innerHeight && photo.getBoundingClientRect().bottom >=
            0 && getComputedStyle(photo).display !== 'none') {
            const imageSrc = photo.getAttribute('data-src');
            photo.style.backgroundImage = `url('${imageSrc}')`;
        }
    });
}

// Attach the lazyLoad function to the scroll event
window.addEventListener('scroll', lazyLoad);
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</html>
<?php
}
?>