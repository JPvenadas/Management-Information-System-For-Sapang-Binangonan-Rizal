<?php 
    $events = getUpcomingEvents();
?>
<div class="services-section">
    <h3 class="section-title">Upcoming Events</h3>
    <div>
        <?php foreach($events as $event){?>
        <div class="service">
            <p><?php echo $event['eventName']?></p>
        </div>
        <?php } ?>
    </div>
</div>