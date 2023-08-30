<?php
function attachNavbar($page){

    // this will just determine which tab bar should be highlighted
    $dashboard=""; $announcements="";$services="";$contacts = "";
    switch ($page) {
        case "dashboard":
         $dashboard="highlight";
          break;
        case "announcements":
        $announcements="highlight";
        break;
        case "services":
          $services="highlight";
        break;
        case "contacts":
          $contacts="highlight";
        break;
        default:
         
      }

?>
 <div class="ham-menu">
      <ion-icon name="menu"></ion-icon>
</div>
<nav class="sidebar">
    <a href="../../Pages/Residents/Profile.php?id=<?php echo $_SESSION['residentID']?>" class="profile">
        <div class="profile-picture">
            <img loading="lazy" src="../../Upload-img/<?php echo $_SESSION['imageName']?>"
                alt="Profile Picture">
        </div>
        <div class="profile-info">
            <p class="username"><?php print_r($_SESSION['firstName']); echo " "; print_r($_SESSION['lastName'])?></p>
            <p class="usertype"><?php print_r($_SESSION['userType'])?></p>
        </div>
    </a>
    <ul class="navigation-container">
        <?php
         include "../../Components/Navbar/Navbar-Item.php";
         generateNavItem($dashboard, "Dashboard", "home-sharp", "../../Pages/Dashboard/Resident-Dashboard.php");
         generateNavItem($services, "Services", "document", "../../Pages/Services/Resident-Services.php");
         generateNavItem($announcements, "Announcements", "chatbubble", "../../Pages/Announcements/Resident-announcements.php");
         generateNavItem($contacts, "Contact us", "call", "../../Pages/Contact us/Contacts.php");
        ?>
        <!-- Logout -->
        <li class="sidebar-item logout">
            <a href="../../Functions/logout.php" class="sidebar-item-container">
                <ion-icon name="power"></ion-icon>
                <span class="sidebar-item-text">Logout</span>
            </a>
        </li>
    </ul>
    <div class="sidebar-circle"></div>
</nav>
<script>
    let sidebar = document.querySelector('.sidebar');
    let menu = document.querySelector('.ham-menu');
    let navStatus = false;

    menu.addEventListener('click', ()=>{
      navStatus = !navStatus;
      shownavbar();
      console.log(navStatus)
     
    })
    
    window.addEventListener("resize", ()=>{
      if (window.innerWidth >= 1000) {
        sidebar.style.left = "0";
        menu.style.left = "270px";
        menu.style.display = "none";
      }else{
        sidebar.style.left = "-300px";
        menu.style.left = "10px";
        menu.style.display = "flex";
      }
    })

    function shownavbar(){
      if(navStatus === false){
        sidebar.style.left = "-300px";
        menu.style.left = "10px";
      }else{
        sidebar.style.left = "0";
        menu.style.left = "270px";
      }
    }
</script>
<?php }?>