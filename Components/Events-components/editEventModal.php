<div id="edit-modal" class="modal-background-blur">
    <form  enctype="multipart/form-data" method="post" class="modal-content-container">
        <div onclick="closeEditModal()" class="modal-close-button">
            <ion-icon name="close"></ion-icon>
        </div>
        <div class="modal-title">
            <h3>Barangay Event</h3>
            <p>You can view or edit the information below</p>
            <div class="inputs">
                <input type="hidden" value="<?php echo $event['eventID']?>" id="event-id" name="eventID">
                <div>
                    <p class="label">Event Title</p>
                    <input value="<?php echo $event['eventName']?>" class="input" name="eventName" id="event-name" type="text" placeholder="Event Name">
                </div>
                <div>
                    <p class="label">Date Start</p>
                    <input value="<?php echo $event['start']?>" id="start" class="input" min="<?php echo date('Y-m-d');?>" name="start" type="text" onfocus="(this.type = 'date')" placeholder="Date and Time of Event">
                </div>
                <div>
                    <p class="label">Date End</p>
                    <input value="<?php echo $event['end']?>" id="end" class="input" min="<?php echo date('Y-m-d');?>" name="end" type="text" onfocus="(this.type = 'date')" placeholder="Date and Time of Event">
                </div>
                <div>
                    <p class="label">Event Description</p>
                    <textarea onkeydown="if (event.keyCode == 13) {event.preventDefault();}" id="event-description" class="long-input" name="eventDescription" placeholder="Event Description"><?php echo $event['eventDescription']?></textarea>
                </div>
            </div>
            <div class="button-container">
                <button type="submit" name="save_event">
                    <ion-icon name="settings"></ion-icon>
                    <p>Save</p>
                </button>
                <button class="archive" type="submit" name="archive_event">
                    <ion-icon name="archive"></ion-icon>
                    <p>Archive</p>
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    let editModal =  document.querySelector('#edit-modal');
    let body =document.querySelector('body');

    function closeEditModal() {
        editModal.style.display = "none"
        body.style.overflowY = "auto"
    }
    function openEditModal() {
        editModal.style.display = "flex"
        body.style.overflowY = "hidden"
    }
</script>