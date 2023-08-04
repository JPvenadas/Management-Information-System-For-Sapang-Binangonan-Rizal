<div class="header">
    <h3 class="title">Hearings</h3>
    <button class="underlined-button">
        <ion-icon name="add"></ion-icon>
        <p>Add another Hearing</p>
    </button>
</div>
<div class="hearings-container">
    <?php
        include "hearing-item.php";
        include "documentationPhoto.php";
        foreach($hearings as $hearing){
            generateHearingItem($hearing);
        }
    ?>

</div>
<script>
const lazyPhotos = document.querySelectorAll('.lazy-load');

function lazyLoad() {
    lazyPhotos.forEach(photo => {
        if (photo.getBoundingClientRect().top <= window.innerHeight && photo.getBoundingClientRect().bottom >=
            0 && getComputedStyle(photo).display !== 'none') {
            const imageSrc = photo.getAttribute('data-src');
            photo.style.backgroundImage = `url('${imageSrc}')`;
        }
    });
}

// Attach the lazyLoad function to the scroll event
window.addEventListener('scroll', lazyLoad);
</script>