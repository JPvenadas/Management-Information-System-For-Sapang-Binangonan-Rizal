<?php 
    $events = getUpcomingEvents();
?>
<div class="events-section">
    <h3 class="section-title">Upcoming Events</h3>
    <div>
        <?php foreach($events as $event){?>
        <div class="event">
            <p><?php echo $event['eventName']?></p>
        </div>
        <?php } ?>
    </div>
</div>