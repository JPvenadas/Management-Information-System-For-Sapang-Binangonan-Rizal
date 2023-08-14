<?php
function generateItem($event){

    $id = $event['eventID'];
    $coverPhoto = $event['coverPhoto'];
    $base64_image = ($coverPhoto !== null) ? base64_encode($coverPhoto) : ''; // Convert the blob data to base64
    $style = ($base64_image !== '') ? 'style="background-image: url(data:image/jpeg;base64,' . $base64_image . ')"' : '';
?>

<a href="../../Pages/Events/Event.php?id=<?php echo $id?>" class="event-record">
    <div class="cover lazy-load" <?php echo $style?> data-src="<?php echo 'data:image/jpg;charset=utf8;base64,' . $base64_image; ?>">
    </div>
    <div class="info">
        <h3 class="event-name"><?php echo $event['eventName']?></h3>
        <h4 class="date"><?php echo date("F, d, Y", strtotime($event['start'])) . " - " . date("F, d, Y", strtotime($event['end']))?></h4>
    </div>
</a>
<script>
const lazyPhotos = document.querySelectorAll('.lazy-load');

function lazyLoad() {
    lazyPhotos.forEach(photo => {
        if (photo.getBoundingClientRect().top <= window.innerHeight && photo.getBoundingClientRect().bottom >= 0 && getComputedStyle(photo).display !== 'none') {
            const imageSrc = photo.getAttribute('data-src');
            photo.style.backgroundImage = `url('${imageSrc}')`;
        }
    });
}

// Attach the lazyLoad function to the scroll event
window.addEventListener('scroll', lazyLoad);
</script>

<?php }?>