<div class="bar">
    <div class="nav-container">
        <div class="logo-container">
            <div>
                <img class="logo" src="Images/logo.png" alt="">
            </div>
            <div>
                <h1 class="logo-name">Barangay Sapang</h1>
                <h2 class="logo-sub">Management Information System</h2>
            </div>
        </div>
        <nav class="sidebar">
            <ul>
                <li>
                    <a href="?">Home</a>
                </li>
                <li>
                    <a href="?page=about">About</a>
                </li>
                <li>
                    <a href="?page=news">News</a>
                </li>
                <li>
                    <a href="?page=contacts">Contacts</a>
                </li>
                <li>
                    <a href="?page=support">Support</a>
                </li>
            </ul>
        </nav>
        <div class="navbar-button-container">
            <button onclick="openLoginModal()" class="button">
                Sign in
            </button>
        </div>
         <div class="ham-menu">
             <ion-icon name="menu"></ion-icon>
         </div>
    </div>
</div>
<script>
    let sidebar = document.querySelector('.sidebar');
    let menu = document.querySelector('.ham-menu');
    let navStatus = false;
    let outside =document.querySelector('body');

    menu.addEventListener('click', ()=>{
      navStatus = !navStatus;
      shownavbar();
    })

    function shownavbar(){
      if(navStatus === false){
        sidebar.style.right = "-100%";
        outside.style.overflow = "auto";
      }else{
        sidebar.style.right = "0";
        outside.style.overflow = "hidden";
      }
    }
</script>