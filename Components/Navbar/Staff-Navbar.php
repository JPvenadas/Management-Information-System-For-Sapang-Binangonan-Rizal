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
        include "../../Functions/getAccess.php";
        $access = getAccess();
         include "../../Components/Navbar/Navbar-Item.php";
         generateNavItem($dashboard, "Dashboard", "home-sharp", "../../Pages/Dashboard/Dashboard.php");
        if($access['residents']){
            generateNavItem($residents, "Residents", "people", "../../Pages/Residents/Residents.php");
        }
        if($access['employees']){
            generateNavItem($employees, "Employees", "person", "../../Pages/Employees/Employees.php");
        }
        if($access['attendance']){
            generateNavItem($attendance, "Attendance", "checkmark-circle", "../../Pages/Attendance/Attendance.php");
        }
        if($access['services']){
            generateNavItem($services, "Services", "document", "../../Pages/Services/Services.php");
        }
        if($access['events']){
            generateNavItem($events, "Events", "calendar", "../../Pages/Events/Events.php");
        }
        if($access['announcements']){
            generateNavItem($announcements, "Announcements", "chatbubble", "../../Pages/Dashboard/Dashboard.php");
        }
        if($access['inventory']){
            generateNavItem($inventory, "Inventory", "albums", "../../Pages/Inventory/Inventory.php");
        }
        if($access['incidents']){
            generateNavItem($incidents, "Incidents", "alert-circle", "../../Pages/Incidents/Incidents.php");
        }
        if($access['reports']){
            generateNavItem($reports, "Reports", "stats-chart", "../../Pages/Reports/Reports.php");
        }
        
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