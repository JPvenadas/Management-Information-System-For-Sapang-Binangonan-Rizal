<?php
    $id = $_GET['id'];
    //get the photos of the selected event
    $conn = openCon();
    $command = "SELECT * FROM `tbl_eventGallery` WHERE `eventID` = '$id'";
    $result = mysqli_query($conn, $command);
    $gallery = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
?>
<div class="gallery">
    <h4 class="gallery-title">Event Gallery</h4>
    <div class="divider"></div>
    <div class="photos-container">
        <?php 
                    foreach($gallery as $photo){
                    $galleryPhoto = $photo['Picture'];
                    $base64_pic = ($galleryPhoto !== null) ? base64_encode($galleryPhoto) : ''; // Convert the blob data to base64
                    $divStyle = ($base64_pic !== '') ? 'style="background-image: url(data:image/jpg;charset=utf8;base64,' . $base64_pic . ')"' : '';
                ?>

        <div style="position: relative">
            <form method='post' action="">
                <input name="photo_id" type="hidden" value="<?php echo $photo['ID']?>">
                <button name="delete_photo" type="submit" class="delete-photo">
                    <ion-icon title="Delete" name="remove-circle"></ion-icon>
                </button>
            </form>
            <a href="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($photo['Picture']); ?>"
                data-lightbox="gallery" data-title="<?php echo $event['eventName']?>">
                <div class="photo lazy-load" <?php echo $divStyle?> data-src="<?php echo 'data:image/jpg;charset=utf8;base64,' . $base64_pic; ?>"></div>
            </a>
        </div>
        <?php
                    }
                ?>
        <form enctype="multipart/form-data" method='post' id="add-photo-form" action="">
            <input name="event_id" type="hidden" value="<?php echo $id?>">
            <input id="photo" name="uploaded_photo" type="file" style="display: none">
            <label for="photo" title="Add Photos" class="add-photo">
                <ion-icon name="images"></ion-icon>
                <p>Add Photos</p>
            </label>
        </form>
    </div>
</div>
<script>
let photoInput = document.getElementById('photo');
let addPhotoForm = document.getElementById('add-photo-form');

photoInput.addEventListener('change', () => {
    addPhotoForm.submit();
})

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