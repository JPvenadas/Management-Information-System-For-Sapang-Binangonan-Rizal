<section class="section-3">
    <div class="section-3-container">
        <h3 class="text-33px-navy">Latest Events</h3>
        <div class="events-container">
            <?php
             $events =  getLatestEvents();
                include "Event-item.php";
                foreach($events as $event){
                    generateEventItem($event);
                }    
            ?>
        </div>
    </div>
</section>