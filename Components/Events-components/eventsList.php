<div class="events-container">
    <?php require "eventItem.php";
        $events = getEvents();
        foreach ($events as $event) {
        generateItem($event);
        }
    ?>
</div>