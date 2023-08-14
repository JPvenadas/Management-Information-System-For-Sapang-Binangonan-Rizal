<?php
    function generateEventItem($event){

    $id = $event['eventID'];
    $coverPhoto = $event['coverPhoto'];
    $base64_image = ($coverPhoto !== null) ? base64_encode($coverPhoto) : ''; // Convert the blob data to base64
    $style = ($base64_image !== '') ? 'style="background-image: url(data:image/jpeg;base64,' . $base64_image . ')"' : '';
?>
<a href="?page=event&id=<?php echo $id?>">
    <div class="event">
        <div class="img" <?php echo $style?> data-src="<?php echo 'data:image/jpg;charset=utf8;base64,' . $base64_image; ?>"></div>
        <div class="event-info">
            <p class="text-13px-gray">
                <?php
                        $dateTime = new DateTime($event['end']);
                        echo $dateTime->format('F, j, Y');
                    ?>
            </p>
            <h4 class="text-17px-navy"><?php echo $event['eventName']?></h4>
            <p class="text-13px-gray">
                <?php echo substr($event['eventDescription'], 0, 150) . "..." ?>
            </p>
        </div>
    </div>
</a>

<?php }?>