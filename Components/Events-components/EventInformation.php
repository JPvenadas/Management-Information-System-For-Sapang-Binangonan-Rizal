<?php
// get the picture and attach it as a background image for the cover div
    $coverPhoto = $event['coverPhoto'];
    $base64_image = ($coverPhoto !== null) ? base64_encode($coverPhoto) : ''; // Convert the blob data to base64
    $coverStyle = ($base64_image !== '') ? 'style="background-image: url(data:image/jpeg;base64,' . $base64_image . ')"' : '';
?>
<div class="cover-large" <?php echo $coverStyle; ?>></div>
<div class="event-page-info">
    <div class="left">
        <h2 class="event-page-title"><?php echo $event['eventName']?></h2>
        <h3 class="event-page-date">
            <?php echo date("F, d, Y", strtotime($event['start'])) . " - " . date("F, d, Y", strtotime($event['end']))?>
        </h3>
    </div>
    <div class="right">
        <div class="ellipsis-button">
            <div class="settings">
                <form enctype="multipart/form-data" id="form" action="" method="post">
                    <input accept="image/*" id="cover" type="file" name="coverPhoto" style="display:none">
                    <label for="cover" class="update-button" for="">Update cover-photo</label>
                </form>
                <button onclick="openEditModal()" class="update-button">
                    Update Event Information
                </button>
            </div>
            <ion-icon name="ellipsis-horizontal"></ion-icon>
        </div>
    </div>
</div>
<p class="event-page-description">"
    <?php echo $event['eventDescription']?>
"</p>

<script>
    let moreButton = document.querySelector('.ellipsis-button');
    let settings = document.querySelector('.settings');

    moreButton.addEventListener('click', ()=>{
        settings.style.display = 'inline-block';
    })
    document.addEventListener("click", function (event) {
        // Check if the clicked element is the modal or one of its children
        if (!moreButton.contains(event.target)) {
            settings.style.display = 'none';
        }
    });

    let coverPhotoInput =document.getElementById('cover');
    let changeCoverForm = document.getElementById('form');

    coverPhotoInput.addEventListener('change', ()=>{
        changeCoverForm.submit();
    })
</script>