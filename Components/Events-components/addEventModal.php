<div id="add-modal" class="modal-background-blur">
    <form  enctype="multipart/form-data" action="?" method="post" class="modal-content-container">
        <div onclick="closeAddModal()" class="modal-close-button">
            <ion-icon name="close"></ion-icon>
        </div>
        <div class="modal-title">
            <h3>Add an Event</h3>
            <p>Fill the necessary information below</p>
            <div class="inputs">
                <div>
                    <p class="label">Event Title</p>
                    <input required class="input" name="eventName" type="text" placeholder="Event Name">
                </div>
                <div>
                    <p class="label">Date Start</p>
                    <input required class="input" name="start" min="<?php echo date('Y-m-d');?>" type="text" onfocus="(this.type = 'date')" placeholder="Date and Time of Event">
                </div>
                <div>
                    <p class="label">Date End</p>
                    <input required class="input" name="end" min="<?php echo date('Y-m-d');?>" type="text" onfocus="(this.type = 'date')" placeholder="Date and Time of Event">
                </div>
                <div>
                    <p class="label">Event Description</p>
                    <textarea onkeydown="if (event.keyCode == 13) {event.preventDefault();}" required class="long-input" name="eventDescription" placeholder="Event Description"></textarea>
                </div>
            </div>
            <div class="button-container">
                <button type="submit" name="add_event">
                    <ion-icon name="add"></ion-icon>
                    <p>Save</p>
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    let body = document.querySelector('body');
    let addModal =  document.querySelector('#add-modal');

    function closeAddModal() {
    addModal.style.display = "none"
    body.style.overflowY = "auto"
    }

    function openAddModal() {
    addModal.style.display = "flex"
    body.style.overflowY = "hidden"
    
    calendar.style.display = 'none'
    calendarStatus = !calendarStatus
    }
</script>