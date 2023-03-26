<div id="edit-modal" class="modal-background-blur">
    <form  enctype="multipart/form-data" action="?" method="post" class="modal-content-container">
        <div onclick="closeEditModal()" class="modal-close-button">
            <ion-icon name="close"></ion-icon>
        </div>
        <div class="modal-title">
            <h3>Barangat Event</h3>
            <p>You can view or edit the information below</p>
            <div class="inputs">
                <input type="hidden" id="event-id" name="eventID">
                <div>
                    <p class="label">Event Title</p>
                    <input class="input" name="eventName" id="event-name" type="text" placeholder="Event Name">
                </div>
                <div>
                    <p class="label">Schedule</p>
                    <input id="schedule" class="input" min="<?php echo date('Y-m-d');?>" name="schedule" type="text" onfocus="(this.type = 'date')" placeholder="Date and Time of Event">
                </div>
                <div>
                    <p class="label">Event Description</p>
                    <textarea id="event-description" class="long-input" name="eventDescription" placeholder="Event Description"></textarea>
                </div>
            </div>
            <div class="button-container">
                <button class="archive" type="submit" name="archive_event">
                    <ion-icon name="archive"></ion-icon>
                    <p>Archive</p>
                </button>
                <button type="submit" name="save_event">
                    <ion-icon name="settings"></ion-icon>
                    <p>Save</p>
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    let editModal =  document.querySelector('#edit-modal');

    function closeEditModal() {
        editModal.style.display = "none"
        body.style.overflowY = "auto"
    }
    function openEditModal(id, name, description, sched) {
        let eventID = document.querySelector("#event-id");
        let eventName = document.querySelector("#event-name");
        let eventDescription = document.querySelector("#event-description");
        let schedule = document.querySelector("#schedule");

        eventID.value = id;
        eventName.value = name;
        eventDescription.value = description;
        schedule.value = sched;

        editModal.style.display = "flex"
        body.style.overflowY = "hidden"
    }
</script>