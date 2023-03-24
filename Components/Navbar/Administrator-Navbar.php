<?php
function attachNavbar($page){

    // this will just determine which tab bar should be highlighted
    $dashboard=""; $residents="";$announcements="";$inventory="";$attendance="";$events=""; $employees=""; $users=""; $services="";$incidents="";$reports="";$settings="";
    switch ($page) {
        case "dashboard":
         $dashboard="highlight";
          break;
        case "residents":
         $residents="highlight";
          break;
        case "employees":
         $employees="highlight";
          break;
        case "events":
        $events="highlight";
        break;
        case "inventory":
        $inventory="highlight";
        break;
        case "users":
         $users="highlight";
        break;
        case "announcements":
        $announcements="highlight";
        break;
        case "services":
          $services="highlight";
        break;
        case "attendance":
         $attendance="highlight";
        break;
        case "incidents":
         $incidents="highlight";
        break;
        case "reports":
          $reports="highlight";
        break;
        default:
          $settings="highlight";
      }

?>
 <div class="ham-menu">
      <ion-icon name="menu"></ion-icon>
</div>
<nav class="sidebar">
    <div class="profile">
        <div class="profile-picture">
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($_SESSION['image']); ?>"
                alt="Profile Picture">
        </div>
        <div class="profile-info">
            <p class="username"><?php print_r($_SESSION['firstName']); echo " "; print_r($_SESSION['lastName'])?></p>
            <p class="usertype"><?php print_r($_SESSION['userType'])?></p>
        </div>
    </div>
    <ul class="navigation-container">
        <?php
         include "../../Components/Navbar/Navbar-Item.php";
         generateNavItem($dashboard, "Dashboard", "home-sharp", "../../Pages/Dashboard/Dashboard.php");
         generateNavItem($residents, "Residents", "people", "../../Pages/Residents/Residents.php");
         generateNavItem($employees, "Employees", "person", "../../Pages/Employees/Employees.php");
         generateNavItem($attendance, "Attendance", "checkmark-circle", "../../Pages/Attendance/Attendance.php");
         generateNavItem($users, "Users", "person-circle", "../../Pages/Users/Users.php");
         generateNavItem($services, "Services", "document", "../../Pages/Services/Services.php");
         generateNavItem($events, "Events", "calendar", "../../Pages/Events/Events.php");
         generateNavItem($announcements, "Announcements", "chatbubble", "../../Pages/Announcements/Announcements.php");
         generateNavItem($inventory, "Inventory", "albums", "../../Pages/Dashboard/Dashboard.php");
         generateNavItem($incidents, "Incidents", "alert-circle", "../../Pages/Dashboard/Dashboard.php");
         generateNavItem($reports, "Reports", "stats-chart", "../../Pages/Dashboard/Dashboard.php");
         generateNavItem($settings, "Settings", "settings", "../../Pages/Settings/Settings.php");
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