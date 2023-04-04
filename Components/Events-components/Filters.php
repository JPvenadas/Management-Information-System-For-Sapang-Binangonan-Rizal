<?php
$scheduled=""; $history="";
    if(isset($_GET['filter'])){
        
        if($_GET['filter'] == "history"){
            $history = "underline";
        }else{
            $scheduled = "underline";
        }

    }else{
        $scheduled = "underline";
    }
?>

<div class="action-controls-container">
    <div class="events-nav">
        <ul class="nav-list">
            <li><a class="<?php echo $scheduled?>" href="?">Scheduled</a></li>
            <li><a class="<?php echo $history?>" href="?filter=history">Events History</a></li>
        </ul>
    </div>
    <form action="" method="post" class="search-button-container">
        <input value="<?php if(isset($_GET['search'])){echo $_GET['search'];}else{echo "";}?>" autocomplete="off"
            name="search_input" placeholder="Enter the Events information here" class="searchbar"
            type="text">
        <input type="hidden" name="search_filter" value ="<?php
            if(isset($_GET['filter']) && $_GET['filter'] == "history"){
                echo "history";
            }else{
                echo "scheduled";
            }
        ?>">
        <button name="search_button" type="submit" class="search-button">
            <ion-icon name="search-outline"></ion-icon>
        </button>
        <div class="calendar-container">
            <div class="calendar-panel">
                    <?php require "calendarView.php"?>
            </div>
            <div class="calendar-view">
                <ion-icon name="calendar-outline"></ion-icon>
            </div>
        </div>
    </form>
</div>

<script>
    let calendar = document.querySelector('.calendar-panel');
    let calendarButton = document.querySelector('.calendar-view');
    let calendarStatus = false;

    calendarButton.addEventListener('click', ()=>{
       showCalendar();
    })

    const showCalendar = () =>{
        if(calendarStatus){
            calendar.style.display = 'none'
       }else{
        calendar.style.display = 'block'
       }
       calendarStatus = !calendarStatus
    }
</script>