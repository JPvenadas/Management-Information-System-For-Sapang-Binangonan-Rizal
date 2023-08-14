<?php
   $event = getSingleEvent();
   $images = getImages();
?>
<section class="event-section">
    <div class="container">
        <div>
            <h2 class="text-25px-navy"><?php echo $event['eventName']?></h2>
            <p class="text-16px-gray">
                <?php
                    $startDate = new DateTime($event['start']);
                    $endDate = new DateTime($event['end']);
                    echo $startDate->format('F, j, Y') . " - " . $endDate->format('F, j, Y');
                ?>
            </p>
        </div>
        <div>
            <!-- carousel -->
            <div id="carouselExampleIndicators" class="carousel slide">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                        class="active" aria-current="true" aria-label="Slide 1"></button>
                    <?php for($i = 1; $i < count($images) + 1; $i++){?>
                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo $i?>"
                        aria-label="Slide <?php echo $i?>"></button>
                    <?php }?>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img style="width: 300px "
                            src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($event['coverPhoto']); ?>"
                            class="d-block w-100" alt="...">
                    </div>
                    <?php
                        foreach($images as $image){?>

                    <div class="carousel-item">
                        <img style="width: 300px "
                            src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($image['Picture']); ?>"
                            class="d-block w-100" alt="...">
                    </div>
                    <?php }?>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <p class="event-summary text-16px-gray"><?php echo $event['eventDescription']?></p>
        </div>
</section>